<?php

/* variables à remplir */
$title = 'Billet Simple';
$metaDescription = '';

/* début de la variable $content */
ob_start();
?>

<header id="billet-header">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 text-center">
                <h1 class="display-4 main-title text-center text-white d-inline-block position-relative">Billet simple pour l'Alaska</h1>
                <h2 class="text-center text-white">Les Chapitres</h2>
            </div>
        </div>
    </div>
</header>

<section id="billet-section">
    <div class="container bg-white">
        <div class="row">
            <div class="col-10 offset-1 mb-5 mt-5">
                <p class="lead">Retrouvez l'ensemble des chapitres qui compose le roman "Billet simple pour l'Alaska", par ordre de publication.<br />
                    <br />
                    Bonne lecture !</p>
                <hr>
                <?php foreach ($articles as $article) { ?>
                    <article class="mb-5 mt-5">
                        <h3><?= htmlspecialchars($article->getTitle()) ?></h3>
                        <p>Publié le <?= date_format(date_create($article->getDate_creation()), 'd/m/Y')  ?></p>
                        <p class="text-justify"><?= substr(htmlspecialchars($article->getContent()), 0, 250) ?>[...]</p>
                        <a href="index.php?action=view&id=<?= $article->getId() ?>" title="Lire la suite de l'article" class="btn btn-primary mb-2" role="button">Lire la suite</a>
                        <hr>
                    </article>
                <?php
            }
            ?>
            </div>
        </div>
</section>

<?php
$content = ob_get_clean(); // fin du contenu de la variable $content 
// appel du template
require('templateFrontend.php');
?>