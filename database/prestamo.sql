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
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
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
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
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
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
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
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
)ENGINE = InnoDb;

INSERT INTO estados_hardware (estado_hardware, color_estado_hardware)
VALUES('Activo', 'rgba(0, 244, 0, 0.5)');
INSERT INTO estados_hardware (estado_hardware, color_estado_hardware)
VALUES('Inactivo', 'rgba(244, 0, 0, 0.5)');



CREATE TABLE IF NOT EXISTS hardwares
(
    id_hardware INT AUTO_INCREMENT PRIMARY KEY NOT NULL,
    id_tipo_hardware INT NOT NULL,
    id_marca INT NOT NULL,
    descripcion_hardware VARCHAR(1024),
    modelo VARCHAR(40) NOT NULL,
    numero_serie VARCHAR(40) NOT NULL UNIQUE,
    codigo_interno VARCHAR(40),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (id_tipo_hardware) REFERENCES tipos_hardware (id_tipo_hardware),
    FOREIGN KEY (id_marca) REFERENCES marcas (id_marca)
)ENGINE = InnoDb;


INSERT INTO hardwares (id_tipo_hardware, id_marca, descripcion_hardware, modelo, numero_serie, codigo_interno)
VALUES('5', '2', 'Ninguna', 'Modelo#', '0000-0001', 'INT-0000-0001' );
INSERT INTO hardwares (id_tipo_hardware, id_marca, descripcion_hardware, modelo, numero_serie, codigo_interno)
VALUES('8', '6', 'Ninguna', 'Modelo#', '0000-0002', 'INT-0000-0002' );
INSERT INTO hardwares (id_tipo_hardware, id_marca, descripcion_hardware, modelo, numero_serie, codigo_interno)
VALUES('3', '4', 'Ninguna', 'Modelo#', '0000-0003', 'INT-0000-0003' );
INSERT INTO hardwares (id_tipo_hardware, id_marca, descripcion_hardware, modelo, numero_serie, codigo_interno)
VALUES('5', '2', 'Ninguna', 'Modelo#', '0000-0004', 'INT-0000-0004' );
INSERT INTO hardwares (id_tipo_hardware, id_marca, descripcion_hardware, modelo, numero_serie, codigo_interno)
VALUES('5', '2', 'Ninguna', 'Modelo#', '0000-0006', 'INT-0000-0005' );
INSERT INTO hardwares (id_tipo_hardware, id_marca, descripcion_hardware, modelo, numero_serie, codigo_interno)
VALUES('8', '5', 'Ninguna', 'Modelo#', '0000-0005', 'INT-0000-0006' );
INSERT INTO hardwares (id_tipo_hardware, id_marca, descripcion_hardware, modelo, numero_serie, codigo_interno)
VALUES('5', '2', 'Ninguna', 'Modelo#', '0000-0007', NULL );
INSERT INTO hardwares (id_tipo_hardware, id_marca, descripcion_hardware, modelo, numero_serie, codigo_interno)
VALUES('5', '2', 'Ninguna', 'Modelo#', '0000-0010', 'INT-0000-0007' );
INSERT INTO hardwares (id_tipo_hardware, id_marca, descripcion_hardware, modelo, numero_serie, codigo_interno)
VALUES('5', '2', 'Ninguna', 'Modelo#', '0000-0011', 'INT-0000-0008' );
INSERT INTO hardwares (id_tipo_hardware, id_marca, descripcion_hardware, modelo, numero_serie, codigo_interno)
VALUES('8', '5', 'Ninguna', 'Modelo#', '0000-0013', NULL );
INSERT INTO hardwares (id_tipo_hardware, id_marca, descripcion_hardware, modelo, numero_serie, codigo_interno)
VALUES('5', '2', 'Ninguna', 'Modelo#', '0000-0012', NULL );
INSERT INTO hardwares (id_tipo_hardware, id_marca, descripcion_hardware, modelo, numero_serie, codigo_interno)
VALUES('5', '2', 'Ninguna', 'Modelo#', '0000-0009', NULL );
INSERT INTO hardwares (id_tipo_hardware, id_marca, descripcion_hardware, modelo, numero_serie, codigo_interno)
VALUES('5', '2', 'Ninguna', 'Modelo#', '0000-0014', NULL );
INSERT INTO hardwares (id_tipo_hardware, id_marca, descripcion_hardware, modelo, numero_serie, codigo_interno)
VALUES('5', '2', 'Ninguna', 'Modelo#', '0000-0016', NULL );
INSERT INTO hardwares (id_tipo_hardware, id_marca, descripcion_hardware, modelo, numero_serie, codigo_interno)
VALUES('3', '4', 'Ninguna', 'Modelo#', '0000-0017', NULL );
INSERT INTO hardwares (id_tipo_hardware, id_marca, descripcion_hardware, modelo, numero_serie, codigo_interno)
VALUES('1', '1', 'Ninguna', 'Modelo#', '0000-0015', NULL );
INSERT INTO hardwares (id_tipo_hardware, id_marca, descripcion_hardware, modelo, numero_serie, codigo_interno)
VALUES('5', '2', 'Ninguna', 'Modelo#', '0000-0018', NULL );
INSERT INTO hardwares (id_tipo_hardware, id_marca, descripcion_hardware, modelo, numero_serie, codigo_interno)
VALUES('5', '2', 'Ninguna', 'Modelo#', '0000-0019', NULL );
INSERT INTO hardwares (id_tipo_hardware, id_marca, descripcion_hardware, modelo, numero_serie, codigo_interno)
VALUES('5', '2', 'Ninguna', 'Modelo#', '0000-0020', NULL );
INSERT INTO hardwares (id_tipo_hardware, id_marca, descripcion_hardware, modelo, numero_serie, codigo_interno)
VALUES('5', '2', 'Ninguna', 'Modelo#', '0000-0021', 'INT-0000-0020' );


