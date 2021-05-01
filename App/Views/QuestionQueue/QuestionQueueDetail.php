<style>
    .que_detail_bg {
        background-color: #343a40 !important;
        color: var(--near-white);

    }

    .gr-btn-report {

        display: flex;
    }

    .review_status_wrapper {

        display: flex;
        justify-content: space-between;

    }
</style>

<?php

if (isset($_SESSION['user_name'])) {
    $curr_user = $_SESSION['user_name'];
    $user_type = $_SESSION['user_type'];
    $isExistsUser = true;

    $curr_user_id = $_SESSION['user_id'];
    $curr_user_full_info = $_SESSION['user_full_info'];
} else {
    $curr_user_id = "anonymous";
}
?>



<div class="row">
    <div class="question col-sm-12 col-md-6 col-lg-8">



        <div class="card my-3 ">

            <?php
            // -------------
            // quetion detail
            // -------------

            use App\Models\QuestionCategoryModel;
            use App\Models\QuestionLabelModel;
            use App\Models\QuestionQueueModel;
            use App\Models\RatingQuestionModel;
            use App\Models\RatingAnswerModel;

            ?>
            <div class="card-header que_detail_bg">
                <h4>
                    <?php
                    echo '<strong>' .  $data[0]['que_title'] . '</strong>';
                    ?>
                    <?php


                    echo '<span class="float-right">     <strong>' . $data[0]['user_name']  . '</strong> -
        ' . $data[0]['createdAt'] . '
   
        </span>';


                    ?>
                </h4>

            </div>
            <div class="card-body">

                <div class=" p-3">
                    <?php
                    echo $data[0]['que_content'];
                    ?>
                </div>

            </div>
            <div class="card-footer bg-light  review_status_wrapper">
                <?php
                $like_question_count = $data[3];
                $spam_question_count = $data[5];
                $badContent_question_count = $data[7];

                ?>

                <div class="review_status"><span> <?php echo "$like_question_count" ?> </span><i class="far fa-thumbs-up mx-2"></i>Like</div>
                <div class="review_status"><span><?php echo "$spam_question_count" ?></span><i class="fas fa-redo-alt mx-2"></i> Spam</div>
                <div class="review_status"><span><?php echo "$badContent_question_count" ?></span><i class="far fa-thumbs-down mx-2"></i>Bad content</div>

            </div>

            <?php
            if ($curr_user_id != 'anonymous') {
            } else {
                echo '<style>.card-footer{display:none;} .review_status_wrapper{display:flex;} </style>';
            }
            ?>


            <div class="card-footer que_detail_bg ">


                <span class="float-right gr-btn-report w-100">
                    <a type="button" class="btn btn-light w-50" <?php
                                                                echo 'href="/mini-q2a?action=question-queue-detail&que_id=' . $data[0]['que_id'] . '&rating_status=like&user_id=' . $curr_user_id . '"';
                                                                ?>>
                        <i class="far fa-thumbs-up"></i>

                        Like</a>

                    <div class="dropdown mx-2  w-50">
                        <button class="btn btn-danger dropdown-toggle w-100" type="button" id="btnReport" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="far fa-flag"></i> Report
                        </button>
                        <div class="dropdown-menu w-100" aria-labelledby="btnReport">
                            <a class="dropdown-item w-100" <?php
                                                            echo 'href="/mini-q2a?action=question-queue-detail&que_id=' . $data[0]['que_id'] . '&rating_status=spam&user_id=' . $curr_user_id . '"';
                                                            ?>>Spam</a>
                            <a class="dropdown-item w-100" <?php
                                                            echo 'href="/mini-q2a?action=question-queue-detail&que_id=' . $data[0]['que_id'] . '&rating_status=bad_content&user_id=' . $curr_user_id . '"';
                                                            ?>>Bad content</a>
                        </div>
                    </div>


                </span>

            </div>

            <div class="card-footer que_detail_bg">

                <button type="button" class="btn btn-success w-100">Trả lời</button>


            </div>

        </div>

        <hr>




        <div class="home-content p-3 my-3">

            <?php
            // -------------
            // Handle Answer
            // -------------



            foreach ($data[1] as $ans) {
                echo '<div class="card my-5 ">';

                echo '<div class="card-header common-bg ">';

                echo "<h4>";
                echo '<strong> Trả lời bởi:</strong> <strong>' . $ans['user_name']  . '</strong> ';
                echo '<span class="float-right">    
' . $ans['createdAt'] . '
</span>';
                echo "</h4>";
                echo '</div>';

                // -------------
                // ans content
                // -------------

                echo '<div class="card-body">';
                echo $ans['ans_content'];

                echo ' </div>';

                echo '   <div class="card-footer   common-bg review_status_wrapper">';


                $qqModel = new QuestionQueueModel();
                $like_ans_count = $qqModel->getLikeRatingAnswersByAnsID($ans['ans_id']);
                $spam_ans_count = $qqModel->getSpamRatingAnswersByAnsID($ans['ans_id']);
                $badContent_ans_count = $qqModel->getBadContentRatingAnswersByAnsID($ans['ans_id']);



                echo '<div class="review_status "><span>' .  $like_ans_count['like_count'] . ' 
                 </span><i class="far fa-thumbs-up mx-2"></i>Like</div>';


                echo '<div class="review_status"><span>' . $spam_ans_count['spam_count'] . '</span><i class="fas fa-redo-alt mx-2"></i> Spam</div>';

                echo '<div class="review_status"><span>' . $badContent_ans_count['bad_content_count'] . '</span><i class="far fa-thumbs-down mx-2"></i>Bad content</div>

                             </div>';



                echo '
<div class="card-footer  common-bg ">';
                echo '
<div>
<span class="float-right gr-btn-report">
<a type="button" class="btn bg-white" 
href="/mini-q2a?action=question-queue-detail&que_id=' . $ans['que_id'] . '&ans_id=' . $ans['ans_id'] . '&rating_status=like&user_id=' . $curr_user_id . '">
    <i class="far fa-thumbs-up"></i>

    Like</a>

<div class="dropdown mx-2 ">
    <button class="btn btn-danger dropdown-toggle" type="button" id="btnReport" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        <i class="far fa-flag"></i> Report
    </button>
    <div class="dropdown-menu" aria-labelledby="btnReport">
        <a class="dropdown-item"
          href="/mini-q2a?action=question-queue-detail&que_id=' . $ans['que_id'] . '&ans_id=' . $ans['ans_id'] . '&rating_status=spam&user_id=' . $curr_user_id . '"; >Spam</a>
          <a class="dropdown-item"
          href="/mini-q2a?action=question-queue-detail&que_id=' . $ans['que_id'] . '&ans_id=' . $ans['ans_id'] . '&rating_status=bad_content&user_id=' . $curr_user_id . '"; >Bad content</a>
    </div>
</div>


</span>

</div>
';

                echo '</div>';


                echo '</div>';
            }
            ?>
        </div>

    </div>
    <div class="question col-sm-12 col-md-6 col-lg-4">

        <div class="card my-3">
            <div class="card-body">

                <h4 class="card-title"> <strong>Chủ đề:
                        <?php

                        if (isset($_GET['que_id'])) {
                            $que_id = $_GET['que_id'];

                            $queCatModel = new QuestionCategoryModel();
                            $cat = $queCatModel->getCatByQueID($que_id);
                        }
                        echo $cat['que_cate_name'];
                        ?>
                    </strong>
                </h4>


            </div>




            <div class="card-body ">
                <h4 class="card-title">
                    <strong>Nhãn</strong>
                </h4>
                <div class="list-tag">
                    <?php
                    // ---------------
                    // Tags
                    // ---------------
                    $queLabelModel = new QuestionLabelModel();
                    if (isset($_GET['que_id'])) {
                        $que_id = $_GET['que_id'];
                        $arrayTags = $queLabelModel->findArrayLabelOfQuestion($que_id);
                        console_log($arrayTags);
                        foreach ($arrayTags as $tag) {
                            echo '   <div class="tag mx-1"> <a href="">#' . $tag['label_name'] . ' </a> </div>';
                        }
                    }




                    ?>


                </div>

            </div>
        </div>
    </div>

