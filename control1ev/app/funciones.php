<?php
require_once ('dat/datos.php');
/**
 *  Devuelve true si el código del usuario y contraseña se 
 *  encuentra en la tabla de usuarios
 *  @param $login : Código de usuario
 *  @param $clave : Clave del usuario
 *  @return true o false
 */
function userOk($login,$clave):bool {
    global $usuarios;

    if (array_key_exists($login, $usuarios) && $usuarios[$login][1] == $clave){
        return true;
    }else{
        return false;
    }
    
}

/**
 *  Devuelve el rol asociado al usuario
 *  @param $login: código de usuario
 *  @return ROL_ALUMNO o ROL_PROFESOR
 */
function getUserRol($login){
    global $usuarios;
    return $usuarios[$login][2];
}

/**
 *  Muestra las notas del alumno indicado.
 *  @param $codigo: Código del usuario
 *  @return $devuelve una cadena con una tabla html con los resultados 
 */
function verNotasAlumno($codigo):String{
    $msg="";
    global $nombreModulos;
    global $notas;
    global $usuarios;

    $msg .= " Bienvenido/a alumno/a: ". $usuarios[$codigo][0];
    $msg .= "<table>";
    // Completar
        $msg .= "<tr><td>Módulo</td><td>Nota</td></tr>";
        foreach($nombreModulos as $indice =>$nombreModulo ){
            $msg.= "<tr><td>". $nombreModulo ."</td><td>" .$notas[$codigo][$indice] . "</td></tr>";
        }
    $msg .= "</table>";
    return $msg;
}

/**
 *  Muestra las notas de todos alumnos. 
 *  @param $codigo: Código del profesor
 *  @return $devuelve una cadena con una tabla html con los resultados 
 */
function verNotaTodas ($codigo): String {
    $msg="";
    global $nombreModulos;
    global $notas;
    global $usuarios;
    $msg .= " Bienvenido Profesor: ". $usuarios[$codigo][0];
    $msg .= "<table>";
    $msg .= "<tr><th>Nombre</th>";
        foreach($nombreModulos as $nombreModulo){
            $msg .= "<th>". $nombreModulo ."</th>";
        }
    $msg .= "</tr>";

        foreach($usuarios as $codigoUsuario => $datosUsuario){
            if ($datosUsuario[2] == ROL_ALUMNO){
                $msg .= "<tr><td>".$datosUsuario[0] ."</td>";
                
                foreach($notas[$codigoUsuario] as $nota){
                $msg .= "<td>". $nota."</td>";
                }
            }
            
            $msg .= "</tr>";
        }
    
    $msg .= "</table>";
    return $msg;
}