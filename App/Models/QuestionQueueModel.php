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

        $sql = "SELECT * FROM `questionqueue` AS q
        ORDER BY q.createdAt DESC;";
        $db->load($sql);
        $ret = $db->Rows();
        return $ret;
    }



    public function detail($que_id)
    {
        $db = new Db();

        $sql = "SELECT q.que_id, q.que_content, q.que_title, q.createdAt, u.user_id,
        u.user_name, qCate.que_cate_id, qCate.que_cate_name
        FROM `questionqueue` AS q
        INNER JOIN `users` AS u
        ON q.user_id = u.user_id
        INNER JOIN  `questioncategories` as qCate
        ON qCate.que_cate_id = q.que_cate_id
        WHERE q.is_accepted = TRUE
        AND q.que_id = '$que_id';";

        $db->load($sql);
        $ret = $db->Rows();
        return $ret[0];
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

    public function del($que_id)
    {
        $db = new Db();

        $sql = "DELETE 
        FROM `questionqueue` AS q
        WHERE q.que_id='$que_id';";

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
        ORDER BY questionqueue.createdAt DESC;
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
        ORDER BY createdAt DESC;
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
        ORDER BY questionqueue.que_id DESC;
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
        ORDER BY createdAt DESC 
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


    public function FilterQuestionQueueByQuestionCategory($cate_id)
    {
        $db = new Db();

        $sql = "SELECT questionqueue.que_id,questionqueue.que_title,questionqueue.createdAt,users.user_name 
        FROM `questionqueue`,`users`
        WHERE users.user_id = questionqueue.user_id 
        AND questionqueue.que_cate_id='$cate_id'
        AND questionqueue.is_accepted = TRUE
        ORDER BY createdAt DESC
        LIMIT 10
        OFFSET 0;
        ";

        $db->load($sql);
        $data = $db->Rows();

        return $data;
    }


    public function FilterQuestionQueueByQuestionCategoryPagination($cate_id, $limit, $offset)
    {
        $db = new Db();

        $sql = "SELECT questionqueue.que_id,questionqueue.que_title,questionqueue.createdAt,users.user_name 
        FROM `questionqueue`,`users`
        WHERE users.user_id = questionqueue.user_id 
        AND questionqueue.que_cate_id='$cate_id'
        AND questionqueue.is_accepted = TRUE
        ORDER BY createdAt DESC
        LIMIT $limit
        OFFSET $offset;
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
            ORDER BY createdAt DESC
            LIMIT 10
            OFFSET 0;
            ";

        $db->load($sql);
        $data = $db->Rows();

        return $data;
    }

    public function getLikeRatingOfQuestionDetail($que_id)
    {
        $db = new Db();

        $sql = "SELECT r.rate_id, r.rate_name, r.que_id, r.user_id, u.user_name
        FROM `ratingsquestion` AS r
        INNER JOIN `questionqueue` AS q
        ON q.que_id= r.que_id
        INNER JOIN `users`  AS u
        ON u.user_id = r.user_id
        WHERE q.is_accepted = TRUE 
        AND r.rate_name = 'like'
        AND r.que_id='$que_id';";

        $db->load($sql);
        $data = $db->Rows();
        return $data;
    }
    public function getSpamRatingOfQuestionDetail($que_id)
    {
        $db = new Db();

        $sql = "SELECT r.rate_id, r.rate_name, r.que_id, r.user_id, u.user_name
        FROM `ratingsquestion` AS r
        INNER JOIN `questionqueue` AS q
        ON q.que_id= r.que_id
        INNER JOIN `users`  AS u
        ON u.user_id = r.user_id
        WHERE q.is_accepted = TRUE 
        AND r.rate_name = 'spam'
        AND r.que_id='$que_id';";

        $db->load($sql);
        $data = $db->Rows();
        return $data;
    }
    public function getBadcontentRatingOfQuestionDetail($que_id)
    {
        $db = new Db();

        $sql = "SELECT r.rate_id, r.rate_name, r.que_id, r.user_id, u.user_name
        FROM `ratingsquestion` AS r
        INNER JOIN `questionqueue` AS q
        ON q.que_id= r.que_id
        INNER JOIN `users`  AS u
        ON u.user_id = r.user_id
        WHERE q.is_accepted = TRUE 
        AND r.rate_name = 'bad_content'
        AND r.que_id='$que_id';";

        $db->load($sql);
        $data = $db->Rows();
        return $data;
    }

    public function getLikeRatingAnswersByAnsID($ans_id)
    {
        $db = new Db();

        $sql = "SELECT  COUNT(*) AS like_count
        FROM `ratingsAnswer` AS r
        WHERE r.rate_name = 'like'
        AND r.ans_id='$ans_id';";
        $db->load($sql);
        $data = $db->Rows();

        return $data[0];
    }
    public function getSpamRatingAnswersByAnsID($ans_id)
    {
        $db = new Db();

        $sql = "SELECT  COUNT(*) AS spam_count
        FROM `ratingsAnswer` AS r
        WHERE r.rate_name = 'spam'
        AND r.ans_id='$ans_id';";
        $db->load($sql);
        $data = $db->Rows();

        return $data[0];
    }
    public function getBadContentRatingAnswersByAnsID($ans_id)
    {
        $db = new Db();

        $sql = "SELECT  COUNT(*) AS bad_content_count
        FROM `ratingsAnswer` AS r
        WHERE r.rate_name = 'bad_content'
        AND r.ans_id='$ans_id';";
        $db->load($sql);
        $data = $db->Rows();

        return $data[0];
    }
}
