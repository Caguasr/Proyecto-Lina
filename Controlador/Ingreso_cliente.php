<?php

include '../Modelo/conexion.php';
$nombre=$_POST['nombre'];
$usuario=$_POST['usuario'];
$pass=$_POST['pass'];
$correo=$_POST['correo'];
$user="User";

$consulta="INSERT INTO `usuarios` (`id_usuario`, `nombre_usuario`, `usuario`, `password`, `email`, `role`) VALUES ('null', '$nombre', '$usuario', '$pass', '$correo','$user')";
$conexion->query($consulta);


