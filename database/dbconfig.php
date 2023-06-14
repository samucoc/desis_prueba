<?php
$host = 'localhost';
$username = 'root';
$password = '';
$database = 'desis_db';

$conn = new mysqli($host, $username, $password, $database);

if ($conn->connect_error) {
    die('Error de conexión a la base de datos: ' . $conn->connect_error);
}
?>