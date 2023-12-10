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
    <!doctype html>
    <html lang="en">
    <head>
    	<meta charset="UTF-8" />
    	<title>Document</title>
    </head>
    <body>
    	<ul>
    		<li><a href="ListaBeneficiosAdministrador.php">Lista Beneficios</a></li>
    		<li><a href="ListaCategoriasAdministrador.php">Lista Categorias</a></li>
    	</ul>
    	<hr>
    	<a href="AgregarCategoria.php"><button>Agregar</button></a>
    	<?php 
    	$categoria = new Categoria();
    	$listaCategorias = $categoria->getAll();
    	
	if ($listaCategorias) {
	?>
		<table border=1>
			<tr>
				<th>Codigo</th>
				<th>Nombre</th>
				<th>Opcion 1</th>
				<th>Opcion 2</th>
			</tr>
			<?php
			foreach ($listaCategorias as $fila) {
				echo "<tr>";
				echo "<td>";
				echo $fila["codigo"];
				echo "</td>";
				echo "<td>";
				echo $fila["nombre"];
				echo "</td>";
				echo "<td>" . "<a href='ModificarCategoria.php?codigo=" . $fila['codigo'] . "'" . ">Modificar</a>" . "</td>";
				echo "<td>" . "<a href='EliminarCategoria.php?codigo=" . $fila['codigo'] . "'" . ">Eliminar</a>" . "</td>";
				echo "</tr>";
			}
			?>
		</table>	
	<?php 
	}
}
	?>
</body>
</html>