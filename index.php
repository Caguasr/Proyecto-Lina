<?php
require_once('./controllers/Autoload.php');
$autoload = new Autoload();
//pasa el parametro a router
$route = (isset($_GET['r'])) ? $_GET['r'] : 'home' ;
$alt = new Router($route);







echo 'perr'; 