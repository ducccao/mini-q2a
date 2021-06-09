<?php

namespace App\Models;

use Db;

class RankingModel
{
    public function __construct()
    {
    }

    public function all()
    {
        $db = new Db();

        $sql = "select u.user_id, u.user_name, u.user_type,
         ifnull(qq.num_question,0) as num_question ,ifnull(ans.num_answer,0) as num_answer,
        (ifnull( qq.num_question,0)+  ifnull(ans.num_answer,0) ) as total_count_ranking,  
        ifnull(qqMonth,0) as queMonth, ifnull(ansMonth,0) as ansMonth
       from `users` u
       left join
       ( 
       select  qq.user_id, count(*) as num_question, date_format(qq.createdAt,'%M') as qqMonth
       from `questionqueue` qq
       group by qq.user_id	, date_format(qq.createdAt,'%M')
       order by date_format(qq.createdAt,'%M')
       ) qq
       on qq.user_id = u.user_id
       left join(
       select ans.user_id, count(*) as num_answer,
       date_format(ans.createdAt,'%M') as ansMonth
       from `answers` ans
       group by ans.user_id,date_format(ans.createdAt,'%M')
       order by date_format(ans.createdAt,'%M')
       ) ans
       on ans.user_id = u.user_id
       group by queMonth,user_id,ansMonth
       order by total_count_ranking desc;
       ";

        $db->load($sql);
        $ret = $db->Rows();
        return $ret;
    }
}
