create database xdushop;

create table xdushop_admin(
    id tinyint unsigned auto_increment key,
    username varchar(20) not null unique,
    password varchar(32) not null,
    email varchar(50) not null
);

create table xdushop_cate(
    id smallint unsigned auto_increment key,
    cName varchar(50) unique
);

create table xdushop_pro(
    id int unsigned auto_increment key,
    pName varchar(50) not null unique,
    pSn varchar(50) not null,
    pNum int unsigned fault 1,
    mPrice decimal(10, 2) not null,
    xduPrice decimal(10, 2) not null,
    pDesc text,
    pubTime int unsigned not null,
    isShow tinyint(1) default 1,
    isHot tinyint(1) default 0,
    cId smallint unsigned not null
);

create table xdushop_user(
    id int unsigned auto_increment key,
    username varchar(20) not null unique,
    password varchar(32) not null,
    sex enum("male", "female", "secret") not null default "secret",
    face varchar(50) not null,
    regTime int unsigned not null
);

create table xdushop_album(
    id int unsigned auto_increment key,
    pid int unsigned not null,
    albumPath varchar(50) not null
);
