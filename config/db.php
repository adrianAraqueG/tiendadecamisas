<?php

class Database{

	public static function conect(){
		$db = new mysqli('bhd0vrvjtn6g9f8a7khe-mysql.services.clever-cloud.com', 'unofwmebxod6jjsr', 's84NEg6zTDEwGfqJ8Lh7', 'bhd0vrvjtn6g9f8a7khe', '3306');
		$db->query("SET NAMES 'utf8'");
		return $db;
	}

}
/** 
$email = 'adrian.kanox.2003@gmail.com';
$sql = "SELECT email FROM usuarios WHERE email = '$email' ";
$conexion = Database::conect();
$consulta = mysqli_fetch_assoc($conexion->query($sql));
if(empty($consulta)){
	echo 'No hay nada';
}else{
	echo 'Hay algo';
}*/


?>