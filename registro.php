<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Registro | La Casa de la Placa</title>

   
    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css"
        rel="stylesheet"
    >

    
    <link rel="stylesheet" href="/ProyectoAmbienteWeb/public/css/style.css">
</head>

<body class="login-body">

    <div class="login-container">

       
        <div class="login-logo-container">
            <img
                src="public/img/logo.jpg"
                alt="Logo de La Casa de la Placa"
                class="login-logo"
            >
        </div>

        
        <div class="login-header">
            <h1>LA CASA DE LA PLACA</h1>
            <h2>Crear cuenta</h2>
            <p>Regístrate para acceder a nuestros servicios</p>
        </div>

        
        <form id="frmRegistro">

            <div class="mb-3">
                <label for="name" class="form-label">
                    Nombre completo
                </label>

                <input
                    type="text"
                    class="form-control"
                    id="name"
                    name="name"
                    placeholder="Ingresa tu nombre completo"
                    required
                >
            </div>

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
                <label for="phone" class="form-label">
                    Teléfono
                </label>

                <input
                    type="tel"
                    class="form-control"
                    id="phone"
                    name="phone"
                    placeholder="8888-8888"
                >
            </div>

            <div class="mb-3">
                <label for="address" class="form-label">
                    Dirección
                </label>

                <input
                    type="text"
                    class="form-control"
                    id="address"
                    name="address"
                    placeholder="Ingresa tu dirección"
                >
            </div>

            <div class="mb-3">
                <label for="password" class="form-label">
                    Contraseña
                </label>

                <input
                    type="password"
                    class="form-control"
                    id="password"
                    name="password"
                    placeholder="Crea una contraseña"
                    required
                >
            </div>

           
            <small
                id="msgRegistro"
                class="text-danger d-block mb-3"
            ></small>

           
            <button
                type="submit"
                class="btn btn-primary w-100 p-2"
            >
                REGISTRARSE
            </button>

            
            <div class="text-center mt-3">
                <span>¿Ya tienes una cuenta?</span>

                <a href="index.php">
                    Inicia sesión
                </a>
            </div>

        </form>

    </div>

    <script src="./js/registro.js"></script>

</body>

</html>