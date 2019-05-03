<?php
session_start();

if (isset($_POST['title']) && isset($_POST['text'])) { // si l'utilisateur a posté

    if (!empty($_POST['title']) && !empty($_POST['text'])) { // si c'est rempli

        if (strlen($_POST['title']) <= 255) { // et si le titre de l'article est inférieur ou égal à 255 caractères

        // définit la variable qui indique si le billet est publié en ligne ou enregistré en brouillon
        if (isset($_POST['submit'])) {
            $online = 1;
        }
        else if (isset($_POST['draft'])) {
            $online = 0;
        }

        // connexion à la base de données sécurisée
        try {
            $bdd = new PDO('mysql:host=localhost;dbname=blog_forteroche;charset=utf8', 'root', '', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION)); // affiche des erreurs plus précises
        } 
        catch (Exception $e) {
            die('Erreur : ' . $e->getMessage());
        }

        $req = $bdd->prepare('UPDATE articles SET title = :newtitle, content = :newcontent, date_creation = NOW(), on_line = :newonline WHERE id = :idarticle') or die(print_r($bdd->errorInfo()));
        $req->execute(array(
            'newtitle' => $_POST['title'],
            'newcontent' => $_POST['text'],
            'newonline' => $online,
            'idarticle' => $_SESSION['id_article']
        ));

        // fin de la requête
        $req->closeCursor();

        // destruction de la variable de session
        unset($_SESSION['id_article']);

        // redirection vers la page d'administration
        header('Location: admin.php');
        }
        else
        {
            $_SESSION['article_error'] = 2; // titre trop long
        }
    }
    else {
        $_SESSION['article_error'] = 1; // message vide
    }
} 
else {
    // l'utilisateur arrive sur la page
    $_SESSION['article_error'] = 0;
    $_SESSION['id_article'] = $_GET['id']; // on enregistre l'ID de l'article

    // on récupère le contenu de l'article enregistré
    try {
        $bdd = new PDO('mysql:host=localhost;dbname=blog_forteroche;charset=utf8', 'root', '', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION)); // affiche des erreurs plus précises
    } 
    catch (Exception $e) {
        die('Erreur : ' . $e->getMessage());
    }

    $req = $bdd->prepare('SELECT * FROM articles WHERE id = ?');
    $req->execute(array($_GET['id']));
    $articles = $req->fetch();
}

// message indicatif à côté du titre
if ($articles['on_line'] == 0) {
    $status = 'en brouillon';
} else {
    $status = 'en ligne';
}

// messages d'erreur
switch ($_SESSION['article_error']) {
    case 1:
        $error = '<p class="text-danger">Message vide !</p>';
        break;
    case 2:
        $error = '<p class="text-danger">Titre trop long !</p>';
        break;
}

?>


<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Modifier un article</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>
<body>
    <div class="container" id="bloc_page">
        <h1 class="mt-3 mb-5">Modifier un article <span class="text-muted">(<?= $status ?>)</span></h1>
        <?php if ($_SESSION['article_error'] > 0) {
            echo $error;
        }
        ?>
        <form action="update_article.php" method="post">
            <div class="form-group">
                <label for="title">Titre <small id="pseudodHelpBlock" class="text-muted">(Privilégiez un titre court et pertinent)</small></label><br />
                <input type="text" class="form-control" name="title" id="title" placeholder="Saisissez votre titre ici" aria-describedby="pseudodHelpBlock" value="<?= htmlspecialchars($articles['title']) ?>" required /><br />
            </div>
            <div class="form-group">
                <label for="text">Texte</label><br />
                <textarea name="text" class="form-control" id="text" rows="10" placeholder="Saisissez votre texte ici" required ><?= htmlspecialchars($articles['content']) ?></textarea><br />
            </div>
            <button type="submit" name="submit" class="btn btn-primary float-right">Publier en ligne</button>
            <button type="submit" name="draft" class="btn btn-outline-secondary float-right mr-3">Sauvegarder en brouillon</button>
        </form>
    </div>

    <script src="https://code.jquery.com/jquery-3.1.1.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>
</html>