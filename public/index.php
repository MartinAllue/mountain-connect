<?php
    include_once __DIR__ . '/../includes/header.php'; // Aqui arriba lo unimos con el header.php y por eso no hace falta poner la etiqueta de HTML
?>
<section class="hero">
        <div class="container">
        <h1>Bienvenido a MOUNTAIN-CONNECT</h1>
        <h2>Tú pagina de montaña de confianza</h2><br><br>
        <p>En esta página web podrás encontrar las mejores rutas de senderismo registradas y probadas por otros usuarios.</p>
        <p>Podrás encontrar la ruta que quieras no solo por el nombre, también podrás buscar rutas adaptadas a tu nivel, distancia que quieras o desnivel, 
            duración de la ruta y una descripción en la que otras personas compartiran su experiencia haciendo la ruta.
        </p>
        <a href="#">Volver al inicio</a>
</section>

<section class="acciones">
    <div class="container">
        <h2>Explora y comparte rutas</h2>
        <p>Accede a las rutas creadas por otros usuarios o comparte tus propias experiencias.</p>

        <div class="botones-acciones">
            <a class="btn" href="routes/list.php">Ver rutas creadas</a>
            <a class="btn" href="routes/create.php">Crear nueva ruta</a>
        </div>
    </div>
</section>

<?php
    include_once __DIR__ . '/../includes/footer.php'; //Como ponemos el footer.php aqui abajo no hace falta cerrar el html
?>