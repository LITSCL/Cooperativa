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
    	<a href="AgregarBeneficio.php"><button>Agregar</button></a>
    	<?php 
    	$categoria = new Categoria();
    	$beneficio = new Beneficio();
    	$listaCategorias = $categoria->getAll();
    	$listaBeneficios = $beneficio->getAll();
    	
    	if ($listaBeneficios) {
    	?>
    		<table border=1>
    			<tr>
    				<th>Codigo</th>
    				<th>Nombre</th>
    				<th>Descripcion</th>
    				<th>Estado</th>
    				<th>Fecha</th>
    				<th>Categoria</th>
    				<th>Opcion 1</th>
    				<th>Opcion 2</th>
    			</tr>
    			<?php
                foreach ($listaBeneficios as $filaBeneficios) {
    			        echo "<tr>";
    			        echo "<td>" . $filaBeneficios["codigo"] . "</td>";
    			        echo "<td>" . $filaBeneficios["nombre"] . "</td>";
    			        echo "<td>" . $filaBeneficios["descripcion"] . "</td>";
    			        if ($filaBeneficios["estado"] == 0) {
    			            echo "<td>"."Inactivo"."</td>";
    			        }
    			        else {
    			            echo "<td>" . "Activo" . "</td>";
    			        }
    			        echo "<td>" . $filaBeneficios["fecha_inicio"] . "</td>";
    
    			        foreach ($listaCategorias as $filaCategorias) {
    			            if ($filaBeneficios["categoria_codigo"] == $filaCategorias["codigo"]) {
    			                echo "<td>" . $filaCategorias["nombre"] . "</td>";
    			                break;
    			            }
    			        }
    			        
    			        echo "<td>"."<a href='ModificarBeneficio.php?codigo=" . $filaBeneficios['codigo'] . "'" . ">Modificar</a>" . "</td>";
    			        echo "<td>"."<a href='EliminarBeneficio.php?codigo=" . $filaBeneficios['codigo'] . "'" . ">Eliminar</a>" . "</td>";
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