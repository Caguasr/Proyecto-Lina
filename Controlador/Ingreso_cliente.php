<?php

include '../Modelo/conexion.php';
$nombre=$_POST['nombre'];
$usuario=$_POST['usuario'];
$pass=$_POST['pass'];
$correo=$_POST['correo'];

$consulta="INSERT INTO `usuarios` (`id_usuario`, `nombre_usuario`, `usuario`, `password`, `email`) VALUES ('null', '$nombre', '$usuario', '$pass', '$correo')";
$conexion->query($consulta);


