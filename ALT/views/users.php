<?php 
print('<h2 class="p1">GESTIÓN DE USUARIOS</h2>');

$users_controller = new UsersController();
$users = $users_controller->get();

if( empty($users) ) {
	print( '
		<div class="container">
			<p class="item  error">No hay Usuarios</p>
		</div>
	');
} else {
	$template_users = '
	<div class="item">
		<table>
			<tr>
				<th>Nombre</th>
				<th>Usuario</th>
				<th>Contraseña</th>
				<th>Email</th>
				<th>Rol</th>
				<th colspan="2">
					<form method="POST">
						<input type="hidden" name="r" value="user-add">
						<input class="button  add" type="submit" value="Agregar">
					</form>
				</th>
			</tr>';

	for ($n=0; $n < count($users); $n++) { 
		$template_users .= '
			<tr>
				<td>' . $users[$n]['nombre_usuario'] . '</td>
				<td>' . $users[$n]['name'] . '</td>
				<td>' . $users[$n]['password'] . '</td>
				<td>' . $users[$n]['email'] . '</td>
				<td>' . $users[$n]['rol'] . '</td>
				<td>
					<form method="POST">
						<input type="hidden" name="r" value="user-edit">
						<input type="hidden" name="user" value="' . $users[$n]['name'] . '">
						<input class="button  edit" type="submit" value="Editar">
					</form>
				</td>
				<td>
					<form method="POST">
						<input type="hidden" name="r" value="user-delete">
						<input type="hidden" name="user" value="' . $users[$n]['name'] . '">
						<input class="button  delete" type="submit" value="Eliminar">
					</form>
				</td>
			</tr>
		'; 
	}

	$template_users .= '
		</table>
	</div>
	';

	print($template_users);
}