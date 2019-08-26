<?php
require_once '../clases/Usuario.php';
require_once '../clases/Categoria.php';
require_once '../clases/Db.php';

use app\clases\Usuario;
use app\clases\Db;
use app\clases\Categoria;

session_start();
if(!isset($_SESSION['usuario']))
{
   $_SESSION['mensaje']= 'Usuario invalido';
   header('Location:index.php');
   exit();
}

if(isset($_POST['btnactualizarCategoria']))
{
        $conn = Db::getConexion();
        $categoria1 = Categoria::crearDesdeParametros($_POST);
        if ($categoria1->actualizar()===0)
        {
            $_SESSION['mensaje'] = 'Error! no se actualizo el registro';
        } else {
            $_SESSION['mensaje'] = "La operacion fue exitosa. La categoria fue actualizada";
            header('Location:../paginas/menuAdmin.php');
            exit();

        }
}
if(isset($_POST['btnactivarCategoria']))
{
        $conn = Db::getConexion();
        $categoria1 = Categoria::crearDesdeParametros($_POST);
        if ($categoria1->activar()===0)
        {
            $_SESSION['mensaje'] = 'Error! no se actualizo el registro';
        } else {
            $_SESSION['mensaje'] = "La operacion fue exitosa. La categoria fue actualizada";
            header('Location:../paginas/menuAdmin.php');
            exit();

        }
}
if(isset($_POST['btndesactivarCategoria']))
{
        $conn = Db::getConexion();
        $categoria1 = Categoria::crearDesdeParametros($_POST);
        if ($categoria1->desactivar()===0)
        {
            $_SESSION['mensaje'] = 'Error! no se actualizo el registro';
        } else {
            $_SESSION['mensaje'] = "La operacion fue exitosa. La categoria fue actualizada";
            header('Location:../procesos/listadoCategoria.php');
            exit();

        }
}

?>
