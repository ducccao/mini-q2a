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

    public function allWithAccepted()
    {
        $db = new Db();

        $sql = "SELECT * FROM `questionqueue` AS q
        WHERE q.is_accepted= TRUE
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

        if (count($ret) > 0) {
            return $ret[0];
        }
        return null;
    }

    public function detailWithAcceptIsFalse($que_id)
    {
        $db = new Db();

        $sql = "SELECT q.que_id, q.que_content, q.que_title, q.createdAt, u.user_id,
        u.user_name, qCate.que_cate_id, qCate.que_cate_name, q.is_accepted
        FROM `questionqueue` AS q
        INNER JOIN `users` AS u
        ON q.user_id = u.user_id
        INNER JOIN  `questioncategories` as qCate
        ON qCate.que_cate_id = q.que_cate_id
        WHERE q.is_accepted = false
        AND q.que_id = '$que_id';";

        $db->load($sql);
        $ret = $db->Rows();

        if (count($ret) > 0) {
            return $ret[0];
        }
        return null;
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

    public function FiveOutstandingQuetion()
    {
        $db = new Db();

        $sql = "SELECT qq.que_id, qq.que_content, qq.que_title,
         qq.createdAt, u.user_name, r.rate_name, COUNT(*) AS like_count
        FROM `questionqueue` AS qq 
        INNER JOIN `ratingsquestion` as r
        ON r.que_id = qq.que_id
        INNER JOIN `users` AS u
        ON u.user_id = qq.user_id
        WHERE qq.is_accepted = TRUE
        AND r.rate_name= 'like'
        GROUP BY qq.que_id
        ORDER BY qq.createdAt DESC
        LIMIT 5;";

        $db->load($sql);
        $data = $db->Rows();
        return $data;
    }

    public function GetNewestQuestionQueueWithoutArrayTag()
    {
        $db = new Db();
        $sql = "SELECT  questionqueue.que_id,questionqueue.que_title , 
        questionqueue.createdAt,COUNT(*)  as like_count,users.user_name
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

        $sql = 'SELECT questionqueue.que_id,questionqueue.que_title,
        questionqueue.createdAt,users.user_name 
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

    public function filterByTagTotalQuestion($label_id)
    {
        $db = new Db();

        // $sql = 'SELECT questionqueue.que_id,questionqueue.que_title,questionqueue.createdAt,users.user_name 
        // FROM `questionqueue`,`users`
        // WHERE users.user_id = questionqueue.user_id 
        // AND questionqueue.is_accepted = TRUE
        // ORDER BY createdAt DESC 
        // LIMIT ' . $limit .
        //     ' OFFSET ' . $offset;

        $sql = "SELECT q.que_id,q.que_title,q.createdAt,u.user_name , l.label_id, l.label_name
            FROM `questionqueue` as q,`users`as u, `labels` as l, `quetionqueue_labels` as ql
            WHERE u.user_id = q.user_id 
            AND q.is_accepted = TRUE
            AND l.label_id = ql.label_id
            AND ql.que_id = q.que_id
            AND l.label_id = '$label_id'
          ;";




        $db->load($sql);
        $data = $db->Rows();

        return $data;
    }

    public function filterByTag($label_id, $limit, $offset)
    {
        $db = new Db();

        // $sql = 'SELECT questionqueue.que_id,questionqueue.que_title,questionqueue.createdAt,users.user_name 
        // FROM `questionqueue`,`users`
        // WHERE users.user_id = questionqueue.user_id 
        // AND questionqueue.is_accepted = TRUE
        // ORDER BY createdAt DESC 
        // LIMIT ' . $limit .
        //     ' OFFSET ' . $offset;

        $sql = "SELECT q.que_id,q.que_title,q.createdAt,u.user_name , l.label_id, l.label_name
            FROM `questionqueue` as q,`users`as u, `labels` as l, `quetionqueue_labels` as ql
            WHERE u.user_id = q.user_id 
            AND q.is_accepted = TRUE
            AND l.label_id = ql.label_id
            AND ql.que_id = q.que_id
            AND l.label_id = '$label_id'
            ORDER BY l.label_name DESC 
            LIMIT $limit
            OFFSET  $offset;";




        $db->load($sql);
        $data = $db->Rows();

        return $data;
    }



    public function filterByNewestTime($limit, $offset)
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
    public function filterByOldestTime($limit, $offset)
    {
        $db = new Db();

        $sql = 'SELECT questionqueue.que_id,questionqueue.que_title,questionqueue.createdAt,users.user_name 
        FROM `questionqueue`,`users`
        WHERE users.user_id = questionqueue.user_id 
        AND questionqueue.is_accepted = TRUE
        ORDER BY createdAt ASC 
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

        $sql = "SELECT quetionqueue_labels.que_id,labels.label_name,labels.label_id
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

    public function FullTextSearchPagi($keyword, $limit, $offset)
    {
        $db = new Db();
        $sql = "SELECT * 
        FROM `questionQueue` QQ 
        INNER JOIN `users` U 
        ON U.USER_ID=QQ.USER_ID
        WHERE MATCH(QQ.QUE_CONTENT)
        AGAINST ('$keyword' IN NATURAL LANGUAGE MODE)
        ORDER BY QQ.CREATEDAT DESC
        LIMIT $limit
        OFFSET $offset;";;

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
