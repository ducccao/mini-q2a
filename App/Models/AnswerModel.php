<?php

namespace App\Models;

use Db;

class AnswerModel
{

    public function all()
    {
        $db = new Db();

        $sql = "SELECT *
        FROM `answers`;
       ";

        $db->load($sql);
        $ret = $db->Rows();

        return $ret;
    }

    public function detail($ans_id)
    {
    }


    public function del()
    {
    }

    public function getAnsByQueID($que_id)
    {
        $db = new Db();

        $sql = "SELECT a.ans_id, a.que_id, a.ans_content, a.ans_source_url, a.ans_images,
        a.createdAt, a.user_id, u.user_name, a.is_accepted
       FROM `answers` AS a
       INNER JOIN `users` AS u
       ON u.user_id = a.user_id
       WHERE a.que_id = '$que_id'
       AND a.is_accepted = TRUE;
       ";

        $db->load($sql);
        $ret = $db->Rows();

        return $ret;
    }

    public function __construct()
    {
    }
}
