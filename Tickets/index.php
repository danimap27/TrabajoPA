<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Gesti&oacute;n de Tickets</title>
        <link rel="stylesheet" href="scss/style.css">
        <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.7/css/jquery.dataTables.css">
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.11.7/js/jquery.dataTables.js"></script>
        <script src="js/tickets.js"></script>
    </head>
    <body>
        <div id="tickets-container">
            <h1>Gesti&oacute;n de Tickets</h1>
            <form id="ticket-form">
                <label for="titulo">T&iacute;tulo:</label>
                <input type="text" id="titulo" name="titulo" required>

                <label for="descripcion">Descripci&oacute;n:</label>
                <textarea id="descripcion" name="descripcion" required></textarea>

                <label for="prioridad">Prioridad:</label>
                <select id="prioridad" name="prioridad">
                    <option value="alta">Alta</option>
                    <option value="media">Media</option>
                    <option value="baja">Baja</option>
                </select>

                <label for="estado">Estado:</label>
                <select id="estado" name="estado">
                    <option value="abierto">Abierto</option>
                    <option value="en_progreso">En progreso</option>
                    <option value="cerrado">Cerrado</option>
                </select>

                <label for="cliente">Cliente:</label>
                <input type="text" id="cliente" name="cliente" required>

                <label for="agente">Agente asignado:</label>
                <input type="text" id="agente" name="agente" required>

                <label for="fecha">Fecha:</label>
                <input type="date" id="fecha" name="fecha" required>

                <button type="submit" id="crear-ticket">Crear Ticket</button>
            </form>

            <button id="ordenar-nombre">Ordenar por Nombre</button>
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
                    echo '<h3>' . $ticket['nombre'] . '</h3>';
                    echo '<p>Descripci&oacute;n: ' . $ticket['descripcion'] . '</p>';
                    echo '<p>Prioridad: ' . $ticket['prioridad'] . '</p>';
                    echo '<p>Estado: ' . $ticket['estado'] . '</p>';
                    echo '<p>Cliente: ' . $ticket['cliente'] . '</p>';
                    echo '<p>Agente asignado: ' . $ticket['agente'] . '</p>';
                    echo '<button class="edit-button">Editar</button>';
                    echo '<button class="delete-button">Eliminar</button>';
                    echo '</li>';
                }
                echo '</ul>';
            } else {
                echo 'No hay tickets';
            }
            ?>
        </div>
    </body>
</html>


