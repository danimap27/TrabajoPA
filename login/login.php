<?php
session_start();
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $error = array();

    $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_STRING);
    $password = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_STRING);

    if (empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error[] = '<p style="color: red; font-weight: bold">El usuario no es válido.</p>';
    }

    if (empty($password)) {
        $error[] = '<p style="color: red; font-weight: bold">La contraseña debe rellenarse.</p>';
    }

    if (empty($error)) {
        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "sist_gest_tick_sop";
        $conn = new mysqli($servername, $username, $password, $dbname);

        if ($conn->connect_error) {
            die("Error de conexión: " . $conn->connect_error);
        }

        $sql = "SELECT idUsuario, tipo, contrasenia_hash FROM usuario WHERE email = '$email'";
        $result = mysqli_query($conn, $sql);
        $conn->close();

        if (mysqli_num_rows($result) > 0) {
            $row = mysqli_fetch_assoc($result);

            if (password_verify($password, $row["contrasenia_hash"])) {
                $_SESSION["email"] = $email;

                if ($row["tipo"] === "administrador") {
                    header("Location: adminView.html");
                    exit();
                } elseif ($row["tipo"] === "cliente") {
                    //TODO
                } elseif ($row["tipo"] === "agente") {
                    //TODO
                } else {
                    //TODO
                }
                exit();
            } else {
                $error[] = '<p style="color: red; font-weight: bold">La combinación de usuario y contraseña no es correcta.</p>';
            }
        } else {
            $error[] = '<p style="color: red; font-weight: bold">Usuario no encontrado.</p>';
        }
    }
}

echo json_encode($error);
?>