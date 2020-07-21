<?php
class MovieSeriesModel extends Model
{

    public function set($ms_data = array())
    {
        foreach ($ms_data as $key => $value) {
            //variable de variable
            //segun documentacion se puede usar al dato que tiene una variable y convertirla en una variable
            $$key = $value;
        }

        $sinopsis = str_replace("'", "\'", $sinopsis);

        
        //el query viene desde Model
        $this->query = "REPLACE INTO peliculas SET imdb_id = '$imdb_id', titulo='$titulo', sinopsis = '$sinopsis', `año`='$año', imagen='$imagen', trailer = '$trailer', actores = '$actores', autor = '$autor', rating = $rating, categoria = '$categoria', statusstatus_id = $statusstatus_id";

        $this->set_query();
    }

    public function get($ms = '')
    {
        $this->query = ($ms != '')
            ? "SELECT ms.imdb_id, ms.titulo, ms.sinopsis, ms.año, ms.imagen, ms.trailer, ms.actores, ms.autor, ms.rating, ms.categoria, s.status FROM peliculas AS ms INNER JOIN status AS s ON ms.statusstatus_id = s.status_id WHERE ms.imdb_id = '$ms'"
            : "SELECT ms.imdb_id, ms.titulo, ms.sinopsis, ms.año, ms.imagen, ms.trailer, ms.actores, ms.autor, ms.rating, ms.categoria, s.status FROM peliculas AS ms INNER JOIN status AS s ON ms.statusstatus_id = s.status_id";
        $this->get_query();

        //contar cuantos datos existe
        $num_rows = count($this->rows);
        $data = array();
        foreach ($this->rows as $key => $value) {
            array_push($data, $value);
        }

        return $data;
    }

    public function del($ms = '')
    {
        $this->query = "DELETE FROM peliculas WHERE imdb_id= '$ms'";

        $this->set_query();
    }

    public function __destruct()
    {
        //unset($this->$this);
    }
}
