

CREATE DATABASE IF NOT EXISTS casa_placa;

USE casa_placa;


-- ==========================================
-- TABLA USUARIOS
-- ==========================================

CREATE TABLE IF NOT EXISTS users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    email VARCHAR(100) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    phone VARCHAR(20),
    address VARCHAR(200),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    profile_image VARCHAR(255) DEFAULT 'usuario.jpg'
);

-- Usuario administrador de prueba (contraseña: 1234)
INSERT IGNORE INTO users (id, name, email, password, phone, address)
VALUES (1, 'Bryan Cerdas', 'admin@correo.com', '1234', '8888-8888', 'San José, Costa Rica');

INSERT IGNORE INTO users (id, name, email, password, phone, address)
VALUES
(2, 'Jimena Rojas',     'jimena.rojas@example.com',    '1234', '8811-2233', 'Alajuelita, San José'),
(3, 'Kimberly Vargas',  'kimberly.vargas@example.com', '1234', '8822-3344', 'Desamparados, San José'),
(4, 'Nicolás Salas',    'nicolas.salas@example.com',   '1234', '8833-4455', 'Curridabat, San José');


-- ==========================================
-- TABLA ESTADÍSTICAS DASHBOARD
-- ==========================================

CREATE TABLE IF NOT EXISTS stats (
    id INT AUTO_INCREMENT PRIMARY KEY,
    description VARCHAR(100) NOT NULL,
    value VARCHAR(50) NOT NULL
);

INSERT IGNORE INTO stats (id, description, value)
VALUES
(1, 'Pedidos realizados','25'),
(2, 'Clientes registrados','75'),
(3, 'Placas fabricadas','320'),
(4, 'Ventas del mes','$15,400'),
(5, 'Mensajes recibidos','14'),
(6, 'Reseñas pendientes','10');


-- ==========================================
-- CATEGORÍA / MATERIAL / TAMAÑO
-- ==========================================

CREATE TABLE IF NOT EXISTS categoria (
    id          INT AUTO_INCREMENT PRIMARY KEY,
    nombre      VARCHAR(100) NOT NULL,
    descripcion VARCHAR(255)
);

INSERT IGNORE INTO categoria (id, nombre, descripcion)
VALUES
(1, 'Placas conmemorativas', 'Placas para homenajes y aniversarios'),
(2, 'Placas corporativas',   'Placas de reconocimiento para empresas'),
(3, 'Placas personalizadas', 'Diseños a medida para ocasiones especiales');

CREATE TABLE IF NOT EXISTS material (
    id     INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(100) NOT NULL,
    precio DECIMAL(10,2) NOT NULL DEFAULT 0
);

INSERT IGNORE INTO material (id, nombre, precio)
VALUES
(1, 'Mármol blanco',      45000.00),
(2, 'Vidrio templado',    32000.00),
(3, 'Acero inoxidable',   38000.00);

CREATE TABLE IF NOT EXISTS tamano (
    id                INT AUTO_INCREMENT PRIMARY KEY,
    dimensiones       VARCHAR(50) NOT NULL,
    precio_adicional  DECIMAL(10,2) NOT NULL DEFAULT 0
);

INSERT IGNORE INTO tamano (id, dimensiones, precio_adicional)
VALUES
(1, '15cm x 20cm', 0.00),
(2, '20cm x 30cm', 5000.00),
(3, '30cm x 40cm', 12000.00);


-- ==========================================
-- HISTORIAL DEL CLIENTE
-- ==========================================

CREATE TABLE IF NOT EXISTS historial (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    producto VARCHAR(100) NOT NULL,
    fecha DATE NOT NULL,
    estado VARCHAR(50) NOT NULL,
    FOREIGN KEY (user_id) REFERENCES users(id)
);

INSERT IGNORE INTO historial (id, user_id, producto, fecha, estado)
VALUES
(1, 1, 'Placa de mármol blanco con grabado dorado', '2026-07-10', 'Entregado'),
(2, 1, 'Placa de vidrio personalizada con nombre familiar', '2026-07-12', 'En proceso'),
(3, 2, 'Placa corporativa de acero con logo grabado', '2026-07-20', 'Entregado'),
(4, 3, 'Placa personalizada de vidrio con foto', '2026-08-01', 'En proceso');


