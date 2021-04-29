<?php


$action = '';

if (isset($_GET['action'])) {
    $action = $_GET['action'];
}
switch ($action) {
    case '':
        require_once "./Router/HomeRouter.php";

        break;
    case 'question-queue':
        require_once "./Router/QuestionQueueRouter.php";
        break;
    case 'home':
        require_once "./Router/HomeRouter.php";
        break;
    case 'ranking':
        require_once "./Router/RankingRouter.php";
        break;
    case 'user-login':
        require_once "./Router/User/UserLoginRouter.php";
        break;

    case 'user-register':
        require_once "./Router/User/UserRegisterRouter.php";

        break;
    case 'admin':
        require_once "./Router/Admin/AdminPageRouter.php";
        break;

    case 'user-upload-question':
        require_once "./Router/User/UserUploadQuestion.php";
        break;


    default:
        echo "404";
        break;
}
