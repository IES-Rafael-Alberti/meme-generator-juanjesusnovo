<?php
    require ("conecta.php");
    require ("revisarlogin.php");

    $usuario = $_SESSION["usuario"];
    $imgUser = $conn-> prepare("SELECT foto FROM usuarios WHERE nombre= :nombre");
    $imgUser->execute(array(":nombre"=>$usuario));
    $imagen = $imgUser->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Página principal</title>
</head>
<body>
    <header>
        <?php
        print("<p>hola $usuario, bienvenido</p>");
        ?>
        <a href="logout.php">Desconectarse</a>
    </header>
    <main>
        <a href="lista_memes.php">Crea tu Meme</a>
        <a href="memesusuario.php">Mis Memes</a>
    </main>
</body>
</html>