'use strict';


window.onload = function() {

    const div = document.createElement('div');
    div.classList = 'mt-3 mb-2';
    div.setAttribute('id','resp');

    const loading = document.querySelector('.loader');
    const result = document.querySelector('#result');
    const inputForm = document.querySelector('#search');
    const h1 = document.querySelector('h1');




    function getMovies(e){

        refreshContent();
        loading.style.display = "flex";


        e.preventDefault();
        const search = document.querySelector('#search').value;


        //Afin d'éviter de récupérer toutes les entrées de la base de donnée
        if (search.length > 0) {
            fetch(`ajax/movies/query/${search}`)
                .then(response => response.json())
                .then((allMovies)=> {
                    createCard(allMovies);
                    h1.innerText = `Résultat : ${search}`;
                    document.title = `Résultat | ${search}`;

                    loading.style.display = "none";

                }).catch((error)=> {
                createCard(null)
            })
        }else {
            loading.style.display = "none";
        }

    }

    function getMoviesByGETMethod(){

        const search = document.querySelector('#search').value;
        fetch(`ajax/movies/search/${search}`)
            .then(response => response.json())
            .then((allMovies)=> {
                createCard(allMovies);
                loading.style.display = "none";
            }).catch((error)=> {
            createCard(null)
        })
    }

    function createCard(arr){


        if (arr != null ) {
        div.classList = 'card-group row justify-content-around';
            for (let i = 0; i < arr.length; i++) {


                const card = document.createElement('div');
                card.classList = 'card mb-4 thumbnail text-white' ;
                //Retire les bordures blanche des card de la class Bootstrap
                card.style.border = "none";

                // const cardBody = document.createElement('div')
                // cardBody.classList = 'card-body';
                //
                // const txtCard = document.createElement('h5');
                // txtCard.innerText = arr[i].name;


                const imgCard = document.createElement('img');
                imgCard.classList = 'card-img-top thumbnail';
                imgCard.src = arr[i].picture;


                const linkPage = document.createElement('a');
                linkPage.href = `film/${arr[i].id}`;
                linkPage.setAttribute("alt", arr[i].name);

                linkPage.appendChild(card);
                card.appendChild(imgCard);

                // card.appendChild(cardBody);

                // cardBody.appendChild(txtCard);
                div.appendChild(linkPage);

            }
        }else {


            const respText = document.createElement('h5');
            respText.classList = 'text-center text-light'
            respText.innerText = 'Aucun film trouvé';
            div.appendChild(respText)

        }
        result.appendChild(div)
    }

    function refreshContent(){

        if (result && (inputForm.value.length > 0 || div) ){
            div.innerHTML ="";
            if (resp){
                resp.classList.remove('card-deck');
            }
        }
    }

    //Déclenché lors d'une requete GET depuis l'input situé dans la nav
    getMoviesByGETMethod();

    //Déclenché lors d'une requete depuis l'input de la page de recherche
    inputForm.addEventListener('keyup',getMovies);
}