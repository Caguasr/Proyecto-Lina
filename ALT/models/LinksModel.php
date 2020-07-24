<?php
class LinksModel extends Model
{

    public function set($links_data = array())
    {
        foreach ($links_data as $key => $value) {
            //variable de variable
            //segun documentacion se puede usar al dato que tiene una variable y convertirla en una variable
            //SELECT ls.link, ms.titulo FROM links AS ls INNER JOIN peliculas AS ms ON ls.peliculasimdb_id = ms.imdb_id WHERE ls.peliculasimdb_id = 'tt7286456'
            $$key = $value;
        }
        //el query viene desde Model
        $this->query = "REPLACE INTO links(id_link, link, peliculasimdb_id) VALUES($id_link, '$link', '$peliculasimdb_id')";
        $this->set_query();
    }

    public function get($id_link = '')
    {
        $this->query = ($id_link != '')
            ? "SELECT ls.id_link, ls.link, ls.peliculasimdb_id, ms.titulo, ms.imdb_id FROM links AS ls INNER JOIN peliculas AS ms ON ls.peliculasimdb_id = ms.imdb_id WHERE ls.peliculasimdb_id = '$id_link' ORDER BY id_link"
            : "SELECT ls.id_link, ls.link, ls.peliculasimdb_id, ms.titulo, ms.imdb_id FROM links AS ls INNER JOIN peliculas AS ms ON ls.peliculasimdb_id = ms.imdb_id ORDER BY id_link";
        $this->get_query();

        //contar cuantos datos existe
        $num_rows = count($this->rows);
        $data = array();
        foreach ($this->rows as $key => $value) {
            array_push($data, $value);
        }

        return $data;
    }

    public function del($id_link = '')
    {
        $this->query = "DELETE FROM links WHERE id_link= $id_link";

        $this->set_query();
    }

    public function __destruct()
    {
        //unset($this->$this);
    }
}
