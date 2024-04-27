<?php
session_start();
$User = $_SESSION['datos']['Nit'];

if (!$User) {
    header("Location: index.html");
} else {
    Lista_Inventario();
}

function Lista_Inventario()
{
    require ('conexion.php');
    $sql = " select nitlocal,nrosucursal,categorias.CodCat,categorias.Nombre, round(sum(stock),1) as Stock " .
        " from categorias " .
        " inner join catproductos on categorias.codcat=catproductos.CodCat " .
        " inner join productos on catproductos.Sku=productos.Sku " .
        " inner join StockProd on StockProd.Sku=productos.Sku " .
        " group by nitlocal,nrosucursal,categorias.CodCat " .
        " order by categorias.CodCat,nitlocal,nrosucursal";
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
    <table>
        <tr>
            <td> Cant </td><td>Nit</td><td>Sucursal</td><td>Categoria</td><td>Nombre</td><td>Stock</td>
        </tr>
    <?php
    if ($result = $mysqli->query($sql)) {
        $row = 0;
        while ($row = $result->fetch_assoc()) {
            ?>
            <tr>
                <td width="1%"><?= $id ?></td>
                <td width="1%"><?= $row["nitlocal"] ?></td>
                <td width="1%"><?= $row["nrosucursal"] ?></td>
                <td width="1%"><?= $row["CodCat"] ?></td>
                <td width="5%"><?= $row["Nombre"] ?></td>
                <td width="5%"><?= $row["Stock"] ?></td>
            </tr>
            <?php
            $id = $id + 1;
        }
    }?>
    </table>
    <?php
}
?>