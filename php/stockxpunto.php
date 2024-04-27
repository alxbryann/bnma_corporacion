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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <header>
        <img src='/img/logo_blanco.png'>
        <h1>CORPORACION BNMA</h1>
    </header>
    <div id="h1Container">
        <h1>Inventario General</h1>
    </div>
    
    <table>
        <thead class=table-light">
        <tr>
            <td>Empresa</td><td>Nombre</td><td>Stock</td>
        </tr>
    <?php
    if ($result = $mysqli->query($sql)) {
        $row = 0;
        while ($row = $result->fetch_assoc()) {
            ?>
            <tr>
                <?php
                if($row["nitlocal"] == "901724534-7" && $row["nrosucursal"] == "1") {
                    $row["nitlocal"] = "Drinks 1";
                }
                if($row["nitlocal"] == "901724534-7" && $row["nrosucursal"] == "2") {
                    $row["nitlocal"] = "Drinks 2";
                }
                if($row["nitlocal"] == "901331637-1") {
                    $row["nitlocal"] = "Gran Central";
                }
                ?>
                <td width="1%"><?= $row["nitlocal"] ?></td>
                <td width="5%"><?= $row["Nombre"] ?></td>
                <td width="5%"><?= $row["Stock"] ?></td>
            </tr>
            <?php
            $id = $id + 1;
        }
    }?>
    </table>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <?php
}
?>