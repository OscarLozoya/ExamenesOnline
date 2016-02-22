<?php include("Header.php"); ?>

<?php include("Slider.php"); ?>

		<aside class="col-xs-12 col-sm-4 aside">
			<br>
			<form action="" class="form-horizontal">
				<div class="form-group row">
					<div class="col-xs-3">
						<label for="usuario" class="control-label">Usuario:</label>
					</div>
					<div class="col-xs-8">
						<input class="form-control" id="usuario" type="text" placeholder="Usuario">
					</div>					
				</div>

				<div class="form-group row">
					<div class="col-xs-3">
						<label for="contrasena" class="control-label">Contraseña:</label>
					</div>	
					<div class="col-xs-8">
						<input class="form-control" id="contrasena" type="password" placeholder="Contraseña">
					</div>
				</div>

				<div class="form-group container">
					<button class="btn btn-link">¿Olvido su contraseña?</button>
				</div>

				<div class="form-group">
					<div class="col-xs-5">
						<button class="btn">Registrarse</button>
					</div>
					<div class="col-xs-3">
						<button class="btn">Ingresar</button>
					</div>
				</div>

				<div class="form-group">
					<button class="btn"><i class="fa fa-facebook-official"></i> Registrarse con Facebook</button>
					<br>
					<br>
					
					<button class="btn"><i class="fa fa-twitter-square"></i> Registrarse con Twitter</button>
					
					<br>
					<br>
					
						<button class="btn"><i class="fa fa-google-plus-square"></i> Registrarse con Google Plus</button>
					
				</div>
			</form>
		</aside>

		<article class="col-xs-12 col-sm-8 content">
			<h1>Categorias</h1>
		</article>

<?php include("Footer.php");?>
