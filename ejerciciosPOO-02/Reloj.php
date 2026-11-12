<?php

class Reloj
{
    private $segundos;
    private $formato24;

    private $segundosAlarma;

    private $alarmaActiva;
    
    public function __construct ( int $hora, int $minutos, int $segundos){
        $this->segundos = $segundos + ($hora * 60 *60)+ ($minutos * 60);
        $this->formato24 = true;
        $this->alarmaActiva = false;

    }

    public function fijarAlarma(int $hora, int $minutos){
        $this->segundosAlarma = ($hora*3600) + ($minutos*60);
    }
    
    public function activarAlarma(bool $activo){
        if ($activo){
            $this->alarmaActiva = true;
        }else{
            $this->alarmaActiva = false;
        }
        //$this->alarmaActiva = $activo;
    }
    // Mostrar la hora: genera un String con el  formado de hora  22:30:23
    // o 10:30:23 pm si el atributos Formato24 es falso
    
    public function mostrar() {
        $segundosTotales = $this->segundos;
        
        $segundos = $segundosTotales % 60;
        $minutos = intdiv($segundosTotales, 60) % 60;
        $horas24 = intdiv($segundosTotales, 3600) % 24;

        if ($this->formato24) {
            // Formato 24 horas (ej: 22:30:23)
            return sprintf("%02d:%02d:%02d", $horas24, $minutos, $segundos);
        } else {
            // Formato 12 horas (ej: 10:30:23 pm)
            $sufijo = ($horas24 >= 12) ? "pm" : "am";
            $horas12 = $horas24 % 12;
            if ($horas12 == 0) {
                $horas12 = 12; // Las 00:00 o las 12:00 se muestran como 12
            }
            return sprintf("%02d:%02d:%02d %s", $horas12, $minutos, $segundos, $sufijo);
        }
    }
    
    // Cambiar formato24, recibe un valor true si quiero formato de
    // 24 o falso si quiero de 12
    public function  cambiarFormato24( bool $formato24){
        $this->formato24 = $formato24;
    }
    
    // Incrementa en un segundo el valor de reloj
    public function tictac (){
        $this->segundos++;
        if ($this->alarmaActiva == true && $this->segundos == $this->segundosAlarma){
            echo "ALARMA ACTIVA, DESPIERTAAAA";
        }
    }
    
    // Comparar Hora, recibe como parámetro otro objeto Reloj
    // y me devuelve el número de segundos que tienen de diferencia
    
    public function comparar ( Reloj $otroreloj){
        return abs($this->segundos - $otroreloj->segundos);
    }    
}