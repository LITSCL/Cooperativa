<?php require_once 'Categoria.php'; ?>

<?php 
session_start(); //Cada vez que se quiera trabajar con sesiones en un documento hay que utilizar "session_start()".
if (empty($_SESSION["usuario"])) { //Se esta preguntando si la sesión existe.
    header("Location: Login.php");
    exit(); //Finaliza el Script (No se lee nada mas que este abajo de esta isntrucción).
}
if (empty($_SESSION["usuario"]) == false && substr($_SESSION["usuario"], -1) === "0") {
    echo "Los socios no pueden acceder a esta pagina";
    echo "<a href='ListaBeneficiosSocio.php'>Volver a la lista</a>";
}
if (empty($_SESSION["usuario"]) == false && substr($_SESSION["usuario"], -1) === "1") {
    echo "Bienvenido Administador: ".substr($_SESSION["usuario"], 0, -1); //Aca se toman todos los caracteres menos el ultimo.
    echo "<a href='Logout.php'>Cerrar Sesion</a>";

    $codigo = $_REQUEST["codigo"];
    $categoria = new Categoria();
    $eliminarCategoria = $categoria->remove($codigo);
    if ($eliminarCategoria == 1){
        echo "<br>Categoria eliminada";
        ?>
    	<a href="ListaCategoriasAdministrador.php"><button>Mostrar lista</button></a>
    	<?php 
    }
    else{
        echo "<script>alert('Error al eliminar'); window.location='ListaCategoriasAdministrador.php'</script>";   
    }
}
?>