-- ==========================================
-- FORMULARIO DE CONTACTO
-- ==========================================

CREATE TABLE IF NOT EXISTS contacto (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(100) NOT NULL,
    email VARCHAR(100) NOT NULL,
    mensaje TEXT NOT NULL,
    fecha TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

INSERT IGNORE INTO contacto (id, nombre, email, mensaje)
VALUES
(1, 'Marcela Chinchilla', 'marcela.ch@example.com',     'Quisiera cotizar una placa para un aniversario de bodas.'),
(2, 'Roberto Vindas',     'roberto.vindas@example.com', '¿Hacen envíos fuera del GAM?'),
(3, 'Paola Méndez',       'paola.mendez@example.com',   'Necesito una placa urgente para este fin de semana.');


-- ==========================================
-- RESEÑAS DE CLIENTES
-- ==========================================

CREATE TABLE IF NOT EXISTS resenas (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    nombre VARCHAR(100) NOT NULL,
    comentario TEXT NOT NULL,
    calificacion INT NOT NULL,
    FOREIGN KEY (user_id) REFERENCES users(id)
        ON DELETE CASCADE ON UPDATE CASCADE
);

INSERT IGNORE INTO resenas (id, user_id, nombre, comentario, calificacion)
VALUES
(1, 1, 'María López',       'Excelente calidad y atención al cliente.', 5),
(2, 1, 'Carlos Rodríguez',  'La placa quedó exactamente como la quería.', 5),
(3, 2, 'Jimena Rojas',      'Muy buena atención, la placa llegó antes de lo esperado.', 5),
(4, 3, 'Kimberly Vargas',   'Buen trabajo pero tardó un poco más de lo prometido.', 4);


-- ==========================================
-- SOPORTE
-- ==========================================

CREATE TABLE IF NOT EXISTS soporte (
    id               INT AUTO_INCREMENT PRIMARY KEY,
    nombre_completo  VARCHAR(150) NOT NULL,
    telefono         VARCHAR(20),
    correo           VARCHAR(150) NOT NULL,
    mensaje_soporte  TEXT
);

INSERT IGNORE INTO soporte (id, nombre_completo, telefono, correo, mensaje_soporte)
VALUES
(1, 'Ana Jiménez',    '8899-1122', 'ana.jimenez@example.com',    'No me llegó el correo de confirmación de mi pedido.'),
(2, 'Luis Fernández', '8877-6655', 'luis.fernandez@example.com', 'Quisiera cambiar la dirección de entrega de mi factura.');


-- ==========================================
-- CUENTA
-- ==========================================

CREATE TABLE IF NOT EXISTS cuenta (
    id        INT AUTO_INCREMENT PRIMARY KEY,
    ubicacion VARCHAR(255),
    genero    VARCHAR(20),
    user_id   INT NOT NULL,
    FOREIGN KEY (user_id) REFERENCES users(id)
        ON DELETE CASCADE ON UPDATE CASCADE
);

INSERT IGNORE INTO cuenta (id, ubicacion, genero, user_id)
VALUES
(1, 'Alajuelita, San José',   'Femenino', 2),
(2, 'Desamparados, San José', 'Femenino', 3);


-- ==========================================
-- FACTURA
-- ==========================================

CREATE TABLE IF NOT EXISTS factura (
    id                  INT AUTO_INCREMENT PRIMARY KEY,
    fecha               DATE NOT NULL,
    total               DECIMAL(10,2) NOT NULL DEFAULT 0,
    estado              VARCHAR(30) NOT NULL DEFAULT 'pendiente',
    fecha_creacion      TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    fecha_modificacion  TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    user_id             INT NOT NULL,
    FOREIGN KEY (user_id) REFERENCES users(id)
        ON DELETE RESTRICT ON UPDATE CASCADE
);

INSERT IGNORE INTO factura (id, fecha, total, estado, user_id)
VALUES
(1, '2026-07-15', 45000.00, 'pagada',    2),
(2, '2026-07-28', 38000.00, 'pagada',    3),
(3, '2026-08-05', 57000.00, 'pendiente', 4);


-- ==========================================
-- PLACA  (con la columna destacado agregada)
-- ==========================================

CREATE TABLE IF NOT EXISTS placa (
    id             INT AUTO_INCREMENT PRIMARY KEY,
    nombre         VARCHAR(150) NOT NULL,
    descripcion    TEXT,
    material       VARCHAR(100),
    tamano         VARCHAR(50),
    precio         DECIMAL(10,2) NOT NULL DEFAULT 0,
    imagen_nombre  VARCHAR(255),
    disponible     TINYINT(1) NOT NULL DEFAULT 1,
    destacado      TINYINT(1) NOT NULL DEFAULT 0,
    categoria_id   INT NOT NULL,
    FOREIGN KEY (categoria_id) REFERENCES categoria(id)
        ON DELETE RESTRICT ON UPDATE CASCADE
);

INSERT IGNORE INTO placa (id, nombre, descripcion, material, tamano, precio, imagen_nombre, disponible, destacado, categoria_id)
VALUES
(1, 'Placa homenaje familiar',              'Placa conmemorativa con grabado personalizado',        'Mármol blanco',    '20cm x 30cm', 45000.00, 'placa_homenaje.jpg',      1, 1, 1),
(2, 'Placa de reconocimiento empresarial',  'Placa corporativa con logo grabado',                   'Acero inoxidable', '30cm x 40cm', 50000.00, 'placa_corporativa.jpg',   1, 1, 2),
(3, 'Placa personalizada con foto',         'Diseño a medida con grabado fotográfico en vidrio',    'Vidrio templado',  '20cm x 30cm', 37000.00, 'placa_personalizada.jpg', 1, 1, 3);


-- ==========================================
-- VENTA  (con la columna placa_id agregada)
-- ==========================================

CREATE TABLE IF NOT EXISTS venta (
    id                  INT AUTO_INCREMENT PRIMARY KEY,
    cantidad            INT NOT NULL DEFAULT 1,
    precio              DECIMAL(10,2) NOT NULL DEFAULT 0,
    fecha_creacion      TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    fecha_modificacion  TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    factura_id          INT NULL,
    placa_id            INT NOT NULL,
    material_id         INT NOT NULL,
    tamano_id           INT NOT NULL,
    FOREIGN KEY (factura_id) REFERENCES factura(id)
        ON DELETE CASCADE ON UPDATE CASCADE,
    FOREIGN KEY (placa_id) REFERENCES placa(id)
        ON DELETE RESTRICT ON UPDATE CASCADE,
    FOREIGN KEY (material_id) REFERENCES material(id)
        ON DELETE RESTRICT ON UPDATE CASCADE,
    FOREIGN KEY (tamano_id) REFERENCES tamano(id)
        ON DELETE RESTRICT ON UPDATE CASCADE
);

INSERT IGNORE INTO venta (id, cantidad, precio, factura_id, placa_id, material_id, tamano_id)
VALUES
(1, 1, 45000.00, 1, 1, 1, 2),
(2, 1, 50000.00, 2, 2, 3, 3),
(3, 1, 37000.00, 3, 3, 2, 2);


-- ==========================================
-- VERIFICACIÓN
-- ==========================================

SHOW TABLES;
SELECT COUNT(*) AS total_users     FROM users;
SELECT COUNT(*) AS total_categoria FROM categoria;
SELECT COUNT(*) AS total_material  FROM material;
SELECT COUNT(*) AS total_tamano    FROM tamano;
SELECT COUNT(*) AS total_soporte   FROM soporte;
SELECT COUNT(*) AS total_contacto  FROM contacto;
SELECT COUNT(*) AS total_resenas   FROM resenas;
SELECT COUNT(*) AS total_historial FROM historial;
SELECT COUNT(*) AS total_cuenta    FROM cuenta;
SELECT COUNT(*) AS total_factura   FROM factura;
SELECT COUNT(*) AS total_placa     FROM placa;
SELECT COUNT(*) AS total_venta     FROM venta;