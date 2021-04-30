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



<div class="row">
    <div class="question col-sm-12 col-md-6 col-lg-8">



        <div class="card my-3 ">

            <?php
            // -------------
            // quetion detail
            // -------------

            use App\Models\QuestionQueueModel;

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
            <div class="card-footer que_detail_bg">


                <span class="float-right gr-btn-report w-100">
                    <a type="button" class="btn btn-light w-50" <?php
                                                                echo 'href="/mini-q2a?action=question-queue-detail&que_id=' . $data[0]['que_id'] . '&report_status=like"';
                                                                ?>>
                        <i class="far fa-thumbs-up"></i>

                        Like</a>

                    <div class="dropdown mx-2  w-50">
                        <button class="btn btn-danger dropdown-toggle w-100" type="button" id="btnReport" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="far fa-flag"></i> Report
                        </button>
                        <div class="dropdown-menu w-100" aria-labelledby="btnReport">
                            <a class="dropdown-item w-100" <?php
                                                            echo 'href="/mini-q2a?action=question-queue-detail&que_id=' . $data[0]['que_id'] . '&report_status=spam"';
                                                            ?>>Spam</a>
                            <a class="dropdown-item w-100" <?php
                                                            echo 'href="/mini-q2a?action=question-queue-detail&que_id=' . $data[0]['que_id'] . '&report_status=bad_content"';
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

                echo '<div class="card-header  ">';

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

                echo '   <div class="card-footer bg-light  review_status_wrapper">';


                $qqModel = new QuestionQueueModel();
                $like_ans_count = $qqModel->getLikeRatingAnswersByAnsID($ans['ans_id']);
                $spam_ans_count = $qqModel->getSpamRatingAnswersByAnsID($ans['ans_id']);
                $badContent_ans_count = $qqModel->getBadContentRatingAnswersByAnsID($ans['ans_id']);



                echo '<div class="review_status"><span>' .  $like_ans_count['like_count'] . ' 
                 </span><i class="far fa-thumbs-up mx-2"></i>Like</div>';


                echo '<div class="review_status"><span>' . $spam_ans_count['spam_count'] . '</span><i class="fas fa-redo-alt mx-2"></i> Spam</div>';

                echo '<div class="review_status"><span>' . $badContent_ans_count['bad_content_count'] . '</span><i class="far fa-thumbs-down mx-2"></i>Bad content</div>

                             </div>';



                echo '
<div class="card-footer   ">';
                echo '
<div>
<span class="float-right gr-btn-report">
<a type="button" class="btn btn-light" 
href="/mini-q2a?action=question-queue-detail&que_id=' . $ans['que_id'] . '&ans_id=' . $ans['ans_id'] . '&report_status=like">
    <i class="far fa-thumbs-up"></i>

    Like</a>

<div class="dropdown mx-2 ">
    <button class="btn btn-danger dropdown-toggle" type="button" id="btnReport" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        <i class="far fa-flag"></i> Report
    </button>
    <div class="dropdown-menu" aria-labelledby="btnReport">
        <a class="dropdown-item"
          href="/mini-q2a?action=question-queue-detail&que_id=' . $ans['que_id'] . '&ans_id=' . $ans['ans_id'] . '&report_status=spam"; >Spam</a>
          <a class="dropdown-item"
          href="/mini-q2a?action=question-queue-detail&que_id=' . $ans['que_id'] . '&ans_id=' . $ans['ans_id'] . '&report_status=bad_content"; >Bad content</a>
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
            <div class="card-header">
                Header
            </div>
            <div class="card-body">
                <h4 class="card-title">Title</h4>
                <p class="card-text">Text</p>
            </div>
            <div class="card-footer text-muted">
                Footer
            </div>
        </div>
    </div>

</div>