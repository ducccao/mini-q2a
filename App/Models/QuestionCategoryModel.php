<?php

namespace App\Models;

use Db;

class QuestionCategoryModel
{
    function __construct()
    {
    }

    public function all()
    {
        $db = new Db();

        $sql = "SELECT*
        FROM `questioncategories`;
        ";

        $db->load($sql);
        $data = $db->Rows();
        return $data;
    }

    public function add($que_cate_id, $que_cate_name)
    {
        $db = new Db();

        $sql = "INSERT INTO `questioncategories` (que_cate_id,que_cate_name)
        VALUES ('$que_cate_id','$que_cate_name');
        ";

        $ret = $db->patchDb($sql);

        return $ret;
    }

    public function del($que_cate_id)
    {
        $db = new Db();

        $sql = "DELETE 
        FROM `questioncategories` AS q
        WHERE q.que_cate_id='$que_cate_id';";

        $ret = $db->patchDb($sql);

        return $ret;
    }
    public function edit($que_cate_id, $new_name)
    {
        $db = new Db();

        $sql = "UPDATE `questioncategories` AS qcat
        SET qcat.que_cate_name = '$new_name'
        WHERE qcat.que_cate_id = '$que_cate_id';
        ";


        $ret = $db->patchDb($sql);
        console_log("edit ret: ");
        console_log($ret);

        return $ret;
    }
    public function GetAllQuestionCategoriesWithCountQQ()
    {
        $db = new Db();

        $sql = "SELECT questioncategories.que_cate_id, 
        questioncategories.que_cate_name, COUNT(*) AS amount
        FROM `questioncategories`
        LEFT JOIN `questionqueue`
        ON questioncategories.que_cate_id =  questionqueue.que_cate_id
        WHERE questionqueue.is_accepted = true
        GROUP BY questioncategories.que_cate_name
        ORDER BY questioncategories.que_cate_name;
        ";

        $db->load($sql);
        $data = $db->Rows();

        return $data;
    }
}
