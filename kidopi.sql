CREATE DATABASE Kidopi;

USE Kidopi;

CREATE TABLE acessos(
id_acesso int(4) auto_increment primary key,
data_acesso date,
hora_acesso time,
pais_acessado varchar(15)
);

