<?php include("Header.php"); ?>
	<section class="container-fluid lines">
    <article class="col-xs-12 col-sm-2 col-md-2 col-lg-2 text-center">
      <div class="form-horizontal">
        <div class="form-group">
            <img src="images/logo_user.gif" alt="Icon-user" class="userLogo"></img>
        </div>
        <div class="form-group">
            <button class="btn btn-primary btn-small">Cambiar Imagen</button>
        </div>
        <div class="form-group">
            <a href="RestContrasena.php">Cambio contraseña</a>
        </div>
        <div class="form-group">
            <a href="DetalleExamenes.php">Detalle exámenes</a>
        </div>
      </div>
    </article>
		<article class="col-xs-12 col-sm-10 col-md-10 col-lg-10 ">
			<div class="jumbotron">
				<h2 class="text-center">Nombre Del Usuario</h2>
				<span class="help-block">* Campos necesarios.</span>
				<form>
					<div class="form-horizontal well">
						<fieldset>
							<legend>Datos Personales</legend>
							<div class="form-group">
								<div class="col-sm-6 col-md-4 col-lg-4">
									<label for="nombre">Nombre: *</label><br>
									<input id="Name"type="text" placeholder="Oscar" class="form-control" onchange="Elimina_Error('ErrorName')">
								</div>
								<div class="col-sm-6 col-md-4 col-lg-4">
									<label for="ape_paterno">Apellido Paterno: *</label><br>
									<input id="ApeP" type="text" placeholder="Perez" class="form-control" onchange="Elimina_Error('ErrorApeP')">
								</div>
								<div class="col-sm-6 col-md-4 col-lg-4">
									<label for="ape_materno">Apellido Materno: </label><br>
									<input id="ApeM" type="text" placeholder="Suarez" class="form-control" onchange="Elimina_Error('ErrorApeM')">
								</div>
							</div>
							<!---->
							<div id="EspTelefono">
								<div class="form-group col-xs-12 col-md-8 col-lg-6">
									<label for="" class="col-xs-12 col-sm-4 control-label">Telefono*:</label>
									<div id="InBtn"class="col-xs-12 col-sm-6	col-lg-8  input-group">
										<input class="form-control" id="Telefono" placeholder="363636052" type="text" onkeypress="prueba(this)" onchange="Elimina_Error('ErrorTelefono')">
										<span id="spanBtn" class="input-group-btn">
							        <button  id="BtnMoreTel"class="btn btn-default" type="button" data-tooltip="Agregar otro Número" onclick="NuevoTelefono()">
							        	<i  id="iconBtnMoreTel" class="glyphicon glyphicon-plus"></i></button>
							      </span>
									</div>
								</div>
							</div>
							<!---->
						</fieldset>
					</div>
					<section class="form-horizontal well">
					<form action="">
						<fieldset>
							<legend>Redes Sociales:</legend>
							<div id="EspRedSocial">
								<div class="form-group col-xs-12 col-md-11">
									<label for="" class="col-xs-2 control-label">URL:</label>
									<div class="col-xs-12 col-sm-10	col-lg-8  input-group">
										<input class="form-control" id="URLred" placeholder="https://www.facebook.com/" type="text">
										<span class="input-group-btn">
							        <button  id="BtnMore"class="btn btn-default" type="button" data-tooltip="Agregar otra Red" onclick="NuevaRedSocial()">
							        	<i  id="iconBtnMore" class="glyphicon glyphicon-plus"></i></button>
							      </span>
									</div>
								</div>
							</div>
						</fieldset>
					</form>
				</section>
					<div class="form-horizontal well">
						<fieldset>
							<legend>Datos Académicos</legend>
							<div class="form-group">
								<label for="universidad" class="col-md-2 control-label">Universidad: </label>
								<div class="col-md-8">
									<input id="universidad" type="text" placeholder="Centro Universitario De Las Ciencias" class="form-control">
								</div>
							</div>
							<div class="form-group">
								<label for="carrera" class="control-label col-xs-12 col-sm-2 col-md-2 control-label">Carrera: </label>
								<div class="col-xs-12 col-sm-5  col-md-4">
									<input id="carrera" type="text" placeholder="Ing. Mecatronica" class="form-control">
								</div>
								<label for="promedio" class="control-label col-xs-12 col-sm-2 col-md-2 control-label">Promedio: </label>
								<div class="col-xs-12 col-sm-3 col-md-2">
									<input id="promedio" type="number" placeholder="87" class="form-control">
								</div>
							</div>
							<div class="form-group">
								<label for="estado" class="col-xs-6 col-md-1 control-label">Estado: </label>
								<div class="col-xs-6  col-md-2">
									<select class="form-control">
										<option>Terminada</option>
										<option>En Proceso</option>
									</select>
								</div>
								<label for="porcentaje" class="col-xs-6  col-md-2 control-label">Porcentaje: </label>
								<div class="col-xs-6  col-md-2">
									<select class="form-control">
										<option value="10%">10%</option>
										<option value="20%">20%</option>
										<option value="30%">30%</option>
										<option value="40%">40%</option>
										<option value="50%">50%</option>
										<option value="60%">60%</option>
										<option value="70%">70%</option>
										<option value="80%">80%</option>
										<option value="90%">90%</option>
										<option value="100%">100%</option>
									</select>
								</div>
								<label for="tiempo_res" class="col-xs-6  col-md-1 control-label">Tiempo Restante: </label>
								<div class="col-xs-3  col-md-2">
									<input id="tiempo_res" type="number" placeholder="2" class="form-control">
								</div>
								<div class="col-xs-3  col-md-2">
									<select class="form-control">
										<option value="Semestres">Semestres</option>
										<option value="Años">Años</option>
									</select>
								</div>
							</div>
							<div class="form-group col-xs-12">
								<h3 class="text-center">Horarios Disponibles</h3>
							</div>
						  <div class="row"><!---->
						  	<div class="col-xs-12 col-sm-6 col-lg-6">
						  		<div class="row text-center"><!--BLOQUE LUNES-->
						  			<div class="col-xs-12 col-md-3 col-lg-2 col-lg-offset-1">
						  				<label class="Valuer">Lunes</label>
						  			</div>
						  			<div class="col-xs-6 col-md-4">
					  					<label for="" class="control-label">Desde</label>
					  					<select name="" id="" class="form-control">
					  						<?php include("Valores00.php"); ?>
					  					</select>
						  			</div>
						  			<div class="col-xs-6 col-md-4">
						  				<label for="" class="control-label">Hasta</label>
					  					<select name="" id="" class="form-control">
					  						<?php include("Valores00.php"); ?>
					  					</select>
						  			</div>
							  	</div>
							  	<!--FIN BLOQUE LUNES-->
						  		<div class="row text-center"><!--BLOQUE MARTES-->
							  		<div class="col-xs-12 col-md-3 col-lg-2 col-lg-offset-1">
						  				<label class="Valuer">Martes</label>
						  			</div>
						  			<div class="col-xs-6 col-md-4">
						  				<label for="" class="control-label">Desde</label>
					  					<select name="" id="" class="form-control">
					  						<?php include("Valores00.php"); ?>
					  					</select>
						  			</div>
						  			<div class="col-xs-6 col-md-4">
						  				<label for="" class="control-label">Hasta</label>
					  					<select name="" id="" class="form-control">
					  						<?php include("Valores00.php"); ?>
					  					</select>
						  			</div>
							  	</div><!--FIN BLOQUE MARTES-->
						  		<div class="row text-center"><!--BLOQUE MIERCOLES-->
						  			<div class="col-xs-12 col-md-3 col-lg-2 col-lg-offset-1">
						  				<label class="Valuer">Miercoles</label>
						  			</div>
						  			<div class="col-xs-6 col-md-4">
					  					<label for="" class="control-label">Desde</label>
					  					<select name="" id="" class="form-control">
					  						<?php include("Valores00.php"); ?>
					  					</select>
						  			</div>
						  			<div class="col-xs-6 col-md-4">
						  				<label for="" class="control-label">Hasta</label>
					  					<select name="" id="" class="form-control">
					  						<?php include("Valores00.php"); ?>
					  					</select>
						  			</div>
							  	</div><!--FIN BLOQUE MIERCOLES-->
						  	</div>
						  	<div class="col-xs-12 col-sm-6 col-lg-6"><!--BLOQUE DE JUEV-SAB DE 6 COL-->
							  	<div class="row text-center"><!--BLOQUE JUEVES-->
						  			<div class="col-xs-12 col-md-2">
						  				<label class="Valuer">Jueves</label>
						  			</div>
						  			<div class="col-xs-6 col-md-4">
					  					<label for="" class="control-label">Desde</label>
					  					<select name="" id="" class="form-control">
					  						<?php include("Valores00.php"); ?>
					  					</select>
						  			</div>
						  			<div class="col-xs-6 col-md-4">
						  				<label for="" class="control-label">Hasta</label>
					  					<select name="" id="" class="form-control">
					  						<?php include("Valores00.php"); ?>
					  					</select>
						  			</div>
							  	</div><!--FIN BLOQUE Jueves-->
						  		<div class="row text-center"><!--BLOQUE Viernes-->
						  			<div class="col-xs-12 col-md-2">
						  				<label class="Valuer">Viernes</label>
						  			</div>
						  			<div class="col-xs-6 col-md-4">
					  					<label for="" class="control-label">Desde</label>
					  					<select name="" id="" class="form-control">
					  						<?php include("Valores00.php"); ?>
					  					</select>
						  			</div>
						  			<div class="col-xs-6 col-md-4">
						  				<label for="" class="control-label">Hasta</label>
					  					<select name="" id="" class="form-control">
					  						<?php include("Valores00.php"); ?>
					  					</select>
						  			</div>
							  	</div><!--FIN BLOQUE Viernes-->
							  	<div class="row text-center"><!--BLOQUE Sabado-->
						  			<div class="col-xs-12 col-md-2">
						  				<label class="Valuer">Sabado</label>
						  			</div>
						  			<div class="col-xs-6 col-md-4">
					  					<label for="" class="control-label">Desde</label>
					  					<select name="" id="" class="form-control">
					  						<?php include("Valores00.php"); ?>
					  					</select>
						  			</div>
						  			<div class="col-xs-6 col-md-4">
						  				<label for="" class="control-label">Hasta</label>
					  					<select name="" id="" class="form-control">
					  						<?php include("Valores00.php"); ?>
					  					</select>
						  			</div>
							  	</div><!--FIN BLOQUE Sabado-->
						  	</div><!--FIN BLOQUE JUEV-SAB-->
							</div>
						</fieldset>
						</div>
						<div class="form-horizontal well ">
							<fieldset>
							<legend>Cambiar Contraseña</legend>
							<div class="form-group">
								<div class="col-sm-6 col-md-4 col-lg-3">
									<label for="contrasena_actual">Contraseña Actual</label><br>
									<input id="contrasena_actual" type="password"  class="form-control">
								</div>
								<div class="col-sm-6 col-md-4 col-lg-3">
									<label for="contrasena_nueva">Nueva Contraseña</label><br>
									<input id="contrasena_nueva" type="password" class="form-control">
								</div>
								<div class="col-sm-6 col-md-4 col-lg-3">
									<label for="confirmacion">Confirmar</label><br>
									<input id="confrimacion" type="password" class="form-control">
								</div>
							</div>
							</fieldset>
						</div>
					<div class="col-md-offset-5 col-md-2">
						<button type="submit" class="btn btn-primary form-control" onclick="return Valida_Campos()">Actualizar</button>
					</div>
				</form>
			</div>
		</article>
	</section>
<?php include("Footer.php");?>
<script type="text/javascript" src="js/ValidacionesPerfilRegistro.js"></script>