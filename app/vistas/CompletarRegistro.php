<?php include("Header.php"); ?>
	<section class="container-fluid lines">
		<article class="col-xs-12 col-sm-2 col-md-2 col-lg-2 formulario text-center">
      <div class="form-horizontal">
        <div class="form-group">
            <img src="images/logo_user.gif" alt="Icon-user" class="userLogo"></img>
        </div>
      </div>
    </article>
		<article class="col-xs-12 col-sm-10 col-md-10 col-lg-10">
			<form name="completarRegistro" action="index.php?controlador=usuario&accion=completarRegistro" method="post">
				<div class="jumbotron">
					<h3 class="text-center">Complete el Registro</h3>
					<span class="help-block">* Campos necesarios.</span>
					<section class="form-horizontal well text-center">
						<fieldset>
							<legend>Datos Personales</legend>
							<div class="form-group">
								<div class="col-sm-6 col-md-4">
									<label for="nom">Nombre: *</label>
								  <br>
									<input for="nam" id="Name" name="Nombre" type="text" placeholder="Oscar" class="form-control" onchange="Elimina_Error('ErrorName')">
								</div>
								<div class="col-sm-6 col-md-4">
									<label for="ApeP">Apellido Paterno: *</label>
									<br>
									<input name="ApellidoP" id="ApeP" type="text" placeholder="Perez" class="form-control" onchange="Elimina_Error('ErrorApeP')">
								</div>
								<div class="col-sm-6 col-md-4">
									<label for="ApeM">Apellido Materno: *</label>
									<br>
									<input name="ApellidoM" id="ApeM" type="text" placeholder="Suarez" class="form-control" onchange="Elimina_Error('ErrorApeM')">
								</div>
							</div>
						  <div id="EspTelefono">
								<div class="form-group col-xs-12 col-md-8 col-lg-6">
									<label for="" class="col-xs-12 col-sm-4 control-label">Telefono*:</label>
									<div id="InBtn"class="col-xs-12 col-sm-6	col-lg-8  input-group">
										<input class="form-control" id="Telefono" name="Telefonos[]" placeholder="363636052" type="text" onkeypress="campoNumerico(this)" onchange="Elimina_Error('ErrorTelefono')">
										<span id="spanBtn" class="input-group-btn">
							        <button  id="BtnMoreTel"class="btn btn-default" type="button" data-tooltip="Agregar otro Número" onclick="NuevoTelefono()">
							        	<i  id="iconBtnMoreTel" class="glyphicon glyphicon-plus"></i></button>
							      </span>
									</div>
								</div>
							</div>
						</fieldset>
					</section>
					<section class="form-horizontal well">
						<fieldset>
							<legend>Redes Sociales *:</legend>
							<div id="EspRedSocial">
								<div class="form-group col-xs-12 col-md-11">
									<label for="" class="col-xs-2 control-label">URL:</label>
									<div class="col-xs-12 col-sm-10	col-lg-8  input-group">
										<input class="form-control" id="URLred" name="RedSocial[]" placeholder="https://www.facebook.com/" type="text" onchange="Elimina_Error('ErrorRed')">
										<span class="input-group-btn">
							        <button  id="BtnMore"class="btn btn-default" type="button" data-tooltip="Agregar otra Red" onclick="NuevaRedSocial()">
							        	<i  id="iconBtnMore" class="glyphicon glyphicon-plus"></i></button>
							      </span>
									</div>
								</div>
							</div>
						</fieldset>
					</section>
					<section class="form-horizontal well">
						<fieldset>
							<legend>Datos Academicos*:</legend>
							<div class="form-group">
									<label for="uni" class="col-md-2 control-label">Universidad</label>
									<div class="col-md-8">
										<input id="Universidad" name="Universidad" type="text" class="form-control" placeholder="Centro Universitario De Ciencias Exactas e Ingenierías" id="universidad" onchange="Elimina_Error('ErrorUniversidad')">
									</div>
							</div>
							<div class="form-group">	
									<label for="car" class="control-label col-xs-12 col-sm-2 col-md-2">Carrera</label>
									<div class="col-xs-12 col-sm-5  col-md-4">
										<input id="Carrera" name="Carrera" type="text" class="form-control" placeholder="Ing. Mecatronica" id="carrera" onchange="Elimina_Error('ErrorCarrera')">
									</div>	
									<label for="pro" class="control-label  col-xs-12 col-sm-2 col-md-2">Promedio</label>
									<div class="col-xs-12 col-sm-3 col-md-2">
										<input id="Promedio" name="Promedio" type="number" class="form-control" placeholder="87" onchange="ValidaProm()">
									</div>	
							</div>
							<div class="form-group">
								<label for="estado" class="col-xs-6 col-sm-2 col-lg-1 control-label">Estado*: </label>
								<div class="col-xs-6 col-sm-3 col-md-3 col-lg-2">
									<select class="form-control" name='Estado'>
										<option>Terminada</option>
										<option>En Proceso</option>
									</select>
								</div>
								<label for="porcentaje" class="col-xs-6  col-sm-4 col-md-3 col-lg-2 control-label">Porcentaje*: </label>
								<div class="col-xs-6  col-sm-3 col-lg-2">
									<select class="form-control" name='Porcentaje'>
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
								<label for="T" class="col-xs-6 col-sm-3  col-md-2 col-lg-1 control-label">Tiempo Restante*: </label>
								<div class="col-xs-3 col-lg-2">
									<input id="Tiempo"name="TiempoRestante" type="number" placeholder="2" class="form-control" onchange="ValidaTiempo()">
								</div>
								<div class="col-xs-3  col-sm-4 col-md-3   col-lg-2">
									<select id="OpcTiempo" name='Lapso' class="form-control" onchange="CambiaPeriodo()">
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
						  				<select name="LunesDesde" id="LunesDesde" class="form-control" onchange="Valida_Horario('LunesDesde','LunesHasta')">
						  					<?php include("Valores00.php"); ?>
						  				</select>
							  		</div>
							  		<div class="col-xs-6 col-md-4">
							  			<label for="" class="control-label">Hasta</label>
						  				<select name="LunesHasta" id="LunesHasta" class="form-control" onchange="Valida_Horario('LunesDesde','LunesHasta')">
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
					  					<select name="MartesDesde" id="MartesDesde" class="form-control" onchange="Valida_Horario('MartesDesde','MartesHasta')">
					  						<?php include("Valores00.php"); ?>
					  					</select>
							  		</div>
						  			<div class="col-xs-6 col-md-4">
						  				<label for="" class="control-label">Hasta</label>
					  					<select name="MartesHasta" id="MartesHasta" class="form-control" onchange="Valida_Horario('MartesDesde','MartesHasta')">
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
					  					<select name="MiercolesDesde" id="MiercolesDesde" class="form-control" onchange="Valida_Horario('MiercolesDesde','MiercolesHasta')">
					  						<?php include("Valores00.php"); ?>
					  					</select>
						  			</div>
						  			<div class="col-xs-6 col-md-4">
						  				<label for="" class="control-label">Hasta</label>
					  					<select name="MiercolesHasta" id="MiercolesHasta" class="form-control" onchange="Valida_Horario('MiercolesDesde','MiercolesHasta')">
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
					  					<select name="JuevesDesde" id="JuevesDesde" class="form-control" onchange="Valida_Horario('JuevesDesde','JuevesHasta')">
					  						<?php include("Valores00.php"); ?>
					  					</select>
						  			</div>
						  			<div class="col-xs-6 col-md-4">
						  				<label for="" class="control-label">Hasta</label>
					  					<select name="JuevesHasta" id="JuevesHasta" class="form-control" onchange="Valida_Horario('JuevesDesde','JuevesHasta')">
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
					  					<select name="ViernesDesde" id="ViernesDesde" class="form-control" onchange="Valida_Horario('ViernesDesde','ViernesHasta')">
					  						<?php include("Valores00.php"); ?>
					  					</select>
						  			</div>
						  			<div class="col-xs-6 col-md-4">
						  				<label for="" class="control-label">Hasta</label>
					  					<select name="ViernesHasta" id="ViernesHasta" class="form-control" onchange="Valida_Horario('ViernesDesde','ViernesHasta')">
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
					  					<select name="SabadoDesde" id="SabadoDesde" class="form-control" onchange="Valida_Horario('SabadoDesde','SabadoHasta')">
					  						<?php include("Valores00.php"); ?>
					  					</select>
						  			</div>
						  			<div class="col-xs-6 col-md-4">
						  				<label for="" class="control-label">Hasta</label>
					  					<select name="SabadoHasta" id="SabadoHasta" class="form-control" onchange="Valida_Horario('SabadoDesde','SabadoHasta')">
					  						<?php include("Valores00.php"); ?>
					  					</select>
						  			</div>
							  	</div><!--FIN BLOQUE Sabado-->
						  	</div><!--FIN BLOQUE JUEV-SAB-->
								</div>
							</fieldset>
					</section>
					<section>
						<div class="form-horizontal well ">
							<fieldset>
							<legend>Contraseña</legend>
							<div class="form-group">
								<div class="col-sm-6 col-md-4 col-lg-3">
									<label for="contrasena_nueva">Nueva Contraseña</label><br>
									<input id="contrasena_nueva" type="password" onchange="Elimina_Error('ErrorContra')" class="form-control">
								</div>
								<div class="col-sm-6 col-md-4 col-lg-3">
									<label for="confirmacion">Confirmar</label><br>
									<input id="contrasena_confirmacion" name="NuevaContrasena" type="password" onchange="Elimina_Error('ErrorContra')" class="form-control">
								</div>
							</div>
							</fieldset>
						</div>
					<div class="col-md-2 col-md-offset-10">
						<button type="submit" class="btn btn-primary form-control" onclick="return Valida_Campos(0)">Guardar</button>
					</div>
				 </section>
				</div>

				<!--<button class="btn btn-primary" type="submit" onclick="return Valida_Campos()" >Enviar</button>-->
			</form>
		</article>
  </section>
<?php include("Footer.php"); ?>
<script type="text/javascript" src="js/ValidacionesPerfilRegistro.js"></script>