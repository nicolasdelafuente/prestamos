CREATE DATABASE IF NOT EXISTS prestamos;


CREATE TABLE IF NOT EXISTS roles_usuario
( 
    id_rol_usuario INT AUTO_INCREMENT PRIMARY KEY NOT NULL, 
    rol_usuario VARCHAR(40) NOT NULL UNIQUE,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE = InnoDb;


INSERT INTO roles_usuario(rol_usuario)
VALUES('Administrador');
INSERT INTO roles_usuario(rol_usuario)
VALUES('Usuario');



CREATE TABLE IF NOT EXISTS usuarios
( 
    id_usuario INT AUTO_INCREMENT PRIMARY KEY NOT NULL, 
    nombre VARCHAR(60) NOT NULL, 
    apellido VARCHAR(60) NOT NULL, 
    email VARCHAR(60) NOT NULL UNIQUE,
    password VARCHAR(20) NOT NULL,
    id_rol_usuario INT NOT NULL,
    created_at_usuario TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at_usuario TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (id_rol_usuario) REFERENCES roles_usuario(id_rol_usuario)
) ENGINE = InnoDb;


INSERT INTO usuarios (nombre, apellido, email, password, id_rol_usuario )
VALUES('Nombre1', 'ApellidoUno', 'persona.uno@gmail.com', '1234', 1);
INSERT INTO usuarios (nombre, apellido, email, password, id_rol_usuario)
VALUES('Nombre2', 'ApellidoDos', 'persona.dos@gmail.com', '1234', 2);




CREATE TABLE IF NOT EXISTS tipos_hardware
(
    id_tipo_hardware INT AUTO_INCREMENT PRIMARY KEY NOT NULL,
    tipo_hardware VARCHAR(40) NOT NULL UNIQUE,
    created_at_tipo TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at_tipo TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
)ENGINE = InnoDb;


INSERT INTO tipos_hardware (tipo_hardware)
VALUES('CPU');
INSERT INTO tipos_hardware (tipo_hardware)
VALUES('Impresora');
INSERT INTO tipos_hardware (tipo_hardware)
VALUES('Monitor');
INSERT INTO tipos_hardware (tipo_hardware)
VALUES('Mouse');
INSERT INTO tipos_hardware (tipo_hardware)
VALUES('Notebook');
INSERT INTO tipos_hardware (tipo_hardware)
VALUES('Proyector');
INSERT INTO tipos_hardware (tipo_hardware)
VALUES('Tablet');
INSERT INTO tipos_hardware (tipo_hardware)
VALUES('Teclado');



CREATE TABLE IF NOT EXISTS marcas
(
    id_marca INT AUTO_INCREMENT PRIMARY KEY NOT NULL,
    marca VARCHAR(40) NOT NULL UNIQUE,
    created_at_marca TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at_marca TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
)ENGINE = InnoDb;


INSERT INTO marcas (marca)
VALUES('Acer');
INSERT INTO marcas (marca)
VALUES('Asus');
INSERT INTO marcas (marca)
VALUES('Genius');
INSERT INTO marcas (marca)
VALUES('Dell');
INSERT INTO marcas (marca)
VALUES('Logitech');
INSERT INTO marcas (Marca)
VALUES('Microsoft');



CREATE TABLE IF NOT EXISTS estados_hardware
(
    id_estado_hardware INT AUTO_INCREMENT PRIMARY KEY NOT NULL,
    estado_hardware VARCHAR(40) NOT NULL UNIQUE,
    color_estado_hardware VARCHAR(40) NOT NULL UNIQUE,
    created_at_estado_h TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at_estado_h TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
)ENGINE = InnoDb;


INSERT INTO estados_hardware (estado_hardware, color_estado_hardware)
VALUES('Disponible', 'rgba(0, 244, 0, 0.5)');
INSERT INTO estados_hardware (estado_hardware, color_estado_hardware)
VALUES('No disponible', 'rgba(244, 0, 0, 0.5)');
INSERT INTO estados_hardware (estado_hardware, color_estado_hardware)
VALUES('En Reparación', 'rgba(244, 244, 0, 0.5)');



CREATE TABLE IF NOT EXISTS hardwares
(
    id_hardware INT AUTO_INCREMENT PRIMARY KEY NOT NULL,
    id_tipo INT NOT NULL,
    id_marca INT NOT NULL,
    id_estado_hardware INT NOT NULL,
    descripcion VARCHAR(600),
    modelo VARCHAR(40) NOT NULL,
    numero_serie VARCHAR(40) NOT NULL UNIQUE,
    numero_unahur VARCHAR(40) UNIQUE,
    created_at_hardware TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at_hardware TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (id_tipo) REFERENCES Tipos_hardware (id_tipo_hardware),
    FOREIGN KEY (id_marca) REFERENCES Marcas (id_marca),
    FOREIGN KEY (id_estado_hardware) REFERENCES Estados_hardware (id_estado_hardware)
)ENGINE = InnoDb;


INSERT INTO hardwares (id_tipo, id_marca, id_estado_hardware, descripcion, modelo, numero_serie, numero_unahur)
VALUES('5', '2', '1', 'Ninguna', 'Modelo#', '0000-0001', 'UNAH-0000-0001' );
INSERT INTO hardwares (id_tipo, id_marca, id_estado_hardware, descripcion, modelo, numero_serie, numero_unahur)
VALUES('8', '6', '1', 'Ninguna', 'Modelo#', '0000-0002', 'UNAH-0000-0002' );
INSERT INTO hardwares (id_tipo, id_marca, id_estado_hardware, descripcion, modelo, numero_serie, numero_unahur)
VALUES('3', '4', '1', 'Ninguna', 'Modelo#', '0000-0003', 'UNAH-0000-0003' );
INSERT INTO hardwares (id_tipo, id_marca, id_estado_hardware, descripcion, modelo, numero_serie, numero_unahur)
VALUES('5', '2', '1', 'Ninguna', 'Modelo#', '0000-0004', 'UNAH-0000-0004' );
INSERT INTO hardwares (id_tipo, id_marca, id_estado_hardware, descripcion, modelo, numero_serie, numero_unahur)
VALUES('5', '2', '1', 'Ninguna', 'Modelo#', '0000-0006', 'UNAH-0000-0005' );
INSERT INTO hardwares (id_tipo, id_marca, id_estado_hardware, descripcion, modelo, numero_serie, numero_unahur)
VALUES('8', '5', '1', 'Ninguna', 'Modelo#', '0000-0005', 'UNAH-0000-0006' );
INSERT INTO hardwares (id_tipo, id_marca, id_estado_hardware, descripcion, modelo, numero_serie, numero_unahur)
VALUES('5', '2', '1', 'Ninguna', 'Modelo#', '0000-0007', NULL );
INSERT INTO hardwares (id_tipo, id_marca, id_estado_hardware, descripcion, modelo, numero_serie, numero_unahur)
VALUES('5', '2', '1', 'Ninguna', 'Modelo#', '0000-0010', 'UNAH-0000-0007' );
INSERT INTO hardwares (id_tipo, id_marca, id_estado_hardware, descripcion, modelo, numero_serie, numero_unahur)
VALUES('5', '2', '1', 'Ninguna', 'Modelo#', '0000-0011', 'UNAH-0000-0008' );
INSERT INTO hardwares (id_tipo, id_marca, id_estado_hardware, descripcion, modelo, numero_serie, numero_unahur)
VALUES('8', '5', '1', 'Ninguna', 'Modelo#', '0000-0013', NULL );
INSERT INTO hardwares (id_tipo, id_marca, id_estado_hardware, descripcion, modelo, numero_serie, numero_unahur)
VALUES('5', '2', '1', 'Ninguna', 'Modelo#', '0000-0012', NULL );
INSERT INTO hardwares (id_tipo, id_marca, id_estado_hardware, descripcion, modelo, numero_serie, numero_unahur)
VALUES('5', '2', '1', 'Ninguna', 'Modelo#', '0000-0009', NULL );
INSERT INTO hardwares (id_tipo, id_marca, id_estado_hardware, descripcion, modelo, numero_serie, numero_unahur)
VALUES('5', '2', '1', 'Ninguna', 'Modelo#', '0000-0014', NULL );
INSERT INTO hardwares (id_tipo, id_marca, id_estado_hardware, descripcion, modelo, numero_serie, numero_unahur)
VALUES('5', '2', '1', 'Ninguna', 'Modelo#', '0000-0016', NULL );
INSERT INTO hardwares (id_tipo, id_marca, id_estado_hardware, descripcion, modelo, numero_serie, numero_unahur)
VALUES('3', '4', '1', 'Ninguna', 'Modelo#', '0000-0017', NULL );
INSERT INTO hardwares (id_tipo, id_marca, id_estado_hardware, descripcion, modelo, numero_serie, numero_unahur)
VALUES('1', '1', '1', 'Ninguna', 'Modelo#', '0000-0015', NULL );
INSERT INTO hardwares (id_tipo, id_marca, id_estado_hardware, descripcion, modelo, numero_serie, numero_unahur)
VALUES('5', '2', '1', 'Ninguna', 'Modelo#', '0000-0018', NULL );
INSERT INTO hardwares (id_tipo, id_marca, id_estado_hardware, descripcion, modelo, numero_serie, numero_unahur)
VALUES('5', '2', '2', 'Ninguna', 'Modelo#', '0000-0019', NULL );
INSERT INTO hardwares (id_tipo, id_marca, id_estado_hardware, descripcion, modelo, numero_serie, numero_unahur)
VALUES('5', '2', '2', 'Ninguna', 'Modelo#', '0000-0020', NULL );
INSERT INTO hardwares (id_tipo, id_marca, id_estado_hardware, descripcion, modelo, numero_serie, numero_unahur)
VALUES('5', '2', '3', 'Ninguna', 'Modelo#', '0000-0021', 'UNAH-0000-0009' );


CREATE TABLE IF NOT EXISTS edificios
( 
    id_edificio INT AUTO_INCREMENT PRIMARY KEY NOT NULL, 
    edificio VARCHAR(40) NOT NULL UNIQUE,
    created_at_edificio TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at_edificio TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE = InnoDb;


INSERT INTO edificios (edificio)
VALUES('Edificio 1');
INSERT INTO edificios (edificio)
VALUES('Edificio 2');
INSERT INTO edificios (edificio)
VALUES('Edificio 3');



CREATE TABLE IF NOT EXISTS estados_solicitud
( 
    id_estado_solicitud INT AUTO_INCREMENT PRIMARY KEY NOT NULL, 
    estado_solicitud VARCHAR(40) NOT NULL UNIQUE,
    color_estado_solicitud VARCHAR(40) NOT NULL UNIQUE, 
    created_at_estado_s TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at_estado_s TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE = InnoDb;


INSERT INTO estados_solicitud (estado_solicitud, color_estado_solicitud)
VALUES('Aprobada', 'rgba(0, 244, 0, 0.5)');
INSERT INTO estados_solicitud (estado_solicitud, color_estado_solicitud)
VALUES('Desaprobada', 'rgba(244, 0, 0, 0.5)');
INSERT INTO estados_solicitud (estado_solicitud, color_estado_solicitud)
VALUES('Pendiente', 'rgba(150, 152, 154, 0.5)');



CREATE TABLE IF NOT EXISTS solicitudes
( 
    id_solicitud INT AUTO_INCREMENT PRIMARY KEY NOT NULL, 
    id_tipo_hardware INT NOT NULL,
    id_usuario INT NOT NULL,
    id_edificio INT NOT NULL ,
    fecha_desde DATE NOT NULL,
    fecha_hasta DATE NOT NULL,
    id_estado_solicitud INT DEFAULT 3,
    motivo_solicitud VARCHAR(1024) NOT NULL,
    motivo_aprobacion VARCHAR(1024),
    created_at_solicitud TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at_solicitud TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (id_tipo_hardware) REFERENCES tipos_hardware(id_tipo_hardware),
    FOREIGN KEY (id_usuario) REFERENCES usuarios(id_usuario),
    FOREIGN KEY (id_edificio) REFERENCES edificios(id_edificio),
    FOREIGN KEY (id_estado_solicitud) REFERENCES estados_solicitud(id_estado_solicitud)
) ENGINE = InnoDb;


INSERT INTO solicitudes (id_tipo_hardware, id_usuario, id_edificio, fecha_desde, fecha_hasta, motivo_solicitud)
VALUES(1, 2, 1, '2020-31-12', '2021-31-01', 'Motivo Solicitud: Necesidad' );
INSERT INTO solicitudes (id_tipo_hardware, id_usuario, id_edificio, fecha_desde, fecha_hasta, id_estado_solicitud, motivo_solicitud)
VALUES(2, 2, 3, '2021-31-01', '2021-02-15', 2, 'Motivo Solicitud: Necesidad para fines de enero' );
INSERT INTO solicitudes (id_tipo_hardware, id_usuario, id_edificio, fecha_desde, fecha_hasta, id_estado_solicitud, motivo_solicitud)
VALUES(3, 2, 1, '2020-31-12', '2021-31-01', 1, 'Motivo Solicitud: Necesidad Urgente' );
INSERT INTO solicitudes (id_tipo_hardware, id_usuario, id_edificio, fecha_desde, fecha_hasta, id_estado_solicitud, motivo_solicitud)
VALUES(4, 2, 1, '2020-31-12', '2021-31-01', 2, 'Motivo Solicitud: Necesidad ---' );
INSERT INTO solicitudes (id_tipo_hardware, id_usuario, id_edificio, fecha_desde, fecha_hasta, id_estado_solicitud, motivo_solicitud)
VALUES(1, 2, 2, '2020-31-12', '2021-31-01', 1, 'Motivo Solicitud: No se' );
INSERT INTO solicitudes (id_tipo_hardware, id_usuario, id_edificio, fecha_desde, fecha_hasta, motivo_solicitud)
VALUES(1, 2, 2, '2020-31-12', '2021-31-01', 'Motivo Solicitud: Para usarlo' );
INSERT INTO solicitudes (id_tipo_hardware, id_usuario, id_edificio, fecha_desde, fecha_hasta, motivo_solicitud)
VALUES(5, 2, 1, '2020-31-12', '2021-31-01', 'Motivo Solicitud: Capricho' );
INSERT INTO solicitudes (id_tipo_hardware, id_usuario, id_edificio, fecha_desde, fecha_hasta, motivo_solicitud)
VALUES(6, 2, 3, '2020-31-12', '2021-31-01', 'Motivo Solicitud: Paar Trabajar' );
INSERT INTO solicitudes (id_tipo_hardware, id_usuario, id_edificio, fecha_desde, fecha_hasta, motivo_solicitud)
VALUES(2, 2, 1, '2020-31-12', '2021-31-01', 'Motivo Solicitud: Ahora' );
INSERT INTO solicitudes (id_tipo_hardware, id_usuario, id_edificio, fecha_desde, fecha_hasta, motivo_solicitud)
VALUES(3, 2, 1, '2020-31-12', '2021-31-01', 'Motivo Solicitud: Motivo?' );


CREATE TABLE IF NOT EXISTS estados_prestamo
( 
    id_estado_prestamo INT AUTO_INCREMENT PRIMARY KEY NOT NULL, 
    estado_prestamo VARCHAR(40) NOT NULL UNIQUE,
    color_estado_prestamo VARCHAR(40) NOT NULL UNIQUE, 
    created_at_estado_p TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at_estado_p TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE = InnoDb;


INSERT INTO estados_prestamo (estado_prestamo, color_estado_prestamo)
VALUES('No entregado', 'rgba(0, 244, 0, 0.5)');
INSERT INTO estados_prestamo (estado_prestamo, color_estado_prestamo)
VALUES('Entregado', 'rgba(244, 0, 0, 0.5)');


CREATE TABLE IF NOT EXISTS prestamos
( 
    id_prestamo INT AUTO_INCREMENT PRIMARY KEY NOT NULL, 
    id_solicitud INT NOT NULL,
    id_hardware INT NOT NULL,
    id_estado_prestamo INT,
    observacion_prestamo VARCHAR(1024),
    created_at_prestamo TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at_prestamo TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (id_solicitud) REFERENCES solicitudes(id_solicitud),
    FOREIGN KEY (id_hardware) REFERENCES hardwares(id_hardware),
    FOREIGN KEY (id_estado_prestamo) REFERENCES estados_prestamo(id_estado_prestamo)
) ENGINE = InnoDb;



CREATE TABLE IF NOT EXISTS estados_devolucion
( 
    id_estado_devolucion INT AUTO_INCREMENT PRIMARY KEY NOT NULL, 
    estado_devolucion VARCHAR(40) NOT NULL UNIQUE,
    color_estado_devolucion VARCHAR(40) NOT NULL UNIQUE, 
    created_at_estado_d TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at_estado_d TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE = InnoDb;



INSERT INTO estados_devolucion (estado_devolucion, color_estado_devolucion)
VALUES('Recibida OK', 'rgba(0, 244, 0, 0.5)');
INSERT INTO estados_devolucion (estado_devolucion, color_estado_devolucion)
VALUES('Recibida con Problemas', 'rgba(244, 244, 0, 0.5)');
INSERT INTO estados_devolucion (estado_devolucion, color_estado_devolucion)
VALUES('No recibido', 'rgba(244, 0, 0, 0.5)');




CREATE TABLE IF NOT EXISTS devoluciones
( 
    id_devolucion INT AUTO_INCREMENT PRIMARY KEY NOT NULL, 
    id_prestamo INT NOT NULL,
    id_estado_devolucion INT NOT NULL,
    observacion_devolucion VARCHAR(1024),
    created_at_prestamo TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at_prestamo TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (id_prestamo) REFERENCES prestamos(id_prestamo),
    FOREIGN KEY (id_estado_devolucion) REFERENCES estados_devolucion(id_estado_devolucion)
) ENGINE = InnoDb;