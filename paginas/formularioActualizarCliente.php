<?php
require_once 'header.php';
require_once '../clases/TipoDocumento.php';

$tiposDocumento = new app\clases\TipoDocumento();

//if(isset($_SESSION['usuario']))
//{
//    require_once 'menuAdmin.php';
//}

require_once '../clases/Db.php';
require_once '../clases/Clientes.php';
use app\clases\Clientes;
use app\clases\Db;

try
{
	$idCliente = $_GET["modId"];
	$conn= Db::getConexion();
        $sql='select * from cliente where idCliente = :idCliente';
        $pst=$conn->prepare($sql);
	$pst->bindParam(":idCliente", $idCliente, PDO::PARAM_INT);
	$pst->execute();
	$cliente1 = $pst->fetch();
}
catch(PDOException $e)
{
	print_r($e->getMessage());
}
?>


    <div class="col-md-8">
        <div class="row">
            <div class="columna col-md-6">
                <div class="">
                            <h2>Actualizar Cliente</h2>
                </div>
            </div>
            <div class="columna col-md-6">
                <div class="">
                    <?=$mensaje??""?>
                </div>
            </div>
        </div>
        
        <form role="form" method="POST" action="../procesos/actualizarCliente.php">
            <div class="row">
                <div class="form-group col-md-3"
                    <label for="idCliente">
                        Id:
                    </label>
                     <input type="text" class="form-control" id="idCliente" name="idCliente" maxlength="10" value="<?=$idCliente??''?>">
                </div>
                <div class="form-group col-md-9"
                    <label for="nombreCliente">
                        Nombre:
                    </label>
                     <input type="text" class="form-control" id="nombreCliente" name="nombreCliente" maxlength="45" value="<?=$cliente1['nombreCliente']??''?>">
                </div>
            </div>
            <div class="row">
                <div class="form-group col-md-4">
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
                </div>
            </div>
            <div class="row">
                <div class="form-group col-md-6"
                    <label for="nroDocCliente">
                        Nro:
                    </label>
                    <input type="text" class="form-control" id="nroDocCliente" name="nroDocCliente" value="<?=$cliente1['nroDocCliente']??''?>">
                </div>
                <div class="form-group col-md-6"
                    <label for="telCliente">
                        Telefono:
                    </label>
                    <input type="text" class="form-control" id="telCliente" name="telCliente" value="<?=$cliente1['telCliente']??''?>">
                </div>
            </div>    
                <label for="direccionCliente">
                    Direccion:
                </label>
                <input type="text" class="form-control" id="direccionCliente" name="direccionCliente" value="<?=$cliente1['direccionCliente']??''?>">
                
                <label for="mailCliente">
                    Email:
                </label>
                </label>
                <input type="email" class="form-control" id="mailCliente" name="mailCliente" value="<?=$cliente1['mailCliente']??''?>" >
                
            <button type="submit" class="btn btn-success m-4" name="btnactualizarCliente">
                Actualizar
            </button>
        </form>
    </div>
    
</div>


<?php
include_once 'footer.php';
?>