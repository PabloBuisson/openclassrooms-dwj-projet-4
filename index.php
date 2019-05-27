<?php
// routeur de notre projet
session_start();

// enregistre l'autoload
function loadClass($classname)
{
    $pathController = 'controller/' . $classname . '.php';
    $pathModel = 'model/' . $classname . '.php';

    if (file_exists($pathController))
    {
        require_once $pathController;
    }
    else if (file_exists($pathModel))
    {
        require_once $pathModel;
    }
}
spl_autoload_register('loadClass');

// on instancie les controller
$frontend = new FrontendController();
$backend = new BackendController();

// conditons puis lancement de la méthode du controller choisi

if (isset($_GET['action']))
{
    // exécute toutes les autres pages

    // FRONTEND
    if ($_GET['action'] == 'home')
    {
        $frontend->home();
    }

    if ($_GET['action'] == 'biographie')
    {
        $frontend->biographie();
    }

    if ($_GET['action'] == 'billetSimple')
    {
        $frontend->billetSimple();
    }

    if ($_GET['action'] == 'contact')
    {
        $frontend->contact();
    }

    if ($_GET['action'] == 'inscription')
    {
        $frontend->inscription();
    }

    if ($_GET['action'] == 'login')
    {
        $frontend->login();
    }

    if ($_GET['action'] == 'view')
    {
        $frontend->view();
    }

    // BACKEND
    if ($_GET['action'] == 'admin')
    {
        $backend->admin();
    }

    if ($_GET['action'] == 'newArticle')
    {
        $backend->newArticle();
    }

    if ($_GET['action'] == 'updateArticle')
    {
        $backend->updateArticle();
    }
}
else
{
    // pas d'action, on exécute la page d'accueil
    $frontend->home();
}