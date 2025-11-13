<?php
if (session_status() === PHP_SESSION_NONE) { 
    session_start();
}

$imagenesSubidas = [];
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
    $imagenes = $_FILES['imagenes'] ?? [];

    if(isset($_POST['nombreR']) && isset($_POST['dificultad']) && isset($_POST['distancia']) && isset($_POST['desnivel']) &&
    isset($_POST['duracion']) && isset($_POST['provincia']) && isset($_POST['epoca']) && isset($_POST['descripcion']) && isset($_POST['nivelTecnico']) &&
    isset($_POST['nivelFisico']) && isset($_FILES['imagenes'])){
        $imagenes = $_FILES['imagenes'];
        $nombre = $imagenes['name'];
        $tipo = $imagenes['type'];
        $tamaño = $imagenes['size'];
        $tmp = $imagenes['tmp_name'];
        $error = $imagenes['error'];

        if ($error === UPLOAD_ERR_OK) {
            if ($tamaño <= 2097152) {
                $extension = pathinfo($nombre, PATHINFO_EXTENSION);
                $permitidas = ['jpg', 'jpeg', 'png', 'pdf'];
                if (in_array(strtolower($extension), $permitidas)) {
                    $nuevo_nombre = uniqid() . '.' . $extension;
                    $destino = 'uploads/photos/' . $nuevo_nombre;
                    if (move_uploaded_file($tmp, $destino)) {
                        echo "<p>Archivo subido correctamente</p>";
                    } else {
                        $errores[] =  "<p>Error al mover el archivo</p>";
                    }
                } else {
                    $errores[] = "<p>Tipo de archivo no permitido</p>";
                }
            } else {
                $errores[] = "<p>Archivo demasiado grande</p>";
            }
        } else {
            $errores[] = "<p>Error en la subida</p>";
        }   
        if(empty($errores)){
            echo "<p>Ruta creada correctamente</p>";

            $nuevaRuta = [
                "nombreRuta" => $nombreRuta,
                "dificultad" => $dificultad,
                "distancia" => $distancia,
                "desnivel" => $desnivel,
                "duracion" => $duracion,
                "provincia" => $provincia,
                "epoca" => $epoca,
                "descripcion" => $descripcion,
                "nivelTecnico" => $nivelTecnico,
                "nivelFisico" => $nivelFisico,
                "imagenes" => $imagenes
            ];

            $rutas[] = $nuevaRuta;

            $_SESSION['rutas']=$rutas;

            header("Location: list.php");
        }
        else {
            foreach($errores as $error){
                echo "<p style='color:red'>$error</p>";
            }
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../assets/css/estilos.css">
    <title>Crear ruta</title>
</head>
<body>
    <div calss= "create-container">
        <h1>Crear ruta</h1>
        <form class="formCrear" action="" method="POST" enctype="multipart/form-data">
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
                <label for="descripcion">Descripción (Max. 500 caracteres)</label>
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

            <div class = "form-group">
                <label>Subir imagen: </label>
                <input type="file" name="imagenes[]" id="imagenes" multiple accept=".jpg,.jpeg,.png" required>
            </div>

            <button type="submit">Crear Ruta</button>
        </form>
    </div>
</body>
</html>