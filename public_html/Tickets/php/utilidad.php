<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "sistema de tickets de soporte";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

function obtenerListaTickets() {
    global $conn;
    $sql = "SELECT * FROM tickets ORDER BY Nombre";
    $result = $conn->query($sql);

    $tickets = [];

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $tickets[] = $row;
        }
    }
    $conn->close();
    return $tickets;
}

?>
