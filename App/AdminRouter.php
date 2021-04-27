<?php

use Core\Route;

$adminRouter = new Route();

$adminRouter->get("/", "AdminController@index");
$adminRouter->get("/abc", "AdminController@abc");


$adminRouter->get("/admin/question-category", "AdminController@QuestionCategory");




// ---------------------
// Mapping
// ---------------------

$request_url = !empty($_GET['url']) ? '/' . $_GET['url'] : '/';

// Lấy phương thức hiện tại của url đang được gọi. (GET | POST). Mặc định là GET.
$method_url = !empty($_SERVER['REQUEST_METHOD']) ? $_SERVER['REQUEST_METHOD'] : 'GET';;

$adminRouter->map($request_url, $method_url);
