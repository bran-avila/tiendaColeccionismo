<?php
require_once 'core/Validator.php';
require_once 'models/Checkout.php'; 
require_once 'models/pedido.php'; 

class CheckoutController {
    private $checkoutModel;
    private $pedidoModel;
    
    public function __construct() {
        $this->checkoutModel = new CheckoutModel();
        $this->pedidoModel = new Pedido();
    }

    public function showCheckout() {
        session_start();
        if (!isset($_SESSION['usuario_id'])) {
            header("Location: /MICHICOLECCION/login");
            $_SESSION['Error'] = "Tiene que iniciar sesion o registrarse para comprar.";
            exit;
        }
        if (!isset($_SESSION['carrito']) || count($_SESSION['carrito']) < 1) {
            header("Location: /MICHICOLECCION/");
            $_SESSION['Error'] = "Tiene que agregar productos al carrito.";
            exit;
        }
        $carrito = isset($_SESSION['carrito']) ? $_SESSION['carrito'] : [];
        $totalCarrito = $this->totalCarrito();
        $envioGratis = $totalCarrito >= 999;
        $idUsuario = $_SESSION['usuario_id']; 
        $direcciones = $this->checkoutModel->obtenerDirecciones($idUsuario);
        $metodosEnvio = $this->checkoutModel->obtenerMetodosEnvio();
        /*
        $carrito = $this->checkoutModel->obtenerCarrito($idUsuario);
        //$tiposPago = $this->checkoutModel->obtenerTiposPago();*/
        
        require_once 'views/checkout/checkout.php';
    }


    public function totalCarrito(){
        $carrito = isset($_SESSION['carrito']) ? $_SESSION['carrito'] : [];
        $totalCarrito = 0;
        foreach ($carrito as $producto): 
            $subtotal = $producto['precio'] * $producto['cantidad'];
            $totalCarrito += $subtotal;
        endforeach;
        return $totalCarrito;
    }

    public function procesarCheckout() {
        session_start();
        if (!isset($_SESSION['usuario_id'])) {
            header("Location: /MICHICOLECCION/login");
            echo json_encode(["success" => false, "message" => "Debes iniciar sesión para continuar."]);
            exit;
        }
        if (!isset($_SESSION['carrito']) || count($_SESSION['carrito']) < 1) {
            header("Location: /MICHICOLECCION/");
            echo json_encode(["success" => false, "message" => "Debes agregar productos al carrito."]);
            exit;
        }
        
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            
            if (!isset($_SESSION['usuario_id'])) {
                echo json_encode(["success" => false, "message" => "Debes iniciar sesión para continuar."]);
                return;
            }
        
            // Obtener todos los datos enviados por POST
            $datos = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
            $resultado = $this->pedidoModel->registrarPedido($datos);
            if($resultado['success']){
                unset($_SESSION['carrito']);
            }
            header('Content-Type: application/json');
            echo json_encode($resultado);
            return;
        } else {
            echo json_encode(["success" => false, "message" => "Método no permitido."]);
            return;
        }
    }

    public function ordenPagoPaypal(){
        session_start();
        $clientId = "AYmkW-I_J63Cz7gRXzAspoEJzI_Tl0otpRCK2fTPa2JaFOD-Y9G9s5vhTEwmFOPqqxDvytuROEiCJLNu";
        $clientSecret = "EIBN6MSsF04o8IDejAJLZDGink4tYy-gov-C9GZr_uzwqs12TBpyyrxWjxZigWih94ktpFMKJh3Bzhht";

        // Obtener el monto enviado desde el frontend
        $metodoEnvio=$this->checkoutModel->obtenerMetodoEnvioPorId($_SESSION['id-metodo-envio']);
        $precioEnvio = isset($metodoEnvio['precio']) ? (float)$metodoEnvio['precio'] : 0;
        $totalCarrito = $this->totalCarrito();
        $monto = $totalCarrito + $precioEnvio;
        $monto;

        // Obtener el token de acceso desde PayPal
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, "https://api-m.sandbox.paypal.com/v1/oauth2/token");
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_USERPWD, $clientId . ":" . $clientSecret);
        curl_setopt($ch, CURLOPT_POSTFIELDS, "grant_type=client_credentials");
        curl_setopt($ch, CURLOPT_HTTPHEADER, ["Content-Type: application/x-www-form-urlencoded"]);

        $response = curl_exec($ch);
        if (curl_errno($ch)) {
            echo 'Error:' . curl_error($ch);
        }
        curl_close($ch);

        $accessToken = json_decode($response)->access_token;

        // Crear la orden en PayPal
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, "https://api-m.sandbox.paypal.com/v2/checkout/orders");
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode([
            "intent" => "CAPTURE",
            "purchase_units" => [[
                "amount" => [
                    "currency_code" => "USD",
                    "value" => $monto
                ]
            ]]
        ]));
        curl_setopt($ch, CURLOPT_HTTPHEADER, [
            "Content-Type: application/json",
            "Authorization: Bearer $accessToken"
        ]);

        $response = curl_exec($ch);
        if (curl_errno($ch)) {
            echo 'Error:' . curl_error($ch);
        }
        curl_close($ch);

        echo $response;
    }

    public function datosPedido(){
        session_start();
        header('Content-Type: application/json');
        // Verificar si la solicitud es POST
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Obtener todos los datos enviados por POST
            $datos = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
            $_SESSION['id-metodo-envio']=$datos["envio"];

            // Devolver los datos en formato JSON
            echo json_encode([
                'success' => true,
                'message' => 'Datos recibidos correctamente',
                'datos'=>$_SESSION['id-metodo-envio']
            ]);
        } else {
            // Responder con un error si no es una solicitud POST
            echo json_encode([
                'success' => false,
                'message' => 'Método no permitido'
            ]);
        }

    }

}
?>