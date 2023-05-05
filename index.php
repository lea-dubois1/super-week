<?php

session_start();

// session_destroy();

require_once 'vendor/autoload.php';

use App\Controller\AuthController;
use App\Controller\UserController;
use App\Controller\BookController;

$router = new AltoRouter();

$router->setBasePath('/super-week');


$router->map( 'GET', '/', function() {
    require_once __DIR__ . "/src/View/home.php";
}, 'home' );

$router->map('GET', '/users', function() {

    $controller = new UserController();
    echo $controller->list();
    
}, 'users2');

$router->map('GET', "/users", function() {
    echo "<h1>Bienvenu sur la liste des Utilisateurs</h1>";
}, "users");

$router->map('GET', '/users/[i:id]', function($id) {
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
    $auth = new AuthController;
    echo $auth->register($_POST['email'], $_POST['firstname'], $_POST['lastname'], $_POST['password']);
}, 'registerPOST');

$router->map('GET', '/login', function() {
    require_once __DIR__ . '/src/View/login.php';
}, 'loginGET');

$router->map('POST', '/login', function() {
    $auth = new AuthController;
    echo $auth->login($_POST['email'], $_POST['password']);
}, 'loginPOST');

$router->map('GET', '/books/write', function() {
    require_once __DIR__ . '/src/View/addBook.php';
    var_dump($_SESSION);
}, 'bookWriteGET');

$router->map('POST', '/books/write', function() {
    $book = new BookController;
    var_dump($_POST);
    $book->addBook($_POST['titre'], $_POST['content'], $_SESSION['user']['id']);
}, 'bookWritePOST');

$router->map('GET', '/books', function() {
    $book = new BookController;
    echo $book->dataAll();
}, 'seeAllBooksJson');

$router->map('GET', '/books/[i:id]', function($id) {
    $book = new BookController;
    echo $book->dataOne($id);
}, 'displayOneBook');

$router->map('GET', '/logout', function() {
    session_destroy();
    require_once __DIR__ . '/src/View/logout.php';
}, 'logout');

$router->map('GET', '/test', function() {
    require_once __DIR__ . 'test.php';
}, 'test');


$match = $router->match();

if( is_array($match) && is_callable( $match['target'] ) ) {
	call_user_func_array( $match['target'], $match['params'] ); 
} else {
	// no route was matched
	header( $_SERVER["SERVER_PROTOCOL"] . ' 404 Not Found');
}

?>