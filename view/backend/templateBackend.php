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
    <meta property="og:url" content="<?= $ogUrl ?>" />
    <meta property="og:type" content="website" />
    <meta property="og:title" content="<?= $ogTitle ?>" />
    <meta property="og:description" content="<?= htmlspecialchars($ogDescription) ?>" />
    <meta property="og:image" content="https://jean-forteroche.pablobuisson.fr/public/img/jean-forteroche-social-media.jpg" />
    <!-- favicon -->
    <link rel="apple-touch-icon" sizes="180x180" href="/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="/favicon-16x16.png">
    <link rel="manifest" href="/site.webmanifest">
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
            "url": "https://jean-forteroche.pablobuisson.fr/",
            "email": "email.com"
        }
    </script>
    <script type='application/ld+json'>
        {
            "@context": "http://www.schema.org",
            "@type": "WebSite",
            "name": "<?= $ogTitle ?> | Tableau de bord : Jean Forteroche",
            "url": "<?= $ogUrl ?>"
        }
    </script>
    <script src="public/js/tinymce/tinymce.min.js"></script>
    <script>
        tinymce.init({
            selector: 'textarea',
            language: 'fr_FR',
            content_css: ['//fonts.googleapis.com/css?family=Exo:300,400,700'],
            content_style: "#tinymce {font-family: 'Exo', sans-serif !important; font-size: 18px}",
            browser_spellcheck: true,
            contextmenu: false,
            // update validation status on change
            onchange_callback: function(editor) {
                tinyMCE.triggerSave();
                $("#" + editor.id).valid();
            }
        });
    </script>
</head>

<body>

    <?= $content ?>

    <script src="https://code.jquery.com/jquery-3.1.1.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous">
    </script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous">
    </script>
    <?= $script ?>
</body>

</html>