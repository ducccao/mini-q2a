<?php

use Core\Route;

$router = new Route();

// ---------------------
// Admin Route
// ---------------------
$router->get("/admin", function () {
    $user_type = 'anonymous';
    $user_type = 'user';
    $user_type = 'admin';


    if ($user_type == 'admin') {
        header("Location: ./Admin.php");
    } else if ($user_type == 'anonymous') {
        header("Location: ./index.php");
    } else {
        header("Location: ./index.php");
    }
});

// ---------------------
// Home Route
// ---------------------

$router->get("/", "HomeController@index");
// ------------
// User Route
// ------------

$router->get("/user/all-users", "UserController@GetAllUserPage");
//$router->get("/user/login", "UserController@GetLoginPage");
$router->get("/user/register", "UserController@GetRegisterPage");

// ---------------------
// Question Queue Route
// ---------------------

$router->get("/question-queue", "QuestionQueueController@index");
$router->get("/question-queue/{id}", "QuestionQueueController@GetQuestionQueueDetail");

// ---------------------
// Ranking Route
// ---------------------

$router->get("/ranking", "RankingController@index");
// ---------------------
// Mapping
// ---------------------

$request_url = !empty($_GET['url']) ? '/' . $_GET['url'] : '/';

// Lấy phương thức hiện tại của url đang được gọi. (GET | POST). Mặc định là GET.
$method_url = !empty($_SERVER['REQUEST_METHOD']) ? $_SERVER['REQUEST_METHOD'] : 'GET';


$router->map($request_url, $method_url);



// an router
