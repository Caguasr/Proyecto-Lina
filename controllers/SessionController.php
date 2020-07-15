<?php
class SessionController{
    private $session;

    public function __construct(){
        //para validar si los usuarios existen
        $this->session = new UserModel();
        
    }

    public function login($user, $pass){
        //ejecuta el metodo valida_user del modelo de usuario y retorno
        return $this->session->validate_user($user, $pass);
    }

    public function logout(){
        session_start();
        session_destroy();
        header('Location: ./');
    }
    
    public function __destruct()
    {
        unset($this->session);
    }
}