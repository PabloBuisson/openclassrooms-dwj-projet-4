<?php

/* variables à remplir */
$title = 'Accueil';
$metaDescription = '';

/* début de la variable $content */
ob_start();
?>

<header id="home-header">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 text-center">
                <h1 class="main-title text-center text-white d-inline-block position-relative">Bienvenue sur le site officiel de Jean Forteroche</h1>
            </div>
        </div>
        <div class="row home-alaska">
            <div class="col-lg-8 offset-lg-2 title-alaska">
                <h2 class="text-center text-white">Billet simple pour l'Alaska : découvrez mon nouveau roman en ligne !</h2>
            </div>
            <div class="col-lg-6 offset-lg-3 text-center">
                <a href="#home-project-alaska" class="btn btn-lg btn-primary" role="button">Découvrir le projet</a>
                <a href="index.php?action=billetSimple" class="btn btn-lg btn-secondary" role="button">Accéder aux chapitres</a>
            </div>
        </div>
    </div>
</header>

<section id="home-project-alaska">
    <div class="container">
        <div class="row">
            <div class="col-lg-6 offset-lg-6">
                <h3>Billet simple pour l'Alaska : le choix d'un roman en ligne</h3>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-6">[PHOTO] Lorem ipsum dolor sit amet, consectetur adipisicing elit. At voluptate pariatur saepe quod! Placeat error nihil optio temporibus culpa nemo ut et? Eaque blanditiis magni soluta quas animi aperiam inventore.</div>
            <div class="col-lg-6">À l'heure du tout connecté et de l'omniprésence des réseaux sociaux, nous (Jean Forteroche et les personnes concernées par le projet) avons décidé de transposer le nouveau récit de Jean Forteroche en ligne, sous la forme de chapitres périodiques et interactifs, afin d'établir une communication bilatérale qu'empêche le support papier. <br />
                Ce roman est un cadeau pour vous, la communauté de lecteurs qui s'est constituée au fil des histoires abracadabrantesques dont seul Jean Forteroche détient le secret. Un cadeau pour faire entendre votre voix, et pour vous récompenser de votre indéféctible loyauté.</div>
        </div>
    </div>
</section>

<section id="home-comment-alaska">
    <div class="container">
        <div class="row">
            <div class="col-lg-6">
                <h3>Intéragissez en direct</h3>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-6">Chaque publication périodique qui composera le roman "Billet simple pour l'Alaska" sera l'occasion de faire entendre votre voix. Exprimez votre ressenti sur la progression de l'histoire, réagissez sur les décisions des personnages, proposez vos interprétations, échangez vos idées.<br />
                Au gré de la pertinence de votre commentaire, Jean Forteroche vous répondra !</div>
            <div class="col-lg-6">[PHOTO] Lorem ipsum dolor sit, amet consectetur adipisicing elit. Odio,
                numquam illum sunt, fugit minus, nam accusantium ipsam itaque vel tenetur odit fugiat
                nostrum natus? Reprehenderit voluptatem aliquid veritatis numquam animi!</div>
        </div>
    </div>
</section>

<?php
$content = ob_get_clean(); // fin du contenu de la variable $content 
// appel du template
require('view/frontend/templateFrontend.php');
?>