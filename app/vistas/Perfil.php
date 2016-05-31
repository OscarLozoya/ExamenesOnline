<?php include("Header.php"); ?>
{Notificacion}
	<section class="container-fluid lines">
    <article class="col-xs-12 col-sm-2 col-md-2 col-lg-2 formulario text-center">
      <div class="form-horizontal"><br>
        <div class="form-group">
            {iniciaFoto}<img src="{Foto}" alt="Icon-user" class="userLogo"></img>{terminaFoto}
        </div>
        <form action="index.php?controlador=usuario&accion=cambiarFoto" method="POST" enctype="multipart/form-data">
        <div class="form-group">
        	<button class="file-upload btn btn-primary"> 
            	<input class="file-input" name="foto" type="file">Cambiar Imagen</button>
            <button class="btn btn-primary" type="submit">Guardar</button>
        </div>
        <div class="form-group">
            <a href="index.php?controlador=usuario&accion=cambioContrasena">Cambio contraseña</a>
        </div>
        <div class="form-group">
            <a href="index.php?controlador=usuario&accion=detalleExamen">Detalle exámenes</a>
        </div>
      </div>
    </article>
		<article class="col-xs-12 col-sm-10 col-md-10 col-lg-10 ">
			<div class="jumbotron">
				<h2 class="text-center">{Nombre Del Usuario}</h2>
				<span class="help-block">* Campos necesarios.</span>
				<form name="creandoperfil" action="index.php?controlador=usuario&accion=Perfil&response=1" method="POST">
					<div class="form-horizontal well">
						<fieldset>
							<legend>Datos Personales</legend>
							<div class="form-group">
								<div class="col-sm-6 col-md-4 col-lg-4">
									<label for="nom">Nombre: *</label><br>
									<input for="nam" id="Name" name="Nombre" value="{Nombre}" type="text" placeholder="Oscar" class="form-control" onchange="Elimina_Error('ErrorName')">
								</div>
								<div class="col-sm-6 col-md-4 col-lg-4">
									<label for="ApeP">Apellido Paterno: *</label><br>
									<input name="ApellidoP" id="ApeP" value="{ApellidoP}"type="text" placeholder="Perez" class="form-control" onchange="Elimina_Error('ErrorApeP')">
								</div>
								<div class="col-sm-6 col-md-4 col-lg-4">
									<label for="ApeM">Apellido Materno*: </label><br>
									<input name="ApellidoM" id="ApeM" value="{ApellidoM}" type="text" placeholder="Suarez" class="form-control" onchange="Elimina_Error('ErrorApeM')">
								</div>
							</div>
							<!---->
              {IniciaEspTelefono}<div id="{idEspTel}">
								<div class="form-group col-xs-12 col-md-8 col-lg-6">
									<label for="" class="col-xs-12 col-sm-4 control-label">Telefono*:</label>
									<div id="InBtn"class="col-xs-12 col-sm-6	col-lg-8  input-group">
										<input class="form-control" id="Telefono" name="Telefonos[]" value="{valorTelefono}" placeholder="363636052" type="text" onkeypress="campoNumerico(this)" onchange="Elimina_Error('ErrorTelefono')">
										<span id="spanBtn" class="input-group-btn">
							        <button  id="BtnMoreTel"class="btn btn-default {BtnAddTel}" type="button" data-tooltip="{toolTipTel}" onclick="{BtnTelClick}">
							        	<i  id="iconBtnMoreTel" class="glyphicon {glyIconT}"></i>
							        </button>
							      </span>
									</div>
								</div>
							</div>{FinEspTelefono}
							<!---->
						</fieldset>
					</div>
					<section class="form-horizontal well">
						<fieldset>
							<legend>Redes Sociales*:</legend>
							{InicioRedes}<div id="{idEsp}">
								<div class="form-group col-xs-12 col-md-11">
									<label for="" class="col-xs-2 control-label">URL:</label>
									<div class="col-xs-12 col-sm-10	col-lg-8  input-group">
										<input class="form-control" id="URLred" name="RedSocial[]" value="{valorRed}" placeholder="https://www.facebook.com/" type="text" onchange="Elimina_Error('ErrorRed')">
										<span class="input-group-btn">
							        <button  id="BtnMore" class="btn btn-default {BtnAddRed}" type="button" data-tooltip="{toolTipRed}" onclick="{BtnRedClick}">
							        	<i  id="iconBtnMore" class="glyphicon {glyIcon}"></i></button>
							      </span>
									</div>
								</div>
							</div>{FinRedes}
						</fieldset>
				</section>
					<div class="form-horizontal well">
						<fieldset>
							<legend>Datos Académicos</legend>
							<div class="form-group">
								<label for="uni" class="col-md-2 control-label">Universidad*: </label>
								<div class="col-md-8">
									<input name="Universidad" id="Universidad" value="{valorUniversidad}" type="text" placeholder="Centro Universitario De Las Ciencias" class="form-control" onchange="Elimina_Error('ErrorUniversidad')">
								</div>
							</div>
							<div class="form-group">
								<label for="car" class="control-label col-xs-12 col-sm-2 col-md-2">Carrera*: </label>
								<div class="col-xs-12 col-sm-5  col-md-4">
									<input name="Carrera" id="Carrera" type="text" value="{valorCarrera}" placeholder="Ing Mecatronica" class="form-control" onchange="Elimina_Error('ErrorCarrera')">
								</div>
								<label for="pro" class="control-label col-xs-12 col-sm-2 col-md-2">Promedio*: </label>
								<div class="col-xs-12 col-sm-3 col-md-2">
									<input id="Promedio" name="Promedio" type="number" value="{valorPromedio}" placeholder="87" class="form-control" onchange="ValidaProm()">
								</div>
							</div>
							<div class="form-group">
								<label for="estado" class="col-xs-6 col-md-1 control-label">Estado*: </label>
								<div class="col-xs-6  col-md-2">
									<select class="form-control" name="Estado">
										<option  {seleccionEn Proceso}>En Proceso</option>
										<option {seleccionTerminada}>Terminada</option>
									</select>
								</div>
								<label for="porcentaje" class="col-xs-6  col-md-2 control-label">Porcentaje*: </label>
								<div class="col-xs-6  col-md-2">
									<select class="form-control" name="Porcentaje">
										<option value="10%" {selec10}>10%</option>
										<option value="20%" {selec20}>20%</option>
										<option value="30%" {selec30}>30%</option>
										<option value="40%" {selec40}>40%</option>
										<option value="50%" {selec50}>50%</option>
										<option value="60%" {selec60}>60%</option>
										<option value="70%" {selec70}>70%</option>
										<option value="80%" {selec80}>80%</option>
										<option value="90%" {selec90}>90%</option>
										<option value="100%" {selec100}>100%</option>
									</select>
								</div>
								<label for="T" class="col-xs-6  col-md-1 control-label">Tiempo Restante*: </label>
								<div class="col-xs-3  col-md-2">
									<input id="Tiempo" type="number" name="TiempoRestante" value="{TiempoRestante}" placeholder="2" class="form-control" onchange="ValidaTiempo()">
								</div>
								<div class="col-xs-3  col-md-2">
									<select id="OpcTiempo" name="Lapso" class="form-control" onchange="CambiaPeriodo()">
										<option value="Años">Años</option>
										<option value="Semestres">Semestres</option>
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
					  					{ValoresLunesDesde}
					  				</select>
						  		</div>
						  		<div class="col-xs-6 col-md-4">
						  			<label for="" class="control-label">Hasta</label>
					  				<select name="LunesHasta" id="LunesHasta" class="form-control" onchange="Valida_Horario('LunesDesde','LunesHasta')">
					  					{ValoresLunesHasta}
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
				  						{ValoresMartesDesde}
				  					</select>
						  		</div>
					  			<div class="col-xs-6 col-md-4">
					  				<label for="" class="control-label">Hasta</label>
				  					<select name="MartesHasta" id="MartesHasta" class="form-control" onchange="Valida_Horario('MartesDesde','MartesHasta')">
				  						{ValoresMartesHasta}
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
				  						{ValoresMiercolesDesde}
				  					</select>
					  			</div>
					  			<div class="col-xs-6 col-md-4">
					  				<label for="" class="control-label">Hasta</label>
				  					<select name="MiercolesHasta" id="MiercolesHasta" class="form-control" onchange="Valida_Horario('MiercolesDesde','MiercolesHasta')">
				  						{ValoresMiercolesHasta}
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
				  						{ValoresJuevesDesde}
				  					</select>
					  			</div>
					  			<div class="col-xs-6 col-md-4">
					  				<label for="" class="control-label">Hasta</label>
				  					<select name="JuevesHasta" id="JuevesHasta" class="form-control" onchange="Valida_Horario('JuevesDesde','JuevesHasta')">
				  						{ValoresJuevesHasta}
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
				  						{ValoresViernesDesde}
				  					</select>
					  			</div>
					  			<div class="col-xs-6 col-md-4">
					  				<label for="" class="control-label">Hasta</label>
				  					<select name="ViernesHasta" id="ViernesHasta" class="form-control" onchange="Valida_Horario('ViernesDesde','ViernesHasta')">
				  						{ValoresViernesHasta}
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
				  						{ValoresSabadoDesde}
				  					</select>
					  			</div>
					  			<div class="col-xs-6 col-md-4">
					  				<label for="" class="control-label">Hasta</label>
				  					<select name="SabadoHasta" id="SabadoHasta" class="form-control" onchange="Valida_Horario('SabadoDesde','SabadoHasta')">
				  						{ValoresSabadoHasta}
				  					</select>
					  			</div>
						  	</div><!--FIN BLOQUE Sabado-->
					  	</div><!--FIN BLOQUE JUEV-SAB-->
							</div>
						</fieldset>
						</div>
						
					<div class="col-md-offset-5 col-md-2">
						<button type="submit" class="btn btn-primary form-control" onclick="return Valida_Campos(1)">Actualizar</button>
					</div>
				</form>
				
			</div>
			<div class="jumbotron">
				<form action="index.php?controlador=usuario&accion=cambioContrasena" method="post">
					<div class="form-horizontal well ">
						<fieldset>
						<legend>Cambiar Contraseña</legend>
							<div class="form-group">
								<div class="col-sm-6 col-md-4 col-lg-3">
									<label for="contrasena_actual">Contraseña Actual</label><br>
									<input id="contrasena_actual" name="contrasena_actual" type="password"  class="form-control">
							{ErrorContra}
								</div>
								<div class="col-sm-6 col-md-4 col-lg-3">
									<label for="contrasena_nueva">Nueva Contraseña</label><br>
									<input id="contrasena_nueva" name="contrasena_nueva" type="password" class="form-control">
								</div>
								<div class="col-sm-6 col-md-4 col-lg-3">
									<label for="confirmacion">Confirmar</label><br>
									<input id="contrasena_confirmacion"  name="contrasena_confirmacion" type="password" class="form-control" onchange="Elimina_Error('ErrorContra')">
								</div>
							</div>
							<div class="col-md-offset-4 col-md-4">
								<button type="submit" class="btn btn-primary form-control" onclick="return ValidaPassword(2)">Actualizar Contraseña</button>
							</div>
							</div>
						</fieldset>
				</form>
			</div>
			
		</article>
	</section>
<?php include("Footer.php");?>
<script type="text/javascript" src="js/ValidacionesPerfilRegistro.js"></script>