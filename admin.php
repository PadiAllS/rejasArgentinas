<?php
require_once 'header.php';
require_once './clases/TipoDocumento.php';
$tiposDocumento = new app\clases\TipoDocumento();
?>

<?php
require_once 'menuAdmin.php';
?>

<div class="row">
    <div class="columna col-md-12">
        <form role="form" class="form-inline">
            <div class="form-group">

                <label for="cliente">
                    Nombre
                </label>
                <input type="text" class="form-control" id="nombreCliente" name="nombreCliente" value='<?php
                if (isset($_GET['nombreCliente'])) {
                    echo $_GET['nombreCliente'];
                } else {
                    echo "";
                }
                ?>'>
            </div>
            
                <button type="submit" class="btn btn-primary">
                    Buscar
                </button>
        </form>
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
                        T.Doc
                    </th>
                    <th>
                        Nro. Documento
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
                    <th>
                        Nomb. Usuario
                    </th>
                    <th>
                        Contrase;a
                    </th>
                </tr>
            </thead>
            <tbody>
                

            </tbody>
        </table>
    </div>
</div>
        <?php
        include_once'footer.php';
        ?>