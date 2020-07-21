<?php
class UserModel extends Model{

    public function set($user_data = array()){
        foreach($user_data as $key => $value){
            //variable de variable
            //segun documentacion se puede usar al dato que tiene una variable y convertirla en una variable
            $$key = $value;
        }
        //el query viene desde Model
        $this->query = "REPLACE INTO usuarios (nombre_usuario, `usuario`, `password`, `email`, `rol`) VALUES('$nombre_usuario', '$usuario', MD5('$password'), '$email', '$rol')";
        $this->set_query();
    }

    public function get($usuario = ''){
        $this->query = ($usuario != '') 
        ?"SELECT * FROM usuarios WHERE usuario = '$usuario'" 
        :"SELECT * FROM usuarios " ;
        $this->get_query();

        //contar cuantos datos existe
        $num_rows = count($this->rows);
        $data = array();
        foreach ($this->rows as $key => $value){
            array_push($data, $value);
        }

        return $data;
    }

    public function del($usuario = ''){
        $this->query = "DELETE FROM usuarios WHERE usuario = '$usuario'";

        $this->set_query();
    }

    public function validate_user ($usuario, $password){
        $this->query = "SELECT * FROM usuarios WHERE usuario = '$usuario' AND password = MD5('$password')";
        $this->get_query();

        $data = array();

        foreach($this->rows as $key => $value){
            array_push($data, $value);
        }
        return $data;
    }

    public function __destruct(){
        //unset($this->$this);
    }
}   