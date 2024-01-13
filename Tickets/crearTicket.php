<?php
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["crear-ticket"])) {
    $filtros = array(
        $_POST['titulo'] => FILTER_SANITIZE_STRING,
        $_POST['descripcion'] => FILTER_SANITIZE_STRING,
        $_POST['prioridad'] => FILTER_SANITIZE_STRING,
        $_POST['estado'] => FILTER_SANITIZE_STRING,
        $_POST['cliente'] => FILTER_SANITIZE_STRING,
        $_POST['agente'] => FILTER_SANITIZE_STRING
    );
    header("Location: crearTicket.php");

    $datosFiltrados = filter_input_array(INPUT_POST, $filtros);

    if (in_array(false, $datosFiltrados, true)) {
        echo "Error en los datos del formulario.";
    } else {
        // Verificar que todos los campos requeridos estén presentes
        $camposRequeridos = array('titulo', 'descripcion', 'prioridad', 'estado', 'cliente', 'agente');
        $errores = array();

        foreach ($camposRequeridos as $campo) {
            if (!isset($datosFiltrados[$campo]) || empty($datosFiltrados[$campo])) {
                $errores[] = "El campo '$campo' es obligatorio.";
            }
        }

        if (!empty($errores)) {
            echo "Errores encontrados:<br>";
            foreach ($errores as $error) {
                echo "- $error<br>";
            }
        } else {
            include 'php/utilidad.php';

            if (crearTicket(
                            $datosFiltrados['titulo'],
                            $datosFiltrados['descripcion'],
                            $datosFiltrados['prioridad'],
                            $datosFiltrados['estado'],
                            $datosFiltrados['cliente'],
                            $datosFiltrados['agente']
                    )) {
                echo "Ticket creado con éxito.";
            } else {
                echo "Error al crear el ticket.";
            }
        }
    }
}
?>
<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Gesti&oacute;n de Tickets</title>
        <link rel="stylesheet" href="css/style.css">
        <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.7/css/jquery.dataTables.css">
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.11.7/js/jquery.dataTables.js"></script>
        <script src="js/tickets.js"></script>
    </head>
    <body style="background-image: url('https://cdn.wallpapersafari.com/71/50/AQRksF.jpg');">
        <div id="tickets-container">
            <h1>Gesti&oacute;n de Tickets</h1>
            <form id="ticket-form" action="indexAdmin.php" method="post">
                <label for="titulo">T&iacute;tulo:</label>
                <input type="text" id="titulo" name="titulo" required>

                <label for="descripcion">Descripci&oacute;n:</label>
                <textarea id="descripcion" name="descripcion" required></textarea>

                <label for="prioridad">Prioridad:</label>
                <select id="prioridad" name="prioridad">
                    <option value="2">Alta</option>
                    <option value="1">Media</option>
                    <option value="0">Baja</option>
                </select>

                <label for="estado">Estado:</label>
                <select id="estado" name="estado">
                    <option value="2">Abierto</option>
                    <option value="1">En progreso</option>
                    <option value="0">Cerrado</option>
                </select>

                <label for="cliente">Cliente:</label>
                <input type="number" id="cliente" name="cliente" required>

                <label for="agente">Agente asignado:</label>
                <input type="number" id="agente" name="agente" required>

                <button type="submit" id="crear-ticket">Crear Ticket</button>
            </form>
    </body>
</html>