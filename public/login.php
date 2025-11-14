<?php
session_start();

    if($_SERVER['REQUEST_METHOD'] === 'POST'){
        $username = $_POST['username'];
        $password = $_POST['password'];

        if (isset($_SESSION['usuarios'])) { //Si ya existian usuario creados, los ponemos en $usuarios para usarlo en esta pagina, si no creamos el array.
            $usuarios = $_SESSION['usuarios'];
        }
        else{
            $usuarios = [];
        }

        $loginCorrecto = false;
        //Recorremos el array comprobando si los datos introducidos coinciden con los usuarios registrados.
        foreach($usuarios as $us){
            if($username == $us['username'] && $password == $us['password']){ //Si lo hace el boolean lo convierte en true para que no salga el error y asigna el usuario introducido en el usuario de la sesion
                $loginCorrecto=true;
                $_SESSION["username"] = $us['username'];
                $_SESSION["login_time"] = time();
                header("Location: index.php");
                exit();
            }
        }
        if($loginCorrecto == false){ //Si no hay usuarios que coincidan con los datos introducidos el boolean que antes ha sido declarado false, no cambiara, por tanto entrar en el if y mostrara el error
            echo "<h2 style='color:red'>Credenciales incorrectas</h2>";
        }
    }
    
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inico de sesion</title>
    <link rel="stylesheet" href="../assets/css/estilos.css">
</head>
<body>
    <br><br><br>
    <div class="login-page">
        <h1>Inicio de sesión</h1>
        <form id="formLogin" action="" method="POST">
            <div class="form-group">
                <label for="username">Nombre de usuario:</label>
                <input type="text" id="username" name="username" required>
            </div>

            <div class="form-group">
                <label for="password">Contraseña:</label>
                <input type="password" id="password" name="password" required>
            </div>

            <a href = "register.php">Registrate</a><br>

            <a href = "index.php">Volver a inicio</a><br><br>

            <button type="submit">Iniciar sesión</button>
        </form>
    </div>
    
</body>
</html>