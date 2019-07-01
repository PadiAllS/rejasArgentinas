<?php
require_once 'header.php';
?>

<div class="container-fluid">
	<div class="row">
		<div class="col-md-12">
			<div class="row">
				<div class="col-md-4">
					<h2>
						Heading
					</h2>
					<p>
						Donec id elit non mi porta gravida at eget metus. Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh, ut fermentum massa justo sit amet risus. Etiam porta sem malesuada magna mollis euismod. Donec sed odio dui.
					</p>
					<p>
						<a class="btn" href="#">View details »</a>
					</p>
				</div>
				<div class="col-md-8">
					<form role="form">
                                            <div class="d-flex">
						<div class="form-group">
							<label for="correo">
								Su email:
                                                        </label>
                                                    <input type="email" class="form-control" id="correo" name="correo" value="" placeholder="Ingrese su email"/>
						</div>
						<div class="form-group">
							 
							<label for="nombre">
								Nombre:
							</label>
                                                    <input type="text" class="form-control" id="nombre" name="nombre" value="" placeholder="Ingrese su nombre"/>
						</div>
						<div class="form-group">
							 
							<label for="teleofono">
								Telefono:
							</label>
                                                    <input type="text" class="form-control" id="telefono" name="telefono" value="" placeholder="Ingrese su telefono"/>
						</div>
                                            </div>
                                            <div>
						<div class="form-group">
							 
							<label for="consulta">
								Consulta:
							</label>
                                                    <textarea class="form-control" id="consulta" name="consulta" value="" placeholder="Ingrese su consulta o comentario"></textarea>
						</div>
                                            </div>
                                            
						<button type="submit" class="btn btn-primary">
							Enviar
						</button>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>  

<?php
include_once 'footer.php';
?>