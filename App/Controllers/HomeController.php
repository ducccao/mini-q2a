<?php

namespace App\Controllers;

use App\Models\UserModel;
use App\Views\View;
use App\Models\QuestionQueueModel;
use App\Models\QuestionCategoryModel;

class HomeController
{
    public function index()
    {

        $qqModel = new QuestionQueueModel();
        $questionCateModel = new QuestionCategoryModel();

        $questionCategories = $questionCateModel->GetAllQuestionCategories();
        $newestQuestionQueue = $qqModel->GetNewestQuestionQueueWithoutArrayTag();
        $newestQQArrayTags = $qqModel->GetNewstQuestionQueueArrayTagName();

        $view_home = new View();


        $data = [$newestQuestionQueue,  $questionCategories, $newestQQArrayTags];

        $view_path = "./App/Views/Home/HomePage.php";

        $view_home->render($view_path, $data);
        return;
    }




    public function abc()
    {
        echo "abc";
    }
}
