<?php
session_start();
require 'utilidad.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_STRING);
    $password = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_SPECIAL_CHARS);
    $error = loginUser($email, $password);
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="login.css">
    <title>Login Gesti&oacute;n de Tickets</title>
</head>

<body>
    <div class="container">
        <form id="loginForm" action="login.php" method="post">
            <h2>Login Gesti&oacute;n de Tickets</h2>
            <?php
            if (!empty($error)) {
                foreach ($error as $errorMessage) {
                    echo $errorMessage;
                }
            }
            ?>
            <div class="input-group">
                <label for="username">Correo:</label>
                <input type="text" id="username" name="email" required>
            </div>
            <input type="hidden" name="type" value="administrador">
            <div class="input-group">
                <label for="password">Contrase&ntilde;a:</label>
                <input type="password" id="password" name="password" required>
            </div>
            <input type="hidden" name="type" value="administrador">
            <button type="submit">Login</button>
        </form>
        <form id="registro" action="signup.php">
            <button type="submit">Registrarse</button>
        </form>
    </div>
</body>

</html>