<?php include("Header.php");?>
<?php include("MenuAdmin.php"); ?>
	<section class="container-fluid">
		{iniciaUsuario}<article>
			<div class="col-xs-12 col-sm-2 col-md-2 col-lg-2">
				<div class="form-horizontal">
					<div>
						<img src="images/logo_user.gif" alt="Icon-user" class="userLogo col-md-offset-2">
					</div>
				</div>
			</div>
			<div class="col-xs-12 col-sm-10 col-md-10 col-lg-10 well">
				<div class="form-horizontal" class="col-md-10">
					<div class="form-group row">
						<label class="label-control col-md-1">Usuario:</label>
						<div class="col-md-2">
							<input type="text" class="form-control" disabled value="{Usuario}">
						</div>
						<label class="label-control col-md-1">Correo:</label>
						<div class="col-md-3">
							<input type="text" class="form-control" disabled value="{Correo}">
						</div>
					</div>
					<div class="form-group row">
						<label class="label-control col-md-1">Nombre:</label>
						<div class="col-md-10">
							<input type="text" class="form-control" disabled value="{Nombre}">
						</div>
					</div>
					<div class="form-group row">
						<label class="label-control col-md-1">Universidad:</label>
						<div class="col-md-3">
							<input type="text" class="form-control" disabled value="{Universidad}">
						</div>
						<label class="label-control col-md-1">Carrera:</label>
						<div class="col-md-3">
							<input type="text" class="form-control" disabled value="{Carrera}">
						</div>
					</div>
					<div class="form-group row">
						<label class="label-control col-md-1">Promedio:</label>
						<div class="col-md-3">
							<input type="text" class="form-control" disabled value="{Promedio}">
						</div>
						<label class="label-control col-md-1">Estado:</label>
						<div class="col-md-3">
							<input type="text" class="form-control" disabled value="{Estado}">
						</div>
						<label class="label-control col-md-1">Porcentaje:</label>
						<div class="col-md-3">
							<input type="text" class="form-control" disabled value="{Porcentaje}">
						</div>
					</div>
				</div>
			</div>
		</article>{terminaUsuario}
	</section>
<?php include("Footer.php"); ?>