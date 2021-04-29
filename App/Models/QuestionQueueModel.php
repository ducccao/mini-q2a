<?php

namespace App\Models;

use Db;

class QuestionQueueModel
{
    public function __construct()
    {
    }

    public function all()
    {
        $db = new Db();

        $sql = "SELECT * FROM `questionqueue`;";
        $db->load($sql);
        $ret = $db->Rows();
        return $ret;
    }

    public function add($que_id, $que_content, $que_title, $user_id, $que_cate_id)
    {
        $db = new Db();

        $sql = "INSERT INTO 
        `questionQueue`
        (que_id,que_content,que_title,createdAt,user_id,que_cate_id,is_accepted) 
        VALUES ('$que_id','$que_content','$que_title',current_timestamp(),
        '$user_id','$que_cate_id',FALSE); 
        ";

        $ret = $db->patchDb($sql);
        return $ret;
    }

    public function GetNewestQuestionQueueWithoutArrayTag()
    {
        $db = new Db();
        $sql = "SELECT  questionqueue.que_id,questionqueue.que_title , 
        questionqueue.createdAt,COUNT(*) as like_count,users.user_name
        FROM `questionqueue`
        LEFT JOIN `ratingsquestion`
        ON ratingsquestion.que_id = questionqueue.que_id 
        LEFT JOIN `users`
        ON users.user_id = questionqueue.user_id 
        WHERE ratingsquestion.rate_name = 'like'
        AND questionqueue.is_accepted = TRUE
        GROUP BY questionqueue.que_id
        ORDER BY questionqueue.createdAt;
        ";

        $db->load($sql);
        $data = $db->Rows();
        return $data;
    }


    public function GetNewstQuestionQueueArrayTagName()
    {
        $db = new Db();

        $sql = "SELECT quetionqueue_labels.que_id,labels.label_name
        FROM `quetionqueue_labels`
        LEFT JOIN `labels`
        ON labels.label_id = quetionqueue_labels.label_id;
        ";

        $db->load($sql);
        $data = $db->Rows();

        return $data;
    }

    public function GetFullQuestionQueue()
    {
        $db = new Db();

        $sql = 'SELECT questionqueue.que_id,questionqueue.que_title,
        questionqueue.createdAt,users.user_name 
        FROM `questionqueue`,`users`
        WHERE users.user_id = questionqueue.user_id 
        AND questionqueue.is_accepted = TRUE
        ORDER BY createdAt;
        ';

        $db->load($sql);
        $data = $db->Rows();

        return $data;
    }

    public function GetFullLikeCountOfFullQuestionQueue()
    {
        $db = new Db();

        $sql = "SELECT questionqueue.que_id,questionqueue.que_title,ratingsquestion.rate_name, 
        COUNT(*) AS like_count
        FROM `questionqueue`
        INNER JOIN `ratingsquestion`
        ON questionqueue.que_id = ratingsquestion.que_id
        WHERE ratingsquestion.rate_name ='like'
        AND questionqueue.is_accepted = TRUE
        GROUP BY questionqueue.que_id
        ORDER BY questionqueue.que_id;
        ";

        $db->load($sql);
        $data = $db->Rows();

        return $data;
    }

    public function GetFullQuestionQueueByPagination($limit, $offset)
    {
        $db = new Db();

        $sql = 'SELECT questionqueue.que_id,questionqueue.que_title,questionqueue.createdAt,users.user_name 
        FROM `questionqueue`,`users`
        WHERE users.user_id = questionqueue.user_id 
        AND questionqueue.is_accepted = TRUE
        ORDER BY createdAt
        LIMIT ' . $limit .
            ' OFFSET ' . $offset;


        // console_log($sql);


        $db->load($sql);
        $data = $db->Rows();

        return $data;
    }

    public function GetFullArrayTagsOfFullQuetionQueue()
    {
        $db = new Db();

        $sql = "SELECT quetionqueue_labels.que_id,labels.label_name
        FROM  `quetionqueue_labels`
        INNER JOIN `labels`
        ON labels.label_id=quetionqueue_labels.label_id;
        ";

        $db->load($sql);
        $data = $db->Rows();

        return $data;
    }


    public function FilterQuestionQueueByQuestionCategoryPaginationed($cate_id)
    {
        $db = new Db();

        $sql = "SELECT questionqueue.que_id,questionqueue.que_title,questionqueue.createdAt,users.user_name 
        FROM `questionqueue`,`users`
        WHERE users.user_id = questionqueue.user_id 
        AND questionqueue.que_cate_id='$cate_id'
        AND questionqueue.is_accepted = TRUE
        ORDER BY createdAt
        LIMIT 10
        OFFSET 0;
        ";

        $db->load($sql);
        $data = $db->Rows();

        return $data;
    }

    public function GetQuestionByKeyFullText($keyWord)
    {
        $db = new Db();

        $sql = "SELECT * FROM `questionQueue` qq
            JOIN `users` u ON u.user_id = qq.user_id 
            WHERE MATCH(que_content)
            AGAINST('$keyWord' IN NATURAL LANGUAGE MODE)
            ORDER BY createdAt
            LIMIT 10
            OFFSET 0;
            ";

        $db->load($sql);
        $data = $db->Rows();

        return $data;
    }

    public function detail($qq_id)
    {
        $db = new Db();

        $sql = "SELECT *
        FROM  `questionqueue`
        WHERE que_id='$qq_id';";

        $db->load($db);
        $data = $db->Rows();

        return $data;
    }
}
