<?php

$action = '';

if (isset($_GET['action'])) {
    $action = $_GET['action'];
    switch ($action) {


        case 'dashboard':
            require_once "./Router/Admin/AdminPageRouter.php";
            break;

        case 'question-detail':
            require_once "./Router/Admin/ManageQuestionDetail.php";
            break;

        case 'question-category':
            require_once "./Router/Admin/ManageQuestionCategory.php";
            break;

        case 'question':
            require_once "./Router/Admin/ManageQuestion.php";
            break;

        default:
            # code...
            break;
    }
}
