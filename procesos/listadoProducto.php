<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

//require_once '../header.php';

if (!isset($_SESSION['usuario'])) {
    $_SESSION['mensaje'] = 'Login Inválido';
    header('Location:../index.php');
    exit();
}

require_once '../clases/Producto.php';

use app\clases\Producto;

if (isset($_GET['submitProd'])) {
    $listaProductos = Producto::buscarCriteros($_GET['nombreProd'], $_GET['descripcionProd'], $_GET['categoriaProd']);
} else if (isset($_GET['quickSearchProd'])) {
    $listaProductos = Producto::busquedaRapida($_GET['searchProd']);
} else {
    $listaProductos = Producto::buscarCriteros();
}

?>

<div class="columna col-md-12">
    <div class="row">
        <div class="col-md-6">
            <a href="../paginas/formularioCrearProducto.php" class="btn btn-outline-primary"><i class="fa fa-fw fa-trash"></i> Agregar Producto <img src="../imagen/botones/botonA.png"></a>
        </div>
        <div class="columna col-md-6">
            <div class="float-right">
            <form role="form" class="form-inline" >
                <div class="form-group">
                    <input type="text" class="form-control" id="nombre" name="searchProd" value='<?= $_GET['searchProd'] ?? '' ?>'>
                </div>
                <button type="submit" class="btn btn-primary" name="quickSearchProd">
                    Buscar
                </button>
            </form>
            </div>
        </div>
    </div>
</div>    
    <div class="row">
        <div class="col-sm-2">
            <div class="form-group">
                <label>Nombre</label>
                <input type="text" name="nombreProd" id="nombreProd" class="form-control" value="<?= $_GET['nombreProd'] ?? '' ?>" placeholder="Ingrese nombre">
            </div>
        </div>
        <div class="col-sm-2">
            <div class="form-group">
                <label>Descripcion</label>
                <input type="text" name="descripcionProd" id="descripcionProd" class="form-control" value="<?= $_GET['descripcionProd'] ?? '' ?>" placeholder="Ingrese descripcion">
            </div>
        </div>
        <div class="col-sm-2">
            <div class="form-group">
                <label>Categoria</label>
                <input type="text" name="categoriaProd" id="categoriaProd" class="form-control" value="<?= $_GET['categoriaProd'] ?? '' ?>" placeholder="Ingrese categoria">
            </div>
        </div>
        <div class="col-sm-2">
            <div class="form-group">
                <label>&nbsp;</label>
                <div><button type="submit" name="submitProd" value="search" id="submitProd" class="btn btn-primary"><i class="fa fa-fw fa-search"></i> Buscar</button></div>
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
                        Nombre
                    </th>
                    <th>
                        Stock
                    </th>
                    <th>
                        Descripcion
                    </th>
                    <th>
                        Precio
                    </th>
                    <th>
                        Precio M2
                    </th>
                    <th colspan="2">
                        Opciones
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
                        <td><?= $producto->getNomProducto() ?></td>
                        <td><?= $producto->getStockProducto() ?></td>
                        <td><?= $producto->getDescripcionProducto() ?></td>
                        <td><?= $producto->getPrecioProducto() ?></td>
                        <td><?= $producto->getPrecioM2Producto() ?></td>
                        <td align="center">
                            <a href="../paginas/formularioActualizarProducto.php?modId=<?= $producto->getIdProducto() ?>" class="btn btn-outline-success"><i class="fa fa-fw fa-trash"></i><img src="../imagen/botones/botonM.png"</a>
                        </td>
                        <td align="center">
                            <a href="../procesos/borrarProducto.php?delId=<?= $producto->getIdProducto() ?>" class="btn btn-outline-danger" onClick="return confirm('Está seguro de borrar el Producto seleccionado?');"><i class="fa fa-fw fa-trash"></i><img src="../imagen/botones/botonB.png"</a>
                        </td>
                    </tr>
                <?php } ?>

            </tbody>
        </table>

    </div>
</div>





