<?php

require_once 'vendor/autoload.php';

$router = new AltoRouter();

$router->setBasePath('/super-week');


$router->map( 'GET', '/', function() {
    echo "<h1>Bienvenu sur l'accueil</h1>";
}, 'home' );

$router->map('GET', "/users", function() {
    echo "<h1>Bienvenu sur la liste des Utilisateurs</h1>";
}, "users");

$router->map('GET', '/users/[i:id]?', function($id) {
    echo "<h1>Bienvenu sur la page de l'utilisateur " . $id . "</h1>";
}, 'user');



$match = $router->match();

if( is_array($match) && is_callable( $match['target'] ) ) {
	call_user_func_array( $match['target'], $match['params'] ); 
} else {
	// no route was matched
	header( $_SERVER["SERVER_PROTOCOL"] . ' 404 Not Found');
}

?>