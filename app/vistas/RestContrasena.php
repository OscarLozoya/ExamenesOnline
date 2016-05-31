<?php include("Header.php"); ?>

<br>
	<section class="container-fluid">
		
					{etiqControl}
		<form action="index.php?controlador=usuario&accion=restablecerContrasena" method="post">
			<div class="col-md-8 col-md-offset-2">
				<div class="col-xs-9 col-xs-offset-1 col-sm-8 col-sm-offset-2 col-lg-8 col-lg-offset-2 jumbotron text-center form-group">
					<br>
					<div class="form-group"><!--DIV DE LA IMAGEN DE LOGO-->
						<figure>
							<img class="userLogo" src="images/logo_user.gif">
						</figure>
					</div>
					<div class="form-group col-xs-12"><!--DIV DEL APARTADO USUARIO LABEL e INPUT-->
							<label class="label-control col-xs-12">Proporcione el nombre de usario para enviar los pasos correspondientes a su correo:</label>	
					</div>
					<div class="form-group col-xs-12"><!--DIV DEL APARTADO CORREO LABEL e  INPUT-->
							<label class="label-control col-xs-12">Usuario</label>
						<div class="col-lg-8 col-lg-offset-2">
							<input id="CorreoElec" name="usuario" class="form-control" type="text" required placeholder="UserN51" onclick="CambioCorreo()">
							<label id="MensajeCorreo" class="Warning">*Debes ingresar un nombre de usuario</label>
						</div>
					</div>	
					<div class="col-xs-10 col-xs-offset-1 form-group"><!--DIV DE LOS BOTONES-->
						<div class="col-xs-12 col-md-6 form-group">
							<button type="submit" class="btn btn-primary" onclick="return ValidacionCorreo()">ENVIAR</button>
						</div>
						<div class="col-xs-12 col-md-6 form-group">
							<button type="button" class="btn btn-primary" onclick="return Cancelar()">CANCELAR</button>
						</div>
					</div>	
				</div>
			</div>	
		</form>
	</section>
<?php include("Footer.php"); ?>
<script type="text/javascript" src="js/ValidacionesRestContrasena.js"></script>