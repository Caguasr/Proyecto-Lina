<?php
print('<h2 class="p1">Gestion de Generos ALT</h2>');
$generos_controller = new GenerosController();
$generos = $generos_controller->get();
if(empty($generos)){
    print('
        <div class="container">
            <p class="item error"> No hay Generos</p>
        </div>
    ');
}else{
    $template_generos= '
    <div class="item">
        <table>
            <tr>
                <th>Id</th>
                <th>Generos</th>
                <th colspan=2>
                    <form method="POST">
                        <input type="hidden" name="r" value="genero-add">
                        <input class"button add" type="submit" value="Agregar">
                    </form>
                </th>
            </tr>';
    for ($n=0; $n < count($generos); $n++) { 
        $template_generos .= '
            <tr>
                <td>' . $generos[$n]['id_genero'] . '</td>
                <td>' . $generos[$n]['nombre_genero'] . '</td>
                <td>
                    <form method="POST">
                        <input type="hidden" name="r" value="genero-edit">
                        <input type="hidden" name="genero_id" value="'. $generos[$n]['id_genero'] .'">
                        <input class="button  edit" type="submit" value="Editar">
                    </form>
                </td>
                <td>
                    <form method="POST">
                        <input type="hidden" name="r" value="genero-delete">
                        <input type="hidden" name="genero_id" value="'. $generos[$n]['id_genero'] .'">
                        <input class="button delete" type="submit" value="Eliminar">
                    </form>
                </td>
            </tr>
        ';
    }

    $template_generos .='
        </table>
    </div>
    ';

    print($template_generos);
}
?>