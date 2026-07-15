// Función que controla el inicio de sesión
const login = (event) => {

    // Evita que el formulario recargue la página al enviarse
    event.preventDefault();

    // Mensaje para verificar que la función se ejecuta
    console.log('login!!');


    // Obtener el formulario de login
    const form = document.querySelector('#frmLogin');

    // Obtener los datos ingresados por el usuario
    const data = new FormData(form);


    // Obtener el botón de enviar del formulario
    const submitBtn = form.querySelector('button[type="submit"]');

    // Desactivar el botón mientras se procesa la información
    submitBtn.disabled = true;

    // Limpiar mensajes de error anteriores
    document.querySelector('#msgError').textContent = '';


    // Enviar los datos al archivo PHP para validar el usuario
    fetch('./backend/login.php', {
        method: 'POST',
        body: data
    })

    // Convertir la respuesta del servidor a formato JSON
    .then(response => response.json())

    // Procesar la respuesta recibida
    .then(result => {

        // Habilitar nuevamente el botón
        submitBtn.disabled = false;


        // Revisar si las credenciales son correctas
        if(result.success){

            // Guardar el usuario en el almacenamiento del navegador
            localStorage.setItem('user', result.user);

            // Enviar al usuario al dashboard
            window.location.href = 'dashboard.php';

        }else{

            // Mostrar el mensaje de error si el login falla
            document.querySelector('#msgError').textContent = result.message || 'Credenciales incorrectas';
        }

    })

    // Capturar errores de conexión con el servidor
    .catch(error => {

        // Activar nuevamente el botón
        submitBtn.disabled = false;

        // Mostrar el error en consola
        console.log('Error: ', error);

        // Mostrar mensaje al usuario
        document.querySelector('#msgError').textContent = 'Error al comunicarse con el servidor.';
    })
}


// Buscar el formulario de login en la página
const form = document.querySelector('#frmLogin');

// Verificar que el formulario exista antes de agregar el evento
if(form){

    // Ejecutar la función login cuando se envíe el formulario
    form.addEventListener('submit', login);
}