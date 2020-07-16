<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
        <link href="../css/registro.css" rel="stylesheet" type="text/css"/>
    </head>
    <body>
        <form action="../Controlador/Ingreso_cliente.php" method="Post">
            <div class="contenedor">
                
            
    <table>
        <tr><td></td><td><h1>REGISTRO USUARIO</h1></td></tr>
        <tr><td><p>Nombre:</p></td><td><input type="text" id="text" name="nombre"></td></tr>
        <tr><td><p>Correo:</p></td><td><input type="text" id="text" name="correo"></td></tr>
        <tr><td><p>Usuario:</p></td><td><input type="text" id="text" name="usuario"></td></tr>
        <tr><td><p>Contraseña:</p></td><td><input type="text" id="text" name="pass"></td></tr>
        <tr><td></td><td><input type="submit"  name="registrar" id="btn" value="Registrarse"><input type="submit" id="btn" name="cancelar" value="Cancelar"></tr>
        
        </table>
                </div>
            </form>
    </body>
</html>
