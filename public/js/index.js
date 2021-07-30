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

function onRemove(e){
    e.preventDefault();
    let name = this.attributes["data-name"].value;

    const swalWithBootstrapButtons = Swal.mixin({
        customClass: {
            confirmButton: 'btn btn-success',
            cancelButton: 'btn btn-danger'
        },
        buttonsStyling: false
    })

    swalWithBootstrapButtons.fire({
        title: `Êtes vous sûr de vouloir supprimer <strong>${name}</strong>  ?`,
        icon: 'warning',
        showCancelButton: true,
        confirmButtonText: 'Oui !',
        cancelButtonText: 'Non',
        reverseButtons: true
    }).then((result) => {
        if (result.isConfirmed) {

            let url = this.attributes["data-url"].value;
            let id = this.attributes["data-id"].value;

            //Envoie des datas en $_POST pour effectuer la suppression
            let data = new FormData();
            data.set('id',id);
            data.set('url',url);

            var myHeaders = new Headers();

            var myInit = { method: 'POST',
                headers: myHeaders,
                body: data
            };

            //Requete ajax de suppression
            fetch(`${url}`,myInit)

            swalWithBootstrapButtons.fire(
                'Supprimé!',
                `${name} a été supprimée !`,
                'success'
            )
        } else if (
            result.dismiss === Swal.DismissReason.cancel
        ) {
            swalWithBootstrapButtons.fire(
                'Annulé',
                'Fausse alerte!!',
                'error'
            )
        }
    })

}

window.onload = function() {


    let logout = document.querySelector('#logout');
        logout.addEventListener('click', disconnect)

    let removeButtons = document.querySelectorAll('.remove');
    removeButtons.forEach(function (button){
        button.addEventListener('click',onRemove);
    });


}