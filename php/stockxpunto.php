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
    <link href='https://fonts.googleapis.com/css2?family=Roboto+Condensed:ital,wght@0,100..900;1,100..900&display=swap'
        rel='stylesheet'>
    <header>
        <img src='/img/logo_blanco.png'>
        <h1>CORPORACION BNMA</h1>
    </header>
    <div id="h1Container">
        <h1>Inventario General</h1>
    </div>

    <table>
        <tr>
            <th>Empresa</th>
            <th>Nombre</th>
            <th>Stock</th>
        </tr>
        <?php
        if ($result = $mysqli->query($sql)) {
            $row = 0;
            while ($row = $result->fetch_assoc()) {
                ?>
                <tr>
                    <?php
                    //DIVIDE LOS INVENTARIOS DE LAS 3 BODEGAS 
                    /*if ($row["nitlocal"] == "901724534-7" && $row["nrosucursal"] == "1") {
                        $row["nitlocal"] = "Drinks 1";
                    }
                    if ($row["nitlocal"] == "901724534-7" && $row["nrosucursal"] == "2") {
                        $row["nitlocal"] = "Drinks 2";
                    }
                    if ($row["nitlocal"] == "901331637-1") {
                        $row["nitlocal"] = "Gran Central";
                    }*/
                    if ($row["nitlocal"] == "901331637-1") {
                        $stockTotal += $row["Stock"];
                        $row["Stock"] = $stockTotal;
                    }else{
                        $stockTotal += $row["Stock"];
                    }
                    ?>
                    <td width="2%"><?= $row["nitlocal"] ?></td>
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