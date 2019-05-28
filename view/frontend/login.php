<?php

/* variables à remplir */
$title = 'Se connecter';
$metaDescription = '';

/* début de la variable $content */
ob_start();
?>

<div id="login-form" class="container">

    <div class="row">
        <div class="col-md-6 offset-md-3">
            <?php if ($error) { ?>
                <p class="text-center text-danger mt-3">Mauvais identifiant ou mot de passe. Veuillez réessayer à nouveau.</p>
            <?php } ?>
            <form action="index.php?action=login" method="post">
                <div class="form-group mt-5">
                    <label for="pseudo" class="text-white">Identifiant</label><br />
                    <input type="text" value="" class="form-control" name="pseudo" id="pseudo" placeholder="Veuillez saisir votre identifiant" required>
                </div>
                <div class="form-group">
                    <label for="password" class="text-white">Mot de passe</label>
                    <input type="password" value="" class="form-control" name="password" id="password" placeholder="Veuillez saisir votre mot de passe" required>
                </div>
                <div class="form-check form-check-inline d-block d-md-inline-block mt-1">
                    <input class="form-check-input" type="checkbox" name="okCookie" id="okCookie">
                    <label class="form-check-label text-white" for="okCookie">
                        Se souvenir de moi
                    </label>
                </div>
                <button type="submit" class="btn btn-primary mt-3 mt-md-2 float-none float-md-right">Se connecter</button>
            </form>
        </div>
    </div>

</div>

<?php
$content = ob_get_clean(); // fin du contenu de la variable $content 
// appel du template
require('templateFrontend.php');
?>