<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bienvenido</title>
</head>
<body>
    <h1>Bienvenido</h1> <br> <br>
    <?php
        session_start();
        if($_SESSION['rol'] == 'admin'){
           echo '<a href="soloAdmin.php">Gestion de administración</a> <br><br>';
        }

        if (isset($_POST['cerrarSesion'])){
            setcookie('sesion', '', time() - 1);
            session_destroy();
        }
        
        if (!isset($_SESSION['iniciado'])){
            header('Location: index.php');
        }

        echo "<form method='POST'><button name='cerrarSesion'>Cerrar sesión</button></form>";
    ?>
</body>
</html>