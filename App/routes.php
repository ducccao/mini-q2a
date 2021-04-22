<?php

$router->get("/", 'HomeController@index');

$router->get("/all-users", 'UserController@renderViewAllUser');
