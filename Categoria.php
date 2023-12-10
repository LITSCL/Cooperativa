<?php require_once 'BDUtils.php'; ?>

<?php
class Categoria extends BDUtils{
    private $codigo;
    private $nombre;
    
    public function __construct() {
        parent::__construct(); //Aca se esta ejecutando el constructor de la clase BDUtils (Aca se conecta a la BD).
    }
    
    public function create($codigo, $nombre) {
        $sql="INSERT INTO categoria VALUES " . "('$codigo', '$nombre')"; //Se establece la sentencia SQL.
        $preparacion = $this->_db->prepare($sql); //Se prepara la sentencia SQL.
        $resultado = $preparacion->execute(); //Se ejecuta la sentencia SQL.
        return $resultado; //Retorna un boolean si funcionó o no la sentencia SQL.
    }
    
    public function getAll() {
        $sql = "SELECT * FROM categoria"; //Se establece la sentencia SQL.
        $ejecutar = $this->_db->query($sql);
        $listaCategorias = $ejecutar->fetch_all(MYSQLI_ASSOC); //Aca se ejecuta la consulta y se almacenan los datos en la lista.
        
        if ($listaCategorias == true) { //Se consulta si la lista tiene datos.
            return $listaCategorias;
            $listaCategorias->close; //Se cierra la conexión a la BD.
        }
        else {
            echo "Falló la conexión a la tabla"; //Si la lista esta vacía es porque no se pudo traer los datos de la tabla.
        }
    }   
    
    public function remove($codigo) {
        $sql = "DELETE FROM categoria WHERE codigo = '$codigo'";
        $preparacion = $this->_db->prepare($sql);
        $resultado = $preparacion->execute();
        return $resultado;
    }
    
    public function buscar($codigo) {
        $sql="SELECT * FROM categoria WHERE codigo = '$codigo'"; //Se establece la sentencia SQL.
        $ejecutar = $this->_db->query($sql);
        $listaCategorias=$ejecutar->fetch_all(MYSQLI_ASSOC); //Aca se ejecuta la consulta y se almacenan los datos en la lista.
        
        if ($listaCategorias == true) { //Se consulta si la lista tiene datos.
            return $listaCategorias;
            $listaCategorias->close; //Se cierra la conexión a la BD.
        }
        else {
            echo "Falló la conexión a la tabla"; //Si la lista esta vacía es porque no se pudo traer los datos de la tabla.
        }
    }
    
    public function update($codigo, $nombre) {
        $sql = "UPDATE categoria SET nombre = '$nombre'" . " WHERE codigo = '$codigo'";
        $ejecutar = $this->_db->query($sql);
        return $ejecutar;
    }
}
?>
