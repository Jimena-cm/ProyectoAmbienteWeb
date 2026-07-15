const login = (event) => {

    event.preventDefault();
    console.log('login!!');

    const form = document.querySelector('#frmLogin');
    const data = new FormData(form);
    const submitBtn = form.querySelector('button[type="submit"]');

    submitBtn.disabled = true;

    document.querySelector('#msgError').textContent = '';

    fetch('./backend/login.php', {
        method: 'POST',
        body: data
    })
    .then(response => response.json())
    .then(result => {

        submitBtn.disabled = false;

        if(result.success){

            localStorage.setItem('user', result.user);
            window.location.href = 'dashboard.php';

        }else{

            document.querySelector('#msgError').textContent = result.message || 'Credenciales incorrectas';
        }

    })
    .catch(error => {

        submitBtn.disabled = false;
        console.log('Error: ', error);
        document.querySelector('#msgError').textContent = 'Error al comunicarse con el servidor.';
    })
}


const form = document.querySelector('#frmLogin');

if(form){
    form.addEventListener('submit', login);
}