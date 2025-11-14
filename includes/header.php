<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../assets/css/estilos.css">
    <title>Mountain-connect</title>
</head>
<body>
    <header class="header">
        <div class="container nav">
            <h2 class="logo">MOUNTAIN-CONNECT</h2>
            <nav>
                <ul class="menu">
                    <!-- Mostramos enlace a index.php y enlace a login.php y register.php si no esta logueado -->
                    <?php
                    if(!isset($_SESSION['username'])): 
                    ?>
                    <li><a href="../public/index.php">Inicio</a></li>
                    <li><a href="../public/login.php">Login</a></li>
                    <li><a href="../public/register.php">Registro</a></li>

                    <?php
                    else:
                    ?>
                    <li><a href="../public/index.php">Inicio</a></li>
                    <li><a href="../public/profile.php"><?php echo $_SESSION['username']?></a></li>
                    <li><a href="../public/logout.php">Logout</a></li>

                    <?php endif; ?>
                </ul>
            </nav>
        </div>     
    </header> <!-- No se cierra porque esta enlazado con index.php -->
