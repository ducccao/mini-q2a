<?php

namespace App\Models;


use Db;



class UserModel
{
    public function __constructor()
    {
    }


    public function getUserIDByQueID($que_id)
    {
        $db = new Db();

        $sql = "SELECT u.user_id
        FROM `users` as u
        LEFT JOIN `questionqueue` AS q
        ON q.user_id = u.user_id
        WHERE q.que_id = '$que_id';
        ";
        $db->load($sql);
        $ret = $db->Rows();



        return $ret[0];
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
