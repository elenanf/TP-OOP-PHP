<?php

class DetailsMovie
{

    public $model;
    public $msgSuccess;
    public $msgError;
    public $movie;
    public $actors;

    public function __construct()
    {
        $this->model = new Model();
        $this->msgSuccess = null;
        $this->msgError = null;
    }

    public function manage()
    {

        if (!isset($_SESSION['user'])) {
            header('Location: index.php?page=signIn');
            exit();
        }

        if (isset($_GET['id'])) {

            $id = $_GET['id'];

            if (isset($_GET['delete']) && $_GET['delete'] == 'true') {
                $this->deleteMovie($id);
            } else {
                $this->getMovieInformation($id);
            }

        } else {
            $this->msgError = "Ce film n'existe pas...";
        }


        include(__DIR__ . '/../view/header.php');
        include(__DIR__ . '/../view/popup.php');
        include(__DIR__ . '/../view/detailsMovie.php');
        include(__DIR__ . '/../view/footer.php');
    }

    public function deleteMovie($id)
    {
        $this->model->deleteMoviesActors($id);
        $this->model->deleteMovie($id);
        $this->msgSuccess = "Film supprimé !";
    }

    public function getMovieInformation($id)
    {
        $this->movie = $this->model->getMovie($id);

        if ($this->movie === false) {
            $this->msgError = "Nous n'avons pas pu retrouver ce film...";
        }

        if ($this->movie === null) {
            $this->msgError = "Oups! Il semble qu'il y a eu une erreur. Réessayez plus tard.";
        }

        $this->actors = $this->model->getActorsByMovie($id);
    }

}