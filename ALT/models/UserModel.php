<?php
class UserModel extends Model{

    public function set($user_data = array()){
        foreach($user_data as $key => $value){
            //variable de variable
            //segun documentacion se puede usar al dato que tiene una variable y convertirla en una variable
            $$key = $value;
        }
        //el query viene desde Model
        $this->query = "REPLACE INTO users (user, email, `name`, birthday, pass, `role`) VALUES('$user', '$email', '$name', '$birthday', MD5('$pass'), '$role')";
        $this->set_query();
    }

    public function get($user = ''){
        $this->query = ($user != '') 
        ?"SELECT * FROM users WHERE user = '$user'" 
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

    public function del($user = ''){
        $this->query = "DELETE FROM users WHERE user = '$user'";

        $this->set_query();
    }

    public function validate_user ($user, $pass){
        $this->query = "SELECT * FROM users WHERE user = '$user' AND pass = MD5('$pass')";
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