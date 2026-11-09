<?php
// 1. INICIAR LA SESIÓN
// session_start() es obligatorio ponerlo siempre en la primera línea.
// Abre la "caja fuerte" en el servidor para este usuario y permite 
// leer o escribir en la variable global $_SESSION.
session_start();
//$_SESSION['tipotarjeta']="visa_electron";



// 2. CAPTURAR EL CLIC DEL USUARIO (MÉTODO GET)
// Cuando el usuario hace clic en una imagen, el navegador viaja a la URL 
// adjuntando un parámetro GET (ejemplo: pagosesion.php?nuevatarjeta=visa1).
// Comprobamos si ese parámetro existe en la URL:
if (isset($_GET['nuevatarjeta'])) {
    $_SESSION['tipotarjeta'] = $_GET['nuevatarjeta'];
}

// 3. RECUPERAR EL ESTADO ACTUAL
// Comprobamos si ya tenemos una tarjeta guardada previamente en la sesión.
// Si $_SESSION['tipotarjeta'] existe, la guardamos en $tarjetactual. 
// Si no existe (es la primera vez que entra), asignamos null.
$tarjetactual = $_SESSION['tipotarjeta'] ?? null;
?>


<html>

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <title>Forma de pago</title>
</head>

<body>
    <center>
        <?php if (!empty($tarjetactual)): ?>
            <H2> SU FORMA DE PAGO ACTUAL ES</H2> </br>
            <img src='imagenes/<?= $tarjetactual . ".gif" ?>' /></a>
        <?php else : ?>
            <h2>NO TIENE FORMA DE PAGO ASIGNADA</h2>
        <?php endif; ?>
        <!-- Cada imagen está envuelta en un enlace <a> que envía por la URL (?nuevatarjeta=...) 
            el nombre de la tarjeta seleccionada hacia el principio de este mismo script. -->
        <h2>SELECCIONE UNA NUEVA TARJETA DE CREDITO </h2><br>
        <!-- CATÁLOGO DE SELECCIÓN (ENLACES GET) -->
        <a href='pagosesion.php?nuevatarjeta=cashu'><img src='imagenes/cashu.gif' /></a>&ensp;
        <a href='pagosesion.php?nuevatarjeta=cirrus1'><img src='imagenes/cirrus1.gif' /></a>&ensp;
        <a href='pagosesion.php?nuevatarjeta=dinersclub'><img src='imagenes/dinersclub.gif' /></a>&ensp;
        <a href='pagosesion.php?nuevatarjeta=mastercard1'><img src='imagenes/mastercard1.gif' /></a>&ensp;
        <a href='pagosesion.php?nuevatarjeta=paypal'><img src='imagenes/paypal.gif' /></a>&ensp;
        <a href='pagosesion.php?nuevatarjeta=visa1'><img src='imagenes/visa1.gif' /></a>&ensp;
        <a href='pagosesion.php?nuevatarjeta=visa_electron'><img src='imagenes/visa_electron.gif' /></a>

    </center>
</body>

</html>