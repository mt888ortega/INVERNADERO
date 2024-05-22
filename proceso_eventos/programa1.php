<?php
include "conexion.php";  // La conexión contiene la información sobre la conexión a la base de datos.

// Se obtienen los datos de humedad, temperatura, iluminación y temperatura del suelo enviados como parámetros en la solicitud GET.
$hum = $_GET["humedad"]; 
$temp = $_GET["temperatura"]; 
$ilum = $_GET["iluminacion"];
$temps = $_GET["temperatura_suelo"];
$id_tarj = $_GET["ID_TARJ"];

// Creación de una nueva instancia de mysqli para la conexión a la base de datos.
$mysqli = new mysqli($host, $user, $pw, $db);

// Se prepara la consulta SQL para insertar los datos recibidos en la tabla 'datos_medidos'.
$sql1 = "INSERT INTO datos_medidos (ID_TARJ, fecha, hora, temperatura, humedad_aire, humedad_tierra, iluminacion) 
         VALUES ('$id_tarj', CURDATE(), CURTIME(), '$temp', '$hum', '$temps', '$ilum')";

// Se ejecuta la consulta SQL.
$result1 = $mysqli->query($sql1);

// Se imprime la cadena SQL enviada a la base de datos y el resultado de la operación.
echo "Consulta SQL: " . $sql1 . "<br>";
echo "Resultado de la consulta: " . $result1;

// Si result es 1, significa que la inserción en la base de datos fue exitosa.
?>
