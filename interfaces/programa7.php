<?php
include "conexion.php";  // Conexión tiene la información sobre la conexión de la base de datos.

if(isset($_POST["consultar"])) {
    $fecha_ini = $_POST["fecha_ini"];
    $fecha_fin = $_POST["fecha_fin"];
    $mysqli = new mysqli($host, $user, $pw, $db);

    // Consulta los eventos registrados entre las fechas especificadas
    $sql = "SELECT * FROM registro_eventos WHERE fecha BETWEEN '$fecha_ini' AND '$fecha_fin'";
    $result = $mysqli->query($sql);
} else {
    // Si no se ha enviado el formulario, muestra todos los eventos registrados
    $mysqli = new mysqli($host, $user, $pw, $db);
    $sql = "SELECT * FROM registro_eventos";
    $result = $mysqli->query($sql);
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Consulta de Eventos Registrados</title>
</head>
<body>
    <h1>Consulta de Eventos Registrados</h1>
    <form method="POST" action="">
        <label for="fecha_ini">Fecha Inicial:</label>
        <input type="date" id="fecha_ini" name="fecha_ini" required>
        <label for="fecha_fin">Fecha Final:</label>
        <input type="date" id="fecha_fin" name="fecha_fin" required>
        <input type="submit" name="consultar" value="Consultar">
    </form>
    <br>
    <table border="1">
        <tr>
            <th>#</th>
            <th>Fecha</th>
            <th>Hora</th>
            <th>Evento</th>
        </tr>
        <?php
        $contador = 0;
        while ($row = $result->fetch_assoc()) {
            $contador++;
            $id_evento = $row['id_evento'];
            // Consulta el nombre del evento
            $sql_evento = "SELECT nombre_evento FROM eventos WHERE id_evento = $id_evento";
            $result_evento = $mysqli->query($sql_evento);
            $row_evento = $result_evento->fetch_assoc();
            echo "<tr>";
            echo "<td>" . $contador . "</td>";
            echo "<td>" . $row['fecha'] . "</td>";
            echo "<td>" . $row['hora'] . "</td>";
            echo "<td>" . $row_evento['nombre_evento'] . "</td>";
            echo "</tr>";
        }
        ?>
    </table>
</body>
</html>
