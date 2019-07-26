<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
error_reporting(E_ALL);
ini_set('display_errors', 1);

require_once './clases/Clientes.php';
require_once './clases/Usuario.php';
require_once './clases/Db.php';
require_once 'header.php';

use app\clases\Clientes;
use app\clases\Usuario;
use app\clases\Db;

if(!isset($_SESSION['usuario']))
{
   $_SESSION['mensaje']= 'Usuario invalido';
   header('Location:index.php');
   exit();
}
if(!isset($_GET['delId']))
{
   echo "no se reconoce el parametro";
   header('Location:admin.php');
   exit();
}
  
if(isset($_GET['delId']))
{
    try 
    {
        $conn = Db::getConexion();
        $conn->beginTransaction();
        $clienteId = intval($_GET['delId']);
        $usuario1 = Usuario::buscarPorId($clienteId);
        $usuario1->eliminar();
        $idCliente = intval($_GET['delId']);
        $cliente1 = Clientes::buscarPorId($idCliente);
        $cliente1->eliminar();
        $conn->commit();
        $mensaje = 'Operación exitosa';
        header('Location:menuAdmin.php');
        exit();
        
    }catch(TypeError $e){
        // hacer rollback de la transacción
        $mensaje = 'Error al obtener la información de la base de datos';
    }catch(NullObjectError $e)
    {
        // hacer rollback de la transaccion
        $mensaje = 'La persona que se quiere borrar no existe';
    }catch(Throwable $e){
        // hacer rollback de la transacción
        error_log($e->getMessage());
        $mensaje = 'Error inesperado, consulte con su administrador';
    }
}else{
    $mensaje = 'No se recibió el identificador necesario para borrar ';
}
?>
<div>
    <?= $mensaje ?>
</div>