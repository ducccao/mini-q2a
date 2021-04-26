<?php

use Core\Route;

class HomeRouter
{

    protected $homeRouter = null;

    public function get($req, $res)
    {
        $this->homeRouter = new Route();
    }





    // ---------------------
    // Home Route
    // ---------------------

    // $homeRouter->get("/", function () {
    //     require_once "./Home.php";
    // });
    // // ------------
    // // User Route
    // // ------------

    // $homeRouter->get("/user/all-users", "UserController@GetAllUserPage");
    // //$homeRouter->get("/user/login", "UserController@GetLoginPage");
    // $homeRouter->get("/user/register", "UserController@GetRegisterPage");

    // // ---------------------
    // // Question Queue Route
    // // ---------------------

    // $homeRouter->get("/question-queue", "QuestionQueueController@index");
    // $homeRouter->get("/question-queue/{id}", "QuestionQueueController@GetQuestionQueueDetail");

    // // ---------------------
    // // Ranking Route
    // // ---------------------

    // $homeRouter->get("/ranking", "RankingController@index");
    // // ---------------------
    // // Mapping
    // // ---------------------

    // $request_url = !empty($_GET['url']) ? '/' . $_GET['url'] : '/';

    // // Lấy phương thức hiện tại của url đang được gọi. (GET | POST). Mặc định là GET.
    // $method_url = !empty($_SERVER['REQUEST_METHOD']) ? $_SERVER['REQUEST_METHOD'] : 'GET';


    // $homeRouter->map($request_url, $method_url);

}
