<?php
session_start();
$User = $_SESSION['datos']['Nit'];

if (!$User) {
    header("Location: index.html");
} else {
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $opcionSeleccionada = $_POST["opciones"];
        echo $opcionSeleccionada;
    }
}
