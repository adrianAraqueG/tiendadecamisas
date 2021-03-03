<?php

class Pedido{
    private $id;
    private $usuario_id;
    private $provincia;
    private $localidad;
    private $direccion;
    private $valor;
    private $estado;
    private $fecha;
    private $hora;

    public $db;

    public function __construct(){
        $this->db = Database::conect();
    }

    /** MÉTODOS */

    // SETER
    public function setId($id){
        $this->id = $id;
    }
    public function setUsuario_id($u_id){
        $this->usuario_id = $u_id;
    }
    public function setProvincia($provincia){
        $this->provincia = $this->db->real_escape_string($provincia);
    }
    public function setLocalidad($localidad){
        $this->localidad = $this->db->real_escape_string($localidad);
    }
    public function setDireccion($direccion){
        $this->direccion = $this->db->real_escape_string($direccion);
    }
    public function setValor($valor){
        $this->valor =$valor;
    }
    public function setEstado($estado){
        $this->estado = $this->db->real_escape_string($estado);
    }
    public function setFecha($fecha){
        $this->fecha = $fecha;
    }
    public function setHora($hora){
        $this->hora = $hora;
    }

    // GETTER
    public function getId(){
        return $this->id;
    }
    public function getUsuario_id(){
        return $this->usuario_id;
    }
    public function getProvincia(){
        return $this->provincia;
    }
    public function getLocalidad(){
        return $this->localidad;
    }
    public function getDireccion(){
        return $this->direccion;
    }
    public function getEstado(){
        return $this->estado;
    }
    public function getValor(){
        return $this->valor;
    }
    public function getFecha(){
        return $this->fecha;
    }
    public function getHora(){
        return $this->hora;
    }


    
    // GUARDAR PEDIDO
    public function save(){
        $sql = "INSERT INTO pedido VALUES(null, {$this->getUsuario_id()}, '{$this->provincia}', '{$this->localidad}', '{$this->direccion}', '{$this->valor}', 'estado', CURDATE(), CURTIME());";
        $save = $this->db->query($sql);

        if($save){
            return true;
        }else{
            var_dump($this->db->error); var_dump($this->getValor()); die();
        }
    }



    // GUARDAR linea_pedido
    public function save_linea(){
        $sql = "SELECT LAST_INSERT_ID() as 'pedido';";
        $query = $this->db->query($sql);
        $pedido_id = $query->fetch_object()->pedido;

        foreach($_SESSION['carrito'] as $elemento){
            $pro = $elemento['producto'];
        
            $insert = "INSERT INTO linea_pedido VALUES(null, {$pro->id}, {$pedido_id}, {$elemento['unidades']});";
            $save = $this->db->query($insert);
        }

        $result = false;
        if($save){
            $result = true;
        }

        return $result;
    }


    // OBTENER TODOS LOS PRODUCTOS
    public function getAll(){
        $pedido = $this->db->query("SELECT * FROM pedido ORDER BY id DESC");
        return $pedido;
    }




    // OBTENER TODOS LOS PRODUCTOS
    public function getOne(){
        $pedido = $this->db->query("SELECT * FROM pedido WHERE id = {$this->getId()}");
        return $pedido->fetch_object();
    }


    // OBTENER DATOS POR USUARIO
    public function getOneById(){
        $sql = "SELECT p.id, p.valor FROM pedido p"
                ." WHERE p.usuario_id = {$this->getUsuario_id()} ORDER BY id DESC LIMIT 1";
        $pedido = $this->db->query($sql);
        return $pedido->fetch_object();
    }



    public function getProductsByPedido($id){
        $sql = "SELECT * FROM productos WHERE id IN "
        . "(SELECT producto_id FROM pedido WHERE pedido_id = {$id})";

        $sql = "SELECT pr.*, lp.unidades FROM producto pr"
        . " INNER JOIN linea_pedido lp ON lp.producto_id = pr.id WHERE lp.pedido_id = {$id};";
        $productos = $this->db->query($sql);
        return $productos;
    }



    public function getAllById(){
        $sql = "SELECT p.* FROM pedido p"
                ." WHERE p.usuario_id = {$this->getUsuario_id()} ORDER BY id DESC;";
        $pedido = $this->db->query($sql);
        return $pedido;
    }



    public function updateOne(){
        $sql = "UPDATE pedido SET estado = '{$this->getEstado()}'";
        $sql .= " WHERE id={$this->getId()}";

        $save = $this->db->query($sql);
        if($save){
            return true;
        }else{
            return false;
        }
    }
}

?>