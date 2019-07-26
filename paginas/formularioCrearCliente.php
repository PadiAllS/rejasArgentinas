<?php
require_once 'header.php';
require_once '../clases/TipoDocumento.php';

$tiposDocumento = new app\clases\TipoDocumento();

//if(isset($_SESSION['usuario']))
//{
//    require_once 'menuAdmin.php';
//}

?>




    <div class="col-md-8">
        <div class="row">
        <div class="columna col-md-6">
            <div class="">
                        <h2>Cargar Clientes</h2>

            </div>
        </div>
        <div class="columna col-md-6">
            <div class="">
                <?=$mensaje??""?>
            </div>
        </div>
        </div>
        
            <form role="form" method="POST" action="crearCliente.php">
                <div class="form-group">

                    <label for="nombreCliente">
                        Nombre:
                    </label>
                    <input type="text" class="form-control" id="nombreCliente" name="nombreCliente"><br>
                    
                    <label for="tipoDocumento">
                        Documento Tipo:
                    </label>
                    <select name="tipoDocCliente">
                        <?php
                        foreach ($tiposDocumento->getTipoDoc() as $tipo) {
                            echo "<option>$tipo</option>";
                        }
                        ?>
                    </select>
                    <div class="row">
                        <div class="form-group col-md-6">
                            <label for="nroDocCliente">
                                Nro:
                            </label>
                            <input type="text" class="form-control" id="nroDocCliente" name="nroDocCliente">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="telCliente">
                                Telefono:
                            </label>
                            <input type="text" class="form-control" id="telCliente" name="telCliente">
                        </div>
                    </div>    
                        <label for="direccionCliente">
                            Direccion:
                        </label>
                        <input type="text" class="form-control" id="direccionCliente" name="direccionCliente">


                        <label for="mailCliente">
                            Email:
                        </label>
                        </label>
                        <input type="email" class="form-control" id="mailCliente" name="mailCliente">
                        <div class="row">
                            <div class="form-group col-md-6">

                                <label for="username">
                                    Nombre de Usuario:
                                </label>
                                <input type="text" class="form-control" id="username" name="username">
                            </div>
                            <div class="form-group col-md-6">

                                <label for="password">
                                    Password
                                </label>
                                <input type="password" class="form-control" id="password" name="password">
                            </div>
                        </div>
                            <button type="submit" class="btn btn-primary" name="btnGuardarCliente">
                                Guardar
                            </button>
                </div>
                </form>
    
    <div class="col-md-3">
        
    </div>
</div>


<?php
include_once 'footer.php';
?>