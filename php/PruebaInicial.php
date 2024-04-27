<?php
session_start();
$User = $_SESSION['datos']['Nit'];

if (!$User) {
    header("Location: index.html");
} else {
    if (!empty($_POST['Tam'])) {
        // 'Tam' trae la presentacion q se borra
        //Borra_conteo($Fecha,$Xtam);
        echo "Para Borrar";
    } else {
        // echo "Para Grabar";
        Graba_conteo();
    }
    // Lista_Tamaños();
}

function Graba_conteo()
{
    require ('Conexion.php');
    date_default_timezone_set('America/Bogota');
    $time = time();
    $Fecha = strval(date("Y-m-d", $time));
    $Hora = strval(date("H:i:s", $time));
    $User = $_SESSION['datos']['Nit'];

    $Xcprese = $_POST["Cprese"];
    $Xcajas = $_POST["Cajas"];
    $XUnida = $_POST["Uni"];
    $Xtam = $_POST["Tam"];

    if (!empty($Xcprese)) {
        $Unicaja = UnicajaXCprese($_POST["Cprese"]);
        // echo 'Unicaja: ' . $Unicaja;
        $StockConteo = ($XUnida / $Unicaja) + $Xcajas;
        echo 'Conte : ' . $StockConteo;
    } else {
    }
}

function UnicajaXCprese($T)
{
    require ('Conexion.php');
    $sql = "select Unicaja from categorias where codcat= '$T' ";
    $result = $mysqli->query($sql);
    $rows = $result->num_rows;
    $Unicaja = strval($row["Unicaja"]);
    if ($rows > 0) {
        $row = $result->fetch_assoc();
        $Unicaja = strval($row["Unicaja"]);
    }
    return $Unicaja;
}

function Lista_Tamaños()
{
    require ('Conexion.php');
    $sql = "select CodCat,categorias.Nombre as Cat,companias.NOMBRE as Comp from categorias inner join companias on categorias.CodComp=companias.ID";
    $result = $mysqli->query($sql);
    $rows = $result->num_rows;
    $Filas = $rows;
    $numero = 0;
    $id = 1;
    echo "<table style=width:30% BORDER CELLPADDING=6 CELLSPACING=0>";
    echo "<tr>";
    echo "<td> Cant </td><td>Categoria</td><td>Nombre</td><td>Distribuye</td>";
    echo " </tr> \n";
    if ($result = $mysqli->query($sql)) {
        $row = 0;
        while ($row = $result->fetch_assoc()) {
            echo "<tr>";
            echo "<td width=\"1%\">" . $id . "</td>";
            echo "<td width=\"1%\">" . $row["CodCat"] . "</td>";
            echo "<td width=\"5%\">" . $row["Cat"] . "</td>";
            echo "<td width=\"5%\">" . $row["Comp"] . "</td>";
            echo "</tr>";
            $id = $id + 1;
        }
    }
    echo "</table>";
}
?>

<html>

<head>
    <meta http-equiv="refresh" content="150">
    <SCRIPT LANGUAGE="JavaScript">
        function mi_alerta(b) {
            var theForm = document.forms['form1'];
            // document.form1.Tam.value = "30";
            document.getElementById("Tam").value = b.id;
            //alert(b.id);
            theForm.submit();
        }

        function mi_alerta1(c) {
            var theForm = document.forms['form1'];
            // document.form1.Tam.value = "30";
            document.getElementById("Autoriza").value = c.id;
            //alert(b.id);
            theForm.submit();
        }
    </SCRIPT>
    <title>Conteo de Inventario</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto+Condensed:ital,wght@0,100..900;1,100..900&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="estilosphp.css">
    <link rel="icon" href="logo.png">
</head>

<body>
    <header>
        <img src="logo_blanco.png">
        <h1>CORPORACION BNMA</h1>
    </header>
    <form id="form1" name="form1" action="PruebaInicial.php" method="POST">
        <div id="contenedorSelect">
            <label>SELECCIONA EL ITEM A CONTAR:</label>
            <select name="Cprese" class="select-perso">
                <?php
                require ('Conexion.php');
                date_default_timezone_set('America/Bogota');
                $time = time() - 1;
                $Fecha = strval(date("Y-m-d", $time));
                $Fecha = date("Y-m-d", strtotime($Fecha . " - 0 days"));
                $sql = " SELECT T1.CODCAT as CODCAT,T1.NOMBRE as NOMBRE FROM categorias T1"
                    . " WHERE NOT EXISTS (SELECT  NULL  FROM web_reg_conteo T2  WHERE T1.CODCAT = T2.codigo and DATE_FORMAT( F_Creacion, '%Y-%m-%d')='$Fecha' and T2.estado=1)  AND (T1.SEGWEBF+T1.SEGWEBT)>'0' "
                    . " ORDER BY T1.CODCAT";
                $result = $mysqli->query($sql);
                $rows = $result->num_rows;
                if ($result = $mysqli->query($sql)) {
                    while ($row = $result->fetch_assoc()) {
                        echo "<option value=" . $row["CODCAT"] . ">" . $row["CODCAT"] . '-' . $row["NOMBRE"] . "</option>";
                    }
                }
                ?>
            </select>
        </div>
        <div id="contenedorInput">
            <label for="Cajas" class="col-sm-2 control-label">CAJAS CONTADAS:</label>
            <input type="number" class="form-control" name="Cajas" id="Cajas" placeholder="Cajas" required>
        </div>
        <div id="contenedorInput">
            <label for="Uni" class="col-sm-2 control-label">UNIDADES CONTADAS:</label>
            <input type="number" class="form-control" name="Uni" id="Uni" placeholder="Unidades" required>
        </div>
        <label colspan=2 style="text-align:center;">
            <input name="Consultar" type="submit" value="Grabar Conteo" class="btn-enviar">
        </label>
        <input id="Tam" name="Tam" type="hidden" value="">
        <input id="Autoriza" name="Autoriza" type="hidden" value="">
    </form>
</body>

</html>