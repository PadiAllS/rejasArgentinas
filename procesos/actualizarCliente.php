<?php

require_once '../clases/Clientes.php';
require_once '../clases/Db.php';

use app\clases\Db;
use app\clases\Clientes;

if(isset($_POST['btnactualizarCliente']))
{
        $conn = Db::getConexion();
        $cliente1 = Clientes::crearDesdeParametros($_POST);
        if ($cliente1->actualizar()===0)
        {
            $_SESSION['mensaje'] = 'Error! no se actualizo el registro';
        } else {
            $_SESSION['mensaje'] = "La operacion fue exitosa. El cliente fue actualizado";
            header('Location:../paginas/menuAdmin.php');
            exit();

        }
}

?>