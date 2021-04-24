<style>
    :root {
        --common-bg: #cbd9dd;
    }

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
        background-color: red;
    }

    .home-list-filter-right {
        height: 300px;
        background-color: blue;
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
</style>




<div class="home-content p-3 my-3">
    <div class="home-list-question-left w-75 ">


        <?php
        foreach ($this->data  as $qq) {
            console_log($qq);

            echo  "<div class= 'question-queue my-2'>";
            echo "<div>" . $qq["que_id"] . "</div>";
            echo "<div>" . $qq["que_content"] . "</div>";

            echo "<div>" . $qq["que_title"] . "</div>";
            echo "<div>" . $qq["createdAt"] . "</div>";
            echo "<div>" . $qq["user_id"] . "</div>";
            echo "<div>" . $qq["que_cate_id"] . "</div>";
            echo  "     </div>";
        }
        ?>




    </div>
    <div class="home-list-filter-right w-25 p-3">

    </div>
</div>