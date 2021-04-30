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

    use App\Models\AdminModel;



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
            <?php
            $is_accepted = null;

            if (isset($_GET['is_accepted'])) {
                $is_accepted = $_GET['is_accepted'];
            }
            $is_accepted = $_GET['is_accepted'];
            ?>

            <?php
            //     echo 'current is accepted: ' . $is_accepted;
            $error_flag = false;

            if ($is_accepted == '0') {
                $que_id = $data[0]['que_id'];
                echo '  <a href="/admin?action=question-detail&que_id=' . $que_id . '&is_accepted=1" class="btn btn-success">Duyệt</a>';
            } else {

                $que_id = $data[0]['que_id'];
                echo '<a href="/admin?action=question-detail&que_id=' . $que_id . '&is_accepted=0" class="btn btn-danger">Bỏ duyệt</a>';
            }
            ?>


        </div>


    </div>
</div>

<hr>


<?php

$is_accepted = null;
$que_id = $data[0]['que_id'];

if (isset($_GET['is_accepted'])) {
    $is_accepted = $_GET['is_accepted'];
}
$is_accepted = $_GET['is_accepted'];

if ($is_accepted == '1') {
    $adModel = new AdminModel();
    $adModel->AcceptQuestionHandle($que_id, $is_accepted);
}


if ($is_accepted == '0') {
    $adModel = new AdminModel();
    $adModel->AcceptQuestionHandle($que_id, $is_accepted);
}

?>