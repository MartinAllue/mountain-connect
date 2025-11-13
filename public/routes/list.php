<?php
if (session_status() === PHP_SESSION_NONE) { 
    session_start();
}

$rutas = isset($_SESSION['rutas']) ? $_SESSION['rutas'] : [];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../assets/css/estilos.css">
    <title>Lista rutas</title>
</head>
<body>
    <div class="acciones">
        <a href="create.php" class="btn btn-crear">Crear nueva ruta</a>
    </div>

    <h1 style="text-align: center;">Listado de Rutas</h1>

    <?php if (empty($rutas)): ?>
        <div class="sin-rutas">
            <h2>No hay rutas creadas</h2>
            <p>¡Comienza creando tu primera ruta!</p>
        </div>
    <?php else: ?>
        <div class="rutas-container">
            <?php foreach ($rutas as $index => $ruta): ?>
                <div class="ruta-card">
                    <div class="ruta-imagenes">
                        <?php if (!empty($ruta['imagenes'])): ?>
                            <?php foreach ($ruta['imagenes'] as $imagen): ?>
                                <img src="<?php echo htmlspecialchars($imagen); ?>" alt="Imagen de ruta" class="ruta-miniatura" onerror="this.style.display='none'">
                            <?php endforeach; ?>
                        <?php else: ?>
                            <p>No hay imágenes</p>
                        <?php endif; ?>
                    </div>
                    
                    <div class="ruta-info">
                        <h3><?php echo htmlspecialchars($ruta['nombreRuta']); ?></h3>
                        
                        <div class="ruta-dato">
                            <strong>Dificultad:</strong> 
                            <?php 
                            $dificultadTexto = [
                                'facil' => 'Fácil',
                                'moderada' => 'Moderada',
                                'dificil' => 'Difícil',
                                'muy dificil' => 'Muy Difícil'
                            ];
                            echo htmlspecialchars($dificultadTexto[$ruta['dificultad']] ?? $ruta['dificultad']);
                            ?>
                        </div>
                        
                        <div class="ruta-dato">
                            <strong>Distancia:</strong> <?php echo htmlspecialchars($ruta['distancia']); ?> km
                        </div>
                        
                        <div class="ruta-dato">
                            <strong>Desnivel:</strong> <?php echo htmlspecialchars($ruta['desnivel']); ?> m
                        </div>
                        
                        <div class="ruta-dato">
                            <strong>Duración:</strong> <?php echo htmlspecialchars($ruta['duracion']); ?> horas
                        </div>
                        
                        <div class="ruta-dato">
                            <strong>Provincia:</strong> 
                            <?php 
                            $provinciaTexto = [
                                'huesca' => 'Huesca',
                                'zaragoza' => 'Zaragoza',
                                'teruel' => 'Teruel'
                            ];
                            echo htmlspecialchars($provinciaTexto[$ruta['provincia']] ?? $ruta['provincia']);
                            ?>
                        </div>
                        
                        <div class="ruta-dato">
                            <strong>Época:</strong> <?php echo htmlspecialchars(ucfirst($ruta['epoca'])); ?>
                        </div>
                        
                        <div class="ruta-dato">
                            <strong>Nivel Técnico:</strong> <?php echo htmlspecialchars($ruta['nivelTecnico']); ?>/5
                        </div>
                        
                        <div class="ruta-dato">
                            <strong>Nivel Físico:</strong> <?php echo htmlspecialchars($ruta['nivelFisico']); ?>/5
                        </div>
                        
                        <div class="ruta-dato">
                            <strong>Descripción:</strong> 
                            <p><?php echo htmlspecialchars($ruta['descripcion']); ?></p>
                        </div>
                        
                        <?php if (isset($ruta['fechaCreacion'])): ?>
                        <div class="ruta-dato">
                            <strong>Creada:</strong> <?php echo htmlspecialchars($ruta['fechaCreacion']); ?>
                        </div>
                        <?php endif; ?>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>
</body>
</html>