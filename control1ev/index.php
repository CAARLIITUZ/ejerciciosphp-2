<?php
session_start();

// Si la variable de intentos no existe todavía, la inicializamos a 0
if (!isset($_SESSION['intentos'])) {
    $_SESSION['intentos'] = 0;
}

include_once('app/funciones.php');

// Comprobamos si ya ha superado el límite de 5 intentos
if ($_SESSION['intentos'] >= 5) {
    $contenido = "Superado el número máximo de accesos, REINICIE NAVEGADOR";
    include_once ('app/resultado.php');
} else {
    // Si no está bloqueado, procesamos el formulario normalmente
    if (!empty($_GET['login']) && !empty($_GET['clave'])) {
        if (userOk($_GET['login'], $_GET['clave'])) {
            // Si acierta, ponemos los intentos a 0 de nuevo
            $_SESSION['intentos'] = 0;
            
            if (getUserRol($_GET['login']) == ROL_PROFESOR) {
                $contenido = verNotaTodas($_GET['login']);
            } else {
                $contenido = verNotasAlumno($_GET['login']);
            }
            include_once('app/resultado.php');
        } else {
            // Si falla, sumamos 1 al contador de intentos
            $_SESSION['intentos']++;
            $contenido = "El número de usuario y la contraseña no son válidos (Intento " . $_SESSION['intentos'] . " de 5)";
            include_once('app/acceso.php');
        }
    } else {
        $contenido = "Introduzca su número de usuario y su contraseña";
        include_once('app/acceso.php');
    }
}