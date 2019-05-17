<?php
// connexion à la base de données pour récupérer les articles
try {
    $bdd = new PDO('mysql:host=localhost;dbname=blog_forteroche;charset=utf8', 'root', '', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION)); // affiche des erreurs plus précises)
} catch (Exception $e) {
    die('Erreur : ' . $e->getMessage());
}

// on récupère les articles [en ligne], du plus plus daté au plus récent (ordre logique des chapitres)
$articles = $bdd->query("SELECT id, title, content, DATE_FORMAT(date_creation, '%d/%m/%Y') AS date_blog, on_line FROM articles WHERE on_line = 1 ORDER BY date_creation");
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Billet simple pour l'Alaska | Le site officiel de Jean Forteroche</title>
    <link rel="stylesheet" href="css/billet-simple.css">
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
                        <h1 class="display-4 main-title text-center text-white d-inline-block position-relative">Billet simple pour l'Alaska</h1>
                        <h2 class="text-center text-white">Les Chapitres</h2>
                    </div>
                </div>
            </div>
        </header>

        <section>
            <div class="container bg-white">
                <div class="row">
                    <div class="col-10 offset-1 mb-5 mt-5">
                        <?php while ($result = $articles->fetch()) {
                            ?>
                            <article class="mb-5">
                                <h3><?= htmlspecialchars($result['title']) ?></h3>
                                <p>Publié le <?= $result['date_blog'] ?></p>
                                <p><?= substr(htmlspecialchars($result['content']), 0, 250) ?>[...]</p>
                                <a href="view.php?id=<?= $result['id'] ?>" title="Lire la suite de l'article" class="btn btn-primary" role="button">Lire la suite</a>
                            </article>
                        <?php
                    }
                    ?>
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

</html>