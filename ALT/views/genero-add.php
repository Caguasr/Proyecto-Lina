<?php
if ($_POST['r'] == 'genero-add' && $_SESSION['rol'] == 'Admin' && !isset($_POST['crud'])) {
    print('
        <h2 class="p1">Agregar Genero</h2>
        <form method="POST" class="item">
            <div class="p_25">
                <input type="text" name="genero" placeholder="Genero" required>
            </div>
            <div class="p_25">
                <input class="button add" type="submit" value="Agregar">
                <input type="hidden" name="r" value="genero-add">
                <input type="hidden" name="crud" value="set">
            </div>
        </form>
    ');
} else if ($_POST['r'] == 'genero-add' && $_SESSION['rol'] == 'Admin' && $_POST['crud'] == 'set') {
    $genero_controller = new GenerosController();

    $new_genero = array(
        'id_genero' => 0,
        'nombre_genero' => $_POST['genero']
    );

    $genero = $genero_controller->set($new_genero);

    $template = '
        <div class="container">
            <p class="item  add">Género <b>%s</b> Salvado</p>
        </div>
        <script>
            window.onload = function (){
                reloadPage("generos")
            }
        </script>
    ';
    printf($template, $_POST['genero']);
} else {
    $controller = new ViewControllers();
    $controller->load_view('error401');
}
