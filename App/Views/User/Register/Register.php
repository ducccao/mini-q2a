<!doctype html>
<html lang="en">

<head>
    <title>Mini Q2A</title>

    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="icon" href="https://avatars2.githubusercontent.com/u/1241667?s=400&v=4">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css">
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
                <div class="card-header ">
                    <!-- Header -->
                    <h5><Strong>Đăng ký</Strong></h5>

                </div>
                <div class="card-body">
                    <form id="fmRegister" method="POST">

                        <div class="form-group">
                            <label for="txtMaile"> <strong>Email</strong> </label>
                            <input type="email" class="form-control" name="txtMaile" id="txtMaile" aria-describedby="txtMaile" placeholder="">
                            <small id="smEmail" class="form-text  text-danger d-none">Email đã tồn tại</small>
                        </div>

                        <div class="form-group">
                            <label for="txtUsername"> <strong>Tên tài khoản</strong> </label>
                            <input type="text" class="form-control" name="txtUsername" id="txtUsername" aria-describedby="helpId" placeholder="">
                            <small id="smUsername" class="form-text  text-danger d-none">Tên tài khoản đã tồn tại</small>

                        </div>
                        <div class="form-group">
                            <label for="txtUsername"><strong>Mật khẩu</strong> </label>
                            <input type="password" class="form-control" name="txtPasword" id="txtPasword" aria-describedby="helpId" placeholder="">
                            <!-- <small id="helpId" class="form-text text-muted">Tên tài khoản</small> -->
                        </div>
                        <div class="d-flex justify-content-end">
                            <button class="btn btn-dark" type="submit">Đăng ký</button>
                            <a class="btn btn-dark ml-3" <?php echo "href='$PATH_ROOT?action=home'"; ?>>Trang chủ </a>

                        </div>
                    </form>
                </div>
                <div class="card-footer text-muted d-flex flex-column justify-content-center ">
                    <p>Đã có tài khoản ?</p>
                    <a class="btn btn-dark " <?php echo "href='$PATH_ROOT?action=user-login'"; ?>>Đăng nhập </a>
                    <small id="smErrorMess" class="form-text  text-danger d-none ">Thông tin không được trống</small>

                    <!-- Footer -->
                </div>
            </div>
        </div>

    </div>




    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script> -->
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.min.js"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@10"></script>


    <script>
        function register() {
            fmRegister = $("#fmRegister");
            email = $("#txtMaile");
            user_name = $("#txtMaile");
            user_pass = $("#txtPasword");

            data = {
                email: email.val(),
                user_name: user_name.val(),
                user_pass: user_pass.val()
            }

            fmRegister.on("submit", function(e) {


                $.ajax({
                    type: "POST",
                    url: "/?action=user-register",
                    data: data,
                    success: ret => {
                        console.log(ret);
                    },
                    error: er => {
                        console.log(er);

                    }


                })
            })
        }
        register();
    </script>
</body>

</html>


<?php







use App\Models\UserModel;




// handle Login

$user_email = '';
$user_name = '';
$user_pass = '';
$error_flag = false;

if (isset($_POST['txtMaile'])) {
    $user_email = $_POST['txtMaile'];
}

if (isset($_POST['txtUsername'])) {
    $user_name = $_POST['txtUsername'];
}
if (isset($_POST['txtPasword'])) {
    $user_pass = $_POST['txtPasword'];
}



$userModel = new UserModel();
$users = $userModel->getAllUser();
$users_len = count($users);


if ($user_email != '' && $user_pass != '' && $user_name !== '') {
    console_log($users);
    foreach ($users as $us) {
        if ($us['email'] == $user_email) {
            echo "<script>
            Swal.fire({
                icon: 'error',
                title: 'Email đã được sử dụng!',
                showConfirmButton: false,
                timer: 1500
              });
            </script>";
            $error_flag = true;
        }
        if ($us['user_name'] == $user_name) {
            echo "<script>
            Swal.fire({
                icon: 'error',
                title: 'Tên tài khoản đã được sử dụng!',
                showConfirmButton: false,
                timer: 1500
              });
            </script>";
            $error_flag = true;
        }
    }

    if ($error_flag == false) {
        $user_id =  'user_' . (string) ($users_len + 1);
        $user_type = 'user';
        $user_rank = (int)$userModel->getRankUserForRegister()['user_rank'] + 1;
        $toggle_send_notify_status = true;


        $ret = $userModel->add(
            $user_id,
            $user_email,
            $user_name,
            $user_pass,
            $user_type,
            $user_rank,
            $toggle_send_notify_status
        );

        if ($ret == true) {
            echo "<script>
            Swal.fire({
                icon: 'success',
                title: 'Đăng ký thành công!',
                showConfirmButton: false,
                timer: 1500
              });
            </script>";
        } else {
            echo "<script>
            Swal.fire({
                icon: 'error',
                title: 'Đã có lỗi gì đó!',
                showConfirmButton: false,
                timer: 1500
              });
            </script>";
        }
    }
}






?>