drop database IF EXISTS examensarbete;
create database examensarbete character set UTF8 collate utf8_bin;
use examensarbete;

create table airlines (
	airline_id int auto_increment PRIMARY KEY,
    name varchar(255),
    alias varchar(255),
    iata varchar(255),
    icao varchar(255),
    callsign varchar(255),
    country varchar(255),
    active char(1)
) DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

create table airplanes (
    name varchar(255) PRIMARY KEY,
    iata_code varchar(255),
    icao_code varchar(255)
) DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

create table airports (
	airport_id int auto_increment PRIMARY KEY,
    name varchar(255) COLLATE utf8mb4_bin,
    city varchar(255),
    country varchar(255),
    iata varchar(255),
    icao varchar(255),
    latitude double,
    longitude double,
    altitude int,
    timezone varchar(255),
    dst varchar(255),
    tz_database_time_zone varchar(255),
    type varchar(255),
    source varchar(255),
    location varchar(255)
) DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;