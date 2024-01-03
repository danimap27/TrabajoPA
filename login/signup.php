<?php
session_start();
require 'utilidad.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_STRING);
    $password = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_SPECIAL_CHARS);
    $userType = filter_input(INPUT_POST, 'userType', FILTER_SANITIZE_STRING);
    $firstName = filter_input(INPUT_POST, 'firstName', FILTER_SANITIZE_STRING);
    $lastName = filter_input(INPUT_POST, 'lastName', FILTER_SANITIZE_STRING);

    $error = registerUser($email, $password, $userType, $firstName, $lastName);
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="signup.css">
    <title>Registro Gesti&oacute;n de Tickets</title>
</head>

<body>
    <div class="container">
        <form id="signupForm" action="signup.php" method="post">
            <h2>Registro Gesti&oacute;n de Tickets</h2>
            <?php
            if (!empty($error)) {
                foreach ($error as $errorMessage) {
                    echo $errorMessage;
                }
            }
            ?>
            <div class="input-group">
                <label for="email">Correo:</label>
                <input type="text" id="email" name="email" required>
            </div>

            <div class="input-group">
                <label for="password">Contrase&ntilde;a:</label>
                <input type="password" id="password" name="password" required>
            </div>

            <div class="input-group">
                <label for="firstName">Nombre:</label>
                <input type="text" id="firstName" name="firstName" required>
            </div>

            <div class="input-group">
                <label for="lastName">Apellido:</label>
                <input type="text" id="lastName" name="lastName" required>
            </div>

            <div class="input-group">
                <label for="userType">Tipo de usuario:</label>
                <select id="userType" name="userType" required>
                    <option value="agente">Agente</option>
                    <option value="cliente">Cliente</option>
                </select>
            </div>
            
            <button type="submit">Registrarse</button>
        </form>
    </div>
</body>

</html>