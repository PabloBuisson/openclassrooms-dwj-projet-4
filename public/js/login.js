$(document).ready(function () {

    // la méthode principale de jQuery validation plugin
    $('#form-login').validate({
        rules: {
            "pseudo": {
                required: true
            },
            "password": {
                required: true
            }
        },
        messages: {
            "pseudo": {
                required: "Veuillez saisir votre pseudo"
            },
            "password": {
                required: "Veuillez saisir votre mot de passe"
            }
        }
    });

});