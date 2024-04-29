<?php

class AddMovie
{

    public $model;
    public $msgSuccess;
    public $msgError;
    public $title;
    public $categories;
    public $actors;
    public $directors;
    public $fileName;

    public function __construct()
    {
        $this->model = new Model();
        $this->msgSuccess = null;
        $this->msgError = null;
        $this->fileName = null;
        $this->title = "Ajouter un film";
    }

    public function manage()
    {

        if (!isset($_SESSION['user'])) {
            header('Location: index.php?page=signIn');
            exit();
        }

        if (isset($_POST['title'])) {

            if (empty($_POST['title']) || empty($_POST['year']) || empty($_POST['director']) || empty($_POST['category']) || empty($_POST['actor'])) {

                $this->msgError = 'Merci de renseigner les champs obligatoires';

            } else {

                if (!empty($_FILES['picture']['name'])) {
                    $this->addImage();
                }

                if (!$this->msgError) {

                    $this->addNewMovie();

                }
            }
        }

        $this->categories = $this->model->getAllCategories();
        $this->actors = $this->model->getAllActors();
        $this->directors = $this->model->getAllDirectors();

        include(__DIR__ . '/../view/header.php');
        include(__DIR__ . '/../view/popup.php');
        include(__DIR__ . '/../view/addMovie.php');
        include(__DIR__ . '/../view/footer.php');
    }

    public function addImage()
    {
        $msgError = '';
        $uploadOk = true;

        $now = date('d-m-Y-H-i-s');

        $imageFileType = strtolower(pathinfo($_FILES['picture']['name'], PATHINFO_EXTENSION));

        $targetDir = "src/public/images/";

        if (!file_exists($targetDir)) {
            mkdir("src/public/images");
        }

        $targetFile = $targetDir . $_POST['title'] . '-' . $now . '.' . $imageFileType;

        $checkSize = getimagesize($_FILES['picture']['tmp_name']);

        if (!$checkSize) {
            $uploadOk = false;
            $msgError = "Ceci n'est pas une image";
        }

        if (file_exists($targetFile)) {
            $uploadOk = false;
            $msgError .= "<br/>Un fichier du même nom existe déjà";
        }

        if ($_FILES['picture']['size'] > 500000) {
            $uploadOk = false;
            $msgError .= "<br>Votre image dépasse les limites autorisées";
        }

        if ($imageFileType != 'jpg' && $imageFileType != 'png' && $imageFileType != 'jpeg') {

            $uploadOk = false;
            $msgError .= "<br>Soyez sympa, envoyez moi un jpg ou un png";
        }

        if ($uploadOk) {
            if (move_uploaded_file($_FILES['picture']['tmp_name'], $targetFile)) {

                $this->fileName = $_POST['title'] . '-' . $now . '.' . $imageFileType;

            } else {

                $this->msgError = "Echec d'upload d'image";

            }
        } else {
            $this->msgError = $msgError;
        }
    }

    public function addNewMovie()
    {
        $synopsis = empty($_POST['synopsis']) ? null : $_POST['synopsis'];
        $trailer = empty($_POST['trailer']) ? null : $_POST['trailer'];
        $duration = empty($_POST['duration']) ? null : $_POST['duration'];
        $idMovie = $this->model->addNewMovie($_POST['title'], $_POST['year'], $synopsis, $duration, $this->fileName, $_POST['category'], $_POST['director'], $_SESSION['user']['id'], $trailer);

        if ($idMovie) {
            $this->model->addActorsForMovie($_POST['actor'], $idMovie);
        } else {
            $this->msgError = 'Une erreur est survenue';
        }
    }

}