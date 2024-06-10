<?php
session_start();
$User = $_SESSION['datos']['Nit'];

if (!$User) {
    header("Location: index.html");
} else {
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $opcionSeleccionada = $_POST["opciones"];
        Lista_Inventario();
    }
}
function Lista_Inventario()
{
    require('conexion.php');
    $sql = "SELECT * FROM StockxProd WHERE NitLocal = '901331637-1'";
    $result = $mysqli->query($sql);
    $rows = $result->num_rows;
    $Filas = $rows;
    $numero = 0;
    $id = 1;
?>
    <link rel="icon" href="/img/logo.png">
    <link rel='stylesheet' type='text/css' href='/css/estilosMenu.css'>
    <link rel='preconnect' href='https://fonts.googleapis.com'>
    <link rel='preconnect' href='https://fonts.gstatic.com' crossorigin>
    <link href='https://fonts.googleapis.com/css2?family=Roboto+Condensed:ital,wght@0,100..900;1,100..900&display=swap' rel='stylesheet'>
    <header>
        <img src='/img/logo_blanco.png'>
        <h1>CORPORACION BNMA</h1>
    </header>
    <div id="h1Container">
        <h1>Modulo de inventario</h1>
        <h1>Inventario de <?php echo $opcionSeleccionada ?></h1>
    </div>
    <table>
        <tr>
            <th>Nombre</th>
            <th>Stock</th>
        </tr>
        <?php
        if ($result = $mysqli->query($sql)) {
            $row = 0;
            while ($row = $result->fetch_assoc()) {
        ?>
                <tr>
                    <td width="2%"><?= $row["Nombre"] ?></td>
                    <td width="2%"><?= $row["Stock"] ?></td>
                </tr>
        <?php
            }
        } ?>
    </table>
<?php
}
?>