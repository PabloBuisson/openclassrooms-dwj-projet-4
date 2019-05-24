$(document).ready(function () {

    $('#error').remove();

    // création d'une méthode pour rendre la vérification de mail plus poussée
    $.validator.addMethod("mailverified", function (value, element, params) {
        let pattern = new RegExp(/^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/);
        return pattern.test(value);
    }, "Veuillez saisir une adresse mail valide");

    // la méthode principale de jQuery validation plugin
    $('#form-inscription').validate({
        rules: {
            mail: {
                required: true,
                mailverified: true, // remplace la propriété mail
                minlength: 3,
                maxlength: 100
            },
            pseudo: {
                required: true,
                maxlength: 100,
                remote: { // vérifie de façon asynchrone si le pseudo est déjà pris
                    url: "inscription.php?check=pseudo",
                    type: "post"
                }
            },
            password: {
                required: true,
                maxlength: 100
            },
            confirmedPassword: {
                required: true,
                maxlength: 100,
                equalTo: "#password"
            }
        },
        messages: {
            mail: {
                required: "Veuillez saisir votre adresse mail",
                mailverified: "Veuillez saisir une adresse mail valide", // remplace la propriété mail
                minlenght: "Veuillez saisir une adresse mail valide",
                maxlength: "Veuillez saisir une adresse mail valide"
            },
            pseudo: {
                required: "Veuillez saisir votre pseudo",
                maxlength: "Veuillez saisir un pseudo moins long",
                remote: "Ce pseudo est déjà pris !"
            },
            password: {
                required: "Veuillez saisir votre mot de passe",
                maxlength: "Veuillez saisir un mot de passe moins long"
            },
            confirmedPassword: {
                required: "Veuillez confirmer votre mot de passe",
                maxlength: "Veuillez saisir un mot de passe moins long",
                equalTo: "Veuillez saisir le même mot de passe"
            }
        }
    });
});