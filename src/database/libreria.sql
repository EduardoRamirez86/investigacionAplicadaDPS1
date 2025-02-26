CREATE DATABASE libreria;

USE libreria;

CREATE TABLE libro(
    ID INT PRIMARY KEY AUTO_INCREMENT,
    nombreLibro VARCHAR(50),
    autor VARCHAR(50),
    editorial VARCHAR(50),
    edicion VARCHAR(10)
);


CREATE TABLE rol(
    IDrol INT PRIMARY KEY AUTO_INCREMENT,
    nombreRol VARCHAR(20)
);

CREATE TABLE usuario(
    IDusuario INT PRIMARY KEY AUTO_INCREMENT,
    nombreUsuario VARCHAR(50),
    apellidoUsuario VARCHAR(50),
    contrasennia VARCHAR(100),
    IDrol INT,
    CONSTRAINT usuarioRol FOREIGN KEY (IDrol) REFERENCES rol(IDrol)
);


