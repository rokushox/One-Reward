<?php 
/*clase para establecer una conexion entre el blog y la base de datos*/
class Conexion{
    private static $conexion;
    /*al ser static no hay que crear "new conexion"*/
    public static function abrir_conexion(){
        if (!isset(self::$conexion)){ /*isset devuelve "verdadero o falso" y el ! es una negacion*/ 
            try {
                include_once "config.inc.php";
            
                self::$conexion = new PDO('mysql:host='.NOMBRE_SERVIDOR.'; dbname='.NOMBRE_BD, NOMBRE_USUARIO, PASSWORD);
                self::$conexion -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); /*Esto es para que nos avise el error la base de datos*/
                self::$conexion -> exec("SET CHARACTER SET utf8");
                
            } catch (PDOException $ex) {
                print "ERROR: " . $ex -> getMessage() . "<br>";
                die();/*cierra la conexion el die si ocurre un error*/
            }
        }        
    }
    
    public static function cerrar_conexion(){
        if (isset(self::$conexion)){
            self::$conexion = null;
        }
    }
    
    public static function obtener_conexion(){ /*metodo para usar la conexion desde fuera de la clase*/
        return self::$conexion;  
    }
}




