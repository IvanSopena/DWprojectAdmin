<?php

include 'server/app/Route.php';
include 'server/app/Router.php';
include 'server/app/Security.php';
include 'server/config/Config.php';
include 'server/library/Controlador.php';
include  'server/controllers/Home.php';
include  'server/controllers/ProfileController.php';
include  'server/controllers/MenuController.php';
include 'server/app/Db_CLASS.php';



$error = null;
$type = null;
$router = new Router\Router('/DWprojectAdmin');
$home = new Home();
$profile = new ProfileController();
$menu = new MenuController();
$sq = new Db_CLASS();
$security = new Security();

$GLOBALS['sq']->connect_DB();


/***************  Rutas Controlador principal *******************/
$router->add('/', function() {
    $GLOBALS['home']->index();
});

$router->add('/logoff', function() {
    $GLOBALS['home']->logoff();
});

$router->post('/login', function() {
    $GLOBALS['home']->login();
});

/***************  Rutas de Perfil *******************/

$router->post('/update_profile', function() {
    $GLOBALS['profile']->save();
});

$router->post('/update_password', function() {
    $GLOBALS['profile']->save_password();
});

$router->add('/profile', function() {
    $GLOBALS['profile']->profile();
});
/************  Correo **********************/
$router->get('/show_notifications', function() {
    $GLOBALS['home']->notifications();
});

$router->post('/read_notification', function() {
    $GLOBALS['home']->read_notification();
});

/************* Rutas de Menu ****************/
/** Usuarios **/
$router->get('/details', function() {
    $GLOBALS['menu']->detail_users();
});

$router->get('/delete_user', function() {
    $GLOBALS['menu']->delete_user();
});

$router->post('/update_user', function() {
    $GLOBALS['menu']->update_users();
});

$router->add('/user', function() {
    $GLOBALS['menu']->users();
});

/** Categoria **/

$router->add('/add_category', function() {
    $GLOBALS['menu']->details_category();
});

$router->add('/view_category', function() {
    $GLOBALS['menu']->view_category();
});

$router->post('/update_category', function() {
    $GLOBALS['menu']->update_category();
});

$router->post('/new_category', function() {
    $GLOBALS['menu']->add_category();
});

$router->get('/delete_category', function() {
    $GLOBALS['menu']->delete_category();
});

$router->get('/edit_category', function() {
    $GLOBALS['menu']->edit_category();
});

/** Estados **/
$router->add('/view_status', function() {
    $GLOBALS['menu']->view_status();
});
$router->add('/new_status', function() {
    $GLOBALS['menu']->details_status();
});
$router->get('/delete_status', function() {
    $GLOBALS['menu']->delete_status();
});

$router->get('/edit_status', function() {
    $GLOBALS['menu']->edit_status();
});

$router->post('/update_status', function() {
    $GLOBALS['menu']->update_status();
});

$router->post('/add_status', function() {
    $GLOBALS['menu']->add_status();
});

/** Peliculas **/
$router->add('/view_movies', function() {
    $GLOBALS['menu']->view_movies();
});

$router->add('/new_movie', function() {
    $GLOBALS['menu']->details_movies();
});

$router->get('/delete_movies', function() {
    $GLOBALS['menu']->delete_movies();
});

$router->get('/edit_movies', function() {
    $GLOBALS['menu']->edit_movie();
}); 

$router->post('/update_movies', function() {
    $GLOBALS['menu']->update_movies();
});

$router->post('/add_movies', function() {
    $GLOBALS['menu']->add_movies();
});

/** Series **/
$router->add('/view_series', function() {
    $GLOBALS['menu']->view_series();
});

$router->add('/new_series', function() {
    $GLOBALS['menu']->details_series();
});

$router->get('/delete_series', function() {
    $GLOBALS['menu']->delete_series();
});

 $router->get('/edit_series', function() {
    $GLOBALS['menu']->edit_serie();
}); 

$router->post('/update_series', function() {
    $GLOBALS['menu']->update_series();
});

$router->post('/add_series', function() {
    $GLOBALS['menu']->add_series();
});


/* Pagina no encontrada */
$router->add('/.*', function () {
    require_once  'Server/views/404.php';
});


$router->route();