<?php
session_start(); //Cada vez que se quiera trabajar con sesiones en un documento hay que utilizar "session_start()".
session_destroy(); //Se destruyen todas las sesiones activas.
header("Location: Login.php");
?>