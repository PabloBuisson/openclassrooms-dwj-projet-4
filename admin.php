<?php

// enregistre l'autoload
function loadClass($classname)
{
    require 'model/' . $classname . '.php';
}

spl_autoload_register('loadClass');

session_start();

if (empty($_SESSION['id'])) {
    header('Location: login.php');
    exit(); // interrompt le reste du code
}

$articleManager = new ArticleManager(); // création de l'Article Manager pour centraliser toutes les requêtes
$commentManager = new CommentManager(); // création du Comment Manager pour centraliser toutes les requêtes

// supression d'un article
if (!empty($_GET['article']) && $_GET['action'] == 'delete')
{
    $article = new Article([
        'id' => $_GET['article']
    ]);

    $articleManager->delete($article);
}

// approbation ou supression d'un commentaire
if (!empty($_GET['comment']) && !empty($_GET['action']))
{
    if ($_GET['action'] == 'accept')
    {
        $comment = new Comment([
            'id' => $_GET['comment']
        ]);

        $commentManager->accept($comment);
    }

    if ($_GET['action'] == 'delete')
    {
        $comment = new Comment([
            'id' => $_GET['comment']
        ]);
        
        $commentManager->delete($comment);
    }
}

// récupère les articles et leurs options, du plus récent au plus daté
$articles = $articleManager->getAll();

// retourne une valeur true s'il y a des commentaires signalés
$reported = $commentManager->getReported(); 

// récupère les commentaires et leurs options, du plus récent au plus daté, en faisant une jointure pour récupérer le titre de l'article associé
$comments = $commentManager->getAll();

?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Bienvenue sur votre tableau de bord | Le site officiel de Jean Forteroche</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css">
</head>

<body>
    <div class="container">
        <div class="jumbotron">
            <h1 class="h1">Bienvenue sur votre tableau de bord ! </h1>
            <hr class="my-4" />
            <p class="lead">Vous retrouverez ici l'ensemble de vos articles et commentaires associés.</p>
            <?php if ($reported) { ?><p class="lead text-danger"><span class="fas fa-exclamation-circle"></span> Vous avez un ou plusieurs commentaires signalés. Pour les traiter, rendez-vous dans votre section "Commentaires"</p><?php } ?>
        </div>



        <h2 class="mb-4 mr-4 d-inline-block">Vos articles</h2><a href="new_article.php" class="d-inline-block btn btn-primary mb-2" role="button">Ajouter</a>
        <div class="table-responsive">
            <table id="table-blogspots" class="table table-striped table-admin">
                <thead class="thead-dark">
                    <tr>
                        <th scope="col">Titre</th>
                        <th scope="col">Date</th>
                        <th scope="col">Statut</th>
                        <th scope="col">Voir</th>
                        <th scope="col">Modifier</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    // on affiche chaque entrée une à une dans une boucle, avec htmlspecialchars pour les données publiées
                    foreach ($articles as $article) {
                        ?>
                        <!-- on ferme PHP car ce qui suit est long (pour rappel, on est dans le tbody) -->
                        <tr>
                            <th scope="row"><?= htmlspecialchars($article->getTitle()) ?></th>
                            <td>Modifié le <?= date_format(date_create($article->getDate_creation()), 'd/m/Y à H:i:s') ?></td>
                            <td>
                                <?php if ($article->getOn_line() == 1) { ?>
                                    <p>Publié <span class="fas fa-check"></span></p>
                                <?php } else { ?>
                                    <p>Brouillon</p>
                                <?php } ?>
                            </td>
                            <td>
                                <a href="view.php?id=<?= $article->getId() ?>" title="Voir l'article" class="btn btn-info"><span class="far fa-eye" role="button"></span></a>
                            </td>
                            <td>
                                <a href="update_article.php?id=<?= $article->getId() ?>" title="Modifier l'article" class="btn btn-warning" role="button"><span class="fas fa-pen"></span></a> <button type="button" title="Supprimer l'article" class="btn btn-danger" data-toggle="modal" data-target="#article<?= $article->getId() ?>"><span class="fas fa-trash-alt"></span></button>
                            </td>
                        </tr>
                        <!-- Modal du bouton supprimer -->
                        <div class="modal fade" id="article<?= $article->getId() ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLongTitle">Êtes-vous certain(e) de supprimer cet article ?</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Fermer">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Annuler</button>
                                        <a href="admin.php?article=<?= $article->getId() ?>&action=delete" class="btn btn-danger">Supprimer</a>
                                    </div>
                                </div>
                            </div>
                        </div>

                    <?php // on réouvre PHP avant de finir la boucle
                }
                ?>
                </tbody>
            </table>
        </div>

        <h2 class="mb-4">Vos commentaires</h2>
        <div class="table-responsive">
            <table id="table-comments" class="table table-striped table-admin">
                <thead class="thead-dark">
                    <tr>
                        <th scope="col">Pseudo</th>
                        <th scope="col">Date</th>
                        <th scope="col">Commentaire</th>
                        <th scope="col">Article</th>
                        <th scope="col">Voir</th>
                        <th scope="col">Modifier</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    // on affiche chaque entrée dans une boucle, avec du htmlspecialchars sur les données publiées
                    foreach ($comments as $comment) {
                        ?>
                        <!-- on ferme PHP pour la clarté du code -->
                        <tr <?php if ($comment->getReport() > 0) { ?> class="bg-warning" <?php } ?>>
                            <th scope="row"><?= htmlspecialchars($comment->getPseudo()) ?></th>
                            <td>Publié le <?= date_format(date_create($comment->getDate_comment()), 'd/m/Y à H:i:s') ?></td>
                            <td><?= substr(htmlspecialchars($comment->getComment()), 0, 50)  ?><span class="text-muted">[...]</span></td>
                            <td><?= htmlspecialchars($comment->getTitle()) ?></td>
                            <td><a href="view.php?id=<?= $comment->getId_article() ?>#comment<?= $comment->getId() ?>" title="Voir le commentaire" class="btn btn-info" role="button"><span class="far fa-eye"></span></a></td>
                            <td><?php if ($comment->getReport() > 0) { ?><a href="admin.php?comment=<?= $comment->getId() ?>&action=accept" title="Accepter le commentaire" class="btn btn-success" role="button"><span class="fas fa-check"></span></a> <?php } ?><button type="button" title="Supprimer le commentaire" class="btn btn-danger" data-toggle="modal" data-target="#comment<?= $comment->getId() ?>"><span class="fas fa-trash-alt"></span></a></td>
                        </tr>
                        <!-- Modal du bouton supprimer -->
                        <div class="modal fade" id="comment<?= $comment->getId() ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLongTitle">Êtes-vous certain(e) de supprimer ce commentaire ?</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Fermer">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Annuler</button>
                                        <a href="admin.php?comment=<?= $comment->getId() ?>&action=delete" class="btn btn-danger">Supprimer</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php // on réouvre PHP avant de finir la boucle
                }
                ?>
                </tbody>
            </table>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.1.1.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous">
    </script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous">
    </script>
    <script src="js/admin.js"></script>
</body>

</html>