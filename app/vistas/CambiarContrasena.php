<section class="container-fluid">
		<form method="post" action="index.php?controlador=usuario&accion=CambioContrasenaNueva" name="formulario_registro">
			<div class="col-md-8 col-md-offset-2">
				<div class="col-xs-9 col-xs-offset-1 col-sm-8 col-sm-offset-2 col-lg-8 col-lg-offset-2 jumbotron text-center form-group">
					<br>
					<div class="form-group"><!--DIV DE LA IMAGEN DE LOGO-->
						<figure>
							<img class="userLogo" src="images/logo_user.gif">
						</figure>
					</div>
					<div class="form-group col-xs-12"><!--DIV DEL APARTADO USUARIO LABEL e INPUT-->
							<label class="label-control col-xs-12">Nueva Contraseña:</label>
						<div class="col-lg-8 col-lg-offset-2 form-group has-success has-feedback">
							<input id="contrasena_nueva" name="contrasena_nueva" class="form-control" type="password" placeholder="Usuario" onclick="" required autofocus>
						</div>
					</div>
					<div class="form-group col-xs-12"><!--DIV DEL APARTADO CORREO LABEL e  INPUT-->
							<label class="label-control col-xs-12">Confirme Contraseña</label>
						<div class="col-lg-8 col-lg-offset-2">
							<input id="contrasena_confirmacion" name="contrasena_confirmacion" class="form-control" type="password" onchange="" required placeholder="alguncorreo@mail.com">
						</div>
					</div>	
					<div class="col-xs-10 col-xs-offset-1 form-group" id="divbtn"><!--DIV DE LOS BOTONES-->
						<div class="col-xs-12 col-md-6 form-group">
							<button type="submit" class="btn btn-primary" onclick="return ValidaPassword()">Cambiar Contraseña</button>
						</div>
						<div class="col-xs-12 col-md-6 form-group">
						</div>
					</div>
				  {label_exito}
				</div>
			</div>
		</form>
	</section>
<?php include("Footer.php"); ?>
<script type="text/javascript" src="js/ValidacionesRestContrasena.js"></script>