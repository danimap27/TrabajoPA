<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title></title>
    <link rel="stylesheet" type="text/css" href="clientecss.css">
</head>
<body style="background-image: url('https://cdn.wallpapersafari.com/71/50/AQRksF.jpg');">

<?php
include('Tickets/php/utilidad.php');

if (isset($_POST['obtener_tickets'])) {
    $tickets = obtenerListaTickets();
    echo '<h2>Lista de Tickets:</h2>';
    echo '<ul>';
    foreach ($tickets as $ticket) {
        echo '<li>' . $ticket . '</li>';
    }
    echo '</ul>';
}
?>

<form method="post" action="">
    <input type="submit" name="obtener_tickets" value="Obtener Lista de Tickets">
</form>

</body>
</html>
