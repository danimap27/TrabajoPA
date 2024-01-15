<?php
include 'utilidad.php';

if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET["idAgente"])) {
    $idAgente = $_GET["idAgente"];

    $agente = obtenerDatosAgentePorId($idAgente);

    if ($agente) {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $nombre = $_POST["nombre"];
            $apellido = $_POST["apellido"];
            $correo = $_POST["correo"];

            if (validarDatosAgente($nombre, $apellido, $correo)) {
                if (actualizarDatosAgente($idAgente, $nombre, $apellido, $correo)) {
                    echo "Datos del agente actualizados correctamente.";
                    echo '<br><a href="javascript:history.go(-1)">Volver a la página anterior</a>';
                    exit();
                } else {
                    echo "Error al actualizar los datos del agente.";
                }
            } else {
                echo "Error en los datos del formulario.";
            }
        }
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Agente</title>
    <link rel="stylesheet" href="agenteEditar.css">
</head>

<body>
    <div id="agentes-container">
        <h1>Editar Agente</h1>
        
        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"] . "?idAgente=" . $idAgente); ?>">
            <label for="nombre">Nombre:</label>
            <input type="text" id="nombre" name="nombre" value="<?php echo $agente['nombreAgente']; ?>" required>

            <label for="apellido">Apellido:</label>
            <input type="text" id="apellido" name="apellido" value="<?php echo $agente['apellidosAgente']; ?>" required>

            <label for="correo">Correo Electrónico:</label>
            <input type="email" id="correo" name="correo" value="<?php echo $agente['correo']; ?>" required>

            <button type="submit">Guardar Cambios</button>
        </form>

        <a href="javascript:history.go(-1)">Volver a la página anterior</a>
    </div>
</body>

</html>
<?php
    } else {
        echo "No se encontró el agente con el ID proporcionado.";
    }
} else {
    echo "ID de agente no proporcionado.";
}
?>
