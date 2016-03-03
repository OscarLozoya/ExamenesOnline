<?php include("Header.php"); ?>
<div class="form-group">
	<ol class="breadcrumb">
	  <li><a href="#">Home</a></li>
	  <li><a href="#">Configuración</a></li>
	  <li class="active">Slider</li>
	</ol>
</div>
<?php include("MenuAdmin.php"); ?>
	<section class="container-fluid">
		<article class="content lines">
			<div class="form-horizontal well">
				<fieldset>
					<legend>Diseño Exámen</legend>
					<div class="form-group">
						<label for="id" class="col-md-1 control-label">ID: </label>
						<div class="col-md-1">
							<input type="text" class="form-control">
						</div>
						<label for="categoria" class="col-md-1 control-label">Categoría: </label>
						<div class="col-md-2">
							<select class="form-control">
								<option>Categoría 1</option>
								<option>Categoría 2</option>
								<option>Categoría 3</option>
								<option>Categoría 4</option>
							</select>
						</div>
						<label for="cantidad_preguntas" class="col-md-2 control-label">Cantidad Preguntas:</label>
						<div class="col-md-1">
							<select class="form-control"></select>
						</div>
						<label for="tel_fijo" class="col-md-2 control-label">Tiempo Limite (min)</label>
						<div class="col-md-1">
							<select class="form-control"></select>
						</div>
					</div>
					<div class="form-group">
						<label for="tel_fijo" class="col-md-3 control-label">Calificación Mínima Aprobatoria</label>
						<div class="col-md-1">
							<select class="form-control"></select>
						</div>
						<label for="tel_fijo" class="col-md-2 control-label">Nombre Exámen</label>
						<div class="col-md-3">
							<input type="text" class="form-control">
						</div>
						<div class="col-md-3">
							<button class="btn btn-primary">Guardar Exámen</button>
						</div>
					</div>
				</fieldset>
			</div>
		</article>
	</section>
<?php include("Footer.php"); ?>