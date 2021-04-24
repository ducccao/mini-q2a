use mini_social_network;


-- --------------------------------------
-- Count the amount of question's category
-- --------------------------------------
SELECT  questioncategories.que_cate_name, COUNT(*) AS amount
FROM `questioncategories`
LEFT JOIN `questionqueue`
ON questioncategories.que_cate_id =  questionqueue.que_cate_id
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
ORDER BY createdAt;
-- ------------------------------------------------------
-- Get full like_count of full question queue 
-- ------------------------------------------------------
SELECT questionqueue.que_id,questionqueue.que_title,ratingsquestion.rate_name, COUNT(*) AS like_count
FROM `questionqueue`
INNER JOIN `ratingsquestion`
ON questionqueue.que_id = ratingsquestion.que_id
WHERE ratingsquestion.rate_name ='like'
GROUP BY questionqueue.que_id
ORDER BY questionqueue.que_id;

-- ------------------------------------------------------
-- Get full question queue paginationed without: like_count, array tag
-- ------------------------------------------------------
SELECT questionqueue.que_id,questionqueue.que_title,questionqueue.createdAt,users.user_name 
FROM `questionqueue`,`users`
WHERE users.user_id = questionqueue.user_id 
ORDER BY createdAt
LIMIT 10
OFFSET 0;



----------------
-- testing
----------------
select * from `users`;
select * from `questionqueue`;
select * from `ratingsquestion`;
select * from `questioncategories`;
select * from `labels`;
select * from `quetionqueue_labels`;

	


