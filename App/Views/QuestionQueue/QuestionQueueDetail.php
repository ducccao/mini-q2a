<style>
    .que_detail_bg {

        background-color: var(--near-white);

        color: black;

    }

    .gr-btn-report {

        display: flex;
    }

    .review_status_wrapper {
        background-color: transparent !important;


        display: flex;
        justify-content: space-between;

    }

    .ans_wrapper {
        background-color: #e3e7e8;
    }

    .common-bg {
        background-color: var(--near-white);

    }

    .card {
        background-color: #fff;
    }

    a:hover {
        text-decoration: none;
    }

    .tag_sticky {
        position: sticky;
        top: 20px;
    }

    .timing_sticky {
        position: sticky;
        top: 240px;
    }
</style>


<!-- wysiwyg toys -->
<script src="https://cdn.tiny.cloud/1/6a2wdzaqh764emfqjwf4g5s2kr8ajq1vbfrcipng9eu1o2il/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>




<?php

if (!isset($_SESSION['user_type'])) {
    $user_type = "anonymous";
}


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

            use App\Models\AnswerModel;
            use App\Models\QuestionCategoryModel;
            use App\Models\QuestionLabelModel;
            use App\Models\QuestionQueueModel;
            use App\Models\RatingQuestionModel;
            use App\Models\RatingAnswerModel;
            use App\Models\UserModel;

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



                <span class="float-right gr-btn-report">

                    <a type="button" class="btn btn-light " <?php
                                                            echo 'href="/mini-q2a?action=question-queue-detail&que_id=' . $data[0]['que_id'] . '&rating_status=like&user_id=' . $curr_user_id . '"';
                                                            ?>>
                        <i class="far fa-thumbs-up"></i>

                        Like</a>

                    <div class="dropdown mx-2  ">
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




        </div>
        <hr>

        <?php
        // --------------
        // handle answer
        // --------------

        if ($user_type != 'anonymous') {
            if (isset($_GET['que_id'])) {
                $que_id = $_GET['que_id'];
            }
            echo "       <h5 class'text-title'>
         Gửi câu trả lời
        </h5>";
            echo '<form class="upload-wrapper " method="GET" >';
            echo '<input  name="action" value="question-queue-detail" class="d-none" />';
            echo '<input  name="que_id" value="' . $que_id . '" class="d-none" />';

            echo '    <textarea id="txtAnsContent" name="txtAnsContent"></textarea>';
            echo ' <button class="btn btn-success  my-3 px-5">Gửi</button>';
            echo '</form>';
        }

        ?>


        <script>
            tinymce.init({
                selector: '#txtAnsContent',
                plugins: 'advlist autolink lists link image charmap print preview hr anchor pagebreak',
                toolbar_mode: 'floating',
            });
        </script>


        <hr>


        <?php
        if (count($data[1]) == 0) {
            echo "<style>.ans_wrapper{display:none;}</style>";
        }
        ?>

        <div class="ans_wrapper my-3">

            <?php
            // ---------------------------
            // Handle show List Answer
            // ---------------------------



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


            <?php

            if (isset($_GET['que_id'])) {
                $que_id = $_GET['que_id'];
            }

            echo '<nav aria-label="Page navigation example ">
            <ul class="pagination float-right">';
            if ((int)$_GET['pagi'] == 1) {
                echo '<li class="page-item disabled"><a class="page-link" href="#">Previous</a></li>';
            } else {
                echo '<li class="page-item"><a class="page-link" href="/mini-q2a?action=question-queue-detail&que_id=que_01&pagi=' . ((int)$_GET['pagi'] - 1) . '">Previous</a></li>';
            }


            for ($i = 1; $i <= $data[8]; $i++) {
                if ($i == (int)$_GET['pagi']) {
                    echo '
                    <li class="page-item active"><a class="page-link " href="/mini-q2a?action=question-queue-detail&que_id=' . $que_id . '&pagi=' . $i . '">' . $i . '</a></li>
                    ';
                } else {
                    echo '
                    <li class="page-item"><a class="page-link" href="/mini-q2a?action=question-queue-detail&que_id=' . $que_id . '&pagi=' . $i . '">' . $i . '</a></li>
                    ';
                }
            }

            if ((int)$_GET['pagi'] == $data[8]) {
                echo '<li class="page-item disabled"><a class="page-link" href="#">Next</a></li>';
            } else {
                echo '<li class="page-item"><a class="page-link" href="/mini-q2a?action=question-queue-detail&que_id=que_01&pagi=' . ((int)$_GET['pagi'] + 1) . '">Next</a></li>';
            }
            echo ' </ul>
              </nav>';


            ?>
        </div>

    </div>
    <div class="question col-sm-12 col-md-6 col-lg-4">


        <div class="card my-3 tag_sticky">
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


                <?php
                // ---------------
                // Tags
                // ---------------
                $queLabelModel = new QuestionLabelModel();
                if (isset($_GET['que_id'])) {
                    $que_id = $_GET['que_id'];
                    $arrayTags = $queLabelModel->findArrayLabelOfQuestion($que_id);
                    console_log($arrayTags);

                    if (count($arrayTags) > 0) {
                        echo '  <h4 class="card-title">
<strong>Tags</strong>
</h4>';


                        echo "   <div class='list-tag'>";
                        foreach ($arrayTags as $tag) {

                            echo '   <div class="tag mx-1"> <a href="/mini-q2a?action=question-queue&tag_id=' . $tag['label_id'] . '">#' . $tag['label_name'] . ' </a> </div>';
                        }
                        echo "  </div>";
                    }
                }




                ?>




            </div>
        </div>

        <div class="card  timing_sticky">

            <div class="card-body">
                <h4 class="card-title">Bộ lọc câu trả lời</h4>

                <form action="/mini-q2a" id="fmTimingDESC" method="GET">
                    <input class="d-none" type="text" name="action" value="question-queue-detail">
                    <input class="d-none" type="text" name="que_id" <?php echo 'value=' . $que_id ?>>
                    <div class="form-check">
                        <label class="form-check-label">
                            <input type="checkbox" class="form-check-input" name="txtFilterByTime" id="txtFilterByTimingDESC" value="DESC" <?php
                                                                                                                                            if (isset($_GET['txtFilterByTime'])) {
                                                                                                                                                $txtFilterByTime = $_GET['txtFilterByTime'];
                                                                                                                                                if ($txtFilterByTime == "DESC") {
                                                                                                                                                    echo "checked";
                                                                                                                                                }
                                                                                                                                            }
                                                                                                                                            ?>>
                            Mới nhất
                        </label>
                    </div>

                </form>
                <form action="/mini-q2a" id="fmTimingASC" method="GET">
                    <input class="d-none" type="text" name="action" value="question-queue-detail">
                    <input class="d-none" type="text" name="que_id" <?php echo 'value=' . $que_id ?>>
                    <div class="form-check">
                        <label class="form-check-label">
                            <input type="checkbox" class="form-check-input" name="txtFilterByTime" id="txtFilterByTimingASC" value="ASC" <?php
                                                                                                                                            if (isset($_GET['txtFilterByTime'])) {
                                                                                                                                                $txtFilterByTime = $_GET['txtFilterByTime'];
                                                                                                                                                if ($txtFilterByTime == "ASC") {
                                                                                                                                                    echo "checked";
                                                                                                                                                }
                                                                                                                                            }
                                                                                                                                            ?>>
                            Cũ nhất
                        </label>
                    </div>

                </form>

                <script>
                    const txtFilterByTimingDESC = $("#txtFilterByTimingDESC");
                    const txtFilterByTimingASC = $("#txtFilterByTimingASC");
                    const fmTimingASC = $("#fmTimingASC");
                    const fmTimingDESC = $("#fmTimingDESC");

                    txtFilterByTimingASC.on("change", function(e) {
                        if (this.checked) {
                            fmTimingASC.submit();
                        }
                    })
                    txtFilterByTimingDESC.on("change", function(e) {
                        if (this.checked) {
                            fmTimingDESC.submit();
                        }
                    })
                </script>
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



<?php
// -------------------------------
// handling Add Answer content
// -------------------------------

if (isset($_GET['txtAnsContent'])) {
    $ans_content = $_GET['txtAnsContent'];
    $que_id = $_GET['que_id'];


    $ansModel = new AnswerModel();
    $userModel = new UserModel();

    $ans_id = randomString(10);
    $ans_source_URL = "none";
    $ans_images = "none";
    $user_id = $curr_user_id;
    $is_accepted = 0;


    $ret = $ansModel->add(
        $ans_id,
        $ans_content,
        $ans_source_URL,
        $ans_images,
        $que_id,
        $user_id,
        $is_accepted
    );

    if ((int)$ret == 1) {
        echo "<script>
        Swal.fire({
            icon: 'success',
            title: 'Câu trả lời của bạn đang được duyệt!',
            showConfirmButton: false,
            timer: 3000
          });
        </script>";
    } else {
        echo "<script>
        Swal.fire({
            icon: 'success',
            title: 'Gửi thất bại!',
            showConfirmButton: false,
            timer: 3000
          });
        </script>";
    }

    console_log($ret);
}

?>