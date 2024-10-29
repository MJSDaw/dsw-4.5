<?php
    require_once 'db.php';

    // Definimos usuarios y contraseñas válidos
    $usuarios = ['admin' => 'admin', 'moises' => '1234'];
    $roles = ['admin' => 'admin', 'moises' => 'user'];

    if (!isset($_COOKIE['espera'])) {
        // Si no hay cookie de intentos, se inicializa con 3
        if (!isset($_COOKIE['intentos'])) {
            setcookie('intentos', 3, time() + 3600); // Cookie de 1 hora de duración
            $intentos = 3; // Inicializamos la variable de intentos
        } else {
            $intentos = $_COOKIE['intentos']; // Leemos la cookie si existe
        }

        // Verificación de credenciales
        if (isset($_POST['nombreUsuario']) && isset($_POST['password'])) {
            if (array_key_exists($_POST['nombreUsuario'], $usuarios)) {

                $query = 'SELECT pass from usuarios where usuario = :userName';
                $stmt = $pdo->prepare($query);
                $stmt->bindParam(':userName', $_POST['nombreUsuario'], PDO::PARAM_STR);
                $stmt->execute();
                $result = $stmt->fetch(PDO::FETCH_ASSOC);

                if (password_verify($_POST['password'], $result['pass'])) {
                    // Credenciales correctas, redirigimos a dentro.php
                    setcookie('intentos', '', time() - 1); // Borramos la cookie de intentos
                    // Generación de sesion
                    session_start();
                    $_SESSION['iniciado'] = true;
                    $_SESSION['nombre'] = $_POST['nombreUsuario'];
                    $_SESSION['rol'] = $roles[$_POST['nombreUsuario']];
                    header('Location: dentro.php');
                } else {
                    // Contraseña incorrecta, reducimos intentos
                    $intentos--;
                    setcookie('intentos', $intentos, time() + 3600); // Actualizamos la cookie
                    header('Location: index.php');
                }
            } else {
                // Usuario no encontrado, reducimos intentos
                $intentos--;
                setcookie('intentos', $intentos, time() + 3600); // Actualizamos la cookie
                header('Location: index.php');
            }
        }

        // Si el número de intentos llega a 0, redirige a fuera.php
        if ($intentos <= 0) {
            setcookie('intentos', 0, time() - 1); // Borramos la cookie de intentos
            setcookie('espera', 0, time() + 60); // Establecemos la cookie de espera
            header('Location: fuera.php');
        }
    }
?>
