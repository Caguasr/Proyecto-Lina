<?php
class Router {
    //para la ruta
    public $route;
    public function __construct($route) {
        //valores para la session
        $session_options = array(
            'use_only_cookies' => 1,
            'auto_start' => 1,
            'read_and_close' => true
        );
        //si no esta definido la sesion
        //session_start crea la session pero le da un valor falso
        if(!isset($_SESSION))   session_start($session_options);
        

        if(!isset($_SESSION['ok']) ) $_SESSION['ok'] = false;
        
        if($_SESSION['ok']){
            // si existe la variable que viene por la url obten el valor sino toma el valor por defecto que es home
            $this->route = isset($_GET['r']) ? $_GET['r'] : 'home';
            $controller = new ViewControllers();
            switch($this->route){
                case'home':
                    $controller->load_view('home');
                break;
                case'movieseries':
                    if( !isset($_POST['r']) ) $controller->load_view('movieseries');
                    else if( $_POST['r'] == 'movieserie-add' ) $controller->load_view('movieserie-add');
                    else if( $_POST['r'] == 'movieserie-edit') $controller->load_view('movieserie-edit');
                    else if( $_POST['r'] == 'movieserie-delete') $controller->load_view('movieserie-delete');
                    else if( $_POST['r'] == 'movieserie-show') $controller->load_view('movieserie-show');
                break;
                case 'users':
                    if( !isset($_POST['r']) ) $controller->load_view('users');
                    else if( $_POST['r'] == 'user-add' ) $controller->load_view('user-add');
                    else if( $_POST['r'] == 'user-edit') $controller->load_view('user-edit');
                    else if( $_POST['r'] == 'user-delete') $controller->load_view('user-delete');
                break;
                case 'status':
                    //si no envia un valor por post o get
                    if( !isset($_POST['r']) ) $controller->load_view('status');
                    else if( $_POST['r'] == 'status-add' ) $controller->load_view('status-add');
                    else if( $_POST['r'] == 'status-edit') $controller->load_view('status-edit');
                    else if( $_POST['r'] == 'status-delete') $controller->load_view('status-delete');
                break;
                case 'salir':
                    $user_session = new SessionController();
                    $user_session->logout();
                break;
                default:
                $controller->load_view('error404');
            break;
            }

            
        }else{
            //Cuando Vienen campos vacios
            if(!isset($_POST['user']) && !isset($_POST['pass'])){
                //para generar y mandar a llamar al viewControler
                $login_form = new ViewControllers();
                $login_form->load_view('login');

            }else{
                $user_session = new SessionController();
                //Ejecuta el metodo login de la clase Session controler
                $session = $user_session->login($_POST['user'], $_POST['pass']);
                if( empty($session)){
                    $login_form = new ViewControllers();
                    $login_form->load_view('login');
                    header('Location: ./?error=EL Usuario y la contraseña son incorrectos');
                }else{
                   $_SESSION['ok'] = true;

                   foreach($session as $row){
                       $_SESSION['user'] = $row['user'];
                       $_SESSION['email'] = $row['email'];
                       $_SESSION['name'] = $row['name'];
                       $_SESSION['birthday'] = $row['birthday'];
                       $_SESSION['pass'] = $row['pass'];
                       $_SESSION['role'] = $row['role'];
                   }
                   header('Location: ./');
                }
            }

        }
    }

    public function __destruct(){
        unset($route);
    }
}