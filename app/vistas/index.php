<?php include("Header.php"); ?>

<?php include("Slider.php"); ?>
	<section class="container-fluid">
		<aside class="col-xs-12 col-sm-4 aside lines">
			<br>
			<form action="index.php?controlador=usuario&accion=ingresar" method="post" class="form-horizontal" onsubmit="return ValidaLogin()">
				<div class="form-group row">
					<div class="col-xs-12 col-md-4">
						<label for="usuario" class="control-label">Usuario:</label>
					</div>
					<div class="col-xs-12 col-md-8">
						<input class="form-control" id="usuario" name="usuario" type="text" placeholder="Usuario" onchange="CambioUsuario()">
						<label id="MensajeUsuario" class="Warning">*Debes de ingresar tu usuario</label>
					</div>					
				</div>

				<div class="form-group row">
					<div class="col-xs-12 col-md-4">
						<label for="contrasena" class="control-label">Contraseña:</label>
					</div>	
					<div class="col-xs-12 col-md-8">
						<input class="form-control" id="contrasena" name="contrasena" type="password" placeholder="Contraseña" onchange="CambioContrasena()">
						<label id="MensajeContrasena" class="Warning">*Debes de ingresar tu contraseña</label>
					</div>
				</div>

				<div class="form-group container">
					<a href="index.php?controlador=usuario&accion=cambioContrasena">¿Olvido su contraseña?</a>
				</div>

				<div class="form-group row">
					<div class="col-xs-5">
						<button class="btn btn-primary" type="button" onclick="location='index.php?controlador=usuario&accion=Registro'">Registrarse</button>
					</div>
					<div class="col-xs-3">
						<button class="btn btn-primary" type="submit">Ingresar</button>
					</div>
				</div>

				<div class="form-group row">
					<div class="col-xs-12">
						<button class="btn btn-lg btn-block buton"><i class="fa fa-facebook-official"></i> Registrarse con Facebook</button>
					</div>
				</div>
				<div class="form-group row">
					<div class="col-xs-12">
						<button class="btn btn-lg btn-block buton"><i class="fa fa-twitter-square"></i> Registrarse con Twitter</button>
					</div>
				</div>
				<div class="form-group row">
					<div class="col-xs-12">
						<button class="btn btn-lg btn-block buton"><i class="fa fa-google-plus-square"></i> Registrarse con Google Plus</button>
					</div>
				</div>
					
					
			</form>
		</aside>

		<section class="col-xs-12 col-sm-8 content lines">
			<div class="text-center">
				<h1>Categorias</h1>
			</div>
			<a href=""><h3>Programación</h3></a>
			<hr noshade="noshade" />
			<a href=""><h3>Web</h3></a>
			<hr noshade="noshade" />
			<a href=""><h3>Algortimos</h3></a>
			<hr noshade="noshade" />
		</section>
	</section>
<?php include("Footer.php");?>
<script type="text/javascript" src="js/ValidacionesLogin.js"></script>

