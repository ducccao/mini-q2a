<div class="q2a-content-nav">
    <ul class="nav justify-content-end bg-light p-3">

        <?php
        // if not exists user
        if ($isExistsUser == false) {
            echo '<li';
            if ($curr_route == "$PATH_ROOT/user/login") {
                echo " class='nav-item active ml-auto'";
            } else {
                echo " class='nav-item ml-auto'";
            }
            echo  '>';
            echo "
    <a class='nav-link'   href='$PATH_ROOT/App/Views/User/Login/Login.php'; > <i class='fas fa-key'></i> Đăng nhập</a>";
            echo "</li>";


            echo "<li";
            if ($curr_route == "$PATH_ROOT/user/register") {
                echo " class='nav-item active'";
            } else {
                echo " class='nav-item'";
            }
            echo ">";

            echo "
    <a class='nav-link'  href='$PATH_ROOT/App/Views/User/Register/Register.php';> <i class='fas fa-registered'></i> Đăng ký</a>          
                ";
        } else {
            // if exists user

            echo '<li';
            if ($curr_route == "$PATH_ROOT/user/profile") {
                echo " class='nav-item active ml-auto'";
            } else {
                echo " class='nav-item ml-auto'";
            }
            echo  '>';
            echo "
    <a class='nav-link gr-logout'   href='$PATH_ROOT/App/Views/User/Profile/Profile.php'; > <i class='fas fa-info-circle mr-1'></i>$curr_user  </a>";
            echo "</li>";


            echo "<li";
            if ($curr_route == "$PATH_ROOT/user/logout") {
                echo " class='nav-item active'";
            } else {
                echo " class='nav-item'";
            }
            echo ">";

            echo "
    <a id='btnLogout'  class='nav-link gr-logout'href='$PATH_ROOT?isDestroy=1'  ;><i class='fas fa-sign-out-alt'></i> Đăng xuất</a>          
         ";
        }

        ?>
    </ul>

</div>