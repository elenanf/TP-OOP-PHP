<?php

class SignIn
{

    public $model;
    public $msgSuccess;
    public $msgError;
    public $displayPseudo;
    public $title;
    public $location;

    public function __construct() {

        $this->model            = new Model();
        $this->msgSuccess       = null;
        $this->msgError         = null;
        $this->displayPseudo    = false;
        $this->title            = "Connectez-vous";
        $this->location         = "signIn";
    }

    public function manage() {

        if (isset($_POST['email'])) {

            if (!empty($_POST['email']) && !empty($_POST['pswrd'])) {

                $user = $this->model->getOneUser($_POST['email']);

                if ($user === null) {

                    $this->msgError = "Quelque chose s'est mal passé...";

                } elseif (!$user || !password_verify($_POST['pswrd'], $user['user_password'])) {

                    $this->msgError = "Attention à bien écrire le login et le mot de passe";

                } else {
                        $_SESSION['user'] = [
                            'pseudo' => $user['user_pseudo'],
                            'email' => $user['user_email'],
                            'id' => $user['user_id'],
                            'role' => $user['role_name'],
                        ];

                        header('Location: index.php?page=listMovies');
                }

            } else {
                $this->msgError = "Merci de remplir tous les champs";
            }
        }



        include (__DIR__ . '/../view/header.php' );
        include (__DIR__ . '/../view/popup.php' );
        include (__DIR__ . '/../view/sign.php');
        include (__DIR__ . '/../view/footer.php' );
    }

}