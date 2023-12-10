<?php require_once 'BDUtils.php'; ?>

<?php
class Beneficio extends BDUtils {
    private $codigo;
    private $nombre;
    private $descripcion;
    private $estado;
    private $fecha_inicio;
    private $categoria_codigo;
    
    public function __construct() {
        parent::__construct(); //Aca se esta ejecutando el constructor de la clase BDUtils (Aca se conecta a la BD).
    }
    
    public function create($codigo, $nombre, $descripcion, $estado, $fecha_inicio, $categoria_codigo) {
        $sql = "INSERT INTO beneficio VALUES " . "('$codigo', '$nombre', '$descripcion', '$estado', '$fecha_inicio', '$categoria_codigo')"; //Se establece la sentencia SQL.
        $preparacion = $this->_db->prepare($sql); //Se prepara la sentencia SQL.
        $resultado = $preparacion->execute(); //Se ejecuta la sentencia SQL.
        return $resultado; //Retorna un boolean si funcionó o no la sentencia SQL.
    }
    
    public function getAll() {
        $sql = "SELECT * FROM beneficio"; //Se establece la sentencia SQL.
        $ejecutar = $this->_db->query($sql);
        $listaBeneficios = $ejecutar->fetch_all(MYSQLI_ASSOC); //Aca se ejecuta la consulta y se almacenan los datos en la lista.
        
        if ($listaBeneficios == true) { //Se consulta si la lista tiene datos.
            return $listaBeneficios;
            $listaBeneficios->close; //Se cierra la conexión a la BD.
        }
        else {
            echo "Falló la conexión a la tabla"; //Si la lista esta vacía es porque no se pudo traer los datos de la tabla.
        }
    }
    
    public function remove($codigo) {
        $sql = "DELETE FROM beneficio WHERE codigo = '$codigo'";
        $preparacion = $this->_db->prepare($sql);
        $resultado = $preparacion->execute();
        return $resultado;
    }
    
    public function buscar($codigo) {
        $sql = "SELECT * FROM beneficio WHERE codigo = '$codigo'"; //Se establece la sentencia SQL.
        $ejecutar = $this->_db->query($sql);
        $listaBeneficios = $ejecutar->fetch_all(MYSQLI_ASSOC); //Aca se ejecuta la consulta y se almacenan los datos en la lista.
        
        if ($listaBeneficios == true) { //Se consulta si la lista tiene datos.
            return $listaBeneficios;
            $listaBeneficios->close; //Se cierra la conexión a la BD.    
        }
        else {
            echo "Falló la conexión a la tabla"; //Si la lista esta vacía es porque no se pudo traer los datos de la tabla.
        }
    }
    
    public function update($codigo, $nombre, $descripcion, $estado, $fecha_inicio, $categoria_codigo){
        $sql = "UPDATE beneficio SET nombre = '$nombre', descripcion = '$descripcion', estado = '$estado', fecha_inicio = '$fecha_inicio', categoria_codigo = '$categoria_codigo'" . " WHERE codigo = '$codigo'";
        $ejecutar = $this->_db->query($sql);
        return $ejecutar;
    }
}
?>

