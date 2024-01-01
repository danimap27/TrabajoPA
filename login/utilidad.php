<?php
session_start();
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $filtros = array(
        $_POST['email'] => FILTER_SANITIZE_STRING,
        $_POST['password'] => FILTER_SANITIZE_EMAIL
    );
    $result = filter_input_array(INPUT_POST, $filtros);
    if (array_search(false, $result, true)) {
        $error[] = '<p style="color: red; font-weight: bold" > Te impido una SQLInjection.</p>';
    } else {
        if (!isset($_POST['email']) || $_POST['email'] == '') {
            $error[] = '<p style="color: red; font-weight: bold" > El usuario debe rellenarses.</p>';
        } else {
            $email = $_POST["email"];
            $pattern = '/^([a-z0-9\+_\-]+)(\.[a-z0-9\+_\-]+)*@([a-z0-9\-]+\.)+[a-z]{2,6}$/ix';
            if (!filter_var($email, FILTER_VALIDATE_EMAIL) || !preg_match($pattern, $email)) {
                $error[] = '<p style="color: red; font-weight: bold" > El usuario no es correcto.</p>';
            } else {
                if (!isset($_POST['password']) || $_POST['password'] == '') {
                    $error[] = '<p style="color: red; font-weight: bold"> La contrase&ntilde; debe rellenarse.</p>';
                } else {
                    require 'database.php';
                    $conn = connectToDatabase();
                    $sql = "SELECT contrasenia_hash FROM usuario WHERE correo = '$email'";
                    $result = mysqli_query($conn, $sql);
                    $conn->close();
                    if (mysqli_num_rows($result) > 0) {
                        $hash = mysqli_fetch_assoc($result)["contrasenia_hash"];
                        if (password_verify($_POST["password"], $hash)) {
                            $_SESSION["email"] = $email;
                            header("Location: index.php");
                            exit();
                        } else {
                            $error[] = '<p style="color: red; font-weight: bold"> La combinación de usuario y contrase&ntilde; no es correcta.</p>';
                        }
                    } else {

                    }
                }
            }
        }
    }
}
?>