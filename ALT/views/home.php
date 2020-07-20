<?php
$template = '
<article class="item">
    <h2 class="p1"> Hola %s, Bienvenid@ a ALT </h2>
    <h3 class="p1"> Tus Películas y series favoritas </h3>
    <p class="p1  f1_25"> Tu nombre es <b>%s</b></p>
    <p class="p1  f1_25"> Tu email es  <b>%s</b></p>
    <p class="p1  f1_25"> Tu perfil de usuario tiene nivel de <b>%s</b></p>
</article>
';
printf(
    $template,
    $_SESSION['usuario'],
    $_SESSION['nombre_usuario'],
    $_SESSION['email'],
    $_SESSION['rol']
);
?>