<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

if (!isset($_SESSION['usuario']))
{
    $_SESSION['mensaje'] = 'Login Inválido';
    header("Location:index.php");
    exit();
}

require_once '../clases/Clientes.php';

use app\clases\Clientes;



if(isset($_GET['quickSearchCli'])){
    $listaClientes = Clientes::busquedaRapida($_GET['searchCli']);   
} else {
    $listaClientes = Clientes::buscarCriteros();
}

?>

<div class="columna col-md-12">
<div class="row d-flex ">
    <div class="columna col-md-6">
        <div class="">
            <?php
                if(isset($_SESSION['mensaje']))
                {  
                    echo ($_SESSION['mensaje']);
                    unset($_SESSION['mensaje']);
                }
            ?>
        </div>
    </div>
    <div class="columna col-md-6">
        <div class="float-right">
            <form role="form" class="form-inline" method="GET">
                <div class="form-group">
                    <input type="text" class="form-control" id="nombre" name="searchCli" value='<?= $_GET['search']??'' ?>' placeholder="Busqueda rapida...">
                </div>
                <button type="submit" class="btn btn-primary" name="quickSearchCli">
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
                    <th colspan="2">
                        Opciones
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
                            <a href="../paginas/formularioActualizarCliente.php?modId=<?=$cliente->getIdCliente()?>" class="btn btn-outline-success"><i class="fa fa-fw fa-trash"></i> Actualizar</a>
                        </td>
                        <td align="center">
                            <a href="../procesos/borrarCliente.php?delId=<?=$cliente->getIdCliente()?>" class="btn btn-outline-danger" onClick="return confirm('Está seguro de borrar el Cliente seleccionado?');"><i class="fa fa-fw fa-trash"></i> Borrar</a>
                        </td>


                    </tr>
               <?php } ?>
                
                  </tbody>
        </table>

    </div>
</div>
</div>
