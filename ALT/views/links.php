<?php
print('<h2 class="p1">Gestion de Links ALT</h2>');
$links_controller = new LinksController();
$links = $links_controller->get();
if(empty($links)){
    print('
        <div class="container">
            <p class="item error"> No hay Links</p>
        </div>
    ');
}else{
    $template_links = '
    <div class="item">
        <table>
            <tr>
                <th>Id</th>
                <th>links</th>
                <th>Película</th>
                <th colspan=2>
                    <form method="POST">
                        <input type="hidden" name="r" value="link-add">
                        <input class"button add" type="submit" value="Agregar">
                    </form>
                </th>
            </tr>';
    for ($n=0; $n < count($links); $n++) { 
        
        $template_links .= '
            <tr>
                <td>' . $links[$n]['id'] . '</td>
                <td>' . $links[$n]['link'] . '</td>
                <td>' . $links[$n]['titulo'] . '</td>
                
                <td>
                    <form method="POST">
                        <input type="hidden" name="r" value="link-edit">
                        <input type="hidden" name="link_id" value="'. $links[$n]['movie_id'] .'">
                        <input class="button  edit" type="submit" value="Editar">
                    </form>
                </td>
                <td>
                    <form method="POST">
                        <input type="hidden" name="r" value="link-delete">
                        <input type="hidden" name="link_id" value="'. $links[$n]['movie_id'] .'">
                        <input class="button delete" type="submit" value="Eliminar">
                    </form>
                </td>
            </tr>
        ';
    }

    $template_links .='
        </table>
    </div>
    ';

    print($template_links);
}
?>