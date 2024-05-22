<?php
include "conexion.php";  

// Líneas de código HTML para crear la página web
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 	Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
    <title>Consulta y modificación de valores límite - Invernadero Automatizado #3</title>
</head>
<body>
<table width="80%" align=center cellpadding=5 border=1 bgcolor="#FFFFFF">
    <tr>
        <td valign="top" align=center width=80% colspan=6 bgcolor="green">
            <img src="img/invernaderoencabezado.jpg" width=800 height=250>
        </td>
    </tr>
    <tr>
        <td valign="top" align=center width=80% colspan=6 bgcolor="green">
            <h1><font color=white>Consulta y modificación de valores límite - Invernadero Automatizado #3</font></h1>
        </td>
    </tr>
<?php

if (isset($_POST["enviado"])) {
    $enviado = $_POST["enviado"];
    if ($enviado == "S1") {
        $mysqli = new mysqli($host, $user, $pw, $db); 
        
        // Modificar los máximos
        $sql1 = "UPDATE datos_limite SET maximo_valor=? WHERE id=?";
        $stmt1 = $mysqli->prepare($sql1);
        $stmt1->bind_param("di", $max_valor, $id);
        
        // Modificar los mínimos
        $sql2 = "UPDATE datos_limite SET minimo_valor=? WHERE id=?";
        $stmt2 = $mysqli->prepare($sql2);
        $stmt2->bind_param("di", $min_valor, $id);
        
        // Array asociativo para almacenar los valores recibidos del formulario
        $valores = $_POST['valores'];

        foreach ($valores as $id => $datos) {
            $max_valor = $datos['max'];
            $min_valor = $datos['min'];

            // Modificar los máximos
            $stmt1->execute();

            // Modificar los mínimos
            $stmt2->execute();
        }

        $mensaje = "Datos actualizados correctamente";
    } 
}
?>    

<form method=POST action="programa4.php">
    <tr>    
        <td bgcolor="#CCEECC" align=center> 
            <font FACE="arial" SIZE=2 color="#000044"> <b>Dato</b></font>  
        </td>    
        <td bgcolor="#CCEECC" align=center> 
            <font FACE="arial" SIZE=2 color="#000044"> <b>Máximo</b></font>  
        </td>    
        <td bgcolor="#CCEECC" align=center> 
            <font FACE="arial" SIZE=2 color="#000044"> <b>Mínimo</b></font>  
        </td>    
    </tr>
    <?php
        $mysqli = new mysqli($host, $user, $pw, $db);
        $sql = "SELECT * FROM datos_limite";
        $result = $mysqli->query($sql);
        while ($row = $result->fetch_assoc()) {
            echo '<tr>';
            echo '<td>'.$row['nombre_dato_limite'].'</td>';
            echo '<td><input type="number" name="valores['.$row['id'].'][max]" value="'.$row['maximo_valor'].'"></td>';
            echo '<td><input type="number" name="valores['.$row['id'].'][min]" value="'.$row['minimo_valor'].'"></td>';
            echo '</tr>';
        }
    ?>
    <tr>    
        <td bgcolor="#EEEEEE" align=center colspan=3> 
            <input type="hidden" name="enviado" value="S1">  
            <input type="submit" value="Actualizar" name="Actualizar">  
        </td>    
    </tr>
</form>    

</table>
</body>
</html>
