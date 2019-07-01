<?php
require_once 'header.php';
require_once './clases/TipoDocumento.php';
$tiposDocumento = new app\clases\TipoDocumento();
?>

<?php
require_once 'menuAdmin.php';
?>


<div class="col-md-9">
    <div class="row d-flex">
        <div class="columna col-md-12">
            <form role="form" class="form-inline">
                <div class="form-group">
      
                <div class="form-group ">
                    <label for="producto">
                        Producto
                    </label>
                    <input type="text" class="form-control" id="apellido" name="apellido" value='<?php
                    if (isset($_GET['producto'])) {
                        echo $_GET['producto'];
                    } else {
                        echo "";
                    }
                    ?>'>
                </div>
                <div class="form-group">
                    <div class="checkbox">
                        <select>
                            <option> - </option>
                            <option> Activo </option>
                            <option> Bloqueado </option>
                        </select>
                        <button type="submit" class="btn btn-primary">
                            Buscar
                        </button>
                    </div>
                </div>
            </form>
        </div>

        <div class="row container">
        <div class="col-md-9">
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
                            Imagen
                        </th>
                        <th>
                            Condicion
                        </th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    foreach (\app\Clases\ListaProducto::obtenerListaProducto() as $producto) {
                        echo "
                            <tr>
                    <th>
                        {$producto["idProducto"]}
                    </th>
                    <th>
                        {$producto["nombreCategoria"]}
                    </th>
                    <th>
                        {$producto["nombreProducto"]}
                    </th>
                    <th>
                        {$producto["stockProducto"]}
                    </th>
                    <th>
                        {$producto["DescripcionProducto"]}
                    </th>
                    <th>
                        {$producto["imagenProducto"]}
                    </th>
                    <th>
                        {$producto["condicionProducto"]}
                    </th>
                </tr>";
                    }
                    ?>

                </tbody>
            </table>
        </div>
    </div>
</div>
</div>
<?php
include_once'footer.php';
?>