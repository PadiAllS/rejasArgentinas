<?php
require_once 'header.php';
require_once 'clases/Categoria.php';

require_once 'menuAdmin.php';
?>
    
    <div class="col-md-6">
        
        <form role="form" method="POST">
            <h2>Nueva Categoria</h2>
            <div class="form-group">

                <label for="nombreCategoria">
                    Nombre:
                </label>
                <input type="text" class="form-control" id="nombreCategoria" name="nombreCategoria">
                
                <label for="descripcionCategoria">
                    Descripcion:
                </label>
                <input type="text" class="form-control" id="descripcionCategoria" name="descripcionCategoria">
                
<!--                <label for="condicionCategoria">
                    Condicion:
                </label>
                <input type="text" class="form-control" id="condicionCategoria" name="condicionCategoria">-->

            <button type="submit" class="btn btn-success" name="guardar">
                Guardar
            </button>
        </form>
    </div>
    <div class="col-md-3">
        
        
    </div>
</div>
</div>

<?php

$datos = $_POST;


if ($_POST)
{
	require("mysql.php"); 
	include("validador.php");
	$pdo = new db();
	$nombre = $datos['nombreCategoria'];
        $descripcion = $datos['descripcionCategoria'];

	try
	{
		$pdo->mysql->beginTransaction();
		$pst = $pdo->mysql->prepare("insert into categoria values (:nombreCategoria, :descripcionCategoria)");
		$pst->bindParam(":nombresCategoria", $nombre, PDO::PARAM_STR);
		$pst->bindParam(":descripcionCategoria", $descripcion, PDO::PARAM_STR);
		$pst->execute();

		
		
		$pdo->mysql->commit();
		header("Location:index.php");
	}
	catch(PDOException $ex)
	{
		$pdo->mysql->rollback();
		echo "El contacto no pudo ser guardado.";
		echo "<a href='#' onclick=javascript:window.history.back()>Regresar</a>"; 
	}


}

//
//////$condicion = $datos['condicionCategoria'];
//
//
//$categoria1 = new Categoria($nombre, $descripcion);
//
//$categoria1->guardar();
?>

<a href="listadoCategoria.php"  
   class="btn btn-info">volver</a>

<?php
include_once 'footer.php';
?>
s