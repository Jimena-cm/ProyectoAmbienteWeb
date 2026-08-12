# La Casa de la Placa

Proyecto en PHP (MVC) + MySQL para XAMPP.

## Instalación

1. Colocar el proyecto en `C:\xampp\htdocs\ProyectoAmbienteWeb`
2. Encemder Apache y MySQL en XAMPP
3. En phpMyAdmin, correr el archivo `BaseDatos.sql` (crea la base `casa_placa`)
4. Crear `app/config/config.php` con tus datos:

```php
<?php
define('DB_HOST', 'localhost');
define('DB_NAME', 'casa_placa');
define('DB_USER', 'root');
define('DB_PASS', ''); // tu contraseña de MySQL

define('BASE_URL', 'http://localhost/ProyectoAmbienteWeb/public/');
define('ROOT_URL', 'http://localhost/ProyectoAmbienteWeb/');
?>
```

5. Verificar que exista la carpeta `uploads/` en la raíz del proyecto

## Entrar al sitio

```
http://localhost/ProyectoAmbienteWeb/public/dashboard
```

Usuario de prueba: `admin@correo.com` / `1234`
