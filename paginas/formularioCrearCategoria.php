<?php
require_once '../paginas/header.php';
require_once '../clases/Categoria.php';
?>
    
    <div class="col-md-6">
        
        <form role="form" method="POST" action="../procesos/crearCategoria.php">
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

            <button type="submit" class="btn btn-success m-4" name="guardarCategoria">
                Guardar
            </button>
            <a href="../procesos/listadoCategoria.php" class="btn btn-info">volver</a>

        </form>
    </div>
    <div class="col-md-3">
        
        
    </div>
</div>
</div>


<?php
include_once '../paginas/footer.php';
?>
