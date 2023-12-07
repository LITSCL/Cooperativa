<?php require_once 'BDUtils.php'; ?>

<?php

class Usuario extends BDUtils {
    private $rut;
    private $nombre;
    private $apellido;
    private $clave;
    private $correo;
    private $tipo;
    
    public function __construct() {
        parent::__construct(); //Aca se esta ejecutando el constructor de la clase BDUtils (Aca se conecta a la BD).
    }
    
    public function buscar($rut) {
        $sql = "SELECT * FROM usuario WHERE rut='$rut'"; //Se establece la sentencia SQL.
        $ejecutar = $this->_db->query($sql);
        $listaUsuarios = $ejecutar->fetch_all(MYSQLI_ASSOC); //Aca se ejecuta la consulta y se almacenan los datos en la lista.
        
        if ($listaUsuarios == true) { //Se consulta si la lista tiene datos.
            return $listaUsuarios;
            $listaUsuarios->close; //Se cierra la conexión a la BD.
        }
    }
}

