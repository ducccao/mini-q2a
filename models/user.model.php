<?php

namespace models;

require_once "utils/db.util.php";

use utils\db;

class UserModel
{


    public function __constructor()
    {
    }
    public function getAllUser()
    {
        $db = new db();
        $db->connect();

        $sql = "select * from users";
        $db->load($sql);

        $users = $db->getData();

        return  $users;
    }
}
