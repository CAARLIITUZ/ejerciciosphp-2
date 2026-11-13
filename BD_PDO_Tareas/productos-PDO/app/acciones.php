<?php
require_once "app/dat/Producto.php";
require_once 'app/dat/AccesoDatos.php';

function accionBorrar ($codigo){    
    $db = AccesoDatos::getModelo();
    $tproducto = $db->borrarProducto($codigo);
}

function accionTerminar(){
    AccesoDatos::closeModelo();
    session_destroy();
    header("Refresh:0 url='./index.php'");
}
 
function accionAlta(){
    $producto = new Producto();
    $producto->nombre  = "";
    $producto->codigo   = "";
    $producto->stock   = "";
    $producto->stock_min = "";
    $producto->precio = "";
    $orden= "Nuevo";
    include_once "layout/formulario.php";
}

function accionDetalles($codigo){
    $db = AccesoDatos::getModelo();
    $producto = $db->getProducto($codigo);
    $orden = "Detalles";
    include_once "layout/formulario.php";
}


function accionModificar($codigo){
    $db = AccesoDatos::getModelo();
    $producto = $db->getProducto($codigo);
    $orden="Modificar";
    include_once "layout/formulario.php";
}

function accionPostAlta(){
    $prod = new Producto();
    $prod->nombre  = $_POST['nombre'];
    $prod->codigo   = $_POST['codigo'];
    $prod->stock   = $_POST['stock'];
    $prod->stock_min = $_POST['stock_min'];
    $prod->precio = $_POST['precio'];
    $db = AccesoDatos::getModelo();
    $db->addProducto($prod);
    
}

function accionPostModificar(){
    
    $prod = new Producto();
    $prod->nombre  = $_POST['nombre'];
    $prod->codigo   = $_POST['codigo'];
    $prod->stock  = $_POST['stock'];
    $prod->stock_min = $_POST['stock_min'];
    $prod->precio = $_POST['precio'];
    $db = AccesoDatos::getModelo();
    $db->modProducto($prod);
    
}

