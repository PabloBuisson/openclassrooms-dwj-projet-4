<?php

if (empty($_GET['id']) || empty($_GET['action'])) {
    header('Location: admin.php');
    exit();
}

try {
    $bdd = new PDO('mysql:host=localhost;dbname=blog_forteroche;charset=utf8', 'root', '', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION)); // affiche des erreurs plus précises
} catch (Exception $e) {
    die('Erreur : ' . $e->getMessage());
}

if ($_GET['action'] == 'delete') {
    $query = $bdd->prepare("DELETE FROM comments WHERE id = ?");
    $query->execute(array(
        $_GET['id']
    ));
}

if ($_GET['action'] == 'update') {
    $query = $bdd->prepare("UPDATE comments SET report = 0 WHERE id = ?");
    $query->execute(array(
        $_GET['id']
    ));
}


$query->closeCursor();
header('Location: admin.php');

?>