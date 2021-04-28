<?php


namespace App\Controllers;

use App\Models;
use App\Models\QuestionQueueModel;
use App\Views\View;
use App\Models\QuestionCategoryModel;

class QuestionQueueController
{
    public function __construct()
    {
    }

    public function index()
    {
        $qqModel = new QuestionQueueModel();
        $questionCateModel = new QuestionCategoryModel();

        $questionCategories = $questionCateModel->GetAllQuestionCategories();

        $allQuestionQueue = $qqModel->GetFullQuestionQueue();

        // ---------------------
        // Pagination Problem
        // ---------------------
        $pagi_total_QuestionQueue =  0;
        $pagi_num_QuestionQueue_appear = 5;
        $pagi_total_pagi_stuff = 0;


        foreach ($allQuestionQueue as $qq) {
            $pagi_total_QuestionQueue++;
        }


        $pagi_total_pagi_stuff = floor($pagi_total_QuestionQueue / $pagi_num_QuestionQueue_appear) + 1;


        $uri = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http")
            . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";

        $url_len = strlen($uri);

        $pagi_current = (int)substr($uri, $url_len - 1, 1) + 1;

        $limit = $pagi_num_QuestionQueue_appear;
        $offset = $limit * ($pagi_current - 1);

        $allQuestionQueuePaginationed = $qqModel->GetFullQuestionQueueByPagination($limit, $offset);


        // -------------------------------------
        // Array Tags & Like Count Problem
        // -------------------------------------
        $fullArrayTags = $qqModel->GetFullArrayTagsOfFullQuetionQueue();
        $allLikeCount = $qqModel->GetFullLikeCountOfFullQuestionQueue();


        // --------------------------
        // Question Category problem
        // --------------------------

        if (isset($_REQUEST['questionCate'])) {
            return $this->FilterByQuestionCate();
        }

        if (isset($_REQUEST['keyWord'])) {
            $keyWord = $_REQUEST['keyWord'];
            return $this->GetQuestionByKeyWord($keyWord);
        }


        $view_home = new View();
        /*
        data[0]: All question queues
        data[1]: questionCategories
        data[2]: fullArrayTags
        data[3]: allLikeCount
        data[4]: pagi_total_pagi_stuff
        data[5]: pagi_current
        data[6]:
        
        */

        console_log($allQuestionQueuePaginationed);
        $data = [
            $allQuestionQueuePaginationed,  $questionCategories,
            $fullArrayTags, $allLikeCount, $pagi_total_pagi_stuff, $pagi_current,

        ];

        $view_path = "./App/Views/QuestionQueue/QuestionQueue.php";

        return $view_home->render($view_path, $data);
    }


    public function FilterByQuestionCate()
    {
        $qqModel = new QuestionQueueModel();
        $questionCateModel = new QuestionCategoryModel();

        $questionCategories = $questionCateModel->GetAllQuestionCategories();

        $allQuestionQueue = $qqModel->GetFullQuestionQueue();

        // ---------------------
        // Pagination Problem
        // ---------------------
        $pagi_total_QuestionQueue =  0;
        $pagi_num_QuestionQueue_appear = 5;
        $pagi_total_pagi_stuff = 0;


        foreach ($allQuestionQueue as $qq) {
            $pagi_total_QuestionQueue++;
        }


        $pagi_total_pagi_stuff = floor($pagi_total_QuestionQueue / $pagi_num_QuestionQueue_appear) + 1;


        $uri = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http")
            . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";

        $url_len = strlen($uri);

        $pagi_current = (int)substr($uri, $url_len - 1, 1) + 1;

        $limit = $pagi_num_QuestionQueue_appear;
        $offset = $limit * ($pagi_current - 1);

        $allQuestionQueuePaginationed = $qqModel->GetFullQuestionQueueByPagination($limit, $offset);


        // -------------------------------------
        // Array Tags & Like Count Problem
        // -------------------------------------
        $fullArrayTags = $qqModel->GetFullArrayTagsOfFullQuetionQueue();
        $allLikeCount = $qqModel->GetFullLikeCountOfFullQuestionQueue();

        // --------------------------
        // Question Category problem
        // --------------------------

        if (isset($_REQUEST['questionCate'])) {
            $questionCate = $_REQUEST['questionCate'];
        }

        $qqFilteredByQuestionCate = $qqModel->FilterQuestionQueueByQuestionCategoryPaginationed($questionCate);



        console_log('Question cate: ' . $questionCate);





        $view_home = new View();
        /*
        data[0]: All question queues
        data[1]: questionCategories
        data[2]: fullArrayTags
        data[3]: allLikeCount
        data[4]: pagi_total_pagi_stuff
        data[5]: pagi_current
        data[6]:
        
        */

        $data = [
            $qqFilteredByQuestionCate,  $questionCategories,
            $fullArrayTags, $allLikeCount, $pagi_total_pagi_stuff, $pagi_current,

        ];


        $view_path = "./App/Views/QuestionQueue/QuestionQueue.php";

        return $view_home->render($view_path, $data);
    }

    public function GetQuestionByKeyWord(string $keyWord){
        $qqModel = new QuestionQueueModel();
        $questionCateModel = new QuestionCategoryModel();

        $questionCategories = $questionCateModel->GetAllQuestionCategories();
        $qqByKeyWord = $qqModel->GetQuestionByKeyFullText($keyWord);
        $fullArrayTags = $qqModel->GetFullArrayTagsOfFullQuetionQueue();
        $allLikeCount = $qqModel->GetFullLikeCountOfFullQuestionQueue();
        
        // ---------------------
        // Pagination Problem
        // ---------------------
        $pagi_total_QuestionQueue =  0;
        $pagi_num_QuestionQueue_appear = 5;
        $pagi_total_pagi_stuff = 0;


        foreach ($qqByKeyWord as $qq) {
            $pagi_total_QuestionQueue++;
        }

        $data = [
            $qqByKeyWord, $questionCategories,
            $fullArrayTags, $allLikeCount, $pagi_num_QuestionQueue_appear, 1
        ];

        $view_home = new View();
        $view_path = "./App/Views/QuestionQueue/QuestionQueue.php";

        return $view_home->render($view_path, $data);
    }


    public function GetQuestionQueueDetail()
    {
        $data = [1, 1];


        $qqModel = new QuestionQueueModel();

        console_log($_SERVER);


        //        $qqModel->detail($qq_id);

        $view_qq_detail = new View();
        $view_path = "./App/Views/QuestionQueue/QuestionQueueDetail.php";

        return $view_qq_detail->render($view_path, $data);
    }
}
