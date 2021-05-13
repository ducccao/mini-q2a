<?php

namespace App\Models;

use Db;

class QuestionLabelModel
{
    public function __construct()
    {
    }

    public function all()
    {
        $db = new Db();

        $sql = "SELECT * 
        FROM `quetionqueue_labels`;";

        $db->load($sql);
        $ret = $db->Rows();
        return $ret;
    }

    public function detail($que_id)
    {
        $db = new Db();

        $sql = "SELECT * 
        FROM `quetionqueue_labels` AS q
        WHERE q.que_id = '$que_id';";

        $db->load($sql);
        $ret = $db->Rows();
        return $ret;
    }

    public function findArrayLabelOfQuestion($que_id)
    {

        $db = new Db();

        $sql = "SELECT  ql.que_id,  ql.label_id, l.label_name
        FROM `quetionqueue_labels` AS ql
        INNER JOIN `labels` AS l
        ON ql.label_id = l.label_id
        WHERE ql.que_id= '$que_id';
        ";

        $db->load($sql);
        $ret = $db->Rows();
        return $ret;
    }

    public function add($que_id, $label_id)
    {

        $db = new Db();

        $sql = "INSERT INTO `quetionqueue_labels`(que_id, label_id)
        VALUES ('$que_id','$label_id');
         ";

        $ret = $db->patchDb($sql);
        return $ret;
    }
}
