<?php
require_once './clases/Usuario.php';
use app\clases\Usuario;
?>

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

//                            session_start();
//                            require_once 'clases/Usuario.php';
//                            use app\clases\Usuario;
                            $usuario = new Usuario();
                            if(isset($_POST['boton'])  && $usuario->esLoginValido($_POST['username'], $_POST['password']))
                            {
                                //echo "login válido";
                                $_SESSION['usuario']= $_POST['username'];
                                header("Location:index.php");
                                exit();
                            }else{
                                echo "login inválido";
                            }
                            
                            ?>
                            <div class="row">
                                <!--    <div class="col-md-3">
                                
                                    </div>-->


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
                                        <a href="registro.php">
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
