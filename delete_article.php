<?php

if (empty($_GET['id'])) {
    header('Location: admin.php');
    exit();
}

try {
    $bdd = new PDO('mysql:host=localhost;dbname=blog_forteroche;charset=utf8', 'root', '', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION)); // affiche des erreurs plus précises
} catch (Exception $e) {
    die('Erreur : ' . $e->getMessage());
}

$query = $bdd->prepare("DELETE FROM articles WHERE id = ?");
$query->execute(array(
    $_GET['id']
));

$query->closeCursor();
header('Location: admin.php');
?>