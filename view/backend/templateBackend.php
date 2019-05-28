<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <title><?= $title ?> | Jean Forteroche - Tableau de bord </title>
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
    <link rel="stylesheet" href="public/css/backend.css">
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

    <?= $content ?>

    <script src="https://code.jquery.com/jquery-3.1.1.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous">
    </script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous">
    </script>
    <script src="public/js/admin.js"></script>
</body>

</html>