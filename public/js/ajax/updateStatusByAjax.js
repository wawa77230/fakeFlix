'use strict';

function onChangeStatus(){

    if(confirm("êtes vous sûr de vouloir modifier son status ?"))
    {
        let url = this.attributes["data-url"].value;
        let id = this.attributes["data-id"].value;
        let status = this.attributes["data-status"].value;
        console.log(url, id);

        // let data = new FormData();
        // data.set('id[]',id);
        // data.set('url[]',url);
        // data.set('status[]',status);
        // data.toString()

        let data = new FormData();
        data.set('id',id);
        data.set('url',url);
        data.set('status',status);

        var myHeaders = new Headers();

        var myInit = { method: 'POST',
            headers: myHeaders,
            body: data
        };

        //La variable url permet de faire la distinction entre les 2 possibilité de requete ajax
        fetch(`ajax/${url}`,myInit
        ).then(resp => resp.json()).then((reponse)=> {
            console.log(reponse)
        })
    }

}

window.onload = function() {

    let inputs = document.querySelectorAll('.custom-control-input');
    inputs.forEach(function (input){
        input.addEventListener('click', onChangeStatus);
    })
}
