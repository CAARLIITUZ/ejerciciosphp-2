<?php
session_start();

// 1. Si no existe la partida, la inicializamos (Número secreto y 5 intentos)
if (!isset($_SESSION['secreto'])) {
    $_SESSION['secreto'] = rand(1, 20); // Número aleatorio del 1 al 20
    $_SESSION['intentos'] = 5;          // 5 oportunidades
}

$msg = "";
$intentosdelusuario = null;

if ($_SERVER['REQUEST_METHOD'] == "POST" && isset($_POST['intento'])){

    $intentosdelusuario = (int) $_POST['intento'];
    $_SESSION['intentos']--;

    if ($intentosdelusuario === $_SESSION['secreto']){
        $msg = "ENHORABUENA, HAS ACERTADO EL NUMERO";
    }else if ($_SESSION['intentos']<=0){
        $msg = "GAME OVER VIDAS AGOTADAS, EL NUMERO RANDOM ERA: " . $_SESSION['secreto'];
    }else if ($intentosdelusuario > $_SESSION['secreto']){
        $msg = "Error, el número es mas pequeño, te quedan ". $_SESSION['intentos']. " intentos";
    }else if ($intentosdelusuario < $_SESSION['secreto'] ){
        $msg = "Error, el número es mas grande, te quedan ". $_SESSION['intentos']. " intentos";

    }
}


if(isset($_GET['sesion'])){
    session_destroy();
    header("Location: adivina.php");
    exit();
}


?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Juego Adivina el Número</title>
</head>
<body>
    <center>
        <h2>JUEGO, ADIVINA EL NUMERO DEL</h2>
    <?php if(!empty($msg)): ?>
        <p><?=$msg ?></p>
    <?php endif; ?>

    <?php if ($_SESSION['intentos'] >0 && $intentosdelusuario !== $_SESSION['secreto']): ?>
        <form action="" method= "post">
            <label for=""><input type="number" name="intento" required></label>
            <input type="submit" value="Prueba suerte">
        </form>
        
    <?php endif; ?>
      <a href="adivina.php?sesion=true">Generar nueva partida</a>
    </center>
</body>
</html>