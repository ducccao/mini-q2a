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


        <a class="nav-link" <?php echo "href='$PATH_ROOT?action=home'" ?>> <i class="fas fa-cog"></i>
            Trang chủ</a>

    </nav>
</div>