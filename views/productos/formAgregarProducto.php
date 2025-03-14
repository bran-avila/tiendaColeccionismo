<div class=" menuFlotante " id="menuFlotante">
    <div id="formularioContainer" class="box" style=" margin-top: 20px;">
        <form id="formProducto">
        <h2 class="title is-4">Agregar Producto:</h2>
            <div class="field">
                <label class="label">Nombre</label>
                <div class="control">
                    <input class="input" type="text" id="nombre" name="nombre" required>
                </div>
            </div>
    
            <div class="field">
                <label class="label">Descripción</label>
                <div class="control">
                    <input class="input" type="text" id="descripcion" name="descripcion" required>
                </div>
            </div>
    
            <div class="field">
                    <label class="label">Marca</label>
                    <div class="control">
                        <div class="select">
                            <select name="idMarca">
                                <option value="6">Sin Marca</option>
                                <option value="1">Bandai</option>
                                <option value="2">Xbox</option>
                                <option value="3">PlayStation</option>
                                <option value="4">Nintendo</option>
                                <option value="5">Otros</option>
                            </select>
                        </div>
                    </div>
                </div>

                <div class="field">
                    <label class="label">Estado del Producto</label>
                    <div class="control">
                        <div class="select">
                            <select name="idEstadoProducto">
                                <option value="1">Nuevo</option>
                                <option value="2">Usado</option>
                                <option value="3">Semi Nuevo</option>
                                <option value="4">Maltratado</option>
                                <option value="5">Restaurado</option>
                            </select>
                        </div>
                    </div>
                </div>

                <div class="field">
                    <label class="label">Categoría</label>
                    <div class="control">
                        <div class="select">
                            <select name="idCategoria">
                                <option value="1">Videojuegos</option>
                                <option value="2">Libros</option>
                                <option value="3">Cartas</option>
                                <option value="4">Figuras</option>
                                <option value="5">Coleccionables</option>
                                <option value="6">Discos</option>
                                <option value="7">Heroclix</option>
                            </select>
                        </div>
                    </div>
                </div>

                <div class="field">
                    <label class="label">Año</label>
                    <div class="control">
                        <input class="input" type="number" name="anio">
                    </div>
                </div>

                <div class="field">
                    <label class="label">Precio</label>
                    <div class="control">
                        <input class="input" type="number" step="0.01" name="precio" required>
                    </div>
                </div>

                <div class="field">
                    <label class="label">Valor Comercial</label>
                    <div class="control">
                        <input class="input" type="number" step="0.01" name="ValorComercial">
                    </div>
                </div>

                <div class="field">
                    <label class="label">Dimensiones (cm)</label>
                    <div class="control">
                        <input class="input" type="number" step="0.01" name="largo" placeholder="Largo">
                        <input class="input" type="number" step="0.01" name="ancho" placeholder="Ancho">
                        <input class="input" type="number" step="0.01" name="alto" placeholder="Alto">
                    </div>
                </div>

                <div class="field">
                    <label class="label">Peso (kg)</label>
                    <div class="control">
                        <input class="input" type="number" step="0.01" name="peso">
                    </div>
                </div>

                <div class="field">
                    <label class="label">Imagen</label>
                    <div class="control">
                        <input class="input" type="text" name="urlPortadaImg">
                    </div>
                </div>

                <div class="field">
                    <label class="checkbox">
                        <input type="checkbox" name="borrador" value="1"> Guardar como borrador
                    </label>
                </div>
    
            <div class="control">
                <button class="button is-success" type="submit">Guardar Producto</button>
                <div class="button" id="btncerrar" >cerrar</div>
            </div>
        </form>
    </div>

</div>