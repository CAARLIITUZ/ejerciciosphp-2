<?php
    // Si el usuario hace clic en una tarjeta, creamos la cookie que durará 30 días
    if (isset($_GET['nuevatarjeta'])){
        setcookie("tipotarjeta", $_GET['nuevatarjeta'], time() + (86400 * 30), "/");
        // RECOMENDACIÓN: Recargamos la página para limpiar la URL y que lea la cookie fresca
        header("Location: pagocookie.php");
        exit();
    }

    // Leemos la tarjeta desde la superglobal $_COOKIE (si no existe, vale null)
    $tarjetactual = $_COOKIE['tipotarjeta'] ?? null;
?>

<html> 
    <head> 
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"> 
        <title>Forma de pago - Cookie</title> 
    </head> 
    <body> 
        <center> 
            <?php if (!empty($tarjetactual)): ?>
                <h2>SU FORMA DE PAGO ACTUAL ES</h2><br> 
                <img src='imagenes/<?= $tarjetactual . ".gif" ?>' alt="Tarjeta actual" />  
            <?php else : ?>
                <h2>NO TIENE FORMA DE PAGO ASIGNADA</h2>
            <?php endif; ?>

            <h2>SELECCIONE UNA NUEVA TARJETA DE CREDITO</h2><br> 
            
            
            <a href='pagocookie.php?nuevatarjeta=cashu'><img src='imagenes/cashu.gif' alt="CashU" /></a>&ensp; 
            <a href='pagocookie.php?nuevatarjeta=cirrus1'><img src='imagenes/cirrus1.gif' alt="Cirrus" /></a>&ensp; 
            <a href='pagocookie.php?nuevatarjeta=dinersclub'><img src='imagenes/dinersclub.gif' alt="Diners Club" /></a>&ensp; 
            <a href='pagocookie.php?nuevatarjeta=mastercard1'><img src='imagenes/mastercard1.gif' alt="Mastercard" /></a>&ensp; 
            <a href='pagocookie.php?nuevatarjeta=paypal'><img src='imagenes/paypal.gif' alt="PayPal" /></a>&ensp; 
            <a href='pagocookie.php?nuevatarjeta=visa1'><img src='imagenes/visa1.gif' alt="Visa" /></a>&ensp; 
            <a href='pagocookie.php?nuevatarjeta=visa_electron'><img src='imagenes/visa_electron.gif' alt="Visa Electron" /></a>  

        </center> 
    </body> 
</html>