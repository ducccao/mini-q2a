use mini_social_network;



-- --------------------------------------
-- Count the amount of question's category
-- --------------------------------------
SELECT questioncategories.que_cate_id, questioncategories.que_cate_name, COUNT(*) AS amount
FROM `questioncategories`
LEFT JOIN `questionqueue`
ON questioncategories.que_cate_id =  questionqueue.que_cate_id
WHERE questionqueue.is_accepted = true
GROUP BY questioncategories.que_cate_name
ORDER BY questioncategories.que_cate_name;


-- -----------------------------------------------------------------------------------------------------
--  Get Newst Question In HomePage - Title, username ,Like , created at and without array tags
-- -----------------------------------------------------------------------------------------------------
SELECT  questionqueue.que_id,questionqueue.que_title , questionqueue.createdAt,COUNT(*) as like_count,
users.user_name
FROM `questionqueue`
INNER JOIN `ratingsquestion`
ON ratingsquestion.que_id = questionqueue.que_id 
INNER JOIN `users`
ON users.user_id = questionqueue.user_id 
WHERE ratingsquestion.rate_name = 'like'
AND questionqueue.is_accepted = TRUE
GROUP BY questionqueue.que_title
ORDER BY questionqueue.createdAt;


-- --------------------------------------------------
-- Get Newst Question In HomePage - Get Array Tag name
-- --------------------------------------------------
SELECT quetionqueue_labels.que_id,labels.label_name
FROM `quetionqueue_labels`
LEFT JOIN `labels`
ON labels.label_id = quetionqueue_labels.label_id;


-- ------------------------------------------------------
-- Get full question queue without: like_count, array tag
-- ------------------------------------------------------
SELECT questionqueue.que_id,questionqueue.que_title,questionqueue.createdAt,users.user_name 
FROM `questionqueue`,`users`
WHERE users.user_id = questionqueue.user_id 
AND questionqueue.is_accepted = TRUE
ORDER BY createdAt;
-- ------------------------------------------------------
-- Get full like_count of full question queue 
-- ------------------------------------------------------
SELECT questionqueue.que_id,questionqueue.que_title,ratingsquestion.rate_name, COUNT(*) AS like_count
FROM `questionqueue`
INNER JOIN `ratingsquestion`
ON questionqueue.que_id = ratingsquestion.que_id
WHERE ratingsquestion.rate_name ='like'
AND questionqueue.is_accepted = TRUE
GROUP BY questionqueue.que_id
ORDER BY questionqueue.que_id;

-- ------------------------------------------------------
-- Get full question queue paginationed without: like_count, array tag
-- ------------------------------------------------------
SELECT questionqueue.que_id,questionqueue.que_title,questionqueue.createdAt,users.user_name 
FROM `questionqueue`,`users`
WHERE users.user_id = questionqueue.user_id 
AND questionqueue.is_accepted = TRUE
ORDER BY createdAt
LIMIT 100
OFFSET 0;
-- ------------------------------------------------------
-- Get full array tags of full question queue 
-- ------------------------------------------------------
SELECT quetionqueue_labels.que_id,labels.label_name
FROM  `quetionqueue_labels`
INNER JOIN `labels`
ON labels.label_id=quetionqueue_labels.label_id;
-- ------------------------------------------------------
-- Fillter full question queue by question category paginationed
-- ------------------------------------------------------
SELECT questionqueue.que_id,questionqueue.que_title,questionqueue.createdAt,users.user_name 
FROM `questionqueue`,`users`
WHERE users.user_id = questionqueue.user_id 
AND questionqueue.que_cate_id='que_cate_01'
AND questionqueue.is_accepted = TRUE
ORDER BY createdAt
LIMIT 10
OFFSET 0;
-- ------------------------------------------------------
-- 	Get User Rank For Register
-- ------------------------------------------------------
SELECT COUNT(*) FROM USERS;

-- ------------------------------------------------------
-- Register
-- ------------------------------------------------------
INSERT INTO `users`(user_id,email,user_name,user_pass,user_type,user_rank,toggle_send_notify_status) 
VALUES ('user9','user09@gmail.com','user9','user9','user','100',true);


-- ------------------------------------------------------
-- Qestion queue detail
-- ------------------------------------------------------
SELECT *
FROM  `questionqueue`
WHERE que_id='que_01';




-- ----------------------------------------------------------
-- ADMIN. All Question Category
-- ----------------------------------------------------------
SELECT*
FROM `questioncategories`;
-- ----------------------------------------------------------
-- ADMIN. Add Question Category
-- ----------------------------------------------------------
INSERT INTO `questioncategories` (que_cate_id,que_cate_name)
VALUES ('que_cate_','Hóa học');
-- ----------------------------------------------------------
-- ADMIN. Delete Question Category
-- ----------------------------------------------------------
DELETE 
FROM `questioncategories` AS q
WHERE q.que_cate_id='4O8oRVGD2P';
-- ----------------------------------------------------------
-- ADMIN. Edit Question Category
-- ----------------------------------------------------------
UPDATE `questioncategories` AS qcat
SET qcat.que_cate_name = 'NEW NAME'
WHERE qcat.que_cate_id = 'old id';

