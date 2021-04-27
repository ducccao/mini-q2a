<?php

namespace App\Controllers;

use App\Models\UserModel;
use App\Views\View;

class AdminController
{
    public function index()
    {
        echo "index";
        return;
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
