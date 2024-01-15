<?php
include 'utilidad.php';

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["delete-agente"])) {
    $idAgente = $_POST["idAgente"];

    if (eliminarAgente($idAgente)) {
        echo "Agente eliminado correctamente.";
    } else {
        echo "Error al eliminar el agente.";
    }
}

$agentes = obtenerListaAgentes();
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Administraci&oacute;n de Agentes</title>
    <link rel="stylesheet" href="agentes.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.7/css/jquery.dataTables.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script type="text/javascript" charset="utf8"
        src="https://cdn.datatables.net/1.11.7/js/jquery.dataTables.js"></script>
    <script src="js/agentes.js"></script>
</head>

<body>
    <div id="agentes-container">
        <h1>Administraci&oacute;n de Agentes</h1>

        <?php
        $listaAgentes = obtenerListaAgentes();

        if (!empty($listaAgentes)) {
            echo '<table id="agente-list">';
            echo '<thead>';
            echo '<tr>';
            echo '<th>Nombre</th>';
            echo '<th>Apellido</th>';
            echo '<th>Correo Electronico</th>';
            echo '<th>Acciones</th>';
            echo '</tr>';
            echo '</thead>';
            echo '<tbody>';

            foreach ($listaAgentes as $agente) {
                echo '<tr>';
                echo '<td>' . $agente['nombreAgente'] . '</td>';
                echo '<td>' . $agente['apellidosAgente'] . '</td>';
                echo '<td>' . $agente['correo'] . '</td>';
                echo '<td>';
                echo '<form method="get" action="agenteEditar.php">
                <input type="hidden" name="idAgente" value="' . $agente['idAgente'] . '";>
                <button class="edit-button" type="submit">Editar</button>
            </form>';
                echo '<form method="post" action="">';
                echo '<input type="hidden" name="idAgente" value="' . $agente['idAgente'] . '">';
                echo '<button class="delete-button" type="submit" name="eliminar-agente">Eliminar</button>';
                echo '</form>';
                echo '</td>';
                echo '</tr>';
            }

            echo '</tbody>';
            echo '</table>';
        } else {
            echo '<p>No hay agentes registrados</p>';
        }
        ?>
    </div>
</body>

</html>