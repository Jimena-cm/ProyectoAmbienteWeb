<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Iniciar Sesión | La Casa de la Placa</title>

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

       
        <div class="login-header text-center">
            <h1>LA CASA DE LA PLACA</h1>
            <h2>Iniciar Sesión</h2>
            <p>Ingresa a tu cuenta para continuar</p>
        </div>

        
        <form id="frmLogin">

            
            <div class="mb-3">
                <label
                    for="email"
                    class="form-label fw-semibold"
                >
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
                <label
                    for="password"
                    class="form-label fw-semibold"
                >
                    Contraseña
                </label>

                <input
                    type="password"
                    class="form-control"
                    id="password"
                    name="password"
                    placeholder="Ingresa tu contraseña"
                    required
                >
            </div>

            
            <small
                id="msgError"
                class="text-danger d-block mb-3"
            ></small>

           
            <div class="form-check mb-4">
                <input
                    class="form-check-input"
                    type="checkbox"
                    name="rememberme"
                    id="rememberme"
                >

                <label
                    class="form-check-label"
                    for="rememberme"
                >
                    Recordarme
                </label>
            </div>

           
            <button
                type="submit"
                class="btn btn-primary w-100 p-2 mb-3"
            >
                INGRESAR
            </button>

            
            <div class="text-center mb-3">
                <a href="recuperar.php">
                    ¿Olvidaste tu contraseña?
                </a>
            </div>

            
            <div class="registro-link text-center">
                <span>¿No tienes una cuenta?</span>

                <a href="registro.php">
                    Regístrate
                </a>
            </div>

        </form>

    </div>

   
    <script src="./js/login.js"></script>

</body>

</html>