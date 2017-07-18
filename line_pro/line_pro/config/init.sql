
create database line_guide;

grant all on line_guide.* to dbuser@localhost identified by 'mu4uJsif';

use line_guide

//登録内容
create table users (
  id int not null auto_increment primary key,
  email varchar(255) unique,
  password varchar(255),
  created datetime,
  modified datetime
);

desc users;


//テキスト保存
create table adv(
  adv_id int not null auto_increment primary key,
  u_id int,
  title varchar(255),
  body varchar(255),
  subm_time datetime,
  ad_time datetime,
);


/*
create database dotinstall_sns_php;

grant all on dotinstall_sns_php.* to dbuser@localhost identified by 'mu4uJsif';

use dotinstall_sns_php

create table users (
  id int not null auto_increment primary key,
  email varchar(255) unique,
  password varchar(255),
  created datetime,
  modified datetime
);

desc users;
*/
