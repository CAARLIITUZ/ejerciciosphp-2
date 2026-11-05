<?php

class Persona{
    private int $edad;
    private string $nombre;

    function __construct(int $edad, string $nombre)
    {
        $this->nombre= $nombre;
        $this->edad = $edad;
    }

    function mensajeEdad(int $años):string {
        if ($años <18){
            return "Precio infantil";
        }else if($años <30){
            return "Precio joven";
        }else{
            return "precio adulto";
        }
    }

    function cumplirAños(): void{
        $this->edad++;
    }

    function __get(string $atributo)
    {
        if($atributo == "nombre"){
            return $this->nombre;
        }

        if($atributo == "edad"){
            return $this->edad -2;
        }
    }

    function __set(string $name, mixed $value)
    {
        if ($name == "edad" && $value <100){
            $this->edad =$value;
        }
    }

    function __toString(){
        return $this->nombre."(". $this->edad.")";
    }
}

$pepe = new Persona(25, "Pepe");
$pepe->cumplirAños();
print_r($pepe);
echo " nombre es " . $pepe->nombre;
echo " edad es " . $pepe->edad;
$pepe->nombre = "Manuel";
$pepe->edad =320;
echo $pepe ."\n";
