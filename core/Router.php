
<?php
class Router {
    
    protected $routes = [];
    protected $notFound;

    /**
     * Registra una ruta para un método HTTP dado.
     *
     * @param string   $method   Método HTTP (GET, POST, etc.).
     * @param string   $pattern  Ruta con posibles parámetros dinámicos, ej: "product/{id}".
     * @param callable $callback Función o método a ejecutar cuando se cumpla la ruta.
     */
    public function add($method, $pattern, $callback) {
        $pattern = preg_replace_callback('#\{([a-zA-Z0-9_]+)\}#', function($matches) {
            return '(?P<' . $matches[1] . '>[^/]+)';
        }, $pattern);

        $pattern = '#^' . $pattern . '$#';

        $this->routes[] = [
            'method'   => strtoupper($method),
            'pattern'  => $pattern,
            'callback' => $callback
        ];
    }

    public function get($pattern, $callback) {
        $this->add('GET', $pattern, $callback);
    }

    public function post($pattern, $callback) {
        $this->add('POST', $pattern, $callback);
    }

    /**
     * Despacha la solicitud actual, comparando la URL y el método HTTP.
     *
     * @param string $uri           La URI solicitada (por ejemplo, de $_SERVER['REQUEST_URI']).
     * @param string $requestMethod El método HTTP de la solicitud (por ejemplo, GET, POST, etc.).
     */
    public function dispatch($uri, $requestMethod) {
        
        $uri = parse_url($uri, PHP_URL_PATH);

    $basePath = '/MICHICOLECCION';

    
    if (strpos($uri, $basePath) === 0) {
        $uri = substr($uri, strlen($basePath));
    }

    
    $uri = trim($uri, '/');

    if (empty($uri)) {
        $uri = '/';
    }



        foreach ($this->routes as $route) {
            
            if (strtoupper($requestMethod) != $route['method']) {
                continue;
            }
            
            if (preg_match($route['pattern'], $uri, $matches)) {
                
                $params = array_filter($matches, 'is_string', ARRAY_FILTER_USE_KEY);
                
                return call_user_func_array($route['callback'], $params);
            }
        }
        if ($this->notFound) {
            call_user_func($this->notFound);
        } else {
            header("HTTP/1.0 404 Not Found");
            echo "404 Not Found";
        }
    }

    public function setNotFound($callback) {
        $this->notFound = $callback;
    }
}
?>