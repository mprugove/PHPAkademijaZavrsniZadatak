use polaznik17;

create table if not exists cars (
    id int auto_increment not null primary key,
    manufacturer varchar(100),
    car_name varchar(100),
    car_year int not null,
    color varchar(30),
    car_km int,
    engine varchar(20)
);

create table if not exists user (
    id int not null auto_increment primary key,
    username varchar(100) unique,
    first_name varchar(100),
    last_name varchar(100),
    email varchar(100),
    pass varchar(100),
    country varchar(100),
    license varchar(10),
    user_type  varchar(10) default 'User',
    join_date timestamp
);

create table if not exists review (
    id int auto_increment not null primary key,
    score int,
    car_id int,
    user_id int,
    foreign key (car_id) references cars(id)
    on delete cascade,
    foreign key(user_id) references user(id)
    on delete cascade
);


create table post (
    id int auto_increment not null primary key,
    content text,
    date timestamp,
    user_id int,
    foreign key(user_id) references user(id)
);

create table if not exists rental (
    id int auto_increment not null primary key,
    start_date date,
    end_date date,
    car_id int,
    user_id int,
    foreign key (car_id) references cars(id)
    on delete cascade,
    foreign key (user_id) references user(id)
    on delete cascade
);


INSERT INTO `cars`(`manufacturer`, `car_name`, `car_year`, `color`, `car_km`, `engine`) VALUES
 ('Wartburg','Wartburg 353', 1988, 'Pink', 687920, 'Diesel'),
('Mercedes','A-Class',2016 ,'Silver', 89570, 'Petrol'),
('Mercedes', 'C-Class',2018 ,'Silver', 66987, 'Petrol'),
('Mercedes' ,'E-Class',2016 ,'Silver', 178524, 'Petrol'),
('Mercedes' ,'AMG GT',2019 ,'Matte Black', 55420, 'Petrol'),
('Mercedes','GLC',2015 ,'Black', 102458, 'Petrol'),
('Mercedes', 'S-Class',2018 ,'White', 12458, 'Petrol'),
('Audi','A4',2018 ,'White', 100200, 'Diesel'),
('Audi','A6',2018 ,'Red', 187458, 'Diesel'),
('Audi', 'A7',2018 ,'Gold', 99458, 'Petrol'),
('Peugeot', '308', 2016, 'Dark Grey', 99842, 'Diesel'),
('Peugeot', '3008', 2019, 'Dark Grey', 45278, 'Diesel'),
('Nissan', 'Juke', 2015, 'Grey', 157896, 'Diesel');





