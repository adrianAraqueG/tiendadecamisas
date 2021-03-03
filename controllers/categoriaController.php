<?php
    //Cargar el modelo
    require_once 'models/categoria.php';
    require_once 'models/producto.php';

   class categoriaController{

        public function index(){
            Utilities::isAdmin();
            $categoria = new Categoria;
            $categorias = $categoria->getAll();

            require_once 'views/categoria/index.php';
        }
        public function crear(){
            Utilities::isAdmin();
            require_once 'views/categoria/crear.php';
        }

        public function ver(){
            if(isset($_GET['id'])){

                // Consultar Categoria
                $categoria = new Categoria;
                $categoria->setId($_GET['id']);

                $categoria = $categoria->getOne();

                // Conseguir Productos
                $producto =  new Producto;
                $producto->setCategoria_id($_GET['id']);
                $productos = $producto->getAllCategory();
            }

            require_once 'views/categoria/ver.php';
        }

        public function save(){
            Utilities::isAdmin();

            if(isset($_POST) && !empty($_POST['nombre'])){
                if(!is_numeric($_POST['nombre'])){
                    $categoria = new Categoria;
                    $categoria->setNombre(trim($_POST['nombre']));

                    $save = $categoria->save();
                    if($save){
                        $_SESSION['saveCat'] = "<strong class='alert_green'>Categoria guardada con éxito</strong>"; 
                    }else{
                        $_SESSION['saveCat'] = "<strong class='alert_red'>No se pudo guardar la categoría :(</strong>";
                    }
                }else{
                    $_SESSION['saveCat'] = "<strong class='alert_red'>Por favor ingrese un nombre válido para su categoria</strong>"; 
                }
            }else{
                $_SESSION['saveCat'] = "<strong class='alert_red'>Por favor ingrese un nombre para su categoria</strong>"; 
            }

            // Redirección
            header("Location: ".base_url.'categoria/crear');
        }
    }



?>