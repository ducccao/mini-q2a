<?php

namespace App\Controllers;

use App\Models\UserModel;
use App\Views\View;
use App\Models\QuestionQueueModel;

class HomeController
{
    public function index()
    {

        $qqModel = new QuestionQueueModel();

        $data = $qqModel->getAllQuestionQueues();

        $view_home = new View();

        $view_path = "./App/Views/Home/HomePage.php";
        $view_home->render($view_path, $data);
        return;
    }




    public function abc()
    {
        echo "abc";
    }
}
