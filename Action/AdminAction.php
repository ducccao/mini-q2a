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
        default:
            # code...
            break;
    }
}
