$(document).ready(function () {

    $.validator.addMethod("mailverified", function (value, element, params) {
        let pattern = new RegExp(/^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/);
        return pattern.test(value);
    }, "Veuillez saisir une adresse mail valide");

    // la méthode principale de jQuery validation plugin
    $('#form-contact').validate({
        rules: {
            "form-mail": {
                required: true,
                mailverified: true, // remplace la propriété mail
                minlength: 3,
                maxlength: 100
            },
            "form-firstname": {
                required: true,
                maxlength: 255
            },
            "form-name": {
                required: true,
                maxlength: 255
            },
            "form-subject": {
                required: true,
                maxlength: 255
            },
            "form-message": {
                required: true
            },
            "request-check": {
                required: true
            }
        },
        messages: {
            "form-mail": {
                required: "Veuillez saisir votre adresse mail",
                mailverified: "Veuillez saisir une adresse mail valide", // remplace la propriété mail
                minlength: "Veuillez saisir une adresse mail valide",
                maxlength: "Veuillez saisir une adresse mail valide"
            },
            "form-firstname": {
                required: "Veuillez saisir votre prénom",
                maxlength: "Veuillez saisir un prénom moins long"
            },
            "form-name": {
                required: "Veuillez saisir votre nom",
                maxlength: "Veuillez saisir un nom moins long"
            },
            "form-subject": {
                required: "Veuillez saisir l'objet de votre mail",
                maxlength: "Veuillez saisir un titre moins long"
            },
            "form-message": {
                required: "Veuillez saisir votre message"
            },
            "request-check": {
                required: "Veuillez confirmer votre demande"
            }
        }
    });

    // modal de confirmation de l'envoi
    $('#after-email.success').modal('toggle');
    $('#after-email .close, #after-email .close-button').click(function (e) {
        $('#after-email').removeClass('success');
    });

});