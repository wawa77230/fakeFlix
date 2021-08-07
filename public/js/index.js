'use strict';
function disconnect(e) {

        e.preventDefault()
        Swal.fire({
            title: 'Êtes vous sûr de vouloir vous déconnecter?',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#28a745',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Oui',
            cancelButtonText: 'Non'
        }).then((result) => {
            if (result.isConfirmed) {
                //Redirection via la récupération de l'attribue href de la balise a#logout
                window.location = this.href;
            }
        })
}


    let logout = document.querySelector('#logout');
        logout.addEventListener('click', disconnect)



