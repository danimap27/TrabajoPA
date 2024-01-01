<?php
session_start();
$response = array();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $error = array();

    $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_STRING);
    $password = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_STRING);

    if (empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error[] = 'El usuario no es válido.';
    }

    if (empty($password)) {
        $error[] = 'La contraseña debe rellenarse.';
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

        $sql = "SELECT idUsuario, tipo, contrasenia_hash FROM usuario WHERE correo = '$email'";
        $result = mysqli_query($conn, $sql);
        $conn->close();

        if (mysqli_num_rows($result) > 0) {
            $row = mysqli_fetch_assoc($result);

            if (password_verify($password, $row["contrasenia_hash"])) {
                $_SESSION["email"] = $email;
                $response['success'] = true;
                $response['redirect'] = ($row["tipo"] === "administrador") ? 'adminView.html' : '';
                exit(json_encode($response));
            } else {
                $error[] = 'La combinación de usuario y contraseña no es correcta.';
            }
        } else {
            $error[] = 'Usuario no encontrado.';
        }
    }

    // Agrega los errores a la respuesta
    $response['success'] = false;
    $response['errors'] = $error;
    exit(json_encode($response));
}

// En caso de que alguien acceda directamente a login.php sin un formulario POST
header("Location: ../login.html");
exit();
?>

