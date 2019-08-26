<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
//require_once '../header.php';

if (!isset($_SESSION['usuario']))
{
    $_SESSION['mensaje'] = 'Login Inválido';
    header('Location:../index.php');
    exit();
}

require_once '../clases/Categoria.php';

use app\clases\Categoria;



if(isset($_GET['quickSearchCat'])){
    $listaCategorias = Categoria::busquedaRapida($_GET['searchCat']);   
} else {
    $listaCategorias = Categoria::buscarCriteros();
}
?>

<div class="columna col-md-12">
    <div class="row">
        <div class="col-md-6">
            <a href="../paginas/formularioCrearCategoria.php" class="btn btn-outline-primary"><i class="fa fa-fw fa-trash"></i>Agregar Categoria <img src="../imagen/botones/botonA.png"></a>
        </div>
        <div class="col-md-6">
            <div class="float-right">
            <form role="form" class="form-inline" >
                <div class="form-group">
                    <input type="text" class="form-control" id="nombre" name="searchCat" value='<?= $_GET['search']??'' ?>'>
                </div>
                <button type="submit" class="btn btn-primary" name="quickSearchCat">
                        Buscar
                </button>
            </form>
            </div>
       </div>
    </div>
</div>
    <div class="row">
    <div class="col-md-12">
        <table class="table">
            <thead>
                <tr>
                    <th>
                        Id Categoria
                    </th>
                    <th>
                        Nombre Categoria
                    </th>
                    <th>
                        Descripcion
                    </th>
                    <th>
                        Condicion
                    </th>
                    <th>
                        Opcion
                    </th>
                    
                    
                </tr>
            </thead>
            <tbody>
                
                <?php
                foreach ($listaCategorias as $categoria) {
                    ?>
                    <tr>
                        <td><?=$categoria->getIdCategoria() ?></td>
                        <td><?=$categoria->getNombreCategoria() ?></td>
                        <td><?=$categoria->getDescripcionCategoria() ?></td>
                        <td><?php
                        if($categoria->getCondicionCategoria()== 1)
                        {
                            echo '<a href="../procesos/actualizarCategoria.php?desId=<?=$categoria->getIdCategoria()?>" class="btn btn-outline-success" name="btndesactivarCategoria"><i class="fa fa-fw fa-trash"></i>Activa</a>';    
                        } else {
                            echo '<a href="../porcesos/actualizarCategoria.php?actId=<?=$categoria->getIdCategoria()?>" class="btn btn-outline-danger" name="btnactivarCategoria"><i class="fa fa-fw fa-trash"></i>Bloqueada</a>';
                        }
                        ?>
                        </td>
                        <td align="center">
                            <a href="../paginas/formularioActualizarCategoria.php?modId=<?=$categoria->getIdCategoria()?>" class="btn btn-outline-success"><i class="fa fa-fw fa-trash"></i><img src="../imagen/botones/botonM.png"</a>
                        </td>
                        

                    </tr>
                        <?php } ?>
                
                

            </tbody>
        </table>

    </div>
</div>
</div>
