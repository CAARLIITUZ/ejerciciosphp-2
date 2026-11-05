<?php

    //FUNCIONES AUXILIARES
    function estaVacio(string $valor){
        $cadena = trim($valor);
        if (empty($cadena)){
            return true;
        }else{
            return false;
        }
    }

    function hayMayuscula(string $valor){
        $cadena = trim($valor);
        for($i=0; $i<mb_strlen($cadena);$i++){
            if(ctype_upper($cadena[$i])){
                return true;
            }
        }
        return false;
    }

    function hayMinuscula(string $valor){
        $cadena = trim($valor);
        for($i=0; $i<mb_strlen($cadena);$i++){
            if(ctype_lower($cadena[$i])){
                return true;
            }
        }
        return false;
    }

    function hayDigito(string $valor){
        $cadena = trim($valor);
        for($i=0; $i<mb_strlen($cadena);$i++){
            if(ctype_digit($cadena[$i])){
                return true;
            }
        }
        return false;
    }

    function hayCaracterNoAlNum(string $valor){
        $cadena = trim($valor);
        for($i=0; $i<mb_strlen($cadena);$i++){
            if(!ctype_alnum($cadena[$i])){
                return true;
            }
        }
        return false;
    }


// Variable para controlar el mensaje de error o éxito
    $mensajeError = "";
    $registrado = false;

    // Si el usuario ha enviado el formulario
    if ($_SERVER['REQUEST_METHOD'] == "POST"){
        $campoVacio = "";
        foreach($_POST as $campo => $valor){
            if(estaVacio($valor)){
                $campoVacio = $campo;
                break;
            }
        }

        $mail = $_POST['mail'] ?? '';
        $pass1 = $_POST['contrasena1'] ?? '';
        $pass2 = $_POST['contrasena2'] ?? '';

        // Validaciones en cascada guardando el error en la variable
        if (!empty($campoVacio)){
            $mensajeError = "El campo " . $campoVacio . " está vacío.";
        }else if(!filter_var($mail, FILTER_VALIDATE_EMAIL)){
            $mensajeError = "ERROR: El formato del correo electrónico no es válido.";
        }else if ($pass1 !== $pass2){
            $mensajeError = "ERROR: Las contraseñas no coinciden.";
        }else if(mb_strlen($pass1) < 8){
            $mensajeError = "ERROR: La contraseña debe tener más de 8 caracteres.";
        }else if(!hayMayuscula($pass1)){
            $mensajeError = "ERROR: La contraseña debe tener al menos 1 mayúscula.";
        }else if (!hayMinuscula($pass1)){
            $mensajeError = "ERROR: La contraseña debe tener al menos 1 minúscula.";
        }else if(!hayDigito($pass1)){
            $mensajeError = "ERROR: La contraseña debe tener al menos 1 dígito.";
        }else if(!hayCaracterNoAlNum($pass1)){
            $mensajeError = "ERROR: La contraseña debe tener un símbolo no alfanumérico (@, !, #...).";
        }else{
            $registrado = true; // ¡Todo OK!
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro</title>
</head>
<body>

    <?php if ($registrado): ?>
        <!-- Si ya se registró con éxito, mostramos mensaje de OK y ocultamos el formulario -->
        <h2 style="color: green;">¡FELICIDADES, USUARIO REGISTRADO CON ÉXITO!</h2>
    <?php else: ?>
        <!-- Si no se ha registrado (o hay error), mostramos el formulario -->

        <?php 
            // Si hay un error, lo mostramos arriba del formulario
            if (!empty($mensajeError)) {
                echo '<p style="color: red; font-weight: bold;">' . $mensajeError . '</p>';
            }
        ?>

        <form action="" method="POST">
            <!-- Usamos value="..." para que no se borre lo que el usuario escribió si hay un error -->
            <label for="">Usuario <input type="text" name="usuario" value="<?php echo htmlspecialchars($_POST['usuario'] ?? ''); ?>"></label><br>
            <label for="">Email <input type="email" name="mail" value="<?php echo htmlspecialchars($_POST['mail'] ?? ''); ?>"></label><br>
            <label for="">Contraseña <input type="password" name="contrasena1"></label><br>
            <label for="">Repita Contraseña <input type="password" name="contrasena2"></label><br>
            <input type="submit" value="Enviar datos">
        </form>
    <?php endif; ?>

</body>
</html>