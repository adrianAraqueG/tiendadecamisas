<?php

require_once "models/pedido.php";

class pedidoController{
        
    /**MÉTODOS */
    public function index(){
            echo 'Controlador de <strong>pedido</strong>, función prueba';
    }



    public function hacer(){
        
        require_once 'views/pedido/hacer.php';
    }



    public function add(){
        if(isset($_POST)){
            $provincia = isset($_POST['provincia']) ? $_POST['provincia'] : false;
            $localidad = isset($_POST['localidad']) ? $_POST['localidad'] : false;
            $direccion = isset($_POST['direccion']) ? $_POST['direccion'] : false;

            //Obtener el valor del carrito
            $stats = Utilities::statsCarrito();
            $valor = strval($stats['total']);

            //Obtener el ID del usuario
            $usuario_id = $_SESSION['identity']->id;
            var_dump($provincia, $localidad, $direccion, $valor, $usuario_id);
            if($provincia && $localidad && $direccion && $valor && $usuario_id){
                $pedido = new Pedido;
                $pedido->setProvincia($provincia);
                $pedido->setLocalidad($localidad);
                $pedido->setDireccion($direccion);
                $pedido->setValor($valor); 
                $pedido->setUsuario_id($usuario_id);

                // Guardar pedido 
                $save = $pedido->save();

                // Guardar linea pedido
                $save_linea = $pedido->save_linea();

                if($save && $save_linea){
                    header("Location: ".base_url."pedido/confirmado");
                }else{
                    $_SESSION['savePed'] = "<h2 class='alert_red'>Pedido no guardado, error query<h2>";
                    header("Location: ".base_url."pedido/hacer");
                }
            }else{
                $_SESSION['savePed'] = "<h2 class='alert_red'>Pedido no guardado, valores incorrectos<h2>";
                header("Location: ".base_url."pedido/hacer");
            }
        }else{
            $_SESSION['savePed'] = "<h2 class='alert_red'>Pedido no guardado<h2>";
            header("Location: ".base_url."pedido/hacer");
        }

    }



    public function confirmado(){
        if(isset($_SESSION['identity'])){
            $identity = $_SESSION['identity'];
            $pedido = new Pedido;
            $pedido->setUsuario_id($identity->id);
            $pedido = $pedido->getOneById();

            $productos_pedido = new Pedido;
            $productos = $productos_pedido->getProductsByPedido($pedido->id);
            
        }

        require_once 'views/pedido/confirmado.php';
    }



    public function mis_pedidos(){
        Utilities::isLogin();
        $usuario_id = $_SESSION['identity']->id;

        $pedido = new Pedido;
        //Sacar los pedidos de un usuario
        $pedido->setUsuario_id($usuario_id);
        $pedidos = $pedido->getAllById();

        require_once 'views/pedido/mispedidos.php';
    }



    public function detalle(){
        Utilities::isLogin();
        if(isset($_GET['id'])){
            $id = $_GET['id'];

            //Sacar el pedido
            $pedido = new Pedido;
            $pedido->setId($id);
            $pedido = $pedido->getOne();

            //Sacar productos
            $producto = new Pedido();
            $productos = $producto->getProductsByPedido($id);

        }else{
            $_SESSION['pro_error'] = "<strong class='alert_red'>Pedido no encontrado</strong>";
            header("Location: ".base_url."pedido/mis_pedidos");
        }

        require_once 'views/pedido/detalle.php';
    }


    
    public function gestionar(){
        Utilities::isAdmin();

        $gestion  = true;

        $pedido = new Pedido;
        $pedidos = $pedido->getAll();


        require_once 'views/pedido/mispedidos.php';
    }



    public function estado(){
        Utilities::isAdmin();

        if(isset($_POST['pedido_id']) && isset($_POST['estado'])){
            $id = $_POST['pedido_id'];
            $estado = $_POST['estado'];

            $pedido = new Pedido;
            $pedido->setId($id);
            $pedido->setEstado($estado);
            $update = $pedido->updateOne();

            if($update){
                header("Location: ".base_url."pedido/detalle&id=".$id);
            }
        }else{
            header("Location: ".base_url."pedido/gestionar");
        }

        
    }




}




?>