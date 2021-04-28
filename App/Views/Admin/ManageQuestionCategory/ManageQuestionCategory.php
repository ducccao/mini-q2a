<?php

?>



<div class="container">

    <div class="card mt-3">
        <div class="card-header">
            <h4>Tất cả loại câu hỏi</h4>

        </div>
        <div class="card-body">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th scope="col">ID</th>
                        <th scope="col">Tên loại câu hỏi</th>

                    </tr>
                </thead>

                <tbody>

                    <?php

                    foreach ($data[0]  as $questionCate) {
                        echo ' <tr>';
                        echo ' <th scope="row">' . $questionCate['que_cate_id'] . ' </th>';
                        echo ' <td>' . $questionCate['que_cate_name'] . '</td>';
                        echo '  </tr>';
                    }
                    ?>



                </tbody>
            </table>
        </div>
        <div class="card-footer text-muted">
            <!-- Button trigger modal -->
            <button type="button" class="btn btn-dark" data-toggle="modal" data-target="#fmAddQuestionCate">
                Thêm loại câu hỏi
            </button>

        </div>
    </div>


</div>



<!-- Modal -->
<form class="modal fade" id="fmAddQuestionCate" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Thêm loại câu hỏi</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label for="txtQuestionCateName">Tên loại</label>
                    <input type="text" class="form-control" name="txtQuestionCateName" id="txtQuestionCateName" aria-describedby="helpId" placeholder="">
                    <!-- <small id="helpId" class="form-text text-muted">Help text</small> -->
                </div>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-primary">Thêm</button>

                <button type="button" class="btn btn-dark" data-dismiss="modal">Đóng</button>
            </div>
        </div>
    </div>
</form>

<script>
    fmAddQuestionCate = $("#fmAddQuestionCate");
    fmAddQuestionCate.on("submit", function(e) {
        e.preventDefault();

        <?php

        use App\Models\QuestionCategoryModel;

        if (isset($_REQUEST['txtQuestionCateName'])) {
            $que_cate_name = $_REQUEST['txtQuestionCateName'];

            $quetionCateModel = new QuestionCategoryModel();



            $quetionCateModel->add($que_cate_id, $que_cate_name);
        }


        ?>

        $.ajax({
            type: "GET",
            url: "/?action=admin&typeManage=question-cate",
            data: $("#txtQuestionCateName").val(),
            success: ret => {
                alert(ret);

            },
            error: er => {
                alert(er);
            }

        })
    })
</script>