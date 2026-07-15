document.addEventListener('DOMContentLoaded', function(){

    const button = document.querySelector('.btn-flotante');
    if(button){
        button.addEventListener('click', saludar);
    }

    fetch('./backend/get_stats.php')
    .then(response => {
        if(!response.ok){
            throw new Error('No autorizado o error de servidor');
        }
        return response.json();
    })
    .then(cards => {
        const cardSection = document.querySelector('.cards')
        let cardsHTML = '';

        cards.forEach(card => {
            const { description, value } = card;

            cardsHTML += `<div class="col-12 col-md-6 col-lg-4">
                        <div class="card-custom h-100">
                            <h3 class="fs-4 fw-semibold mb-3">${description}</h3>
                            <p class="fs-5 text-muted m-0">${value}</p>
                        </div>
                    </div>`;
            
        });
        cardSection.innerHTML = cardsHTML;

    })
    .catch(error => {
        console.log('Error obtenido:', error);
        if(error.message.includes('No autorizado')) {
            window.location.href = 'index.php';
        }
    });
  
});


const saludar = () => {
    alert('Todo bien!');
}
