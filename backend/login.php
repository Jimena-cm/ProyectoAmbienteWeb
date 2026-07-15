<?php

// Iniciar la sesión para guardar datos del usuario
session_start();

// Incluir el archivo de conexión a la base de datos
require_once('conexion.php');

// Indicar que la respuesta será en formato JSON
header('Content-Type: application/json');

// Verificar que la solicitud sea de tipo POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    // Obtener el correo enviado desde el formulario
    $email = $_POST['email'] ?? '';

    // Obtener la contraseña enviada desde el formulario
    //$email = $_POST['email'] == null ? '' : $_POST['email'];
    $password = $_POST['password'] ?? '';

    // Buscar el usuario por su correo
    $stmt = $pdo->prepare("SELECT * FROM users WHERE email = ?");
    $stmt->execute([$email]);

    // Obtener los datos del usuario encontrado
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    // Verificar que el usuario exista y que la contraseña sea correcta
    if ($user && $user['password'] === $password) {

        // Guardar datos del usuario en la sesión
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['user_name'] = $user['name'];

        // Enviar una respuesta indicando que el inicio de sesión fue exitoso
        echo json_encode([
            'success' => true,
            'message' => 'Proceso exitoso',
            'user' => $user['name']
        ]);

    } else {

        // Enviar un mensaje si las credenciales son incorrectas
        echo json_encode([
            'success' => false,
            'message' => 'Credenciales incorrectas.'
        ]);
    }

} else {

    // Mostrar un mensaje si el método de la solicitud no es POST
    echo json_encode([
        'success' => false,
        'message' => 'Método no permitido.'
    ]);
}
