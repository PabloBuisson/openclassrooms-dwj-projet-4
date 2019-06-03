<?php

/* variables à remplir */
$title = htmlspecialchars($article->getTitle());
$metaDescription = "Plongez dans l'un des chapitres du nouveau roman interactif de Jean Forteroche, intitulé \"Billet simple pour l'Alaska\" et publié en ligne.";
$ogUrl = 'http://jean-forteroche.pablobuisson.fr/?action=view$id=' . $article->getId();
/* No more 65 words */
$ogTitle = htmlspecialchars($article->getTitle());
/* 150-200 words */
$ogDescription = "Plongez dans l'un des chapitres du nouveau roman interactif de Jean Forteroche, intitulé \"Billet simple pour l'Alaska\" et publié en ligne.";

/* début de la variable $content */
ob_start();
?>

<header id="view-header">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 text-center">
                <h1 class="display-4 main-title text-center text-white d-inline-block position-relative">Billet simple pour l'Alaska</h1>
                <h2 class="text-center text-white"><?= htmlspecialchars($article->getTitle()) ?></h2>
            </div>
        </div>
    </div>
</header>

<article id="view-article">
    <div class="container-fluid bg-white">
        <div class="row">
            <div class="col-10 offset-1 mb-5 mt-5 article-content">
                <div class="text-justify mb-5">Publié le <?= $article->getDate_creation() ?></div>
                <div class="text-justify article-text"><?= htmlspecialchars_decode($article->getContent()) ?> Lorem ipsum dolor sit amet consectetur, adipisicing elit. Delectus provident quisquam error, vero ipsam suscipit, numquam et quod doloremque veritatis reprehenderit tempore aut nobis. Hic provident harum tempore saepe tempora! Lorem ipsum dolor sit amet consectetur, adipisicing elit. Ullam qui doloribus libero inventore magnam, at fuga veniam incidunt illum reprehenderit cum explicabo corporis aliquam accusamus rem sed. Fugit, perspiciatis iste? Lorem ipsum dolor sit amet consectetur adipisicing elit. Modi ab veritatis magnam, deleniti illum nostrum fugit reprehenderit cum perspiciatis perferendis expedita. Ex vitae quas unde neque eligendi iure, non placeat.</div>
            </div>
        </div>
</article>

<section id="comments">
    <div class="container bg-dark">
        <div class="row">
            <div class="col-lg-10 offset-lg-1 mb-5 mt-5">
                <h5 class="text-center mt-4 mb-5 text-white">Commentaires</h5>
                <?php if (empty($comments)) { ?><p class="text-center text-white">Pas de commentaires à afficher. Laissez le vôtre !</p><?php } ?>
                <?php foreach ($comments as $comment) { ?>
                    <div class="comment <?php if ($comment->getReport() > 0) { ?> reported<?php } ?>">
                        <div class="row">
                            <div class="col-md-3">
                                <p id="comment<?= $comment->getId() ?>" class="mt-3 ml-5"><span id="pseudo-comment"><?= htmlspecialchars($comment->getPseudo()) ?></span><br /><small class="text-muted">Publié le <?= date_format(date_create($comment->getDate_comment()), 'd/m/Y à H:i:s') ?></small></p>
                            </div>
                            <div class="col-md-9">
                                <p id="comment-content" class="mt-3 ml-5 mr-5"> <?= htmlspecialchars($comment->getComment()) ?> </p>
                            </div>
                            <div class="col-2 col-sm-3 col-md-2 ml-5 ml-sm-auto offset-sm-8 offset-md-10 mt-3"><a href="index.php?action=view&comment=<?= $comment->getId() ?>&article=<?= $comment->getId_article() ?>&event=report" class="btn btn-danger btn-sm mr-5<?php if ($comment->getReport() > 0) { ?> disabled" aria-disabled="true" <?php } ?> role="button"><?php if ($comment->getReport() > 0) { ?> Signalé <?php } else { ?> Signaler <?php } ?></a></div>
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
                <form id="form-comment" action="index.php?action=view&id=<?= $article->getId() ?>" method="post">
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

<?php
$content = ob_get_clean(); // fin du contenu de la variable $content
$script = '<script src="public/js/comment.js"></script>';
// appel du template
require('templateFrontend.php');
?>