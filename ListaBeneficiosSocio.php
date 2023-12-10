<?php require_once 'Beneficio.php'; ?>
<?php require_once 'Categoria.php'; ?>

<?php 
session_start(); //Cada vez que se quiera trabajar con sesiones en un documento hay que utilizar "session_start()".
if (empty($_SESSION["usuario"])){ //Se esta preguntando si la sesión existe.
    header("Location: Login.php");
    exit(); //Finaliza el Script (No se lee nada mas que este abajo de esta isntrucción).
}
if (empty($_SESSION["usuario"]) == false && substr($_SESSION["usuario"], -1) === "1") {
    echo "Los administradores no pueden acceder a esta pagina";
    echo "<a href='PanelAdministrador.php'>Volver al panel</a>";
}
if (empty($_SESSION["usuario"]) == false && substr($_SESSION["usuario"], -1) === "0") {
    echo "Bienvenido Socio: " . substr($_SESSION["usuario"], 0, -1); //Aca se toman todos los caracteres menos el ultimo.
    echo "<a href='Logout.php'>Cerrar Sesion</a>";

?>
<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8" />
	<title>Document</title>
</head>
<body>
	<hr>
	<?php 
	$categoria = new Categoria();
	$beneficio = new Beneficio();
	$listaCategorias = $categoria->getAll();
	$listaBeneficios = $beneficio->getAll();
	
	if ($listaBeneficios) {
	?>
		<form action="ListaBeneficiosSocio.php" method="GET">

      		<input type="submit" name="filtrar" value="Filtrar"/>
      		<select name="categoriaFiltrada">
      			<?php 
      			foreach ($listaCategorias as $filaCategoria) {
      			    if (isset($_REQUEST["categoriaFiltrada"])) {
      			        if ($_REQUEST["categoriaFiltrada"] == $filaCategoria["codigo"]) {
      			            echo "<option selected='selected' value=" . $filaCategoria["codigo"] . ">" . $filaCategoria["nombre"] . "</option>";
      			        }
      			        else {
      			            echo "<option value=" . $filaCategoria["codigo"] . ">" . $filaCategoria["nombre"] . "</option>";
      			        }
      			    }
      			    else {
      			        echo "<option value=" . $filaCategoria["codigo"] . ">" . $filaCategoria["nombre"] . "</option>";
      			    }
      			}
		        ?>
      		</select>
				
		</form>

		<table border=1>
			<tr>
				<th>Codigo</th>
				<th>Nombre</th>
				<th>Descripcion</th>
				<th>Estado</th>
				<th>Fecha</th>
				<th>Categoria</th>
			</tr>
			<?php
			if (isset($_REQUEST["filtrar"])) {
			    foreach ($listaBeneficios as $filaBeneficios){
			        if ($filaBeneficios["categoria_codigo"] == $_REQUEST["categoriaFiltrada"]) {
			            if ($filaBeneficios["estado"] == 1) {
			                echo "<tr>";
			                echo "<td>" . $filaBeneficios["codigo"] . "</td>";
			                echo "<td>" . $filaBeneficios["nombre"] . "</td>";
			                echo "<td>" . $filaBeneficios["descripcion"] . "</td>";
			                echo "<td>" . "Activo" . "</td>";
			                echo "<td>" . $filaBeneficios["fecha_inicio"] . "</td>";
			                foreach ($listaCategorias as $filaCategorias) {
			                    if ($filaBeneficios["categoria_codigo"] == $filaCategorias["codigo"]) {
			                        echo "<td>" . $filaCategorias["nombre"] . "</td>";
			                        break;
			                    }
			                }
			            }
			        }
			    }
			}
			else {
			    foreach ($listaBeneficios as $filaBeneficios) {
			        if ($filaBeneficios["estado"] == 1) {
			            echo "<tr>";
			            echo "<td>" . $filaBeneficios["codigo"] . "</td>";
			            echo "<td>" . $filaBeneficios["nombre"] . "</td>";
			            echo "<td>" . $filaBeneficios["descripcion"] . "</td>";
			            echo "<td>" . "Activo" . "</td>";
			            echo "<td>" . $filaBeneficios["fecha_inicio"] . "</td>";
			            foreach ($listaCategorias as $filaCategorias) {
			                if ($filaBeneficios["categoria_codigo"] == $filaCategorias["codigo"]) {
			                    echo "<td>" . $filaCategorias["nombre"] . "</td>";
			                    break;
			                }
			            }
			        }
			    }
			}
			?>
		</table>	
	<?php 
	}
}
	?>
</body>
</html>
