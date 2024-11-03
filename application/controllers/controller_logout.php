<?php

class Controller_Logout extends Controller
{


    function __construct()
    {
    }

    function action_index()
    {
        session_unset();


        header("Location: /main");
    }

}
