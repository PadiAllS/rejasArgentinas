<?php
require_once 'header.php';
require_once './clases/TipoDocumento.php';
$tiposDocumento = new app\clases\TipoDocumento();
?>
<div class="row">
    <div class="col-md-12">
        <ul class="nav">
            <li class="nav-item">
                <a class="nav-link active" href="productos.php">Productos</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="nosotros.php">Quienes Somos</a>
            </li>
            <li class="nav-item">
                <a class="nav-link active" href="tutoriales.php">Tutoriales</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="presupuesto.php">Presupuesto</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="contacto.php">Contacto</a>
            </li>				

        </ul>
    </div>
</div>
<?php
require_once 'menuAdmin.php';
?>

    <div class="col-md-6">
        <form role="form">
            <div class="form-group">

                <label for="nombreusuario">
                    Nombre:
                </label>
                <input type="text" class="form-control" id="nombreusuario" name="nombreusuario">
                <label for="tipodocumento">
                    Tipo Documento:
                </label>
                <select>
                    <?php
                    foreach ($tiposDocumento->getTipoDoc() as $tipo) {
                        echo "<option>$tipo</option>";
                    }
                    ?>
                </select><br>
                <label for="nrodocumento">
                    Nro Documento
                </label>
                <input type="text" class="form-control" id="nrodocumento" name="nrodocumento">
                <label for="direccionusuario">
                    Direccion:
                </label>
                <input type="text" class="form-control" id="direccionusuario" name="direccionusuario">
                <label for="telefonousuario">
                    Telefono:
                </label>
                <input type="text" class="form-control" id="telusuario" name="telusuario">

                <label for="email">
                    Email:
                </label>
                </label>
                <input type="email" class="form-control" id="email" name="email">
                <label for="login">
                    Nombre de Usuario:
                </label>
                <input type="text" class="form-control" id="login" name="login">
            </div>
            <div class="form-group">

                <label for="password">
                    Password
                </label>
                <input type="password" class="form-control" id="password" name="password">
            </div>

            <div class="checkbox">

                <label>
                    <input type="checkbox"> Check me out
                </label>
            </div> 
            <button type="submit" class="btn btn-primary">
                Submit
            </button>
        </form>
    </div>
    <div class="col-md-3">
        <dl>
            <dt>
                Description lists
            </dt>
            <dd>
                A description list is perfect for defining terms.
            </dd>
            <dt>
                Euismod
            </dt>
            <dd>
                Vestibulum id ligula porta felis euismod semper eget lacinia odio sem nec elit.
            </dd>
            <dd>
                Donec id elit non mi porta gravida at eget metus.
            </dd>
            <dt>
                Malesuada porta
            </dt>
            <dd>
                Etiam porta sem malesuada magna mollis euismod.
            </dd>
            <dt>
                Felis euismod semper eget lacinia
            </dt>
            <dd>
                Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh, ut fermentum massa justo sit amet risus.
            </dd>
        </dl>
    </div>
</div>
</div>

<script src="js/jquery.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="js/scripts.js"></script>
</body>
