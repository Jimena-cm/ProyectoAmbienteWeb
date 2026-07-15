-- ==========================================
-- BASE DE DATOS LA CASA DE LA PLACA
-- ==========================================

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

    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP

);



-- Usuario administrador de prueba
-- contraseña: 1234

INSERT IGNORE INTO users 
(id, name, email, password, phone, address)

VALUES

(1,
'Bryan Cerdas',
'admin@correo.com',
'1234',
'8888-8888',
'San José, Costa Rica'
);



-- ==========================================
-- TABLA ESTADÍSTICAS DASHBOARD
-- ==========================================

CREATE TABLE IF NOT EXISTS stats (

    id INT AUTO_INCREMENT PRIMARY KEY,

    description VARCHAR(100) NOT NULL,

    value VARCHAR(50) NOT NULL

);



TRUNCATE TABLE stats;


INSERT INTO stats(description,value)

VALUES

('Pedidos realizados','25'),

('Clientes registrados','75'),

('Placas fabricadas','320'),

('Ventas del mes','$15,400'),

('Mensajes recibidos','14'),

('Reseñas pendientes','10');



-- ==========================================
-- HISTORIAL DEL CLIENTE
-- ==========================================

CREATE TABLE IF NOT EXISTS historial (

    id INT AUTO_INCREMENT PRIMARY KEY,

    user_id INT NOT NULL,

    producto VARCHAR(100) NOT NULL,

    fecha DATE NOT NULL,

    estado VARCHAR(50) NOT NULL,


    FOREIGN KEY(user_id)

    REFERENCES users(id)

);



-- Datos de prueba del historial

INSERT INTO historial
(user_id, producto, fecha, estado)

VALUES

(1,
'Placa de mármol blanco con grabado dorado',
'2026-07-10',
'Entregado'),

(1,
'Placa de vidrio personalizada con nombre familiar',
'2026-07-12',
'En proceso');




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




-- ==========================================
-- RESEÑAS DE CLIENTES
-- ==========================================

CREATE TABLE IF NOT EXISTS resenas (

    id INT AUTO_INCREMENT PRIMARY KEY,

    nombre VARCHAR(100) NOT NULL,

    comentario TEXT NOT NULL,

    calificacion INT NOT NULL

);



-- Datos de prueba

INSERT INTO resenas
(nombre, comentario, calificacion)

VALUES

('María López',
'Excelente calidad y atención al cliente.',
5),


('Carlos Rodríguez',
'La placa quedó exactamente como la quería.',
5);




-- ==========================================
-- VERIFICACIÓN
-- ==========================================


USE casa_placa;


SHOW TABLES;


SELECT * FROM users;

SELECT * FROM stats;

SELECT * FROM historial;

SELECT * FROM contacto;

SELECT * FROM resenas;


USE casa_placa;

ALTER TABLE users
ADD profile_image VARCHAR(255) DEFAULT 'usuario.jpg';