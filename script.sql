drop database if exists rent_a_car;
create database rent_a_car character set utf8mb4 COLLATE utf8mb4_unicode_ci;

use rent_a_car;

create table if not exists car_brand (
    id int auto_increment not null primary key,
    brand varchar(255)
);

create table if not exists cars (
    id int auto_increment not null primary key,
    car_name varchar(100),
    car_year int not null,
    color varchar(30),
    car_km int,
    brand_id int,
    foreign key (brand_id) references car_brand(id)
);

create table if not exists users (
    id int not null auto_increment primary key,
    username varchar(100) unique,
    first_name varchar(100),
    last_name varchar(100),
    email varchar(100),
    pass varchar(100),
    country varchar(100),
    license varchar(10),
    join_date timestamp
);

create table if not exists rental (
    id int auto_increment not null primary key,
    start_date date,
    end_date date,
    car_id int,
    brand_id int,
    user_id int,
    foreign key (car_id) references cars(id),
    foreign key (brand_id) references car_brand(id),
    foreign key (user_id) references users(id)
);