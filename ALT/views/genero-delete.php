<?php 
$generos_controller = new GenerosController();

if( $_POST['r'] == 'genero-delete' && $_SESSION['rol'] == 'Admin' && !isset($_POST['crud']) ) {

	$genero = $generos_controller->get($_POST['genero_id']);

	if( empty($genero) ) {
		$template = '
			<div class="container">
				<p class="item  error">No existe el el genero <b>%s</b></p>
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
			<h2 class="p1">Eliminar Género</h2>
			<form method="POST" class="item">
				<div class="1  f2">
                    ¿Estas seguro de eliminar el Género: 
                    <mark class="p1">%s</mark>
				</div>
				<div class="p_25">
                    <input class="button  delete" type="submit" value="SI">
                    <input class="button  add" type="button" value="NO" onclick="history.back()">
                    <input type="hidden" name="genero_id" value="%s">
                    <input type="hidden" name="r" value="genero-delete">
                    <input type="hidden" name="crud" value="del">
				</div>
			</form>
		';

		printf(
			$template_genero,
			$genero[0]['nombre_genero'],
			$genero[0]['id_genero']
		);	
	}

} else if( $_POST['r'] == 'genero-delete' && $_SESSION['rol'] == 'Admin' && $_POST['crud'] == 'del' ) {	

	$genero = $generos_controller->del($_POST['genero_id']);

	$template = '
		<div class="container">
			<p class="item  delete">Género <b>%s</b> eliminado</p>
		</div>
		<script>
			window.onload = function () {
				reloadPage("generos")
			}
		</script>
	';

	printf($template, $_POST['genero_id']);
} else {
	$controller = new ViewControllers();
	$controller->load_view('error401');
}