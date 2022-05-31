
<?php
$host="localhost";
$user="root";
$passwd="";
$enlace=mysqli_connect($host,$user,$passwd);
$bd="cabedi";

//CREAMOS LA BD
mysqli_query($enlace,"CREATE OR REPLACE DATABASE cabedi");
mysqli_select_db($enlace,$bd);

//CREAR TABLA USUARIOS
mysqli_query($enlace, "CREATE TABLE usuarios(
codigo INT(11) PRIMARY KEY AUTO_INCREMENT,
usuario VARCHAR(255),
pwd VARCHAR(255)
)");

//CREAR TABLA CENTROS
mysqli_query($enlace,"CREATE TABLE centros (codigo INT(11) PRIMARY KEY AUTO_INCREMENT,
direccion VARCHAR(255))");

//CREAR TABLA DEPARTAMENTOS
mysqli_query($enlace, "CREATE TABLE departamentos (codigo INT(11) PRIMARY KEY AUTO_INCREMENT,
nombre VARCHAR(255),
codigo_director INT(11),
codigo_centro INT(11),
FOREIGN KEY (codigo_centro) REFERENCES centros (codigo))
");

//CREAR TABLA EMPLEADOS
mysqli_query($enlace, "CREATE TABLE empleados (codigo INT(11) PRIMARY KEY AUTO_INCREMENT,
nombre VARCHAR(255),
apellidos VARCHAR(255),
correo VARCHAR(255),
fechaNac VARCHAR(255),
activo INT(2),
codigoDep INT(11),
FOREIGN KEY (codigoDep) REFERENCES departamentos (codigo))
");




//INSERTAR DATOS EN LAS TABLAS
mysqli_query($enlace, "INSERT INTO usuarios (usuario, pwd) VALUES ('javi', 'javi')");
mysqli_query($enlace, "INSERT INTO usuarios (usuario, pwd) VALUES ('pepe2000', 'pepe2000')");
mysqli_query($enlace, "INSERT INTO usuarios (usuario, pwd) VALUES ('carmen', 'carmen')");
mysqli_query($enlace, "INSERT INTO usuarios (usuario, pwd) VALUES ('proyecto', 'proyecto')");

mysqli_query($enlace, "INSERT INTO centros (direccion)  VALUES ('Calle Sevilla')");
mysqli_query($enlace, "INSERT INTO centros (direccion) VALUES ('Calle Aurora')");
mysqli_query($enlace, "INSERT INTO centros (direccion) VALUES ('Calle Andalucia')");
mysqli_query($enlace, "INSERT INTO centros (direccion) VALUES ('Calle Canela')");
mysqli_query($enlace, "INSERT INTO centros (direccion) VALUES ('Calle Marchena')");

mysqli_query($enlace, "INSERT INTO departamentos (nombre, codigo_director, codigo_centro) VALUES('Informática', '1', '1')");
mysqli_query($enlace, "INSERT INTO departamentos (nombre, codigo_director, codigo_centro) VALUES('Calidad', '2', '1')");
mysqli_query($enlace, "INSERT INTO departamentos (nombre, codigo_director, codigo_centro) VALUES('Diseño', '3', '2')");
mysqli_query($enlace, "INSERT INTO departamentos (nombre, codigo_director, codigo_centro) VALUES('Gestión', '4', '2')");

mysqli_query($enlace, "INSERT INTO empleados (nombre, apellidos, correo, fechaNac, activo, codigoDep) VALUES ('Javier', 'Cabello Diaz', 'jcabello@gmail.com', '04/10/1999', '1', '1')");
mysqli_query($enlace, "INSERT INTO empleados (nombre, apellidos, correo, fechaNac, activo, codigoDep) VALUES ('Manuel', 'Parrado Jiménez', 'mparrado@gmail.com', '12/04/2003', '1', '2')");
mysqli_query($enlace, "INSERT INTO empleados (nombre, apellidos, correo, fechaNac, activo, codigoDep) VALUES ('Juan', 'Angorrilla Nateras', 'jango@gmail.com', '26/07/1994', '1', '3')");
mysqli_query($enlace, "INSERT INTO empleados (nombre, apellidos, correo, fechaNac, activo, codigoDep) VALUES ('Rubén', 'Segura Martínez', 'rsegma@gmail.com', '19/05/1996', '1', '4')");
?>