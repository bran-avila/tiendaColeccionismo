create database michicoleccion;
use michicoleccion;

create table usuarios(
    idUsuario int primary key auto_increment,
    nombre varchar (99),
    apellidoP varchar(99),
    apellidoM varchar(99),
    passwordUser  varchar(255),
    correo varchar(200) UNIQUE not null );

create table Roles (
    idRol int primary key auto_increment,
    nombreRol varchar(45)
);

create table permisos(
    idPermiso int primary key auto_increment,
    nombrePermiso varchar(45)
);

create table rolesPermisos (
    idRol int,
    idPermisos int,
    primary key (idRol,idPermisos),
    FOREIGN KEY (idRol) REFERENCES Roles(idRol) ON DELETE CASCADE,
    FOREIGN KEY (idPermisos) REFERENCES permisos(idPermiso) ON DELETE CASCADE
);

create table usuariosRoles (
    idUsuario int,
    idRol int,
    primary key (idUsuario,idRol),
    FOREIGN KEY (idUsuario) REFERENCES usuarios(idUsuario) ON DELETE CASCADE,
    FOREIGN KEY (idRol) REFERENCES Roles(idRol) ON DELETE CASCADE
);


create table estadoCarrito(
    idEstadoCarrito int primary key AUTO_INCREMENT,
    estadoCarrito VARCHAR(45)
);

create table carritos(
    idCarrito int primary key auto_increment,
    idEstadoCarrito int,
    fechaCreacion date,
    duracion_reserva int,
    FOREIGN KEY (idEstadoCarrito) REFERENCES estadoCarrito(idEstadoCarrito) ON DELETE CASCADE
);


create table EstadoReservado(
    idEstadoReservado int primary key AUTO_INCREMENT,
    estado VARCHAR(45)
);


create table EstadoProducto(
    idEstadoProducto int primary key AUTO_INCREMENT,
    estado varchar(45)
);

create table marcas(
    idMarca int primary key AUTO_INCREMENT,
    marca varchar(45)
);
create table Categorias(
    idCategoria int primary key AUTO_INCREMENT,
    nombre varchar(99)
);

create table productos(
    idProducto int primary key AUTO_INCREMENT,
    idMarca int,
    idEstadoProducto INT,
    idCategoria INT,
    nombre varchar(200) UNIQUE,
    descripcion varchar(400),
    borrador TINYINT(1),
    largo FLOAT,
    ancho FLOAT,
    alto FLOAT,
    anio int,
    precio decimal(10,2),
    ValorComercial DECIMAL(10,2),
    urlPortadaImg varchar(200),
    peso FLOAT,
    FOREIGN KEY (idEstadoProducto) REFERENCES EstadoProducto(idEstadoProducto) ON DELETE CASCADE,
    FOREIGN KEY (idCategoria) REFERENCES Categorias(idCategoria) ON DELETE CASCADE,
    FOREIGN KEY (idMarca) REFERENCES marcas(idMarca) ON DELETE CASCADE
);

ALTER TABLE productos
ADD COLUMN cantidad INT NOT NULL DEFAULT 0,
ADD COLUMN fecha DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP;

create table detalleCarritos(
    idCarrito int,
    idProducto int,
    idEstadoReservado int,
    precio DECIMAL(10,2),
    cantidad int,
    primary key(idCarrito,idProducto,idEstadoReservado),
    FOREIGN KEY (idCarrito) REFERENCES carritos(idCarrito) ON DELETE CASCADE,
    FOREIGN KEY (idProducto) REFERENCES productos(idProducto) ON DELETE CASCADE,
    FOREIGN KEY (idEstadoReservado) REFERENCES estadoReservado(idEstadoReservado) ON DELETE CASCADE
);

create table inventario(
    idInventario int primary key AUTO_INCREMENT,
    idProducto int,
    cantidadDisponible int UNSIGNED ,
    cantidadReservado Int UNSIGNED ,
    fechaUltimaAct date,
    FOREIGN KEY (idProducto) REFERENCES Productos(idProducto) ON DELETE CASCADE
);

