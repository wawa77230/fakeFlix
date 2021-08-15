'use strict';

var domElements = {};

function FormValidator(form) {

    this.form = form;
    this.allErrors = [];
}

FormValidator.prototype.checkRequiredSelect = function()
{
    let classThis = this ;

    this.form.find("[data-requiredselect]").each(function ()
    {
        let  value = $(this).val();
        let forbiddenValue = $(this).data("requiredselect") ;

        if (value == forbiddenValue)
        {
            classThis.allErrors.push({
                domElement : $(this),
                message : "Veuillez choisir une valeur",
            }) ;
        }
    });
}

FormValidator.prototype.checkFileFields = function()
{
    let classThis = this ;
    this.form.find("[data-requiredfile]").each(function ()
    {

        let value = $(this)[0].value ;

        if (!value){
            let message = "Veuillez ajouter une image" ;
            classThis.allErrors.push({
                domElement : $(this),
                message : message,
            }) ;
        }
    });

}

FormValidator.prototype.checkMinLength = function()
{
    let classThis = this ;
    this.form.find("[data-minlength]").each(function ()
    {
        let  value = $(this).val().trim();
        let minLength = $(this).data("minlength") ;
        let missingChars = minLength - value.length ;

        if (value.length < minLength)
        {
            let message = "Veuillez entrer au moins "+minLength+" caractère(s)<br>" ;
            message += "("+missingChars+" caractère(s) manquant(s))" ;
            classThis.allErrors.push({
                domElement : $(this),
                message : message,
            }) ;
        }
    });
}

FormValidator.prototype.checkEmail = function()
{
    let classThis = this ;
    this.form.find("[data-email]").each(function ()
    {
        let  value = $(this).val().trim();

        if (! value.match(/^[-a-z0-9~!$%^&*_=+}{\'?]+(\.[-a-z0-9~!$%^&*_=+}{\'?]+)*@([a-z0-9_][-a-z0-9_]*(\.[-a-z0-9_]+)*\.(aero|arpa|biz|com|coop|edu|gov|info|int|mil|museum|name|net|org|pro|travel|mobi|[a-z][a-z])|([0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}))(:[0-9]{1,5})?$/i ))
        {
            classThis.allErrors.push({
                domElement : $(this),
                message : "Veuillez entrer un email valide",
            }) ;
        }
    });
}

FormValidator.prototype.checkEqualFields = function()
{
    let classThis = this ;
    this.form.find("[data-equal]").each(function ()
    {
        let value = $(this).val() ;
        let otherEqualFields = $("[data-equalcopy="+$(this).data("equal")+"]") ;
        let error = false ;
        otherEqualFields.each(function()
        {
            error = error || ($(this).val() != value) ;
        }) ;

        if (error)
        {
            classThis.allErrors.push({
                domElement : $(this),
                message : "Ce champ doit avoir la même valeur que le mot de passe",
            }) ;
        }
    });

}

FormValidator.prototype.displayAllErrors = function()
{
    if (this.allErrors.length > 0)
    {
        this.allErrors.forEach(function (error) {

           let errorDiv = $("<div>");


            //Afin de distinquer toutes la page d'inscription où le text des erreur est rouge, je récupère  la derniere valeur de l'url pour changer la couleur en blanc des erreurs ( au lieu de rouge)
            const adress = window.location.href;
            const separator = adress.split('/');
            const url = separator[4];

            if (url === "inscription"){
                errorDiv.addClass("text-white");

            }else {
                errorDiv.addClass("form-error");
            }
            errorDiv.html(error.message);
            error.domElement.after(errorDiv);

        })
    }
}

FormValidator.prototype.onSubmit = function(event)
{
    this.allErrors = [];
    $(".form-error").remove();

    this.checkMinLength();
    this.checkRequiredSelect();
    this.checkEmail();
    this.checkFileFields();
    this.checkEqualFields();


    this.displayAllErrors();


    if (this.allErrors.length>0)
    {
        event.preventDefault();
    }

}

FormValidator.prototype.run = function()
{
        this.checkRequired();
        this.displayAllErrors();
}

$(function () {

    let formVal = new FormValidator($("form[data-validate]"));
    formVal.form.on("submit", formVal.onSubmit.bind(formVal));


});
