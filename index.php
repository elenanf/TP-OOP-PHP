<?php

session_start();

if (isset($_GET['logout'])) {
    $_SESSION = [];
    session_destroy();
}

require('src/Controller/DetailsMovie.php');
require('src/Controller/ListMovie.php');
require('src/Controller/AddMovie.php');
require('src/Controller/SignIn.php');
require('src/Controller/SignUp.php');
require('src/Model/Model.php');

$page = filter_input(INPUT_GET, "page");

$route = [
        "detailsMovie" => DetailsMovie::class,
        "addMovie" => AddMovie::class,
        "listMovies" => ListMovie::class,
        "signIn" => SignIn::class,
        "signUp" => SignUp::class,
];

$controller = null;

foreach ($route as $routeValue => $className) {

    if ($page === $routeValue) {

        $controller = new $className;
        $controller->manage();
    }
}

if (!$controller) {

    $controller = new SignIn();
    $controller->manage();
}
