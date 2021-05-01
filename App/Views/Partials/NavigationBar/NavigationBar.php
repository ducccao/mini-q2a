<?php
session_start();
$curr_user = '';
$isExistsUser = false;


if (isset($_SESSION['user_name'])) {
    $curr_user = $_SESSION['user_name'];
    $user_type = $_SESSION['user_type'];
    $isExistsUser = true;

    $curr_user_id = $_SESSION['user_id'];
    $curr_user_full_info = $_SESSION['user_full_info'];
}
// echo  $curr_user . ' is loged-in in system';
console_log($curr_user . ' is loged-in in system');




$curr_route = '';

if (isset($_SERVER['REQUEST_URI'])) {
    $curr_route = $_SERVER['REQUEST_URI'];
}

console_log($curr_route);



?>




<!-- Navigation Bar -->
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <a class="navbar-brand" <?php echo "href='$PATH_ROOT?action=home'" ?>><i class="fab fa-quora"></i> Mini-Q2A</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav w-100">

            <li <?php if (str_contains($curr_route, "action=home")) {
                    echo "class='nav-item active'";
                } else {
                    echo "class='nav-item '";
                } ?>>
                <a class="nav-link" <?php echo "href='$PATH_ROOT?action=home'" ?>> <i class="fa fa-home"></i> Trang chủ <span class="sr-only">(current)</span></a>
            </li>

            <li <?php if (str_contains($curr_route, "action=question-queue") && !str_contains($curr_route, "action=question-queue-detail")) {
                    echo "class='nav-item active'";
                } else {
                    echo "class='nav-item '";
                } ?>>
                <a class="nav-link" href="<?php echo "$PATH_ROOT" ?>?action=question-queue"><i class="fas fa-question"></i> Danh dách câu hỏi</a>
            </li>
            <li <?php if (str_contains($curr_route, "action=ranking")) {
                    echo "class='nav-item active'";
                } else {
                    echo "class='nav-item '";
                } ?>>
                <a class="nav-link" <?php echo "href='$PATH_ROOT?action=ranking'"; ?>> <i class="far fa-chart-bar"></i> Bảng xếp hạng</a>
            </li>
            <!-- <li class="nav-item">
                    <a class="nav-link disabled" href="#" tabindex="-1" aria-disabled="true">Disabled</a>
                </li> -->

            <?php
            // if not exists user
            if ($isExistsUser == false) {
                echo '<li';
                if ($curr_route == "/user/login") {
                    echo " class='nav-item active ml-auto'";
                } else {
                    echo " class='nav-item ml-auto'";
                }
                echo  '>';
                echo "
    <a class='nav-link'   href='$PATH_ROOT?action=user-login'; > <i class='fas fa-key'></i> Đăng nhập</a>";
                echo "</li>";


                echo "<li";
                if ($curr_route == "/user/register") {
                    echo " class='nav-item active'";
                } else {
                    echo " class='nav-item'";
                }
                echo ">";

                echo "
    <a class='nav-link'  href='$PATH_ROOT?action=user-register';> <i class='fas fa-registered'></i> Đăng ký</a>          
                ";
            } else {
                // if exists user



                if ($user_type == 'admin') {
                    echo "<li class ='nav-item '>";
                    echo "<a class='nav-link' href='/admin?action=dashboard'><i class='fas fa-cog mr-1'></i>Trang quản lý</a>";
                    echo "</li>";
                }



                echo '<li';
                if ($curr_route == "/user/profile") {
                    echo " class='nav-item active ml-auto'";
                } else {
                    echo " class='nav-item ml-auto'";
                }
                echo  '>';
                echo "
    <a class='nav-link'   href='$PATH_ROOT/App/Views/User/Profile/Profile.php'; > <i class='fas fa-info-circle mr-1'></i>Hi $curr_user ! </a>";
                echo "</li>";



                echo '<li';


                if (str_contains($curr_route, "upload")) {
                    echo " class='nav-item active '";
                } else {
                    echo " class='nav-item '";
                }
                echo  '>';
                echo "
    <a class='nav-link'   href='$PATH_ROOT?action=user-upload-question'; > <i class='fas fa-arrow-circle-up'></i> Đăng câu hỏi  </a>";
                echo "</li>";



                echo "<li";
                if ($curr_route == "/user/logout") {
                    echo " class='nav-item active'";
                } else {
                    echo " class='nav-item'";
                }
                echo ">";

                echo "
    <a id='btnLogout'  class='nav-link'href='$PATH_ROOT?action=home&isDestroy=1'  ;><i class='fas fa-sign-out-alt'></i> Đăng xuất</a>          
         ";
            }

            ?>




        </ul>
    </div>
</nav>

<!-- ------------- -->
<!-- Logout handle -->
<!-- ------------- -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>


<script>
    function logout() {
        const btnLogout = $("#btnLogout");

        btnLogout.on("click", function(e) {
            fmLogout.submit();

        })


    }
    logout();
</script>


<?php

if (isset($_GET['isDestroy'])) {
    $isDestroy = (int) $_GET['isDestroy'];

    if ($isDestroy == 1) {
        session_destroy();
        echo "<script>location.href='$PATH_ROOT?action=home'</script>";
    }
}


?>