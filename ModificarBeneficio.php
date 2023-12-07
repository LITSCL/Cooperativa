<?php require_once 'Beneficio.php'; ?>
<?php require_once 'Categoria.php'; ?>

<?php 
session_start(); //Cada vez que se quiera trabajar con sesiones en un documento hay que utilizar "session_start()".
if (empty($_SESSION["usuario"])){ //Se esta preguntando si la sesión existe.
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
    $codigo=$_REQUEST["codigo"];
    $beneficio=new Beneficio();
    $listaBeneficios=$beneficio->buscar($codigo);
    if (isset($_REQUEST["modificar"]) != "Modificar") { //Aca se esta verificando que no se haya enviado el formulario antes.
        if($listaBeneficios){
            foreach ($listaBeneficios as $fila) { //Se recorre una lista con un solo objeto.
    ?>
            	<div>
                	<form action="ModificarBeneficio.php" method="GET">
                		<label for="codigo">Codigo</label><br/>
                		<input type="number" name="codigo" value="<?php echo $fila['codigo']; ?>" readonly/><br/>
                		
                		<label for="nombre">Nombre</label><br/>
                		<input type="text" name="nombre" value="<?php echo $fila['nombre']; ?>" required/><br/>
                		
                		<label for="descripcion">Descripcion</label><br/>
                		<input type="text" name="descripcion" value="<?php echo $fila['descripcion']; ?>" required/><br/>
                		
                		<?php 
                		if ($fila["estado"] === "1") {
                		    echo "<input type='radio' name='estado' value='1' checked required>Activo<br/>";
                		    echo "<input type='radio' name='estado' value='0' required>Inactivo<br/>";
                		}
                		else {
                		    echo "<input type='radio' name='estado' value='1' required>Activo<br/>";
                		    echo "<input type='radio' name='estado' value='0' checked required>Inactivo<br/>";
                		}
                		?>

						<label for="fecha_inicio">Fecha</label><br/>
                		<input type="date" name="fecha_inicio" value="<?php echo $fila['fecha_inicio']; ?>" required/><br/>
                		
                		<label for="categoria_codigo">Categoria</label><br/>
                		<?php 
                		$categoria = new Categoria();
                		$listaCategorias = $categoria->getAll();
                		?>
                		<select name="categoria_codigo">
                		<?php 
                		foreach($listaCategorias as $filaCategoria) {
                		    if ($fila["categoria_codigo"] == $filaCategoria["codigo"]) {
                		        echo "<option selected='selected' value=".$filaCategoria["codigo"] . ">" . $filaCategoria["nombre"] . "</option>";
                		    }
                		    else {
                		        echo "<option value=" . $filaCategoria["codigo"] . ">" . $filaCategoria["nombre"] . "</option>";
                		    }        		    
                		}
                		?>
                		</select><br/> 		
                		<input type="submit" name="modificar" value="Modificar"/>
                		
                	</form>
                	<a href="ListaBeneficiosAdministrador.php"><button>Cancelar</button></a>
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
        $descripcion = $_REQUEST["descripcion"];
        $estado = $_REQUEST["estado"];
        $fecha_inicio = $_REQUEST["fecha_inicio"];
        $categoria_codigo = $_REQUEST["categoria_codigo"];
        
        $beneficio = new Beneficio();
        $modificarBeneficio = $beneficio->update($codigo, $nombre, $descripcion, $estado, $fecha_inicio, $categoria_codigo);
        if ($modificarBeneficio == 1){
            echo "<br>Beneficio modificado"; 
        
    ?>
    	<a href="ListaBeneficiosAdministrador.php"><button>Mostrar lista</button></a>
    <?php
        }
        else {
            echo "<script>alert('Error de ingreso'); window.location='ListaBeneficiosAdministrador.php'</script>";
        }    
    }
}
?>
</body>
</html>