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
        //INSERT INTO `links`(`id`, `link`, `movie_id`) VALUES ([value-1],[value-2],[value-3])
        $this->query = "REPLACE INTO links(id, link, movie_id) VALUES($id, '$link', '$movie_id')";
        $this->set_query();
    }

    public function get($id = '')
    {
        $this->query = ($id != '')
            ? "SELECT ls.id, ls.link, ls.movie_id, ms.titulo, ms.imdb_id FROM links AS ls INNER JOIN peliculas AS ms ON ls.movie_id = ms.imdb_id WHERE ls.movie_id = '$id' ORDER BY id"
            : "SELECT ls.id, ls.link, ls.movie_id, ms.titulo, ms.imdb_id FROM links AS ls INNER JOIN peliculas AS ms ON ls.movie_id = ms.imdb_id ORDER BY id";
        $this->get_query();

        //contar cuantos datos existe
        $num_rows = count($this->rows);
        $data = array();
        foreach ($this->rows as $key => $value) {
            array_push($data, $value);
        }

        return $data;
    }

    public function del($id = '')
    {
        $this->query = "DELETE FROM links WHERE id= $id";

        $this->set_query();
    }

    public function __destruct()
    {
        //unset($this->$this);
    }
}
