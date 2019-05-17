<?php

if (!empty($_POST)) {
    $validation = true;

    if (empty($_POST['form-firstname']) || empty($_POST['form-name']) || empty($_POST['form-mail']) || empty($_POST['form-subject']) || empty($_POST['form-message'])) {
        $validation = false;
    }
    if ($_POST['form-firstname'] > 255 || $_POST['form-name'] > 255 || $_POST['form-subject'] > 255) {
        $validation = false;
    }
    if (!preg_match("#^[a-z0-9._-]+@[a-z0-9._-]{2,}\.[a-z]{2,4}$#", $_POST['form-mail'])) {
        $validation = false;
    }
    if (empty($_POST['request-check'])) {
        $validation = false;
    }

    // si toutes les conditions sont remplies, on peut envoyer le mail
    if ($validation) {
        $to = "pablo.buisson@gmail.com";
        $subject = $_POST['form-subject'];
        // Si les lignes ont plus de 70 cactères, on utilise wordwrap()
        $message = wordwrap($_POST['form-message'], 70, "\r\n");
        $headers = "From:" . htmlspecialchars($_POST['form-firstname']) . " " . htmlspecialchars($_POST['form-name']) . "<" . htmlspecialchars($_POST['form-mail']) . ">\r\n";
        $headers .= "Reply-to:" . htmlspecialchars($_POST['form-mail']) . "\r\n";
        $headers .= "Content-type: text/html\r\n";
        $success = mail($to, $subject, $message, $headers);
        if (!$success) {
            $errorMessage = error_get_last()['message'];
            print_r(error_get_last());
            echo '<p class="text-danger">Problème de envoi</p>';
        }
    }
    else {
        echo '<p class="text-danger">Problème de champ</p>';
    }
}

?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Contactez-moi | Le site officiel de Jean Forteroche</title>
    <link rel="stylesheet" href="css/contact.css">
    <link href="https://fonts.googleapis.com/css?family=Exo:300,400,700" rel="stylesheet">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css">
</head>

<body>
    <div id="bloc-page">

        <?php include("nav.php"); ?>

        <header>
            <div class="container">
                <div class="row">
                    <div class="col-lg-12 text-center">
                        <h1 class="display-4 main-title text-center text-white d-inline-block position-relative">Contactez-moi</h1>
                    </div>
                    <div class="col-lg-8 offset-2 text-center">
                        <p id="text-form" class="text-center text-white">Adressez votre demande via le formulaire de contact ci-dessous et je vous répondrai dans les plus brefs délais !</p>
                    </div>
                </div>
            </div>
        </header>

        <section id="contact-form">
            <div class="container bg-dark">
                <div class="row">
                    <div class="col-lg-10 offset-lg-1 mb-5 mt-5">
                        <h5 class="text-center mt-4 mb-5 text-white">Formulaire de contact</h5>
                        <form action="contact.php" method="post">
                            <div class="form-row">
                                <div class="form-group col-6">
                                    <label for="form-firstname" class="text-white">Votre prénom</label>
                                    <input type="text" class="form-control" name="form-firstname" id="form-firstname" placeholder="Prénom" required>
                                </div>
                                <div class="form-group col-6">
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

        <?php include("footer.php"); ?>

    </div>


    <script src="https://code.jquery.com/jquery-3.1.1.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>