-- Name: Danny Galan
-- Desc. Final Project - Classroom Reward System 
DROP TABLE IF EXISTS userInfo;

CREATE TABLE userInfo(
    name varchar(50),
    userName varchar(40),
    password varchar(40)
);

CREATE TABLE studentInfo(
    name varchar (40),
    studentID int,
    currency int
);

CREATE TABLE transHistory(
    transaction datetime,
    description varchar(500)
);

-- Inserting into Tables
INSERT INTO userInfo VALUES(Danny, Danny123, password);




