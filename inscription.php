<?php
session_start();
$error = null;

if (!empty($_POST)) { // si l'utilisateur a posté le formulaire
    $validation = true;

    if (empty($_POST['mail']) || empty($_POST['pseudo']) || empty($_POST['password']) || empty($_POST['confirmedPassword'])) {
        $validation = false;
        $error = 1; // présence d'un champ vide
    }
    if (strlen($_POST['mail']) > 255 || strlen($_POST['pseudo']) > 100 || strlen($_POST['password']) > 100) {
        $validation = false;
        $error = 2; // valeur erronée d'un champ
    }
    if (($_POST['password'] !== $_POST['confirmedPassword'])) {
        $validation = false;
        $error = 3; // mauvaise confirmation de mpd
    }
    if (!(preg_match("#^[a-z0-9._-]+@[a-z0-9._-]{2,}\.[a-z]{2,4}$#", $_POST['mail']))) {
        $validation = false;
        $error = 4; // mail non conforme
    }

    if ($validation) {

        // si tout est en règle, on peut se connecter à la base de données
        try {
            $bdd = new PDO('mysql:host=localhost;dbname=blog_forteroche;charset=utf8', 'root', '', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION)); // affiche des erreurs plus précises)
        } catch (Exception $e) {
            die('Erreur : ' . $e->getMessage());
        }

        // avant d'enregister les identifiants sur la base de données, il faut vérifier s'il n'existe pas un pseudo semblable avec une requête préparée (sécurisée)
        // on passe en lowercase le pseudo rentré et la recherche de pseudo correspondant pour éviter les doublons
        $req = $bdd->prepare('SELECT pseudo FROM users WHERE LOWER(pseudo) = ?');
        $req->execute(array(strtolower($_POST['pseudo'])));
        $result = $req->fetch();
        // fin de la requête
        $req->closeCursor();

        // si la recherche ne ramène aucun résultat, alors le pseudo est libre
        if (empty($result['pseudo'])) {
            // hachage du mot de passe saisi
            $hashedPassword = password_hash($_POST['password'], PASSWORD_DEFAULT);

            // envoi des valeurs sur la base de données, en deux temps (sécurisé grâce à une requête séparée)
            $req = $bdd->prepare('INSERT INTO users(pseudo, pass, mail, date_inscription) VALUES(?, ?, ?, CURDATE())');
            $req->execute(array($_POST['pseudo'], $hashedPassword, $_POST['mail']));

            // fin de la requête
            $req->closeCursor();

            // redirection vers la page de connexion
            header('Location: login.php');
        } else {
            $error = 5; // pseudo déjà pris
        }
    }
}


switch ($error) {
    case 1:
        $error = '<p class="text-center text-danger">Une ou plusieurs cases n\'ont pas été remplies</p>';
        break;
    case 2:
        $error = '<p class="text-center text-danger">Valeur(s) incorrecte(s)</p>';
        break;
    case 3:
        $error = '<p class="text-center text-danger">Mauvaise confirmation de mot de passe</p>';
        break;
    case 4:
        $error = '<p class="text-center text-danger">Adresse mail incorrecte</p>';
        break;
    case 5:
        $error = '<p class="text-center text-danger">Pseudo déjà pris !</p>';
        break;
}
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
                <?php if ($error) {
                    echo $error;
                } ?>
                <form id="form-inscription" action="inscription.php" method="post">
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
    <script src="js/inscription.js"></script>
</body>

</html>