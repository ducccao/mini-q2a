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
            min-height: 100vh;
            width: 100vw;
        }

        .login-page-wrapper {
            background-color: var(--common-bg);
            min-height: 100vh;

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
    $PATH_ROOT = $GLOBALS['PATH_ROOT'];
    $PATH_ADMIN_ROOT = $GLOBALS['PATH_ADMIN_ROOT'];


    ?>


    <div class="login-page-wrapper">

        <div class="fm-wrapper">
            <div class="card">
                <div class="card-header">
                    <!-- Header -->
                    <h5><Strong>Đăng nhập</Strong></h5>
                </div>
                <div class="card-body">
                    <form action="?action=user-login" method="POST">

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
                            <a class="btn btn-dark ml-3" <?php echo "href='$PATH_ROOT?action=home'"; ?>>Trang chủ </a>


                        </div>
                    </form>
                </div>
                <div class="card-footer text-muted d-flex flex-column ">
                    <!-- Footer -->

                    <p>Chưa có tài khoản ?</p>


                    <a class="btn btn-dark " <?php echo "href='$PATH_ROOT?action=user-register'"; ?>>Tạo tài khoản </a>

                </div>
            </div>
        </div>

    </div>
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.min.js" integrity="sha384-+YQ4JLhjyBLPDQt//I+STsc9iw4uQqACwlvpslubQzn4u2UU2UFM80nGisd026JF" crossorigin="anonymous"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@10"></script>

</body>

</html>


<?php








use App\Models\UserModel;


$user_name = '';
$user_pass = '';
$error_flag = true;

if (isset($_POST['txtUsername'])) {
    $user_name = $_POST['txtUsername'];
}
if (isset($_POST['txtPasword'])) {
    $user_pass = $_POST['txtPasword'];
}


$userModel = new UserModel();
$users = $userModel->getAllUser();

//console_log($users);
foreach ($users as $us) {

    if ($us['user_name'] == $user_name && $us['user_pass'] == $user_pass) {

        $user_type = $us['user_type'];
        $error_flag = false;

        switch ($user_type) {
            case 'admin':
                $msg = 'hi';


                $_SESSION['user_name'] = $user_name;
                $_SESSION['user_type'] = 'admin';
                $_SESSION['user_id'] = $us['user_id'];
                $_SESSION['user_email'] = $us['email'];
                $_SESSION['user_full_info'] = $us;


                // echo ("<script>location.href = '" . $PATH_ROOT . "/App/Views/Admin/AdminPage/AdminPage.php';</script>");

                echo ("<script>location.href = '" . $PATH_ADMIN_ROOT . "?action=dashboard';</script>");

                break;
            case 'user':
                $_SESSION['user_name'] = $user_name;
                $_SESSION['user_type'] = 'user';
                $_SESSION['user_id'] = $us['user_id'];
                $_SESSION['user_email'] = $us['email'];

                $_SESSION['user_full_info'] = $us;


                echo "<script>location.href = '" . $PATH_ROOT . "?action=home'</script>";


                break;


            default:
                $_SESSION['user_name'] = $user_name;
                $_SESSION['user_type'] = 'user';
                $_SESSION['user_id'] = $us['user_id'];
                $_SESSION['user_email'] = $us['email'];

                $_SESSION['user_full_info'] = $us;

                echo "<script>location.href = '" . $PATH_ROOT . "/'</script>";



                break;
        }
    } else {
    }
}


if (isset($_POST['txtUsername'])) {
    if (isset($_POST['txtPasword'])) {
        if ($error_flag == true) {
            echo "<script>
            Swal.fire({
                icon: 'error',
                title: 'Sai tên tài khoản hoặc mật khẩu!',
                showConfirmButton: false,
                timer: 2700
              });
            </script>";
        }
    }
}







?>