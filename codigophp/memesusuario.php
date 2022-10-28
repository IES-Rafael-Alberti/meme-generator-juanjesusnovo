<?php
require ("conecta.php");
require ("revisarlogin.php");

$usuario = $_SESSION["usuario"];
$psw = $_SESSION["contrasena"];



?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Memes</title>
</head>
<body>
<a href="index.php">Ir al inicio</a>

<?php
    $memes = $conn->prepare("SELECT * FROM memes WHERE idUsuario = :nombre");
    $memes->execute(array(":nombre" => $usuario));
    $memes_assoc=$memes->fetchAll(PDO::FETCH_ASSOC);
    print("<table class='styled-table'>");
    foreach($memes_assoc as $meme){;
        print("</thead>");
        print("<td>");
        echo "<img src='fotos/$meme[url]'>";
        print("</td>");
        print("</tr>");
    }
?>
</body>
</html>
