<?php 
$genero_controller = new GenerosController();

if( $_POST['r'] == 'genero-edit' && $_SESSION['rol'] == 'Admin' && !isset($_POST['crud']) ) {

	$generos = $genero_controller->get($_POST['genero_id']);

	if( empty($generos) ) {
		$template = '
			<div class="container">
				<p class="item  error">No existe el genero_id <b>%s</b></p>
			</div>
			<script>
				window.onload = function (){
					reloadPage("generos")
				}
			</script>
		';

		printf($template, $_POST['genero_id']);
	} else {
		$template_genero = '
			<h2 class="p1">Editar Género</h2>
			<form method="POST" class="item">
				<div class="p_25">
					<input type="text" placeholder="genero_id" value="%s" disabled required>
					<input type="hidden" name="genero_id" value="%s">
				</div>
				<div class="p_25">
					<input type="text" name="nombre_genero" placeholder="Nombre genero" value="%s" required>
				</div>
				<div class="p_25">
					<input class="button edit" type="submit" value="Editar">
					<input type="hidden" name="r" value="genero-edit">
					<input type="hidden" name="crud" value="set">
				</div>
			</form>
		';

		printf(
			$template_genero,
			$generos[0]['id_genero'],
			$generos[0]['id_genero'],
			$generos[0]['nombre_genero']
		);	
	}

} else if( $_POST['r'] == 'genero-edit' && $_SESSION['rol'] == 'Admin' && $_POST['crud'] == 'set' ) {	

	$save_genero = array(
		'id_genero' => $_POST['genero_id'],
		'nombre_genero' => $_POST['nombre_genero']
	);

	$generos = $genero_controller->set($save_genero);

	$template = '
		<div class="container">
			<p class="item  edit">Género <b>%s</b> salvado</p>
		</div>
		<script>
			window.onload = function () {
				//reloadPage("generos")
			}
		</script>
	';

	printf($template, $_POST['nombre_genero']);
} else {
	$controller = new ViewControllers();
	$controller->load_view('error401');
}