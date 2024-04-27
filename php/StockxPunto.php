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
    require ('Conexion.php');
    $sql = " select nitlocal,nrosucursal,categorias.CodCat,categorias.Nombre, round(sum(stock),1) as Stock " .
        " from categorias " .
        " inner join catproductos on categorias.codcat=catproductos.CodCat " .
        " inner join productos on catproductos.Sku=productos.Sku " .
        " inner join StockProd on StockProd.Sku=productos.Sku " .
        " group by nitlocal,nrosucursal,categorias.CodCat " .
        " order by nitlocal,nrosucursal,categorias.CodCat ";
    $result = $mysqli->query($sql);
    $rows = $result->num_rows;
    $Filas = $rows;
    $numero = 0;
    $id = 1;
    echo '<link rel="icon" href="/img/logo.png">';
    echo "<link rel='stylesheet' type='text/css' href='/css/estilosMenu.css'>";
    echo "<link rel='preconnect' href='https://fonts.googleapis.com'>";
    echo "<link rel='preconnect' href='https://fonts.gstatic.com' crossorigin>";
    echo "<link href='https://fonts.googleapis.com/css2?family=Roboto+Condensed:ital,wght@0,100..900;1,100..900&display=swap' rel='stylesheet'>";
    echo "<header>";
    echo "<img src='/img/logo_blanco.png'>";
    echo "<h1>CORPORACION BNMA</h1>";
    echo "</header>";
    echo "<table>";
    echo "<tr>";
    echo "<td> Cant </td><td>Categoria</td><td>Nombre</td><td>Stock</td>";
    echo " </tr> \n";
    if ($result = $mysqli->query($sql)) {
        $row = 0;
        while ($row = $result->fetch_assoc()) {
            echo "<tr>";
            echo "<td width=\"1%\">" . $id . "</td>";
            echo "<td width=\"1%\">" . $row["nitlocal"] . "</td>";
            echo "<td width=\"1%\">" . $row["Nrosucursal"] . "</td>";
            echo "<td width=\"1%\">" . $row["CodCat"] . "</td>";
            echo "<td width=\"5%\">" . $row["Nombre"] . "</td>";
            echo "<td width=\"5%\">" . $row["Stock"] . "</td>";
            echo "</tr>";
            $id = $id + 1;
        }
    }
    echo "</table>";
}
?>