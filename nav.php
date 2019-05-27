<?php 

if (empty($_SESSION['id']))
{
    $connected = false;
}
else
{
    $connected = true;
}
?>

<nav id="navbar-example2" class="navbar navbar-expand-md navbar-dark bg-dark fixed-top">
    <!-- le navbar-expand-md permet de décider quand le menu collapse -->
    <div class="container">
        <a class="navbar-brand text-white-50" href="index.php?action=home">Jean Forteroche</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarToggler" aria-controls="navbarToggler" aria-expanded="false" aria-label="Toggle navigation"> <span class="navbar-toggler-icon"></span></button>
        <ul class="nav collapse navbar-collapse flex-sm-column flex-md-row justify-content-md-end align-items-sm-start" id="navbarToggler">
            <li class="nav-item">
                <a class="nav-link text-white" href="index.php?action=home">Accueil</a>
            </li>
            <li class="nav-item">
                <a class="nav-link text-white" href="index.php?action=biographie">Biographie</a>
            </li>
            <li class="nav-item">
                <a class="nav-link text-white" href="index.php?action=billetSimple">Billet simple</a>
            </li>
            <li class="nav-item">
                <a class="nav-link text-white" href="index.php?action=contact">Contact</a>
            </li>
            <?php if ($connected) { ?>
            <li class="nav-item">
                <a class="nav-link text-white" href="index.php?action=admin"><span class="fas fa-user-circle"></span> Admin</a>
            </li>
            <?php
            }
            ?>
        </ul>
    </div>
</nav>