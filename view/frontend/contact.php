<?php
/* variables à remplir */
$title = 'Contact';
$metaDescription = "Vous recherchez une information, vous avez une demande particulière ? Contactez directement Jean Forteroche en remplissant notre formulaire de contact.";
$ogUrl = 'https://jean-forteroche.pablobuisson.fr/index.php?action=contact';
/* No more 65 words */
$ogTitle = 'Contactez Jean Forteroche';
/* 150-200 words */
$ogDescription = "Vous rechechez une information, vous avez une demande particulière ? Contactez directement Jean Forteroche en remplissant notre formulaire de contact.";
/* début de la variable $content */
ob_start();
?>

<header id="contact-header">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 text-center">
                <h1 class="display-4 main-title text-center text-white d-inline-block position-relative">Contactez-moi</h1>
            </div>
            <div class="col-lg-10 offset-lg-1 col-xl-8 offset-xl-2 text-center">
                <p id="text-form" class="text-center text-white">Adressez votre demande via le formulaire de contact ci-dessous et je vous répondrai dans les plus brefs délais !</p>
            </div>
        </div>
    </div>
</header>

<!-- Modal de l'alerte après l'envoi réussi du mail -->
<div class="modal fade <?php if ($success) { ?>success<?php } ?>" id="after-email" tabindex="-1" role="dialog" aria-labelledby="votre mail a bien été envoyé" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalAlertEmail"><?= $success ?></h5>
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

<section id="contact-form">
    <div class="container bg-dark">
        <div class="row">
            <div class="px-sm-5 px-lg-0 col-lg-10 offset-lg-1 mb-5 mt-5">
                <h5 class="text-center mt-5 mb-5 text-white">Formulaire de contact</h5>
                <form id="form-contact" action="index.php?action=contact" method="post">
                    <div class="form-row">
                        <div class="form-group col-12 col-md-6">
                            <label for="form-firstname" class="text-white">Votre prénom</label>
                            <input type="text" class="form-control" name="form-firstname" id="form-firstname" placeholder="Prénom" required>
                        </div>
                        <div class="form-group col-12 col-md-6">
                            <label for="form-name" class="text-white">Votre nom</label>
                            <input type="text" class="form-control" name="form-name" id="form-name" placeholder="Nom" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="form-mail" class="text-white">Votre adresse e-mail</label>
                        <input type="email" class="form-control" name="form-mail" id="form-mail" placeholder="votre_adresse@mail.com" required>
                    </div>
                    <div class="form-group">
                        <label for="form-subject" class="text-white">Objet du message <span>(en moins de 255 caractères)</span></label>
                        <input type="text" class="form-control" name="form-subject" id="form-subject" placeholder="Objet du message" required>
                    </div>
                    <div class="form-group">
                        <label for="form-message" class="text-white mt-2">Votre message</label>
                        <textarea class="form-control" name="form-message" id="form-message" rows="3" placeholder="Votre message" required></textarea>
                    </div>
                    <div class="form-check text-center mt-4">
                        <input class="form-check-input" type="checkbox" name="request-check" id="request-check">
                        <label class="form-check-label text-white" for="request-check">
                            Je ne suis pas un Robot ♪
                        </label>
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
$script = '<script src="public/js/contact.js"></script>';
// appel du template
require('templateFrontend.php');
?>