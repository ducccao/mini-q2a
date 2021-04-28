<?php

namespace App\Controllers;

use App\Models\UserModel;
use App\Views\View;

class AdminController
{
    public function index()
    {
        $view_admin = new View();

        $data = [1, 2];
        $view_path = "./App/Views/Admin/AdminPage/AdminPage.php";
        return $view_admin->render($view_path, $data);
    }


    public function abc()
    {
        echo
        "abc";
    }

    public function RenderAllUser()
    {
        $userModel = new UserModel();
        $users = $userModel->getAllUser();
    }

    public function QuestionCategory()
    {

        echo "qqcate";
        // $view_path = './App/Views/Admin/QuestionCategory/QuestionCategory.php';
        // $data = [1, 2, 3];

        // $questionCategoryView = new View();
        // return $questionCategoryView->render($view_path, $data);
    }
}
