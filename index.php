<?php

include 'server/app/Route.php';
include 'server/app/Router.php';
include 'server/app/Security.php';
include 'server/config/Config.php';
include 'server/library/Controlador.php';
include  'server/controllers/Home.php';
include  'server/controllers/ProfileController.php';
include 'server/app/Db_CLASS.php';



$error = null;
$type = null;
$router = new Router\Router('/DWprojectAdmin');
$home = new Home();
$profile = new ProfileController();
$sq = new Db_CLASS();
$security = new Security();

$GLOBALS['sq']->connect_DB();

$router->add('/', function() {
    $GLOBALS['home']->index();
});

$router->add('/logoff', function() {
    $GLOBALS['home']->logoff();
});

$router->post('/login', function() {
    $GLOBALS['home']->login();
});

$router->post('/update_profile', function() {
    $GLOBALS['profile']->save();
});

$router->add('/profile', function() {
    $GLOBALS['profile']->profile();
});

$router->add('/.*', function () {
    require_once  'Server/views/404.php';
});


$router->route();