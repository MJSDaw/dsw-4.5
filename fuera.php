<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Muchos intentos!</title>
</head>
<body>
    <h1>Has perdido los intentos totales.</h1>
</body>
</html>

<?php
    if(isset($_COOKIE['espera'])){
        echo 'Debes esperar 1 minuto para volver a intentarlo.';
    } else {
        header('Location: index.php');
    }
?>