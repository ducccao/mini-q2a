<div class="container">

    <div class="card mt-3">
        <div class="card-header">
            <h4>Danh sách cho câu hỏi</h4>

        </div>
        <div class="card-body">


            <table id="table_quecate" class="table table-hover">
                <thead>
                    <tr>
                        <th scope="col">ID</th>
                        <th scope="col">Tiêu đề</th>
                        <th scope="col">Mã người hỏi</th>
                        <th scope="col">Trạng thái duyệt</th>
                        <th scope="col">Mã loại câu hỏi </th>
                        <th scope="col">Ngày tạo</th>
                        <th scope="col">Gán nhãn</th>

                    </tr>
                </thead>


                <tbody>

                    <?php

                    foreach ($data[0]  as $qq) {
                        echo ' <tr>';
                        echo "<td>$qq[que_id] </td>";
                        echo "<td>$qq[que_title] </td>";

                        echo "<td>$qq[user_id] </td>";
                        echo "<td>$qq[is_accepted]</td>";
                        echo "<td>$qq[que_cate_id] </td>";
                        echo "<td>$qq[createdAt] </td>";

                        echo '
                            <td>
                            <a 
                            class="btn btn-primary" 
                            href="/admin?action=add-label-to-question&que_id=' . $qq['que_id'] . '" 
                            >
                            Gán nhãn
                            </a>
                            </td>
                        ';



                        echo "</tr>";
                    }
                    ?>



                </tbody>
            </table>
        </div>
        <div class="card-footer text-muted">
            <!-- Button trigger modal -->
            <!-- <button type="button" class="btn btn-success" data-toggle="modal" data-target="#fmAddQuestionCate">
                Thêm loại câu hỏi
            </button> -->

        </div>
    </div>


</div>