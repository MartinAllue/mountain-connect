<?php
require_once "../includes/auth_check.php"; // Con esto se hace la protección de la página del perfil
?>

<!DOCTYPE html>
<html>
    <head>
        <title>Perfil</title>
        <link rel="stylesheet" href="../assets/css/estilos.css">
    </head>
    <body>
        <div class="profile-container">
            <h1>Bienvenido <?php echo htmlspecialchars($_SESSION["username"]); //Mostramos el nombre de usuario?></h1>
            <p>Iniciaste sesión a las: <?php echo date("H:i:s", $_SESSION["login_time"]); // Mostramos el tiempo en el que inició la sesión
            ?></p>
            <a href="logout.php">Cerrar Sesión</a>
        </div>
    </body>
</html>