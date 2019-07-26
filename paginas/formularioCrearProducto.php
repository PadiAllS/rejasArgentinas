<?php
require_once '../paginas/header.php';
require_once '../clases/Producto.php';
require_once '../clases/Categoria.php';

use app\clases\Producto;
use app\clases\Categoria;

$listaCategorias = Categoria::buscarCriteros();
?>
<div class="col-md-8">
        
    <form role="form" method="POST" action="../procesos/crearProducto.php">
        <h2>Cargar Producto</h2>
            <div class="form-group">
                <label for="nombreProducto">
                    Nombre:
                </label>
                <input type="text" class="form-control" id="nombreProducto" name="nombreProducto" value='<?= $_POST['nombreProducto']??'' ?>'>
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
                <input type="text" class="form-control" id="codBarraProducto" name="codBarraProducto" value='<?= $_POST['codBarraProducto']??'' ?>'>
            </div>
        </div>
        <div class="row">
            <div class="form-group col-md-4">
                <label for="stockProducto">
                    Stock:
                </label>
                <input type="text" class="form-control" id="stockProducto" name="stockProducto" value='<?= $_POST['stockProducto']??'' ?>'>
            </div>
            <div class="form-group col-md-4">
                <label for="precioProducto">
                    Precio:
                </label>
                <input type="text" class="form-control" id="precioProducto" name="precioProducto" value='<?= $_POST['precioProducto']??'' ?>'>
            </div>
            <div class="form-group col-md-4">
                <label for="precioM2Producto">
                    Precio x M2:
                </label>
                <input type="text" class="form-control" id="precioProducto" name="precioProducto" value='<?= $_POST['precioProducto']??'' ?>'>
            </div>
        </div>
                <label for="descripcionProducto">
                    Descripcion:
                </label>
                <input type="text" class="form-control" id="descripcionProducto" name="descripcionProducto" value='<?= $_POST['descripcionProducto']??'' ?>'>
            
                <div class="form-group">
					 
					<label for="imagenProcutos">
						Buscar imagen
					</label>
                    <input type="file" class="form-control-file" id="imagenProducto" name="imagenProducto" />
<!--					<p class="help-block">
						Example block-level help text here.
					</p>-->
				</div>

                            
            <button type="submit" class="btn btn-primary" name="btnGuardarProducto">
                Guardar
            </button>
            </div>
    </form>
    
</div>    
</div>



