<?php
require_once 'header.php';
require_once 'menuAdmin.php';
require_once './clases/Producto.php';
require_once './clases/Categoria.php';

use app\clases\Producto;
use app\clases\Categoria;

$listaCategorias = Categoria::buscarCriteros();
?>
<div class="col-md-6">
        
    <form role="form" method="POST" action="crearProducto.php">
            <h2>Cargar Producto</h2>
            <div class="form-group">

                <label for="categoria">
                    Categoria:
                </label>
                <select name="categoriaId" >
                    <?php
                        foreach ($listaCategorias as $categoria) {
                        ?>
                            <option><?=$categoria->getIdCategoria() ?></option>;
                    <?php
                    
                        }
                    ?>
                </select><br><br>
                <label for="codBarraProducto">
                    Cod. de Barras:
                </label>
                <input type="text" class="form-control" id="codBarraProducto" name="codBarraProducto" value='<?= $_POST['codBarraProducto']??'' ?>'>
                
                <label for="nombreProducto">
                    Nombre:
                </label>
                <input type="text" class="form-control" id="nombreProducto" name="nombreProducto" value='<?= $_POST['nombreProducto']??'' ?>'>
                
                <label for="stockProducto">
                    Stock:
                </label>
                <input type="text" class="form-control" id="stockProducto" name="stockProducto" value='<?= $_POST['stockProducto']??'' ?>'>
                <label for="descripcionProducto">
                    Descripcion:
                </label>
                <input type="text" class="form-control" id="descripcionProducto" name="descripcionProducto" value='<?= $_POST['descripcionProducto']??'' ?>'>

                <label for="imagenProducto">
                    Imagen:
                </label>
                </label>
                <input type="text" class="form-control" id="imagenProducto" name="imagenProducto" value='<?= $_POST['imagenProducto']??'' ?>'>
                <label for="precioProducto">
                    Precio x M2:
                </label>
                <input type="text" class="form-control" id="precioProducto" name="precioProducto" value='<?= $_POST['precioProducto']??'' ?>'>
            </div>
            
            <button type="submit" class="btn btn-primary" name="btnGuardarProducto">
                Guardar
            </button>
        </form>
    </div>
</div>    
</div>



