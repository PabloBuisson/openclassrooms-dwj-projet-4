<?php

// enregistre l'autoload
function loadClass($classname)
{
    require 'model/' . $classname . '.php';
}

spl_autoload_register('loadClass');

$commentManager = new CommentManager;

// s'il y a un article signalé
if (!empty($_GET['comment']) && !empty($_GET['article']) && $_GET['action'] == 'report') {

    $comment = new Comment([
        'id' => $_GET['comment']
    ]);
    $commentManager->report($comment);

    header('Location: view.php?id=' . $_GET['article'] . '#comments');
    exit();
}

// si l'utilisateur a posté un commentaire
if (!empty($_POST)) {
    $validation = true;

    if (empty($_POST['form-pseudo']) || empty($_POST['form-comment'])) {
        $validation = false;
    }

    if ($_POST['form-pseudo'] > 255) {
        $validation = false;
    }

    // si les champs sont remplis et conformes
    if ($validation) {

        $comment = new Comment([
            'id_article' => $_GET['id'],
            'pseudo' => $_POST['form-pseudo'],
            'comment' => $_POST['form-comment']
        ]);

        $commentManager->add($comment);
    }

    header('Location: view.php?id=' . $_GET['id'] . '#comments');
}

$articleManager = new ArticleManager(); // instanciation de la classe ArticleManager et connexion à la BDD
$article = $articleManager->get($_GET['id']);
/* var_dump($article); objet
die(); */

// récupère les commentaires postés sur l'article
$comments = $commentManager->getPosted($_GET['id']);
// var_dump($comments);
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title><?= htmlspecialchars($article->getTitle()) ?> | Le site officiel de Jean Forteroche</title>
    <link rel="stylesheet" href="css/view.css">
    <link href="https://fonts.googleapis.com/css?family=Exo:300,400,700" rel="stylesheet">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css">
</head>

<body>
    <div id="bloc-page">

        <?php include("nav.php"); ?>

        <header>
            <div class="container">
                <div class="row">
                    <div class="col-lg-12 text-center">
                        <h1 class="display-4 main-title text-center text-white d-inline-block position-relative">Billet simple pour l'Alaska</h1>
                        <h2 class="text-center text-white"><?= htmlspecialchars($article->getTitle()) ?></h2>
                    </div>
                </div>
            </div>
        </header>

        <article>
            <div class="container-fluid bg-white">
                <div class="row">
                    <div class="col-10 offset-1 mb-5 mt-5 article-content">
                        <div class="text-justify mb-5">Publié le <?= $article->getDate_creation() ?></div>
                        <div class="text-justify"><?= htmlspecialchars($article->getContent()) ?> Lorem ipsum dolor sit amet consectetur, adipisicing elit. Delectus provident quisquam error, vero ipsam suscipit, numquam et quod doloremque veritatis reprehenderit tempore aut nobis. Hic provident harum tempore saepe tempora! Lorem ipsum dolor sit amet consectetur, adipisicing elit. Ullam qui doloribus libero inventore magnam, at fuga veniam incidunt illum reprehenderit cum explicabo corporis aliquam accusamus rem sed. Fugit, perspiciatis iste? Lorem ipsum dolor sit amet consectetur adipisicing elit. Modi ab veritatis magnam, deleniti illum nostrum fugit reprehenderit cum perspiciatis perferendis expedita. Ex vitae quas unde neque eligendi iure, non placeat.</div>
                    </div>
                </div>
        </article>

        <section id="comments">
            <div class="container bg-dark">
                <div class="row">
                    <div class="col-lg-10 offset-lg-1 mb-5 mt-5">
                        <h5 class="text-center mt-4 mb-5 text-white">Commentaires</h5>
                        <?php foreach ($comments as $comment) { ?>
                            <div class="comment <?php if ($comment->getReport() > 0) { ?> reported<?php } ?>">
                                <div class="row">
                                    <div class="col-md-3">
                                        <p id="comment<?= $comment->getId() ?>" class="mt-3 ml-5"><span id="pseudo-comment"><?= htmlspecialchars($comment->getPseudo()) ?></span><br /><small class="text-muted">Publié le <?= date_format(date_create($comment->getDate_comment()), 'd/m/Y à H:i:s') ?></small></p>
                                    </div>
                                    <div class="col-md-9">
                                        <p id="comment-content" class="mt-3 ml-5 mr-5"> <?= htmlspecialchars($comment->getComment()) ?> </p>
                                    </div>
                                    <div class="col-2 col-sm-3 col-md-2 ml-5 ml-sm-auto offset-sm-8 offset-md-10 mt-3"><a href="view.php?comment=<?= $comment->getId() ?>&article=<?= $comment->getId_article() ?>&action=report" class="btn btn-danger btn-sm mr-5<?php if ($comment->getReport() > 0) { ?> disabled" aria-disabled="true" <?php } ?> role="button"><?php if ($comment->getReport() > 0) { ?> Signalé <?php } else { ?> Signaler <?php } ?></a></div>
                                </div>
                            </div>
                        <?php } ?>
                    </div>
                </div>
            </div>
        </section>

        <section id="comment-form">
            <div class="container bg-dark">
                <div class="row">
                    <div class="col-lg-10 offset-lg-1 mb-5 mt-5">
                        <h5 class="text-center mt-4 mb-5 text-white">Laisser un commentaire</h5>
                        <form action="view.php?id=<?= $article->getId() ?>" method="post">
                            <div class="form-group">
                                <label for="form-pseudo" class="text-white">Votre pseudo <span>(en moins de 255 caractères)</span></label>
                                <input type="text" class="form-control" name="form-pseudo" id="form-pseudo" placeholder="Pseudo" required>
                            </div>
                            <div class="form-group">
                                <label for="form-comment" class="text-white mt-2">Votre commentaire</label>
                                <textarea class="form-control" name="form-comment" id="form-comment" rows="3" placeholder="Commentaire" required></textarea>
                            </div>
                            <div class="col-lg-12 text-center">
                                <button type="submit" class="btn btn-primary mt-4 px-4">Envoyer</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </section>

        <?php include("footer.php"); ?>

    </div>


    <script src="https://code.jquery.com/jquery-3.1.1.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>

</html>