<?php
session_start();

$errores = [];
$rutas = [];

if($_SERVER['REQUEST_METHOD']==='POST'){
    $nombreRuta = trim($_POST['nombreR']);
    $dificultad = $_POST['dificultad'];
    $distancia = $_POST['distancia'];
    $desnivel = $_POST['desnivel'];
    $duracion = $_POST['duracion'];
    $provincia = $_POST['provincia'];
    $epoca = $_POST['epoca'];
    $descripcion = $_POST['descripcion'];
    $nivelTecnico = $_POST['nivelTecnico'];
    $nivelFisico = $_POST['nivelFisico'];

    if(isset($_POST['nombreR']) && isset($_POST['dificultad']) && isset($_POST['distancia']) && isset($_POST['desnivel']) &&
    isset($_POST['duracion']) && isset($_POST['provincia']) && isset($_POST['epoca']) && isset($_POST['descripcion']) && isset($_POST['nivelTecnico']) &&
    isset($_POST['nivelFisico'])){

    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crear ruta</title>
</head>
<body>
    <div>
        <h1>Crear ruta</h1>
        <form class="formCrear" action="" method="POST">
            <div class="form-group">
                <label for="nombreR">Nombre de la ruta</label>
                <input type="text" id="nombreR" name="nombreR" required>
            </div>

            <div class="form-group">
                <label for="dificultad">Dificultad</label>
                <select id="dificultad" name="dificultad">
                    <option value="">Seleccione...</option>
                    <option value="facil">Fácil</option>
                    <option value="moderada">Moderada</option>
                    <option value="dificil">Dificil</option>
                    <option value="muy dificil">Muy dificil</option>
                </select>
            </div>

            <div class="form-group">
                <label for="distancia">Distancia en kilometros</label>
                <input type="number" id="distancia" name="distancia" required>
            </div>

            <div class="form-group">
                <label for="desnivel">Desnivel positivo</label>
                <input type="number" id="desnivel" name="desnivel" required>
            </div>

            <div class="form-group">
                <label for="duracion">Duración estimada en horas</label>
                <input type="number" id="duracion" name="duracion" required>
            </div>

            <div class="form-group">
                <label for="provincia">Provincia</label>
                <select id="provincia" name="provincia">
                    <option value="">Seleccione...</option>
                    <option value="huesca">Huesca</option>
                    <option value="zaragoza">Zaragoza</option>
                    <option value="teruel">Teruel</option>
                </select>
            </div>

            <div class="form-group">
                <label>Epoca del año recomendada</label>
                <div class="radio-group">
                    <input type="radio" id="primavera" name="epoca" value="primavera" required>
                    <label for="epoca">Primavera</label>
                </div>
        
                <div class="radio-group">
                    <input type="radio" id="verano" name="epoca" value="verano">
                    <label for="verano">Verano</label>
                </div>
        
                <div class="radio-group">
                    <input type="radio" id="otoño" name="epoca" value="otoño">
                    <label for="otoño">Otoño</label>
                </div>
        
                <div class="radio-group">
                    <input type="radio" id="invierno" name="epoca" value="invierno">
                    <label for="invierno">Invierno</label>
                </div>
            </div>

            <div class="form-group">
                <label for="descripcion">Descripción</label>
                <input type="textarea" id="descripcion" name="descripcion" required>
            </div>

            <div class="form-group">
                <label for="nivelTecnico">Nivel técnico</label>
                <input type="number" id="nivelTecnico" name="nivelTecnico" min="1" max="5" required>
            </div>

            <div class="form-group">
                <label for="nivelFisico">Nivel físico</label>
                <input type="number" id="nivelFisico" name="nivelFisico" min="1" max="5" required>
            </div>
        </form>
    </div>
</body>
</html>