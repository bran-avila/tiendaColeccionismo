<!DOCTYPE html>
<html>
<head>
    <title><?= htmlspecialchars($producto['nombre']); ?></title>
</head>
<body>
    <h1><?= htmlspecialchars($producto['nombre']); ?></h1>
    <p>Precio: $<?= htmlspecialchars($producto['precio']); ?></p>
    <p><?= htmlspecialchars($producto['descripcion']); ?></p>
    <a href="/productos">Volver a productos</a>
</body>
</html>