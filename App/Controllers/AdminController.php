<?php

namespace App\Controllers;

use App\Models\UserModel;
use App\Views\View;

class AdminController
{
    public function index()
    {


        return;
    }
    public function GetPostControlPage()
    {
        return   require "./App/Views/Admin/vwPostControl/PostControl.php";
    }

    public function RenderAllUser()
    {
        $userModel = new UserModel();
        $users = $userModel->getAllUser();
    }
}