CREATE TABLE IF NOT EXISTS hardwares_estados_hardware
(
    id_hardware_estado_hardware INT AUTO_INCREMENT PRIMARY KEY NOT NULL,
    id_hardware INT NOT NULL,
    id_estado_hardware INT NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (id_hardware) REFERENCES hardwares (id_hardware),
    FOREIGN KEY (id_estado_hardware) REFERENCES estados_hardware (id_estado_hardware)
)ENGINE = InnoDb;


INSERT INTO hardwares_estados_hardware (id_hardware, id_estado_hardware)
VALUES(1,1);
INSERT INTO hardwares_estados_hardware (id_hardware, id_estado_hardware)
VALUES(2,1);
INSERT INTO hardwares_estados_hardware (id_hardware, id_estado_hardware)
VALUES(3,1);
INSERT INTO hardwares_estados_hardware (id_hardware, id_estado_hardware)
VALUES(4,1);
INSERT INTO hardwares_estados_hardware (id_hardware, id_estado_hardware)
VALUES(5,1);
INSERT INTO hardwares_estados_hardware (id_hardware, id_estado_hardware)
VALUES(6,1);
INSERT INTO hardwares_estados_hardware (id_hardware, id_estado_hardware)
VALUES(7,1);
INSERT INTO hardwares_estados_hardware (id_hardware, id_estado_hardware)
VALUES(8,1);
INSERT INTO hardwares_estados_hardware (id_hardware, id_estado_hardware)
VALUES(9,1);
INSERT INTO hardwares_estados_hardware (id_hardware, id_estado_hardware)
VALUES(10,1);
INSERT INTO hardwares_estados_hardware (id_hardware, id_estado_hardware)
VALUES(11,1);
INSERT INTO hardwares_estados_hardware (id_hardware, id_estado_hardware)
VALUES(12,1);
INSERT INTO hardwares_estados_hardware (id_hardware, id_estado_hardware)
VALUES(13,1);
INSERT INTO hardwares_estados_hardware (id_hardware, id_estado_hardware)
VALUES(14,1);
INSERT INTO hardwares_estados_hardware (id_hardware, id_estado_hardware)
VALUES(15,1);
INSERT INTO hardwares_estados_hardware (id_hardware, id_estado_hardware)
VALUES(16,1);
INSERT INTO hardwares_estados_hardware (id_hardware, id_estado_hardware)
VALUES(17,1);
INSERT INTO hardwares_estados_hardware (id_hardware, id_estado_hardware)
VALUES(18,1);
INSERT INTO hardwares_estados_hardware (id_hardware, id_estado_hardware)
VALUES(19,1);
INSERT INTO hardwares_estados_hardware (id_hardware, id_estado_hardware)
VALUES(20,1);


