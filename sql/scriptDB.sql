drop database if exists `mini_social_network`;
create database mini_social_network;
use mini_social_network;

drop table if exists `users`;
create table `users`(
	user_id int primary key auto_increment,
    email nvarchar(200),
    user_name nvarchar(200),
    user_pass nvarchar(200),
    user_type nvarchar(200),
    user_rank nvarchar(200)
);

insert into `users`(user_id,email,user_name,user_pass,user_type,user_rank) 
values (1,'duccao01@gmail.com','duccao','duc123','admin','100');