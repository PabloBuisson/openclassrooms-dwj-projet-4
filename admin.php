<?php
    session_start();
    
    if (empty($_SESSION['id'])) {
        header('Location: login.php');
    }

    try {
        $bdd = new PDO('mysql:host=localhost;dbname=blog_forteroche;charset=utf8', 'root', '', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION)); // affiche des erreurs plus précises)
    } catch (Exception $e) {
        die('Erreur : ' . $e->getMessage());
    }

    // on récupère les articles et leurs options, du plus récent au plus daté
    $articles = $bdd->query('SELECT id, title, DATE_FORMAT(date_creation, "Modifié le %d/%m/%Y à %H:%i:%s") AS date_blog, on_line FROM articles ORDER BY date_creation DESC');

    // on récupère les commentaires et leurs options, du plus récent au plus daté, en faisant une jointure pour récupérer le titre de l'article associé
    $comments = $bdd->query('SELECT comments.id, id_article, pseudo, comment, DATE_FORMAT(date_comment, "Publié le %d/%m/%Y à %H:%i:%s") AS date_com_blog, articles.title
    FROM comments
    INNER JOIN articles ON comments.id_article = articles.id
    ORDER BY date_comment DESC');
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Bienvenue sur votre tableau de bord | Le site officiel de Jean Forteroche</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css">
</head>

<body>
    <div class="container">
        <div class="jumbotron">
            <h1 class="h1">Bienvenue sur votre tableau de bord ! </h1>
            <hr class="my-4" />
            <p class="lead">Vous retrouverez ici l'ensemble de vos articles et commentaires associés.</p>
        </div>
            <h2 class="mb-4">Vos articles</h2>
            <div class="table-responsive-lg">
                <table id="table-blogspots" class="table table-striped table-admin">
                    <thead class="thead-dark">
                        <tr>
                            <th scope="col">Titre</th>
                            <th scope="col">Date</th>
                            <th scope="col">Statut</th>
                            <th scope="col">Voir</th>
                            <th scope="col">Modifier</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            // on affiche chaque entrée une à une dans une boucle, avec htmlspecialchars pour les données publiées
                            while ($result = $articles->fetch()) {
                        ?> <!-- on ferme PHP car ce qui suit est long (pour rappel, on est dans le tbody) -->
                                <tr>
                                    <th scope="row"><?= htmlspecialchars($result['title']); ?></th>
                                    <td><?= htmlspecialchars($result['date_blog']) ?></td>
                                    <td>
                                        <?php if ($result['on_line'] == 1) { ?>
                                                <p>Publié <span class="fas fa-check"></span></p>
                                        <?php } else { ?>
                                                <p>Brouillon</p>
                                        <?php } ?>
                                    </td>
                                    <td>
                                        <a href="view.php?id=<?= $result['id'] ?>" class="btn btn-info"><span class="far fa-eye"></span></a>
                                    </td>
                                    <td>
                                        <a href="#" class="btn btn-warning"><span class="fas fa-pen"></span></a> <a href="#" class="btn btn-danger"><span class="fas fa-trash-alt"></span></a>
                                    </td>
                                </tr>
                        <?php // on réouvre PHP avant de finir la boucle
                            }
                            $articles->closeCursor();
                        ?>
                    </tbody>
                </table>
            </div>

            <h2 class="mb-4">Vos commentaires</h2>
            <div class="table-responsive-lg">
                <table id="table-comments" class="table table-striped table-admin">
                    <thead class="thead-dark">
                        <tr>
                            <th scope="col">Pseudo</th>
                            <th scope="col">Date</th>
                            <th scope="col">Commentaire</th>
                            <th scope="col">Article</th>
                            <th scope="col">Voir</th>
                            <th scope="col">Supprimer</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            // on affiche chaque entrée dans une boucle, avec du htmlspecialchars sur les données publiées
                            while ($result = $comments->fetch()) {
                        ?><!-- on ferme PHP pour la clarté du code -->
                            <tr>
                                <th scope="row"><?= htmlspecialchars($result['pseudo']); ?></th>
                                <td><?= htmlspecialchars($result['date_com_blog']); ?></td>
                                <td><?= htmlspecialchars($result['comment']); ?></td>
                                <td><?= htmlspecialchars($result['title']); ?></td>
                                <td><a href="#" class="btn btn-info"><span class="far fa-eye"></span></a></td>
                                <td><a href="#" class="btn btn-danger"><span class="fas fa-trash-alt"></span></a></td>
                            </tr>
                        <?php // on réouvre PHP avant de finir la boucle
                            }
                            $comments->closeCursor();
                        ?>
                    </tbody>
                </table>
            </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.1.1.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <script src="js/admin.js"></script>
</body>
</html>