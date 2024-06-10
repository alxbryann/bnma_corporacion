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
    require('conexion.php');
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
    <div id="h1Container">
        <h1>Modelo de inventario</h1>
    </div>
    <form action="stock.php" method="post">
        <p>Selecciona una opción:</p>
        <br>
        <br>
        <select name="opciones">
            <option value="inventario_general">Inventario general</option>
            <option value="drinks">Drinks</option>
            <option value="drinks2">Drinks 2</option>
            <option value="gran_central">Gran Central</option>
        </select>
        <input type="submit" value="Enviar">
    </form>
    <table>
        <tr>
            <th>Empresa</th>
            <th>Nombre</th>
            <th>Stock</th>
        </tr>

    </table>
<?php
}
?>