<?php
namespace pruebas00\taller\POO;

class Coche
{
    // Definir los atributos
    private $modelo;
    private $distanciaTotal;
    private $distanciaParcial;
    private $arrancado;
    private $velocidad;
    private $velocidadMax;
    
    
    // Completar los métodos
    
    function __construct ( String $modelo, int $velocidadMax){
        $this->modelo = $modelo;
        $this->velocidadMax = $velocidadMax;
        $this->distanciaTotal = 0;
        $this->distanciaParcial =0;
        $this->velocidad = 0;
        $this->arrancado = false;
    }
    
    public function  arrancar():bool{
        if ($this->arrancado == false){
            $this->arrancado = true;
            return true;
        }else{
            $this->infoError("EL MOTOR YA ESTA ARRANCADO");
            return false;
        }
    }
    
    public function parar():bool{
        if ($this->arrancado){
            $this->arrancado = false;
            $this->distanciaParcial = 0;
            $this->velocidad = 0;
            return true;
        }else{
            $this->infoError("EL COCHE YA ESTA DETENIDO");
            return false;
        }
    }
    
    public function acelera(int $cantidad): bool {
    if (!$this->arrancado) {
        $this->infoError("MOTOR APAGADO");
        return false;
    }
    
    if (($this->velocidad + $cantidad) > $this->velocidadMax) {
        $this->infoError("No puede acelerar más de la velocidad máxima");
        return false;
    }
    
    $this->velocidad += $cantidad;
    return true;
}
    
    public function frena(int $cantidad): bool {
    if (!$this->arrancado) {
        $this->infoError("Motor detenido");
        return false;
    }
    
    if ($this->velocidad == 0) {
        $this->infoError("No se puede frenar si la velocidad es 0");
        return false;
    }
    
    $this->velocidad -= $cantidad;
    if ($this->velocidad < 0) {
        $this->velocidad = 0; // Evitamos velocidades negativas
    }
    
    return true;
}
    
    public function recorre ():bool{
        if ($this->arrancado && $this->velocidad>0){
            $this->distanciaParcial+= $this->velocidad;
            $this->distanciaTotal+=$this->velocidad;
            return true;
        }else{
            $this->infoError("Motor apagado");
            return false;
        }
    }
    
    public function info():string{
        return "Modelo: ". $this->modelo . "Velocidad Actual: ". $this->velocidad . "Estado motor: ".$this->arrancado. "KMParciales : " . $this->distanciaParcial . "TOTAL KM: ". $this->distanciaTotal;
    }
    
    public function getKilometros():int{
        return $this->distanciaParcial;
    }
    
    private function infoError( String $mensaje):void{
        echo "<br><b>Error:</b> " . $mensaje;
    }	
}