<?php
include '../login/database.php';
function obtenerListaAgentes()
{
    $conn = connectToDatabase();

    $sql = "SELECT agente.idAgente, usuario.correo, agente.nombreAgente, agente.apellidosAgente
            FROM usuario
            INNER JOIN agente ON usuario.idCorrespondiente = agente.idAgente";

    $result = $conn->query($sql);

    $agentes = array();

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $agentes[] = $row;
        }
    }

    $conn->close();

    return $agentes;
}

function eliminarAgente($idAgente)
{
    $conn = connectToDatabase();

    $sql = "DELETE FROM agente WHERE idAgente = $idAgente";
    $result = $conn->query($sql);

    if ($result) {
        $sqlUsuario = "DELETE FROM usuario WHERE idCorrespondiente = $idAgente";
        $resultUsuario = $conn->query($sqlUsuario);

        if (!$resultUsuario) {
            echo "Error al eliminar el usuario: " . $conn->error;
        }
    } else {
        echo "Error al eliminar el agente: " . $conn->error;
    }

    $conn->close();

    return $result && $resultUsuario;
}

function obtenerDatosAgentePorId($idAgente) {
    $conn = connectToDatabase();

    $sql = "SELECT agente.idAgente, usuario.correo, agente.nombreAgente, agente.apellidosAgente
    FROM usuario
    INNER JOIN agente ON usuario.idCorrespondiente = agente.idAgente";
    $result = $conn->query($sql);

    if ($result && $result->num_rows > 0) {
        $agente = $result->fetch_assoc();
        $conn->close();
        return $agente;
    } else {
        $conn->close();
        return null;
    }
}
function validarDatosAgente($nombre, $apellido, $correo) {
    return !empty($nombre) && !empty($apellido) && filter_var($correo, FILTER_VALIDATE_EMAIL);
}

function actualizarDatosAgente($idAgente, $nombre, $apellido, $correo) {
    $conn = connectToDatabase();

    $sql = "UPDATE agente SET nombreAgente = '$nombre', apellidosAgente = '$apellido' WHERE idAgente = $idAgente";
    $result = $conn->query($sql);

    if ($result) {
        $sqlUsuario = "UPDATE usuario SET correo = '$correo' WHERE idCorrespondiente = $idAgente";
        $resultUsuario = $conn->query($sqlUsuario);

        $conn->close();
        return $resultUsuario;
    } else {
        $conn->close();
        return false;
    }
}

function obtenerIdAgenteDesdeSesion() {
    if (session_status() == PHP_SESSION_NONE) {
        session_start();
    }

    if (isset($_SESSION['correo'])) {
        $correoAgente = $_SESSION['correo'];

        $idAgente = obtenerIdAgenteDesdeCorreo($correoAgente);

        return $idAgente;
    }
    return null;
}

function obtenerIdAgenteDesdeCorreo($correoAgente) {
    $conn = connectToDatabase();

    $sql = "SELECT idAgente FROM agente WHERE correo = '$correoAgente'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $idAgente = $row['idAgente'];
        return $idAgente;
    }

    return null;
}

function obtenerClientesDeAgente($agenteId) {
    $conn = connectToDatabase();

    $sql = "SELECT * FROM cliente WHERE id_agente = $agenteId";
    $result = $conn->query($sql);

    $clientes = array();

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $clientes[] = $row;
        }
    }

    $conn->close();
    return $clientes;
}

function obtenerTicketsDeCliente($clienteId) {
    $conn = connectToDatabase();

    $sql = "SELECT * FROM ticket WHERE fk_idCliente = $clienteId";
    $result = $conn->query($sql);

    $tickets = array();

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $tickets[] = $row;
        }
    }

    $conn->close();
    return $tickets;
}

function actualizarPrioridadYEstado($ticketId, $prioridad, $estado) {
    $conn = connectToDatabase();

    $sql = "UPDATE ticket SET prioridad = '$prioridad', estado = '$estado' WHERE idTicket = $ticketId";
    $result = $conn->query($sql);

    $conn->close();
    return $result;
}
?>
