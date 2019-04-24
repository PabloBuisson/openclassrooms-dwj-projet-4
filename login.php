<?php
    session_start(); // active les variables de session

    if (empty($_SESSION['login_error'])) {
        $loginError = false;
    }
    else if ($_SESSION['login_error'] > 0) {
        $loginError = true;
    }

    if (empty($_COOKIE['pseudo']) && empty($_COOKIE['password'])) { // s'il n'y a pas de cookies
        $pseudo = NULL;
        $password = NULL;
    }
    else { // s'il y a des cookies
        $pseudo = $_COOKIE['pseudo'];
        $password = $_COOKIE['password'];
    }

    // détruit la variable de mauvaise connexion (en cas de rafraîchissement de page)
    unset($_SESSION['login_error']);
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
                <?php
                    if ($loginError) {
                         echo '<p class="text-center text-danger mt-3">Mauvais identifiant ou mot de passe. Veuillez réessayer à nouveau.</p>';
                    };
                ?>
                <form action="admin.php" method="post">
                    <div class="form-group mt-5">
                        <label for="pseudo">Identifiant</label><br />
                        <input type="text" value="<?php echo $pseudo; ?>" class="form-control" name="pseudo" id="pseudo" placeholder="Veuillez saisir votre identifiant" required>
                    </div>
                    <div class="form-group">
                        <label for="password">Mot de passe</label>
                        <input type="password" value="<?php echo $password; ?>" class="form-control" name="password" id="password" placeholder="Veuillez saisir votre mot de passe" required>
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