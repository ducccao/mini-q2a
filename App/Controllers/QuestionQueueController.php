<?php


namespace App\Controllers;

use App\Models;
use App\Models\AnswerModel;
use App\Models\QuestionQueueModel;
use App\Views\View;
use App\Models\QuestionCategoryModel;
use App\Models\LabelModel;

class QuestionQueueController
{
    public function __construct()
    {
    }

    public function index()
    {
        $qqModel = new QuestionQueueModel();
        $questionCateModel = new QuestionCategoryModel();

        $questionCategories = $questionCateModel->GetAllQuestionCategoriesWithCountQQ();

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


        if ($pagi_total_QuestionQueue == $pagi_num_QuestionQueue_appear) {
            $pagi_total_pagi_stuff = floor($pagi_total_QuestionQueue / $pagi_num_QuestionQueue_appear);
        } else {
            $pagi_total_pagi_stuff = floor($pagi_total_QuestionQueue / $pagi_num_QuestionQueue_appear) + 1;
        }
        $pagi_current = 1;

        if (isset($_GET['pagi'])) {
            $pagi_current = $_GET['pagi'];
        }




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

        $cate_current = "";
        if (isset($_REQUEST['questionCate'])) {
            $questionCate = $_GET['questionCate'];
            $cate_current = $questionCate;
            $allQQByCat = $qqModel->FilterQuestionQueueByQuestionCategory($questionCate);

            $pagi_total_QuestionQueue =  0;
            $pagi_num_QuestionQueue_appear = 5;
            $pagi_total_pagi_stuff = 0;


            $limit = $pagi_num_QuestionQueue_appear;
            $offset = $limit * ($pagi_current - 1);

            $allQuestionQueuePaginationed = $qqModel->FilterQuestionQueueByQuestionCategoryPagination($questionCate, $limit, $offset);


            $pagi_total_QuestionQueue = 0;
            foreach ($allQQByCat as $qq) {
                $pagi_total_QuestionQueue++;
            }
            if ($pagi_total_QuestionQueue == $pagi_num_QuestionQueue_appear) {
                $pagi_total_pagi_stuff = floor($pagi_total_QuestionQueue / $pagi_num_QuestionQueue_appear);
            } else {
                $pagi_total_pagi_stuff = floor($pagi_total_QuestionQueue / $pagi_num_QuestionQueue_appear) + 1;
            }
        }


        if (isset($_REQUEST['keyWord'])) {
            $keyWord = $_REQUEST['keyWord'];
            return $this->GetQuestionByKeyWord($keyWord);
        }


        // ----------------------
        //  Filter by newest time
        // ----------------------


        if (isset($_GET['txtTimeNewest'])) {
            $allQuestionQueuePaginationed = $qqModel->filterByNewestTime($limit, $offset);
        }


        if (isset($_GET['txtTimeOldest'])) {
            $allQuestionQueuePaginationed = $qqModel->filterByOldestTime($limit, $offset);
        }

        // ----------------------
        //  Filter by tags
        // ----------------------
        $tagModel = new LabelModel();

        // outstanding tags : used by at least 5 user
        $outstandingTags = $tagModel->getTagUsedByUserWithAmount();


        $outstandingTags = array_filter($outstandingTags, function ($ele) {
            return $ele['count_user_used'] >= 1;
        });

        if (isset($_GET['tag_id'])) {
            $label_id = $_GET['tag_id'];
            $limit = 10;
            $offset = 10;
            $totalQuestionFilterByTag = $qqModel->filterByTagTotalQuestion($label_id);


            $pagi_total_QuestionQueue =  0;
            $pagi_num_QuestionQueue_appear = 5;
            $pagi_total_pagi_stuff = 0;


            $limit = $pagi_num_QuestionQueue_appear;
            $offset = $limit * ($pagi_current - 1);

            $allQuestionQueuePaginationed = $qqModel->filterByTag($label_id, $limit, $offset);

            $pagi_total_QuestionQueue = 0;
            foreach ($totalQuestionFilterByTag as $qq) {
                $pagi_total_QuestionQueue++;
            }
            if ($pagi_total_QuestionQueue == $pagi_num_QuestionQueue_appear) {
                $pagi_total_pagi_stuff = floor($pagi_total_QuestionQueue / $pagi_num_QuestionQueue_appear);
            } else {
                $pagi_total_pagi_stuff = floor($pagi_total_QuestionQueue / $pagi_num_QuestionQueue_appear) + 1;
            }
        }


        console_log($allQuestionQueuePaginationed);


        $view_home = new View();
        /*
        data[0]:allQuestionQueuePaginationed
        data[1]: questionCategories
        data[2]: fullArrayTags
        data[3]: allLikeCount
        data[4]: pagi_total_pagi_stuff
        data[5]: pagi_current
        data[6]: cate_current
        data[7]: outstandingTags
        */


        $data = [
            $allQuestionQueuePaginationed,  $questionCategories,
            $fullArrayTags, $allLikeCount, $pagi_total_pagi_stuff,
            $pagi_current, $cate_current, $outstandingTags
        ];

        $view_path = "./App/Views/QuestionQueue/QuestionQueue.php";

        return $view_home->render($view_path, $data);
    }


