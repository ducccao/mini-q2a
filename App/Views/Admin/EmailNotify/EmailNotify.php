<?php
$user_id = $_SESSION['user_id'];

use App\Models\AdminModel;

$adModel = new AdminModel();
console_log($user_id);

$user_info = $adModel->getUserInfo($user_id);


if ((int)$user_info['toggle_send_notify_status'] == 1) {
    echo '<a id="btn_turnOff" class="btn btn-danger" href="/mini-q2a/admin?action=email-notify&notify=0" >Tắt thông báo</a>';
} else {
    echo '<a id="btn_turnOn" class="btn btn-success" href="/mini-q2a/admin?action=email-notify&notify=1" >Bật thông báo</a>';
}

// echo "<script>location.href='http://localhost:8080/mini-q2a/admin?action=email-notify'</script>";


?>

<?php

if (isset($_GET['notify'])) {
    $ret = $adModel->ToggleNotify($user_id, $_GET['notify']);
    echo "<script>location.href='/mini-q2a/admin?action=email-notify';</script>";
}

console_log($user_info['toggle_send_notify_status']);


?>
    
