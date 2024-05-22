<?php
include "conexion.php";  // La conexión contiene la información sobre la conexión a la base de datos.
$mysqli = new mysqli($host, $user, $pw, $db); // Aquí se hace la conexión a la base de datos.

// Las siguientes son líneas de código HTML simple, para crear una página web
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
    <title>Últimos datos medidos de TEMPERATURA, HUMEDAD y ILUMINACIÓN del Invernadero Automatizado</title>
    <meta http-equiv="refresh" content="15" />
</head>
<body>
<table width="80%" align=center cellpadding=5 border=1 bgcolor="#FFFFFF">
    <tr>
        <td valign="top" align=center width=80% colspan=7 bgcolor="green">
            <img src="img/invernaderoencabezado.jpg" width=800 height=250>
        </td>
    </tr>
    <tr>
        <td valign="top" align=center width=80% colspan=7 bgcolor="green">
            <h1> <font color=white>Últimos datos medidos del Invernadero Automatizado # 3</font></h1>
        </td>
    </tr>
    <tr>
        <td valign="top" align=center bgcolor="#E1E1E1">
            <b>#</b>
        </td>
        <td valign="top" align=center bgcolor="#E1E1E1">
            <b>Fecha</b>
        </td>
        <td valign="top" align=center bgcolor="#E1E1E1">
            <b>Hora</b>
        </td>
        <td valign="top" align=center bgcolor="#E1E1E1">
            <b>Temperatura (°C)</b>
        </td>
        <td valign="top" align=center bgcolor="#E1E1E1">
            <b>Humedad aire (%)</b>
        </td>
        <td valign="top" align=center bgcolor="#E1E1E1">
            <b>Iluminación (lux)</b>
        </td>
        <td valign="top" align=center bgcolor="#E1E1E1">
            <b>Humedad suelo (%)</b>
        </td>
    </tr>
    <?php
    // Se prepara la consulta SQL para obtener los últimos 5 datos medidos de la tabla 'datos_medidos'
    $sql1 = "SELECT * FROM datos_medidos ORDER BY id_datos_medidos DESC LIMIT 5"; 
    // Se ejecuta la consulta SQL
    $result1 = $mysqli->query($sql1);
    
    $contador = 0;
    // Se inicia un bucle while para iterar sobre los resultados de la consulta
    while($row1 = $result1->fetch_array(MYSQLI_NUM))
    {
        $contador++;
        // Se extraen los datos de cada fila
        $fecha = $row1[1];
        $hora = $row1[2];
        $temp = $row1[3];
        $hum = $row1[4];
        $ilum = $row1[6];
        $temps = $row1[5];
    ?>
        <tr>
            <td valign="top" align=center><?php echo $contador; ?></td>
            <td valign="top" align=center><?php echo $fecha; ?></td>
            <td valign="top" align=center><?php echo $hora; ?></td>
            <td valign="top" align=center><?php echo $temp; ?></td>
            <td valign="top" align=center><?php echo $hum; ?></td>
            <td valign="top" align=center><?php echo $ilum; ?></td>
            <td valign="top" align=center><?php echo $temps; ?></td>
        </tr>
    <?php
    }
    ?>
</table>
</body>
</html>
