<?php
session_start();
$User = $_SESSION['datos']['Nit'];

if (!$User) {
    header("Location: index.html");
} else {
    lista_empleados();
}
function lista_empleados(){
    require('Conexion.php');
}
?>