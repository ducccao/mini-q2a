<style>
    .body {
        background-color: #ecf0f1;
    }

    .search-bar {
        width: 90% !important;
    }

    .common-bg {
        background-color: var(--common-bg);
    }

    .bg-search-bar {
        background-color: var(--common-bg);
    }

    .home-content {
        display: flex;
    }

    .home-list-question-left {
        min-height: 300px;
        background-color: transparent;
    }

    .home-list-filter-right {
        min-height: 300px;

    }

    .filter_by_cat {
        background-color: var(--near-white);
        border-radius: 5px;
        color: black;
    }

    .filter_by_time {
        background-color: var(--near-white);
        color: black;

        border-radius: 5px;
    }

    .question-queue {
        width: 100%;
        min-height: 80px;
        background-color: lightblue;
        border: 1px solid black;
        color: black;

    }

    .home-content {
        background-color: var(--common-bg);
        border-radius: 5px;
    }


    .question-newest {
        font-weight: bold;
    }

    .question-queue-card {
        min-height: 50px;
        width: 100%;
        background-color: var(--near-white);
        border-radius: var(--border-radius);
    }

    .qq-top-info {
        min-height: 40px;
        width: 100%;
        background-color: transparent;
        display: flex;
        justify-content: space-between;

    }

    .qq-bot-info {

        width: 100%;
        background-color: transparent;
        display: flex;
        justify-content: space-between;
    }


    /* .que-cate-wrapper {}

    .qq-top-left {} */

    .qq-title {
        font-size: 22px;
        font-weight: bold;
    }



    .qq-top-right {
        display: flex;
        align-items: center;
    }

    .qq-bot-left {
        display: flex;
        align-items: flex-end;

    }

    .qq-bot-right {
        display: flex;

    }

    .list-tag {
        display: flex;
        align-items: flex-end;

    }

    .tag {
        border-radius: var(--border-radius);
        background-color: lightblue;
        padding: 4px;
    }

    .like {
        width: 80px;
    }

    .question-category {
        cursor: pointer;
    }

    .que-cate-content {
        display: flex;
        justify-content: space-between;
    }

    .home-list-filter-right {
        color: var(--near-white);
        border-radius: var(--border-radius);

    }

    a:hover {
        color: black;
        text-decoration: none;
    }

    .que_cate_name {
        color: black;
    }

    .time_filter_css {
        color: black;
        font-weight: bold;

    }

    h1,
    h2,
    h3,
    h4,
    h5,
    h6 {
        font-weight: bold;
    }

    .pagi {
        border-top-left-radius: var(--border-radius);
        border-bottom-left-radius: var(--border-radius);
    }

    .pagi-next {
        border-top-right-radius: var(--border-radius);
        border-bottom-right-radius: var(--border-radius);
    }


    .question-cate-active {
        color: #212529;
        background-color: rgba(0, 0, 0, .075);
    }

    .que_title {
        color: initial;
    }

    .que_title:hover {
        color: initial;
    }
</style>


<?php
$PATH_ROOT = $GLOBALS['PATH_ROOT'];

?>



