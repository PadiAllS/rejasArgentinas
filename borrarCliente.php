<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
require_once './clases/Clientes.php';
require_once './clases/Usuario.php';
require_once 'header.php';

use app\clases\Clientes;
use app\clases\Usuario;
use app\clases\Db;

//session_start();
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
        // usar esa conexión para iniciar una transacción
        $conn->beginTransaction();
        // obtener la persona a partir del ID (línea de abajo)
        $idCliente = intval($_GET['delId']);
        $usuario1 = Usuario::buscarPorId($idCliente);
        // invocar el getCompania de persona que obtiene un objeto compania
        //$cia = $persona->getCompania();
        // invocar el metodo eliminar del objeto compania obtenido
        $usuario1->eliminar();
        // invocar el metodo getInformacionAmigos del objeto persona para obtener un arreglo de amigos
        $cliente1 = Clientes::buscarPorId($idCliente);
        $cliente1->eliminar();
        // realizar el commit de la transaccion
        $conn->commit();
        $mensaje = 'Operación exitosa';
        
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









$conn= Db::getConexion();
$conn->beginTransaction();
$idCliente= $_GET['delId']; 

$cliente = Clientes::buscarPorId($idCliente);


$pst = $conn->prepare($sql);
$pst->bindValue(':id', $id_persona);
$pst->execute();

if($pst->rowCount()===0)
{
    $_SESSION['mensaje'] = 'Error! no se borro el registro';
} else {
    $_SESSION['mensaje'] = "La operacion fue exitosa. La persona fue eliminada";
    header('Location:listarPersonas.php');
    exit();
}

// // en caso contrario (el rowCount fue 1) escribir que la operación fue exitosa
// redirigir a listarPersonas.php




