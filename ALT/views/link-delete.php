<?php 
$links_controller = new LinksController();

if( $_POST['r'] == 'link-delete' && $_SESSION['rol'] == 'Admin' && !isset($_POST['crud']) ) {

	$link = $links_controller->get($_POST['link_id']);

	if( empty($link) ) {
		$template = '
			<div class="container">
				<p class="item  error">No existe el ID del link <b>%s</b></p>
			</div>
			<script>
				window.onload = function (){
					reloadPage("links")
				}
			</script>
		';

		printf($template, $_POST['link_id']);
	} else {
		$template_link = '
			<h2 class="p1">Eliminar Link</h2>
			<form method="POST" class="item">
				<div class="1  f2">
                    ¿Estas seguro de eliminar el link: 
                    <mark class="p1">%s</mark>
				</div>
				<div class="p_25">
                    <input class="button  delete" type="submit" value="SI">
                    <input class="button  add" type="button" value="NO" onclick="history.back()">
                    <input type="hidden" name="link_id" value="%s">
                    <input type="hidden" name="r" value="link-delete">
                    <input type="hidden" name="crud" value="del">
				</div>
			</form>
		';

		printf(
			$template_link,
			$link[0]['id'],
			$link[0]['id']
		);	
	}

} else if( $_POST['r'] == 'link-delete' && $_SESSION['rol'] == 'Admin' && $_POST['crud'] == 'del' ) {	

	$link = $links_controller->del($_POST['link_id']);

	$template = '
		<div class="container">
			<p class="item  delete">Link <b>%s</b> eliminado</p>
		</div>
		<script>
			window.onload = function () {
				reloadPage("links")
			}
		</script>
	';

	printf($template, $_POST['link_id']);
} else {
	$controller = new ViewControllers();
	$controller->load_view('error401');
}