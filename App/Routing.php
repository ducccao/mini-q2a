<?php

use Core\Route;

$router = new Route();



// Home Route
$router->get("/", "HomeController@index");

// User Route
$router->get("/all-users", "UserController@GetAllUserPage");
$router->get("/login", "UserController@GetLoginPage");
$router->get("/sign-up", "UserController@GetSignUpPage");


// Question Queue Route
$router->get("/question-queue", "QuestionQueueController@index");
$router->get("/question-queue/{id}", "QuestionQueueController@GetQuestionQueueDetail");

// Ranking Route
$router->get("/ranking", "RankingController@index");

// Mapping
$request_url = !empty($_GET['url']) ? '/' . $_GET['url'] : '/';

// Lấy phương thức hiện tại của url đang được gọi. (GET | POST). Mặc định là GET.
$method_url = !empty($_SERVER['REQUEST_METHOD']) ? $_SERVER['REQUEST_METHOD'] : 'GET';


$router->map($request_url, $method_url);



// an router
