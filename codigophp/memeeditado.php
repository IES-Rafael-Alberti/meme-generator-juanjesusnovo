<?php
require ("conecta.php");
require ("revisarlogin.php");

$url = 'https://api.imgflip.com/caption_image';

$id = $_POST["id"];
$boxes = $_POST["boxes"];


$valores = array();

for($x = 1; $x <= $boxes; $x++){
    array_push($valores, array(
        "text" => $_POST["text$x"],
        "color" => "#ff8484"
    ));
}


//The data you want to send via POST
$fields = array(
    "template_id" => $id,
    "username" => "fjortegan",
    "password" => "pestillo",
    "boxes" => $valores
    );


//url-ify the data for the POST
$fields_string = http_build_query($fields);

//open connection
$ch = curl_init();

//set the url, number of POST vars, POST data
curl_setopt($ch,CURLOPT_URL, $url);
curl_setopt($ch,CURLOPT_POST, true);
curl_setopt($ch,CURLOPT_POSTFIELDS, $fields_string);

//So that curl_exec returns the contents of the cURL; rather than echoing it
curl_setopt($ch,CURLOPT_RETURNTRANSFER, true);

//execute post
$result = curl_exec($ch);

//decode response
$data = json_decode($result, true);

//if success show image
if($data["success"]) {
    $meme = $_SESSION["usuario"]."_".date("dmyhis").".jpg";
    file_put_contents("fotos/$meme", file_get_contents($data["data"]["url"]));
    $urlImagen = $data["data"]["url"];
    echo "<img src='".$data["data"]["url"]."'>";
    $sql = "INSERT INTO memes (idUsuario, url, idMeme) VALUES (:idUsuario, :nombre, :idMeme)";
    $datos = array(
        ":idUsuario" => $_SESSION["usuario"],
        ":nombre" => $meme,
        ":idMeme" => $id
    );
    $stmt = $conn->prepare($sql);
    if($stmt -> execute($datos) != 1){
        print("Error al guardar el meme");
        exit(0);
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Imagen modificada</title>
</head>
<body>
    <a href="index.php">Ir al inicio</a>
</body>
</html>

