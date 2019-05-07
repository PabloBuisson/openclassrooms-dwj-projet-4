<?php

// connexion à la base de données pour récupérer les identifiants
try {
    $bdd = new PDO('mysql:host=localhost;dbname=blog_forteroche;charset=utf8', 'root', '', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION)); // affiche des erreurs plus précises)
} catch (Exception $e) {
    die('Erreur : ' . $e->getMessage());
}

// récupération de l'article via son ID
$queryArticles = $bdd->prepare('SELECT * FROM articles WHERE id = ?');
$queryArticles->execute(array($_GET['id']));
$article = $queryArticles->fetch();

$queryComments = $bdd->prepare('SELECT id, id_article, pseudo, comment, DATE_FORMAT(date_comment, "Publié le %d/%m/%Y à %H:%i:%s") AS date_com FROM comments WHERE id_article = ? ORDER BY date_comment DESC');
$queryComments->execute(array($_GET['id']));
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title><?= htmlspecialchars($article['title']) ?> | Le site officiel de Jean Forteroche</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css">
</head>

<body>
    <div class="container">
        <header class="row">
            <div class="col-lg-12">
                <h1 class="text-center mt-4"><?= htmlspecialchars($article['title']) ?></h1>
            </div>
        </header>
        <div class="row">
            <div class="col-lg-10 offset-lg-1 mb-5">
                <hr />
                <article class="text-justify"><?= htmlspecialchars($article['content']) ?> Lorem ipsum dolor sit amet consectetur, adipisicing elit. Delectus provident quisquam error, vero ipsam suscipit, numquam et quod doloremque veritatis reprehenderit tempore aut nobis. Hic provident harum tempore saepe tempora! Lorem ipsum dolor sit amet consectetur, adipisicing elit. Ullam qui doloribus libero inventore magnam, at fuga veniam incidunt illum reprehenderit cum explicabo corporis aliquam accusamus rem sed. Fugit, perspiciatis iste? Lorem ipsum dolor sit amet consectetur adipisicing elit. Modi ab veritatis magnam, deleniti illum nostrum fugit reprehenderit cum perspiciatis perferendis expedita. Ex vitae quas unde neque eligendi iure, non placeat.</article>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-8 offset-lg-2">
                <hr />
                <h3 class="text-center mt-4 mb-3">Commentaires</h3>
                <?php while ($comments = $queryComments->fetch()) { ?>
                    <p class="text-center" id="comment<?= $comments['id'] ?>"><strong><?= htmlspecialchars($comments['pseudo']) ?></strong> : <?= $comments['comment']; ?> <small class="text-muted"><?= htmlspecialchars($comments['date_com']) ?></small></p>
                <?php } ?>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.1.1.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>

</html>