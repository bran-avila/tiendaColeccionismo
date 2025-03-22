<?php if (!empty($direcciones)) : ?>
    <label for="idDireccion">Selecciona una dirección:</label>
    <select name="idDireccion" id="idDireccion">
        <option value="">Selecciona una dirección</option>
        <?php foreach ($direcciones as $index => $direccion) : ?>
            <option value="<?= $direccion['idDireccion'] ?>"
                data-nombre="<?= htmlspecialchars($direccion['nombre']) ?>"
                data-apellidoP="<?= htmlspecialchars($direccion['apellidoP']) ?>"
                data-apellidoM="<?= htmlspecialchars($direccion['apellidoM']) ?>"
                data-numExterior="<?= htmlspecialchars($direccion['numExterior']) ?>"
                data-numInterior="<?= htmlspecialchars($direccion['numInterior']) ?>"
                data-calle="<?= htmlspecialchars($direccion['calle']) ?>"
                data-colonia="<?= htmlspecialchars($direccion['colonia']) ?>"
                data-cp="<?= htmlspecialchars($direccion['cp']) ?>"
                data-telefono="<?= htmlspecialchars($direccion['telefono']) ?>"
                data-ciudad="<?= htmlspecialchars($direccion['ciudad']) ?>"
                data-estado="<?= htmlspecialchars($direccion['estado']) ?>">
                Dirección <?= $index + 1 ?>
            </option>
        <?php endforeach; ?>
    </select>

    <!-- Campos de entrada donde se llenará la dirección seleccionada -->
    <input type="text" id="nombre" placeholder="Nombre">
    <input type="text" id="apellidoP" placeholder="Apellido Paterno">
    <input type="text" id="apellidoM" placeholder="Apellido Materno">
    <input type="text" id="numExterior" placeholder="Número Exterior">
    <input type="text" id="numInterior" placeholder="Número Interior">
    <input type="text" id="calle" placeholder="Calle">
    <input type="text" id="colonia" placeholder="Colonia">
    <input type="text" id="cp" placeholder="Código Postal">
    <input type="text" id="telefono" placeholder="Teléfono">
    <input type="text" id="ciudad" placeholder="Ciudad">
    <input type="text" id="estado" placeholder="Estado">
<?php else : ?>
    <p>No tienes direcciones guardadas. Agrega una nueva antes de continuar.</p>
<?php endif; ?>