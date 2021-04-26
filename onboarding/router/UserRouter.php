
<?php

use App\Controllers\UserController;

$userRouter = new Core\Route;

$userRouter->get("/user/login", function () {
    echo "user login";
});

$request_url = !empty($_GET['url']) ? '/' . $_GET['url'] : '/';

// Lấy phương thức hiện tại của url đang được gọi. (GET | POST). Mặc định là GET.
$method_url = !empty($_SERVER['REQUEST_METHOD']) ? $_SERVER['REQUEST_METHOD'] : 'GET';


$userRouter->map($request_url, $method_url);


?>