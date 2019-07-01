<?php
declare(strict_types=1);

namespace app\clases;

use \PDO;
class Db
{
    private static $conexion;
    /**
     * Implementación del método en el patrón Singleton, este método se encarga de devolver
     * una instancia ya creada de conexión a la BD, y si no existe la crea, la guarda para los siguientes
     * pedidos, y lo devuelve.
     * 
     */
    public static function getConexion(): PDO
    {
        if(isset(self::$conexion)){
            return self::$conexion;
        }else{
            $conexion = self::nuevaConexion();
            self::$conexion = $conexion;
            return self::$conexion;
        }
        
    }
    private static function nuevaConexion(): PDO
    {
        $host = "localhost";
        $user = "root";
        $pass = "padi";
        $database = "dbherreria";
        $charset = "utf8";
        $opt = [PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC];
        $db = new pdo("mysql:host={$host};dbname={$database};charset={$charset}", $user, $pass, $opt);
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $db;
        
    }
    
    
}