    public function FilterByQuestionCate()
    {
        $qqModel = new QuestionQueueModel();
        $questionCateModel = new QuestionCategoryModel();

        $questionCategories = $questionCateModel->GetAllQuestionCategoriesWithCountQQ();




        // -------------------------------------
        // Array Tags & Like Count Problem
        // -------------------------------------
        $fullArrayTags = $qqModel->GetFullArrayTagsOfFullQuetionQueue();
        $allLikeCount = $qqModel->GetFullLikeCountOfFullQuestionQueue();


        // --------------------------
        // Filter Question By Category problem
        // --------------------------

        $questionCate = '';
        if (isset($_REQUEST['questionCate'])) {
            $questionCate = $_REQUEST['questionCate'];
        }

        $qqFilteredByQuestionCate = $qqModel->FilterQuestionQueueByQuestionCategory($questionCate);


        if (isset($_REQUEST['keyWord'])) {
            $keyWord = $_REQUEST['keyWord'];
            return $this->GetQuestionByKeyWord($keyWord);
        }

        // ---------------------
        // Pagination Problem
        // ---------------------
        $pagi_total_QuestionQueue =  0;
        $pagi_num_QuestionQueue_appear = 5;
        $pagi_total_pagi_stuff = 0;


        foreach ($qqFilteredByQuestionCate as $qq) {
            $pagi_total_QuestionQueue++;
        }




        if ($pagi_total_QuestionQueue == $pagi_num_QuestionQueue_appear) {
            $pagi_total_pagi_stuff = floor($pagi_total_QuestionQueue / $pagi_num_QuestionQueue_appear);
        } else {
            $pagi_total_pagi_stuff = floor($pagi_total_QuestionQueue / $pagi_num_QuestionQueue_appear) + 1;
        }



        $pagi_current = 1;

        if (isset($_GET['pagi'])) {
            $pagi_current = (int)$_GET['pagi'] + 1;
        }



        $limit = $pagi_num_QuestionQueue_appear;
        $offset = $limit * ($pagi_current - 1);


        $filteredQQPagi = $qqModel->FilterQuestionQueueByQuestionCategoryPagination($questionCate, $limit, $offset);
        $cate_current = $questionCate;



        $view_home = new View();
        /*
        data[0]: All question queues
        data[1]: questionCategories
        data[2]: fullArrayTags
        data[3]: allLikeCount
        data[4]: pagi_total_pagi_stuff
        data[5]: pagi_current
        data[6]: cate_current
        
        */


        $data = [
            $filteredQQPagi,  $cate_current,
            $fullArrayTags, $allLikeCount, $pagi_total_pagi_stuff, $pagi_current,
            $cate_current
        ];

        $view_path = "./App/Views/QuestionQueue/QuestionQueue.php";

        return $view_home->render($view_path, $data);
    }




    public function GetQuestionByKeyWord(string $keyWord)
    {
        $qqModel = new QuestionQueueModel();
        $questionCateModel = new QuestionCategoryModel();

        $questionCategories = $questionCateModel->GetAllQuestionCategoriesWithCountQQ();
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
        $queDetailData = null;
        if (isset($_GET['que_id'])) {
            $que_id = $_GET['que_id'];

            $qqModel = new QuestionQueueModel();
            $queDetailData = $qqModel->detail($que_id);

            $ansModel = new AnswerModel();
            $ansData = $ansModel->getAnsByQueID($que_id);

            $like_data = $qqModel->getLikeRatingOfQuestionDetail($que_id);
            $spam_data = $qqModel->getSpamRatingOfQuestionDetail($que_id);
            $badContent_data = $qqModel->getBadcontentRatingOfQuestionDetail($que_id);

            $like_question_count = count($like_data);
            $spam_question_count = count($spam_data);
            $badContent_question_count = count($badContent_data);
        }



        $data = [
            $queDetailData, $ansData, $like_data, $like_question_count,
            $spam_data, $spam_question_count, $badContent_data, $badContent_question_count,

        ];

        // data[0]: queDetailData
        // data[1]: ansData
        // data[2]: like_data
        // data[3]: like_question_count
        // data[4]: spam_data
        // data[5]: spam_question_count
        // data[6]: badContent_data
        // data[7]: badContent_question_count
        // data[8]: like_answer_data
        // data[9]: like_answer_count






        $view_qq_detail = new View();
        $view_path = "./App/Views/QuestionQueue/QuestionQueueDetail.php";

        return $view_qq_detail->render($view_path, $data);
    }
}
