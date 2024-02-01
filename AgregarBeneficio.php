<?php require_once 'Beneficio.php'; ?>
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
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
    	<title>Document</title>
    </head>
    <body>
	<?php
	if (isset($_REQUEST["agregar"])) { //Aca se esta consultando si se dio click al botón Agregar.
	    $beneficio = new Beneficio();
	    $crearBeneficio = $beneficio->create($_REQUEST["codigo"], $_REQUEST["nombre"], $_REQUEST["descripcion"], $_REQUEST["estado"], $_REQUEST["fecha_inicio"], $_REQUEST["categoria_codigo"]);
	    if ($crearBeneficio == 1) { //Si create es igual a 1 singnifica True (Si ingresó el registro).
	        echo "<br>Beneficio ingresado";
	?>
			<a href="ListaBeneficiosAdministrador.php"><button>Mostrar lista</button></a>
	<?php 
	    }
	    else {
	        echo "<script>alert('Error de ingreso'); window.location='AgregarBeneficio.php'</script>";
	    }
	}
	else { //Si no se le dio click al botón Agregar se muestra el formulario.
	?>
    	<div>
        	<form action="AgregarBeneficio.php" method="GET">
        		<label for="codigo">Codigo</label><br/>
        		<input type="number" name="codigo" required/><br/>
        		
        		<label for="nombre">Nombre</label><br/>
        		<input type="text" name="nombre" required/><br/>
        		
        		<label for="descripcion">Descripcion</label><br/>
        		<input type="text" name="descripcion" required/><br/>
        		
        		<input type="radio" name="estado" value="1" required>Activo<br/>
      			<input type="radio" name="estado" value="0" required>Inactivo<br/>
        		
        		<label for="fecha_inicio">Fecha</label><br/>
        		<input type="date" name="fecha_inicio" required/><br/>
        		
        		<label for="categoria_codigo">Categoria</label><br/>
        		<?php 
        		$categoria = new Categoria();
        		$listaCategorias = $categoria->getAll();
        		?>
        		<select name="categoria_codigo">
        		<?php 
        		foreach($listaCategorias as $filaCategoria){
        		    echo "<option value=" . $filaCategoria["codigo"] . ">" . $filaCategoria["nombre"] . "</option>";
        		}
        		?>
        		</select><br/> 		
        		<input type="submit" name="agregar" value="Agregar"/>
        		
        	</form>
        	<a href="ListaBeneficiosAdministrador.php"><button>Cancelar</button></a>
    	</div>
	<?php 
	}
}
	?>
</body>
</html>