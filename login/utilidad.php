<?php
require 'database.php';
function registerUser($email, $password, $userType, $firstName, $lastName)
{
    $error = array();

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error[] = '<p style="color: red; font-weight: bold">El correo electr&oacute;nico no es v&aacute;lido.</p>';
    }

    if (strlen($password) < 6) {
        $error[] = '<p style="color: red; font-weight: bold">La contrase&ntilde;a debe tener al menos 6 caracteres.</p>';
    }

    if ($userType !== 'agente' && $userType !== 'cliente') {
        $error[] = '<p style="color: red; font-weight: bold">El tipo de usuario no es v&aacute;lido.</p>';
    }

    if (!preg_match("/^[a-zA-Z ]+$/", $firstName)) {
        $error[] = '<p style="color: red; font-weight: bold">El nombre no es v&aacute;lido.</p>';
    }

    if (!preg_match("/^[a-zA-Z ]+$/", $lastName)) {
        $error[] = '<p style="color: red; font-weight: bold">El apellido no es v&aacute;lido.</p>';
    }

    if (empty($error)) {
        $conn = connectToDatabase();

        $emailExistsQuery = "SELECT COUNT(*) as count FROM usuario WHERE correo = '$email'";
        $emailExistsResult = $conn->query($emailExistsQuery);
        $emailExistsData = $emailExistsResult->fetch_assoc();

        if ($emailExistsData['count'] > 0) {
            $error[] = '<p style="color: red; font-weight: bold">El correo electr&oacute;nico ya est&aacute; registrado.</p>';
        } else {
            $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

            if ($userType === 'agente') {
                $sql = "INSERT INTO agente (nombreAgente, apellidosAgente) VALUES ('$firstName', '$lastName')";
            } else {
                $sql = "INSERT INTO cliente (nombreCliente, apellidoCliente) VALUES ('$firstName', '$lastName')";
            }

            if ($conn->query($sql)) {
                $lastInsertedId = $conn->insert_id;
                $sql = "INSERT INTO usuario (correo, contrasenia_hash, tipo, idCorrespondiente) VALUES ('$email', '$hashedPassword', '$userType', '$lastInsertedId')";
                $conn->query($sql);
                $error[] = '<p style="color: green; font-weight: bold">Usuario registrado correctamente.</p>';
            } else {
                $error[] = '<p style="color: red; font-weight: bold">Error al registrar el usuario. Por favor, int&eacute;ntalo de nuevo.</p>';
            }
        }

        $conn->close();
    }

    return $error;
}


function loginUser($email, $password)
{
    $error = array();
    if (!$email || !$password) {
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
                    $conn = connectToDatabase();
                    $sql = "SELECT contrasenia_hash, tipo FROM usuario WHERE correo = '$email'";
                    $result = mysqli_query($conn, $sql);
                    $conn->close();
                    if ($result && mysqli_num_rows($result) > 0) {
                        $row = mysqli_fetch_assoc($result);
                        $hash = $row['contrasenia_hash'];
                        $tipo = $row['tipo'];
                        //password_verify($_POST['password'], $hash)
                        if ($_POST['password'] === $hash) {
                            $_SESSION["email"] = $email;
                            if ($tipo === 'cliente') {
                                header("Location: ../Tickets/index.php");
                            } elseif ($tipo === 'agente') {
                                header("Location: ../Agente/index.php");
                            } elseif ($tipo === 'administrador') {
                                header("Location: ../Admin/index.php");
                            } else {
                                header("Location: ../Tickets/index.php");
                            }
                            exit();
                        } else {
                            $error[] = '<p style="color: red; font-weight: bold">La combinación de usuario y contraseña no es correcta.</p>';
                        }
                    } else {
                        $error[] = '<p style="color: red; font-weight: bold">El usuario no existe.</p>';
                    }
                }
            }
        }
    }
    return $error;
}
?>