<?php
class Utilities{
    //Métodos útiles

    //Borrar sesiones
    public static function deleteSesion($name){
        if(isset($_SESSION[$name])){
            $_SESSION[$name] = null;
            unset($_SESSION[$name]);
        }

        return $name;
    }



    // Validar datos del registro
    public static function validate($nombre, $apellido, $email, $password){
        $error = true;

        // Validar nombre
        if(empty($nombre)){
            $error = "<strong class='alert_red'>Por favor introduzca su Nombre</strong>";
            return $error;
        }elseif(is_numeric($nombre) && preg_match("/[0-9]/", $nombre)){
            $error = "<strong class='alert_red'>Por favor introduzca un Nombre válido</strong>";
            return $error;
        }else{
            $error = false; 
        }

        // Validar apellido
        if(empty($apellido)){
            $error = "Por favor introduzca su <strong>Email</strong>";
            return $error;
        }elseif(is_numeric($apellido) && preg_match("/[0-9]/", $apellido)){
            $error = "<strong class='alert_red'>Por favor introduzca un Apellido válido</strong>";
            return $error;
        }else{
            $error = false; 
        }

        // Validar email
        // Validar que no sea un usuario ya registrado con el mismo email
        $sql = "SELECT email FROM usuarios WHERE email = '$email' ";
        $conexion = Database::conect();
        $result = mysqli_fetch_assoc($conexion->query($sql));

        if(empty($email)){
            $error = "<strong class='alert_red'>Por favor introduzca su Email</strong>";
            return $error;
        }elseif(!filter_var($email, FILTER_VALIDATE_EMAIL)){
            $error = "<strong class='alert_red'>Por favor introduzca un Email válido</strong>";
            return $error;
        }elseif(!empty($result)){
            $error = "<strong class='alert_red'>El email ya está registrado</strong>";
            return $error;
        }else{
            $error = false; 
        }

        // Validar password
        if(empty($password)){
            $error = "<strong class='alert_red'>Por favor introduzca su Contraseña</strong>";
            return $error;
        }elseif(strlen($password) < 5){
            $error = "<strong class='alert_red'>Por favor introduzca una contraseña válida, mínimo 5 caracteres</strong>";
            return $error;
        }else{
            $error = false;
        }

        // Devolver el $error
        return $error;
    }

    // VALIDAR SI ES ADMIN
    public static function isAdmin(){
        if(!isset($_SESSION['admin'])){
            header("Location: ".base_url);

        }else{
            return true;
        }

    }

    // MOSTRAR CATEGORIAS
    public static function showCategorias(){
        require_once 'models/categoria.php';
        
        $categoria = new Categoria;
        $categorias = $categoria->getAll();

        return $categorias;
    }

    public static function productValidate($nombre, $cat_id, $desc, $precio, $stock){
        $error = true;

        // Validar nombre
        if(empty($nombre)){
            $error = "<strong class='alert_red'>Por favor introduzca un Nombre</strong>";
            return $error;
        }elseif(is_numeric($nombre) && preg_match("/[0-9]/", $nombre)){
            $error = "<strong class='alert_red'>Por favor introduzca un Nombre válido</strong>";
            return $error;
        }else{
            $error = false; 
        }

        // Validar categoria_id
        if(empty($cat_id)){
            $error = "<strong class='alert_red'>Por favor Elija una categoría</strong>";
            return $error;
        }elseif(!is_numeric($cat_id) && !preg_match("/[0-9]/", $cat_id)){
            $error = "<strong class='alert_red'>Error en la elección de categoria</strong>";
            return $error;
        }else{
            $error = false; 
        }

        // Validar descripción
        if(empty($desc)){
            $error = "<strong class='alert_red'>Por favor introduzca una descripción</strong>";
            return $error;
        }elseif(!is_string($desc)){
            $error = "<strong class='alert_red'>Por favor introduzca una descripción válida</strong>";
            return $error;
        }else{
            $error = false; 
        }

        //validar precio
        if(empty($precio)){
            $error = "<strong class='alert_red'>Por favor introduzca un valor para su producto</strong>";
            return $error;
        }elseif(!preg_match("/[0-9]/", $precio)){
            $error = "<strong class='alert_red'>Por favor introduzca un valor válido</strong>";
            return $error;
        }else{
            $error = false; 
        }

        //validar stock
        if(empty($stock)){
            $error = "<strong class='alert_red'>Por favor introduzca un valor para su stock</strong>";
            return $error;
        }elseif(!preg_match("/[0-9]/", $stock)){
            $error = "<strong class='alert_red'>Por favor introduzca un valor válido</strong>";
            return $error;
        }else{
            $error = false; 
        }

        return $error;


    }



    public static function statsCarrito(){
        $stats = array(
            "count" => 0,
            "total" => 0,
        );

        if(isset($_SESSION['carrito'])){
            $stats['count'] = count($_SESSION['carrito']);

            foreach($_SESSION['carrito'] as $value){
                $stats['total'] += $value['precio'] * $value['unidades'];
            }
        }

        return $stats;
    }



    public static function isLogin(){
        if(isset($_SESSION['identity'])){
            return true;
        }
    }



    public static function showStatus($status){
        $value = 'Pendiente';

        if($status == 'estado'){
            $value = 'Pendiente';
        }elseif($status == 'preparation'){
            $value = 'En preparación';
        }elseif($status == 'ready'){
            $value = 'Listo para enviar';
        }elseif($status == 'sended'){
            $value = 'Enviado';
        }

        return $value;
    }
}
?>