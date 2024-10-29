<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Autenticación Básica</title>
</head>
<body>
    <form action="logica.php" method="POST">
        <label for="nombreUsuario">Nombre de usuario: </label>
        <input type="text" name="nombreUsuario" id="nombreUsuario" required><br><br>
        <label for="password">Contraseña: </label>
        <input type="password" name="password" id="password" required><br><br>
        <input type="submit" value="Iniciar sesión"><br><br>
    </form>
    <?php
        if (isset($_COOKIE['intentos'])){
            $intentos = $_COOKIE['intentos'];
            echo "Tienes $intentos intentos";
        } else {
            echo "Tienes 3 intentos";
        }
    ?>
</body>
</html>

