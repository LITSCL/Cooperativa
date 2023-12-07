<?php require_once 'Usuario.php'; ?>

<?php
$rutRecibido = $_REQUEST["rut"];
$claveRecibida = $_REQUEST["clave"];

$usuario = new Usuario();
$listaUsuarios = $usuario->buscar($rutRecibido);

if ($listaUsuarios) {
    foreach ($listaUsuarios as $filaUsuario) {
        if ($filaUsuario["clave"] === $claveRecibida && $filaUsuario["tipo"] === "1") {
            session_start(); //Cada vez que se quiera trabajar con sesiones en un documento hay que utilizar "session_start()".
            $_SESSION["usuario"] = $rutRecibido . "1"; //Se crea una sesion.
            header("Location: PanelAdministrador.php"); //Se redirige al usuario al documento "Contenido.php".
            
        }
        else if ($filaUsuario["clave"] === $claveRecibida && $filaUsuario["tipo"] === "0") {
            session_start(); //Cada vez que se quiera trabajar con sesiones en un documento hay que utilizar "session_start()".
            $_SESSION["usuario"] = $rutRecibido . "0"; //Se crea una sesion.
            header("Location: ListaBeneficiosSocio.php"); //Se redirige al usuario al documento "Contenido.php".
        }
    }
}
echo "Usuario Y/O clave no valido";
echo "<a href='Login.php'>Volver al Login</a>";
?>