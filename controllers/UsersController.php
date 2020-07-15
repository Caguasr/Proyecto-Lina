<?php
class UsersController{
    private $model;

    public function __construct(){
        $this->model = new UserModel();
    }

    public function set($user_data = array()){
        //el model como ya es instanciable se tiene acceso a los metodos de la clase modelo
        return $this->model->set($user_data);

    }

    public function get( $user_id = ''){
        return $this->model->get($user_id);
        
    }

    public function del( $user_id = ''){
        return $this->model->del($user_id);
    }

    public function __destruct(){
        unset($this->model);
    }
}