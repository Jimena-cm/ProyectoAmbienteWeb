<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Registrarse | La Casa de la Placa</title>

    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css"
        rel="stylesheet"
    >

    <link rel="stylesheet" href="<?= BASE_URL ?>css/style.css">
</head>

<body class="login-body">

    <div class="login-container">

        <div class="login-logo-container">
            <img
                src="<?= BASE_URL ?>img/logo.jpg"
                alt="Logo de La Casa de la Placa"
                class="login-logo"
            >
        </div>

        <div class="login-header text-center">
            <h1>LA CASA DE LA PLACA</h1>
            <h2>Crear cuenta</h2>
            <p>Regístrate para acceder a tu cuenta</p>
        </div>

        <?php if (isset($error)): ?>
            <small class="text-danger d-block mb-3">
                <?= htmlspecialchars($error) ?>
            </small>
        <?php endif; ?>

        <form action="<?= BASE_URL ?>auth/register" method="POST">

            <div class="mb-3">
                <label for="name" class="form-label fw-semibold">
                    Nombre completo
                </label>

                <input
                    type="text"
                    class="form-control"
                    id="name"
                    name="name"
                    placeholder="Nombre completo"
                    required
                >
            </div>

            <div class="mb-3">
                <label for="email" class="form-label fw-semibold">
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
                <label for="phone" class="form-label fw-semibold">
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
                <label for="address" class="form-label fw-semibold">
                    Dirección
                </label>

                <input
                    type="text"
                    class="form-control"
                    id="address"
                    name="address"
                    placeholder="San José, Costa Rica"
                >
            </div>

            <div class="mb-3">
                <label for="password" class="form-label fw-semibold">
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

            <button
                type="submit"
                class="btn btn-primary w-100 p-2 mb-3"
            >
                REGISTRARSE
            </button>

            <div class="registro-link text-center">
                <span>¿Ya tienes una cuenta?</span>

                <a href="<?= BASE_URL ?>auth/index">
                    Iniciar sesión
                </a>
            </div>

        </form>

    </div>

</body>

</html>