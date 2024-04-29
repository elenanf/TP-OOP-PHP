<?php

class SignUp
{

    public $model;
    public $msgSuccess;
    public $msgError;
    public $displayPseudo;
    public $title;
    public $location;



    public function __construct()
    {
        $this->model            = new Model();
        $this->msgSuccess       = null;
        $this->msgError         = null;
        $this->displayPseudo    = true;
        $this->title            = "Créer votre compte";
        $this->location         = "signUp";
    }

    public function manage()
    {

        if(isset($_POST['email'])) {

            if (empty($_POST['pseudo']) || empty($_POST['email']) || empty($_POST['pswrd'])) {

                $this->msgError = "Merci de remplir les champs obligatoires";

            } else {

                $pswrdHash = password_hash($_POST['pswrd'], PASSWORD_DEFAULT);

                $idUser = $this->model->addNewUser($_POST['pseudo'], $_POST['email'], $pswrdHash);

                if ($idUser) {
                    $_SESSION['user'] = [
                        'pseudo' => $_POST['pseudo'],
                        'email' => $_POST['email'],
                        'id' => $idUser,
                        'role' => 'user',
                    ];

                    header('Location: index.php?page=listMovies');
                } else {

                    $this->msgError = 'Erreur ! Merci de réessayer ultérieurement.';
                }

            }

        }

        include (__DIR__ . '/../view/header.php' );
        include (__DIR__ . '/../view/popup.php' );
        include (__DIR__ . '/../view/sign.php');
        include (__DIR__ . '/../view/footer.php' );
    }

}