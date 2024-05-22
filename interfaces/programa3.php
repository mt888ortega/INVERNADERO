<?php
include "conexion.php";  // La conexión contiene la información sobre la conexión a la base de datos.

// Las siguientes son líneas de código HTML simple, para crear una página web
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
    <title>Consulta de datos medidos en el Invernadero Automatizado #3 por rango de fechas</title>
</head>
<body>
<table width="80%" align=center cellpadding=5 border=1 bgcolor="#FFFFFF">
    <tr>
        <td valign="top" align=center width=80% colspan=7 bgcolor="green">
            <img src="img/invernaderoencabezado.jpg" width=800 height=250>
        </td>
    </tr>
<tr>
    <td valign="top" align="center" width="80%" colspan="7" bgcolor="green">
        <h1 style="font-size: 24px; margin: 10px; color: white;">Consulta de datos medidos en el Invernadero Automatizado #3 por rango de fechas</h1>
    </td>
</tr>

<?php

if (isset($_POST["enviado"])) {
    $enviado = $_POST["enviado"];
    if ($enviado == "S1") {
        $fecha_ini = $_POST["fecha_ini"];  // en estas variables se almacenan los datos de fechas recibidos del formulario HTML inicial
        $fecha_fin = $_POST["fecha_fin"];
        $mysqli = new mysqli($host, $user, $pw, $db); // Aquí se hace la conexión a la base de datos.
?>
        <tr>
            <td valign="top" align=center bgcolor="#E1E1E1" colspan=7>
                <b>Rango de fechas consultado: desde <?php echo $fecha_ini; ?> hasta <?php echo $fecha_fin; ?></b>
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
                <b>Temperatura</b>
            </td>
            <td valign="top" align=center bgcolor="#E1E1E1">
                <b>Humedad aire</b>
            </td>
            <td valign="top" align=center bgcolor="#E1E1E1">
                <b>Iluminación</b>
            </td>
            <td valign="top" align=center bgcolor="#E1E1E1">
                <b>Humedad suelo</b>
            </td>
        </tr>
<?php
        // Se prepara la consulta SQL para obtener los datos medidos dentro del rango de fechas especificado
        $sql1 = "SELECT * FROM datos_medidos WHERE fecha BETWEEN '$fecha_ini' AND '$fecha_fin' ORDER BY fecha";
        // Se ejecuta la consulta SQL
        $result1 = $mysqli->query($sql1);
        // La siguiente variable se usa para numerar las filas
        $contador = 0;
        // Se inicia un bucle while para iterar sobre los resultados de la consulta
        while ($row1 = $result1->fetch_array(MYSQLI_NUM)) {
            $contador++;
            // Se extraen los datos de cada fila
            $fecha = $row1[1];
            $hora = $row1[2];
            $temp = $row1[3];
            $hum = $row1[4];
            $ilum = $row1[5];
            $temps = $row1[6];
?>
            <tr>
                <td valign="top" align=center><?php echo $contador; ?></td>
                <td valign="top" align=center><?php echo $fecha; ?></td>
                <td valign="top" align=center><?php echo $hora; ?></td>
                <td valign="top" align=center><?php echo $temp; ?> °C</td>
                <td valign="top" align=center><?php echo $hum; ?> %</td>
                <td valign="top" align=center><?php echo $ilum; ?> lux</td>
                <td valign="top" align=center><?php echo $temps; ?> %</td>
            </tr>
<?php
        }  // FIN DEL WHILE
?>
        <tr>
            <form method="POST" action="programa3.php">
                <td bgcolor="#EEEEEE" align=center colspan=7>
                    <input type="submit" value="Volver" name="Volver">
                </td>
            </form>
        </tr>
<?php
    } // FIN DEL IF, si ya se han recibido las fechas del formulario
}  // FIN DEL IF, si la variable enviado existe, que es cuando ya se envió el formulario
else 
?>    
   <form method="POST" action="programa3.php">
    <tr>
        <td bgcolor="#CCEECC" align="center" colspan=6> 
            <font FACE="arial" SIZE=2 color="#000044"> <b>Fecha Inicial:</b></font>  
        </td>   
        <td bgcolor="#EEEEEE" align="center"> 
            <input type="date" name="fecha_ini" value="" required>  
        </td>
    </tr>
    <tr>
        <td bgcolor="#CCEECC" align="center" colspan=6> 
            <font FACE="arial" SIZE=2 color="#000044"> <b>Fecha Final:</b></font>  
        </td>   
        <td bgcolor="#EEEEEE" align="center"> 
            <input type="date" name="fecha_fin" value="" required>  
        </td>
    </tr>
    <tr>
        <td bgcolor="#EEEEEE" align="center" colspan=7> 
            <input type="hidden" name="enviado" value="S1">  
            <input type="submit" value="Consultar" name="Consultar">  
        </td>   
    </tr>
</form>	  
  