create table vistasProductos(
    idVistasProducto int primary key AUTO_INCREMENT,
    idProducto int,
    fechaHora DATETIME,
    cantidad int,
    FOREIGN KEY (idProducto) REFERENCES Productos(idProducto) ON DELETE CASCADE
);

create table galerias(
    idGaleria int primary key AUTO_INCREMENT,
    idReferencia int,
    url varchar(255),
    GaleriaColeccion varchar(300),
    fechaCreacion datetime,
    prioridad int 
);

create table banner(
    idBanner int primary key AUTO_INCREMENT,
    idGaleria int,
    urlbanner varchar(45),
    FOREIGN KEY (idGaleria) REFERENCES Galerias(idGaleria) ON DELETE CASCADE
);

create table slider(
    idSlider int primary key AUTO_INCREMENT,
    idGaleria int,
    imagenAnimacion varchar(100),
    titulo varchar(45),
    tituloAnimacion varchar(45),
    btnTexto varchar(45),
    btnAnimacion varchar(45),
    btnUrl varchar(45),
    FOREIGN KEY (idGaleria) REFERENCES Galerias(idGaleria) ON DELETE CASCADE
);

create table imagenesCategoriaInicio(
    idImagenesCategoriaInicio int primary key AUTO_INCREMENT,
    idCategoria int,
    idGaleria int,
    urlImg varchar(150),
    FOREIGN KEY (idGaleria) REFERENCES Galerias(idGaleria) ON DELETE CASCADE,
    FOREIGN KEY (idCategoria) REFERENCES categorias(idCategoria) ON DELETE CASCADE
);




create table direcciones(
    idDireccion int primary key AUTO_INCREMENT,
    nombre varchar(45),
    apellidoP varchar(45),
    apellidoM varchar(45),
    numExterior varchar(20),
    numInterior varchar(20),
    calle varchar(100),
    colonia varchar(100),
    cp int,
    telefono varchar(45),
    ciudad varchar(99),
    estado varchar(99)
);

create table direccionesUsuarios(
    idDireccionesUsuario int primary key AUTO_INCREMENT,
    idUsuario int,
    idDireccion int,
    FOREIGN KEY (idUsuario) REFERENCES usuarios(idUsuario) ON DELETE CASCADE,
    FOREIGN KEY (idDireccion) REFERENCES direcciones(idDireccion) ON DELETE CASCADE
);

create table metodoEnvio(
    idMetodoEnvio int primary key AUTO_INCREMENT,
    tipoEnvio varchar(45),
    precio decimal(10,2)
);

create table estatusVenta(
    idEstatusventa int primary key AUTO_INCREMENT,
    estado varchar (45)
);

create table estadoPago(
    idEstadoPago int primary key AUTO_INCREMENT,
    estado varchar (45)
);

create table tipoPagos(
    idTipoPago int primary key AUTO_INCREMENT,
    idEstadoPago int,
    idTransaccion varchar(99),
    cantidad decimal(10,2),
    fechaPago date,
    FOREIGN KEY (idEstadoPago) REFERENCES estadoPago(idEstadoPago) ON DELETE CASCADE
);




create table pedidos(
    idPedido int primary key AUTO_INCREMENT,
    idUsuario int,
    idDireccionesUsuario int,
    idMetodoEnvio int,
    idEstatusVenta int,
    idTipoPago int,
    totalBruto decimal(10,2),
    totalNeto decimal(10,2),
    fecha datetime,
    pesoTotal float,
     FOREIGN KEY (idUsuario) REFERENCES usuarios(idUsuario) ON DELETE CASCADE,
     FOREIGN KEY (idDireccionesUsuario) REFERENCES direccionesUsuarios(idDireccionesUsuario) ON DELETE CASCADE,
     FOREIGN KEY (idMetodoEnvio) REFERENCES metodoEnvio(idMetodoEnvio) ON DELETE CASCADE,
     FOREIGN KEY (idEstatusVenta) REFERENCES estatusVenta(idEstatusVenta) ON DELETE CASCADE,
     FOREIGN KEY (idTipoPago) REFERENCES tipoPagos(idTipoPago) ON DELETE CASCADE
);

