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
        background-color: var(--layout-bg-1);
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
        border: 1px solid #000;
    }

    .question-queue-card {
        min-height: 50px;
        width: 100%;
        background-color: var(--near-white);
        border: 1px solid #000;
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


    .que-cate-wrapper {}

    .qq-top-left {}

    .qq-title {
        font-size: 26px;
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

        background-color: lightblue;
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
</style>





<div class="question-queue-card p-3">
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

</div>