$(document).ready(function () {

    // prend en compte les champs cachés
    $.validator.setDefaults({
        ignore: ''
    });
    
    // la méthode principale de jQuery validation plugin
    $('#form-article').validate({
        rules: {
            "title": {
                required: true,
                maxlength: 255
            },
            "text": {
                required: true
            }
        },
        messages: {
            "title": {
                required: "Veuillez saisir votre titre",
                maxlength: "Veuillez saisir un titre moins long"
            },
            "text": {
                required: "Veuillez saisir votre commentaire"
            }
        }
    });
});