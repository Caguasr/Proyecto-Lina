<?php
class UserModel extends Model{

    public function set($user_data = array()){
        foreach($user_data as $key => $value){
            //variable de variable
            //segun documentacion se puede usar al dato que tiene una variable y convertirla en una variable
            $$key = $value;
        }
        //el query viene desde Model
        $this->query = "REPLACE INTO users (id, name, `email`, `password`) VALUES(null, '$name', '$email', MD5('$password'))";
       // $this->query = "REPLACE INTO users (id, `name`, `password`, `email`, `nombre_usuario`, `rol`) VALUES(null, '$name',  MD5('$password'), '$email', '$nombre_usuario', '$rol')";
        $this->set_query();
    }

    public function get($usuario = ''){
        $this->query = ($usuario != '') 
        ?"SELECT * FROM users WHERE `name` = '$usuario'" 
        :"SELECT * FROM users " ;
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
        $this->query = "DELETE FROM users WHERE `name` = '$usuario'";

        $this->set_query();
    }

    public function validate_user ($usuario, $password){
        $this->query = "SELECT * FROM users WHERE name = '$usuario' AND password = MD5('$password')";
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