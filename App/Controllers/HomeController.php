<?php

namespace App\Controllers;

use App\Models\UserModel;
use App\Views\View;

class HomeController
{
    public function index()
    {
        $userModel = new UserModel();
        $users = $userModel->getAllUser();


        $view_path = "./App/Views/Home/HomePage.php";

        $homeView = new View();
        $homeView->render($view_path, $users);
        return;
    }
}
