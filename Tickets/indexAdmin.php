<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gesti&oacute;n de Tickets</title>
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.7/css/jquery.dataTables.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script type="text/javascript" charset="utf8"
        src="https://cdn.datatables.net/1.11.7/js/jquery.dataTables.js"></script>
    <script src="js/tickets.js"></script>
</head>

<body style="background-image: url('https://cdn.wallpapersafari.com/71/50/AQRksF.jpg');">
    <div id="tickets-container">
        <h1>Gesti&oacute;n de Tickets</h1>
        
        <button id="ordenar-titulo">Ordenar por T&iacute;tulo</button>
        <button id="ordenar-prioridad">Ordenar por Prioridad</button>
        <button id="agrupar-cliente">Agrupar por Cliente</button>
        <button id="agrupar-agente">Agrupar por Agente</button>

        <?php
        include 'php/utilidad.php';

        $listaTickets = obtenerListaTickets();

        if (!empty($listaTickets)) {
            echo '<ul id="ticket-list">';
            foreach ($listaTickets as $ticket) {
                echo '<li class="ticket-item">';
                echo '<h3>' . $ticket['nombreTicket'] . '</h3>';
                echo '<p>Descripci&oacute;n: ' . $ticket['descripcionTicket'] . '</p>';
                //Poner el nombre haciendo otra consulta
                echo '<p>Prioridad: ' . $ticket['prioridad'] . '</p>';
                echo '<p>Estado: ' . $ticket['estado'] . '</p>';
                //mostraCliente($ticket['cliente']);
                //mostraAgente($ticket['agente']);
                echo '<p>Fecha: ' . $ticket['fechaRegistro'] . '</p>';
                echo '<button class="edit-button">Editar</button>';
                echo '<button class="delete-button">Eliminar</button>';
                echo '</li>';
            }
            echo '</ul>';
        } else {
            echo '<p>No hay tickets</p>';
        }
        ?>
    </div>
</body>

</html>