<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Obtener los datos del formulario
    $nombre = $_POST['nombre'];
    $apellido = $_POST['apellido'];
    $alias = $_POST['alias'];
    $rut = $_POST['rut'];
    $email = $_POST['email'];
    $region = $_POST['region'];
    $comuna = $_POST['comuna'];
    $candidato = $_POST['candidato'];
    $entero = $_POST['entero'];

    require_once('database/dbconfig.php');

    // Validar los datos (puedes agregar validaciones adicionales aquí)
    if (validarRut($rut) && !existeVotoDuplicado($rut)) {

        // Insertar los datos en la tabla de votantes
        $query = "INSERT INTO votantes (nombre, apellido, alias, rut, email, region, comuna, candidato, entero) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";
        $statement = $conn->prepare($query);
        $statement->bind_param("sssssssss", $nombre, $apellido, $alias, $rut, $email, $region, $comuna, $candidato, implode(",", $entero));
        $statement->execute();

        // Cerrar la conexión a la base de datos
        $statement->close();

        header('Location: index.php');
        exit();
    } else {
        // Rut inválido o voto duplicado
        echo "RUT inválido o voto duplicado.";
    }
    $conn->close();
}


// Función para validar el formato de un RUT chileno
function validarRut($rut) {
    $rut = preg_replace('/[^0-9kK]/', '', $rut);

    if (strlen($rut) < 2) {
        return false;
    }

    $cuerpo = substr($rut, 0, -1);
    $digitoVerificador = strtoupper(substr($rut, -1));

    $suma = 0;
    $multiplo = 2;

    for ($i = strlen($cuerpo) - 1; $i >= 0; $i--) {
        $suma += intval(substr($cuerpo, $i, 1)) * $multiplo;
        $multiplo = $multiplo === 7 ? 2 : $multiplo + 1;
    }

    $resto = $suma % 11;
    $dv = $resto === 0 ? 0 : ($resto === 1 ? 'K' : (11 - $resto));

    return $dv == $digitoVerificador;
}

// Función para verificar si existe un voto duplicado en la base de datos
function existeVotoDuplicado($rut) {
    $host = 'localhost';
    $username = 'root';
    $password = '';
    $database = 'desis_db';

    $conn = new mysqli($host, $username, $password, $database);

    if ($conn->connect_error) {
        die('Error de conexión a la base de datos: ' . $conn->connect_error);
    }

    $query = "SELECT COUNT(*) AS count FROM votantes WHERE rut = ?";
    $statement = $conn->prepare($query);
    $statement->bind_param("s", $rut);
    $statement->execute();
    $result = $statement->get_result();
    $row = $result->fetch_assoc();

    $count = $row['count'];

    // Cerrar la conexión a la base de datos
    $statement->close();
    $conn->close();

    return $count > 0;
}



?>