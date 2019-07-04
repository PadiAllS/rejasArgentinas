<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
require_once 'header.php';

//session_start();
if (!isset($_SESSION['usuario']))
{
    $_SESSION['mensaje'] = 'Login Inválido';
    header('Location:index.php');
    exit();
}

require_once './clases/Clientes.php';

use app\clases\Clientes;



if(isset($_GET['quickSearch'])){
    $listaClientes = Clientes::busquedaRapida($_GET['quickSearch']);   
} else {
    $listaClientes = Clientes::buscarCriteros();
}
require_once 'header.php';
require_once 'menuAdmin.php';

?>

<div class="columna col-md-10">
<div class="row d-flex">
    <div class="columna col-md-12">
       <div class="">
        <div>
                <h2>Listado de Clientes</h2>
        </div>
         
        <form role="form" class="form-inline">
                        
            <div class="form-group">
                
                
                <input type="text" class="form-control" id="nombre" name="quickSearch" value='<?= $_GET['quickSearch']??'' ?>'>
            </div>
            
            <button type="submit" class="btn btn-primary" name="quickSearch">
                    Buscar
            </button>
        </form>
       </div>
    </div>
</div>
<div class="row">
    <div class="columna col-md-12">
        <table class="table">
            <thead>
                <tr>
                    <th>
                        id
                    </th>
                    <th>
                        Nombre
                    </th>
                    <th>
                        Documento 
                    </th>
                    <th>
                        Direccion
                    </th>
                    <th>
                        Corre Electronico
                    </th>
                    <th>
                        Telefono
                    </th>
                    <th>
                        Opcion
                    </th>
                </tr>
            </thead>
            <tbody>
               <?php
                foreach ($listaClientes as $cliente) {
                    ?>
                    <tr>
                        <td><?=$cliente->getIdCliente() ?></td>
                        <td><?=$cliente->getNombreCliente() ?></td>
                        <td><?=$cliente->getTipoyNroDoc() ?></td>
                        <td><?=$cliente->getDireccionCliente() ?></td>
                        <td><?=$cliente->getMailCliente() ?></td>
                        <td><?=$cliente->getTelCliente() ?></td>
                        <td align="center">
                            <a href="borrarCliente.php?delId=<?=$cliente->getIdCliente()?>" class="text-danger" onClick="return confirm('Está seguro de borrar el Cliente seleccionado?');"><i class="fa fa-fw fa-trash"></i> Borrar</a>
                        </td>

                    </tr>
                        <?php } ?>
                
                  </tbody>
        </table>

    </div>
</div>
</div>

<?php
require_once 'footer.php';
?>     

  