<?php

use App\Models\LabelModel;
use App\Models\QuestionQueueModel;
use App\Models\QuestionCategoryModel;
use App\Models\QuestionLabelModel;

?>


<style>
    .upload-wrapper {
        background-color: var(--common-bg);
        border-radius: var(--border-radius);
    }

    .ql-toolbar {
        background-color: white;

    }
</style>

<!-- wysiwyg toys -->
<script src="https://cdn.tiny.cloud/1/6a2wdzaqh764emfqjwf4g5s2kr8ajq1vbfrcipng9eu1o2il/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>




<form class="upload-wrapper p-3 my-3" method="GET">
    <input type="text" class="form-control d-none" name="action" value="user-upload-question" id="action" aria-describedby="helpId" placeholder="">

    <div class="form-group">
        <label for="txtTitle"><strong>Tiêu đề</strong> </label>
        <input type="text" class="form-control" name="txtTitle" id="txtTitle" aria-describedby="helpId" placeholder="">
    </div>

    <?php

    $qCatModel = new QuestionCategoryModel();
    $allQuestionCat = $qCatModel->all();
    echo "  <div class='form-group'>";
    echo "  <label for='txtQueCat'><strong>Danh mục</strong> </label>";
    echo '<select name="txtQueCat" class="custom-select" aria-label="Default select example">';
    // echo '<option  disabled selected></option>';
    foreach ($allQuestionCat as $qCat) {
        echo "<option value='$qCat[que_cate_id]' >$qCat[que_cate_name]</option>";
    }
    echo '</select>';
    echo "  </div>";

    ?>



    <div class="form-group">
        <label for="txtTitle"><strong>Nội dung</strong> </label>

        <textarea id="txtContent" name="txtContent"></textarea>
    </div>

    <div class="form-group">
        <label for="txtTags"><strong>Nhãn</strong> </label>

        <input class="form-control" type="text" name="txtTags">
        <small class="text-black">Ngăn cách bởi khoảng trắng</small>
    </div>



    <button class="btn btn-dark ">Đăng câu hỏi</button>
</form>


<script>
    tinymce.init({
        selector: '#txtContent',
        plugins: 'advlist autolink lists link image charmap print preview hr anchor pagebreak',
        toolbar_mode: 'floating',
    });
</script>




<?php

if (isset($_GET['txtContent'])) {
    $que_title = $_GET['txtTitle'];
    $que_content = $_GET['txtContent'];
    $que_cate_id = $_GET['txtQueCat'];
    $error_flag = false;
    $user_full_info = $_SESSION['user_full_info'];
    $user_id = $_SESSION['user_id'];

    $que_id = randomString(10);



    if ($que_content == '' || $que_title == '') {
        echo "<script>
        Swal.fire({
            icon: 'error',
            title: 'Nội dung hoặc tiêu đề trống!',
            showConfirmButton: false,
            timer: 2500
          });
        </script>";
        $error_flag = true;
    }

    $qqModel = new QuestionQueueModel();

    $allQQ = $qqModel->all();

    foreach ($allQQ as $qq) {
        if ($qq['que_title'] == $que_title) {
            echo "<script>
            Swal.fire({
                icon: 'error',
                title: 'Tiêu đề đã tồn tại!',
                showConfirmButton: false,
                timer: 2500
              });
            </script>";
            $error_flag = true;
        }
        if ($qq['que_id'] == $que_id) {
            echo "<script>
            Swal.fire({
                icon: 'error',
                title: 'Đăng câu hỏi thất bại!',
                showConfirmButton: false,
                timer: 2500
              });
            </script>";
            $error_flag = true;
        }
    }

    if ($error_flag == false) {

        $ret = $qqModel->add($que_id, $que_content, $que_title, $user_id, $que_cate_id);



        // --------------
        // Tags handler
        // --------------

        if (isset($_GET['txtTags'])) {
            $tags = $_GET['txtTags'];

            $arrayTag = explode(" ", $tags);

            // Handle Repeat tag from user
            $arrayTag = array_unique($arrayTag);




            $isTagExists = false;

            foreach ($arrayTag as $tag) {
                if ($tag !== "") {
                    $labelModel = new LabelModel();
                    $quetionLabelModel = new QuestionLabelModel();

                    $tagsData = $labelModel->all();

                    // check tag exists
                    foreach ($tagsData as $tagsData) {
                        if ($tagsData['label_name'] == $tag) {
                            $isTagExists = true;
                            break;
                        }
                    }


                    if ($isTagExists == false) {
                        $label_id = randomString(10);

                        // check case sensitive
                        $vnBadWords = [
                            "đụ",
                            "cụ",
                            "đù",
                            "đụ má",
                            "má mày",
                            "má",
                            "mày",
                            "địt",
                            "cặc",
                            "lồn",
                            "đĩ",
                            "điếm",
                            "thúi",
                            "quần què",
                            "đéo",
                            "vãi",
                            "ngu",
                            "cứt",
                            "chó chết",
                            "Chết mẹ",
                            "đi ăn cứt",
                            "ăn máu lồn",
                        ];

                        $badword_flag = false;

                        foreach ($vnBadWords as $bad) {
                            if (str_contains($tag, $bad) == true) {
                                $badword_flag = true;
                                break;
                            }
                        }

                        if ($badword_flag == false) {
                            $labelModel->add($label_id, $tag);
                            $quetionLabelModel->add($que_id, $label_id);
                        }
                    } else {
                        $label_curr = $labelModel->findLabelByLabelName($tag);

                        if (count($label_curr) > 0) {
                            $quetionLabelModel->add($que_id, $label_curr['label_id']);
                        }
                    }
                }
            }
        }

        // --------------
        // End Tags handler
        // --------------

        if ($ret == true) {
            echo "<script>
            Swal.fire({
                icon: 'success',
                title: 'Bài đăng của bạn đang được duyệt!',
                showConfirmButton: false,
                timer: 3000
              });
            </script>";

            $PATH_AUTO_ACCEPT_QUESTION_API_SERVICE = $GLOBALS['PATH_AUTO_ACCEPT_QUESTION_API_SERVICE'];

            $curr_data_added = $qqModel->detailWithAcceptIsFalse($que_id);
            $curr_tag_added = $quetionLabelModel->findArrayLabelOfQuestion($que_id);
            console_log($curr_tag_added);

            $retCallAPI = callAPI("GET", $PATH_AUTO_ACCEPT_QUESTION_API_SERVICE, [$curr_data_added, $curr_tag_added]);

            $retCallAPI = json_decode($retCallAPI, true);
            console_log($retCallAPI);


            if (isset($retCallAPI)) {
                if ($retCallAPI['is_accepted'] == true) {
                    echo "<script>
                    Swal.fire({
                        icon: 'success',
                        title: 'Đăng câu hỏi thành công!',
                        showConfirmButton: false,
                        timer: 3000
                      });
                    </script>";
                } else {
                    echo "<script>
                    Swal.fire({
                        icon: 'error',
                        title: 'Đăng câu hỏi thất bại!',
                        showConfirmButton: false,
                        timer: 2500
                      });
                    </script>";
                }
            }



            //   echo "<script>window.location.assign('$PATH_AUTO_ACCEPT_QUESTION_API_SERVICE')</script>";
        } else {
            echo "<script>
            Swal.fire({
                icon: 'error',
                title: 'Đăng câu hỏi thất bại!',
                showConfirmButton: false,
                timer: 2500
              });
            </script>";
        }
    }
}






?>