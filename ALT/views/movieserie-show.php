<?php
if ( $_POST['r'] == 'movieserie-show' && isset($_POST['imdb_id'])) {
    $ms_controller = new MovieSeriesController();

    $ms = $ms_controller->get($_POST['imdb_id']);
    if (empty($ms)) {
        printf('
            <div class="container">
                <p class="item error" Error al cargar la información de la Pelicula <b>%s</b></p>
            <div>
        ', $_POST['imdb:id']);
    }else {
        $template_ms = '
            <div class="item  movieserie-info">
                <h2 class="p_5">%s</h2>
                <p class="p_5">
                    <small class="block">( %s )</small>
                    <small class="block">%s</small>
                    <small class="block">%s</small>
                    <small class="block">%s</small>
                    <small class="block">%s</small>
                </p>
                <img class="p_5  poster" src="%s">
                <p class="p_5">Autor: <b>%s</b></p>
                <p class="p_5">Actores: <b>%s</b></p>
                <article class="p_5 ph7 mauto left">%s</article>
                <div class="p_5 trailer">
                    <iframe src="%s" frameborder="0" allowfullscreen></iframe>
                </div>
                <input class="p_5 button add" type="button" value="Regresar" onclick="history.back()">
            </div>
        ';
        $trailer = str_replace('watch?v=', 'embed/', $ms[0]['trailer']);

        printf(
            $template_ms,
            $ms[0]['titulo'],
            $ms[0]['imdb_id'],
            $ms[0]['status'],
            $ms[0]['categoria'],
            $ms[0]['año'],
            $ms[0]['rating'],
            $ms[0]['imagen'],
            $ms[0]['autor'],
            $ms[0]['actores'],
            $ms[0]['sinopsis'],
            $trailer       
        );
    }
}else {
    $controller = new ViewControllers();
	$controller->load_view('error404');
}