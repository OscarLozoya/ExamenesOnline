<?php include("Header.php"); ?>
<div class="form-group">
	<ol class="breadcrumb">
	  <li><a href="#">Home</a></li>
	  <li><a href="#">Configuración</a></li>
	  <li class="active">Slider</li>
	</ol>
</div>
<?php include("MenuAdmin.php"); ?>
	<form name="creandoexamen" action="404.php" method="post">
	<section class="container-fluid lines">
		<article class="jumbotron">
			<div class="form-horizontal well">
				<fieldset>
					<legend>Diseño Exámen</legend>
					<div class="form-group">
						<label for="id" class="col-md-1 control-label">ID: </label>
						<div class="col-md-1">
							<input id="id" type="text" disabled class="form-control" placeholder="18">
						</div>
						<label for="categoria" class="col-md-1 control-label">Categoría: </label>
						<div class="col-md-2">
							<select id="categoria" class="form-control" onchange="CambioAlgo('categoria')">
								<option>Categoría 1</option>
								<option>Categoría 2</option>
								<option>Categoría 3</option>
								<option>Categoría 4</option>
							</select>
						</div>
						<label for="cantidad_preguntas" class="col-md-2 control-label">Cantidad Preguntas:</label>
						<div class="col-md-1">
							<input id="cantidad_preguntas" type="number" class="form-control" placeholder="20" onchange="CambioAlgo('cantidad')">
						</div>
						<label for="tiempo" class="col-md-2 control-label">Tiempo Limite (min)</label>
						<div class="col-md-1">
							<input id="tiempo" type="number" class="form-control" placeholder="5" onchange="CambioAlgo('tiempo')">
						</div>
					</div>
					<div class="form-group">
						<label for="calificacion" class="col-md-3 control-label">Calificación Mínima Aprobatoria</label>
						<div class="col-md-1">
							<input id="calificacion" type="number" class="form-control" placeholder="60" onchange="CambioAlgo('calificacion')">
						</div>
						<label for="nombre" class="col-md-2 control-label">Nombre Exámen</label>
						<div class="col-md-3">
							<input id="nombre" type="text" class="form-control" placeholder="JavaScript" onchange="CambioAlgo('nombre')">
						</div>
						<div class="col-md-3">
							<button type="submit" class="btn btn-primary" onclick="return validarExamen()">Guardar Exámen</button>
						</div>
					</div>
					<div class="form-group">
						<div class="col-xs-12">
							<label id="MensajeCategoria" class="Warning control-label">*Debes seleccionar una categoria</label>
						</div>
						<div class="col-xs-12">
							<label id="MensajeCantidad" class="Warning control-label">*Debes escribir una cantidad de preguntas</label>
						</div>
						<div class="col-xs-12">
							<label id="MensajeTiempo" class="Warning control-label">*Escribe una cantidad de tiempo</label>
						</div>
						<div class="col-xs-12">
							<label id="MensajeCalificacion" class="Warning control-label">*Escribe una calificacion</label>
						</div>
						<div class="col-xs-12">
							<label id="MensajeNombre" class="Warning control-label">*Escribe un nombre de examen</label>
						</div>
					</div>
				</fieldset>
			</div>
		</article>
	</section>
	</form>
<script type="text/javascript" src="js/ValidacionesCrearExamen.js"></script>
<?php include("Footer.php"); ?>