<style>
    .manage-sidebar {
        height: 100%;
    }
</style>

<div class="q2a-side-bar">


    <nav class="nav flex-column bg-dark manage-sidebar">
        <div class="nav-link active p-3">
            <h5> <strong>Mini-Q2A Administrator</strong></h5>
        </div>



        <a <?php if (str_contains($curr_route, "action=dashboard")) {
                echo "class='nav-link active'";
            } else {
                echo "class='nav-link '";
            }
            echo "href='$PATH_ADMIN_ROOT?action=dashboard'"; ?>>
            <i class="fas fa-cog"></i> Dasboard
        </a>
        <a <?php if (str_contains($curr_route, "action=question-category")) {
                echo "class='nav-link active'";
            } else {
                echo "class='nav-link '";
            }
            echo "href='$PATH_ADMIN_ROOT?action=question-category'" ?>>
            <i class="fas fa-cog"></i>
            Quản lý loại câu hỏi
        </a>

        <a <?php if (
                str_contains($curr_route, "action=question")
                && !str_contains($curr_route, "action=question-category")
            ) {
                echo "class='nav-link active'";
            } else {
                echo "class='nav-link '";
            }
            echo "href='$PATH_ADMIN_ROOT?action=question'" ?>>
            <i class="fas fa-cog"></i>
            Quản lý câu hỏi
        </a>


        <a <?php if (
                str_contains($curr_route, "action=answer")
                && !str_contains($curr_route, "action=question-category")
            ) {
                echo "class='nav-link active'";
            } else {
                echo "class='nav-link '";
            }
            echo "href='$PATH_ADMIN_ROOT?action=answer'" ?>>
            <i class="fas fa-cog"></i>
            Quản lý câu trả lời
        </a>


        <a <?php if (str_contains($curr_route, "action=all-question-to-add-label")) {
                echo "class='nav-link active'";
            } else {
                echo "class='nav-link '";
            }
            echo "href='$PATH_ADMIN_ROOT?action=all-question-to-add-label'" ?>>
            <i class="fas fa-cog"></i>
            Gán nhãn
        </a>



        <a <?php if (str_contains($curr_route, "action=email-notify")) {
                echo "class='nav-link active'";
            } else {
                echo "class='nav-link '";
            }
            echo "href='$PATH_ADMIN_ROOT?action=email-notify'" ?>>
            <i class="fas fa-cog"></i>
            Thông báo duyệt qua Email
        </a>


        <a <?php if (str_contains($curr_route, "action=export")) {
                echo "class='nav-link active'";
            } else {
                echo "class='nav-link '";
            }
            echo "href='$PATH_ADMIN_ROOT?action=export'" ?>>
            <i class="fas fa-cog"></i>
            Export records database
        </a>









        <a class="nav-link" <?php echo "href='$PATH_ROOT?action=home'" ?>> <i class="fas fa-cog"></i>
            Trang chủ</a>





    </nav>
</div>