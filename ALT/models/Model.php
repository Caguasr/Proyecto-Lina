<?php
abstract class Model {

    //Atributos
    private static $db_host = 'localhost';
    private static $db_user = 'root';
    private static $db_pass = '';
    private static $db_name = 'atl';
    private static $db_charset = 'utf8';
    // variable para la conexion
    private $conn;
    //variable para ejecutar consultas
    protected $query;
    // variable para guardar las consultas en un tipo arreglo
    protected $rows = array();

    //Metodos abstractos para CRUD
    abstract protected function set();
    abstract protected function get();
    abstract protected function del();

    private function db_open(){
        //creamos un objeto de tipo conexion (conn) para guardar en una array
        $this->conn = new mysqli(
            self::$db_host,
            self::$db_user,
            self::$db_pass,
            self::$db_name
        );

        $this->conn->set_charset(self::$db_charset);
    }

    private function db_close(){
        $this->conn->close();
    }

    //establecer un query simple que afecte datos del tipo INSERT, DELETE, UPDATE
    protected function set_query(){
        $this->db_open();
        //el this->query es lo que se va a ejecutar en las clases hijas
        $this->conn->query($this->query);
        $this->db_close();
    }

    //traer resultados de una consulta de tipo select en un array
    protected function get_query(){
        $this->db_open();

        $result = $this->conn->query($this->query);
        while( $this->rows[] = $result->fetch_assoc() );
        $result->close();

        $this->db_close();
        //retorno el valor guardado en rows
        return array_pop($this->rows);
    }

}

?>