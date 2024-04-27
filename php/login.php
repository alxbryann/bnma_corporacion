<?php
session_start();
require ('Conexion.php');
if (!empty($_POST)) {
    $usuario = mysqli_real_escape_string($mysqli, $_POST['usuario']);
    $password = mysqli_real_escape_string($mysqli, $_POST['contraseña']);

    echo $usuario;

    $error = '';
    $sql = "SELECT terceros.Nit,Nombre FROM terceros inner join tercerospassw on terceros.nit=tercerospassw.nit WHERE terceros.Nit = '$usuario' AND passw = '$password' AND tercerospassw.ESTADO='1' ";
    $result = $mysqli->query($sql);
    $rows = $result->num_rows;
    if ($rows > 0) {
        $array = $result->fetch_assoc();
        $_SESSION['datos']['Nit'] = $array['Nit'];
        $_SESSION['datos']['Nombre'] = $array['Nombre'];
        $_SESSION["SESSION"] = $datos;
        header("Location:/html/menu.html");
    } else {
        echo 'error Login';
        header("Location:/index.html");
    }
}
?>