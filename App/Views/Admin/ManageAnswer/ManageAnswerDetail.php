<style>
    .que_detail_bg {
        background-color: #343a40 !important;
        color: var(--near-white);

    }

    .gr-btn-report {

        display: flex;
    }

    p a:hover {
        color: red;
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

        <h6>Mã câu hỏi: <?php echo $data[0]['que_id']; ?> </h6>



        <h4>
            <div>
                <h5>Trả lời bởi <?php
                                echo ' <strong>' . $data[0]['user_name'] . '</strong>';
                                echo '<span class="float-right"> 
                                ' . $data[0]['createdAt'] . '
                    
                                </span>';
                                ?>



                </h5>

            </div>

            <?php





            ?>
        </h4>

    </div>
    <div class="card-body">

        <div class=" p-3">
            <?php
            echo $data[0]['ans_content'];
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
                $ans_id = $data[0]['ans_id'];
                echo '  <a href="/admin?action=answer-detail&ans_id=' . $ans_id . '&is_accepted=1" class="btn btn-success">Duyệt</a>';
            } else {

                $ans_id = $data[0]['ans_id'];
                echo '<a href="/admin?action=answer-detail&ans_id=' . $ans_id . '&is_accepted=0" class="btn btn-danger">Bỏ duyệt</a>';
            }
            ?>


        </div>


    </div>
</div>

<hr>


<?php

$is_accepted = null;
$ans_id = $data[0]['ans_id'];

if (isset($_GET['is_accepted'])) {
    $is_accepted = $_GET['is_accepted'];
}
$is_accepted = $_GET['is_accepted'];

if ($is_accepted == '1') {
    $adModel = new AdminModel();
    $adModel->AcceptAnswerHandle($ans_id, $is_accepted);
}


if ($is_accepted == '0') {
    $adModel = new AdminModel();
    $adModel->AcceptAnswerHandle($ans_id, $is_accepted);
}

?>