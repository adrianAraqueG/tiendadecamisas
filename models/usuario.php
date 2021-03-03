<?php

class Usuario{
    /** ATRIBUTOS */
    private $id;
    private $nombre;
    private $apellidos;
    private $email;
    private $password;
    private $fecha;
    private $imagen;
    private $rol;
    private $db;

    public function __construct(){
        $this->db = Database::conect();
    }

    /** MÉTODOS */

    // SET
    public function setId($id){
        $this->id = $id;
    }
    public function setNombre($nombre){
        $this->nombre = $this->db->real_escape_string($nombre);
    }
    public function setApellidos($apellidos){
        $this->apellidos = $this->db->real_escape_string($apellidos);
    }
    public function setEmail($email){
        $this->email = $this->db->real_escape_string($email);
    }
    public function setPassword($password){
        $this->password = $this->db->real_escape_string($password);
    }
    public function setFecha($fecha){
        $this->fecha = $fecha;
    }
    public function setImagen($imagen){
        $this->imagen = $imagen;
    }
    public function setRol($Rol){
        $this->id = $Rol;
    }

    // GET
    public function getId(){
        return $this->id;
    }
    public function getNombre(){
        return $this->nombre;
    }
    public function getApellidos(){
        return $this->apellidos;
    }
    public function getEmail(){
        return $this->email;
    }
    public function getPassword(){
        return $this->password;
    }
    public function getFecha(){
        return $this->fecha;
    }
    public function getImagen(){
        return $this->imagen;
    }
    public function getRol(){
        return $this->rol;
    }


    //SAVE USER
    public function save(){
        $password_hash = password_hash($this->password, PASSWORD_DEFAULT);
        $sql = "INSERT INTO usuarios VALUES(NULL, '{$this->getNombre()}', '{$this->getApellidos()}', '{$this->getEmail()}', '{$password_hash}', CURDATE(), NULL, 'user')";
        $save = $this->db->query($sql);

        $result = false;
        if($save){
            $result = true;
        }else{
            $result = false;
        }

        return $result;
    }

    // LOGIN USER
    public function login(){
        $result = false;

        // Hacer la consulta
        $sql="SELECT * FROM usuarios WHERE email = '{$this->email}'";
        $login = $this->db->query($sql);

        //Validar los datos / Valido si existe el registro
        if($login->num_rows == 1){
            // Convierto la query en un objeto
            $usuario = $login->fetch_object();

            //Valido la contraseña
            $verificar = password_verify($this->getPassword(), $usuario->password);
            if($verificar){
                $result = $usuario;
            }
        }
        return $result;

    }

}
?>