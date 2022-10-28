<?php
if(isset($_POST["user"])){
    require("conecta.php");

    $user = $_POST["user"];
    $psw = $_POST["psw"];

    $loginUsuario = array(
      ":user" => $user,
      ":psw" => $psw
    );

    $sql = "SELECT * FROM usuarios WHERE nombre = :user AND contrasena = :psw";
    $stmt = $conn->prepare($sql);
    $stmt -> execute($loginUsuario);
    if($stmt -> rowCount() == 1){
        session_start();
        $_SESSION["usuario"] = $user;
        $_SESSION["contrasena"]= $psw;
        session_write_close();
        header("Location: index.php");
        exit(0);
    }
    else{
        print("No se pudo iniciar sesion, usuario y/o contraseña incorrecta");
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<header>
    <img src="">
</header>
<form action="" method="post" enctype="multipart/form-data">
    <label for="user">Nombre: </label>
    <input type="text" name="user" id="user">
    <label for="psw">Contraseña: </label>
    <input type="password" name="psw" id="psw">
    <input type="submit" value="Enviar">
</form>
<a href="register.php">¿No tienes cuenta? Registrate aquí</a>
</body>
</html>