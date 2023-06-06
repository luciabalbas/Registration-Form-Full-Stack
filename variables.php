<?php
// Práctica Laboratorio - Lucía Balbás

// Obtener los datos del formulario
$name = $_POST["name"];
$surname1 = $_POST["surname1"];
$surname2 = $_POST["surname2"];
$email = $_POST["email"];
$login = $_POST["login"];
$password = $_POST["password"];


// Valores BBDD
$host = "localhost";
$user = "root";
$passw = "";
$bbdd = "laboratorio";

// Array de Errores
$errores = [];

// Seleccion de Email - Si el email existe
$emailLookUp = "SELECT * FROM usuarios WHERE Email = '$email'";

// Introducir Valores en BBDD
$query = "INSERT INTO `usuarios` (`Nombre`, `Apellido1`, `Apellido2`, `Email`, `Usuario`, `Contraseña`) 
VALUES ('$name', '$surname1', '$surname2', '$email', '$login', '$password')";

// Selección de todos los datos de la BBDD
$datos = 'SELECT * FROM usuarios';
?>