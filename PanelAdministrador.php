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
    echo "Bienvenido Administador: " . substr($_SESSION["usuario"],0 , -1); //Aca se toman todos los caracteres menos el ultimo.
    echo "<a href='Logout.php'>Cerrar Sesion</a>";
?>
	<!doctype html>
	<html lang="es">
	<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<title>Document</title>
	</head>
	<body>
		<ul>
			<li><a href="ListaBeneficiosAdministrador.php">Lista Beneficios</a></li>
			<li><a href="ListaCategoriasAdministrador.php">Lista Categorias</a></li>
		</ul>
		<hr>
	</body>
	</html>
<?php 
}
?>

