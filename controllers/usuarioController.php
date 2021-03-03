<?php

    // Cargar modelo
    require_once 'models/usuario.php';
   class usuarioController{
       
       /**MÉTODOS */
        public function index(){
            echo 'Controlador de <strong>usuario</strong>, función prueba';
        }

        // Mostrar la la vista del registro
        public function registro(){
            require_once 'views/usuario/registro.php';
        }

        // Recoger los datos del form, instanciar al modelo Usuario y usar su método save para guardarlo
        public function save(){
            if(isset($_POST)){

                $nombre = isset($_POST['nombre']) ? trim($_POST['nombre']) : false;
                $apellido = isset($_POST['apellido']) ? trim($_POST['apellido']) : false;
                $email = isset($_POST['email']) ? trim($_POST['email']) : false;
                $password = isset($_POST['pass']) ? trim($_POST['pass']) : false;

                $validar = Utilities::validate($nombre, $apellido, $email, $password);
                var_dump($validar);
                if($validar == false){
                    $usuario = new Usuario;
                    $usuario->setNombre($nombre);
                    $usuario->setApellidos($apellido);
                    $usuario->setEmail($email);
                    $usuario->setPassword($password);
                    $save = $usuario->save();

                    if($save){
                        $_SESSION[register]= 'complete';
                    }else{
                        $_SESSION[register]= 'failed';
                    }
                }else{
                    $_SESSION[register]= $validar;
                }
            }else{
                $_SESSION[register]= "<strong class='alert_red'>Algo ha fallado :(</strong>";
            }

            // Redirección 
            header('Location:'.base_url.'usuario/registro');
        }

        // LOGIN USER
        public function login(){
            if(isset($_POST)){
                //Identificar al usuario
                $usuario = new Usuario;
                $usuario->setEmail($_POST['email']);
                $usuario->setPassword($_POST['pass']);

                $identity = $usuario->login();
                
                if($identity && is_object($identity)){
                    $_SESSION['identity'] = $identity;

                    if($identity->rol == admin){
                        $_SESSION['admin'] = true;
                    }
                }else{
                    $_SESSION['error_login'] = "</strong class='alert_red'>Error al iniciar sesión</strong>";
                }
            }
            //Redirección
           header("Location: ".base_url);
            
        }
        // EXIT LOGIN
        public function exit(){
            if(isset($_SESSION['identity'])){
                unset($_SESSION['identity']);
            }
            if(isset($_SESSION['admin'])){
                unset($_SESSION['admin']);
            }

            if(isset($_SESSION['carrito'])){
                unset($_SESSION['carrito']);
            }

            // Redirección 
            header("Location: ".base_url);
        }
    }

?>