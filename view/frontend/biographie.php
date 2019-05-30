<?php

/* variables à remplir */
$title = 'Biographie';
$metaDescription = '';

/* début de la variable $content */
ob_start();
?>

<header id="biographie-header">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 text-center">
                <h1 class="display-4 main-title text-center text-white d-inline-block position-relative">Jean Forteroche</h1>
                <h2 class="text-center text-white">Écrivain, animateur, dompteur de phoques</h2>
            </div>
        </div>
    </div>
</header>

<article id="biographie-article">
    <div class="container-fluid">
        <div class="row">
            <div class="col-3 offset-1 text-justify article-picture">
                <img src="public/img/jean-forteroche-portrait.jpg" class="img-responsive" alt="Photo de Jean Forteroche" />
            </div>
        </div>
    </div>
    <div class="container-fluid bg-white pt-5 pb-5">
        <div class="row">
            <div class="col-6 offset-5 text-justify article-content">
                Il est de notoriété publique que Jean Rochefort n'aime guère parler de lui, qui plus est à la troisième personne du singulier. Seulement, dans la mesure où la page que vous parcourez s'intitule sobrement "Biographie", nous serions bien embêtés si je décidais de ne pas honorer le contrat qui vous a précisément amené ici. J'en suis tout à fait capable, n'en doutez pas, cher lecteur avisé. Et je pourrais continuer des heures durant à deviser sur le bien-fondé de ma pudeur, ou encore sur le fameux contrat qui m'oblige à temporairement la souiller. <br />
                C'est pour cette raison que je m'adresserai à vous comme je m'adresserai à un vieil ami. On a plus grand chose à cacher à un vieil ami, si ce n'est cette part de mystère qui vous rend irristiblement intéressant. Car celui qui aime parler de lui suscitera très vite le désintérêt, et celui qui ne dit rien, l'ennui. Il vaut savoir distribuer avec minutie les parcelles de son histoire, et c'est bien là tout l'art de l'écrivain, et de façon générale, l'art de la communication.<br />
                Ainsi, mon vieil ami, il ne vous a pas échappé que je suis écrivain et qu'en qualité d'écrivain, j'écris des livres, dans lesquels je transpose mon goût pour l'absurbe et les personnages pittoresques. Certains appeleront cela une signature, d'autres une façon de cacher l'angoisse de la médiocrité.<br />
                Il est d'usage de citer les créations qui m'ont permis de vivre de mon métier, alors je me permettrais d'évoquer "Double meurtre à Doubleville" (1993), "L'homme qui parlait aux truites" (1997), "Le burn-out de l'épouvantail" (2008) et, plus récémment, "Billet simple pour l'Alaska", un roman dont vous pourrez suivre la progression en direct sur ce blog.<br />
                Sinon, quand je n'écris pas, j'affectionne le jardinage et l'entretien de mon portager,
                pour ses vertus apaisantes, et passer du temps avec mes enfants, pour l'exact contraire.<br />
                <br />
                Bienvenue à toi, vieil ami, et bonne lecture.<br />
                <br />
                Jean Forteroche
            </div>
        </div>
    </div>
</article>
<?php
$content = ob_get_clean(); // fin du contenu de la variable $content 
// appel du template
require('templateFrontend.php');
?>