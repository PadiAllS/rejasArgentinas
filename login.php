<?php
require_once 'header.php';
?>
	<div class="row">
		<div class="col-md-12">
			<ul class="nav">
				<li class="nav-item">
                                    <a class="nav-link active" href="index.php">Inicio</a>
				</li>
				<li class="nav-item">
                                    <a class="nav-link" href="registro.php">Registro</a>
				</li>
				
			</ul>
		</div>
	</div>
	<div class="row">
		<div class="col-md-3">
			
		</div>

            
            <div class="col-md-6">
			<form role="form">
				<div class="form-group">
					 
					
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
				
				 
				<button type="submit" class="btn btn-primary">
					Submit
				</button>
			</form>
		</div>
		<div class="col-md-3">
			
		</div>
	</div>
</div>

    <script src="js/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/scripts.js"></script>
  </body>
</html>