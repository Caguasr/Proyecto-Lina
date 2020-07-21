<?php
if ($_POST['r'] == 'user-add' && $_SESSION['rol'] == 'Admin' && !isset($_POST['crud'])) {
    print('
        <h2 class="p1">Agregar Usuario</h2>
        <form method="POST" class="item">
            <div class="p_25">
                <input type="text" name="user" placeholder="usuario" required>
            </div>
            <div class="p_25">
            <input type="email" name="email" placeholder="email" required>
            </div>
            <div class="p_25">
            <input type="text" name="name" placeholder="nombre" required>
            </div>
            <div class="p_25">
            <input type="password" name="pass" placeholder="password" required>
            </div>
            <div class="p_25">
                <input type="radio"  name="role" id="admin" value="Admin" required><label for="admin">Administrador</label>
                <input type="radio"  name="role" id="noadmin" value="User" required><label for="noadmin">Usuario</label>
            </div>
            <div class="p_25">
                <input class="button  add" type="submit" value="Agregar">
                <input type="hidden" name="r" value="user-add">
                <input type="hidden" name="crud" value="set">
        </div>
        </form>
    ');
} else if ($_POST['r'] == 'user-add' && $_SESSION['rol'] == 'Admin' && $_POST['crud'] == 'set') {
    $users_controller = new UsersController();

    $new_user = array(
        'nombre_usuario' =>  $_POST['name'], 
		'usuario' =>  $_POST['user'], 
		'email' =>  $_POST['email'],
		'password' =>  $_POST['pass'], 
		'rol' =>  $_POST['role']
    );

    $user = $users_controller->set($new_user);

    $template = '
        <div class="container">
            <p class="item  add">Usuario <b>%s</b> Salvado</p>
        </div>
        <script>
            window.onload = function (){
                reloadPage("usuarios")
            }
        </script>
    ';
    printf($template, $_POST['user']);
} else {
    $controller = new ViewControllers();
    $controller->load_view('error401');
}