<?php 
$users_controller = new UsersController();

if( $_POST['r'] == 'user-edit' && $_SESSION['rol'] == 'Admin' && !isset($_POST['crud']) ) {

	$user = $users_controller->get($_POST['user']);

	if( empty($user) ) {
		$template = '
			<div class="container">
				<p class="item  error">No existe el usuario <b>%s</b></p>
			</div>
			<script>
				window.onload = function (){
					reloadPage("usuarios")
				}
			</script>
		';

		printf($template, $_POST['user']);
	} else {
		$role_admin = ($user[0]['rol'] == 'Admin') ? 'checked' : '';
		$role_user = ($user[0]['rol'] == 'User') ? 'checked' : '';

		$template_user = '
			<h2 class="p1">Editar Usuario</h2>
			<form method="POST" class="item">
				<div class="p_25">
					<input type="text" placeholder="usuario" value="%s" disabled required>
					<input type="hidden" name="user" value="%s">
				</div>
				<div class="p_25">
					<input type="email" name="email" placeholder="email" value="%s" required>
				</div>
				<div class="p_25">
					<input type="text" name="name" placeholder="nombre" value="%s" required>
				</div>
				<div class="p_25">
					<input type="password" name="pass" placeholder="password" value="" required>
				</div>
				<div class="p_25">
					<input type="radio" name="role" id="admin" value="Admin" %s required><label for="admin">Administrador</label>
					<input type="radio" name="role" id="noadmin" value="User" %s required><label for="noadmin">Usuario</label>
				</div>
				<div class="p_25">
					<input  class="button  edit" type="submit" value="Editar">
					<input type="hidden" name="r" value="user-edit">
					<input type="hidden" name="crud" value="set">
				</div>
			</form>
		';

		printf(
			$template_user,
			$user[0]['usuario'],
			$user[0]['nombre_usuario'],
			$user[0]['email'],
			$user[0]['nombre_usuario'],
			//$user[0]['pass'],
			$role_admin,
			$role_user
		);	
	}

} else if( $_POST['r'] == 'user-edit' && $_SESSION['rol'] == 'Admin' && $_POST['crud'] == 'set' ) {	

	$save_user = array(
		'nombre_usuario' =>  $_POST['name'], 
		'usuario' =>  $_POST['user'], 
		'email' =>  $_POST['email'],
		'password' =>  $_POST['pass'], 
		'rol' =>  $_POST['role']

	);

	$user = $users_controller->set($save_user);

	$template = '
		<div class="container">
			<p class="item  edit">Usuario <b>%s</b> salvado</p>
		</div>
		<script>
			window.onload = function () {
				//reloadPage("usuarios")
			}
		</script>
	';

	printf($template, $_POST['user']);
} else {
	$controller = new ViewControllers();
	$controller->load_view('error401');
}