<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
require_once 'header.php';
//session_start();
if (!isset($_SESSION['usuario']))
{
    $_SESSION['mensaje'] = 'Login Inválido';
    header('Location:login.php');
    exit();
}

require_once 'clases/Categoria.php';

use app\clases\Categoria;



if(isset($_GET['quickSearch'])){
    $listaCategorias = Categoria::busquedaRapida($_GET['quickSearch']);   
} else {
    $listaCategorias = Categoria::buscarCriteros();
}

require_once 'header.php';

require_once 'menuAdmin.php';



?>

<div class="columna col-md-10">
<div class="row d-flex">
    <div class="columna col-md-12">
        <div>
            <h2>Listado de Categorias</h2>
        </div>
        <div class="">
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
                        <td><?=($categoria->getCondicionCategoria()== 1)?'Activa':'Bloqueada'?></td>
                        

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