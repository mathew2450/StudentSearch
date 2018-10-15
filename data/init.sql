CREATE DATABASE test;

use test;

CREATE TABLE data (
	ID VARCHAR(11) PRIMARY KEY, 
	address TEXT NOT NULL,
	city VARCHAR(30) NOT NULL,
	county VARCHAR(30) NOT NULL,
	state VARCHAR(2),
	zip INT(5)
);

CREATE TABLE names (
	ID VARCHAR(11) PRIMARY KEY, 
	first_name TEXT NOT NULL,
	last_name VARCHAR(30) NOT NULL,
	DOB VARCHAR(11) NOT NULL
);