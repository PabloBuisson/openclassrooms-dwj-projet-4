<?php 
    // on teste si toutes les cases ont été remplies
    if (!empty($_POST['mail']) && !empty($_POST['pseudo']) && !empty($_POST['password']) && !empty($_POST['confirmedPassword'])) {

        // puis si les valeurs remplissent les conditions
        if (strlen($_POST['mail']) <= 255 && strlen($_POST['pseudo']) <= 100 && strlen($_POST['password']) <= 100 && ($_POST['password'] === $_POST['confirmedPassword'])) {

            // puis on teste la conformité de l'adresse mail
            if (preg_match("#^[a-z0-9._-]+@[a-z0-9._-]{2,}\.[a-z]{2,4}$#", $_POST['mail'])) {

                // si elle est conforme, on peut se connecter à la base de données
                try {
                    $bdd = new PDO('mysql:host=localhost;dbname=blog_forteroche;charset=utf8', 'root', '', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION)); // affiche des erreurs plus précises)
                } catch (Exception $e) {
                    die('Erreur : ' . $e->getMessage());
                }

                // avant d'enregister les identifiants sur la base de données, il faut vérifier s'il n'existe pas un pseudo semblable avec une requête préparée (sécurisée)
                // on passe en lowercase le pseudo rentré et la recherche de pseudo correspondant pour éviter les doublons
                $req = $bdd->prepare('SELECT pseudo FROM users WHERE LOWER(pseudo) = ?');
                $req->execute(array(strtolower($_POST['pseudo'])));
                $result = $req->fetch();
                // fin de la requête
                $req->closeCursor();

                // si la recherche ne ramène aucun résultat, alors le pseudo est libre
                if (empty($result['pseudo'])) {
                    // hachage du mot de passe saisi
                    $hashedPassword = password_hash($_POST['password'], PASSWORD_DEFAULT);

                    // envoi des valeurs sur la base de données, en deux temps (sécurisé grâce à une requête séparée)
                    $req = $bdd->prepare('INSERT INTO users(pseudo, pass, mail, date_inscription) VALUES(?, ?, ?, CURDATE())');
                    $req->execute(array($_POST['pseudo'], $hashedPassword, $_POST['mail']));

                    // fin de la requête
                    $req->closeCursor();

                    // redirection vers la page de connexion
                    header('Location: login.php');
                }
                else {
                    echo '<p>Pseudo déjà pris</p>';
                    session_start();
                    $_SESSION['inscription_error'] = 4;
                    // redirection vers la page d'inscription
                    header('Location: inscription.php');
                    exit();
                }

            }
            else {
                echo '<p>Adresse mail incorrecte</p>';
                session_start();
                $_SESSION['inscription_error'] = 3;
                // redirection vers la page d'inscription
                header('Location: inscription.php');
                exit();
            }
            
        }
        else {
            echo '<p>Valeur(s) incorrecte(s).</p>';
            session_start();
            $_SESSION['inscription_error'] = 2;
            // redirection vers la page d'inscription
            header('Location: inscription.php');
            exit();
        }
    }
    else {
        echo '<p>Une ou plusieurs cases n\' ont pas été remplies.</p>';
        session_start();
        $_SESSION['inscription_error'] = 1;
        // redirection vers la page d'inscription
        header('Location: inscription.php');
        exit();
    }