<?php

if (empty($_SESSION['id'])) {
    $connected = false;
} else {
    $connected = true;
}
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <title><?= $title ?> | Le site officiel de Jean Forteroche</title>
    <meta name="description" content="<?= $metaDescription ?>" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <!-- meta réseaux sociaux -->
    <meta name="twitter:card" content="summary" />
    <meta property="og:url" content="http://location-velo-toulouse.pablobuisson.fr/" />
    <meta property="og:type" content="website" />
    <meta property="og:title" content="Réservez votre vélo en libre service à Toulouse" />
    <meta property="og:description" content="Consultez notre carte de location de vélos sur Toulouse et réservez votre vélo dans la station la plus proche" />
    <meta property="og:image" content="http://location-velo-toulouse.pablobuisson.fr/img/carte-location-velo-fb.jpg" />
    <!-- favicon -->
    <link rel="shortcut icon" type="image/x-icon" href="/favicon.ico" />
    <!-- règles CSS et CDN -->
    <!-- <link rel="stylesheet" href="../../public/css/frontend.css"> essai en local -->
    <link rel="stylesheet" href="public/css/frontend.css">
    <link href="https://fonts.googleapis.com/css?family=Exo:300,400,700" rel="stylesheet">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css">
    <!-- SEO JSON -->
    <script type='application/ld+json'>
        {
            "@context": "http://www.schema.org",
            "@type": "person",
            "name": "Jean Forteroche",
            "jobTitle": "Writer",
            "url": "url.com",
            "email": "email.com"
        }
    </script>
    <script type='application/ld+json'>
        {
            "@context": "http://www.schema.org",
            "@type": "WebSite",
            "name": "Bienvenue sur le site officiel de Jean Forteroche",
            "url": "url.com"
        }
    </script>
</head>

<body>
    <div id="bloc-page">

        <nav id="navbar-example2" class="navbar navbar-expand-md navbar-dark bg-dark fixed-top">
            <!-- le navbar-expand-md permet de décider quand le menu collapse -->
            <div class="container">
                <a class="navbar-brand text-white-50 text-uppercase" href="index.php?action=home">Jean Forteroche</a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarToggler" aria-controls="navbarToggler" aria-expanded="false" aria-label="Toggle navigation"> <span class="navbar-toggler-icon"></span></button>
                <ul class="nav collapse navbar-collapse flex-sm-column flex-md-row justify-content-md-end align-items-sm-start" id="navbarToggler">
                    <li class="nav-item">
                        <a class="nav-link text-white text-uppercase" href="index.php?action=home">Accueil</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-white text-uppercase" href="index.php?action=biographie">Biographie</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-white text-uppercase" href="index.php?action=billetSimple">Billet simple</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-white text-uppercase" href="index.php?action=contact">Contact</a>
                    </li>
                    <?php if ($connected) { ?>
                        <li class="nav-item">
                            <a class="nav-link text-white text-uppercase" href="index.php?action=admin"><span class="fas fa-user-circle"></span> Admin</a>
                        </li>
                    <?php
                }
                ?>
                </ul>
            </div>
        </nav>

        <?= $content ?>

        <footer>
            <div class="container">
                <div class="row">
                    <div class="col-lg-4">
                        <h5 class="text-uppercase">Plan du site</h5>
                        <div>
                            <a href="index.php?action=home" class="text-white">Accueil</a><br />
                            <a href="index.php?action=biographie" class="text-white">Biographie</a><br />
                            <a href="index.php?action=billetSimple" class="text-white">Billet Simple</a><br />
                            <a href="index.php?action=contact" class="text-white">Contact</a>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <h5 class="text-uppercase">Me retrouver sur</h5>
                        <div>
                            <a href="#" class="text-white">Facebook</a><br />
                            <a href="#" class="text-white">Twitter</a><br />
                            <a href="#" class="text-white">Senscritique</a>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <h5 class="text-uppercase">Admin</h5>
                        <div>
                            <a href="index.php?action=login" class="text-white">Se connecter</a>
                        </div>
                    </div>
                </div>
            </div>
        </footer>
    </div>

    <script src="https://code.jquery.com/jquery-3.1.1.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <?php if (!empty($script)) { echo $script; } ?>
</body>

</html>