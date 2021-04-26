<!-- Navigation Bar -->
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <a class="navbar-brand" <?php echo "href='$PATH_ROOT'" ?>><i class="fab fa-quora"></i> Mini-Q2A</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav w-100">



            <li <?php if ($curr_route == "") {
                    echo "class='nav-item active'";
                } else {
                    echo "class='nav-item '";
                } ?>>
                <a class="nav-link" <?php echo "href='$PATH_ROOT'" ?>> <i class="fa fa-home"></i> Trang chủ <span class="sr-only">(current)</span></a>
            </li>

            <li <?php if ($curr_route == "/question-queue") {
                    echo "class='nav-item active'";
                } else {
                    echo "class='nav-item '";
                } ?>>
                <a class="nav-link" href="<?php echo "$PATH_ROOT" ?>/question-queue"><i class="fas fa-question"></i> Danh dách câu hỏi</a>
            </li>
            <li <?php if ($curr_route == "/ranking") {
                    echo "class='nav-item active'";
                } else {
                    echo "class='nav-item '";
                } ?>>
                <a class="nav-link" <?php echo "href='$PATH_ROOT/ranking'"; ?>> <i class="far fa-chart-bar"></i> Bảng xếp hạng</a>
            </li>
            <!-- <li class="nav-item">
                    <a class="nav-link disabled" href="#" tabindex="-1" aria-disabled="true">Disabled</a>
                </li> -->

            <li <?php if ($curr_route == "/user/login") {
                    echo "class='nav-item active ml-auto'";
                } else {
                    echo "class='nav-item ml-auto'";
                } ?>>
                <a class="nav-link" <?php echo "href='./App/Views/User/Login/Login.php'"; ?>> <i class="fas fa-key"></i> Đăng nhập</a>
            </li>
            <li <?php if ($curr_route == "/user/register") {
                    echo "class='nav-item active'";
                } else {
                    echo "class='nav-item'";
                } ?>>
                <a class="nav-link" <?php echo "href='./App/Views/User/Register/Register.php'"; ?>> <i class="fas fa-registered"></i> Đăng ký</a>
            </li>
        </ul>
    </div>
</nav>