-- ------------------------------------------------------
-- Get All Quetion Category, All Question Queue
-- -----------------------------------------------------
select * from `questioncategories`;
SELECT * FROM `questionqueue`;
-- ------------------------------------------------------
-- Upload question
-- ------------------------------------------------------
INSERT INTO `questionQueue`(que_id,que_content,que_title,createdAt,user_id,que_cate_id,is_accepted) 
VALUES ("que_03",'Toán đại học như thế nào ?','Toán đại học',current_timestamp(),"user_02",'que_cate_02',TRUE); 


-- ----------------------------------------------------------
-- ADMIN. All Question 
-- ----------------------------------------------------------
SELECT  *
FROM `questionqueue`;


-- ----------------------------------------------------------
-- Home. Question queue detail
-- ----------------------------------------------------------
SELECT q.que_id, q.que_content, q.que_title, q.createdAt, u.user_id,
u.user_name, qCate.que_cate_id, qCate.que_cate_name
FROM `questionqueue` AS q
INNER JOIN `users` AS u
ON q.user_id = u.user_id
INNER JOIN  `questioncategories` as qCate
ON qCate.que_cate_id = q.que_cate_id
WHERE q.is_accepted = TRUE
AND q.que_id = 'que_01';

-- ----------------------------------------------------------
-- Home. Answer of question queue detail 
-- ----------------------------------------------------------
SELECT a.ans_id,a.que_id, a.ans_content, a.ans_source_url, a.ans_images,
 a.createdAt, a.user_id, u.user_name, a.is_accepted
FROM `answers` AS a
INNER JOIN `users` AS u
ON u.user_id = a.user_id
WHERE a.que_id = 'que_01'
AND a.is_accepted = TRUE
 ORDER BY a.createdAt;
 -- ----------------------------------------------------------
-- Home. Like Rating Data Question Of Question Detail 
-- ----------------------------------------------------------
SELECT r.rate_id, r.rate_name, r.que_id, r.user_id, u.user_name
FROM `ratingsquestion` AS r
INNER JOIN `questionqueue` AS q
ON q.que_id= r.que_id
INNER JOIN `users`  AS u
ON u.user_id = r.user_id
WHERE q.is_accepted = TRUE 
AND r.rate_name = 'like'
AND r.que_id='que_01';
 -- ----------------------------------------------------------
-- Home. Spam Rating Data Question Of Question Detail 
-- ----------------------------------------------------------
SELECT r.rate_id, r.rate_name, r.que_id, r.user_id, u.user_name
FROM `ratingsquestion` AS r
INNER JOIN `questionqueue` AS q
ON q.que_id= r.que_id
INNER JOIN `users`  AS u
ON u.user_id = r.user_id
WHERE q.is_accepted = TRUE 
AND r.rate_name = 'spam'
AND r.que_id='que_01';
 -- ----------------------------------------------------------
-- Home. Spam Rating Data Question Of Question Detail 
-- ----------------------------------------------------------
SELECT r.rate_id, r.rate_name, r.que_id, r.user_id, u.user_name
FROM `ratingsquestion` AS r
INNER JOIN `questionqueue` AS q
ON q.que_id= r.que_id
INNER JOIN `users`  AS u
ON u.user_id = r.user_id
WHERE q.is_accepted = TRUE 
AND r.rate_name = 'bad_content'
AND r.que_id='que_01';
 -- ----------------------------------------------------------
-- Home. Get like rating Answer With AnsID - quetion detail
-- ----------------------------------------------------------
SELECT  COUNT(*)
FROM `ratingsAnswer` AS r
WHERE r.rate_name = 'like'
AND r.ans_id='ans_01';


-- ----------------------------------------------------------
-- Home. All rating question
-- ----------------------------------------------------------   
SELECT *
FROM `ratingsquestion`;

-- ----------------------------------------------------------
-- Home. All Like rating question
-- ----------------------------------------------------------   
SELECT *
FROM `ratingsquestion`
WHERE rate_name ='like';

-- ----------------------------------------------------------
-- Home. All spam rating question
-- ----------------------------------------------------------   
SELECT *
FROM `ratingsquestion`
WHERE rate_name ='spam';

-- ----------------------------------------------------------
-- Home. All bad_content rating question
-- ----------------------------------------------------------   
SELECT *
FROM `ratingsquestion`
WHERE rate_name ='bad_content';




-- ----------------------------------------------------------
-- Home. Like Rating By User  - Question Detail
-- ----------------------------------------------------------   
INSERT INTO `ratingsquestion` (rate_id, rate_name, que_id, user_id)
VALUES ('rate_10','like','que_03','user_08');

-- ----------------------------------------------------------
-- Home. Un-Like Rating By User  - Question Detail
-- ----------------------------------------------------------   
DELETE 
FROM `ratingsquestion`
WHERE user_id = 'user_06' 
AND que_id = 'que_03'
AND rate_name = 'like';

