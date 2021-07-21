'use strict';


window.onload = function() {

    let logout = document.querySelector('#logout');

    logout.addEventListener('click',function (e){
        e.preventDefault()

        Swal.fire({
            title: 'Êtes vous?',
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
    })


}