-- ESTADO 2
/*
INSERT INTO hardwares_estados_hardware (id_hardware, id_estado_hardware)
VALUES(1,2);
INSERT INTO hardwares_estados_hardware (id_hardware, id_estado_hardware)
VALUES(3,2);
INSERT INTO hardwares_estados_hardware (id_hardware, id_estado_hardware)
VALUES(5,2);
INSERT INTO hardwares_estados_hardware (id_hardware, id_estado_hardware)
VALUES(6,2);
INSERT INTO hardwares_estados_hardware (id_hardware, id_estado_hardware)
VALUES(7,2);
INSERT INTO hardwares_estados_hardware (id_hardware, id_estado_hardware)
VALUES(9,2);
*/



CREATE TABLE IF NOT EXISTS edificios
( 
    id_edificio INT AUTO_INCREMENT PRIMARY KEY NOT NULL, 
    edificio VARCHAR(60) NOT NULL UNIQUE,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
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
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE = InnoDb;


INSERT INTO estados_solicitud (estado_solicitud, color_estado_solicitud)
VALUES('Aprobada', 'rgba(0, 244, 0, 0.5)');
INSERT INTO estados_solicitud (estado_solicitud, color_estado_solicitud)
VALUES('Desaprobada', 'rgba(244, 0, 0, 0.5)');
INSERT INTO estados_solicitud (estado_solicitud, color_estado_solicitud)
VALUES('Pendiente', 'rgba(244, 244, 0, 0.5)');



CREATE TABLE IF NOT EXISTS solicitudes
( 
    id_solicitud INT AUTO_INCREMENT PRIMARY KEY NOT NULL, 
    id_tipo_hardware INT NOT NULL,
    id_usuario INT NOT NULL,
    id_edificio INT NOT NULL ,
    fecha_desde DATE NOT NULL,
    fecha_hasta DATE NOT NULL,
    motivo_solicitud VARCHAR(1024) NOT NULL,
    motivo_aprobacion VARCHAR(1024),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (id_tipo_hardware) REFERENCES tipos_hardware(id_tipo_hardware),
    FOREIGN KEY (id_usuario) REFERENCES usuarios(id_usuario),
    FOREIGN KEY (id_edificio) REFERENCES edificios(id_edificio)
) ENGINE = InnoDb;


INSERT INTO solicitudes (id_tipo_hardware, id_usuario, id_edificio, fecha_desde, fecha_hasta, motivo_solicitud)
VALUES(1, 2, 1, '2020-12-31', '2021-01-31', 'Motivo Solicitud: Necesidad' );
INSERT INTO solicitudes (id_tipo_hardware, id_usuario, id_edificio, fecha_desde, fecha_hasta, motivo_solicitud)
VALUES(2, 2, 3, '2020-12-01', '2021-02-15', 'Motivo Solicitud: Necesidad para fines de enero' );
INSERT INTO solicitudes (id_tipo_hardware, id_usuario, id_edificio, fecha_desde, fecha_hasta, motivo_solicitud)
VALUES(3, 2, 1, '2020-12-30', '2021-01-28', 'Motivo Solicitud: Necesidad Urgente' );
INSERT INTO solicitudes (id_tipo_hardware, id_usuario, id_edificio, fecha_desde, fecha_hasta, motivo_solicitud)
VALUES(4, 2, 1, '2021-02-02', '2021-02-28', 'Motivo Solicitud: Necesidad ---' );
INSERT INTO solicitudes (id_tipo_hardware, id_usuario, id_edificio, fecha_desde, fecha_hasta, motivo_solicitud)
VALUES(1, 2, 2, '2021-01-12', '2021-07-31', 'Motivo Solicitud: No se' );
INSERT INTO solicitudes (id_tipo_hardware, id_usuario, id_edificio, fecha_desde, fecha_hasta, motivo_solicitud)
VALUES(1, 2, 2, '2021-01-12', '2021-09-30', 'Motivo Solicitud: Para usarlo' );
INSERT INTO solicitudes (id_tipo_hardware, id_usuario, id_edificio, fecha_desde, fecha_hasta, motivo_solicitud)
VALUES(5, 2, 1, '2021-01-26', '2022-01-25', 'Motivo Solicitud: Capricho' );
INSERT INTO solicitudes (id_tipo_hardware, id_usuario, id_edificio, fecha_desde, fecha_hasta, motivo_solicitud)
VALUES(6, 2, 3, '2021-01-12', '2023-01-12', 'Motivo Solicitud: Paar Trabajar' );
INSERT INTO solicitudes (id_tipo_hardware, id_usuario, id_edificio, fecha_desde, fecha_hasta, motivo_solicitud)
VALUES(2, 2, 1, '2021-01-15', '2021-06-25', 'Motivo Solicitud: Ahora' );
INSERT INTO solicitudes (id_tipo_hardware, id_usuario, id_edificio, fecha_desde, fecha_hasta, motivo_solicitud)
VALUES(3, 2, 1, '2021-01-17', '2021-05-05', 'Motivo Solicitud: Motivo?' );


CREATE TABLE IF NOT EXISTS solcitudes_estados_solicitud
(
    id_solicitud_estado_solicitud INT AUTO_INCREMENT PRIMARY KEY NOT NULL,
    id_solicitud INT NOT NULL,
    id_estado_solicitud INT NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (id_solicitud) REFERENCES solicitudes (id_solicitud),
    FOREIGN KEY (id_estado_solicitud) REFERENCES estados_solicitud (id_estado_solicitud)
)ENGINE = InnoDb;


INSERT INTO solcitudes_estados_solicitud (id_solicitud, id_estado_solicitud)
VALUES(1,3);
INSERT INTO solcitudes_estados_solicitud (id_solicitud, id_estado_solicitud)
VALUES(2,3);
INSERT INTO solcitudes_estados_solicitud (id_solicitud, id_estado_solicitud)
VALUES(3,3);
INSERT INTO solcitudes_estados_solicitud (id_solicitud, id_estado_solicitud)
VALUES(5,3);
INSERT INTO solcitudes_estados_solicitud (id_solicitud, id_estado_solicitud)
VALUES(6,3);
INSERT INTO solcitudes_estados_solicitud (id_solicitud, id_estado_solicitud)
VALUES(7,3);
INSERT INTO solcitudes_estados_solicitud (id_solicitud, id_estado_solicitud)
VALUES(8,3);
INSERT INTO solcitudes_estados_solicitud (id_solicitud, id_estado_solicitud)
VALUES(9,3);
INSERT INTO solcitudes_estados_solicitud (id_solicitud, id_estado_solicitud)
VALUES(10,3);
INSERT INTO solcitudes_estados_solicitud (id_solicitud, id_estado_solicitud)
VALUES(5,1);
INSERT INTO solcitudes_estados_solicitud (id_solicitud, id_estado_solicitud)
VALUES(6,1);
INSERT INTO solcitudes_estados_solicitud (id_solicitud, id_estado_solicitud)
VALUES(7,2);



CREATE TABLE IF NOT EXISTS estados_prestamo
( 
    id_estado_prestamo INT AUTO_INCREMENT PRIMARY KEY NOT NULL, 
    estado_prestamo VARCHAR(40) NOT NULL UNIQUE,
    color_estado_prestamo VARCHAR(40) NOT NULL, 
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE = InnoDb;


INSERT INTO estados_prestamo (estado_prestamo, color_estado_prestamo)
VALUES('No entregado', 'rgba(244, 0, 0, 0.5)');
INSERT INTO estados_prestamo (estado_prestamo, color_estado_prestamo)
VALUES('Entregado', 'rgba(0, 244, 0, 0.5)');
INSERT INTO estados_prestamo (estado_prestamo, color_estado_prestamo)
VALUES('Recibido', 'rgba(0, 244, 0, 0.5)');
INSERT INTO estados_prestamo (estado_prestamo, color_estado_prestamo)
VALUES('No Recibido', 'rgba(244, 0, 0, 0.5)');
INSERT INTO estados_prestamo (estado_prestamo, color_estado_prestamo)
VALUES('Recibido, con problemas', 'rgba(244, 244, 0, 0.5)');



CREATE TABLE IF NOT EXISTS prestamos
( 
    id_prestamo INT AUTO_INCREMENT PRIMARY KEY NOT NULL, 
    id_solicitud INT NOT NULL,
    id_hardware INT NOT NULL,
    observacion_devolucion VARCHAR(1024),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (id_solicitud) REFERENCES solicitudes(id_solicitud),
    FOREIGN KEY (id_hardware) REFERENCES hardwares(id_hardware)
) ENGINE = InnoDb;


CREATE TABLE IF NOT EXISTS prestamos_estados_prestamo
(
    id_prestamo_estado_prestamo INT AUTO_INCREMENT PRIMARY KEY NOT NULL,
    id_prestamo INT NOT NULL,
    id_estado_prestamo INT NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (id_prestamo) REFERENCES prestamos (id_prestamo),
    FOREIGN KEY (id_estado_prestamo) REFERENCES estados_prestamo (id_estado_prestamo)
)ENGINE = InnoDb;


