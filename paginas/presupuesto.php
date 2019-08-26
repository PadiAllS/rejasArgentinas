<?php
require_once '../header.php';
require_once '../clases/Producto.php';
require_once '../clases/Categoria.php';
require_once '../clases/Config.php';
//require_once '../procesos/crearPresupuesto.php';

use app\clases\Producto;
use app\clases\Categoria;


error_reporting(E_ALL);
ini_set('display_errors', 1);

//require_once '../header.php';

//if (!isset($_SESSION['usuario'])) {
//    $_SESSION['mensaje'] = 'Login Inválido';
//    header('Location:../index.php');
//    exit();
//}


if (isset($_GET['quickSearchProd'])) {
    $listaProductos = Producto::busquedaRapida($_GET['searchProd']);
} else {
    $listaProductos = Producto::buscarCriteros();
}

//$listaCategorias = Categoria::buscarCriteros();

?>

<div class="row">
    <div class="col-md-12 alert alert-primary">
        <h3>PRESUPUESTO</h3>
    <?php
                if(!empty($_SESSION['presupuesto']))
                {
    ?>
                
    <table class="table">
            <thead>
                <tr>
                    <th>id</th>
                    <th>Nombre</th>
                    <th>Precio M2 $</th>
                    <th>Alto</th>
                    <th>Ancho</th>
                    <th>Cantidad</th>
                    <th>Precio</th>
                    <th>Quitar</th>
                </tr>
            </thead>
            
            <tbody>

                <?php
                $total=0;
                foreach ($_SESSION['presupuesto'] as $key =>$prodPresu) {
                    $superficie=  (($prodPresu['alto']*$prodPresu['ancho'])/10000);   
                    $precProd= ($superficie*$prodPresu['cantidad']*$prodPresu['precioM2']);
                    ?>
                    <tr>
                        <td><?= $prodPresu['id']?></td>
                        <td><?= $prodPresu['nombre']?></td>
                        <td><?= $prodPresu['precioM2']?></td>
                        <td><?= number_format($prodPresu['alto'],2)?></td>
                        <td><?= number_format($prodPresu['ancho'],2)?></td>
                        <td><?= number_format($prodPresu['cantidad'],2)?></td>
                        <td><?= number_format($precProd,2)?></td>
                        <td>
                            <form action="../procesos/crearPresupuesto.php" method="post">
                                <input type="hidden" name="idProd" id="idProd" value="<?= openssl_encrypt($prodPresu['id'], COD, KEY) ?>">
                                <button class="btn btn-danger" type="submit" name="btnAccion" value="borrar">Quitar</button>
                            </form>
                        </td>
            </tr>
                <?php 
                    $total = $total+ $precProd;
                
                }
                ?>
                    <tr>
                        <td colspan="4"><h4>Total</h4></td>
                        <td colspan="2"><h4><?= number_format($total,2) ?> </h4></td>
                        
                    </tr>
                    
                    <tr>
                        <td colspan="8">
                            <form action="../procesos/crearPresupuesto.php" method="post">
                                <div class="form-group">
                                    <?php
                                        if (!isset($_SESSION['usuario'])) {
                                    ?>
                                    
                                    <button type="button" class="btn btn-primary btn-lg btn-block" data-toggle="modal" data-target="#myModal">
                                    Enviar Presupuesto </button>
                                    <?php 
                                        } else {
                                    ?>        
                                    <input type="hidden" name="montoPresupuesto" id="idProd" value="<?= $total ?>">
                                    <button class="btn btn-primary btn-lg btn-block" type="submit" value="enviar" name="btnAccion">Enviar Presupuesto</button>
                                    <?php
                                    }
                                    ?>
                                </div>
                            </form>
                        </td>
                    </tr>

            </tbody>
        </table>
    <?php 
        } else {
    ?>        
    <div class="alert alert-primary">
        No ha seleccionado productos!
    </div>
    <?php    
        }
    ?>
</div>
</div>

<br>
<br>


<div class="row">
        <div class="columna col-md-4">
            <div>
                     <H3>Agregar Productos</H3>
            </div>
        </div>    
        <div class="columna col-md-8">
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

<div class="row">
    <?php
        foreach($listaProductos as $producto)
        {
    ?>
    <div class="col-md3">
        <div class="card">
            <img 
                title="<?= $producto->getNomProducto() ?>" 
                alt="<?= $producto->getNomProducto() ?>" 
                class="card-img-top"
                src="<?= $producto->getImagenProducto() ?>"
                height="250px"
            >    
<!--                data-toggle="popover"
                data-trigger="hover"
                data-content="<?// =  $producto->getDescripcionProducto ?>"-->
            
            <div class="card-body">
                <span><?= $producto->getNomProducto() ?></span>
                <h5>$ <?= $producto->getPrecioM2Producto() ?>-M2</h5>
                <p class="card-text">Descripcion</p>
                <div class="form-group">
                    <form action="../procesos/crearPresupuesto.php" method="post">
                        <input type="hidden" class="form-control" name="idProd" id="" value="<?= openssl_encrypt($producto->getIdProducto(), COD, KEY) ?>">
                        <input type="hidden" class="form-control" name="nombProd" id="" value="<?= openssl_encrypt($producto->getNomProducto(), COD, KEY) ?>">
                        <input type="hidden" class="form-control" name="precM2Prod" id="" value="<?= openssl_encrypt($producto->getPrecioM2Producto(), COD, KEY) ?>">
                        
                        <label>Ingrese el alto (en Cm):</label>
                        <input type="text" class="form-control" name="altoProd" id="" value="">
                        <label>Ingrese el ancho (en Cm):</label>
                        <input type="text" class="form-control" name="anchoProd" id="" value="">
                        <label>Ingrese la cantidad:</label>
                        <input type="text" class="form-control" name="cantProd" id="" value="1">
                    
                                          
                <button class="btn btn-primary" 
                        name="btnAccion" 
                        value="agregar" 
                        type="submit">Agregar al Presupuesto
                </button>
                </form>
                
                </div>
            </div>
               
                 
        </div>
    </div>
    <?php
        }
        ?>
</div>

<!--<script>
    $(function () {
        $('[data-toggle="popover"]').popover()
    })
</script>-->
 


<?php
include_once 'footer.php';
?>

    
