DROP DATABASE bolsa_trabajo;
CREATE DATABASE IF NOT EXISTS bolsa_trabajo;
USE bolsa_trabajo;

CREATE TABLE InfEmpresa (
  ID_InfEmpresa int,
  NombreComercial varchar(50),
  RFC varchar(13),
  Pais varchar(30),
  Estado varchar(30),
  Ciudad varchar(40),
  Direccion varchar(100),
  GiroEmpresarial varchar(50),
  NoTrabajadores int(11),
  DescripcionEmpresa varchar(150),
  PaginaWeb varchar(50),
  LogoEmpresa varchar(50),
  ContactoNombre varchar(30),
  ContactoApellido varchar(30),
  ContactoCargo varchar(30),
  ContactoTelefono1 varchar(10),
  ContactoTelefono2 varchar(10)
)

CREATE TABLE TipoUsuario (
	ID_TipoUsuario int,
	Nombre_TipoUsuario varchar(50)
)

CREATE TABLE Curriculum (
	ID_Curriculum int
)

CREATE TABLE Categoria (
	ID_Categoria int,
	Nombre_Categoria varchar(100)
)

CREATE TABLE Lugar (
	ID_Lugar int,
	Nombre_Lugar varchar(100)
)

CREATE TABLE Vacantes (
	ID_Vacante int,
	Nombre_Vacante varchar(100),
	Descripcion_Vacante varchar(100),
	ID_Lugar int,
	ID_Categoria int,
	ID_Interesado int
)

CREATE TABLE Usuario (
	ID_Usuario int,
	NoTelefono varchar(10),
	Email varchar(60),
	Pass varchar(30),
	ID_TipoUsuario int,
	ID_Curriculum int,
	ID_InfEmpresa int
)

CREATE TABLE Interesados(
	ID_Interesado int,
	ID_Usuario int
)


ALTER TABLE 'InfEmpresa'
	ADD PRIMARY KEY ('ID_InfEmpresa');
COMMIT;
ALTER TABLE 'TipoUsuario'
	ADD PRIMARY KEY ('ID_TipoUsuario');
COMMIT;
ALTER TABLE 'Curriculum'
	ADD PRIMARY KEY ('ID_Curriculum');
COMMIT;
ALTER TABLE 'Categoria'
	ADD PRIMARY KEY ('ID_Categoria');
COMMIT;
ALTER TABLE 'Lugar'
	ADD PRIMARY KEY ('ID_Lugar');
COMMIT;
ALTER TABLE 'Vacantes'
	ADD PRIMARY KEY('ID_Vacante');
COMMIT;
ALTER TABLE 'Usuario'
	ADD PRIMARY KEY('ID_Usuario');
COMMIT;
ALTER TABLE 'Interesados'
	ADD PRIMARY KEY('ID_Interesado');
COMMIT;