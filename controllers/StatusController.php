<?php
class StatusController{
    private $model;

    public function __construct(){
        $this->model = new StatusModel();
    }

    public function set($status_data = array()){
        //el model como ya es instanciable se tiene acceso a los metodos de la clase modelo
        return $this->model->set($status_data);

    }

    public function get( $status_id = ''){
        return $this->model->get($status_id);
        
    }

    public function del( $status_id = ''){
        return $this->model->del($status_id);
    }

    public function __destruct(){
        //unset($this->model);
    }
}