<?php
    // connexion à la base de données pour récupérer les identifiants
    try {
        $bdd = new PDO('mysql:host=localhost;dbname=blog_forteroche;charset=utf8', 'root', '', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION)); // affiche des erreurs plus précises)
    } catch (Exception $e) {
        die('Erreur : ' . $e->getMessage());
    }

    // récupération de l'utilisateur et de son mot de passe hâché
    $req = $bdd->prepare('SELECT id, pass FROM users WHERE pseudo = ?');
    $req->execute(array($_POST['pseudo']));
    $result = $req->fetch();
    // comparaison du mot de passe envoyé et du mot de passe stocké
    $verifiedPassword = password_verify($_POST['password'], $result['pass']);

    // si la recherche n'a rien donné
    if (!$result) {
        echo '<p>Mauvais identifiant ou mot de passe.</p>';
        session_start();
        $_SESSION['login_error'] = 1;
        header('Location: login.php');
        exit();
    }
    else {
        if ($verifiedPassword) { // si les deux mots de passe correspondent
            session_start();
            $_SESSION['id'] = $result['id'];
            $_SESSION['pseudo'] = $_POST['pseudo'];
            
            if (isset($_POST['okCookie'])) { // si l'utilisateur a coché l'option cookie
                setcookie('pseudo', htmlspecialchars($_POST['pseudo']), time() + 365*24*60*60, null, null, false, true); // initialise le cookie pour le pseudo (avec sécurité)
                setcookie('password', htmlspecialchars($_POST['password']), time() + 365*24*60*60, null, null, false, true); // initialiser le cookie pour le mot de passe (avec sécurité)
            }
        }
        else {
            echo '<p>Mauvais identifiant ou mot de passe.</p>';
            session_start();
            $_SESSION['login_error'] = 1;
            header('Location: login.php');
            exit();
        }
    }
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
            <h1 class="h1">Bienvenue sur votre tableau de bord !</h1>
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
                            // connexion à la base de données
                            try {
                                $bdd = new PDO('mysql:host=localhost;dbname=blog_forteroche;charset=utf8', 'root', '', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION)); // affiche des erreurs plus précises)
                            } catch (Exception $e) {
                                die('Erreur : ' . $e->getMessage());
                            }

                            // on récupère les articles et leurs options, du plus récent au plus daté
                            $response = $bdd->query('SELECT id, title, DATE_FORMAT(date_creation, "Modifié le %d/%m/%Y à %H:%i:%s") AS date_blog, on_line FROM blogposts ORDER BY date_creation DESC');
                            
                            // on affiche chaque entrée une à une dans une boucle, avec htmlspecialchars pour les données publiées
                            while ($result = $response->fetch()) {
                        ?> <!-- on ferme PHP car ce qui suit est long (pour rappel, on est dans le tbody) -->
                                <tr>
                                    <th scope="row"><?php echo htmlspecialchars($result['title']); ?></th>
                                    <td><?php echo htmlspecialchars($result['date_blog']); ?></td>
                                    <td>
                                        <?php
                                            if ($result['on_line'] == 1) {
                                                $onLine = 'Publié <span class="fas fa-check"></span>';
                                            }
                                            else {
                                                $onLine = "Brouillon";
                                            }
                                            echo $onLine; 
                                        ?>
                                    </td>
                                    <td>
                                        <?php
                                            if ($result['on_line'] == 1) {
                                                echo '<button type="button" class="btn btn-info"><span class="far fa-eye"></span></button>';
                                            }
                                            else {
                                                echo "";
                                            }
                                        ?>
                                    </td>
                                    <td>
                                    <?php echo '<button type="button" class="btn btn-warning"><span class="fas fa-pen"></span></button> <button type="button" class="btn btn-danger"><span class="fas fa-trash-alt"></span></button>'; 
                                    ?>
                                    </td>
                                </tr>
                        <?php // on réouvre PHP avant de finir la boucle
                            }

                            $response->closeCursor(); // termine le traitement de la requête
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
                            // on récupère les commentaires et leurs options, du plus récent au plus daté, en faisant une jointure pour récupérer le titre de l'article associé
                            $response = $bdd->query('SELECT comments.id, id_blogpost, pseudo, comment, DATE_FORMAT(date_comment, "Publié le %d/%m/%Y à %H:%i:%s") AS date_com_blog, blogposts.title
                            FROM comments
                            INNER JOIN blogposts ON comments.id_blogpost = blogposts.id
                            ORDER BY date_comment DESC');
                            
                            /*  $response = $bdd->query('SELECT id, id_blogpost, pseudo, comment, DATE_FORMAT(date_comment, "Publié le %d/%m/%Y à %H:%i:%s") AS date_com_blog FROM comments ORDER BY date_comment DESC'); */

                            // on affiche chaque entrée dans une boucle, avec du htmlspecialchars sur les données publiées
                            while ($result = $response->fetch()) {
                        ?><!-- on ferme PHP pour la clarté du code -->
                            <tr>
                                <th scope="row"><?php echo htmlspecialchars($result['pseudo']); ?></th>
                                <td><?php echo htmlspecialchars($result['date_com_blog']); ?></td>
                                <td><?php echo htmlspecialchars($result['comment']); ?></td>
                                <td><?php echo htmlspecialchars($result['title']); ?></td>
                                <td><?php echo '<button type="button" class="btn btn-info"><span class="far fa-eye"></span></button>'; ?></td>
                                <td><?php echo '<button type="button" class="btn btn-danger"><span class="fas fa-trash-alt"></span></button>' ?></td>
                            </tr>
                        <?php // on réouvre PHP avant de finir la boucle
                            }
                        
                        $response->closeCursor(); // fin de la requête
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

    <script>
        $(document).ready(function () {
            $('.table-admin').DataTable({
                "lengthMenu": [ 5, 10, 25, 50, 75, 100 ],
                "pageLength": 5,
                "ordering": false, // supprime la possibilité de trier les entrées
                "info": false,
                "language": {
                    "lengthMenu": "Afficher  _MENU_  entrées",
                    "zeroRecords": "La recherche n'a donné aucun résultat",
                    "info": "Afficher page _PAGE_ sur _PAGES_",
                    "infoEmpty": "Aucune entrée trouvée",
                    "infoFiltered": "(filtered from _MAX_ total records)",
                    "search": "Rechercher :",
                    "paginate": {
                        "first": "Premier",
                        "last": "Dernier",
                        "next": "Suivant",
                        "previous": "Précédant"
                    },
                }
            }); 
            $('.dataTables_length').addClass('bs-select');
            $('.pagination').addClass('pagination-custom'); // add margin-top: 20px;
        });
    </script>
</body>
</html>