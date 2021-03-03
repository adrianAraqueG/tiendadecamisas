<?php
require_once 'models/producto.php';

   class productoController{
       
    /**MÉTODOS */

    // INDEX PRINCIPAL PRODUCTOS // VISTA
    public function index(){
        $producto = new Producto;
        $productos = $producto->getRandom(3);

        //Renderizar vista
         require_once 'views/producto/destacados.php';
        }



    // GESTIONAR PRODUCTOS // VISTA
    public function gestionar(){
        Utilities::isAdmin();

        $producto = new Producto;
        $productos = $producto->getAll();

        require_once 'views/producto/gestionar.php';
    }



    // VER PRODUCTO // VISTA
    public function ver(){
        if(isset($_GET['id'])){
            $editar = true;
            $id = $_GET['id'];
            $producto = new Producto;
            $producto->setId($id);

            $pro = $producto->getOne();

            
        }
        
        require_once 'views/producto/ver.php';
    }



    // CREAR PRODUCTO // VISTA
    public function crear(){
        Utilities::isAdmin();

        require_once 'views/producto/crear.php';
    }



    // GUARDAR PRODUCTO
    public function save(){
        // Comprobar si se recibe algo por POST
        if(isset($_POST) && !empty($_POST)){
            //Comprobar si los campos existen
            $nombre = isset($_POST['nombre']) ? $_POST['nombre']: false;
            $categoria_id = isset($_POST['categoria']) ? $_POST['categoria']: false;
            $descripcion = isset($_POST['descripcion']) ? $_POST['descripcion']: false;
            $precio = isset($_POST['precio']) ? $_POST['precio']: false;
            $stock = isset($_POST['stock']) ? $_POST['stock']: false;

            //Validar los campos
            $validate = Utilities::productValidate($nombre, $categoria_id, $descripcion, $precio, $stock);
            if($validate == false){
                //Crear instancia de producto y guardar los datos del FORM
                $producto = new Producto;
                $producto->setNombre($nombre);
                $producto->setCategoria_id($categoria_id);
                $producto->setDescripcion($descripcion);
                $producto->setPrecio($precio);
                $producto->setStock($stock);
                if(isset($_FILES['img'])){
                    //Guardar la imagen
                    $file = $_FILES['img'];
                    $filename = $file['name'];
                    $mimetype = $file['type'];

                    //comprobar si el mimetype corresponde a una imagen
                    if($mimetype == 'image/jpg' || $mimetype == 'image/jpeg' || $mimetype == 'image/png' || $mimetype == 'image/gif'|| $mimetype == 'image/webp'){
                        //Si no exise el directorio, crearlo
                        if(!is_dir('uploads/productImg')){
                            mkdir('uploads/productImg', 0777, true);
                        }
                        //Mover el archivo cargado al directorio
                        move_uploaded_file($file['tmp_name'], 'uploads/productImg/'.$filename);
                        $producto->setImagen($filename);
                    }
                    //Ejecutar la función save del modelo y comprobar si se guardó correctamente
                }else{
                    $_SESSION['savePro'] = "<strong class='alert_red'>El formato de la imagen no es válido</strong>";
                }
                
                if($_GET['id']){
                    $id = $_GET['id'];
                    $producto->setId($id);
                    $edit = $producto->edit();
                }else{
                    $save = $producto->save();
                }

                if(isset($save) && $save == true){
                    $_SESSION['savePro'] = "<strong class='alert_green'>Producto agregado correctamente</strong>";
                    header("Location: ".base_url."producto/crear");
                }elseif(isset($edit) && $edit == true){
                    $_SESSION['saveEdit'] = "<strong class='alert_green'>Producto actualizado correctamente</strong>";
                    header("Location: ".base_url."producto/gestionar");
                }elseif(isset($save) && $save == false){
                    $_SESSION['savePro'] = "<strong class='alert_red'>Producto no agregado: error</strong>";
                    header("Location: ".base_url."producto/crear");
                }elseif(isset($edit) && $edit == false){
                    $_SESSION['saveEdit'] = "<strong class='alert_green'>Producto NO actualizado</strong>";
                    header("Location: ".base_url."producto/gestionar");
                }
                
            }else{
                $_SESSION['savePro'] = $validate;
                header("Location: ".base_url."producto/crear");
            }
        }else{
            $_SESSION['savePro'] = "<strong class='alert_red'>Por favor, introduzca los valores<strong>";
            header("Location: ".base_url."producto/crear");
        }
    }

  

    // ELIMINAR UN PRODUCTO
    public function delete(){
        Utilities::isAdmin();
        if(isset($_GET['id'])){
            $id = $_GET['id'];

            $producto = new Producto;
            $producto->setId($id);

            $eliminar = $producto->delete();

            if($eliminar == false){
                $_SESSION['delete'] = "<strong class='alert_red'>No se ha podido borrar el producto</strong>";
            }
        }else{
            $_SESSION['delete'] = "<strong class='alert_red'>No se ha podido borrar el producto</strong>";
        }

        // Redirección
        header("Location: ".base_url."producto/gestionar"); 
        
    }



    // EDITAR UN PRODUCTO
    public function edit(){
        Utilities::isAdmin();
        if(isset($_GET['id'])){
            $editar = true;
            $id = $_GET['id'];
            $producto = new Producto;
            $producto->setId($id);

            $pro = $producto->getOne();

            require_once 'views/producto/crear.php';
        }

    }
    


    // 


    }

?>