<?php

// Datos para conectarse a la base de datos
$host = 'localhost';
$db = 'casa_placa';
$user = 'root';
$pass = 'Zeanne202507';

// Usar PDO para conectarse a MySQL
try {

    // Crear la conexión con la base de datos
    $pdo = new PDO("mysql:host=$host;dbname=$db;charset=utf8", $user, $pass);

    // Mostrar errores si ocurre algún problema
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

} catch (PDOException $e) {

    // Mostrar el error de conexión
    echo "Error de conexión: " . $e->getMessage();

    // Detener el programa si no se pudo conectar
    die();

}


















?>