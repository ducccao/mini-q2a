<style>
    .que_detail_bg {
        background-color: #343a40 !important;
        color: var(--near-white);

    }

    .gr-btn-report {

        display: flex;
    }
</style>


<div class="card my-3 ">

    <?php
    // -------------
    // quetion detail
    // -------------



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
    <div class="card-footer que_detail_bg">
        <div>
            <button type="button" class="btn btn-success">Trả lời</button>

            <span class="float-right gr-btn-report">
                <a type="button" class="btn btn-warning" <?php
                                                            echo 'href="/mini-q2a?action=question-queue-detail&que_id=' . $data[0]['que_id'] . '&report_status=like"';
                                                            ?>>
                    <i class="far fa-thumbs-up"></i>

                    Like</a>

                <div class="dropdown mx-2 ">
                    <button class="btn btn-danger dropdown-toggle" type="button" id="btnReport" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="far fa-flag"></i> Report
                    </button>
                    <div class="dropdown-menu" aria-labelledby="btnReport">
                        <a class="dropdown-item" <?php
                                                    echo 'href="/mini-q2a?action=question-queue-detail&que_id=' . $data[0]['que_id'] . '&report_status=spam"';
                                                    ?>>Spam</a>
                        <a class="dropdown-item" <?php
                                                    echo 'href="/mini-q2a?action=question-queue-detail&que_id=' . $data[0]['que_id'] . '&report_status=bad_content"';
                                                    ?>>Bad content</a>
                    </div>
                </div>


            </span>
        </div>
    </div>
</div>

<hr>








<?php
// -------------
// Handle Answer
// -------------



foreach ($data[1] as $ans) {
    echo '<div class="card my-5">';

    echo '<div class="card-header   bg-info">';

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

    echo '
    <div class="card-footer   bg-info">';
    echo '
    <div>
    <span class="float-right gr-btn-report">
    <a type="button" class="btn btn-warning" 
    href="/mini-q2a?action=question-queue-detail&que_id=' . $ans['que_id'] . '&&ans_id=' . $ans['ans_id'] . '&report_status=like">
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