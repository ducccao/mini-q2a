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

    public function del()
    {
    }
    public function edit()
    {
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
