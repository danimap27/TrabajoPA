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
    $sql = "DELETE FROM usuario WHERE idCorrespondiente = $idAgente";
    $result = $conn->query($sql);
    $conn->close();

    return $result;
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

?>
