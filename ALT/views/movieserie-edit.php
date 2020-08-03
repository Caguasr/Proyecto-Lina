<?php 
$ms_controller = new MovieSeriesController();

if( $_POST['r'] == 'movieserie-edit' && $_SESSION['rol'] == 'Admin' && !isset($_POST['crud']) ) {

	$ms = $ms_controller->get($_POST['imdb_id']);

	if( empty($ms) ) {
		$template = '
			<div class="container">
				<p class="item  error">No existe la Película <b>%s</b></p>
			</div>
			<script>
				window.onload = function (){
					reloadPage("movieseries")
				}
			</script>
		';

		printf($template, $_POST['imdb_id']);
	} else {
		$category_movie = ($ms[0]['categoria'] == 'MOVIE') ? 'checked' : '';
		$category_serie = ($ms[0]['categoria'] == 'Serie') ? 'checked' : '';

		$status_controller = new StatusController();
		$status = $status_controller->get();
		$status_select = '';

		for ($n=0; $n < count($status); $n++) { 
			$selected = ($ms[0]['status_desc'] == $status[$n]['status_desc']) ? 'selected' : '';
			$status_select .= '<option value="' . $status[$n]['status_id'] . '"' . $selected . '>' . $status[$n]['status_desc'] . '</option>';
		}

		$template_ms = '
			<h2 class="p1">Editar MovieSerie</h2>
			<form method="POST" class="item">
				<div class="p_25">
					<input type="text" placeholder="imdb_id" value="%s" disabled required>
					<input type="hidden" name="imdb_id" value="%s">
				</div>
				<div class="p_25">
					<input type="text" name="title" placeholder="título" value="%s" required>
				</div>
				<div class="p_25">
					<textarea name="plot" cols="22" rows="10" placeholder="descripción">%s</textarea>
				</div>
				<div class="p_25">
					<input type="text" name="author" placeholder="autor" value="%s">
				</div>
				<div class="p_25">
					<input type="text" name="actors" placeholder="actores" value="%s">
				</div>
				<div class="p_25">
					<input type="text" name="premiere" placeholder="Año de estreno" value="%s" required>
				</div>
				<div class="p_25">
					<input type="url" name="poster" placeholder="Imagen" value="%s">
				</div>
				<div class="p_25">
					<input type="url" name="trailer" placeholder="trailer" value="%s">
				</div>
				<div class="p_25">
					<input type="number" name="rating" placeholder="rating" value="%s" required>
				</div>
				<div class="p_25">
					<select name="status" placeholder="status" required>
						<option value="">status</option>
						%s
					</select>
				</div>
				<div class="p_25">
					<input type="radio" name="category" id="movie" value="Movie" %s required><label for="movie">Movie</label>
					<input type="radio" name="category" id="serie" value="Serie" %s required><label for="serie">Serie</label>
				</div>
				<div class="p_25">
					<input  class="button  edit" type="submit" value="Editar">
					<input type="hidden" name="r" value="movieserie-edit">
					<input type="hidden" name="crud" value="set">
				</div>
			</form>
		';

		printf(
			$template_ms,
			$ms[0]['imdb_id'],
			$ms[0]['imdb_id'],
			$ms[0]['titulo'],
			$ms[0]['sinopsis'],
			$ms[0]['autor'],
			$ms[0]['actores'],
			$ms[0]['año'],
			$ms[0]['imagen'],
			$ms[0]['trailer'],
			$ms[0]['rating'],
			$status_select,
			$category_movie,
			$category_serie
		);	
	}

} else if( $_POST['r'] == 'movieserie-edit' && $_SESSION['rol'] == 'Admin' && $_POST['crud'] == 'set' ) {	

	$save_ms = array(
		'imdb_id' =>  $_POST['imdb_id'],
		'titulo' =>  $_POST['title'], 
		'sinopsis' =>  $_POST['plot'], 
		'autor' =>  $_POST['author'],
		'actores' =>  $_POST['actors'],
		'año' =>  $_POST['premiere'],
		'imagen' =>  $_POST['poster'],
		'trailer' =>  $_POST['trailer'],
		'rating' =>  $_POST['rating'],
		'statusstatus_id' =>  $_POST['status'],
		'categoria' =>  $_POST['category']
	);

	$ms = $ms_controller->set($save_ms);

	$template = '
		<div class="container">
			<p class="item  edit">Película <b>%s</b> salvada</p>
		</div>
		<script>
			window.onload = function () {
				reloadPage("movieseries")
			}
		</script>
	';

	printf($template, $_POST['title']);
} else {
	$controller = new ViewControllers();
	$controller->load_view('error401');
}