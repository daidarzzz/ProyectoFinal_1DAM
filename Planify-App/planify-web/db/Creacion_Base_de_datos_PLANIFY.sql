CREATE DATABASE IF NOT EXISTS PLANIFY;
USE PLANIFY;

CREATE TABLE USUARIO (
    idUsuario INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(100) NOT NULL,
    contrasenia VARCHAR(20) NOT NULL,
    email VARCHAR(40) NOT NULL
);

CREATE TABLE USUARIO_PREMIUM (
    idUsuario INT PRIMARY KEY,
    pago DECIMAL(10,2) NOT NULL,
    FOREIGN KEY (idUsuario) REFERENCES USUARIO(idUsuario)
);

CREATE TABLE ANUNCIANTE (
    idUsuario INT PRIMARY KEY,
    empresa VARCHAR(60) NOT NULL,
    presupuesto DECIMAL(10,2) NOT NULL,
    FOREIGN KEY (idUsuario) REFERENCES USUARIO(idUsuario)
);

CREATE TABLE ANUNCIO (
    idAnuncio INT AUTO_INCREMENT PRIMARY KEY,
    titulo VARCHAR(50) NOT NULL,
    plantilla TINYINT NOT NULL,
    estado ENUM('Desplegado','En revision','Finalizado')
);

CREATE TABLE ANUNCIANTE_ANUNCIO (
    idUsuario INT,
    idAnuncio INT,
    PRIMARY KEY (idUsuario, idAnuncio),
    FOREIGN KEY (idUsuario) REFERENCES ANUNCIANTE(idUsuario),
    FOREIGN KEY (idAnuncio) REFERENCES ANUNCIO(idAnuncio)
);
CREATE TABLE PAIS (
    idPais INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR (100) NOT NULL UNIQUE
);

CREATE TABLE CIUDAD (
    idCiudad INT AUTO_INCREMENT PRIMARY KEY,
    idPais INT,
    nombre VARCHAR (100) NOT NULL,
    FOREIGN KEY (idPais) REFERENCES PAIS(idPais)
);
CREATE TABLE VIAJE (
    idViaje INT AUTO_INCREMENT PRIMARY KEY,
    idUsuario INT,
    fechaInicio DATE NOT NULL,
    fechaFin DATE NOT NULL,
    nombre VARCHAR (100) NOT NULL,
    estado ENUM('Finalizado','En curso', 'Pendiente'),
    idPais int NOT NULL,
    FOREIGN KEY (idPais) REFERENCES PAIS(idPais),
    FOREIGN KEY (idUsuario) REFERENCES USUARIO(idUsuario)
);




CREATE TABLE ACTIVIDAD (
    idActividad INT AUTO_INCREMENT PRIMARY KEY,
    idViaje INT,
    inicio DATE NOT NULL,
    fin DATE NULL,
    nombre VARCHAR (100) NOT NULL,
    descripcion VARCHAR (300) NULL,
    coste DECIMAL(10,2) NULL,
    FOREIGN KEY (idViaje) REFERENCES VIAJE(idViaje)
);
CREATE TABLE GRUPO_VIAJE (
    idViaje INT,
    idUsuario INT,
    estado ENUM ('Finalizado','En curso', 'Pendiente'),
    PRIMARY KEY (idViaje, idUsuario),
    FOREIGN KEY (idViaje) REFERENCES VIAJE(idViaje),
    FOREIGN KEY (idUsuario) REFERENCES USUARIO(idUsuario)
);

CREATE TABLE GRUPO_VIAJE_USUARIO (
    idViaje INT,
    idUsuario INT,
    idMiembro INT,
    FOREIGN KEY (idViaje, idUsuario) REFERENCES GRUPO_VIAJE(idViaje, idUsuario),
    FOREIGN KEY (idMiembro) REFERENCES USUARIO(idUsuario)
);