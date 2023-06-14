<?php
// Establecer la conexión a la base de datos
require_once('../database/dbconfig.php');

// Consulta SQL para obtener las regiones
$sql = "SELECT * FROM candidatos";
$result = $conn->query($sql);

// Verificar si se encontraron resultados
if ($result->num_rows > 0) {
    // Crear un arreglo para almacenar las regiones
    $regiones = array();

    // Recorrer los resultados y agregar las regiones al arreglo
    while ($row = $result->fetch_assoc()) {
        $region = array(
            "id" => $row["id"],
            "nombre" => $row["nombre"]
        );
        $regiones[] = $region;
    }

    // Convertir el arreglo de regiones a formato JSON
    $jsonRegiones = json_encode($regiones);

    // Mostrar el JSON resultante
    echo $jsonRegiones;
} else {
    echo "No se encontraron regiones.";
}

// Cerrar conexión
$conn->close();
?>