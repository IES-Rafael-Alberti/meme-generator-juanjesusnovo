<?php
$image = $_GET["url"];
$boxes = $_GET["box"];
$id=$_GET["id"];
if(isset($_POST["text0"])){
    header("Location: memeeditado.php");
    exit(0);
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
    <form action="memeeditado.php" method="post">
        <input name="id" type="hidden" value=<?php echo $id ?>>
        <input name="boxes" type=hidden value=<?php echo $boxes ?>>
        <?php
            $x = 1;
            echo "<img src='$image' width='300px'>";
            while($x <= $boxes){
                echo "<label for='text$x'>Texto $x</label>";
                echo "<input type='text' name='text$x' id='text$x'>";
                $x++;
            }
            echo "<input type='submit' value='Enviar'>";
        ?>
    </form>
</body>
</html>
