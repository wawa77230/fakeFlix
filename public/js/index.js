'use strict';

function disconnect(e) {

        e.preventDefault()

        Swal.fire({
            title: 'Êtes vous sûr de vouloir vous déconnecter?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
            if (result.isConfirmed) {
                Swal.fire(
                    'Deleted!',
                    'Your file has been deleted.',
                    'success'
                )
            }
        })

}

function onRemove(e){
    e.preventDefault();
    // console.log('coucou');
    let cat = this.attributes["data-cat"].value;

    const swalWithBootstrapButtons = Swal.mixin({
        customClass: {
            confirmButton: 'btn btn-success',
            cancelButton: 'btn btn-danger'
        },
        buttonsStyling: false
    })

    swalWithBootstrapButtons.fire({
        title: `Êtes vous sûr de vouloir supprimer <strong>${cat}</strong>  ?`,
        // text: `Cela concerne la catégorie `,
        icon: 'warning',
        showCancelButton: true,
        confirmButtonText: 'Oui !',
        cancelButtonText: 'Non',
        reverseButtons: true
    }).then((result) => {
        if (result.isConfirmed) {

            let url = this.attributes["data-url"].value;
            let id = this.attributes["data-id"].value;

            // console.log(url);
            // console.log(id);

            let data = new FormData();
            data.set('id[]',id);
            data.set('url[]',url);

            var myHeaders = new Headers();

            var myInit = { method: 'POST',
                headers: myHeaders,
                body: data
            };


            //Requete ajax de suppression
            fetch(`${url}`,myInit)

            swalWithBootstrapButtons.fire(
                'Supprimé!',
                `La catégorie ${cat} a été supprimée !`,
                'success'
            )
        } else if (
            /* Read more about handling dismissals below */
            result.dismiss === Swal.DismissReason.cancel
        ) {
            swalWithBootstrapButtons.fire(
                'Annulé',
                'La catégorie n\'a pas été supprimée !!',
                'error'
            )
        }
    })






    // fetch(`${url}`,myInit
    // ).then(resp => resp.json()).then((reponse)=> {
    //     console.log(reponse)
    // })


}

window.onload = function() {

    let logout = document.querySelector('#logout');
    logout.addEventListener('click', disconnect)

    let removeButtons = document.querySelectorAll('.remove');
    removeButtons.forEach(function (button){
        button.addEventListener('click',onRemove);
    });


}