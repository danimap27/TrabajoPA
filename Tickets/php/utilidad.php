<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "soporte";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

function crearTicket($titulo, $descripcion, $prioridad, $estado, $cliente, $agente) {
    global $conn;
    
    // Prevenir inyección SQL utilizando declaraciones preparadas
    $stmt = $conn->prepare("INSERT INTO tickets (titulo, descripcion, prioridad, estado, cliente, agente, fecha) VALUES (?, ?, ?, ?, ?, ?, NOW())");
    $stmt->bind_param("sssss", $titulo, $descripcion, $prioridad, $estado, $cliente, $agente);
    if (!$stmt->execute()) {
        echo "Error al ejecutar la consulta: " . $stmt->error;
    }

    if ($stmt->execute()) {
        $stmt->close();
        return true;
    } else {
        $stmt->close();
        return false;
    }
}

function obtenerListaTickets() {
    global $conn;
    $sql = "SELECT * FROM tickets ORDER BY titulo";
    $result = $conn->query($sql);

    $tickets = [];

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $tickets[] = $row;
        }
    }
    return $tickets;
}

?>