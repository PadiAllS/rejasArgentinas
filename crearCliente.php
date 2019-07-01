<?php
require_once 'header.php';
require_once 'clases/Clientes.php';
require_once 'clases/Usuario.php';
require_once 'clases/Db.php';

use app\clases\Db;
use app\clases\Usuario;
use app\clases\Clientes;

if(isset($_POST['btnGuardarCliente']))
{
    try 
    {
        $conn = Db::getConexion();
        $conn->beginTransaction();
        $cliente1 = Clientes::crearDesdeParametros($_POST);
        $cliente1->insertar();
        $_POST['idCliente']=$cliente1->getIdCliente();
        $user1= Usuario::crearDesdeParametros($_POST);
        $user1->insertar();
        $conn->commit();
        $mensaje = 'Operación exitosa';
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
    $mensaje = 'No se recibió la información necesaria para crear una persona';
}
?>
<div>
    <?= $mensaje ?>
</div>


<?php
require_once 'footer.php';
?>

