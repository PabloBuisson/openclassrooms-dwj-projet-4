<?php

/* variables à remplir */
$title = 'Accueil';
$metaDescription = "Bienvenue sur le site web de Jean Forteroche, écrivain. Découvrez son nouveau roman \"Billet simple pour l'Alaska\", publié en ligne.";
$ogUrl = 'https://jean-forteroche.pablobuisson.fr/';
/* No more 65 words */
$ogTitle = 'Bienvenue sur le site web de Jean Forteroche';
/* 150-200 words */
$ogDescription = "Découvrez en ligne les chapitres du nouveau roman de Jean Forteroche, \"Billet simple pour l'Alaska\".";

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
                <a href="#home-project-alaska" id="home-to-project" class="d-block d-md-inline-block btn btn-lg btn-primary mb-3" role="button">Découvrir le projet</a>
                <a href="index.php?action=billetSimple" class="d-block d-md-inline-block btn btn-lg btn-secondary mb-3" role="button">Accéder aux chapitres</a>
            </div>
        </div>
    </div>
</header>

<section id="home-project-alaska">
    <div class="container">
        <div class="row">
            <div class="text-center text-md-left col-md-6 offset-md-6">
                <h3>Billet simple pour l'Alaska : le choix d'un roman en ligne</h3>
            </div>
        </div>
        <div class="row">
            <div class="text-center text-md-left col-md-6 mb-5 mb-md-0"><img src="public/img/roman-en-ligne.jpg" class="img-responsive" alt="Un roman en ligne"></div>
            <div class="col-md-6 text-justify text-reader">À l'heure du tout connecté et de l'omniprésence des réseaux sociaux, nous (Jean Forteroche et les personnes concernées par le projet) avons décidé de transposer le nouveau récit de Jean Forteroche en ligne, sous la forme de chapitres périodiques et interactifs, afin d'établir une communication bilatérale qu'empêche le support papier. <br />
                Ce roman est un cadeau pour vous, la communauté de lecteurs qui s'est constituée au fil des histoires abracadabrantesques dont seul Jean Forteroche détient le secret. Un cadeau pour faire entendre votre voix, et pour vous récompenser de votre indéfectible loyauté.</div>
        </div>
    </div>
</section>

<section id="home-comment-alaska">
    <div class="container">
        <div class="row">
            <div class="text-center text-md-left col-md-6">
                <h3>Interagissez en direct</h3>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6 order-2 order-mb-1 text-justify text-reader">Chaque publication périodique qui composera le roman "Billet simple pour l'Alaska" sera l'occasion de faire entendre votre voix. Exprimez votre ressenti sur la progression de l'histoire, réagissez sur les décisions des personnages, proposez vos interprétations, échangez vos idées.<br />
                Au gré de la pertinence de votre commentaire, Jean Forteroche vous répondra !</div>
            <div class="text-center text-md-left col-md-6 order-1 order-mb-2 mb-5 mb-0"><img src="public/img/roman-interactif-smartphone.jpg" class="img-responsive" alt="Un roman interactif que l'on peut commenter"></div>
        </div>
    </div>
</section>

<?php
$content = ob_get_clean(); // fin du contenu de la variable $content
$script = '<script src="public/js/home.js"></script>';
// appel du template
require('templateFrontend.php');
?>