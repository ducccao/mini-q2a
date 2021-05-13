<style>
    .layout {
        min-height: 490px;
        color: black !important;
    }
</style>

<?php
$curr_user = $_SESSION['user_full_info'];
$curr_user_name = $_SESSION['user_name'];
$curr_user_email = $_SESSION['user_email'];



?>

<div class="row my-3">

    <div class="col-sm-12 col-md-4 col-lg-4  layout">
        <div class="row">
            <div class="col-lg-12 mb-3">
                <div class="card  ">
                    <img class="card-img-top" src="holder.js/100px180/" alt="">
                    <div class="card-body">
                        <h4 class="card-title">Thông tin cá nhân </h4>

                        <p class="card-text"><strong>Username</strong> : <?php echo $curr_user_name; ?> </p>
                        <p class="card-text"><strong>Email</strong> : <?php echo $curr_user_email; ?> </p>
                    </div>
                </div>

            </div>
            <div class="col-lg-12">
                <div class="card ">
                    <img class="card-img-top" src="holder.js/100px180/" alt="">
                    <div class="card-body">
                        <h4 class="card-title">Cập nhật mật khẩu</h4>
                        <form action="" method="POST">
                            <input class="d-none" type="text" name="action" value="edit-profile">
                            <input required class="w-100 my-3 form-control" type="password" name="txtPassword">
                            <button class="btn btn-primary w-100" type="submit">Đổi mật khẩu</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

    </div>
    <div class="col-sm-12 col-md-8 col-lg-8 ">
        <div class="card layout p-3">

            <h4 class="card-title"> Cập nhật thông tin cá nhân </h4>



            <form action="" method="GET">
                <input class="d-none" type="text" name="action" value="edit-profile">
                <div class="form-group">
                    <label for="txtUsername">Username</label>
                    <input required type="text" name="txtUsername" id="txtUsername" class="form-control" placeholder="" aria-describedby="helpId">
                    <small id="helpId" class="text-muted">Username</small>
                </div>

                <div class="form-group">
                    <label for="txtMaile">Email</label>
                    <input type="email" name="txtMaile" id="txtMaile" class="form-control" placeholder="" aria-describedby="helpId">
                    <small id="helpId" class="text-muted">Maile</small>
                </div>
                <button class="btn btn-primary">Cập nhật</button>
            </form>

        </div>
    </div>


</div>


<?php

use App\Models\UserModel;

$userModel = new UserModel();

if (isset($_POST['txtPassword'])) {
    $new_pass = $_POST['txtPassword'];
    $user_id = $curr_user['user_id'];

    $ret = $userModel->changePassword($user_id, $new_pass);

    if ($ret == true) {
        echo "<script>
        Swal.fire({
            icon: 'success',
            title: 'Đổi mật khẩu thành công!',
            showConfirmButton: false,
            timer: 2700
          });
        </script>";
    } else {
        echo "<script>
        Swal.fire({
            icon: 'error',
            title: 'Đổi mật khẩu thất bại!',
            showConfirmButton: false,
            timer: 2700
          });
        </script>";
    }
}


if (isset($_GET['txtUsername'])) {
    $new_name = $_GET['txtUsername'];
    $user_id = $curr_user['user_id'];
    $ret = $userModel->changeName($user_id, $new_name);

    $_SESSION['user_name'] = $new_name;

    if ($ret == true) {
        echo "<script>
        Swal.fire({
            icon: 'success',
            title: 'Cập nhật thành công!',
            showConfirmButton: false,
            timer: 2700
          });
        </script>";


        echo '<script>
        setTimeout(() => {
            location.href = "/mini-q2a?action=edit-profile"
        }, 1500);
    </script>';
    } else {
        echo "<script>
        Swal.fire({
            icon: 'error',
            title: 'Cập nhật thất bại!',
            showConfirmButton: false,
            timer: 2700
          });
        </script>";
    }
}


if (isset($_GET['txtMaile'])) {
    $new_mail = $_GET['txtMaile'];
    $user_id = $curr_user['user_id'];
    $ret = $userModel->changeEmail($user_id, $new_mail);

    $_SESSION['user_email'] = $new_mail;

    if ($ret == true) {
        echo "<script>
        Swal.fire({
            icon: 'success',
            title: 'Cập nhật thành công!',
            showConfirmButton: false,
            timer: 2700
          });
        </script>";

        echo '<script>
        setTimeout(() => {
            location.href = "/mini-q2a?action=edit-profile"
        }, 1500);
    </script>';
    } else {
        echo "<script>
        Swal.fire({
            icon: 'error',
            title: 'Cập nhật thất bại!',
            showConfirmButton: false,
            timer: 2700
          });
        </script>";
    }
}

?>