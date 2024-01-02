<?php
require 'utilidad.php';
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
            if (isset($error)) {
                foreach ($error as $e) {
                    echo $e . '<br>';
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
    </div>
</body>
</html>