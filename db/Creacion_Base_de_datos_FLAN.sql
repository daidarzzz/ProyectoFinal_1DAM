
Use PLANIFY
go

create table USUARIO (

idUsuario int identity Primary key,
nombre varchar (100) not null,
contraseña varchar(20) not null,
email varchar(40) not null,
check(contraseña like '%[A-Z]%' and contraseña like '%[0-9]%' and contraseña like '%[!@#$%^&*(),.?":{}|<>]%'),
check (email like '_%@_%._%' and email not like '% %' and email not like '%..%')

);

go

create table USUARIO_PREMIUM (

idUsuario int primary key,
pago money not null,
foreign key (idUsuario) references USUARIO(idUsuario),
check(pago > 0) 

);

go

create table ANUNCIANTE (

idUsuario int primary key,
empresa varchar(60) not null,
presupuesto money not null,
check (presupuesto > 0),
foreign key (idUsuario) references USUARIO(idUsuario)

);

go

create table ANUNCIO (

idAnuncio int identity primary key,
titulo varchar(50) not null,
plantilla tinyint not null,
estado char(11),
check (plantilla between 1 and 3),
check (estado in ('Desplegado','En revision','Finalizado'))

);

go

create table ANUNCIANTE_ANUNCIO (

idUsuario int,
idAnuncio int,
Primary key (idUsuario,idAnuncio),
foreign key (idUsuario) references Anunciante(idUsuario),
foreign key (idAnuncio) references Anuncio(idAnuncio)

);

go

create table VIAJE(

idVIaje int identity primary key,
idUsuario int,
fechaInicio date not null,
fechaFin date not null,
nombre varchar (50) not null,
estado char(10),
check (estado in ('Finalizado','En curso', 'Pendiente')),
check (fechaInicio < fechaFin),
check (fechaFin > fechaInicio),
foreign key (idUsuario) references USUARIO(idUsuario)

);

go

create table ACTIVIDAD (

idActividad int identity primary key,
idViaje int,
inicio date not null,
fin date null,
nombre varchar (100) not null,
descripcion varchar (300) null,
coste money null,
check (inicio < fin),
check (fin > inicio),
check (coste > 0),
foreign key (idViaje) references VIAJE(idViaje)

);

go

create table PAIS (

idPais int identity primary key,
nombre varchar (100)

);

go

create table CIUDAD (

idCiudad int identity primary key,
idPais int,
nombre varchar (100) not null,
foreign key (idPais) references PAIS(idPais)

);

go

create table GRUPO_VIAJE (

idViaje int,
idUsuario int,
estado char (10),
Primary key (idViaje, idUsuario),
foreign key (idViaje) references VIAJE(idViaje),
foreign key (idUsuario) references USUARIO(idUsuario),
check (estado in ('Finalizado','En curso', 'Pendiente'))


);

go

create table GRUPO_VIAJE_USUARIO (

idViaje int,
idUsuario int,
idMiembro int,
foreign key (idViaje, idUsuario) references GRUPO_VIAJE(idViaje,idUsuario),
foreign key (idMiembro) references USUARIO(idUsuario),

);



