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
    echo "Bienvenido Administador: " . substr($_SESSION["usuario"], 0, -1); //Aca se toman todos los caracteres menos el ultimo.
    echo "<a href='Logout.php'>Cerrar Sesion</a>";
?>
    <!DOCTYPE html>
    <html lang="es">
    <head>
    	<meta charset="UTF-8" />
    	<title></title>
    </head>
    <body>
    	<?php
    	if(isset($_REQUEST["agregar"])) { //Aca se esta consultando si se dio click al botón Agregar.
    	    $categoria = new Categoria();
    	    $crearCategoria = $categoria->create($_REQUEST["codigo"], $_REQUEST["nombre"]);
    	    if ($crearCategoria == 1){ //Si create es igual a 1 singnifica True (Si ingreso el registro).
    	        echo "<br>Categoria ingresada";
    	?>
    			<a href="ListaCategoriasAdministrador.php"><button>Mostrar lista</button></a>
    	<?php 
    	    }
    	    else {
    	        echo "<script>alert('Error de ingreso'); window.location='AgregarCategoria.php'</script>";
    	    }
    	}
    	else { //Si no se le dio click al botón Agregar se muestra el formulario.
    	?>
        	<div>
            	<form action="AgregarCategoria.php" method="GET">
            		<label for="codigo">Codigo</label><br/>
            		<input type="number" name="codigo" required/><br/>
            		
            		<label for="nombre">Nombre</label><br/>
            		<input type="text" name="nombre" required/><br/>
            		
            		<input type="submit" name="agregar" value="Agregar"/>
            		
            	</form>
            	<a href="ListaCategoriasAdministrador.php"><button>Cancelar</button></a>
        	</div>
    	<?php 
    	}
}
	    ?>
</body>
</html>