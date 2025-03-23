<?php if (!empty($direcciones)) : ?>
    <label class="labelc" for="idDireccionExistente">Selecciona una dirección:</label>
    <select class="form-control" name="idDireccionExistente" id="idDireccionExistente">
        <option value="0" selected >Ninguna dirección</option>
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
    <input type="hidden" name="idDireccionNueva" id="idDireccionNueva" value="false">
<?php else : ?>
    <p>No tienes direcciones guardadas. Agrega una nueva antes de continuar.</p>
    <input type="hidden" name="idDireccionNueva" id="idDireccionNueva" value="true">
<?php endif; ?>