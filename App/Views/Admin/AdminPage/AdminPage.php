<!-- PATH ROOT -->

<?php
$PATH_ROOT = "/mini-q2a";
global $PATH_ROOT;

$uri = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http")
    . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";

$url_len = strlen($uri);

$curr_url = '';
if (isset($_SERVER['REDIRECT_URL'])) {
    $curr_url = $_SERVER['REDIRECT_URL'];
}
$curr_route = substr($curr_url, strlen($PATH_ROOT), 100);
$curr_route = trim($curr_route);
console_log($curr_route);

?>

<?php
function  console_log($output, $with_script_tags = true)
{
    $js_code = 'console.log(' . json_encode($output, JSON_HEX_TAG) .
        ');';
    if ($with_script_tags) {
        $js_code = '<script>' . $js_code . '</script>';
    }
    echo $js_code;
}


session_start();
$curr_user = '';
$isExistsUser = false;


if (isset($_SESSION['user_name'])) {
    $curr_user = $_SESSION['user_name'];
    $curr_user_type = $_SESSION['user_type'];

    $isExistsUser = true;
    if (isset($_SESSION['user_type'])) {
        if ($_SESSION['user_type'] != 'admin') {
            echo ("<script>location.href = '" . $PATH_ROOT . "';</script>");
        }
    }
} else {
    echo ("<script>location.href = '" . $PATH_ROOT . "';</script>");
}
console_log($curr_user . ' is loged-in in system');
console_log('User type is: ' . $curr_user_type);








?>






<html lang="en">

<head>

    <!-- Required meta tags -->

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css">

    <!-- font famlily -->
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Poppins&display=swap" rel="stylesheet">

    <!-- Fontawessome  -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />
    <title>Admin</title>


    <style>
        :root {
            --near-white: #fdfdfddb;
            --common-bg: #cbd9dd;
            --layout-bg-1: lightblue;
            --layout-bg-2: lightcoral;
            --layout-bg-3: lightgreen;
            --border-radius: 5px;

            /* --layout-bg-1: transparent;
            --layout-bg-2: transparent;
            --layout-bg-3: transparent; */

        }

        * {
            /* font-family: 'Poppins', sans-serif; */
            /* font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; */
            font-family: Tahoma, Geneva, Verdana, sans-serif
        }

        body {
            height: 100vh;
            width: 100%;

        }

        .q2a-wrapper {
            height: 100%;
            width: 100%;
            display: flex;

        }

        .q2a-side-bar {
            height: 100%;
            width: 20%;
        }

        .q2a-content {
            min-height: 300px;
            width: 80%;
        }

        a {
            color: #6c757d;
        }

        .active {
            color: var(--near-white);

        }

        a:hover {
            color: var(--near-white);

        }

        .q2a-content-nav {}

        .gr-logout:hover {
            color: black;
        }
    </style>


</head>

<body>

    <div class="q2a-wrapper">
        <div class="q2a-side-bar">


            <nav class="nav flex-column bg-dark h-100">
                <div class="nav-link active p-3">
                    <h5> <strong>Mini-Q2A Administrator</strong></h5>
                </div>
                <a class="nav-link active" aria-current="page" href="#">Active</a>
                <a class="nav-link" href="#">Link</a>
                <a class="nav-link" href="#">Link</a>
                <a class="nav-link disabled" href="#" tabindex="-1" aria-disabled="true">Disabled</a>
            </nav>
        </div>
        <div class="q2a-content">
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
            <div class="q2a-content-content">
                content
            </div>


        </div>
    </div>






    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.min.js"></script>
</body>

</html>