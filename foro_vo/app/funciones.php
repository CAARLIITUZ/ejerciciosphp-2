<?php
function usuarioOk($usuario, $contraseña) :bool {
   $usuariosinEspacios = trim($usuario);
   $contraseñasinEspacios = trim($contraseña);
   return (mb_strlen($usuariosinEspacios)>=8 && strrev($usuariosinEspacios)===$contraseñasinEspacios);
    
}

function numPalabras (string $texto) : int {
   $textoSinEspacios = trim($texto);
   return str_word_count($textoSinEspacios);
}

function letraMasRepetida(string $texto) : string{
   $cadenaLower = mb_strtolower($texto);
   $cadenaSinEspacios = str_replace([" ", "\r", "\n"], "", $cadenaLower);
   if($cadenaSinEspacios === ""){
      return "-";
   }
   $arrayLetras= mb_str_split($cadenaSinEspacios);
   $arrayContLetras = array_count_values($arrayLetras);
   arsort($arrayContLetras);
   $letraMasRepe = array_key_first($arrayContLetras);
   return $letraMasRepe;
}

function palabraMasRepetida(string $texto) :string{
   $cadenaLower = mb_strtolower($texto);
   trim($cadenaLower);
   if($cadenaLower ===""){
      return "-";
   }
   $arrayPalabras = explode(" ",$cadenaLower);

   $arrayContPalabras = array_count_values($arrayPalabras);
   arsort($arrayContPalabras);
   $palabraMasRepe = array_key_first($arrayContPalabras);
   return $palabraMasRepe;
}