<?php
// Iniciar la sesión
session_start();

// Require al autoload que carga los controladores/configuraciones/helpers
require_once 'autoload.php';
require_once 'config/db.php';
require_once 'config/parameters.php';
require_once 'helpers/utilities.php';

// Requerir los archivos html
require_once 'views/layout/header.php';
require_once 'views/layout/sidebar.php';

// 	Función para mostrar errores
function show_error(){
	$error = new errorController;
	return $error->index();
}




//Comprobar si llegan los parámetros correctos por GET y definir el controlador
if(isset($_GET['controller'])){
	$nombre_controlador = $_GET['controller'].'Controller';
}elseif(!isset($_GET['controller']) && !isset($_GET['action'])){
	$nombre_controlador = controller_default;
}else{
	show_error();
}



//Comprobar si el controlador existe, crear un nuevo objeto controlador 
//y ejecutar la acción que llega por GET
if(class_exists($nombre_controlador)){	
	$controlador = new $nombre_controlador();
	
	if(isset($_GET['action']) && method_exists($controlador, $_GET['action'])){
		$action = $_GET['action'];
		$controlador->$action();

	}elseif(!isset($_GET['controller']) & !isset($_GET['action'])){
		$action = action_default;
		$controlador->$action();
	}else{
		show_error();
	}
}else{
	show_error();
}


// Requerir el footer
require_once 'views/layout/footer.php';

?>