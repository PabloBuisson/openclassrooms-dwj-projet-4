<?php

/* variables à remplir */
$title = 'Admin';
$metaDescription = "Bienvenue sur le tableau de bord du blog de Jean Forteroche, où vous pourrez gérer vos articles et les commentaires associés.";
$ogUrl = 'https://jean-forteroche.pablobuisson.fr/index.php?action=admin';
/* No more 65 words */
$ogTitle = 'Admin';
/* 150-200 words */
$ogDescription = "Bienvenue sur le tableau de bord du blog de Jean Forteroche, où vous pourrez gérer vos articles et les commentaires associés.";

/* début de la variable $content */
ob_start();
?>

<div class="container">
    <div class="jumbotron">
        <div class="d-flex flex-column flex-xl-row flex-wrap justify-content-between align-items-xl-center">
            <div class="d-flex flex-row justify-content-center justify-content-lg-start order-lg-1 order-xl-2 mb-4 mb-xl-0 flex-end">
                <button type="button" title="Déconnexion" class="btn btn-secondary d-inline-block mr-2" data-toggle="modal" data-target="#end-session"><span class="fas fa-power-off"></button></a><a href="index.php?action=home" class="d-inline-block btn btn-outline-secondary" role="button">Revenir sur le site</a>

                <!-- Modal du bouton déconnexion -->
                <div class="modal fade" id="end-session" tabindex="-1" role="dialog" aria-labelledby="se déconnecter de la session" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="modalEndSession">Souhaitez-vous vous déconnecter ?</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Fermer">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Annuler</button>
                                <a href="index.php?action=admin&session=end" class="btn btn-danger">Se déconnecter</a>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Modal de l'alerte après un événement -->
                <div class="modal fade <?php if ($success) { ?>success<?php } ?>" id="after-event" tabindex="-1" role="dialog" aria-labelledby="votre action a été enregistrée" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="modalAlertEvent"><?= $success ?></h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Fermer">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary close-button" data-dismiss="modal">Fermer</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <h1 class="h1 order-lg-2 order-xl-1 text-center text-lg-left">Bienvenue sur votre tableau de bord ! </h1>
        </div>

        <hr class="my-4" />
        <p class="lead text-justify">Vous retrouverez ici l'ensemble de vos articles et commentaires associés.</p>
        <?php if ($reported) { ?><p class="lead text-danger text-justify"><span class="fas fa-exclamation-circle"></span> Vous avez un ou plusieurs commentaires signalés. Pour les traiter, rendez-vous dans votre section "Commentaires"</p><?php } ?>
    </div>



    <h2 id="admin-title-article" class="mb-4 mr-4 d-inline-block">Vos articles</h2><a href="index.php?action=newArticle" class="d-inline-block btn btn-primary mb-2" role="button">Ajouter</a>
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
                        <th scope="row"><?= $article->getTitle() ?></th>
                        <td>Modifié le <?= date_format(date_create($article->getDate_update()), 'd/m/Y à H:i:s') ?></td>
                        <td>
                            <?php if ($article->getOn_line() == 1) { ?>
                                <p>Publié <span class="fas fa-check"></span></p>
                            <?php } else { ?>
                                <p>Brouillon</p>
                            <?php } ?>
                        </td>
                        <td>
                            <a href="index.php?action=view&id=<?= $article->getId() ?>" title="Voir l'article" class="btn btn-secondary"><span class="far fa-eye" role="button"></span></a>
                        </td>
                        <td>
                            <a href="index.php?action=updateArticle&id=<?= $article->getId() ?>" title="Modifier l'article" class="btn btn-info mb-2" role="button"><span class="fas fa-pen"></span></a> <button type="button" title="Supprimer l'article" class="btn btn-danger mb-2" data-toggle="modal" data-target="#article<?= $article->getId() ?>"><span class="fas fa-trash-alt"></span></button>
                        </td>
                    </tr>
                    <!-- Modal du bouton supprimer -->
                    <div class="modal fade" id="article<?= $article->getId() ?>" tabindex="-1" role="dialog" aria-labelledby="supprimer un article" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="modalDeleteArticle">Êtes-vous certain(e) de supprimer cet article ?</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Fermer">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Annuler</button>
                                    <a href="index.php?action=admin&article=<?= $article->getId() ?>&event=delete" class="btn btn-danger">Supprimer</a>
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

    <h2 id="admin-title-comment" class="mb-4">Vos commentaires</h2>
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
                        <th scope="row"><?= $comment->getPseudo() ?></th>
                        <td>Publié le <?= date_format(date_create($comment->getDate_comment()), 'd/m/Y à H:i:s') ?></td>
                        <td><?= substr($comment->getComment(), 0, 50) ?><span class="text-muted">[...]</span></td>
                        <td><?= $comment->getTitle() ?></td>
                        <td><a href="index.php?action=view&id=<?= $comment->getId_article() ?>#comment<?= $comment->getId() ?>" title="Voir le commentaire" class="btn btn-secondary" role="button"><span class="far fa-eye"></span></a></td>
                        <td><?php if ($comment->getReport() > 0) { ?><a href="index.php?action=admin&comment=<?= $comment->getId() ?>&event=accept" title="Accepter le commentaire" class="btn btn-success mb-2" role="button"><span class="fas fa-check"></span></a> <?php } ?><button type="button" title="Supprimer le commentaire" class="btn btn-danger mb-2" data-toggle="modal" data-target="#comment<?= $comment->getId() ?>"><span class="fas fa-trash-alt"></span></a></td>
                    </tr>
                    <!-- Modal du bouton supprimer -->
                    <div class="modal fade" id="comment<?= $comment->getId() ?>" tabindex="-1" role="dialog" aria-labelledby="supprimer un commentaire" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="modalDeleteComment">Êtes-vous certain(e) de supprimer ce commentaire ?</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Fermer">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Annuler</button>
                                    <a href="index.php?action=admin&comment=<?= $comment->getId() ?>&event=delete" class="btn btn-danger">Supprimer</a>
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

<?php
$content = ob_get_clean(); // fin du contenu de la variable $content
$script = '<script src="public/js/admin.js"></script>';
// appel du template
require('templateBackend.php');
?>