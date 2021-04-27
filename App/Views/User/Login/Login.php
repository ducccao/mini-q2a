<?php
// Session
session_start();
?>


<!doctype html>
<html lang="en">

<head>
    <title>Mini Q2A</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="icon" href="https://avatars2.githubusercontent.com/u/1241667?s=400&v=4">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
    <style>
        :root {
            --near-white: #fdfdfddb;

            --common-bg: #212529;
            /* --common-bg: white; */

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
            width: 100vw;
        }

        .login-page-wrapper {
            background-color: var(--common-bg);
            height: 100%;
            width: 100%;
            overflow: hidden;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .fm-wrapper {
            width: 600px;
        }
    </style>

</head>

<body>

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


    <div class="login-page-wrapper">

        <div class="fm-wrapper">
            <div class="card">
                <div class="card-header">
                    <!-- Header -->
                    <h5><Strong>Đăng nhập</Strong></h5>
                </div>
                <div class="card-body">
                    <form action="/mini-q2a/App/Views/User/Login/Login.php" method="POST">

                        <div class="form-group">
                            <label for="txtUsername"> <strong>Tên tài khoản</strong> </label>
                            <input type="text" class="form-control" name="txtUsername" id="txtUsername" aria-describedby="helpId" placeholder="">
                            <!-- <small id="helpId" class="form-text text-muted">Tên tài khoản</small> -->
                        </div>
                        <div class="form-group">
                            <label for="txtUsername"><strong>Mật khẩu</strong> </label>
                            <input type="password" class="form-control" name="txtPasword" id="txtPasword" aria-describedby="helpId" placeholder="">
                            <!-- <small id="helpId" class="form-text text-muted">Tên tài khoản</small> -->
                        </div>
                        <div class="d-flex justify-content-end">
                            <button class="btn btn-dark" type="submit">Đăng nhập</button>
                            <a class="btn btn-dark ml-3" <?php echo "href='$PATH_ROOT/'"; ?>>Trang chủ </a>


                        </div>
                    </form>
                </div>
                <div class="card-footer text-muted d-flex flex-column ">
                    <!-- Footer -->

                    <p>Chưa có tài khoản ?</p>


                    <a class="btn btn-dark " <?php echo "href='$PATH_ROOT/App/Views/User/Register/Register.php'"; ?>>Tạo tài khoản </a>

                </div>
            </div>
        </div>

    </div>
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.min.js" integrity="sha384-+YQ4JLhjyBLPDQt//I+STsc9iw4uQqACwlvpslubQzn4u2UU2UFM80nGisd026JF" crossorigin="anonymous"></script>
</body>

</html>


<?php


function  console_log($output, $with_script_tags = true)
{
    $js_code = 'console.log(' . json_encode($output, JSON_HEX_TAG) .
        ');';
    if ($with_script_tags) {
        $js_code = '<script>' . $js_code . '</script>';
    }
    echo $js_code;
};






include_once "../../../../Core/Db.php";
include_once "../../../Models/UserModel.php";

use App\Models\UserModel;


$user_name = '';
$user_pass = '';


if (isset($_POST['txtUsername'])) {
    $user_name = $_POST['txtUsername'];
}
if (isset($_POST['txtPasword'])) {
    $user_pass = $_POST['txtPasword'];
}


$userModel = new UserModel();
$users = $userModel->getAllUser();

console_log($users);
foreach ($users as $us) {

    if ($us['user_name'] == $user_name && $us['user_pass'] == $user_pass) {
        echo "equal";
        $user_type = $us['user_type'];

        switch ($user_type) {
            case 'admin':
                $msg = 'hi';
                $_SESSION['user_name'] = $user_name;
                $_SESSION['user_type'] = 'admin';
                echo ("<script>location.href = '" . $PATH_ROOT . "/App/Views/Admin/AdminPage/AdminPage.php';</script>");

                break;
            case 'user':
                $_SESSION['user_name'] = $user_name;
                $_SESSION['user_type'] = 'user';

                echo "<script>location.href = '" . $PATH_ROOT . "/'</script>";


                break;


            default:
                $_SESSION['user_name'] = $user_name;
                echo "<script>location.href = '" . $PATH_ROOT . "/'</script>";


                break;
        }
    } else {
    }
}


console_log($user_name);
console_log($user_pass);





?>