<?php
session_start();

// Cambiar  visitar --> VALOR DE COOKIE
// Cambiar disponible --> VALOR DE SESSION
$_SESSION['disponible'] = 1000;
$visitas = 1;  
$disponible = $_SESSION['disponible'];
// Actualizo el cookie de visitas

 // Un mes  

$msg="";

// Entra en el casino --------------------------------
if (! isset($_SESSION['disponible'])) {

    // No continuo despues de mostrar los formularios
    exit();
}



// Si realiza una apuesta ----------------------------------
// llama a procesar apuesta 
if (isset($_POST["apostar"])) {
    $msg = " Resultado de la apuesta";
 }

// Si abandona o ya no le queda dinero -------------------------
 if (isset($_POST["dejar"]) || ($_SESSION["disponible"] == 0) ) {
    
   exit();
} 
// Muestro el formulario si puede seguir apostando
require_once  "form_apuesta.php";
?>


<?php

/**
 *  FUNCIONES AUXILIARES
 */

function procesarApuesta(int $valorapuesta, int & $saldodisponible, string $apuesta): String {
    $msgresultado = "";
  return $msgresultado;
}

