<?php

class Producto{
    /** ATRIBUTOS */
    private $id;
    private $categoria_id;
    private $nombre;
    private $descripcion;
    private $precio;
    private $stock;
    private $oferta;
    private $fecha;
    private $imagen;


    private $db;

    function __construct(){
        $this->db = Database::conect();
    }

    // SETER
    function setId($id){
        $this->id = $id;
    }
    function setCategoria_id($categoria_id){
        $this->categoria_id = $this->db->real_escape_string($categoria_id);
    }
     function setNombre($nombre){
        $this->nombre = $this->db->real_escape_string($nombre);
    }
    function setDescripcion($descripcion){
        $this->descripcion = $this->db->real_escape_string($descripcion);
    }
    function setPrecio($precio){
        $this->precio = $this->db->real_escape_string($precio);
    }
    function setStock($stock){
        $this->stock = $this->db->real_escape_string($stock);
    }
    function setOferta($oferta){
        $this->oferta = $this->db->real_escape_string($oferta);
    }
    function setFecha($fecha){
        $this->fecha = $fecha;
    }
    function setImagen($imagen){
        $this->imagen = $this->db->real_escape_string($imagen);
    }

    // GETTER
    function getId(){
        return $this->id;
    }
    function getCategoria_id(){
        return $this->categoria_id;
    }
    function getNombre(){
        return $this->nombre;
    }
    function getDescripcion(){
        return $this->descripcion;
    }
    function getPrecio(){
        return $this->precio;
    }
    function getStock(){
        return $this->stock;
    }
    function getOferta(){
        return $this->oferta;
    }
    function getFecha(){
        return $this->fecha;
    }
    function getImagen(){
        return $this->imagen;
    }



    // OBTENER TODOS LOS PRODUCTOS
    public function getAll(){
        $producto = $this->db->query("SELECT * FROM producto ORDER BY id DESC");
        return $producto;
    }



    // OBTENER TODOS LOS PRODUCTOS
    public function getAllCategory(){
        $sql = "SELECT p.* FROM producto p "
                ." INNER JOIN categorias c ON c.id = p.categoria_id"
                ." WHERE p.categoria_id = {$this->getCategoria_id()}"
                ." ORDER BY id DESC";

        $producto = $this->db->query($sql);
        return $producto;
    }


    // OBTENER TODOS LOS PRODUCTOS
    public function getOne(){
        $producto = $this->db->query("SELECT * FROM producto WHERE id = {$this->getId()}");
        return $producto->fetch_object();
    }



    // OBTENER PRODUCTOS RANDOM
    public function getRandom($limit){
        $productos = $this->db->query("SELECT * FROM producto ORDER BY RAND() LIMIT $limit");
        return $productos;
    }



    // GUARDAR UN NUEVO PRODUCTO
    public function save(){
        $sql = "INSERT INTO producto VALUES(null, '{$this->getCategoria_id()}', '{$this->getNombre()}', '{$this->getDescripcion()}', '{$this->getPrecio()}', '{$this->getStock()}', '', CURDATE(), '{$this->getImagen()}')";
        $save = $this->db->query($sql);

        if($save){
            return true;
        }else{
            return false;
        }
    }



    // ACTUALIZAR PRODUCTO
    public function edit(){
        $sql = "UPDATE producto SET categoria_id = {$this->getCategoria_id()}, nombre = '{$this->getNombre()}', descripcion = '{$this->getDescripcion()}', precio = {$this->getPrecio()}, stock = {$this->getStock()}";

        if($this->getImagen() != null){
            $sql .= ", imagen = '{$this->getImagen()}'";
        }
        
        $sql .= " WHERE id={$this->getId()};";

        $save = $this->db->query($sql);

        if($save){
            return true;
        }else{
            return false;
        }
    }



    public function delete(){
        $sql = "DELETE FROM producto WHERE id = {$this->getId()}";
        $delete = $this->db->query($sql);

        if($delete){
            return true;
        }else{
            return false;
        }
    }
}

?>

