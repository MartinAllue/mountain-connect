<?php 
function validarEmail($email) {
    // Elimina espacios laterales
    $email = trim($email);

    // Verifica que tenga formato válido
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        return false;
    }

    return true;
}

function verificarSesionActiva() {
    // Si no hay sesión iniciada, iniciar comprobación
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }

    // Verificar si existe una variable de sesión clave
    if (!isset($_SESSION['username'])) {
        // No hay sesión: redireccionar o devolver false
        return false;
    }

    return true;
}

?>