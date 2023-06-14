<?php
// Establecer la conexión a la base de datos
require_once('../database/dbconfig.php');

$regionId = $_GET['region'];

// Consulta SQL para obtener las comunas de la región
$sql = "SELECT c.* FROM comunas c
        INNER JOIN provincias p ON c.provincia_id = p.id
        WHERE p.region_id = $regionId";
$result = $conn->query($sql);

// Verificar si se encontraron resultados
if ($result->num_rows > 0) {
    // Crear un arreglo para almacenar las comunas
    $comunas = array();

    // Recorrer los resultados y agregar las comunas al arreglo
    while ($row = $result->fetch_assoc()) {
        $comuna = array(
            "id" => $row["id"],
            "comuna" => $row["comuna"],
            "provincia_id" => $row["provincia_id"]
        );
        $comunas[] = $comuna;
    }

    // Convertir el arreglo de comunas a formato JSON
    $jsonComunas = json_encode($comunas);

    // Mostrar el JSON resultante
    echo $jsonComunas;
} else {
    echo "No se encontraron comunas para la región con ID $regionId.";
}

// Cerrar conexión
$conn->close();
?>