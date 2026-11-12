<?php
/**
 * Fichero: BiciElectrica.php 
 * Implementa la clase para la gestión de bicicletas eléctricas.
 */
class BiciElectrica {

    // Atributos privados
    private int $id;         // Identificador de la bicicleta (entero)
    private int $coordx;     // Coordenada X (entero)
    private int $coordy;     // Coordenada Y (entero)
    private int $bateria;   // Carga de la batería en tanto por ciento (entero)
    private int $operativa; // Estado de la bicicleta (true operativa - false no disponible)

    /**
     * Constructor para inicializar el objeto BiciElectrica.
     */
    public function __construct($id, $coordx, $coordy, $bateria, $operativa) {
        $this->id = (int)$id;
        $this->coordx = (int)$coordx;
        $this->coordy = (int)$coordy;
        $this->bateria = (int)$bateria;
        $this->operativa = (bool)$operativa; 
    }

    /**
     * Métodos mágicos setter y getter 
     */
    public function __get($name) {
        if (property_exists($this, $name)) {
            return $this->$name;
        }
        return null;
    }

    public function __set($name, $value) {
        if (property_exists($this, $name)) {
            $this->$name = $value;
        }
    }

    /**
     * Método __ToString 
     * Devuelve el id de la bicicleta y el estado de la batería.
     */
    public function __toString() {
        return "Identificador: $this->id Bateria $this->bateria %";
    }

    /**
     * Devuelve la distancia entre las coordenadas pasadas como parámetro
     * y las coordenadas de la bicicleta aplicando la fórmula de distancia entre dos puntos[cite: 3]. 
     */
    public function distancia($x, $y) {
        // Se aplica la fórmula matemática de la distancia euclidiana: sqrt((x2 - x1)^2 + (y2 - y1)^2)[cite: 3]
        return sqrt(pow($this->coordx - $x, 2) + pow($this->coordy - $y, 2));
    }
}