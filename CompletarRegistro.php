<?php include("Header.php"); ?>
<div class="container-fluid">
		<section class="col-xs-12 col-sm-2 col-md-2 col-lg-2 formulario text-center" >
			<div class="form-horizontal">
				<div class="form-group">
				<br>
					<figure>
						<img src="images/logo_user.gif" alt="Imagen del Usuario" class="userLogo">					
					</figure>
				</div>
				<div class="form-group">
					<button type="button" class="btn btn-primarybtn-small">Elejir Imagen</button>
				</div>
			</div>
		</section>
		<section class="col-xs-12 col-sm-10 col-md-10 col-lg-10">
			<div class="jumbotron">
				<h3 class="text-center">Complete el Registro</h3>
				<span class="help-block">* Campos necesarios.</span>
				<section class="form-horizontal well text-center">
					<form>
						<fieldset>
							<legend>Datos Personales</legend>
							<div class="form-group">
								<div class="col-sm-6 col-md-4 col-lg-3">
									<label for="nom">Nombre: *</label>
								<br>
									<input for="name" type="text" placeholder="Fulano Fulanito" class="form-control">
								</div>
								<div class="col-sm-6 col-md-4 col-lg-3">
									<label for="ApeP">Apellido Paterno: *</label>
									<br>
									<input name="apeP" type="text" placeholder="Ferez" class="form-control">
								</div>
								<div class="col-sm-6 col-md-4 col-lg-3">
									<label for="ApeM">Apellido Materno:</label>
									<br>
									<input name="apeM" type="text" placeholder="Fuarez" class="form-control">
								</div>
								<div class="col-sm-6 col-md-4 col-lg-3">
									<label for="contra">Contraseña: *</label>
									<br>
									<input name="pass" type="password" class="form-control">
								</div>
							</div>
							<div class="form-group">
								<div class="col-sm-6  col-lg-4 col-lg-offset-1">
									<label for="fijo">Telefono Fijo:</label>
									<br>
									<input type="text" name="telfijo" class="form-control">
								</div>
								<div class="col-sm-6  col-lg-4 col-lg-offset-1">
									<label for="tcel">Telefono Celular:</label>
									<br>
									<input type="text" name="cel" class="form-control">
								</div>
							</div>
						</fieldset>
					</form>
				</section>
				<section class=" well">
					<form action="">
						<fieldset>
							<legend>Redes Sociales:</legend>
							<div class="form-group col-xs-12	col-md-6">
								<div class="col-xs-8	col-md-8">
									<input class="form-control" id="rd" type="text">
								</div>
								<div class="col-xs-4	col-md-4 ">
									<select class="form-control">
									  	<option>Facebook</option>
										  <option>Twitter</option>
										  <option>Google+</option>
										  <option>Skype</option>
									</select>
								</div>
							</div>
							<div class="form-group col-xs-12	col-md-6">
								<div class="col-xs-8	col-md-8">
									<input class="form-control" id="rd" type="text">
								</div>
								<div class="col-xs-4	col-md-4">
									<select class="form-control">
									  	<option>Facebook</option>
										  <option>Twitter</option>
										  <option>Google+</option>
										  <option>Skype</option>
									</select>
								</div>
							</div>
							<div class="form-group col-xs-12	col-md-6">
								<div class="col-xs-8	col-md-8">
									<input class="form-control" id="rd" type="text">
								</div>
								<div class="col-xs-4	col-md-4">
									<select class="form-control">
									  	<option>Facebook</option>
										  <option>Twitter</option>
										  <option>Google+</option>
										  <option>Skype</option>
									</select>
								</div>
							</div>
							<div class="form-group col-xs-12	col-md-6">
								<div class="col-xs-8	col-md-8">
									<input class="form-control" id="rd" type="text">
								</div>
								<div class="col-xs-4 col-md-4">
									<select class="form-control">
									  	<option>Facebook</option>
										  <option>Twitter</option>
										  <option>Google+</option>
										  <option>Skype</option>
									</select>								</div>
							</div>
						</fieldset>
					</form>
				</section>
				<section class="form-horizontal well">
					<form action="">
						<fieldset>
							<legend>Datos Academicos:</legend>
							<div class="form-group">
									<label for="uni" class="col-md-2 control-label">Universidad</label>
									<div class="col-md-8">
										<input type="text" class="form-control" id="universidad">
									</div>
							</div>
							<div class="form-group">	
									<label for="car" class="control-label col-xs-12 col-sm-2 col-md-2">Carrera</label>
									<div class="col-xs-12 col-sm-5  col-md-4">
										<input type="text" class="form-control" id="carrera">
									</div>		
									<label for="pro" class="control-label  col-xs-12 col-sm-2 col-md-2">Promedio</label>
									<div class="col-xs-12 col-sm-3 col-md-2">
										<input type="text" class="form-control" id="promedio">
									</div>	
							</div>
							<div class="form-group">
								<label for="estado" class="col-xs-6  col-md-1 control-label">Estado</label>
								<div class="col-xs-6  col-md-2">
									<select class="form-control">
										<option>Terminada</option>
										<option>En Proceso</option>
									</select>
								</div>
								<label for="porcentaje" class="col-xs-6  col-md-2 control-label">Porcentaje</label>
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
								<label for="tiempo_res" class="col-xs-12  col-md-1 control-label">Tiempo Restante</label>
								<div class="col-xs-6  col-md-2">
									<input type="number" class="form-control">
								</div>
								<div class="col-xs-6 col-sm-5 col-md-2">
									<select class="form-control">
										<option value="Semestres">Semestres</option>
										<option value="Años">Años</option>	
									</select>
								</div>
							</div>
							<div class="form-group col-xs-12">
									<h3 class="text-center">Horarios Disponibles</h3>
							  </div>
							  <div class="col-xs-12">
							  	<div class="col-xs-12 col-sm-12 col-lg-6">
							  		<div class="form-group">
								  		<label class=" col-xs-4 col-xs-offset-2 text-center">Desde</label>
								  		<label class=" col-xs-6 text-center">Hasta</label>
								  		<label for="" class="col-xs-2 control-label">Lunes</label>
								  		<div class="col-xs-5"><select class="form-control"></select></div>
											<div class="col-xs-5"><select class="form-control"></select></div>
								  	</div>
							  		<div class="form-group">
								  		<label class=" col-xs-4 col-xs-offset-2 text-center">Desde</label>
								  		<label class=" col-xs-6 text-center">Hasta</label>
								  		<label for="" class="col-xs-2 control-label">Martes</label>
								  		<div class="col-xs-5"><select class="form-control"></select></div>
											<div class="col-xs-5"><select class="form-control"></select></div>
								  	</div>
							  		<div class="form-group">
								  		<label class=" col-xs-4 col-xs-offset-2 text-center">Desde</label>
								  		<label class=" col-xs-6 text-center">Hasta</label>
								  		<label for="" class="col-xs-2 control-label">Miercoles</label>
								  		<div class="col-xs-5"><select class="form-control"></select></div>
											<div class="col-xs-5"><select class="form-control"></select></div>
								  	</div>
							  	</div>
							  	<div class="col-xs-12 col-sm-12 col-lg-6">
							  		<div class="form-group">
								  		<label class=" col-xs-4 col-xs-offset-2 text-center">Desde</label>
								  		<label class=" col-xs-6 text-center">Hasta</label>
								  		<label for="" class="col-xs-2 control-label">Jueves</label>
								  		<div class="col-xs-5"><select class="form-control"></select></div>
											<div class="col-xs-5"><select class="form-control"></select></div>
								  	</div>
							  		<div class="form-group">
								  		<label class=" col-xs-4 col-xs-offset-2 text-center">Desde</label>
								  		<label class=" col-xs-6 text-center">Hasta</label>
								  		<label for="" class="col-xs-2 control-label">Viernes</label>
								  		<div class="col-xs-5"><select class="form-control"></select></div>
											<div class="col-xs-5"><select class="form-control"></select></div>
								  	</div>
							  		<div class="form-group">
								  		<label class=" col-xs-4 col-xs-offset-2 text-center">Desde</label>
								  		<label class=" col-xs-6 text-center">Hasta</label>
								  		<label for="" class="col-xs-2 control-label">Sabado</label>
								  		<div class="col-xs-5"><select class="form-control"></select></div>
											<div class="col-xs-5"><select class="form-control"></select></div>
								  	</div>
							  	</div>
							  
							</div>
						</fieldset>
					</form>
				</section>
			</div>
		</section>
</div>
<?php include("Footer.php"); ?>