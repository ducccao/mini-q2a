<?php



# Route Home
$router->get("/", 'HomeController@index');


# Route User
$router->get("/all-users", 'UserController@renderViewAllUser');



# Route Admin
$router->get("/admin", 'AdminController@index');
$router->get("/admin/post-control", 'AdminController@GetPostControlPage');
