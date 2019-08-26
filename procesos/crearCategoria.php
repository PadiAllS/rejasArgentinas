<?php

require_once '../clases/Categoria.php';
require_once '../clases/Db.php';

use app\clases\Db;
use app\clases\Categoria;

if(isset($_POST['guardarCategoria']))
{
        $conn = Db::getConexion();
        $categoria1 = Categoria::crearDesdeParametros($_POST);
        if ($categoria1->insertar()===0)
        {
            $_SESSION['mensaje'] = 'Error! no se actualizo el registro';
        } else {
            $_SESSION['mensaje'] = "La operacion fue exitosa.";
//            header('Location:../paginas/menuAdmin.php');
//            exit();
        }
        
}

?>