<div class="home-content p-3 my-3">
    <div class="home-list-question-left w-75   ">

        <div class="question-newest">
            <h3 class="">Danh sách câu hỏi</h3>
        </div>



        <?php



        foreach ($this->data[0]  as $qq) {
            $flag = 0;


            echo '
        
            <div class="question-queue-card p-3 my-3">
          
            <div class="qq-top-info">
                <div class="qq-top-left">

                    <div class="qq-title">
                    <a class="que_title" href=  ' .   $PATH_ROOT . '?action=question-queue-detail&que_id=' . $qq["que_id"] . '>
                      ' .   $qq["que_title"] . '
                      </a>
                    </div>
                    <div class="qq-username">
                        <p>
                        ' .   $qq["user_name"] . '
                        </p>
                    </div>
                </div>

                <div class="qq-top-right">
                    <div>
                    ' .   $qq["createdAt"] . '
                    </div>

                </div>

            </div>
            <div class="qq-bot-info">

                <div class="qq-bot-left">

                    <div class="like-wrapper">
                        <span class="badge ">
                        ';

            // Put The Like Count right there 



            foreach ($data[3] as $like_count) {

                if ($qq['que_id'] ==  $like_count['que_id']) {
                    if ($like_count['like_count'] > 0) {
                        echo $like_count['like_count'];
                        $flag = 1;
                        break;
                    }
                }
            };

            if ($flag == 0) {
                echo "0";
            }

            echo

            ' 
                        </span>

                        <i class="far fa-thumbs-up like"></i>

                    </div>
                </div>
                <div class="qq-bot-right">
                    <div class="list-tag">
  
            ';

            // put tag[i] right there ! 

            foreach ($this->data[2]  as $tags => $tag) {

                if ($tag['que_id'] == $qq['que_id']) {
                    echo '       <div class="tag mx-1">    <a href="/mini-q2a?action=question-queue&tag_id=' . $tag['label_id'] . '">';
                    echo  "#" . $tag['label_name'];
                    echo '    </a>      </div>';
                }
            }


            echo   '

    </div>
    
</div>
</div>
</div> ';
        }
        ?>


        <nav aria-label="Page navigation example">
            <ul class="pagination justify-content-end">



                <?php
                // ------------------------
                // handle filter by time
                // ------------------------


                if (isset($_GET['txtTimeNewest'])) {
                    // ------------------
                    // case newest time
                    // ------------------
                    $pagi_curr = $data[5];
                    $questionCate = '';
                    if (isset($data[6])) {
                        $questionCate = $data[6];
                    }
                    // ------------------------------
                    // handle Previous Pagi
                    // ------------------------------
                    if ($pagi_curr == 1) {
                        echo "   <li class='page-item disabled '>
                        <a class='page-link pagi' href='#'>Previous</a>
                    </li>";
                    } else {

                        if ($questionCate != '') {

                            $temp_pagi_cur_previous = $pagi_curr - 1;
                            echo "   <li class='page-item '>
                                <a class='page-link pagi' href='$PATH_ROOT?action=question-queue&txtTimeNewest=DESC&questionCate=$questionCate&pagi=$temp_pagi_cur_previous'>Previous</a>
                            </li>";
                        } else {
                            $temp_pagi_cur_previous = $pagi_curr - 1;

                            echo "   <li class='page-item '>
                            <a class='page-link pagi' href='$PATH_ROOT?action=question-queue&txtTimeNewest=DESC&pagi=$temp_pagi_cur_previous'>Previous</a>
                        </li>";
                        }
                    }

                    // ------------------------------
                    // total pagi stuff right there 
                    // ------------------------------

                    for ($i = 1; $i <= $data[4]; ++$i) {
                        if ($data[5] == $i) {
                            $questionCate = '';
                            if (isset($data[6])) {
                                $questionCate = $data[6];
                            }

                            if ($questionCate != '') {

                                echo '  <li class="page-item active"><a  class="page-link " ';
                                echo "  href='$PATH_ROOT?action=question-queue&txtTimeNewest=DESC&questionCate=$questionCate&pagi=$i'";
                                echo ">";
                                echo  $i . "   </a></li>";
                            } else {

                                echo '  <li class="page-item active"><a  class="page-link " ';
                                echo "  href='$PATH_ROOT?action=question-queue&txtTimeNewest=DESC&pagi=$i'";
                                echo ">";
                                echo  $i . "   </a></li>";
                            }
                        } else {
                            $questionCate = '';
                            if (isset($data[6])) {
                                $questionCate = $data[6];
                            }

                            if ($questionCate != '') {
                                echo '  <li class="page-item "><a  class="page-link " ';
                                echo "  href='$PATH_ROOT?action=question-queue&txtTimeNewest=DESC&questionCate=$questionCate&pagi=$i'";
                                echo ">";
                                echo  $i  . "   </a></li>";
                            } else {

                                echo '  <li class="page-item "><a  class="page-link " ';
                                echo "  href='$PATH_ROOT?action=question-queue&txtTimeNewest=DESC&pagi=$i'";
                                echo ">";
                                echo  $i  . "   </a></li>";
                            }
                        }
                    }



                    // -------------------
                    // handle next Pagi
                    // -------------------

                    if ($pagi_curr == $data[4]) {

                        echo " <li class='page-item disabled'> <a class='page-link disabled pagi-next' href='$PATH_ROOT?action=question-queue&txtTimeNewest=DESC&pagi=$pagi_curr'>Next</a> </li> ";
                    } else {
                        $temp_pagi = $pagi_curr + 1;
                        $questionCate = '';
                        if (isset($data[6])) {
                            $questionCate = $data[6];
                        }

                        if ($questionCate != '') {
                            echo "  <li class='page-item'><a class='page-link pagi-next' href='$PATH_ROOT?action=question-queue&txtTimeNewest=DESC&questionCate=$questionCate&pagi=$temp_pagi'>Next</a></li> ";
                        } else {
                            echo "  <li class='page-item'><a class='page-link pagi-next' href='$PATH_ROOT?action=question-queue&txtTimeNewest=DESC&pagi=$temp_pagi'>Next</a></li> ";
                        }
                    }
                } else if (isset($_GET['txtTimeOldest'])) {
                    // ------------------
                    // case oldest time
                    // ------------------


                    $pagi_curr = $data[5];
                    $questionCate = '';
                    if (isset($data[6])) {
                        $questionCate = $data[6];
                    }
                    // ------------------------------
                    // handle Previous Pagi
                    // ------------------------------
                    if ($pagi_curr == 1) {
                        echo "   <li class='page-item disabled '>
                        <a class='page-link pagi' href='#'>Previous</a>
                    </li>";
                    } else {

                        if ($questionCate != '') {

                            $temp_pagi_cur_previous = $pagi_curr - 1;
                            echo "   <li class='page-item '>
                                <a class='page-link pagi' href='$PATH_ROOT?action=question-queue&txtTimeOldest=ASC&questionCate=$questionCate&pagi=$temp_pagi_cur_previous'>Previous</a>
                            </li>";
                        } else {
                            $temp_pagi_cur_previous = $pagi_curr - 1;

                            echo "   <li class='page-item '>
                            <a class='page-link pagi' href='$PATH_ROOT?action=question-queue&txtTimeOldest=ASC&pagi=$temp_pagi_cur_previous'>Previous</a>
                        </li>";
                        }
                    }

                    // ------------------------------
                    // total pagi stuff right there 
                    // ------------------------------

                    for ($i = 1; $i <= $data[4]; ++$i) {
                        if ($data[5]  == $i) {
                            $questionCate = '';
                            if (isset($data[6])) {
                                $questionCate = $data[6];
                            }

                            if ($questionCate != '') {

                                echo '  <li class="page-item active"><a  class="page-link " ';
                                echo "  href='$PATH_ROOT?action=question-queue&txtTimeOldest=ASC&questionCate=$questionCate&pagi=$i'";
                                echo ">";
                                echo  $i  . "   </a></li>";
                            } else {

                                echo '  <li class="page-item active"><a  class="page-link " ';
                                echo "  href='$PATH_ROOT?action=question-queue&txtTimeOldest=ASC&pagi=$i'";
                                echo ">";
                                echo  $i  . "   </a></li>";
                            }
                        } else {
                            $questionCate = '';
                            if (isset($data[6])) {
                                $questionCate = $data[6];
                            }

                            if ($questionCate != '') {
                                echo '  <li class="page-item "><a  class="page-link " ';
                                echo "  href='$PATH_ROOT?action=question-queue&txtTimeOldest=ASC&questionCate=$questionCate&pagi=$i'";
                                echo ">";
                                echo  $i . "   </a></li>";
                            } else {

                                echo '  <li class="page-item "><a  class="page-link " ';
                                echo "  href='$PATH_ROOT?action=question-queue&txtTimeOldest=ASC&pagi=$i'";
                                echo ">";
                                echo  $i . "   </a></li>";
                            }
                        }
                    }



                    // -------------------
                    // handle next Pagi
                    // -------------------

                    if ($pagi_curr == $data[4]) {

                        echo " <li class='page-item disabled'> <a class='page-link disabled pagi-next' href='$PATH_ROOT?action=question-queue&txtTimeOldest=ASC&pagi=$pagi_curr'>Next</a> </li> ";
                    } else {
                        $temp_pagi = $pagi_curr + 1;

                        $questionCate = '';
                        if (isset($data[6])) {
                            $questionCate = $data[6];
                        }

                        if ($questionCate != '') {
                            echo "  <li class='page-item'><a class='page-link pagi-next' href='$PATH_ROOT?action=question-queue&txtTimeOldest=ASC&questionCate=$questionCate&pagi=$temp_pagi'>Next</a></li> ";
                        } else {
                            echo "  <li class='page-item'><a class='page-link pagi-next' href='$PATH_ROOT?action=question-queue&txtTimeOldest=ASC&pagi=$temp_pagi'>Next</a></li> ";
                        }
                    }
                } else {
                    // previous pagi
                    $pagi_curr = $data[5];
                    $questionCate = '';
                    if (isset($data[6])) {
                        $questionCate = $data[6];
                    }

                    if ($pagi_curr == 1) {

                        echo "   <li class='page-item disabled '>
                        <a class='page-link pagi' href='#'>Previous</a>
                    </li>";
                    } else {

                        if ($questionCate != '') {

                            $temp_pagi_cur_previous = $pagi_curr - 1;
                            echo "   <li class='page-item '>
                                <a class='page-link pagi' href='$PATH_ROOT?action=question-queue&questionCate=$questionCate&pagi=$temp_pagi_cur_previous'>Previous</a>
                            </li>";
                        } else {
                            $temp_pagi_cur_previous = $pagi_curr - 1;

                            echo "   <li class='page-item '>
                            <a class='page-link pagi' href='$PATH_ROOT?action=question-queue&pagi=$temp_pagi_cur_previous'>Previous</a>
                        </li>";
                        }
                    }


                    // total pagi stuff right there 
                    for ($i = 1; $i <= $data[4]; ++$i) {
                        if ($data[5]  == $i) {
                            $questionCate = '';
                            if (isset($data[6])) {
                                $questionCate = $data[6];
                            }

                            if ($questionCate != '') {

                                echo '  <li class="page-item active"><a  class="page-link " ';
                                echo "  href='$PATH_ROOT?action=question-queue&questionCate=$questionCate&pagi=$i'";
                                echo ">";
                                echo  $i . "   </a></li>";
                            } else {

                                echo '  <li class="page-item active"><a  class="page-link " ';
                                echo "  href='$PATH_ROOT?action=question-queue&pagi=$i'";
                                echo ">";
                                echo  $i . "   </a></li>";
                            }
                        } else {
                            $questionCate = '';
                            if (isset($data[6])) {
                                $questionCate = $data[6];
                            }

                            if ($questionCate != '') {
                                echo '  <li class="page-item "><a  class="page-link " ';
                                echo "  href='$PATH_ROOT?action=question-queue&questionCate=$questionCate&pagi=$i'";
                                echo ">";
                                echo  $i . "   </a></li>";
                            } else {

                                echo '  <li class="page-item "><a  class="page-link " ';
                                echo "  href='$PATH_ROOT?action=question-queue&pagi=$i'";
                                echo ">";
                                echo  $i . "   </a></li>";
                            }
                        }
                    }
                    //  next pagi
                    if ($pagi_curr == $data[4]) {

                        echo " <li class='page-item disabled'> <a class='page-link disabled pagi-next' href='$PATH_ROOT?action=question-queue&pagi=$pagi_curr'>Next</a> </li> ";
                    } else {
                        $temp_pagi = $pagi_curr + 1;

                        $questionCate = '';
                        if (isset($data[6])) {
                            $questionCate = $data[6];
                        }

                        if ($questionCate != '') {
                            echo "  <li class='page-item'><a class='page-link pagi-next' href='$PATH_ROOT?action=question-queue&questionCate=$questionCate&pagi=$temp_pagi'>Next</a></li> ";
                        } else {
                            echo "  <li class='page-item'><a class='page-link pagi-next' href='$PATH_ROOT?action=question-queue&pagi=$temp_pagi'>Next</a></li> ";
                        }
                    }
                }


                // -----------------------------
                // End handle filter by time
                // -----------------------------

                ?>






            </ul>
        </nav>


    </div>
    <div class="home-list-filter-right w-25 ml-3">
        <div class="filter_by_cat p-3 my-3">
            <h4 class="">Chủ đề</h4>

            <div class="que-cate-wrapper">
                <table class="table table-hover">
                    <tbody>


                        <?php
                        $questionCate = '';

                        if (isset($_REQUEST['questionCate'])) {
                            $questionCate = $_REQUEST['questionCate'];
                        } else {
                            $questionCate = '';
                        }



                        foreach ($data[1] as $questionCategories) {
                            // echo floor(81 / 10);
                            echo "<tr class='question-category'>";
                            echo '<th scope="row" class ="que-cate-content"> ';
                            echo "<div> <a  href='$PATH_ROOT?action=question-queue&questionCate=$questionCategories[que_cate_id]' 
                class='que_cate_name' >" . $questionCategories["que_cate_name"] . "</a> </div> ";

                            echo "<div class='badge badge-primary p-2'>" . $questionCategories["amount"] . " </div>";
                            echo "   </th>";


                            echo "</tr>";
                        }
                        ?>
                        <th>


                        </th>
                    </tbody>
                </table>
            </div>


        </div>


        <div class="filter_by_time p-3 my-3">
            <h4 class="">Thời gian </h4>

            <div class="que-cate-wrapper">
                <table class="table table-hover">
                    <tbody>



                        <form action="" method="GET" id="fmSortByNewestTime">
                            <input type="text" name="action" value="question-queue" class="d-none">
                            <div class="form-check">
                                <label class="form-check-label time_filter_css">
                                    <input type="checkbox" class="form-check-input" name="txtTimeNewest" id="txtTimeNewest" value="DESC" <?php if (isset($_GET['txtTimeNewest'])) {
                                                                                                                                                echo "checked";
                                                                                                                                            } ?>>
                                    Mới nhất
                                </label>
                            </div>



                        </form>


                        <form action="" method="GET" id="fmSortByOldestTime">
                            <input type="text" name="action" value="question-queue" class="d-none">

                            <div class="form-check">
                                <label class="form-check-label time_filter_css">
                                    <input type="checkbox" class="form-check-input" name="txtTimeOldest" id="txtTimeOldest" value="ASC" <?php if (isset($_GET['txtTimeOldest'])) {
                                                                                                                                            echo "checked";
                                                                                                                                        } ?>>
                                    Cũ nhất
                                </label>
                            </div>



                        </form>



                        <script>
                            const fmSortByNewestTime = $("#fmSortByNewestTime");
                            const fmSortByOldestTime = $("#fmSortByOldestTime");
                            const txtTimeNewest = $("#txtTimeNewest");
                            const txtTimeOldest = $("#txtTimeOldest");



                            txtTimeNewest.on("change", function(e) {
                                if (this.checked) {
                                    fmSortByNewestTime.submit();
                                }
                            })
                            txtTimeOldest.on("change", function(e) {
                                if (this.checked) {
                                    fmSortByOldestTime.submit();
                                }
                            })
                        </script>


                    </tbody>
                </table>
            </div>


        </div>


        <div class="filter_by_time p-3 my-3">
            <h4 class="">Top tags</h4>


            <div class="list-tag">

                <?php
                // outstanding tags

                foreach ($data[7] as $tag) {
                    echo '<div class="tag mx-1"> <a href="/mini-q2a?action=question-queue&tag_id=' . $tag['label_id'] . '">#' . $tag['label_name'] . ' </a> </div>';
                }
                ?>


            </div>


        </div>

    </div>



</div>