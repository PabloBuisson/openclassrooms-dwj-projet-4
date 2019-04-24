<?php
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

    // si la recherche n'a rien donné
    if (!$result) {
        echo '<p>Mauvais identifiant ou mot de passe.</p>';
        session_start();
        $_SESSION['login_error'] = 1;
        header('Location: login.php');
        exit();
    }
    else {
        if ($verifiedPassword) { // si les deux mots de passe correspondent
            session_start();
            $_SESSION['id'] = $result['id'];
            $_SESSION['pseudo'] = $_POST['pseudo'];
            
            if (isset($_POST['okCookie'])) { // si l'utilisateur a coché l'option cookie
                setcookie('pseudo', htmlspecialchars($_POST['pseudo']), time() + 365*24*60*60, null, null, false, true); // initialise le cookie pour le pseudo (avec sécurité)
                setcookie('password', htmlspecialchars($_POST['password']), time() + 365*24*60*60, null, null, false, true); // initialiser le cookie pour le mot de passe (avec sécurité)
            }
        }
        else {
            echo '<p>Mauvais identifiant ou mot de passe.</p>';
            session_start();
            $_SESSION['login_error'] = 1;
            header('Location: login.php');
            exit();
        }
    }
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Bienvenue sur votre tableau de bord</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>

<body>
    <div class="container">
            <h1>Bienvenue sur votre tableau de bord</h1>
            <p>Vous retrouverez ici...</p>
    </div>

    <script src="https://code.jquery.com/jquery-3.1.1.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>
</html>