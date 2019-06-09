<?php

/* variables à remplir */
$title = 'Se connecter';
$metaDescription = "Connectez-vous avec vos idenfifiants pour profiter des fonctionnalités du blog de Jean Forteroche.";
$ogUrl = 'https://jean-forteroche.pablobuisson.fr/index.php?action=login';
/* No more 65 words */
$ogTitle = 'Se connecter au blog de Jean Forteroche';
/* 150-200 words */
$ogDescription = "Connectez-vous avec vos idenfifiants pour profiter des fonctionnalités du blog de Jean Forteroche.";

/* début de la variable $content */
ob_start();
?>

<section id="login-form">

    <div class="container">
        <div class="row">
            <div class="col-md-6 offset-md-3 login-content pb-5 px-5">
                <form action="index.php?action=login" method="post">
                    <div class="form-group mt-5">
                        <?php if ($error) { ?>
                            <p class="text-center text-danger mt-3">Mauvais identifiant ou mot de passe. Veuillez réessayer à nouveau.</p>
                        <?php } ?>
                        <label for="pseudo" class="text-white">Identifiant</label><br />
                        <input type="text" value="" class="form-control" name="pseudo" id="pseudo" placeholder="Veuillez saisir votre identifiant" required>
                    </div>
                    <div class="form-group">
                        <label for="password" class="text-white">Mot de passe</label>
                        <input type="password" value="" class="form-control" name="password" id="password" placeholder="Veuillez saisir votre mot de passe" required>
                    </div>
                    <div class="text-center">
                        <button type="submit" class="btn btn-primary mt-3 float-none float-md-right">Se connecter</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

</section>

<?php
$content = ob_get_clean(); // fin du contenu de la variable $content 
// appel du template
require('templateFrontend.php');
?>