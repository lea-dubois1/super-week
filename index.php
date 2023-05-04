<?php

require_once 'vendor/autoload.php';

use App\Controller\AuthController;
use App\Controller\UserController;

$router = new AltoRouter();

$router->setBasePath('/super-week');


$router->map( 'GET', '/', function() {
    echo "<h1>Bienvenu sur l'accueil</h1>";
}, 'home' );

$router->map('GET', '/users', function() {

    $controller = new UserController();
    echo $controller->list();
    
}, 'users2');

$router->map('GET', "/users", function() {
    echo "<h1>Bienvenu sur la liste des Utilisateurs</h1>";
}, "users");

$router->map('GET', '/users/[i:id]', function($id) {
    echo "<h1>Bienvenu sur la page de l'utilisateur " . $id . "</h1>";
    $user = new UserController;
    echo $user->dataById($id);
}, 'user');

$router->map('GET', '/addUser', function() {
    $user = new UserController();
    $user->create();
}, "addUser");

$router->map('GET', '/addBook', function() {

    $faker = Faker\Factory::create("fr_FR");

    $conn = new \PDO('mysql:host=localhost;dbname=revisions', "root", "");

    $sql = "INSERT INTO book (titre, content, id_user) VALUES (:titre, :content, :id_user)";
    $req = $conn->prepare($sql);

    for ($j=0; $j < 10; $j++) {

        $req->execute([':titre' => $faker->word(),
                       ':content' => $faker->realTextBetween($minNbChars = 200, $maxNbChars = 260, $indexSize = 2),
                       ':id_user' => $faker->randomDigitNotNull()
        ]);
    }
}, 'addBook');

$router->map('GET', '/register', function() {
    require_once __DIR__ . '/src/View/register.php';
}, 'register');

$router->map('POST', '/register', function() {   
    require_once __DIR__ . '/src/View/register.php';
    $auth = new AuthController;
    echo $auth->register($_POST['email'], $_POST['firstname'], $_POST['lastname'], $_POST['password']);
}, 'registerPOST');

$router->map('GET', '/login', function() {
    require_once __DIR__ . '/src/View/login.php';
}, 'loginGET');

$router->map('POST', '/login', function() {
    require_once __DIR__ . 'src/View/login.php';
    $auth = new AuthController;
    echo $auth->login($_POST['email'], $_POST['password']);
}, 'loginPOST');


$match = $router->match();

if( is_array($match) && is_callable( $match['target'] ) ) {
	call_user_func_array( $match['target'], $match['params'] ); 
} else {
	// no route was matched
	header( $_SERVER["SERVER_PROTOCOL"] . ' 404 Not Found');
}

?>