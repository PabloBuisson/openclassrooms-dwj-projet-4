$(document).ready(function () {

    // la méthode principale de jQuery validation plugin
    $('#form-comment').validate({
        rules: {
            "form-pseudo": {
                required: true,
                maxlength: 255
            },
            "form-comment": {
                required: true
            }
        },
        messages: {
            "form-pseudo": {
                required: "Veuillez saisir votre pseudo",
                maxlength: "Veuillez saisir un pseudo moins long"
            },
            "form-comment": {
                required: "Veuillez saisir votre commentaire"
            }
        }
    });

});