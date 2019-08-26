<?php
require_once '../header.php';
require_once '../clases/Producto.php';
require_once '../clases/Categoria.php';
require_once '../clases/Db.php';

use app\clases\Producto;
use app\clases\Categoria;
use app\clases\Db;

try
{
	$idProducto = $_GET["modId"];
	$conn= Db::getConexion();
        $sql='select * from producto where idProducto = :idProducto';
        $pst=$conn->prepare($sql);
	$pst->bindParam(":idProducto", $idProducto, PDO::PARAM_INT);
	$pst->execute();
	$producto1 = $pst->fetch();
}
catch(PDOException $e)
{
	print_r($e->getMessage());
}


$listaCategorias = Categoria::buscarCriteros();
?>
<div class="col-md-8">
        
    <form role="form" method="POST" action="../procesos/actualizarProducto.php">
        <h2>Actualizar Producto</h2>
        <div class="row">    
            <div class="col-md-4">
            <div class="form-group">
                <label for="idProducto">
                    Id:
                </label>
                <input type="text" class="form-control" id="idProducto" name="idProducto" value="<?=$idProducto??''?>">
            </div>
            </div>
            <div class="col-md-8">
            <div class="form-group">
                <label for="nombreProducto">
                    Nombre:
                </label>
                <input type="text" class="form-control" id="nombreProducto" name="nombreProducto" value="<?=$producto1['nombreProducto']??''?>">
            </div>
            </div>
        </div>
        <div class="row">
            <div class="form-group col-md-2">
                <label for="categoria">
                    Categoria:
                </label><br>
                <select name="categoriaId" >
                    <?php
                        foreach ($listaCategorias as $categoria) {
                    ?>
                            <option><?=$categoria->getIdCategoria() ?></option>;
                                                    
                    <?php
                    
                        }
                    ?>
                </select>
            </div>
            <div class="form-group col-md-6">
                <label for="codBarraProducto">
                    Cod. de Barras:
                </label>
                <input type="text" class="form-control" id="codBarraProducto" name="codBarraProducto" value="<?=$producto1['codBarraProducto']??''?>">
            </div>
        </div>
        <div class="row">
            <div class="form-group col-md-4">
                <label for="stockProducto">
                    Stock:
                </label>
                <input type="text" class="form-control" id="stockProducto" name="stockProducto" value="<?=$producto1['stockProducto']??''?>">
            </div>
            <div class="form-group col-md-4">
                <label for="precioProducto">
                    Precio:
                </label>
                <input type="text" class="form-control" id="precioProducto" name="precioProducto" value="<?=$producto1['precioProducto']??''?>">
            </div>
            <div class="form-group col-md-4">
                <label for="precioM2Producto">
                    Precio x M2:
                </label>
                <input type="text" class="form-control" id="precioM2Producto" name="precioM2Producto" value="<?=$producto1['precioM2Producto']??''?>">
            </div>
        </div>
                <label for="descripcionProducto">
                    Descripcion:
                </label>
                <input type="text" class="form-control" id="descripcionProducto" name="descripcionProducto" value="<?=$producto1['descripcionProducto']??''?>">
            
                <div class="form-group">
					 
					<label for="imagenProcutos">
						Buscar imagen
					</label>
                    <input type="file" class="form-control-file" id="imagenProducto" name="imagenProducto" value="<?=$producto1['imagenProducto']??''?>"/>
<!--					<p class="help-block">
						Example block-level help text here.
					</p>-->
				</div>

                            
            <button type="submit" class="btn btn-primary" name="btnActualizarProducto">
                Actualizar
            </button>
            </div>
    </form>
    
</div>    
</div>