-- ----------------------------------------------------------
-- Home. Un-Spam Rating By User  - Question Detail
-- ----------------------------------------------------------   
DELETE 
FROM `ratingsquestion`
WHERE user_id = 'user_06' 
AND que_id = 'que_03'
AND rate_name = 'spam';

-- ----------------------------------------------------------
-- Home. Get category by que_id - Question Detail
-- ----------------------------------------------------------   
SELECT qCat.que_cate_id, qCat.que_cate_name
FROM `questioncategories` AS qCat
LEFT JOIN `questionqueue` AS q
ON q.que_cate_id = qCat.que_cate_id
WHERE q.que_id='que_03';


-- ----------------------------------------------------------
-- Home. Get Label by que_id - Question Detail
-- ----------------------------------------------------------   
SELECT  ql.que_id,  ql.label_id, l.label_name
FROM `quetionqueue_labels` AS ql
INNER JOIN `labels` AS l
ON ql.label_id = l.label_id
WHERE ql.que_id= '8k3lPCf9QE';

-- ----------------------------------------------------------
-- Home. Answer 
-- ----------------------------------------------------------   
INSERT INTO `answers` (ans_id, ans_content, ans_source_URL, ans_images, createdAt, que_id, user_id,is_accepted)
VALUES ('ans_id', 'ans_content', 'ans_source_URL', 'ans_images', current_timestamp(), 'que_01', 'user_01',false);

-- ----------------------------------------------------------
-- Home. Get userID by queID - Answer 
-- ----------------------------------------------------------   
SELECT u.user_id
FROM `users` as u
LEFT JOIN `questionqueue` AS q
ON q.user_id = u.user_id
WHERE q.que_id = 'que_01';





-- ----------------------------------------------------------
-- Home. All label - Upload Question
-- ----------------------------------------------------------  
SELECT * 
FROM `labels`;
-- ----------------------------------------------------------
-- Home. Add label - Upload Question
-- ----------------------------------------------------------   
INSERT INTO `labels`(label_id, label_name)
VALUES ('a','vatly');

-- ----------------------------------------------------------
-- Home. Add question label - Upload Question
-- ----------------------------------------------------------   
INSERT INTO `quetionqueue_labels`(que_id, label_id)
VALUES ('a','vatly');
 
 -- ----------------------------------------------------------
-- Home. Find label by label name - Upload Question
-- ----------------------------------------------------------  
SELECT  *
FROM  `labels`AS l
WHERE l.label_name='ok';


 

 


-- ----------------------------------------------------------
-- Admin. Detail Question
-- ----------------------------------------------------------
SELECT q.que_id, q.que_content, q.que_title, q.createdAt, u.user_id,
        u.user_name, qCate.que_cate_id, qCate.que_cate_name
        FROM `questionqueue` AS q
        INNER JOIN `users` AS u
        ON q.user_id = u.user_id
        INNER JOIN  `questioncategories` as qCate
        ON qCate.que_cate_id = q.que_cate_id
        WHERE q.is_accepted = TRUE
        AND q.que_id = '$que_id';
        
-- ----------------------------------------------------------
-- Admin. Answer Of Detail Question 
-- ----------------------------------------------------------   
        
SELECT a.ans_id, a.que_id, a.ans_content, a.ans_source_url, a.ans_images,
        a.createdAt, a.user_id, u.user_name, a.is_accepted
       FROM `answers` AS a
       INNER JOIN `users` AS u
       ON u.user_id = a.user_id
       WHERE a.que_id = 'que_01'
       ORDER BY a.createdAt;
-- ----------------------------------------------------------
-- Admin. Accepted Question
-- ----------------------------------------------------------   
UPDATE `questionqueue` AS q
SET q.is_accepted = 0
WHERE que_id = 'que_01';

-- ----------------------------------------------------------
-- Admin. All Answer
-- ----------------------------------------------------------
SELECT a.ans_id, a.ans_content, a.createdAt, u.user_name, qq.que_id, a.is_accepted
FROM `answers` AS a
INNER JOIN `questionqueue` AS qq 
ON qq.que_id = a.que_id 
INNER JOIN `users` AS u
ON u.user_id = a.user_id
ORDER BY a.createdAt DESC;


----------------
-- testing
----------------
select * from `users` order by user_id;
select * from `questionqueue`;
select * from `autoquestionaccepted`;

select * from `questioncategories`;
select * from `labels`;
select * from `quetionqueue_labels`;
select * from `answers`;
select * from `ratingsAnswer`;
select * from `ratingsquestion`;




-- Get all question with keyword of que_content
SELECT * FROM questionQueue
WHERE MATCH(que_content)
    AGAINST("Toán" IN NATURAL LANGUAGE MODE);

-- Get all question with keyword of que_title
SELECT * FROM questionQueue
WHERE MATCH(que_title)
    AGAINST("Lý" IN NATURAL LANGUAGE MODE);


