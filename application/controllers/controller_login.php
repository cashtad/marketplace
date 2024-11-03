<?php

class Controller_Login extends Controller
{


    function __construct()
    {
        $this->model = new Model_Login();
        $this->view = new View();
    }

    function action_index()
    {
        //$data["login_status"] = "";

        if (isset($_POST['login']) && isset($_POST['password'])) {
            $login = $_POST['login'];
            $password = $_POST['password'];

            /*
            Производим аутентификацию, сравнивая полученные значения со значениями прописанными в коде.
            Такое решение не верно с точки зрения безопсаности и сделано для упрощения примера.
            Логин и пароль должны храниться в БД, причем пароль должен быть захеширован.
            */
            if ($this->model->authenticate($login, $password)) {
                $user = $this->model->infoByLogin($login);
                $data["login_status"] = "access_granted";
                $_SESSION["logged_in"] = true;
                $_SESSION["login"] = $login;
                $_SESSION["role"] = $user['role'];
                $_SESSION["name"] = $user['name'];
                $_SESSION["user_id"] = $user["user_id"];
                header('Location:/profile/');
            } else {
                $data["login_status"] = "access_denied";
            }
        } else {
            $data["login_status"] = "";

        }


        $this->view->generate('login_view.php', 'template_view.php', $data);
    }

}