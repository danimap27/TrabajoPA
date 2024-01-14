<?php

function conectarDB() {
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "sist_gest_tick_sop";


    $conn = new mysqli($servername, $username, $password, $dbname);

    
    if ($conn->connect_error) {
        die("Conexión fallida: " . $conn->connect_error);
    }

    return $conn;
}

function darBaja($nombre, $apellido, $dni) {
    $conn = conectarDB();

    
    $sql = "DELETE FROM clientes WHERE idCliente = '$dni'";
    
    if ($conn->query($sql) === TRUE) {
        echo "Cliente dado de baja exitosamente.";
    } else {
        echo "Error al dar de baja al cliente: " . $conn->error;
    }

    $conn->close();
}

function darAlta($nombre, $apellido, $dni, $idAgente) {
    $conn = conectarDB();

    
    $sql = "INSERT INTO clientes (idCliente, nombreCliente, apellidoCliente, id_agente) VALUES ('$dni', '$nombre', '$apellido', '$idAgente')";
    
    if ($conn->query($sql) === TRUE) {
        echo "Cliente dado de alta exitosamente.";
    } else {
        echo "Error al dar de alta al cliente: " . $conn->error;
    }

    $conn->close();
}

function modificarDatos($nombre, $apellido, $id_agente) {
    $conn = conectarDB();

    
    $sql = "UPDATE clientes SET nombreCliente='$nombre', apellidoCliente='$apellido' WHERE id_agente='$id_agente'";
    
    if ($conn->query($sql) === TRUE) {
        echo "Datos del cliente modificados exitosamente.";
    } else {
        echo "Error al modificar los datos del cliente: " . $conn->error;
    }

    $conn->close();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST["opcion"])) {
        $opcion = $_POST["opcion"];

        if (isset($_POST["nombre"]) && isset($_POST["apellido"]) && isset($_POST["dni"]) && isset($_POST["idAgente"])) {
            $nombre = $_POST["nombre"];
            $apellido = $_POST["apellido"];
            $dni = $_POST["dni"];

            switch ($opcion) {
                case "dar_de_baja":
                    darBaja($nombre, $apellido, $dni);
                    break;

                case "dar_de_alta":
                    darAlta($nombre, $apellido, $dni, $id_agente);
                    break;

                case "modificar_datos":
                    modificarDatos($nombre, $apellido, $id_agente);
                    break;

                default:
                    echo "Opción no válida.";
                    break;
            }
        } else {
            echo "Por favor, complete todos los campos del formulario.";
        }
    } else {
        echo "Opción no especificada.";
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulario de Opciones</title>
    <link rel="stylesheet" type="text/css" href="estilos.css">
</head>
<body>

    <h2>Seleccione una opción:</h2>

    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
        <label for="nombre">Nombre:</label>
        <input type="text" name="nombre" required>

        <label for="apellido">Apellido:</label>
        <input type="text" name="apellido" required>

        <label for="dni">DNI:</label>
        <input type="text" name="dni" required>

        <label for="idAgente">ID del agente asociado:</label>
        <input type="text" name="idAgente" required>

        <button type="submit" name="opcion" value="dar_de_baja">Dar de baja</button>
        <button type="submit" name="opcion" value="dar_de_alta">Dar de alta</button>
        <button type="submit" name="opcion" value="modificar_datos">Modificar datos</button>
    </form>

</body>
</html>
