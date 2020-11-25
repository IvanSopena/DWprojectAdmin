<?php


include 'server/app/Route.php';
include 'server/app/Router.php';
include 'server/app/Security.php';
include 'server/config/Config.php';
include 'server/library/Controlador.php';
include  'server/controllers/Home.php';
include 'server/app/Db_CLASS.php';




// Si está en el directorio raíz dejar así, si no especificar como primer parámetro '/la-subcarpeta'
$error = null;
$type = null;
$router = new Router\Router('/DWprojectAdmin');
$home = new Home();
$sq = new Db_CLASS();
$security = new Security();

$GLOBALS['sq']->connect_DB();

$router->add('/', function() {
    $GLOBALS['home']->index();
});

$router->add('/login', function() {
    $GLOBALS['home']->login();
});


$router->add('/.*', function () {
    require_once  'Server/views/404.php';
});


$router->route();