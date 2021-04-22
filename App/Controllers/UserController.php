<?php

namespace App\Controllers;

use App\Models\UserModel;

class UserController
{


    function __constructor()
    {
    }

    public function renderViewAllUser()
    {
        $userModel = new UserModel();

        $users = $userModel->getAllUser();

        console_log("hi");
        console_log($users);


        require "./App/Views/User/AllUser.php";
    }
}
