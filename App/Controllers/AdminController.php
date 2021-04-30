<?php

namespace App\Controllers;

use App\Models\AdminModel;
use App\Models\QuestionCategoryModel;
use App\Models\QuestionQueueModel;
use App\Models\UserModel;
use App\Views\View;
use App\Models\AnswerModel;

class AdminController
{
    public function index()
    {
        $view_admin = new View();

        $data = [1, 2];
        $view_path = "./App/Views/Admin/AdminPage/AdminPage.php";


        if (isset($_REQUEST['typeManage'])) {
            $typeManage = $_REQUEST['typeManage'];

            switch ($typeManage) {
                case   'question-cate':
                    return $this->ManageQuestionCategory();
                    break;


                default:
                    # code...
                    break;
            }
        }

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

    public function ManageQuestionCategory()
    {


        $view_path = './App/Views/Admin/ManageQuestionCategory/ManageQuestionCategory.php';

        $quetionCateModel = new QuestionCategoryModel();
        $allQuestionCate = $quetionCateModel->all();

        // Data Note
        // data[0]: allQuestionCate

        $data = [$allQuestionCate];
        $questionCategoryView = new View();
        return $questionCategoryView->render($view_path, $data);
    }


    public function ManageQuestion()
    {


        $view_path = './App/Views/Admin/ManageQuestion/ManageQuestion.php';

        $qqModel = new QuestionQueueModel();
        $allQQ = $qqModel->all();

        // Data Note
        // data[0]: allQQ

        $data = [$allQQ];
        $manageQuestionView = new View();
        return $manageQuestionView->render($view_path, $data);
    }

    public function ManageQuestionDetail()
    {
        $queDetailData = null;
        $ansData = null;

        if (isset($_GET['que_id'])) {
            $que_id = $_GET['que_id'];

            $adMode = new AdminModel();
            $queDetailData = $adMode->QuestionDetailByQueID($que_id);
        }



        $data = [$queDetailData, $ansData];


        // data[0]: queDetailData
        // data[1]: ansData


        $manageQuestionView = new View();
        $view_path = './App/Views/Admin/ManageQuestion/ManageQuestionDetail.php';

        return $manageQuestionView->render($view_path, $data);
    }
}
