<?php

namespace App\Controllers;

use App\Models\AdminModel;
use App\Models\QuestionCategoryModel;
use App\Models\QuestionQueueModel;
use App\Models\UserModel;
use App\Views\View;
use App\Models\AnswerModel;
use App\Models\LabelModel;

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
    public function ManageAnswer()
    {


        $view_path = './App/Views/Admin/ManageAnswer/ManageAnswer.php';

        $ansModel = new AnswerModel();
        $allAnswers = $ansModel->all();

        // Data Note
        // data[0]: allAnswers

        $data = [$allAnswers];
        $manageAnswerView = new View();
        return $manageAnswerView->render($view_path, $data);
    }

    public function ManageAnswerDetail()
    {
        $queDetailData = null;
        $ansData = null;

        if (isset($_GET['ans_id'])) {
            $ans_id = $_GET['ans_id'];

            $adMode = new AdminModel();
            $ansModel = new AnswerModel();
            $ansDetailData = $ansModel->detail($ans_id);

            console_log($ansDetailData);
        }



        $data = [$ansDetailData, $ansData];


        // data[0]: ansDetailData
        // data[1]: ansData


        $manageQuestionView = new View();
        $view_path = './App/Views/Admin/ManageAnswer/ManageAnswerDetail.php';

        return $manageQuestionView->render($view_path, $data);
    }

    public function AllQuestionToAddLabel()
    {
        $view_path = './App/Views/Admin/AddLabelToQuestion/AllQuestionToAddLabel.php';

        $qqModel = new QuestionQueueModel();
        $allAcceptedQQ = $qqModel->allWithAccepted();


        // data[0]: allAcceptedQQ
        $data = [$allAcceptedQQ];
        $view_add_label_to_question = new View();

        return $view_add_label_to_question->render($view_path, $data);
    }

    public function AddLabelToQuestion()
    {
        $view_path = './App/Views/Admin/AddLabelToQuestion/AddLabelToQuestion.php';

        $qqModel = new QuestionQueueModel();
        $tagModel = new LabelModel();

        $que_id = '';
        if (isset($_GET['que_id'])) {
            $que_id = $_GET['que_id'];
        }

        $curr_question = $qqModel->detail($que_id);
        $like_count = $qqModel->GetFullLikeCountOfFullQuestionQueue();
        $tags = $qqModel->GetFullArrayTagsOfFullQuetionQueue();
        $all_label = $tagModel->all();


        // data[0]: allAcceptedQQ
        // data[1]: que_id
        // data[2]: allAcceptedQQ
        // data[3]: like_count
        // data[4]: all_label


        $data = [[$curr_question], $que_id, $tags, $like_count, $all_label];
        $view_add_label_to_question = new View();

        return $view_add_label_to_question->render($view_path, $data);
    }
    public function EmailNotify()
    {
        $view_path = './App/Views/Admin/EmailNotify/EmailNotify.php';



        $data = [];
        $view_email_notify_toggle = new View();

        return $view_email_notify_toggle->render($view_path, $data);
    }
}