create table detalleEnvio(
    idDetalleEnvio int primary key AUTO_INCREMENT,
    idPedido int,
    precioGuia decimal (10,2),
    numeroGuia varchar(200),
    paqueteria varchar(200),
    FOREIGN KEY (idPedido) REFERENCES pedidos(idPedido) ON DELETE CASCADE
);

create table paginasEstatica(
    idPaginasEstatica int primary key AUTO_INCREMENT,
    idUsuario int,
    titulo varchar(100),
    contenido TEXT,
    linkPagina varchar(200),
    paginaEstaticaColeccion varchar(45),
    fechaCreacion date,
    FOREIGN KEY (idUsuario) REFERENCES usuarios(idUsuario) ON DELETE CASCADE
);

-- Índices para mejorar búsquedas en tablas clave
CREATE INDEX idx_usuario_correo ON usuarios(correo);
CREATE INDEX idx_usuario_nombre ON usuarios(nombre);
CREATE INDEX idx_usuario_apellidos ON usuarios(apellidoP, apellidoM);

CREATE INDEX idx_roles_nombre ON Roles(nombreRol);
CREATE INDEX idx_permisos_nombre ON permisos(nombrePermiso);

CREATE INDEX idx_estado_carrito ON estadoCarrito(estadoCarrito);
CREATE INDEX idx_estado_producto ON EstadoProducto(estado);
CREATE INDEX idx_estado_reservado ON EstadoReservado(estado);

CREATE INDEX idx_marcas_nombre ON marcas(marca);
CREATE INDEX idx_categorias_nombre ON Categorias(nombre);

-- Índices para optimizar búsqueda y orden en productos
CREATE INDEX idx_productos_nombre ON productos(nombre);
CREATE INDEX idx_productos_categoria ON productos(idCategoria);
CREATE INDEX idx_productos_marca ON productos(idMarca);
CREATE INDEX idx_productos_estado ON productos(idEstadoProducto);

-- Índices en carritos para mejorar rendimiento de consultas de compras
CREATE INDEX idx_carritos_estado ON carritos(idEstadoCarrito);
CREATE INDEX idx_carritos_fecha ON carritos(fechaCreacion);

CREATE INDEX idx_detalle_carritos_producto ON detalleCarritos(idProducto);
CREATE INDEX idx_detalle_carritos_carrito ON detalleCarritos(idCarrito);

-- Índices en inventario
CREATE INDEX idx_inventario_producto ON inventario(idProducto);

-- Índices para optimizar estadísticas de visitas
CREATE INDEX idx_vistas_productos_fecha ON vistasProductos(fechaHora);
CREATE INDEX idx_vistas_productos_producto ON vistasProductos(idProducto);

-- Índices para optimizar consultas de direcciones y usuarios
CREATE INDEX idx_direcciones_cp ON direcciones(cp);
CREATE INDEX idx_direcciones_ciudad ON direcciones(ciudad);
CREATE INDEX idx_direcciones_estado ON direcciones(estado);

-- Índices en métodos de envío y pagos
CREATE INDEX idx_metodo_envio_tipo ON metodoEnvio(tipoEnvio);
CREATE INDEX idx_tipo_pagos_estado ON tipoPagos(idEstadoPago);

-- Índices en pedidos para mejorar consultas por usuario y fecha
CREATE INDEX idx_pedidos_usuario ON pedidos(idUsuario);
CREATE INDEX idx_pedidos_fecha ON pedidos(fecha);
CREATE INDEX idx_pedidos_estatus ON pedidos(idEstatusVenta);

-- Índices en detalle de envíos
CREATE INDEX idx_detalle_envio_pedido ON detalleEnvio(idPedido);
CREATE INDEX idx_detalle_envio_paqueteria ON detalleEnvio(paqueteria);

-- Índices en páginas estáticas para búsquedas rápidas
CREATE INDEX idx_paginas_estaticas_titulo ON paginasEstatica(titulo);
CREATE INDEX idx_paginas_estaticas_usuario ON paginasEstatica(idUsuario);