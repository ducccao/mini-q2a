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
-- Upload question
-- ------------------------------------------------------
INSERT INTO `questionQueue`(que_id,que_content,que_title,createdAt,user_id,que_cate_id,is_accepted) 
VALUES ("que_03",'Toán đại học như thế nào ?','Toán đại học',current_timestamp(),"user_02",'que_cate_02',TRUE); 


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



----------------
-- testing
----------------
select * from `users` order by user_id;
select * from `questionqueue`;
select * from `autoquestionaccepted`;
select * from `ratingsquestion`;
select * from `questioncategories`;
select * from `labels`;
select * from `quetionqueue_labels`;

-- Get all question with keyword of que_content
SELECT * FROM questionQueue
WHERE MATCH(que_content)
    AGAINST("Toán" IN NATURAL LANGUAGE MODE);

-- Get all question with keyword of que_title
SELECT * FROM questionQueue
WHERE MATCH(que_title)
    AGAINST("Lý" IN NATURAL LANGUAGE MODE);


