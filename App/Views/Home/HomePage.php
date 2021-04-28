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
        height: 300px;
        background-color: var(--layout-bg-2);
    }

    .question-queue {
        width: 100%;
        min-height: 80px;
        background-color: lightblue;
        border: 1px solid black;

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
        background-color: #8fa1b4;
        color: var(--near-white);
        border-radius: var(--border-radius);

    }

    a:hover {
        color: var(--near-white);
        text-decoration: none;
    }

    .que_cate_name {
        color: var(--near-white);

    }

    h1,
    h2,
    h3,
    h4,
    h5,
    h6 {
        font-weight: bold;
    }
</style>




<div class="home-content p-3 my-3">
    <div class="home-list-question-left w-100 ">

        <div class="question-newest">
            <h3 class="">Các câu hỏi nổi bật</h3>
        </div>



        <!-- Card  Question Queue -->
        <!-- <div class="question-queue-card p-3">
            <div class="qq-top-info">
                <div class="qq-top-left">

                    <div class="qq-title">
                        title
                    </div>
                    <div class="qq-username">
                        <p>username</p>
                    </div>
                </div>

                <div class="qq-top-right">
                    <div>Created at

                    </div>

                </div>

            </div>
            <div class="qq-bot-info">

                <div class="qq-bot-left">

                    <div class="like-wrapper">
                        <span class="badge ">5</span>

                        <i class="far fa-thumbs-up like"></i>

                    </div>
                </div>
                <div class="qq-bot-right">
                    <div class="list-tag">

                        <div class="tag mx-1">
                            <a href="">#tagname</a>

                        </div>


                    </div>

                </div>

            </div>

        </div> -->


        <?php




        foreach ($this->data[0]  as $qq) {


            echo '
            
            <div class="question-queue-card p-3 my-3">
            <div class="qq-top-info">
                <div class="qq-top-left">

                    <div class="qq-title">
                      ' .   $qq["que_title"] . '
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
                        ' .   $qq["like_count"] . '
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
                    echo "       <div class='tag mx-1'>    <a href=''>";
                    echo  "#" . $tag['label_name'];
                    echo '    </a>      </div>';
                }
            }


            echo   '

    </div>

</div>

</div>

</div>';


            // echo  "<div class= 'question-queue my-2'>";
            // echo "<div>" . $qq["que_id"] . "</div>";
            // echo "<div>" . $qq["que_content"] . "</div>";

            // echo "<div>" . $qq["que_title"] . "</div>";
            // echo "<div>" . $qq["createdAt"] . "</div>";
            // echo "<div>" . $qq["user_id"] . "</div>";
            // echo "<div>" . $qq["que_cate_id"] . "</div>";
            // echo  "     </div>";
        }
        ?>




    </div>
    <!-- <div class="home-list-filter-right w-25 p-3 ml-3">
        <h4 class="">Chủ đề</h4>

        <div class="que-cate-wrapper">
            <table class="table table-hover">
                <tbody>


                    <?php

                    foreach ($data[1] as $questionCategories) {
                        echo "<tr class='question-category'>";
                        echo '<th scope="row" class ="que-cate-content"> ';
                        echo "<div> <a href='#' class='que_cate_name' >" . $questionCategories["que_cate_name"] . "</a> </div> ";

                        echo "<div class='badge badge-light p-2'>" . $questionCategories["amount"] . " </div>";
                        echo "   </th>";


                        echo "</tr>";
                    }
                    ?>
                    <th>


                    </th>
                </tbody>
            </table>
        </div>
    </div> -->
</div>