<?php

class Model_Login extends Model
{
    public function authenticate($login, $password)
    {
        $result = $this->mysql->query("SELECT * FROM `users` WHERE
     `email` = '$login'");
        if (mysqli_num_rows($result) == 0) {
            return false;
        }
        $user = $result->fetch_assoc();
        if (count($user) == 0) {
            return false;
        }
        if ($user && password_verify($password, $user["password"])) {
            return true;
        }
        return false;
    }

    public function infoByLogin($login)
    {
        $result = $this->mysql->query("SELECT * FROM `users` WHERE
       `email` = '$login'");
        $user = $result->fetch_assoc();
        return $user;
    }

}
