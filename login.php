<?php
    session_start(); // active les variables de session
    unset($_SESSION['login_error']);

    // si l'utilisateur a envoyé le formulaire
    if (isset($_POST['pseudo']) && isset($_POST['password'])) {

        // si les champs sont remplis
        if (!empty($_POST['pseudo']) && !empty($_POST['password'])) {

            // si les valeurs sont correctes
            if (strlen($_POST['pseudo']) <= 100 && strlen($_POST['password']) <= 100) {

                // connexion à la base de données pour récupérer les identifiants
                try {
                    $bdd = new PDO('mysql:host=localhost;dbname=blog_forteroche;charset=utf8', 'root', '', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION)); // affiche des erreurs plus précises)
                } catch (Exception $e) {
                    die('Erreur : ' . $e->getMessage());
                }

                // récupération de l'utilisateur et de son mot de passe hâché
                $req = $bdd->prepare('SELECT id, pass FROM users WHERE pseudo = ?');
                $req->execute(array($_POST['pseudo']));
                $result = $req->fetch();
                // comparaison du mot de passe envoyé et du mot de passe stocké
                $verifiedPassword = password_verify($_POST['password'], $result['pass']);

                    // si la recherche de pseudo n'a rien donné
                    if (!$result) {
                        $_SESSION['login_error'] = 1;
                    }
                    else
                        if ($verifiedPassword) { // si les deux mots de passe correspondent
                            $_SESSION['id'] = $result['id'];
                            header('Location: admin.php');
                        }
                        else { // s'il y a un pseudo correspondant, mais un mot de passe éronné
                            $_SESSION['login_error'] = 1;
                        }

                $req->closeCursor(); // fin de la requête 
            }
            else {
                $_SESSION['login_error'] = 1;    
            }

        }
        else {
            $_SESSION['login_error'] = 1;
        }
    }
    else {
        $_SESSION['login_error'] = 0;
    }
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Se connecter | Le site officiel de Jean Forteroche</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>

<body>

    <div class="container">

        <div class="row">
            <div class="col-md-6 offset-md-3">
                <?php if ($_SESSION['login_error'] > 0) { ?>
                    <p class="text-center text-danger mt-3">Mauvais identifiant ou mot de passe. Veuillez réessayer à nouveau.</p>
                <?php } ?>
                <form action="login.php" method="post">
                    <div class="form-group mt-5">
                        <label for="pseudo">Identifiant</label><br />
                        <input type="text" value="" class="form-control" name="pseudo" id="pseudo" placeholder="Veuillez saisir votre identifiant" required>
                    </div>
                    <div class="form-group">
                        <label for="password">Mot de passe</label>
                        <input type="password" value="" class="form-control" name="password" id="password" placeholder="Veuillez saisir votre mot de passe" required>
                    </div>
                    <div class="form-check form-check-inline d-block d-md-inline-block mt-1">
                        <input class="form-check-input" type="checkbox" name="okCookie" id="okCookie">
                        <label class="form-check-label" for="okCookie">
                            Se souvenir de moi
                        </label>
                    </div>
                    <button type="submit" class="btn btn-primary mt-3 mt-md-2 float-none float-md-right">Se connecter</button>
                </form>
            </div>
        </div>

    </div>

<script src="https://code.jquery.com/jquery-3.1.1.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>

</body>
</html>