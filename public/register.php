<?php
    session_start();

    require_once __DIR__ . "/../includes/functions.php"; //Aqui tengo la funcion para validar email

    $errores = [];
    $usuarios = [];

    if($_SERVER['REQUEST_METHOD']==='POST'){  //Validación de todos los campos obligatorios
        $username = trim($_POST['username']);
        $email = trim($_POST['email']);
        $password = $_POST['password'];
        $confirm_password = $_POST['confirm_password'];
        $experiencia = $_POST['experiencia'];
        $especialidad = trim($_POST['especialidad']);
        $provincia = $_POST['provincia'];

        if(isset($_POST['username']) && isset($_POST['email']) && isset($_POST['password']) && isset($_POST['confirm_password']) && // Verifico que existen los campos
            isset($_POST['experiencia']) && isset($_POST['especialidad']) && isset($_POST['provincia'])){
                //Valido el formato del email
                if(!validarEmail($email)){
                    $errores[]="Email no válido";
                }
                //Valido que la contraseña introducida es igual a confirm_password
                if($password != $confirm_password){
                    $errores[]="No coinciden las contraseñas";
                }
                // Valido que la contraseña tenga 8 o mas caracteres
                if(strlen($password)<8){
                    $errores[]="La contraseña debe contener al menos 8 caracteres";
                }
                // Una vez terminada la validacion de los datos, si esta bien introducido los mete en un array, y si no muestra los errores
                if(empty($errores)){
                    echo "<p>Datos introducidos correctamente</p>";
                    //Hago un array asociativo y luego lo meto en un array general de usuarios, así creo una especie de colección
                    $nuevoUsuario=[
                        "username" => $username,
                        "email" => $email,
                        "password" => $password,
                        "experiencia" => $experiencia,
                        "especialidad" => $especialidad,
                        "provincia" => $provincia
                    ];

                    $usuarios[] = $nuevoUsuario;

                    $_SESSION['usuarios'] = $usuarios; //Con esto lo que hago es guardar el array en la sesion para que al hacer el login se guarden las credenciales

                    header("Location: index.php");
                }
                else{
                    foreach($errores as $error){
                        echo "<p style='color:red'>$error</p>";
                    }
                }
        }
    }
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro de usuarios</title>
    <link rel="stylesheet" href="../assets/css/estilos.css">
</head>
<body>
    <div class="register-page">
        <h1>Registro de usuario</h1>
        <?php if(isset($error)) echo "<p style='color:red'>$error</p>"; ?>
        <form id="formRegistro" action="" method="POST">
            <div class="form-group">
                <label for="username">Nombre de Usuario:</label>
                <input type="text" id="username" name="username" required>
            </div>

            <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" id="email" name="email" required>
            </div>

            <div class="form-group">
                <label for="password">Contraseña:</label>
                <input type="password" id="password" name="password" required>
            </div>

            <div class="form-group">
                <label for="confirm_password">Confirmar Contraseña:</label>
                <input type="password" id="confirm_password" name="confirm_password" required>
            </div>

            <div class="form-group">
                <label for="experiencia">Nivel de Experiencia:</label>
                <select id="experiencia" name="experiencia" required>
                    <option value="">Seleccione...</option>
                    <option value="alto">Alto</option>
                    <option value="medio">Medio</option>
                    <option value="bajo">Bajo</option>
                </select>
            </div>

            <div class="form-group">
                <label for="especialidad">Especialidad:</label>
                <input type="text" id="especialidad" name="especialidad" required>
            </div>

            <div class="form-group">
                <label for="provincia">Provincia:</label>
                <input type="text" id="provincia" name="provincia" required>
            </div>
            <br>

            <a href = "index.php">Volver a inicio</a><br><br>

            <button type="submit">Registrar</button>
        </form>
    </div>
</body>
</html>