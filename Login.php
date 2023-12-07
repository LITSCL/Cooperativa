<!doctype html>
<html lang="es">
<head>
	<meta charset="UTF-8" />
	<title>Login</title>
</head>
<body>
	<form action="ValidarSesion.php" method="GET">
    	<label for="rut">Usuario</label><br/>
    	<input type="text" name="rut"><br/>
    	<label for="clave">Clave</label><br/>
    	<input type="password" name="clave"><br/>
    	<input type="submit" name="ingresar" value="Ingresar">
    </form>
</body>
</html>