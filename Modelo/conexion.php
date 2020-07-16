<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


$host = "localhost";
$nombre_db = "peliculas";
$usuario = "root";
$password_db = "";
$conexion = mysqli_connect($host, $usuario, $password_db);
if(mysqli_connect_errno()){
    echo "Fallo en la conexion a MYSQL";
    exit();
}
mysqli_select_db($conexion, $nombre_db)or die("No se encuentra la base de datos");
mysqli_set_charset($conexion, "UTF8");