<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $titulo ?? 'Mi Tienda'; ?></title>

    <!-- CSS Global -->
    <link rel="stylesheet" href="/MICHICOLECCION/assets/css/global.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
<!--
        


<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bulma@0.9.4/css/bulma.min.css">-->

    <!-- CSS Específico de la Página
     este es una plantilla para usarlo en todas las paginas
     el if es por si llega a tener su propio css de cada pagina y tener un orden
    
    -->
    <?php if (!empty($css)): ?>
        <link rel="stylesheet" href="/MICHICOLECCION/assets/css/<?php echo $css; ?>">
    <?php endif; ?>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
</head>
<body>
<!-- asi se inserta los layout a una pagina por medio de la view -->
<?php require_once 'header.php'; ?>

<main>
    <?php echo $contenido; // Aquí se inserta el contenido de la página 
    // es un obj que contiene el cuerpo de la vista por ejemplo la lista productos
    // ?>
</main>

<?php require_once 'footer.php'; ?>

<!-- JavaScript Global
 


-->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>

    
<script src="/MICHICOLECCION/assets/js/global.js"></script>

<!-- JavaScript Específico de la Página -->
<?php if (!empty($js)): ?>
    <script src="/MICHICOLECCION/assets/js/<?php echo $js; ?>"></script>
<?php endif; ?>

</body>
</html>