<?php
require_once 'header.php';
require_once './clases/TipoDocumento.php';

$tiposDocumento = new app\clases\TipoDocumento();

if(isset($_SESSION['usuario']))
{
    require_once 'menuAdmin.php';
}

?>




    <div class="col-md-5">
        <form role="form" method="POST" action="crearCliente.php">
            <h2>Cargar Clientes</h2>
            <div class="form-group">

                <label for="nombreCliente">
                    Nombre:
                </label>
                <input type="text" class="form-control" id="nombreCliente" name="nombreCliente"><br>
                <label>Documento</label>
                <label for="tipoDocumento">
                    Tipo:
                </label>
                <select name="tipoDocCliente">
                    <?php
                    foreach ($tiposDocumento->getTipoDoc() as $tipo) {
                        echo "<option>$tipo</option>";
                    }
                    ?>
                </select>
                <label for="nroDocCliente">
                    Nro:
                </label>
                <input type="text" class="form-control" id="nroDocCliente" name="nroDocCliente">
                
                <label for="direccionCliente">
                    Direccion:
                </label>
                <input type="text" class="form-control" id="direccionCliente" name="direccionCliente">
                <label for="telCliente">
                    Telefono:
                </label>
                <input type="text" class="form-control" id="telCliente" name="telCliente">

                <label for="mailCliente">
                    Email:
                </label>
                </label>
                <input type="email" class="form-control" id="mailCliente" name="mailCliente">
                <label for="username">
                    Nombre de Usuario:
                </label>
                <input type="text" class="form-control" id="username" name="username">
            </div>
            <div class="form-group">

                <label for="password">
                    Password
                </label>
                <input type="password" class="form-control" id="password" name="password">
            </div>

            <button type="submit" class="btn btn-primary" name="btnGuardarCliente">
                Guardar
            </button>
        </form>
    </div>
    <div class="col-md-3">
        
    </div>
</div>


<?php
include_once 'footer.php';
?>