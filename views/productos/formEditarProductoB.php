<div class=" menuFlotante container-fluid " id="menuFlotanteEditar">

<div class="row justify-content-center">
            <form id="formProductoEditar" class="col-md-6 col-lg-5 mt-4 needs-validation" novalidate>
                <div class="card overflow-auto" style="height: 500px;">
                    <div class="card-body colorFomulario">
                        <h2 class="h4 text-center">Editar Producto:</h2>

                        <div class="mb-3">
                            <label class="form-label">Nombre</label>
                            <input class="form-control" type="text" id="nombre" name="nombre" required>
                            <div class="invalid-feedback">Por favor, ingresa el nombre del producto.</div>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Descripción</label>
                            <input class="form-control" type="text" id="descripcion" name="descripcion" required>
                            <div class="invalid-feedback">Por favor, ingresa la descripción.</div>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Marca</label>
                            <select class="form-select" name="idMarca" required>
                                <option value="">Selecciona una marca</option>
                                <option value="6">Sin Marca</option>
                                <option value="1">Bandai</option>
                                <option value="2">Xbox</option>
                                <option value="3">PlayStation</option>
                                <option value="4">Nintendo</option>
                                <option value="5">Otros</option>
                            </select>
                            <div class="invalid-feedback">Por favor, selecciona la marca.</div>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Estado del Producto</label>
                            <select class="form-select" name="idEstadoProducto" required>
                                <option value="">Selecciona un estado</option>
                                <option value="1">Nuevo</option>
                                <option value="2">Usado</option>
                                <option value="3">Semi Nuevo</option>
                                <option value="4">Maltratado</option>
                                <option value="5">Restaurado</option>
                            </select>
                            <div class="invalid-feedback">Por favor, selecciona el estado.</div>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Categoría</label>
                            <select class="form-select" name="idCategoria" required>
                                <option value="">Selecciona una categoría</option>
                                <?php foreach ($categorias as $categoria): ?>
                                    <option value="<?php echo htmlspecialchars($categoria['idCategoria']); ?>">
                                        <?php echo htmlspecialchars($categoria['nombre']); ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                            <div class="invalid-feedback">Por favor, selecciona la categoría.</div>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Año</label>
                            <input class="form-control" type="number" name="anio" required>
                            <div class="invalid-feedback">Por favor, ingresa el año.</div>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Cantidad</label>
                            <input class="form-control" type="number" name="cantidad" min="0" max="100" step="1" required>
                            <div class="invalid-feedback">Por favor, ingresa la cantidad.</div>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Precio</label>
                            <div class="input-group mb-3">
                                    <span class="input-group-text">$</span>
                                    <input class="form-control" type="number" step="0.01" name="precio" required>
                            </div>
                            <div class="invalid-feedback">Por favor, ingresa el precio.</div>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Valor Comercial</label>
                            <div class="input-group mb-3">
                                    <span class="input-group-text">$</span>
                                    <input class="form-control" type="number" step="0.01" name="ValorComercial" required>
                            </div>
                            <div class="invalid-feedback">Por favor, ingresa el valor comercial.</div>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Dimensiones (cm)</label>
                            <div class="d-flex gap-2">
                                <input class="form-control" type="number" step="0.01" name="largo" placeholder="Largo"
                                    required>
                                <input class="form-control" type="number" step="0.01" name="ancho" placeholder="Ancho"
                                    required>
                                <input class="form-control" type="number" step="0.01" name="alto" placeholder="Alto"
                                    required>
                                <div class="invalid-feedback">Por favor, ingresa las dimensiones.</div>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Peso (kg)</label>
                            <input class="form-control" type="number" step="0.01" name="peso" required>
                            <div class="invalid-feedback">Por favor, ingresa el peso.</div>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Cambiar portada</label>
                            <input class="form-control" type="text" id="urlEditar" name="urlPortadaImg">
                            <div class="contenedorFileImg">
                                <div class="input-div">
                                    <input class="input" name="urlPortadaImgNuevo" type="file" id="fileEditar">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" stroke-linejoin="round" stroke-linecap="round" viewBox="0 0 24 24" stroke-width="2" fill="none" stroke="currentColor" class="icon"><polyline points="16 16 12 12 8 16"></polyline><line y2="21" x2="12" y1="12" x1="12"></line><path d="M20.39 18.39A5 5 0 0 0 18 9h-1.26A8 8 0 1 0 3 16.3"></path><polyline points="16 16 12 12 8 16"></polyline></svg>
                                </div>
                                <img class="imgFile" src="" alt="imagen a subir">
                            </div>
                        </div>

                        <div class="mb-3 form-check">
                            <input class="form-check-input" type="checkbox" name="borrador" value="1" id="borrador">
                            <label class="form-check-label" for="borrador">Guardar como borrador</label>
                        </div>

                        <div class="row">
                            <button class="btn btn-success col-12 col-sm-6" type="submit">Guardar cambios</button>
                            <div class="col-sm-2"></div>
                            <button class="btn btn-secondary col-12 col-sm-3" type="button" id="btncerrarEdit">Cerrar</button>
                            <div class="col-sm-1"></div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>

</div>