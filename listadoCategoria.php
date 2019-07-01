<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

session_start();
if (!isset($_SESSION['usuario']))
{
    $_SESSION['mensaje'] = 'Login Inválido';
    header('Location:login.php');
    exit();
}

require_once 'clases/Categoria.php';

use app\clases\Categoria;



if(isset($_GET['submit'])){
    $listaCategorias = Categoria::buscarCriteros($_GET['nombre'], $_GET['descripcion'], $_GET['condicion']);    
} else if(isset($_GET['quickSearch'])){
    $listaCategorias = Categoria::busquedaRapida($_GET['quickSearch']);   
} else {
    $listaCategorias = Categoria::buscarCriteros();
}

require_once 'header.php';

require_once 'menuAdmin.php';



?>

<div class="columna col-md-9">
<div class="row d-flex">
    <div class="columna col-md-12">
       <div class="d-flex justify-content-center">
        <form role="form" class="form-inline">
            <div>
                <h2>Listado de Categorias</h2>
            </div>
            
            <div class="form-group">
                
                
                <input type="text" class="form-control" id="nombre" name="quickSearch" value='<?= $_GET['quickSearch']??'' ?>'>
            </div>
            
            <button type="submit" class="btn btn-primary" name="quickSearch">
                    Buscar
            </button>
        </form>
       </div>
    </div>
</div>
<div class="row">
    <div class="col-md-12">
        <table class="table">
            <thead>
                <tr>
                    <th>
                        Id Categoria
                    </th>
                    <th>
                        Nombre Categoria
                    </th>
                    <th>
                        Descripcion
                    </th>
                    <th>
                        Condicion
                    </th>
                </tr>
            </thead>
            <tbody>
                
                <?php
                foreach ($listaCategorias as $categoria) {
                    echo "<tr>
                        <td>
                            {$categoria["idCategoria"]}
                        </td>
                        <td>
                            {$categoria["nombreCategoria"]}
                        </td>
                        <td>
                            {$categoria["descripcionCategoria"]}
                        </td>
                        <td>
                            {$categoria["condicionCategoria"]}
                        </td>
                        </tr>";
                }
                ?>

            </tbody>
        </table>

    </div>
</div>
<!--<div class="row">
		<div class="col-md-12">
			<nav>
				<ul class="pagination">
					<li class="page-item">
						<a class="page-link" href="#">Previous</a>
					</li>
					<li class="page-item">
						<a class="page-link" href="#">1</a>
					</li>
					<li class="page-item">
						<a class="page-link" href="#">2</a>
					</li>
					<li class="page-item">
						<a class="page-link" href="#">3</a>
					</li>
					<li class="page-item">
						<a class="page-link" href="#">4</a>
					</li>
					<li class="page-item">
						<a class="page-link" href="#">5</a>
					</li>
					<li class="page-item">
						<a class="page-link" href="#">Next</a>
					</li>
				</ul>
			</nav>
		</div>
	</div>    -->
</div>

<?php
require_once 'footer.php';
?>