</div>



<?php
// ----------------------
// handle rating question 
// ----------------------
if (isset($_GET['rating_status']) && isset($_GET['user_id']) && !isset($_GET['ans_id'])) {
    $rating_status = $_GET['rating_status'];

    switch ($rating_status) {
        case 'like':

            $ratingQuestionModel = new RatingQuestionModel();
            $user_id = $_GET['user_id'];
            $que_id = $_GET['que_id'];
            $rating_status = $_GET['rating_status'];

            $allUserLikeRating = $ratingQuestionModel->allLike();

            $is_liked = false;

            foreach ($allUserLikeRating as $allLike) {
                if ($allLike['que_id'] == $que_id && $allLike['user_id'] == $user_id) {
                    $is_liked = true;
                }
            }

            if ($is_liked == false) {
                $ratingQuestionModel->likeRatingByUserHandle($user_id, $que_id);
                echo "<script>location.href='/mini-q2a?action=question-queue-detail&que_id=$que_id'</script>";
            } else {
                $ratingQuestionModel->unLikeRatingByUserHandle($user_id, $que_id);
                echo "<script>location.href='/mini-q2a?action=question-queue-detail&que_id=$que_id'</script>";
            }





            break;
        case 'spam':
            $ratingQuestionModel = new RatingQuestionModel();
            $user_id = $_GET['user_id'];
            $que_id = $_GET['que_id'];


            $allSpamData = $ratingQuestionModel->allSpam();

            $is_spamed = false;

            foreach ($allSpamData as $allSpam) {
                if ($allSpam['que_id'] == $que_id && $allSpam['user_id'] == $user_id) {
                    $is_spamed = true;
                }
            }

            if ($is_spamed == false) {
                $ratingQuestionModel->spamRatingByUserHandle($user_id, $que_id);
                echo "<script>location.href='/mini-q2a?action=question-queue-detail&que_id=$que_id'</script>";
            } else {
                $ratingQuestionModel->unSpamRatingByUserHandle($user_id, $que_id);
                echo "<script>location.href='/mini-q2a?action=question-queue-detail&que_id=$que_id'</script>";
            }

            break;
        case 'bad_content':

            $ratingQuestionModel = new RatingQuestionModel();
            $user_id = $_GET['user_id'];
            $que_id = $_GET['que_id'];


            $allBadContent = $ratingQuestionModel->allBadContent();

            $is_badContented = false;

            foreach ($allBadContent as $allBad) {
                if ($allBad['que_id'] == $que_id && $allBad['user_id'] == $user_id) {
                    $is_badContented = true;
                }
            }

            if ($is_badContented == false) {
                $ratingQuestionModel->badContentRatingByUserHandle($user_id, $que_id);
                echo "<script>location.href='/mini-q2a?action=question-queue-detail&que_id=$que_id'</script>";
            } else {
                $ratingQuestionModel->unBadContentRatingByUserHandle($user_id, $que_id);
                echo "<script>location.href='/mini-q2a?action=question-queue-detail&que_id=$que_id'</script>";
            }
            break;

        default:
            # code...
            break;
    }
}
?>



