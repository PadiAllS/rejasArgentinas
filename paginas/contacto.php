<?php
require_once '../header.php';
?>

<div class="container-fluid">
	<div class="row">
		<div class="col-md-12">
			<div class="row">
				<div class="col-md-4">
					<h2>
						Datos de contacto
					</h2>
					<p>
						Balcarse 946 - Monte Grande
					</p>
					<p>
						011-55552314
					</p>
					<p>
						info@rejasargentinas.com.ar
					</p>
					<p>
						<a class="btn" href="#">Como llegar »</a>
					</p>
				</div>
				<div class="col-md-8">
                                    <form role="form" method="POST" action="../procesos/enviarMail.php">
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

<div>
        <section class="map1 cid-re8eH2bIMC" id="map1-i">
            <div class="google-map"><iframe frameborder="0" style="border:0" src="https://www.google.com/maps/embed/v1/place?key=AIzaSyCy9r70T3NYf3PhvVflTo0_zdif2_IoIYs&amp;q=place_id:EihQdW50YSBOaW5mYXMgMTU2NSwgUsOtbyBOZWdybywgQXJnZW50aW5hIhsSGQoUChIJwQ5fGRIz-pURatxuaSzsbnAQnQw" allowfullscreen=""></iframe></div>
        </section>
    </div>
<?php
include_once '../paginas/footer.php';
?>
