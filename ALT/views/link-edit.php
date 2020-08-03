<?php 
$links_controller = new LinksController();

if( $_POST['r'] == 'link-edit' && $_SESSION['rol'] == 'Admin' && !isset($_POST['crud']) ) {
	
	$link = $links_controller->get($_POST['link_id']);
	
	if(empty($link)) {
		
		$template = '
			<div class="container">
				<p class="item  error">No existe el Link <b>%s</b></p>
			</div>
			<script>
				window.onload = function (){
					reloadPage("links")
				}
			</script>
		';

		printf($template, $_POST['link_id']);
		
	} else {

		///consulta
		//https://powv1deo.cc/9opiytoxsn4k
	$ms_controller = new MovieSeriesController();
	$ms = $ms_controller->get();
	
	$link2 = $links_controller->get($_POST['link_id']);
    $link_select = '';

    for ($n=0; $n < count($ms); $n++) {
		$selected = ($_POST['link_id'] == $ms[$n]['imdb_id']) ? 'selected' : ''; 
		$link_select .= '<option value="' . $ms[$n]['imdb_id'] . '"' . $selected . '>' . $ms[$n]['titulo'] . '</option>';
		
		//$selected = ($ms[0]['status'] == $status[$n]['status']) ? 'selected' : '';
		//$status_select .= '<option value="' . $status[$n]['status_id'] . '"' . $selected . '>' . $status[$n]['status'] . '</option>';
    }
	//fin consulta

		$template_link = '
			<h2 class="p1">Editar Link</h2>
			<form method="POST" class="item">
				<div class="p_25">
					<input type="text" placeholder="link_id" value="%s" disabled required>
					<input type="hidden" name="link_id" value="%s">
				</div>
				<div class="p_25">
					<input type="url" name="link" placeholder="link" value="%s" required>
				</div>
				<div class="p_25">
					<select name="imdb_id" placeholder="imdb_id" required>
						<option value="">Titulo</option>
						%s
					</select>
				</div>
				<div class="p_25">
					<input class="button edit" type="submit" value="Editar">
					<input type="hidden" name="r" value="link-edit">
					<input type="hidden" name="crud" value="set">
				</div>
			</form>
		';

		printf(
			$template_link,
			$link[0]['id'],
			$link[0]['id'],
			$link[0]['link'],
			$link_select
		);	
	}

} else if( $_POST['r'] == 'link-edit' && $_SESSION['rol'] == 'Admin' && $_POST['crud'] == 'set' ) {	

	$save_link = array(
		'id' => $_POST['link_id'],
		'link' => $_POST['link'],
		'movie_id' => $_POST['imdb_id']
	);

	$link = $links_controller->set($save_link);

	$template = '
		<div class="container">
			<p class="item  edit">Link <b>%s</b> salvado</p>
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