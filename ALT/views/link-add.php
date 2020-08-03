<?php
if ($_POST['r'] == 'link-add' && $_SESSION['rol'] == 'Admin' && !isset($_POST['crud'])) {
    $ms_controller = new MovieSeriesController();
    $ms = $ms_controller->get();

    $link_controller = new LinksController();
    $link = $link_controller->get();


    $ms_select = '';

    for ($n=0; $n < count($ms); $n++) { 
        $ms_select .= '<option value="' . $ms[$n]['imdb_id'] . '">' . $ms[$n]['titulo'] . '</option>';
    }
    printf('
        <h2 class="p1">Agregar Links</h2>
        <form method="POST" class="item">
            <div class="p_25">
                <input type="url" name="link" placeholder="Link" required>
            </div>
            <div class="p_25">
            <select name="imdb_id" placeholder="imdb_id" required>
                <option value="">Película</option>
                %s
            </select>
            </div>
            <div class="p_25">
                <input class="button add" type="submit" value="Agregar">
                <input type="hidden" name="r" value="link-add">
                <input type="hidden" name="crud" value="set">
            </div>
        </form>
    ',$ms_select);
} else if ($_POST['r'] == 'link-add' && $_SESSION['rol'] == 'Admin' && $_POST['crud'] == 'set') {
    $links_controller = new LinksController();

    $new_link = array(
        'id' => 0,
        'link' => $_POST['link'],
        'movie_id' => $_POST['imdb_id']
    );

    $link = $links_controller->set($new_link);

    $template = '
        <div class="container">
            <p class="item  add">Links <b>%s</b> Salvado</p>
        </div>
        <script>
            window.onload = function (){
                reloadPage("links")
            }
        </script>
    ';
    printf($template, $_POST['imdb_id']);
} else {
    $controller = new ViewControllers();
    $controller->load_view('error401');
}
///Preguntas
// Como o cual sería la recomendación para el cambio de paradigma para las personas o una cultura que no estan familiarizados con la tecnologia y animarlos a optar por un e-comerce