<?php
// ----------------------
// handle rating answer 
// ----------------------
if (isset($_GET['rating_status']) && isset($_GET['user_id']) && isset($_GET['ans_id'])) {
    $rating_status = $_GET['rating_status'];

    switch ($rating_status) {
        case 'like':


            $ratingQuestionModel = new RatingAnswerModel();
            $user_id = $_GET['user_id'];
            $que_id = $_GET['que_id'];
            $ans_id = $_GET['ans_id'];
            $rating_status = $_GET['rating_status'];

            $allUserLikeRating = $ratingQuestionModel->allLike();

            $is_liked = false;

            foreach ($allUserLikeRating as $allLike) {
                if ($allLike['ans_id'] == $ans_id && $allLike['user_id'] == $user_id) {
                    $is_liked = true;
                }
            }

            if ($is_liked == false) {
                $ratingQuestionModel->likeRatingByUserHandle($user_id, $ans_id);
                echo "<script>location.href='/mini-q2a?action=question-queue-detail&que_id=$que_id'</script>";
            } else {
                $ratingQuestionModel->unLikeRatingByUserHandle($user_id, $ans_id);
                echo "<script>location.href='/mini-q2a?action=question-queue-detail&que_id=$que_id'</script>";
            }





            break;
        case 'spam':
            $ratingQuestionModel = new RatingAnswerModel();
            $user_id = $_GET['user_id'];
            $que_id = $_GET['que_id'];
            $ans_id = $_GET['ans_id'];



            $allUserSpamRating = $ratingQuestionModel->allSpam();

            $is_spamed = false;

            foreach ($allUserSpamRating as $allSpam) {
                if ($allSpam['ans_id'] == $ans_id && $allSpam['user_id'] == $user_id) {
                    $is_spamed = true;
                }
            }

            if ($is_spamed == false) {
                $ratingQuestionModel->spamRatingByUserHandle($user_id, $ans_id);
                echo "<script>location.href='/mini-q2a?action=question-queue-detail&que_id=$que_id'</script>";
            } else {
                $ratingQuestionModel->unSpamRatingByUserHandle($user_id, $ans_id);
                echo "<script>location.href='/mini-q2a?action=question-queue-detail&que_id=$que_id'</script>";
            }

            break;
        case 'bad_content':

            $ratingQuestionModel = new RatingAnswerModel();
            $user_id = $_GET['user_id'];
            $que_id = $_GET['que_id'];
            $ans_id = $_GET['ans_id'];


            $allUserBadContentRating = $ratingQuestionModel->allBadContent();

            $is_badContented = false;

            foreach ($allUserBadContentRating as $allBadContent) {
                if ($allBadContent['ans_id'] == $ans_id && $allBadContent['user_id'] == $user_id) {
                    $is_badContented = true;
                }
            }

            if ($is_badContented == false) {
                $ratingQuestionModel->badContentRatingByUserHandle($user_id, $ans_id);
                echo "<script>location.href='/mini-q2a?action=question-queue-detail&que_id=$que_id'</script>";
            } else {
                $ratingQuestionModel->unBadContentRatingByUserHandle($user_id, $ans_id);
                echo "<script>location.href='/mini-q2a?action=question-queue-detail&que_id=$que_id'</script>";
            }
            break;

        default:
            # code...
            break;
    }
}
?>