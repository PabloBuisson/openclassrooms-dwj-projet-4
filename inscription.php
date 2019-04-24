<?php
    session_start(); // active les variables de session

    if (empty($_SESSION['inscription_error'])) {
        $inscriptionError = false;
    }
    else if ($_SESSION['inscription_error'] > 0) {
        $inscriptionError = $_SESSION['inscription_error'];
    }

    // détruit la variable de mauvaise inscription (en cas de rafraîchissement de page)
    unset($_SESSION['inscription_error']);
?>


<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Inscription | Le site officiel de Jean Forteroche</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>

<body>
    <div class="container">
        <div class="row">
            <div class="col-md-6 offset-md-3 col-lg-4 offset-lg-4 mt-4 bg-light shadow">
                <h1 class="text-center pt-3">Lancez-vous !</h1>
                <p class="text-center text-secondary">Votre blog à portée de clics</p>
                <p class="error-message text-center text-danger"></p>
                <?php
                    if ($inscriptionError) {
                        switch ($inscriptionError) {
                            case 1:
                                echo '<p class="text-center text-danger">Une ou plusieurs cases n\'ont pas été remplies</p>';
                                break;
                            case 2:
                                echo '<p class="text-center text-danger">Valeur(s) incorrecte(s)</p>';
                                break;
                            case 3:
                                echo '<p class="text-center text-danger">Adresse mail incorrecte</p>';
                                break;
                            case 4:
                                echo '<p class="text-center text-danger">Pseudo déjà pris</p>';
                                break;
                        }
                    }
                ?>
                <form id="form-inscription" action="inscription_post.php" method="post">
                    <div class="form-group mt-4">
                        <label for="mail">Adresse mail</label><br />
                        <input type="text" class="form-control" name="mail" id="mail" placeholder="Votre adresse mail" required>
                    </div>
                    <div class="form-group">
                        <label for="pseudo">Identifiant <small id="pseudodHelpBlock" class="text-muted">(doit être inférieur à 100 caractères)</small></label><br />
                        <input type="text" class="form-control" name="pseudo" id="pseudo" placeholder="Choisissez votre identifiant" aria-describedby="pseudodHelpBlock" required>
                    </div>
                    <div class="form-group">
                        <label for="password">Mot de passe <small id="passwordHelpBlock" class="text-muted">(doit être inférieur à 100 caractères)</small></label>
                        <input type="password" class="form-control" name="password" id="password" placeholder="Créez votre mot de passe" aria-describedby="passwordHelpBlock" required>
                    </div>
                    <div class="form-group">
                        <label for="password">Confirmez votre mot de passe</label>
                        <input type="password" class="form-control" name="confirmedPassword" id="confirmed-password" placeholder="Confirmez votre mot de passe" required>
                    </div>
                    <button type="submit" class="btn btn-primary mt-4 mb-4 btn-block">Créez votre compte</button>
                </form>
            </div>
        </div>

    </div>

    <script src="https://code.jquery.com/jquery-3.1.1.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>

    <script>
        $(document).ready(function () {

            // création d'une méthode pour rendre la vérification de mail plus poussée
            $.validator.addMethod("mailverified", function (value, element, params) {
                let pattern = new RegExp(/^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/);
                return pattern.test(value);
            }, "Veuillez saisir une adresse mail valide");

            // la méthode principale de jQuey validation plugin
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
                        maxlength: 100
                    },
                    password: {
                        required: true,
                        maxlength: 100
                    },
                    confirmedPassword: {
                        required: true,
                        maxlength: 100,
                        equalTo : "#password"
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
                        maxlength: "Veuillez saisir un pseudo moins long"
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
    </script>
</body>
</html>