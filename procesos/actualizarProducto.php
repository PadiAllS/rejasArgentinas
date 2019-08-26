<?php
require_once '../clases/Usuario.php';
require_once '../clases/Producto.php';
require_once '../clases/Db.php';

use app\clases\Usuario;
use app\clases\Db;
use app\clases\Producto;

session_start();
if(!isset($_SESSION['usuario']))
{
   $_SESSION['mensaje']= 'Usuario invalido';
   header('Location:index.php');
   exit();
}

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
