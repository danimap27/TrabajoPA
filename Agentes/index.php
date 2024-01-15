<?php
include 'utilidad.php';

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["actualizar-ticket"])) {
    $idTicket = $_POST["idTicket"];
    $nuevaPrioridad = $_POST["nuevaPrioridad"];
    $nuevoEstado = $_POST["nuevoEstado"];

    if (actualizarPrioridadYEstado($idTicket, $nuevaPrioridad, $nuevoEstado)) {
        echo "Ticket actualizado correctamente.";
    } else {
        echo "Error al actualizar el ticket.";
    }
}
$agenteId = obtenerIdAgenteDesdeSesion();

$clientes = obtenerClientesDeAgente($agenteId);

?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panel del Agente</title>
</head>

<body>
    <h1>Clientes y Tickets</h1>

    <?php foreach ($clientes as $cliente) : ?>
        <div class="cliente">
            <h2><?= $cliente['nombreCliente'] . ' ' . $cliente['apellidoCliente']; ?></h2>

            <?php $tickets = obtenerTicketsDeCliente($cliente['idCliente']); ?>
            <ul class="tickets">
                <?php foreach ($tickets as $ticket) : ?>
                    <li>
                        <p><?= $ticket['nombreTicket']; ?></p>
                        <p><?= $ticket['descripcionTicket']; ?></p>
                        <p>Prioridad: <?= $ticket['prioridad']; ?></p>
                        <p>Estado: <?= $ticket['estado']; ?></p>
                        <form method="post">
                            <input type="hidden" name="ticketId" value="<?= $ticket['idTicket']; ?>">
                            <select name="prioridad">
                                <option value="Alta">Alta</option>
                                <option value="Media">Media</option>
                                <option value="Baja">Baja</option>
                            </select>
                            <select name="estado">
                                <option value="Abierto">Abierto</option>
                                <option value="En progreso">En progreso</option>
                                <option value="Cerrado">Cerrado</option>
                            </select>
                            <button type="submit">Actualizar</button>
                        </form>
                    </li>
                <?php endforeach; ?>
            </ul>
        </div>
    <?php endforeach; ?>
</body>
</html>

