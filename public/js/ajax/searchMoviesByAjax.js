'use strict';


window.onload = function() {

    const btnSubmit = document.querySelector('#submit');
    const loading = document.querySelector('.loader');
    const result = document.querySelector('#result');


    function getMovies(e){
        console.log('Query')
        e.preventDefault();
        const search = document.querySelector('#search').value;
        fetch(`ajax/query/${search}`)
            .then(response => response.json())
            .then((allMovies)=> {
                // console.log(allMovies)
                let movies = allMovies.movies;

                createCard(movies);

                loading.style.display = "none";

            })

        // console.log('wééééé');
        // console.log(search);
    }

    function getMoviesByGETMethod(){

        const search = document.querySelector('#search').value;
        fetch(`ajax/search/${search}`)
            .then(response => response.json())
            .then((allMovies)=> {
                createCard(allMovies);
                loading.style.display = "none";
            }).catch((error)=> {
            createCard(null)
        })
    }

    function createCard(arr){

        const div = document.createElement('div');
        div.classList = 'mt-3 mb-2 resp';

        if (arr != null ) {
        div.classList.add('card-deck');
            for (let i = 0; i < arr.length; i++) {


                const card = document.createElement('div');
                card.classList = 'card mb-4' ;

                const cardBody = document.createElement('div')
                cardBody.classList = 'card-body';

                const txtCard = document.createElement('h5');
                txtCard.innerText = arr[i].name;


                const imgCard = document.createElement('img');
                imgCard.classList = 'card-img-top';
                imgCard.src = arr[i].picture;


                const linkPage = document.createElement('a');
                linkPage.href = `film/${arr[i].id}`;
                linkPage.setAttribute("alt", arr[i].name);

                linkPage.appendChild(card);
                card.appendChild(imgCard);

                card.appendChild(cardBody);

                cardBody.appendChild(txtCard);
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
        if (document.getElementsByClassName('result')){
            document.getElementById('resp').innerHTML ="";

        }
    }

    //Déclenché lors d'une requete GET depuis l'input situé dans la nav
    getMoviesByGETMethod();

    //Déclenché lors d'une requete depuis l'input de la page de recherche
    btnSubmit.addEventListener('keyup',getMovies);
}