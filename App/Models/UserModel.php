<?php

namespace App\Models;


use Db;



class UserModel
{
    public function __constructor()
    {
    }
    public function getAllUser()
    {


        $db = new Db();
        $sql = 'SELECT * FROM `users`';
        $db->load($sql);
        $users = $db->Rows();
        return $users;
    }
    public function getRankUserForRegister()
    {
        $db = new Db();
        $sql = 'SELECT COUNT(*) AS user_rank FROM `users`; ';
        $db->load($sql);
        $data = $db->Rows();
        return $data[0];
    }

    public function add(
        $user_id,
        $email,
        $user_name,
        $user_pass,
        $user_type,
        $user_rank,
        $toggle_send_notify_status
    ) {
        $db = new Db();
        $sql = "INSERT INTO `users`(user_id,email,user_name,user_pass,user_type,user_rank,toggle_send_notify_status) 
        VALUES ('$user_id','$email','$user_name','$user_pass','$user_type','$user_rank',$toggle_send_notify_status);";

        $ret = $db->patchDb($sql);

        return $ret;
    }
}
