<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Rejas Argentinas</title>

        <meta name="description" content="Source code generated using layoutit.com">
        <meta name="author" content="LayoutIt!">

        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
        <link href="../css/style.css" rel="stylesheet">
        <link href="../css/fontface.css" rel="stylesheet">

    </head>
    <body class="bdy">
        <?php
        session_start();
        ?>

        <div class="container">
            <div class="row">
                <div class="col-md-12 text-center">
                    <img alt="logo" src="../imagen/LOGO-01.svg" width="50%" height="120px">
                </div>
            </div>

            <div class="row">
                <div class="col-md-12">
                    <ul class="nav">
                        <li class="nav-item">
                            <a class="nav-link active" href="../index.php">Inicio</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link active" href="../paginas/productos.php">Productos</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="../paginas/nosotros.php">Quienes Somos</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link active" href="../paginas/tutoriales.php">Tutoriales</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="../paginas/presupuesto.php">Presupuesto</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="../paginas/contacto.php">Contacto</a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link" href="../paginas/formularioCrearCliente.php">Regisgro</a>
                        </li>
                        <?php
                        if (!isset($_SESSION['usuario'])) {
                            ?>
                            <li class="nav-item">
                                
                                <button type="button" class="btn" data-toggle="modal" data-target="#myModal">
                                    Login
                                </button>
                                
                            </li>
                            <?php
                        } else {
                            ?>
                            <li class="nav-item">
                                <a class="nav-link" href="../paginas/logout.php">Logout (<?= $_SESSION['usuario'] ?>)</a>
                            </li>


                            <li class="nav-item">
                                <a class="nav-link" href="../paginas/menuAdmin.php">Administrador</a>
                            </li>

                            <?php
                        }
                        ?>

                    </ul>
                </div>
            </div>


            <div class="modal" id="myModal">
                <div class="modal-dialog">
                    <div class="modal-content">

                        <!-- Modal Header -->
                        <div class="modal-header">
                            <h4 class="modal-title">INGRESO DE USUARIO</h4>
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                        </div>

                        <!-- Modal body -->
                        <div class="modal-body">
                            <?php
                            error_reporting(E_ALL);
                            ini_set('display_errors', 1);

                            //session_start();
                            require_once 'clases/Usuario.php';
                            use app\clases\Usuario;
                                        
                            $usuario = new Usuario();
                            if (isset($_POST['boton']) && $usuario->esLoginValido($_POST['username'], $_POST['password'])) {
                                //echo "login válido";
                                $_SESSION['usuario'] = $_POST['username'];
                                header("Location:../index.php");
                                exit();
                            } else {
                                echo "login inválido";
                            }
                            ?>
                            <div class="row">
                                <div class="col-md-6">
                                    <form role="form" method="POST">
                                        <div class="form-group">
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

                                        <button type="submit" class="btn btn-success" name="boton">
                                            Acceder
                                        </button>
                                        <a href="paginas/formularioCrearCliente.php">
                                            <input type="button" class="btn btn-success" value="Registro">
                                        </a>

                                    </form>
                                </div>

                            </div>


                        </div>

                        <!-- Modal footer -->
                        <!--      <div class="modal-footer">
                                <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                              </div>-->

                    </div>
                </div>
            </div>





