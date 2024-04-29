<?php

class ListMovie
{
    public $model;
    public $msgSuccess;
    public $msgError;
    public $title;
    public $movies;

    public function __construct() {
        $this->model            = new Model();
        $this->msgSuccess       = null;
        $this->msgError         = null;
        $this->title            = "Liste des films";
    }

    public function manage() {

        if (!isset($_SESSION['user'])) {
            header('Location: index.php?page=signIn');
            exit();
        }

        $this->movies = $this->model->getAllMovies($_SESSION['user']['id']);

        if ($this->movies === false) {
            $this->msgError = "Il n'y a aucun film à afficher...";
        }

        if ($this->movies === null) {
            $this->msgError = "Oups! Il semble qu'il y a eu une erreur. Réessayez plus tard.";
        }

        include (__DIR__ . '/../view/header.php' );
        include (__DIR__ . '/../view/listMovie.php' );
        include (__DIR__ . '/../view/popup.php' );
        include (__DIR__ . '/../view/footer.php' );
    }

}