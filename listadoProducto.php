<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

require_once 'header.php';

//session_start();
if (!isset($_SESSION['usuario'])) {
    $_SESSION['mensaje'] = 'Login Inválido';
    header('Location:index.php');
    exit();
}

require_once 'clases/Producto.php';

use app\clases\Producto;

if (isset($_GET['submit'])) {
    $listaProductos = Producto::buscarCriteros($_GET['nombre'], $_GET['descripcion'], $_GET['categoria']);
} else if (isset($_GET['quickSearch'])) {
    $listaProductos = Producto::busquedaRapida($_GET['quickSearch']);
} else {
    $listaProductos = Producto::buscarCriteros();
}

require_once 'header.php';

require_once 'menuAdmin.php';
?>

<div class="columna col-md-10">
    <div class="row d-flex">
        <div class="columna col-md-12">
            <div>
                <h2>Listado de Productos</h2>
            </div>
            <div class="">
                <form role="form" class="form-inline">
                    <div class="form-group m-2">
                        <input type="text" class="form-control" id="nombre" name="quickSearch" value='<?= $_GET['quickSearch'] ?? '' ?>'>
                    </div>
                    <button  type="submit" class="btn btn-primary float-right" name="quickSearch">
                        Buscar
                    </button>
                </form>
            </div>
            
            <div class="row">
                                <div class="col-sm-2">
                                    <div class="form-group">
                                        <label>Nombre</label>
                                        <input type="text" name="nombre" id="nombre" class="form-control" value="<?=$_GET['nombre']??'' ?>" placeholder="Ingrese nombre">
                                    </div>
                                </div>
                                <div class="col-sm-2">
                                    <div class="form-group">
                                        <label>Descripcion</label>
                                        <input type="text" name="descripcion" id="descripcion" class="form-control" value="<?=$_GET['descripcion']??'' ?>" placeholder="Ingrese descripcion">
                                    </div>
                                </div>
                                <div class="col-sm-2">
                                    <div class="form-group">
                                        <label>Categoria</label>
                                        <input type="text" name="categoria" id="categoria" class="form-control" value="<?=$_GET['categoria']??'' ?>" placeholder="Ingrese categoria">
                                    </div>
                                </div>
                                <div class="col-sm-2">
                                    <div class="form-group">
                                        <label>&nbsp;</label>
                                        <div><button type="submit" name="submit" value="search" id="submit" class="btn btn-primary"><i class="fa fa-fw fa-search"></i> Buscar</button></div>
                                    </div>
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
                            id
                        </th>
                        <th>
                            Categoria
                        </th>
                        <th>
                            Cod. Barras
                        </th>
                        <th>
                            Nombre
                        </th>
                        <th>
                            Stock
                        </th>
                        <th>
                            Descripcion
                        </th>
                        <th>
                            Imagen
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
foreach ($listaProductos as $producto) {
    ?>
                        <tr>
                            <td><?= $producto->getIdProducto() ?></td>
                            <td><?= $producto->getCategoriaId() ?></td>
                            <td><?= $producto->getCodBarraProducto() ?></td>
                            <td><?= $producto->getNomProducto() ?></td>
                            <td><?= $producto->getStockProducto() ?></td>
                            <td><?= $producto->getDescripcionProducto() ?></td>
                            <td><?= $producto->getImagenProducto() ?></td>
                            <td><?= $producto->getPrecioProducto() ?></td>
                            <td align="center">
                                <a href="borrarProducto.php?delId=<?=$producto->getIdProducto()?>" class="text-danger" onClick="return confirm('Está seguro de borrar el Producto seleccionado?');"><i class="fa fa-fw fa-trash"></i> Borrar</a>
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


