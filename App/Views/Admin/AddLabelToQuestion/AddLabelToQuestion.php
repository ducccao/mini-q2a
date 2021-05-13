<?php


use App\Models\LabelModel;
use App\Models\QuestionLabelModel;

$PATH_ROOT = $GLOBALS['PATH_ROOT'];
$tagModel = new LabelModel();
$questionTagModel = new QuestionLabelModel();


?>
<style>
    .body {
        background-color: #ecf0f1;
    }

    .search-bar {
        width: 90% !important;
    }

    .common-bg {
        background-color: var(--common-bg);
    }

    .bg-search-bar {
        background-color: var(--common-bg);
    }

    .home-content {
        display: flex;
    }

    .home-list-question-left {
        min-height: 300px;
        background-color: transparent;
    }

    .home-list-filter-right {
        height: 300px;
        background-color: var(--layout-bg-2);
    }

    .question-queue {
        width: 100%;
        min-height: 80px;
        background-color: lightblue;
        border: 1px solid black;

    }

    .home-content {
        background-color: var(--common-bg);
        border-radius: 5px;
    }


    .question-newest {
        font-weight: bold;
    }

    .question-queue-card {

        min-height: 50px;
        width: 100%;
        background-color: #4e4e4e17;
        border-radius: var(--border-radius);
    }

    .qq-top-info {
        min-height: 40px;
        width: 100%;
        background-color: transparent;
        display: flex;
        justify-content: space-between;

    }

    .qq-bot-info {

        width: 100%;
        background-color: transparent;
        display: flex;
        justify-content: space-between;
    }


    /* .que-cate-wrapper {} */

    .qq-top-left {
        transition: 0.13s;

    }

    .qq-top-left:hover {
        transform: translateX(10px)
    }


    .qq-title {
        font-size: 22px;
        font-weight: bold;
    }



    .qq-top-right {
        display: flex;
        align-items: center;
    }

    .qq-bot-left {
        display: flex;
        align-items: flex-end;

    }

    .qq-bot-right {
        display: flex;

    }

    .list-tag {
        display: flex;
        align-items: flex-end;

    }

    .tag {
        color: black !important;
        border-radius: var(--border-radius);
        background-color: lightblue;
        padding: 4px;
    }

    .like {
        width: 80px;
    }

    .question-category {
        cursor: pointer;
    }

    .que-cate-content {
        display: flex;
        justify-content: space-between;
    }

    .home-list-filter-right {
        background-color: #8fa1b4;
        color: var(--near-white);
        border-radius: var(--border-radius);

    }


    a:hover {
        color: var(--near-white);
        text-decoration: none;
    }

    .que_cate_name {
        color: var(--near-white);

    }

    h1,
    h2,
    h3,
    h4,
    h5,
    h6 {
        font-weight: bold;
    }

    .que_title {
        color: black;
        font-weight: bold;
        font-size: 22px;
    }

    .que_title:hover {
        color: black;


    }

    .card-wrap {
        padding: 12px;
    }
</style>





<?php



foreach ($this->data[0]  as $qq) {
    $flag = 0;


    echo '

    <div class="card-wrap" >
    <h4>
    Thông tin câu hỏi
</h4>
    <div class="question-queue-card p-3 my-3">
  
    <div class="qq-top-info">
        <div class="qq-top-left">

            <div class="qq-title">
            <a class="que_title" href=  ' .   $PATH_ROOT . '?action=add-label-to-question&que_id=' . $qq["que_id"] . '>
              ' .   $qq["que_title"] . '
              </a>
            </div>
            <div class="qq-username">
                <p>
                ' .   $qq["user_name"] . '
                </p>
            </div>
        </div>

        <div class="qq-top-right">
            <div>
            ' .   $qq["createdAt"] . '
            </div>

        </div>

    </div>
    <div class="qq-bot-info">

        <div class="qq-bot-left">

            <div class="like-wrapper">
                <span class="badge ">
                ';

    // Put The Like Count right there 



    foreach ($data[3] as $like_count) {

        if ($qq['que_id'] ==  $like_count['que_id']) {
            if ($like_count['like_count'] > 0) {
                echo $like_count['like_count'];
                $flag = 1;
                break;
            }
        }
    };

    if ($flag == 0) {
        echo "0";
    }

    echo

    ' 
                </span>

                <i class="far fa-thumbs-up like"></i>

            </div>
        </div>
        <div class="qq-bot-right">
            <div class="list-tag">

    ';

    // put tag[i] right there ! 

    foreach ($this->data[2]  as $tags => $tag) {

        if ($tag['que_id'] == $qq['que_id']) {
            echo '       <div class="tag mx-1">    <a href="/mini-q2a?action=question-queue&tag_id=' . $tag['label_id'] . '">';
            echo  "#" . $tag['label_name'];
            echo '    </a>      </div>';
        }
    }


    echo   '

</div>

</div>
</div>
</div> 
</div>';
}
?>


<div class="card">
    <div class="card-body">
        <h4 class="card-title">Gán nhãn</h4>
        <h6 class="card-subtitle text-muted">Hãy gán nhãn</h6>
    </div>
    <img src="holder.js/100x180/" alt="">
    <div class="card-body">
        <form action="/admin" method="GET">
            <input type="text" name="action" value="add-label-to-question" class="d-none">
            <input type="text" name="que_id" <?php echo 'value="' . $data[1] . '"' ?> class="d-none">

            <div class="form-group">
                <label for="txtTagName">Tên nhãn</label>
                <input required type="text" class="form-control" name="txtTagName" id="txtTagName" aria-describedby="helpId" placeholder="">
                <small id="helpId" class="form-text text-muted">Tên nhãn</small>
            </div>


            <button class="btn btn-primary" type="submit">Gán</button>
        </form>
    </div>
</div>



<?php

if (isset($_GET['txtTagName'])) {


    if (isset($_GET['que_id'])) {
        $que_id = $_GET['que_id'];
        $tag_name = $_GET['txtTagName'];
        $all_label = $data[4];

        $is_exists_tag = false;

        $is_tag_added = false;

        foreach ($all_label as $tag) {
            if ($tag_name == $tag['label_name']) {
                $is_exists_tag = true;
                break;
            }
        }

        if ($is_exists_tag == true) {
            // if tag exists 
            $allQuestionTags = $questionTagModel->detail($que_id);
            $curr_tag_id = $tagModel->getTagIdByTagName($tag_name);

            foreach ($allQuestionTags as $que_tag) {
                if ($que_tag['que_id'] == $que_id && $que_tag['label_id'] == $curr_tag_id['label_id']) {
                    $is_tag_added = true;
                }
            }


            if ($is_tag_added != true) {
                $ret = $questionTagModel->add($que_id, $tag['label_id']);
                echo "<script>location.href='/admin?action=add-label-to-question&que_id=$que_id'; </script>";
            }
        } else {
            // if tag is not exists
            $label_id = randomString(10);
            $ret_create_tag =  $tagModel->add($label_id, $tag_name);
            $ret_add = $questionTagModel->add($que_id, $label_id);
            echo "<script>location.href='/admin?action=add-label-to-question&que_id=$que_id'; </script>";
        }
    }
}





?>