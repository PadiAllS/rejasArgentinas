<?php
require_once '../clases/Usuario.php';
require_once '../clases/Producto.php';
require_once '../clases/Categoria.php';
require_once '../clases/Db.php';
require_once '../clases/Uploads.php';

use app\clases\Usuario;
use app\clases\Db;
use app\clases\Producto;
use app\clases\Categoria;
use app\clases\Uploads;

session_start();
if(!isset($_SESSION['usuario']))
{
   $_SESSION['mensaje']= 'Usuario invalido';
   header('Location:index.php');
   exit();
}

$dirSubida = dirname(__FILE__).'/../imagen/productos/';

$uploads = new Uploads($dirSubida,'imagenProducto');
if($uploads->procesarUpload()){
    $_POST['imagenProducto']= $uploads->getArchivoCargado();
}


if(isset($_POST['btnGuardarProducto']))
{
    try 
    {
        $conn = Db::getConexion();
        $producto1 = Producto::crearDesdeParametros($_POST);
        $producto1->insertar();
 
        }catch(TypeError $e){
        $conn->rollBack();
        $mensaje = 'Error al obtener la información de la base de datos';
        
        
        }catch(Throwable $e){
        error_log($e->getMessage());
        $mensaje = 'Error inesperado, consulte con su administrador';
    }
}else{
    $mensaje = 'No se recibió la información necesaria para crear un producto';
}
?>
<div>
    <?= $mensaje ?>
</div>

