<?php
include_once "app/dat/Producto.php";
include_once "app/config.php";

/*
 * Acceso a datos con BD Usuarios y Patrón Singleton 
 * Un único objeto para la clase
 * VERSION 1:  las sentencias precompiladas ser crean en cada función
 */
class AccesoDatos {
    
    private static $modelo = null;
    private $dbh = null;
    
    
    public static function getModelo(){
        // Si no existe lo crea el acceso de a la BD
        if (self::$modelo == null){
            self::$modelo = new AccesoDatos();
        }
        return self::$modelo;
    }
    
    

   // Constructor privado  Patron singleton, se accede por getModelo
   
    private function __construct(){
        
        try {
            $dsn = "mysql:host=".SERVER_DB.";dbname=".DATABASE.";charset=utf8";
            // Creo el objeto PDO estableciendo la conexión a la BD
            $this->dbh = new PDO($dsn,DB_USER,DB_PASSWD);
            // Si falla genera una excepción
            $this->dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e){
            echo "Error de conexión ".$e->getMessage();
            exit();
        }   
    }

    // Cierro la conexión anulando todos los objectos relacioanado con la conexión PDO (stmt)
    public static function closeModelo(){
        if (self::$modelo != null){
            $obj = self::$modelo;
            $obj->dbh = null;     // Cierro la conexión
            self::$modelo = null; // Borro el objeto.
        }
    }


    // Devuelvo un array de objeto de Productos
    public function getProductos ():array {
        $tproducto = [];
        // Sobre la conexión PDO prepara la consulta;
        $stmt_productos  = $this->dbh->prepare("select * from productos");
        // Los resultados se devuelven como objetos de la clase Usuarios
        $stmt_productos->setFetchMode(PDO::FETCH_CLASS, 'Producto');
        
        // Ejecuto la sentencias 
        if ( $stmt_productos->execute() ){
            //$tuser = $stmt_usuarios->fetchAll();
            // Mientra $user no sea false, sea un objeto
            while ( $producto = $stmt_productos->fetch()){
               // añado ese objeto a la tabla
               $tproducto[]= $producto;
            }
        }
        

        return $tproducto;
    }
    
    // Devuelvo un usuario o false
    public function getProducto (String $codigo) {
        $prod = false;
        $stmt_producto   = $this->dbh->prepare("select * from productos where codigo=:codigo");
        $stmt_producto->setFetchMode(PDO::FETCH_CLASS, 'Producto');
        $stmt_producto->bindParam(':codigo', $codigo);
        if ( $stmt_producto->execute() ){
             // Solo hay un objeto
             if ( $obj = $stmt_producto->fetch()){
                $prod= $obj;
            }
        }
        return $prod;
    }
    
    // UPDATE
    public function modProducto($producto):bool{
      
        $stmt_modprod   = $this->dbh->prepare("update productos set nombre=:nombre, stock=:stock, stock_min=:stock_min, precio=:precio where codigo=:codigo");
        $stmt_modprod->bindValue(':codigo',$producto->codigo);
        $stmt_modprod->bindValue(':nombre',$producto->nombre);
        $stmt_modprod->bindValue(':stock',$producto->stock);
        $stmt_modprod->bindValue(':stock_min',$producto->stock_min);
        $stmt_modprod->bindValue(':precio',$producto->precio);
        $stmt_modprod->execute();
        // El número de filas modificadas debe ser 1
        $resu = ($stmt_modprod->rowCount () == 1);
        return $resu;
    }

    //INSERT
    public function addProducto($producto):bool{
        $stmt_creaprod  = $this->dbh->prepare("insert into productos (codigo,nombre,stock,stock_min,precio) Values(?,?,?,?,?)");
        //$stmt_creaprod->bindValue(1,$producto->codigo);
        $stmt_creaprod->execute( [$producto->codigo, $producto->nombre, $producto->stock, $producto->stock_min, $producto->precio]);
        $resu = ($stmt_creaprod->rowCount () == 1);
        return $resu;
    }

    //DELETE
    public function borrarProducto(String $codigo):bool {
        $stmt_borprod = $this->dbh->prepare("delete from productos where codigo =:codigo");
        $stmt_borprod->bindValue(':codigo', $codigo);
        $stmt_borprod->execute();
        $resu = ($stmt_borprod->rowCount () == 1);
        return $resu;
    }   
    
     // Evito que se pueda clonar el objeto. (SINGLETON)
    public function __clone()
    { 
        trigger_error('La clonación no permitida', E_USER_ERROR); 
    }
}

