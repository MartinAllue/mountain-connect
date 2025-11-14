<?php
if (session_status() === PHP_SESSION_NONE) { //Iniciamos la sesion si no estaba iniciada antes
    session_start();
}
$errores = [];
$imagenesGuardadas = [];
$rutas = [];

if($_SERVER['REQUEST_METHOD']==='POST'){ //Validacion de campos
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
    $imagenes[] = $_FILES['imagenes'] ?? [];

    if(isset($_POST['nombreR']) && isset($_POST['dificultad']) && isset($_POST['distancia']) && isset($_POST['desnivel']) &&
    isset($_POST['duracion']) && isset($_POST['provincia']) && isset($_POST['epoca']) && isset($_POST['descripcion']) && isset($_POST['nivelTecnico']) &&
    isset($_POST['nivelFisico']) && isset($_FILES['imagenes'])){
        if (!empty($_FILES['imagenes']['name'][0])) { //Aqui valido las imagenes subidas
            for ($i = 0; $i < count($_FILES['imagenes']['name']); $i++) { //Hago un for con las imagenes que se han subido, puede ser una o varias
                $nombre = $_FILES['imagenes']['name'][$i];
                $tmp = $_FILES['imagenes']['tmp_name'][$i];
                $size = $_FILES['imagenes']['size'][$i];
                $error = $_FILES['imagenes']['error'][$i];

                if ($error === UPLOAD_ERR_OK) { //Si el estado del error es OK sigue, si no da el error
                    if ($size <= 2097152) {
                        $extension = strtolower(pathinfo($nombre, PATHINFO_EXTENSION)); //Con esto cojo el nombre de la extension del archivo
                        $permitidas = ['jpg','jpeg','png'];//Hago un array con las extensiones permitdas
                        if (in_array($extension, $permitidas)) {//Si la extension del archivo esta entre las extensiones permitidas sigue, si no devulve el error
                            $nuevoNombre = uniqid() . '.' . $extension; 
                            $destino = '../../uploads/photos/' . $nuevoNombre;
                            if (move_uploaded_file($tmp, $destino)) { // Movemos el archivo a /uploads/photos
                                $imagenesGuardadas[] = $nuevoNombre;// La guardo en el array que mas tarde meteremos dentro del array $nuevaRuta
                            } 
                            else {
                                $errores[] = "Error al mover el archivo $nombre";
                            }

                        } else {
                            $errores[] = "Archivo $nombre no permitido";
                        }

                    } else {
                        $errores[] = "Archivo $nombre demasiado grande (máx 2MB)";
                    }
                } 
                else {
                $errores[] = "Error en la subida del archivo $nombre";
                }
        }
        if(strlen($descripcion)>500){ //Valido que la descripción no tenga mas de 500 caracteres
            $errores[] = "Máximo de caracteres en la descripción superado (500 max.)";
        }
    } 
        if(empty($errores)){
            echo "<p>Ruta creada correctamente</p>";

            $nuevaRuta = [
            "nombreRuta" => $_POST['nombreR'],
            "dificultad" => $_POST['dificultad'],
            "distancia" => $_POST['distancia'],
            "desnivel" => $_POST['desnivel'],
            "duracion" => $_POST['duracion'],
            "provincia" => $_POST['provincia'],
            "epoca" => $_POST['epoca'],
            "descripcion" => $_POST['descripcion'],
            "nivelTecnico" => $_POST['nivelTecnico'],
            "nivelFisico" => $_POST['nivelFisico'],
            "imagenes" => $imagenesGuardadas
            ];

            $rutas[] = $nuevaRuta; //Meto todos los datos en el array general donde estaran todas las rutas

            $_SESSION['rutas']=$rutas;

            header("Location: list.php");
            exit();
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
        <h1 style="text-align:center">Crear ruta</h1>
        <a href="../index.php" style="text-align: right">Inicio</a>
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
                <input type="file" name="imagenes[]" id="imagenes" multiple required>
            </div>

            <button type="submit">Crear Ruta</button>
        </form>
    </div>
</body>
</html>