<?php
class MovieSeriesController{
    private $model;

    public function __construct(){
        $this->model = new MovieSeriesModel();
    }

    public function set($ms_data = array()){
        //el model como ya es instanciable se tiene acceso a los metodos de la clase modelo
        return $this->model->set($ms_data);

    }

    public function get( $ms = ''){
        return $this->model->get($ms);
        
    }

    public function del( $ms = ''){
        return $this->model->del($ms);
    }

    public function __destruct(){
        //unset($this->model);
    }
}