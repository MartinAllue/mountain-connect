<?php
if (session_status() === PHP_SESSION_NONE) { //Si no se ha hecho el session_start(), lo hace
    session_start();
}

if (!isset($_SESSION['username'])) { //Si no ha iniciado sesión le redirige a iniciar sesión, esto es por sí alguien intenta entrar a una pagina para usuarios registrados con la URL
    header("Location: ../public/login.php");
    exit();
}
?>