<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Recuperar contraseña | La Casa de la Placa</title>

    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css"
        rel="stylesheet"
    >

    <link rel="stylesheet" href="./css/style.css">
</head>

<body class="login-body">

    <div class="login-container">

      
        <div class="login-logo-container">
            <img
                src="./img/logo.jpg"
                alt="Logo de La Casa de la Placa"
                class="login-logo"
            >
        </div>

       
        <div class="login-header">
            <h1>LA CASA DE LA PLACA</h1>
            <h2>Recuperar contraseña</h2>
            <p>Ingresa tu correo y crea una nueva contraseña</p>
        </div>

        <form id="frmRecuperar">

            <div class="mb-3">
                <label for="email" class="form-label">
                    Correo electrónico
                </label>

                <input
                    type="email"
                    class="form-control"
                    id="email"
                    name="email"
                    placeholder="correo@ejemplo.com"
                    required
                >
            </div>

            <div class="mb-3">
                <label for="password" class="form-label">
                    Nueva contraseña
                </label>

                <input
                    type="password"
                    class="form-control"
                    id="password"
                    name="password"
                    placeholder="Ingresa tu nueva contraseña"
                    required
                >
            </div>

            <div class="mb-3">
                <label for="confirmPassword" class="form-label">
                    Confirmar contraseña
                </label>

                <input
                    type="password"
                    class="form-control"
                    id="confirmPassword"
                    name="confirmPassword"
                    placeholder="Confirma tu nueva contraseña"
                    required
                >
            </div>

            <small
                id="msgRecuperar"
                class="d-block mb-3"
            ></small>

            <button
                type="submit"
                class="btn btn-primary w-100 p-2"
            >
                CAMBIAR CONTRASEÑA
            </button>

            <div class="text-center mt-3">
                <a href="index.php">
                    Volver al inicio de sesión
                </a>
            </div>

        </form>

    </div>

    <script src="./js/recuperar.js"></script>

</body>

</html>