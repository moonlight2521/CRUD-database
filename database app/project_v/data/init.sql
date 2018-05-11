
CREATE DATABASE test;

use test;

CREATE TABLE users (
	id INT(11) UNSIGNED AUTO_INCREMENT PRIMARY KEY, 
	firstname VARCHAR(30) NOT NULL,
	lastname VARCHAR(30) NOT NULL,
	email VARCHAR(50) NOT NULL,
	age INT(3),
	health_issues VARCHAR(50),
	date TIMESTAMP
);

create table food(
	FoodName varchar(30) primary key not null,
	FoodType varchar(30)  not null,
	Seasons varchar(30),
    Cost decimal (9,2)  not null,
    Storage varchar(30) not null
);

create table vitamin(
	vitamin_id INT(11) UNSIGNED AUTO_INCREMENT PRIMARY KEY, 
    FoodName varchar(30)  not null,
	foreign key (FoodName) references food(FoodName),
	VitaminName varchar(30) not null,
	amount DECIMAL(5,0) not null
);

create table mineral(
	mineral_id INT(11) UNSIGNED AUTO_INCREMENT PRIMARY KEY, 
    FoodName varchar(30) not null,
	foreign key (FoodName) references food(FoodName),
	MineralName varchar(30) not null,
	amount DECIMAL(5,0) not null
);

create table macronutrient(
	macro_id INT(11) UNSIGNED AUTO_INCREMENT PRIMARY KEY, 
    FoodName varchar(30) not null,
	foreign key (FoodName) references food(FoodName),
	MacroName varchar(30) not null,
	amount DECIMAL(5,0) not null
);

create table aminoAcid(
	amino_id INT(11) UNSIGNED AUTO_INCREMENT PRIMARY KEY, 
    FoodName varchar(30) not null,
	foreign key (FoodName) references food(FoodName),
	AminoName varchar(30) not null,
	amount DECIMAL(5,0) not null
);

-- drop table vitamin;
-- drop table mineral;
-- drop table macronutrient;
-- drop table aminoAcid;
-- drop table food;