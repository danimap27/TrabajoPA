<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Verificar si la opción está presente en la solicitud POST
    if (isset($_POST["opcion"])) {
        $opcion = $_POST["opcion"];

        // Procesar la opción según el valor recibido
        switch ($opcion) {
            case "dar_de_baja":
                // Lógica para dar de baja
                echo "Has seleccionado dar de baja.";
                break;

            case "dar_de_alta":
                // Lógica para dar de alta
                echo "Has seleccionado dar de alta.";
                break;

            case "modificar_datos":
                // Lógica para modificar datos
                echo "Has seleccionado modificar datos.";
                break;

            default:
                echo "Opción no válida.";
                break;
        }
    } else {
        echo "Opción no especificada.";
    }
} else {
    echo "Acceso no permitido.";
}

?>
