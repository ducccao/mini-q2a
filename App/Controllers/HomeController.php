<?php

namespace App\Controllers;

use App\Models\UserModel;
use App\Views\View;
use App\Models\QuestionQueueModel;
use App\Models\QuestionCategoryModel;

use function PHPSTORM_META\map;

class HomeController
{
    public function index()
    {

        $qqModel = new QuestionQueueModel();
        $questionCateModel = new QuestionCategoryModel();


        $questionCategories = $questionCateModel->GetAllQuestionCategoriesWithCountQQ();
        $fiveOutstandingQuestion = $qqModel->FiveOutstandingQuetion();
        $fullArrayTags = $qqModel->GetFullArrayTagsOfFullQuetionQueue();

        console_log($fullArrayTags);

        $view_home = new View();


        $fiveOutstandingQuestion = array_filter($fiveOutstandingQuestion, function ($ele) {
            return (int)$ele['like_count'] > 2;
        });


        console_log($fiveOutstandingQuestion);


        $data = [$fiveOutstandingQuestion,  $questionCategories, $fullArrayTags];

        $view_path = "./App/Views/Home/HomePage.php";

        $view_home->render($view_path, $data);
        return;
    }




    public function abc()
    {
        echo "abc";
    }
}
