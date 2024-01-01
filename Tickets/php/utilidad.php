<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "sist_gest_tick_sop";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

function crearTicket($titulo, $descripcion, $prioridad, $estado, $cliente, $agente) {
    global $conn;

    $prioridad = filter_var($prioridad, FILTER_VALIDATE_INT);
    $estado = filter_var($estado, FILTER_VALIDATE_INT);

    $stmt = $conn->prepare("INSERT INTO ticket (nombreTicket, descripcionTicket, prioridad, estado, fk_idCliente, fk_idAgente, fechaRegistro) VALUES (?, ?, ?, ?, ?, ?, NOW())");
    $stmt->bind_param("ssiiii", $titulo, $descripcion, $prioridad, $estado, $cliente, $agente);

    if ($stmt->execute()) {
        $stmt->close();
        return true;
    } else {
        echo "Error al ejecutar la consulta: " . $stmt->error;
        $stmt->close();
        return false;
    }
}

function obtenerListaTickets() {
    global $conn;
    $sql = "SELECT * FROM ticket ORDER BY nombreTicket";
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
