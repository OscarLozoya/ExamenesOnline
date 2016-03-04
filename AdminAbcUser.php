<?php include("Header.php");?>
<div class="form-group">
	<label class="label-control">Historial de Navegación</label>
</div>
<?php include("MenuAdmin.php"); ?>

<br>
	<section class="container-fluid">
		<form >
			<div class="col-md-8 col-md-offset-2">
				<div class="col-xs-9 col-xs-offset-1 col-sm-8 col-sm-offset-2 col-lg-8 col-lg-offset-2 formulario form-group">
					<br>
					<div class="form-group"><!--DIV DE LA IMAGEN DE LOGO-->
						<figure>
							<img class="userLogo" src="images/logo_user.gif">
						</figure>
					</div>
					<div class="form-group col-xs-12"><!--DIV DEL APARTADO USUARIO LABEL e INPUT-->
							<label class="label-control col-xs-12">Nombre de Usuario:</label>
						<div class="col-lg-8 col-lg-offset-2 form-group has-success has-feedback">
							<input id="NomUser" class="form-control" type="text" placeholder="NamUser" required autofocus>
						</div>
					</div>
					<div class="form-group col-xs-12"><!--DIV DEL APARTADO CORREO LABEL e  INPUT-->
							<label class="label-control col-xs-12">Correo Electrónico</label>
						<div class="col-lg-8 col-lg-offset-2">
							<input id="CorreoElc" class="form-control" type="email" required placeholder="correo@empresa.dom">
						</div>
					</div>	
					<div class="form-group col-xs-12"><!--DIV DEL COMBOBOX Y level-->
						<label for="" class="label-control col-xs-12">Tipo:</label>
						<div class="col-lg-8 col-lg-offset-2">
							<select name="" id="" class="form-control">
								<option>User</option>
								<option>Moderador</option>
								<option>Administrador</option>
							</select>
						</div>
					</div>
					<div class="col-xs-10 col-xs-offset-1 form-group"><!--DIV DE LOS BOTONES-->
						<div class="col-xs-12 col-md-6 form-group">
							<button type="button" class="btn btn-primary">Limpiar</button>
						</div>
						<div class="col-xs-12 col-md-6 form-group">
							<button type="button" class="btn btn-primary">Agregar/Buscar</button>
						</div>
					</div>		
				</div>
			</div>
		</form>
	</section>
<?php include("Footer.php"); ?>