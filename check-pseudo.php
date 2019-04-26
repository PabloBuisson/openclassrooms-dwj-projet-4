<?php
    $pseudo = strtolower($_POST['pseudo']);

    if ((!empty($pseudo)) && strlen($pseudo) <= 100) {
        // si le pseudo est conforme, on se connecte à la bdd
        try {
            $bdd = new PDO('mysql:host=localhost;dbname=blog_forteroche;charset=utf8', 'root', '', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION)); // affiche des erreurs plus précises)
        } catch (Exception $e) {
            die('Erreur : ' . $e->getMessage());
        }

        // puis on fait une requête séparée, pour la sécurité
        $req = $bdd->prepare('SELECT pseudo FROM users WHERE LOWER(pseudo) = ?');
        $req->execute(array($pseudo));
        $result = $req->fetch();

        // si la recherche ne ramène aucun résultat, le pseudo est libre
        if (empty($result['pseudo'])) {
            echo 'true';
        }
        else {
            echo 'false';
        }
    }
    else {
        echo 'false';
    }
?>