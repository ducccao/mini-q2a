<?php

namespace App\Models;

use Db;

class AdminModel
{
    public function __construct()
    {
    }
    public function QuestionDetailByQueID($que_id)
    {
        $db = new Db();

        $sql = "SELECT q.que_id, q.que_content, q.que_title, q.createdAt, u.user_id,
        u.user_name, qCate.que_cate_id, qCate.que_cate_name
        FROM `questionqueue` AS q
        INNER JOIN `users` AS u
        ON q.user_id = u.user_id
        INNER JOIN  `questioncategories` as qCate
        ON qCate.que_cate_id = q.que_cate_id
        AND q.que_id = '$que_id';";
        $db->load($sql);
        $ret = $db->Rows();
        return $ret[0];
    }

    public function AcceptQuestionHandle($que_id, $status_accepted)
    {
        $db = new Db();

        $sql = "UPDATE `questionqueue` AS q
        SET q.is_accepted = $status_accepted
        WHERE que_id = '$que_id';
        ";


        $ret = $db->patchDb($sql);

        return $ret;
    }
}
