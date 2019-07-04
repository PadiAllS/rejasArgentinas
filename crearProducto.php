<?php

require_once 'header.php';
require_once 'clases/Producto.php';
require_once 'clases/Categoria.php';
require_once 'clases/Db.php';

use app\clases\Db;
use app\clases\Producto;
use app\clases\Categoria;

if(isset($_POST['btnGuardarProducto']))
{
    try 
    {
        $conn = Db::getConexion();
        $producto1 = Producto::crearDesdeParametros($_POST);
        $producto1->insertar();
        
        header('Location:index.php');
        exit();
    }catch(TypeError $e){
        // hacer rollback de la transacción
        $mensaje = 'Error al obtener la información de la base de datos';
    }catch(Throwable $e){
        
        //$conn->mysql->rollback();
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


<?php
require_once 'footer.php';
?>

