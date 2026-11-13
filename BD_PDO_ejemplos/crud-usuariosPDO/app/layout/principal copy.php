<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CRUD DE USUARIOS</title>
    <link href="web/default.css" rel="stylesheet" type="text/css" />
    <script type="text/javascript" src="web/js/funciones.js"></script>
</head>
<body>

<div id="container">
    <div id="header">
        <h1>GESTIÓN DE USUARIOS</h1>
        <h2>versión 1.1 + BD (PDO)</h2>
    </div>

    <div id="content">
        <?= $contenido ?>

        <form method="GET" class="actions-bar" style="margin-top: 20px;">
            <button type="submit" name="orden" value="Nuevo">Nuevo</button>
            <button type="submit" name="orden" value="Terminar">Terminar</button>
        </form>
    </div>
</div>

</body>
</html>