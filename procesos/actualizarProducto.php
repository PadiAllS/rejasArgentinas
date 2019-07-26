<?php

require_once '../clases/Producto.php';
require_once '../clases/Db.php';

use app\clases\Db;
use app\clases\Producto;

if(isset($_POST['btnActualizarProducto']))
{
        $conn = Db::getConexion();
        $producto1 = Producto::crearDesdeParametros($_POST);
        if ($producto1->actualizar()===0)
        {
            $_SESSION['mensaje'] = 'Error! no se actualizo el registro';
        } else {
            $_SESSION['mensaje'] = "La operacion fue exitosa. El producto fue actualizado";
            header('Location:../paginas/menuAdmin.php');
            exit();

        }
}

?>
