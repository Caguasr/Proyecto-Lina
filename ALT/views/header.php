
<?php
print('
<!DOCTYPE html>
<html lang="es">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta charset="UTF-8">
    <title>ALT PELIS</title>
    <meta name="description" content="Bienvenid@s a ALT tus películas favoritas">
    <link rel="shortcut icon" type="image/png" href="./public/img/alt.png">
    <link rel="stylesheet" href="./public/css/responsimple.min.css">
    <link rel="stylesheet" href="./public/css/alt.css">
    
    </head>
<body>
    <header class="container center header">
    <div class="item i-b v-middle ph12 lg2 lg-left">
        <h1 class="logo">ALT</h1>
    </div>
    ');
if ($_SESSION['ok']) {
    print('
    <nav class="item i-b v-middle php12 log10 lg-right menu">
        <ul class="container">
            <li class="nobullet item inline"><a href="./">Inicio</a></li>
            <li class="nobullet item inline"><a href="movieseries">Movies</a></li>
            <li class="nobullet item inline"><a href="users">Usuarios</a></li>
            <li class="nobullet item inline"><a href="status">Status</a></li>
            <li class="nobullet item inline"><a href="Generos">Géneros</a></li>
            <li class="nobullet item inline"><a href="links">links</a></li>
            <li class="nobullet item inline"><a href="salir">Salir</a></li>
        </ul>
    </nav>
    ');
}
print('
    </header>
    <main class="container  center  main">

');
