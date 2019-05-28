<?php

require('../../model/User.php');
require('../../model/UserManager.php');

if ((!empty($_POST['pseudo'])) && strlen($_POST['pseudo']) <= 100)
{
    // si le pseudo est conforme, on se connecte à la bdd
    $userManager = new UserManager;

    // si la recherche ne ramène aucun résultat, le pseudo est libre
    if (empty($userManager->exists($_POST['pseudo'])))
    {
        echo 'true';
    }
    else
    {
        echo 'false';
    }
}
else
{
    echo 'false';
}
?>