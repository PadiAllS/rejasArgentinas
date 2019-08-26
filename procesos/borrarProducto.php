<?php
require_once '../clases/Usuario.php';
require_once '../clases/Producto.php';
require_once '../clases/Db.php';

use app\clases\Usuario;
use app\clases\Producto;
use app\clases\Db;

// iniciar la sesión
// verificar que el usuario esté logueado, en caso contrario redirigir a login.php
session_start();
if(!isset($_SESSION['usuario']))
{
   $_SESSION['mensaje']= 'Usuario invalido';
   header('Location:../procesos/listadoProducto.php');
   exit();
}
// verificar que hayamos recibido por GET el valor delId y en caso contrario, escribir un mensaje que diga que no se recibió el parámetro y redirigir a listarPersonas.php
if(!isset($_GET['delId']))
{
   echo "no se reconoce el parametro";
   header('Location:../procesos/listadoProductos.php');
   exit();
}
$id_persona= $_GET['delId'];   
// escribir la sentencia $sql = 'delete ... ';
$sql='DELETE FROM producto WHERE idProducto = :id';
// obtener conexión
$conn= Db::getConexion();
// preparar la sentencia 
$pst = $conn->prepare($sql);
// hacer el bindValue correspondiente
$pst->bindValue(':id', $_GET[delId]);
// ejecutar
$pst->execute();
// si el rowCount de la ejecución es distinto de 1 escribir en la sesión (mensaje) que algo salió mal
if($pst->rowCount()===0)
{
    $_SESSION['mensaje'] = 'Error! no se borro el registro';
} else {
    $_SESSION['mensaje'] = "La operacion fue exitosa. El procuto fue eliminado";
    header('Location:../paginas/menuAdmin.php');
    exit();
}

// // en caso contrario (el rowCount fue 1) escribir que la operación fue exitosa
// redirigir a listarPersonas.php


