<!-- PATH ROOT -->

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


$PATH_ROOT = "/mini-q2a";
global $PATH_ROOT;

$uri = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http")
    . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";

$url_len = strlen($uri);

console_log($uri);

$curr_url = '';
if (isset($_SERVER['REDIRECT_URL'])) {
    $curr_url = $_SERVER['REDIRECT_URL'];
}
$curr_route = substr($curr_url, strlen($PATH_ROOT), 100);
$curr_route = trim($curr_route);
echo ("admin current route is " . $curr_route);

?>


<?php


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
    <link rel="icon" href="https://avatars2.githubusercontent.com/u/1241667?s=400&v=4">

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

        /* .q2a-content-nav {} */

        .gr-logout:hover {
            color: black;
        }
    </style>


</head>

<body>


    <!-- Require DB ROOT-->

    <?php

    require_once "./Core/Db.php";

    ?>


    <div class="q2a-wrapper">

        <!-- side bar -->
        <?php

        include_once "./App/Views/Admin/partials/Sidebar.php";
        ?>
        <div class="q2a-content">
            <!-- nav bar -->
            <?php
            include_once "./App/Views/Admin/partials/Navbar.php";

            ?>
            <div class="q2a-content-content">
                <?php


                // Định nghĩa hằng Path của file index.php
                define('PATH_ROOT', __DIR__);

                // Autoload class trong PHP
                spl_autoload_register(function (string $class_name) {
                    include_once PATH_ROOT . '/' . $class_name . '.php';
                });
                console_log($_REQUEST);

                // Load Router
                include_once "./App/AdminRouter.php";


                if (isset($_SERVER['REQUEST_URI'])) {
                    $adRouting = $_SERVER['REQUEST_URI'];
                    console_log($adRouting);
                    switch ($adRouting) {
                        case $PATH_ROOT . '/admin/question-cate':
                            echo "q cate";
                            break;

                        default:
                            # code...
                            break;
                    }
                }

                console_log($_SERVER);

                $curr_routee = $_SERVER['REQUEST_URI'];




                ?>



            </div>


        </div>
    </div>






    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.min.js"></script>
</body>

</html>