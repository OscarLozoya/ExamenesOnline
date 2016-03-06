<?php include("Header.php"); ?>
	<section class="container-fluid lines">
    <article class="col-xs-12 col-sm-2 col-md-2 col-lg-2 text-center">
      <div class="form-horizontal">
        <div class="form-group">
            <img src="" alt="Icon-user" class="form-control"></img>
        </div>
        <div class="form-group">
            <button class="btn btn-primary btn-small">Cambiar Imagen</button>
        </div>
        <div class="form-group">
            <a href="">Cambio contraseña</a>
        </div>
        <div class="form-group">
            <a href="DetalleExamenes.php">Detalle exámenes</a>
        </div>
      </div>
    </article>
		<article class="col-xs-12 col-sm-10 col-md-10 col-lg-10 ">
			<div class="jumbotron">
				<h2 class="text-center page-header">Nombre Del Usuario</h2>
				<span class="help-block">* Campos necesarios.</span>
				<form>
					<div class="form-horizontal well">
						<fieldset>
							<legend>Datos Personales</legend>
							<div class="form-group">
								<div class="col-sm-6 col-md-4 col-lg-3">
									<label for="nombre">Nombre: *</label><br>
									<input id="nombre" type="text" placeholder="Juan" class="form-control">
								</div>
								<div class="col-sm-6 col-md-4 col-lg-3">
									<label for="ape_paterno">Apellido Paterno: *</label><br>
									<input id="ape_paterno" type="text" placeholder="Perez" class="form-control">
								</div>
								<div class="col-sm-6 col-md-4 col-lg-3"4
									<label for="ape_materno">Apellido Materno</label><br>
									<input id="ape_materno" type="text" placeholder="Suarez" class="form-control">
								</div>
								<div class="col-sm-6 col-md-4 col-lg-3">
									<label for="tel_fijo">Teléfono Fijo: </label><br>
									<input id="tel_fijo" type="text" placeholder="36259345" class="form-control">
								</div>
							</div>
							<div class="form-group">
								<div class="col-sm-6 col-md-5 col-lg-4">
									<label for="tel_celular">Teléfono Celular: </label><br>
									<input id="tel_celular" type="text" placeholder="3315623412" class="form-control">
								</div>	
								<div class="col-sm-6 col-md-5 col-lg-4">
									<label for="correo">Correo: </label><br>
									<input id="correo" type="email" placeholder="alguncorreo@mail.com" class="form-control">
								</div>	
						</div>
						</fieldset>
					</div>
					<div class="form-horizontal well">
						<fieldset>
							<legend>Redes sociales</legend>
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
					</div>
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
							<h3 class="text-center">Horarios Disponibles</h3>
							<div class="col-xs-12 col-sm-12 col-lg-6">
								<div class="form-group">
									<label class=" col-xs-offset-2 col-xs-4 text-center">Desde</label>
									<label class="col-xs-6 text-center">Hasta</label>
									<label class="col-xs-2 control-label">Lunes</label>
									<div class="col-xs-5"><select class="form-control"></select></div>
									<div class="col-xs-5"><select class="form-control"></select></div>
								</div>
								<div class="form-group">
									<label class=" col-xs-offset-2 col-xs-4 text-center">Desde</label>
									<label class="col-xs-6 text-center">Hasta</label>
									<label class="col-xs-2 control-label">Martes</label>
									<div class="col-xs-5"><select class="form-control"></select></div>
									<div class="col-xs-5"><select class="form-control"></select></div>
								</div>
								<div class="form-group">
									<label class=" col-xs-offset-2 col-xs-4 text-center">Desde</label>
									<label class="col-xs-6 text-center">Hasta</label>
									<label class="col-xs-2 control-label">Miercoles</label>
									<div class="col-xs-5"><select class="form-control"></select></div>
									<div class="col-xs-5"><select class="form-control"></select></div>
								</div>
							</div>
							<div class="col-xs-12 col-sm-12 col-lg-6">
								<div class="form-group">
									<label class=" col-xs-offset-2 col-xs-4 text-center">Desde</label>
									<label class="col-xs-6 text-center">Hasta</label>
									<label class="col-xs-2 control-label">Jueves</label>
									<div class="col-xs-5"><select class="form-control"></select></div>
									<div class="col-xs-5"><select class="form-control"></select></div>
								</div>
								<div class="form-group">
									<label class=" col-xs-offset-2 col-xs-4 text-center">Desde</label>
									<label class="col-xs-6 text-center">Hasta</label>
									<label class="col-xs-2 control-label">Viernes</label>
									<div class="col-xs-5"><select class="form-control"></select></div>
									<div class="col-xs-5"><select class="form-control"></select></div>
								</div>
								<div class="form-group">
									<label class=" col-xs-offset-2 col-xs-4 text-center">Desde</label>
									<label class="col-xs-6 text-center">Hasta</label>
									<label class="col-xs-2 control-label">Sabado</label>
									<div class="col-xs-5"><select class="form-control"></select></div>
									<div class="col-xs-5"><select class="form-control"></select></div>
								</div>
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
						<button type="submit" class="btn btn-primary btn form-control">Actualizar</button>
					</div>
				</form>
			</div>
		</article>
	</section>
<?php include("Footer.php");?>