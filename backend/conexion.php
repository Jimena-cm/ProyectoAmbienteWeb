<?php

require_once __DIR__ . '/config.php';

// Usar PDO para conectarse a MySQL
try {

    // Crear la conexión con la base de datos
    $pdo = new PDO("mysql:host=" . DB_HOST . ";dbname=" . DB_NAME . ";charset=utf8", DB_USER, DB_PASS);

    // Mostrar errores si ocurre algún problema
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

} catch (PDOException $e) {

    // Mostrar el error de conexión
    echo "Error de conexión: " . $e->getMessage();

    // Detener el programa si no se pudo conectar
    die();

}