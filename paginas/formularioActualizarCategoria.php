<?php
require_once 'header.php';

require_once '../clases/Db.php';
require_once '../clases/Categoria.php';
use app\clases\Categoria;
use app\clases\Db;

try
{
	$idCategoria = intval($_GET["modId"]);
	$conn= Db::getConexion();
        $sql='select * from categoria where idCategoria = :idCategoria';
        $pst=$conn->prepare($sql);
	$pst->bindParam(":idCategoria", $idCategoria, PDO::PARAM_INT);
	$pst->execute();
	$categoria1 = $pst->fetch();
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
                            <h2>Actualizar Categoria</h2>
                </div>
            </div>
            <div class="columna col-md-6">
                <div class="">
                    <?=$mensaje??""?>
                </div>
            </div>
        </div>
        
        <form role="form" method="POST" action="../procesos/actualizarCategoria.php">
            <div class="row">
                <div class="form-group col-md-3"
                    <label for="idCategoria">
                        Id:
                    </label>
                     <input type="text" class="form-control" id="idCategoria" name="idCategoria" maxlength="10" value="<?=$idCategoria??''?>">
                </div>
                <div class="form-group col-md-9"
                    <label for="nombreCategoria">
                        Nombre:
                    </label>
                     <input type="text" class="form-control" id="nombreCategoria" name="nombreCategoria" value="<?=$categoria1['nombreCategoria']??''?>">
                </div>
            </div>
            <div class="row">
                <div class="form-group col-md-12">
                    <label for="descripcionCategoria">
                        Descripcion:
                    </label>
                    <input type="text" class="form-control" id="descripcionCategoria" name="descripcionCategoria" value="<?=$categoria1['descripcionCategoria']??''?>">
                </div>
            </div>
            
            <button type="submit" class="btn btn-success m-4" name="btnactualizarCategoria">
                Actualizar
            </button>
        </form>
    </div>
    
</div>


<?php
include_once 'footer.php';
?>