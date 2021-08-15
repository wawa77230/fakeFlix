'use strict' ;


function onRemoveButtonClick(e){
    e.preventDefault();
    let name = this.attributes["data-name"].value;
    const container = this.closest('.removable-container')

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
            onRemoved(container) ;

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

function onRemoved(el)
{
    el.style.opacity = 1;
    (function fade() {
        if ((el.style.opacity -= .1) < 0) {
            el.style.display = "none";
        } else {
            requestAnimationFrame(fade);
        }
    })();
}

const removeButtons = document.querySelectorAll('.remove');
removeButtons.forEach(function (button){
    button.addEventListener('click',onRemoveButtonClick);
});


