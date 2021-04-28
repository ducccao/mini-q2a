<?php

namespace App\Controllers;

use App\Models\QuestionCategoryModel;
use App\Models\UserModel;
use App\Views\View;

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
}
