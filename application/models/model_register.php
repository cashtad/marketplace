<?php

class Model_Register extends Model
{

    public function register($login, $name, $password, $role, $verified)
    {
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);
        $date = date("Y-m-d");
        $this->mysql->query("INSERT INTO `users` (`email`, `password`, `name`, `role`, `registration_date`,`verified`)
        VALUES ('$login', '$hashed_password', '$name', '$role', '$date','$verified')");


        return true;
    }
    public function infoByLogin($login)
    {
        $result = $this->mysql->query("SELECT * FROM `users` WHERE
       `email` = '$login'");
        $user = $result->fetch_assoc();
        return $user;
    }
}
