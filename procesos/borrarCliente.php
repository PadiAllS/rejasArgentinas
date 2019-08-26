<?php

require_once '../clases/Clientes.php';
require_once '../clases/Usuario.php';
require_once '../clases/Db.php';
use app\clases\Usuario;
use app\clases\Clientes;
use app\clases\Db;

session_start();
if(!isset($_SESSION['usuario']))
{
   $_SESSION['mensaje']= 'Usuario invalido';
   header('Location:index.php');
   exit();
}
// verificar que hayamos recibido por GET el valor delId y en caso contrario, escribir un mensaje que diga que no se recibió el parámetro y redirigir a listarPersonas.php
if(!isset($_GET['delId']))
{
   echo "no se reconoce el parametro";
   header('Location:../paginas/menuAdmin.php');
   exit();
}

$idCliente= intval($_GET['delId']);   

$conn= Db::getConexion();
$conn->beginTransaction();
$sql='DELETE FROM usuario WHERE clienteId = :id';
$pst = $conn->prepare($sql);
$pst->bindValue(':id', $idCliente);
$pst->execute();

$pst = $conn->prepare('DELETE FROM cliente WHERE idCliente = :idCli');
$pst->bindValue(':idCli', $idCliente);
$pst->execute();
$conn->commit();
if($pst->rowCount()===0)
{
    $_SESSION['mensaje'] = "Error! no se borro el registro";
} else {
    $_SESSION['mensaje'] = "La operacion fue exitosa. El cliente fue eliminado";
    header('Location:../paginas/menuAdmin.php');
    exit();
}
