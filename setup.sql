CREATE DATABASE IF NOT EXISTS classroomsystems;
USE classroomsystems;

DROP TABLE IF EXISTS userInfo;
DROP TABLE IF EXISTS studentInfo;
DROP TABLE IF EXISTS transHistory;

CREATE TABLE userInfo
(userInfoName char(50),
userName varchar(40),
userPassword varchar(40)
);

CREATE TABLE studentInfo
(studentInfoName varchar (40),
studentID int,
currency int
);

CREATE TABLE transHistory
(transactionHist datetime,
description varchar(500)
);

-- Inserting into Tables
INSERT INTO userInfo VALUES('Danny', 'Danny123', 'password2');
INSERT INTO userInfo VALUES('Benson', 'Benson123', 'pizza');
INSERT INTO userInfo VALUES('Bob', 'BoB123', 'lemonade');

INSERT INTO studentInfo VALUES('Jimmy', 1, 500);
INSERT INTO studentInfo VALUES('Karl', 2, 100);
INSERT INTO studentInfo VALUES('Ben', 3, 10);

