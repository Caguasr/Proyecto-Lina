<?php 
class Router {
	public $route;

	public function __construct($route) {
		//http://php.net/manual/es/function.session-start.php
		//http://php.net/manual/es/session.configuration.php
		//buscar opciones en el PHP.INI
		$session_options = array(
			'use_only_cookies' => 1,
			'auto_start' => 1,
			'read_and_close' => true
		);
		
		if( !isset($_SESSION) )  session_start($session_options);

		if( !isset($_SESSION['ok']) )  $_SESSION['ok'] = false;


		if($_SESSION['ok']) {
			//Aquí va toda la programación de nuestra webapp
			$this->route = isset($_GET['r']) ? $_GET['r'] : 'home';
			
			$controller = new ViewControllers();

			switch ($this->route) {
				case 'home':
					$controller->load_view('home');
					break;

				case 'movieseries':
					if( !isset( $_POST['r'] ) )  $controller->load_view('movieseries');
					else if( $_POST['r'] == 'movieserie-add' )  $controller->load_view('movieserie-add');
					else if( $_POST['r'] == 'movieserie-edit' )  $controller->load_view('movieserie-edit');
					else if( $_POST['r'] == 'movieserie-delete' )  $controller->load_view('movieserie-delete');
					else if( $_POST['r'] == 'movieserie-show' )  $controller->load_view('movieserie-show');
					break;

				case 'users':
					if( !isset( $_POST['r'] ) )  $controller->load_view('users');
					else if( $_POST['r'] == 'user-add' )  $controller->load_view('user-add');
					else if( $_POST['r'] == 'user-edit' )  $controller->load_view('user-edit');
					else if( $_POST['r'] == 'user-delete' )  $controller->load_view('user-delete');
					break;

				case 'status':
					if( !isset( $_POST['r'] ) )  $controller->load_view('status');
					else if( $_POST['r'] == 'status-add' )  $controller->load_view('status-add');
					else if( $_POST['r'] == 'status-edit' )  $controller->load_view('status-edit');
					else if( $_POST['r'] == 'status-delete' )  $controller->load_view('status-delete');
					break;

				case 'generos':
					if( !isset( $_POST['r'] ) )  $controller->load_view('generos');
					else if( $_POST['r'] == 'genero-add' )  $controller->load_view('genero-add');
					else if( $_POST['r'] == 'genero-edit' )  $controller->load_view('genero-edit');
					else if( $_POST['r'] == 'genero-delete' )  $controller->load_view('genero-delete');
					break;
				
				case 'links':
					if( !isset( $_POST['r'] ) )  $controller->load_view('links');
					else if( $_POST['r'] == 'link-add' )  $controller->load_view('link-add');
					else if( $_POST['r'] == 'link-edit' )  $controller->load_view('link-edit');
					else if( $_POST['r'] == 'link-delete' )  $controller->load_view('link-delete');
					break;

				case 'salir':
					$user_session = new SessionController();
					$user_session->logout();
					break;
				
				default:
					$controller->load_view('error404');
					break;
			}
		} else {
			if( !isset($_POST['user']) && !isset($_POST['pass']) ) {
				//mostrar un formulario de autenticación
				$login_form = new ViewControllers();
				$login_form->load_view('login');
			}
			else {
				$user_session = new SessionController();
				$session = $user_session->login($_POST['user'], $_POST['pass']);

				if( empty($session) ) {
					//echo 'El usuario y el password son incorrectos';
					$login_form = new ViewControllers();
					$login_form->load_view('login');
					header('Location: ./?error=El usuario ' . $_POST['user'] . ' y el password proporcionado no coinciden');
				} else {
					//echo 'El usuario y el password son correctos';
					//var_dump($session);
					
					$_SESSION['ok'] = true;

					foreach ($session as $row) {
						$_SESSION['id_usuario'] = $row['id_usuario'];
						$_SESSION['nombre_usuario'] = $row['nombre_usuario'];
						$_SESSION['usuario'] = $row['usuario'];
						$_SESSION['password'] = $row['password'];
						$_SESSION['email'] = $row['email'];
						$_SESSION['rol'] = $row['rol'];
					}

					header('Location: ./');
				}
			}
		}
	}

	public function __destruct() {
		//unset($this);
	}
}