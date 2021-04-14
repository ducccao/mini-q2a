
<?php

require_once "models/user.model.php";

use models\UserModel;





$router->get("/", function () {
    echo "<h1>Home Get /</h1>";

    $obj1 = (object)[
        'name' => 'duc',
        'age' => 3
    ];

    $obj2 = (object)[
        'name' => 'duccao',
        'age' => 4
    ];

    $arr_objs = [$obj1, $obj2];


    print_r(array_map(function ($e) {
        return "<h1>
        <div> $e->name </div>
        <div> $e->age </div>
        </h1>";
    }, $arr_objs));
});


$router->get("/home", function () {
    echo "<h1>Home Get /</h1>";
});



$router->get("/api/users", function () {
    $userModel = new UserModel();
    $users = $userModel->getAllUser();





    console_log($users);
});
