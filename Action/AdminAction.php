<?php

$action = '';

if (isset($_GET['action'])) {
    $action = $_GET['action'];
    switch ($action) {


        case 'dashboard':
            require_once "./Router/Admin/AdminPageRouter.php";
            break;



        case 'question-category':
            require_once "./Router/Admin/ManageQuestionCategory.php";
            break;

        case 'question':
            require_once "./Router/Admin/ManageQuestion.php";
            break;
        case 'question-detail':
            require_once "./Router/Admin/ManageQuestionDetail.php";
            break;

        case 'answer':
            require_once "./Router/Admin/ManageAnswer.php";
            break;

        case 'answer-detail':
            require_once "./Router/Admin/ManageAnswerDetail.php";
            break;

        case 'all-question-to-add-label':
            require_once "./Router/Admin/AllQuestionToAddLabel.php";
            break;
        case 'add-label-to-question':
            require_once "./Router/Admin/AddQuestionToLabel.php";
            break;
        case 'email-notify':
            require_once "./Router/Admin/EmailNotify.php";
            break;

        case 'export':
            require_once "./Router/Admin/ExportRecords.php";
            break;


        case 'config-api':
            require_once "./Router/Admin/ConfigAPI.php";
            break;

        default:
            # code...
            break;
    }
}
