<?php

// enregistre l'autoload
function loadClass($classname)
{
    require 'model/' . $classname . '.php';
}

spl_autoload_register('loadClass');

$error = null;

if (!empty($_POST)) // on rentre dans la condition si POST n'est pas vide
{ 
    $validation = true;

    if (empty($_POST['title']) && empty($_POST['text'])) {
        $error = 1; // message vide
        $validation = false;
    }
    if (strlen($_POST['title']) > 255) {
        $error = 2; // titre trop long
        $validation = false;
    }

    if ($validation) // si pas d'erreurs
    { 
        // définit la variable qui indique si le billet est publié en ligne ou enregistré en brouillon
        if (isset($_POST['submit'])) {
            $online = 1;
        } else if (isset($_POST['draft'])) {
            $online = 0;
        }

        // crée l'objet Article et ses valeurs
        $article = new Article([
            'title' => $_POST['title'],
            'content' => $_POST['text'],
            'on_line' => $online
        ]);

        // instanciation de la classe ArticleManager, qui lance la connexion à la BDD
        $articleManager = new ArticleManager();
        $articleManager->add($article); // ajout de l'article à la BDD

        // redirection vers la page d'administration
        header('Location: admin.php');
    }
}

switch ($error) {
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
    <title>Ajouter un article</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>

<body>
    <div class="container" id="bloc_page">
        <h1 class="mt-3 mb-5">Ajouter un nouvel article</h1>
        <?php if ($error) {
            echo $error;
        }
        ?>
        <form action="new_article.php" method="post">
            <div class="form-group">
                <label for="title">Titre <small id="pseudodHelpBlock" class="text-muted">(Privilégiez un titre court et pertinent)</small></label><br />
                <input type="text" class="form-control" name="title" id="title" placeholder="Saisissez votre titre ici" aria-describedby="pseudodHelpBlock" required /><br />
            </div>
            <div class="form-group">
                <label for="text">Texte</label><br />
                <textarea name="text" class="form-control" id="text" rows="10" placeholder="Saisissez votre texte ici" required></textarea><br />
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