<?php
class LinksController{
    private $model;

    public function __construct(){
        $this->model = new LinksModel();
    }

    public function set($links_data = array()){
        //el model como ya es instanciable se tiene acceso a los metodos de la clase modelo
        return $this->model->set($links_data);

    }

    public function get( $id_link = ''){
        return $this->model->get($id_link);
        
    }

    public function del( $id_link = ''){
        return $this->model->del($id_link);
    }

    public function __destruct(){
        //unset($this->model);
    }
}