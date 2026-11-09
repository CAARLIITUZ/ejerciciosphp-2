<?php
session_start();

// Si el usuario ha pulsado "Volver a jugar" desde la despedida
if (isset($_GET['reiniciar'])) {
  unset($_SESSION['disponible']); // Borramos la sesión del dinero
  header("Location: " . $_SERVER['PHP_SELF']); // Recargamos la página limpia
  exit();
}
// Cambiar  visitar --> VALOR DE COOKIE
// Cambiar disponible --> VALOR DE SESSION


//OTRA FORMA DE HACERLO MAS SIMPLE
/*$visitas = isset($_COOKIE['visitas']) ? $_COOKIE['visitas'] + 1 : 1;
setcookie("visitas", $visitas, time() + (86400 * 30), "/");
*/
// Actualizo el cookie de visitas

// Un mes  

$msg = "";

// Entra en el casino --------------------------------
if (! isset($_SESSION['disponible'])) {
  if (isset($_POST['cantidadini'])) {
    $_SESSION['disponible'] = $_POST['cantidadini'];
    $disponible = $_SESSION['disponible'];
  } else {
    if (isset($_COOKIE['visitas'])) {
  $visitas = (int)$_COOKIE['visitas'] + 1;
} else {
  $visitas = 1;
}
setcookie("visitas", $visitas, time() + (86400 * 30), "/");
    require_once "form_bienvenida.php";
    exit();
  }
  // No continuo despues de mostrar los formularios
} else {
  $disponible = $_SESSION['disponible'];
}



// Si realiza una apuesta ----------------------------------
// llama a procesar apuesta 
if (isset($_POST["apostar"])) {

  $msg = procesarApuesta($_POST['cantidad'], $disponible, $_POST['apuesta']);
  $_SESSION['disponible'] = $disponible;
}

// Si abandona o ya no le queda dinero -------------------------
if (isset($_POST["dejar"]) || ($_SESSION["disponible"] == 0)) {
  require_once "despedida.php";
  exit();
}
// Muestro el formulario si puede seguir apostando
require_once  "form_apuesta.php";
?>


<?php

/**
 *  FUNCIONES AUXILIARES
 */

function procesarApuesta(int $valorapuesta, int &$saldodisponible, string $apuesta): String
{
  $numeroRandom = rand(1, 20);
  $msgresultado = "";
  if ($valorapuesta > $saldodisponible) {
    $msgresultado = "Error: no dispone de $valorapuesta euros disponibles.";
  } else {
    // Determinamos si el número aleatorio es par o impar
    $esPar = ($numeroRandom % 2 == 0);
    $tipoNumero = $esPar ? "PAR" : "IMPAR";

    // Comprobamos si el usuario acertó
    $acerto = ($apuesta == $tipoNumero);

    if ($acerto) {
      $saldodisponible += $valorapuesta;
      $msgresultado = "RESULTADO DE LA APUESTA : $tipoNumero <br> ¡GANASTE!";
    } else {
      $saldodisponible -= $valorapuesta;
      $msgresultado = "RESULTADO DE LA APUESTA : $tipoNumero <br> PERDISTE";
    }
  }
  return $msgresultado;
}
?>