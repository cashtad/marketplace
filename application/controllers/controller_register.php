<?php

class Controller_Register extends Controller
{


    function __construct()
    {
        $this->model = new Model_Register();
        $this->view = new View();
    }

    function action_index()
    {

        if (isset($_POST['name-reg']) && isset($_POST['email-reg']) && isset($_POST['password-reg']) && isset($_POST['role-reg'])) {
            $login = $_POST['email-reg'];
            $password = $_POST['password-reg'];
            $name = $_POST['name-reg'];
            $role = $_POST['role-reg'];
            switch ($role) {
                case 'Buyer':
                    $role = 1;
                    $verified = 1;
                    break;
                case 'Seller':
                    $role = 2;
                    $verified = 0;
                    break;
            }
            if ($this->model->register($login, $name, $password, $role, $verified)) {
              $user = $this->model->infoByLogin($login);
              $data["login_status"] = "access_granted";
              $_SESSION["logged_in"] = true;
              $_SESSION["login"] = $login;
              $_SESSION["role"] = $user['role'];
              $_SESSION["name"] = $user['name'];
              $_SESSION["user_id"] = $user["user_id"];

                header('Location:/profile/');
            }
        } else {
            $data["register_status"] = "";

        }


        $this->view->generate('register_view.php', 'template_view.php', $data);
    }

}
