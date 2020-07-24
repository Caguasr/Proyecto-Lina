<?php
class GenerosModel extends Model
{

    public function set($generos_data = array())
    {
        foreach ($generos_data as $key => $value) {
            //variable de variable
            //segun documentacion se puede usar al dato que tiene una variable y convertirla en una variable
            $$key = $value;
        }
        //el query viene desde Model
        $this->query = "REPLACE INTO genero(id_genero, nombre_genero) VALUES($id_genero, '$nombre_genero')";
        $this->set_query();
    }

    public function get($id_genero = '')
    {
        $this->query = ($id_genero != '')
            ? "SELECT * FROM genero WHERE id_genero = $id_genero"
            : "SELECT * FROM genero ";
        $this->get_query();

        //contar cuantos datos existe
        $num_rows = count($this->rows);
        $data = array();
        foreach ($this->rows as $key => $value) {
            array_push($data, $value);
        }

        return $data;
    }

    public function del($id_genero = '')
    {
        $this->query = "DELETE FROM genero WHERE id_genero= $id_genero";

        $this->set_query();
    }

    public function __destruct()
    {
        //unset($this->$this);
    }
}
