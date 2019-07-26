<?php
require_once './clases/Producto.php';

use app\clases\Producto;
use app\clases\NullObjectError;
if(isset($_GET['delId']))
{
    try 
    {
        $idProducto= $_GET['delId'];
        $producto = Producto::buscarPorId($idProducto);
        $mensaje = ($producto->eliminar()===TRUE)?"El Producto {$producto->getNombreProducto()} se ha borrado correctamente":"Ocurrió un error al intentar borrar a {$producto->getNombreProducto()}";
        header('location:listadoProducto.php');
        exit();
    }catch(TypeError $e){
        $mensaje = 'Error al obtener la información del producto en la base de datos';
    }catch(NullObjectError $e)
    {
        $mensaje = 'El producto que se quiere borrar no existe';
    }catch(Throwable $e){
        error_log($e->getMessage());
        $mensaje = 'Error inesperado, consulte con su administrador';
    }
}else{
    $mensaje = 'No se recibió el identificador necesario para realizar la operación';
}
?>
<div>
    <?= $mensaje ?>
</div>

