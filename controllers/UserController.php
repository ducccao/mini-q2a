<?php


class UserController
{


    function __constructor()
    {
    }

    public function renderViewAllUser()
    {
        $userModel = new UserModel();

        $users = $userModel->getAllUser();

        console_log($users);
        echo $users['email'];
    }
}
