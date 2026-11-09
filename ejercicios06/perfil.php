<?php

if ($_SERVER['REQUEST_METHOD'] == "POST") {

    if ($_POST['orden'] == "Confirmar") {
        setcookie("edad", $_POST['edad'], time() + (86400 * 7), "/");

        $genero_post = isset($_POST['genero']) ? $_POST['genero'] : "";
        setcookie("genero", $genero_post, time() + (86400 * 7), "/");

        $deportes_post = isset($_POST['deportes']) ? implode(",", $_POST['deportes']) : "";
        setcookie("deportes", $deportes_post, time() + (86400 * 7), "/");

    } else if ($_POST['orden'] == "Eliminar") {
        setcookie("edad", "", time() - 3600, "/");
        setcookie("genero", "", time() - 3600, "/");
        setcookie("deportes", "", time() - 3600, "/");
    }
}

/*if (isset($_COOKIE['edad'])) {
    $edad = $_COOKIE['edad'];
} else {
    $edad = "";
}*/

$edad = isset($_COOKIE['edad']) ? $_COOKIE['edad'] : "";
$genero = isset($_COOKIE['genero']) ? $_COOKIE['genero'] : "";
$deportes_guardados = isset($_COOKIE['deportes']) ? explode(",", $_COOKIE['deportes']) : [];



?>
<html>

<head>
    <meta charset="UTF-8">
    <link href="default.css" rel="stylesheet" type="text/css" />
</head>

<body>
    <div id="container" style="width: 380px;">
        <div id="header">
            <h1>SUS DATOS ALMACENADOS</h1>
        </div>

        <div id="content">
            <fieldset>
                <form method="post">
                    <label>Edad</label> <input type="number" name="edad" value="<?= $edad ?>"><br>
                    Género :<br>
                    <label> Mujer </label>
                    <input type="radio" name="genero" value="Mujer" <?=($genero == "Mujer")? 'checked' : '' ?>>
                    <label> Hombre</label>
                    <input type="radio" name="genero" value="Hombre" <?= ($genero == "Hombre") ? 'checked': '' ?>>
                    <br>
                    <label>Deportes</label><br>
                    <select name="deportes[]" multiple="multiple" size="4">
                        <option value="Futbol" <?= in_array("Futbol", $deportes_guardados) ? 'selected': '' ?>>Futbol</option>
                        <option value="Tenis" <?= in_array("Tenis",$deportes_guardados) ? 'selected': ''  ?>>Tenis</option>
                        <option value="Ciclismo" <?= in_array("Ciclismo", $deportes_guardados) ? 'selected' : '' ?>>Ciclismo</option>
                        <option value="Otro" <?= in_array("Otro", $deportes_guardados) ? 'selected': '' ?>>Otro</option>
                    </select>
                    <br>
                    <button name="orden" value="Confirmar"> Almacenar valores </button>
                    <button name="orden" value="Eliminar"> Eliminar valores </button>
                </form>
            </fieldset>
        </div>
    </div>
</body>

</html>