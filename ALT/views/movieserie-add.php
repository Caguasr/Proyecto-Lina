<?php
if ($_POST['r'] == 'movieserie-add' && $_SESSION['rol'] == 'Admin' && !isset($_POST['crud'])) {
    
    $status_controller = new StatusController();
    $status = $status_controller->get();
    $status_select = '';

    for ($n=0; $n <count($status) ; $n++) { 
        $status_select .= '<option value="' .$status[$n]['status_id'] . '">' .$status[$n]['status_desc'] . '</option>';
    }

    
    printf('
        <h2 class="p1">Agregar Películas</h2>
        <form method="POST" class="item">
            <div class="p_25">
                <input type="text" name="imdb_id" placeholder="imdb_id" required>
            </div>
            <div class="p_25">
                <input type="text" name="title" placeholder="Título" required>
            </div>
            <div class="p_25">
                <textarea name="plot" cols="22" rows="10" placeholder="descripción" ></textarea>
            </div>
            <div class="p_25">
                <input type="text" name="author" placeholder="Autor" required>
            </div>
            <div class="p_25">
                <input type="text" name="actors" placeholder="Actores">
            </div>
            <div class="p_25">
                <input type="text" name="premiere" placeholder="Año de estreno" required>
            </div>
            <div class="p_25">
                <input type="url" name="poster" placeholder="Imagen">
            </div>
            <div class="p_25">
                <input type="url" name="trailer" placeholder="trailer">
            </div>
            <div class="p_25">
                <input type="number" name="rating" placeholder="rating" required>
            </div>
            <div class="p_25">
                <select name="status_desc" placeholder="status_desc" required>
                <option value="">status</option>
                %s
                </select>
            </div>
            <div class="p_25">
                <input type="radio"  name="category" id="movie" value="Película" required><label for="movie">Película</label>
                <input type="radio"  name="category" id="serie" value="Serie" required><label for="serie">Serie</label>
            </div>
            <div class="p_25">
                <input class="button  add" type="submit" value="Agregar">
                <input type="hidden" name="r" value="movieserie-add">
                <input type="hidden" name="crud" value="set">
        </div>
        </form>
    ', $status_select );
} else if ($_POST['r'] == 'movieserie-add' && $_SESSION['rol'] == 'Admin' && $_POST['crud'] == 'set') {
    $ms_controller = new MovieSeriesModel();

    $new_ms = array(
        'imdb_id' =>  $_POST['imdb_id'],
        'titulo' =>  $_POST['title'],
        'sinopsis' =>  $_POST['plot'],
        'autor' =>  $_POST['author'],
        'actores' =>  $_POST['actors'],
        'año' =>  $_POST['premiere'],
        'imagen' =>  $_POST['poster'],
        'trailer' =>  $_POST['trailer'],
        'rating' =>  $_POST['rating'],
        'statusstatus_id' =>  $_POST['status_desc'],
        'categoria' =>  $_POST['category']
    );

    $ms = $ms_controller->set($new_ms);

    $template = '
        <div class="container">
            <p class="item  add">Película <b>%s</b> Salvado</p>
        </div>
        <script>
            window.onload = function (){
                //reloadPage("movieseries")
            }
        </script>
    ';
    printf($template, $_POST['title']);
} else {
    $controller = new ViewControllers();
    $controller->load_view('error401');
}