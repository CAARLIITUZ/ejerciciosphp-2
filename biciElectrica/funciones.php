<?php
require_once("BiciElectrica.php");

// Lee el fichero CSV y devuelve una tabla (array) de objetos BiciElectrica
function cargarbicis(): array
{
    $fich = @fopen("Bicis.csv", "r");
    if ($fich == false) {
        die("Error al abrir el fichero");
    }
    $tabla = [];

    while ($valor = fgetcsv($fich)) {
        list($id, $cx, $cy, $bat, $op) = $valor;
        $bici = new BiciElectrica($id, $cx, $cy, $bat, $op);
        $tabla[] = $bici; // Añadimos cada objeto bicicleta al array
    }
    fclose($fich);

    return $tabla;
}

// Devuelve una cadena con la tabla HTML de las bicicletas que están operativas
function mostrartablabicis($tabla): string
{
    // Creamos la estructura inicial de la tabla HTML con sus cabeceras
    $cadena = "<table><tr><th>Id</th><th>Coord X</th><th>Coord Y</th><th>Bateria</th></tr>";
    
    foreach ($tabla as $bici) {
        // Condición: Mostrar únicamente las bicis que estén operativas (true / 1)
        if ($bici->operativa) {
            $cadena .= "<tr>";
            $cadena .= "<td>" . $bici->id . "</td>";
            $cadena .= "<td>" . $bici->coordx . "</td>";
            $cadena .= "<td>" . $bici->coordy . "</td>";
            $cadena .= "<td>" . $bici->bateria . "%</td>"; // Mostramos el porcentaje de batería
            $cadena .= "</tr>";
        }
    }
    
    $cadena .= "</table>";

    return $cadena;
}

/**
 * Devuelve la bici con menor distancia a las coordenadas del usuario. 
 * @param $x Coordenada X introducida por el usuario
 * @param $y Coordenada Y introducida por el usuario
 * @param $tabla Tabla de bicicletas cargadas
 * @return bicicleta más cercana (objeto) o null
 */
function bicimascercana($x, $y, $tabla)
{
    $bicicerca = null;
    $menordistancia = PHP_FLOAT_MAX; // Inicializamos con el valor más alto posible para ir buscando el mínimo

    foreach ($tabla as $bici) {
        // Solo evaluamos las bicicletas que estén operativas para la recomendación
        if ($bici->operativa) {
            // Calculamos la distancia usando el método de la clase BiciElectrica
            $distancia = $bici->distancia($x, $y);
            
            // Si la distancia actual es menor que la menor registrada, la actualizamos
            if ($distancia < $menordistancia) {
                $menordistancia = $distancia;
                $bicicerca = $bici;
            }
        }
    }
    
    return $bicicerca; // Devuelve el objeto de la bici más cercana
}