<style>
    .layout {
        min-height: 500px;
    }
</style>

<div class="my-3">
    <div class="row">
        <div class="col-sm-12 col-md-12">
            <div class="card layout p-5">
                <table class="table table-hover ">
                    <thead>
                        <tr>
                            <th>Tên người dùng</th>
                            <th>Loại người dùng</th>
                            <th>Số câu hỏi</th>
                            <th>Số câu trả lời</th>
                            <th>Hạng</th>
                            <th>Tháng</th>
                            <th>Năm</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $rankData = $data[0];

                        foreach ($rankData as $rank) {
                            echo '
                            <tr>
                                <td >' . $rank['user_name'] . ' </td>
                                <td >' . $rank['user_type'] . ' </td>
                                <td >' . $rank['num_question'] . ' </td>
                                <td >' . $rank['num_answer'] . ' </td>
                                <td >' . $rank['total_count_ranking'] . ' </td>';

                            if ($rank['queMonth'] == 0) {
                                echo '<td>' . $rank['ansMonth'] . '</td>';
                            } else {
                                echo '<td>' . $rank['queMonth'] . '</td>';
                            }

                            echo '<td>2021</td>';
                            echo   '</tr>';
                        }



                        ?>



                    </tbody>
                </table>

            </div>
        </div>

    </div>
</div>


<?php
echo strtotime("2021-05-13 20:47:41");
?>