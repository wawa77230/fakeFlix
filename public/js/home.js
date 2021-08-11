'use strict'
window.onload = function() {
    $('.multiple-items').slick({
        infinite: false,
        slidesToShow: 5,
        slidesToScroll: 1,
        arrows: true,
        nextArrow: '<i class="fa fa-chevron-right"></i>',
        prevArrow: '<i class="fa fa-chevron-left"></i>',
        responsive: [
            {
                breakpoint: 1031,
                settings: {
                    slidesToShow: 4,
                    infinite: true
                }
            },
            {
                breakpoint: 830,
                settings: {
                    slidesToShow: 3,
                    infinite: true
                }
            }
        ]
    });
    //Afin de ne cibler que les images présent dans la page home, j'ai ajouté cette classe
    let img = $('.images');
    img.css('cursor','pointer');

    img.click( function (){

        //Récuperation de l'url afin de faire la redirection au click
        let url = this.attributes["data-url"].value;
        $(location).attr('href', url);

        }
    )
}