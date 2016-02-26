<?php include("Header.php"); ?>
	<section class="container-fluid">
    <article class="col-xs-2 col-sm-2 col-md-2 col-lg-2 ">
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
		<article class="col-xs-10 col-sm-10 col-md-10 col-lg-10 ">
			<div class="jumbotron">
				<h2 class="text-center page-header">Nombre Del Usuario</h2>
				<form>
					<div class="form-horizontal well">
						<fieldset>
							<legend>Datos Personales</legend>
						<div class="form-group">
								<label for="nombre" class="col-md-2">Nombre</label>
								<label for="ape_paterno" class="col-md-2">Apellido Paterno</label>
								<label for="ape_materno" class="col-md-2">Apellido Materno</label>
								<label for="tel_fijo" class="col-md-2">Teléfono Fijo</label>
								<label for="tel_celular" class="col-md-2">Teléfono Celular</label>
						</div>
						<div class="form-group">
								<div class="col-md-2"><input type="text" class="form-control"></input></div>
								<div class="col-md-2"><input type="text" class="form-control"></input></div>
								<div class="col-md-2"><input type="text" class="form-control"></input></div>
								<div class="col-md-2"><input type="tel" class="form-control"></input></div>
								<div class="col-md-2"><input type="tel" class="form-control"></input></div>
						</div>
						<div class="form-group">
								<label for="correo" class="col-md-2 control-label">Correo</label>
								<div class="col-md-4"><input type="email" class="form-control"></input></div>
						</div>
						</fieldset>
					</div>
					<div class="form-horizontal well">
						<fieldset>
							<legend>Redes sociales</legend>
						<div class="form-group">
								<label class="col-md-2">Nombre</label>
								<label class="col-md-2">Apellido Paterno</label>
								<label class="col-md-2">Apellido Materno</label>
								<label class="col-md-2">Teléfono Fijo</label>
								<label class="col-md-2">Teléfono Celular</label>
						</div>
						<div class="form-group">
								<div class="col-md-2"><input class="form-control"></input></div>
								<div class="col-md-2"><input class="form-control"></input></div>
								<div class="col-md-2"><input class="form-control"></input></div>
								<div class="col-md-2"><input class="form-control"></input></div>
								<div class="col-md-2"><input class="form-control"></input></div>
						</div>
						<div class="form-group">
								<label class="col-md-2 control-label">Correo</label>
								<div class="col-md-4"><input class="form-control"></input></div>
						</div>
						</fieldset>
					</div>
					<div class="form-horizontal well">
						<fieldset>
							<legend>Datos Académicos</legend>
						<div class="form-group">
								<label for="universidad" class="col-md-2 control-label">Universidad</label>
								<div class="col-md-8"><input type="text" class="form-control"></input></div>
						</div>
						<div class="form-group">
								<label for="carrera" class="col-md-2 control-label">Carrera</label>
								<div class="col-md-4"><input type="text" class="form-control"></input></div>
								<label for="promedio" class="col-md-2 control-label">Promedio</label>
								<div class="col-md-2"><input type="number" class="form-control"></input></div>
						</div>
						<div class="form-group">
								<label for="estado" class="col-md-2 control-label">Estado</label>
								<div class="col-md-2"><select class="form-control"></select></div>
								<label for="porcentaje" class="col-md-1 control-label">Porcentaje</label>
								<div class="col-md-2"><select class="form-control"></select></div>
								<label for="tiempo_res" class="col-md-2 control-label">Tiempo Restante</label>
								<div class="col-md-1"><select class="form-control"></select></div>
								<div class="col-md-2"><select class="form-control"></select></div>
						</div>
						<br><h3 class="text-center">Horarios Disponibles</h3><br>
						<div class="form-group">
								<label class=" col-md-offset-2 col-md-2">Desde</label>
								<label class="col-md-2">Hasta</label>
								<label class="col-md-offset-2 col-md-2">Desde</label>
								<label class="col-md-2">Hasta</label>
						</div>
						<div class="form-group">
								<label class="col-md-2 control-label">Lunes</label>
								<div class="col-md-2"><select class="form-control"></select></div>
								<div class="col-md-2"><select class="form-control"></select></div>
								<label class="col-md-2 control-label">Jueves</label>
								<div class="col-md-2"><select class="form-control"></select></div>
								<div class="col-md-2"><select class="form-control"></select></div>
						</div>
						<div class="form-group">
								<label class="col-md-2 control-label">Martes</label>
								<div class="col-md-2"><select class="form-control"></select></div>
								<div class="col-md-2"><select class="form-control"></select></div>
								<label class="col-md-2 control-label">Viernes</label>
								<div class="col-md-2"><select class="form-control"></select></div>
								<div class="col-md-2"><select class="form-control"></select></div>
						</div>
						<div class="form-group">
								<label class="col-md-2 control-label">Miércoles</label>
								<div class="col-md-2"><select class="form-control"></select></div>
								<div class="col-md-2"><select class="form-control"></select></div>
								<label class="col-md-2 control-label">Sabado</label>
								<div class="col-md-2"><select class="form-control"></select></div>
								<div class="col-md-2"><select class="form-control"></select></div>
						</div>
						</fieldset>
					</div>
					<div class="form-horizontal well ">
						<fieldset>
							<legend>Cambiar Contraseña</legend>
						<div class="form-group">
								<label class="col-md-3">Contraseña Actual</label>
								<label class="col-md-3">Nueva Contraseña</label>
								<label class="col-md-3">Confirmar</label>
						</div>
						<div class="form-group">
								<div class="col-md-3"><input type="password" class="form-control"></input></div>
								<div class="col-md-3"><input type="password" class="form-control"></input></div>
								<div class="col-md-3"><input type="password" class="form-control"></input></div>
						</div>
						</fieldset>
					</div>
					<div class="col-md-offset-5 col-md-2">
						<button class="btn btn-primary btn form-control">Actualizar</button>
					</div>
				</form>
			</div>
		</article>
	</section>
<?php include("Footer.php");?>