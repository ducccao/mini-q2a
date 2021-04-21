<?php
include "utils/Db.php";


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
}
