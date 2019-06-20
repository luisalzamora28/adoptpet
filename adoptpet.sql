DROP SCHEMA IF EXISTS `adoptpet`;
CREATE DATABASE adoptpet CHARACTER SET utf8 COLLATE utf8_general_ci;
USE adoptpet;
SET NAMES 'utf8';

CREATE TABLE admin(
    id int primary key auto_increment,
    username varchar(60) not null,
    email varchar(200) not null,
    password varchar(60) not null,
    status tinyint(1) default 1
);
INSERT INTO admin (username,email,password) VALUES ('admin','admin@admin',md5('admin'));

CREATE TABLE customer(
    id int primary key auto_increment,
    firstname varchar(100),
    lastname varchar(100),
    dni varchar(20),
    address varchar(100),
    district varchar(100),
    phone varchar(20),
    birthdate date,
    job varchar(50),
    business varchar(100),
    email varchar(100) not null,
    password varchar(60) not null,
    status tinyint(1) default 1,
    created_at datetime,
    updated_at datetime
);

CREATE TABLE dog(
    id int primary key auto_increment,
    admin_id int, foreign key (admin_id) references admin(id),
    name varchar(50),
    sex varchar(10),
    age varchar(30),
    size varchar(20),
    fur varchar(20),
    activity varchar(30),
    required_space varchar(20),
    time_alone varchar(30),
    code varchar(10),
    adoption_contribution int default 0,
    adoption_status tinyint(1) default 0,
    created_at datetime,
    updated_at datetime
);

CREATE TABLE resource (
    id int primary key auto_increment,
    dog_id int, foreign key (dog_id) references dog(id),
    admin_id int, foreign key (admin_id) references admin(id),
    type varchar(5),
    body varchar(100),
    name varchar(100),
    created_at datetime,
    status tinyint(1) default 0
);

CREATE TABLE adoption(
    id int primary key auto_increment,
    dog_id int, foreign key (dog_id) references dog(id),
    customer_id int, foreign key (customer_id) references customer(id),
    description varchar(200),
    created_at datetime,
    status tinyint(1) default 0
);

CREATE TABLE message(
    id int primary key auto_increment,
    name varchar(60),
    email varchar(100),
    body varchar(300),
    status tinyint(1) default 0,
    created_at datetime
);
