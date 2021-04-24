<?php


namespace App\Controllers;

use App\Models\UserModel;
use App\Views\View;

class UserController
{


    function __constructor()
    {
    }
    public function index()
    {
        echo "User index";
    }

    public function renderViewAllUser()
    {
        $userModel = new UserModel();

        $users = $userModel->getAllUser();

        console_log("hi");
        console_log($users);


        $view_path = "./App/Views/User/AllUser.php";
        $viewUser = new View();
        $viewUser->render($view_path, $users);
        return;
    }

    public function GetAllUserPage()
    {
        $userModel = new UserModel();

        $users = $userModel->getAllUser();

        console_log("hi");
        console_log($users);


        $view_path = "./App/Views/User/AllUser.php";
        $viewUser = new View();
        return $viewUser->render($view_path, $users);
    }
}
