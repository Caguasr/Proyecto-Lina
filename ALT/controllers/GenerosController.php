<?php
class GenerosController{
    private $model;

    public function __construct(){
        $this->model = new GenerosModel();
    }

    public function set($generos_data = array()){
        //el model como ya es instanciable se tiene acceso a los metodos de la clase modelo
        return $this->model->set($generos_data);

    }

    public function get( $id_genero = ''){
        return $this->model->get($id_genero);
        
    }

    public function del( $id_genero = ''){
        return $this->model->del($id_genero);
    }

    public function __destruct(){
        //unset($this->model);
    }
}