<?php
include "conexion.php";  // Conexión tiene la información sobre la conexión de la base de datos.

// Las siguientes son líneas de código HTML simple, para crear una página web
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
    <title>Últimos datos medidos de TEMPERATURA y HUMEDAD dispositivo IoT</title>
    <meta http-equiv="refresh" content="15" />
</head>
<body>
<table width="80%" align=center cellpadding=5 border=1 bgcolor="#FFFFFF">
    <tr>
        <td valign="top" align=center width=80% colspan=8 bgcolor="green">
            <img src="img/invernadero.jpg" width=800 height=250>
        </td>
    </tr>
    <tr>
        <td valign="top" align=center width=80% colspan=8 bgcolor="green">
            <h1> <font color=white>Últimos datos medidos del Invernadero Automatizado # 1</font></h1>
        </td>
    </tr>
    <tr>
        <td valign="top" align=center bgcolor="#E1E1E1">
            <b>#</b>
        </td>
        <td valign="top" align=center bgcolor="#E1E1E1">
            <b>Id de la Tarjeta</b>
        </td>
        <td valign="top" align=center bgcolor="#E1E1E1">
            <b>Fecha</b>
        </td>
        <td valign="top" align=center bgcolor="#E1E1E1">
            <b>Hora</b>
        </td>
        <td valign="top" align=center bgcolor="#E1E1E1">
            <b>Temperatura</b>
        </td>
        <td valign="top" align=center bgcolor="#E1E1E1">
            <b>Humedad</b>
        </td>
        <td valign="top" align=center bgcolor="#E1E1E1">
            <b>Alerta Temperatura</b>
        </td>
        <td valign="top" align=center bgcolor="#E1E1E1">
            <b>Alerta Humedad</b>
        </td>
    </tr>
    <?php
    // CONSULTA TEMPERATURA MÁXIMA
    $sql1 = "SELECT * FROM datos_maximos WHERE id=1";
    $result1 = $mysqli->query($sql1);
    $row1 = $result1->fetch_array(MYSQLI_NUM);
    $temp_max = $row1[3];

    // CONSULTA HUMEDAD MÁXIMA
    $sql2 = "SELECT * FROM datos_maximos WHERE id=2";
    $result2 = $mysqli->query($sql2);
    $row2 = $result2->fetch_array(MYSQLI_NUM);
    $hum_max = $row2[3];

    $sql = "SELECT * FROM datos_medidos WHERE ID_TARJ=1 ORDER BY id DESC LIMIT 5";
    $result = $mysqli->query($sql);
    $contador = 0;
    while ($row = $result->fetch_array(MYSQLI_NUM)) {
        $temp = $row[2];
        $hum = $row[3];
        $fecha = $row[4];
        $hora = $row[5];
        $ID_TARJ = 1;
        $contador++;
        ?>
        <tr>
            <td valign="top" align=center>
                <?php echo $contador; ?>
            </td>
            <td valign="top" align=center>
                <?php echo $ID_TARJ; ?>
            </td>
            <td valign="top" align=center>
                <?php echo $fecha; ?>
            </td>
            <td valign="top" align=center>
                <?php echo $hora; ?>
            </td>
            <td valign="top" align=center>
                <?php echo $temp . " *C"; ?>
            </td>
            <td valign="top" align=center>
                <?php echo $hum . " %"; ?>
            </td>
            <td valign="top" align=center>
                <?php
                if ($temp > $temp_max) {
                    ?>
                    <img src="img/temp_alerta.jpg" width=80 height=80>
                    <?php
                } else {
                    ?>
                    <img src="img/temp_ok.jpg" width=80 height=80>
                    <?php
                }
                ?>
            </td>
            <td valign="top" align=center>
                <?php
                if ($hum > $hum_max) {
                    ?>
                    <img src="img/hum_alerta.jpg" width=80 height=80>
                    <?php
                } else {
                    ?>
                    <img src="img/hum_ok.jpg" width=80 height=80>
                    <?php
                }
                ?>
            </td>
        </tr>
        <?php
    }
    ?>
</table>
</body>
</html>
