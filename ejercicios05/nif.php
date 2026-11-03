<?php


function calcularLetra($dni){
        $arrayLetras = ["T", "R","W","A","G","M","Y","F","P","D","X","B","N","J","Z","S","Q","V","H","L","C","K","E"];

        $resto=$dni%23;
        $letra = $arrayLetras[$resto];
        return $letra;
    }

if(isset($_POST['dni'])){
    $dniIngresado = $_POST['dni'];

    if(ctype_digit($dniIngresado)){
        $letraObtenida = calcularLetra($dniIngresado);
        echo "DNI OBTENIDO: ". $dniIngresado.$letraObtenida;
    }else{
        echo "Debe introducir solo números enteros positivos";
    }


}


?>
<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="utf-8">
  <title>
    NIF
  </title>

</head>

<body>
  <h1>NIF CON PHP</h1>
  <form action="" method="post">

    <label for="">Introduzca sus dígitos</label>
    <input maxlength="7" type="text" name="dni" required>
    <button type="submit">Enviar datos</button>
  </form>



  
</body>

</html>