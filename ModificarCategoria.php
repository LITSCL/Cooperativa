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
?>
    <!DOCTYPE html>
    <html lang="es">
    <head>
        <meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<title>Document</title>
    </head>
    <body>
    <?php 
    $codigo = $_REQUEST["codigo"];
    $categoria = new Categoria();
    $listaCategorias = $categoria->buscar($codigo);
    if (isset($_REQUEST["modificar"]) != "Modificar") { //Aca se esta verificando que no se haya enviado el formulario antes.
        if ($listaCategorias) {
            foreach ($listaCategorias as $fila) { //Se recorre una lista con un solo objeto.
    ?>
        		<div>
                	<form action="ModificarCategoria.php" method="GET">
                		<label for="codigo">Codigo</label><br/>
                		<input type="number" name="codigo" value="<?php echo $fila['codigo']; ?>" readonly/><br/>
                		
                		<label for="nombre">Nombre</label><br/>
                		<input type="text" name="nombre" value="<?php echo $fila['nombre']; ?>" required/><br/>
                		
                		<input type="submit" name="modificar" value="Modificar"/>
                		
                	</form>
                	<a href="ListaCategoriasAdministrador.php"><button>Cancelar</button></a>
            	</div>
    <?php 
            }
        }
    }
    ?>
    
    <?php 
    if (isset($_REQUEST["modificar"])) {
        $codigo = $_REQUEST["codigo"];
        $nombre = $_REQUEST["nombre"];
        
        $categoria = new Categoria();
        $modificarCategoria = $categoria->update($codigo,$nombre);
        if ($modificarCategoria == 1) {
            echo "<br>Categoria modificada";    
    ?>
    	<a href="ListaCategoriasAdministrador.php"><button>Mostrar lista</button></a>
    <?php
        }
        else {
            echo "<script>alert('Error de ingreso'); window.location='ListaCategoriasAdministrador.php'</script>";
        }    
    }
}
    ?>
</body>
</html>