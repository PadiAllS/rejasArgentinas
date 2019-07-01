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
        <link href="css/style.css" rel="stylesheet">

    </head>
    <body class="bdy">
        <?php
       // session_start();
        ?>

        <div class="container">
            <div class="row">
                <div class="col-md-12 text-center">
                    <img alt="logo" src="imagen/LOGO-01.svg" width="50%" height="120px">
                </div>
            </div>

            <div class="row">
                <div class="col-md-12">
                    <ul class="nav">
                        <li class="nav-item">
                            <a class="nav-link active" href="index.php">Inicio</a>
                        </li>
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

                        <li class="nav-item">
                            <a class="nav-link" href="registro.php">Regisgro</a>
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
                                <a class="nav-link" href="logout.php">Logout (<?= $_SESSION['usuario'] ?>)</a>
                            </li>


                            <li class="nav-item">
                                <a class="nav-link" href="admin.php">Administrador</a>
                            </li>

                            <?php
                        }
                        ?>

                    </ul>
                </div>
            </div>
<?php
                        require_once 'login.php';
?>
  



