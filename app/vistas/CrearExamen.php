<?php include("Header.php"); ?>

<?php include("MenuAdmin.php"); ?>
	<form name="creandoexamen" action="index.php?controlador=examen&accion=crear&response=buscar" method="post" onsubmit="return Buscar()">
	<section class="container-fluid lines">
		<article class="jumbotron">
			<div class="form-horizontal well">
				<fieldset>
					<legend>Diseño Exámen</legend>
					<div class="form-group">
						<label for="id" class="col-md-1 control-label">ID: </label>
						<div class="col-md-1">
							{inicio_idExamen}<input id="id" name="ID" type="text" value="{ID}" disabled class="form-control" placeholder="18">{fin_idExamen}
						</div>
						<label for="categoria" class="col-md-1 control-label">Categoría: </label>
						<div class="col-md-2">
							<select id="categoria" name="categoria" class="form-control" onchange="CambioAlgo('categoria')">
								{inicio_categoria}<option value="{ID_Categoria}">{Categoria}</option>{fin_categoria}
							</select>
						</div>
						<label for="cantidad_preguntas" class="col-md-2 control-label">Cantidad Preguntas:</label>
						<div class="col-md-1">
							<input id="cantidad_preguntas" value="{cantidadPreguntas}" name="cantidadPreguntas" type="number" class="form-control" placeholder="20" onchange="CambioAlgo('cantidad')">
						</div>
						<label for="tiempo" class="col-md-2 control-label">Tiempo Limite (min)</label>
						<div class="col-md-1">
							<input id="tiempo" name="tiempoLimite" value="{tiempoLimite}" type="number" class="form-control" placeholder="5" onchange="CambioAlgo('tiempo')">
						</div>
					</div>
					<div class="form-group">
						<label for="calificacion" class="col-md-3 control-label">Calificación Mínima Aprobatoria</label>
						<div class="col-md-1">
							<input id="calificacion" name="calificacionMinima" value="{calificacionMinima}" type="number" class="form-control" placeholder="60" onchange="CambioAlgo('calificacion')">
						</div>
						<label for="nombre" class="col-md-2 control-label">Nombre Exámen</label>
						<div class="col-md-3">
							<input id="nombre" name="nombreExamen" value="{nombreExamen}" type="text" class="form-control" placeholder="JavaScript" onchange="CambioAlgo('nombre')">
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
					<fieldset>
					<legend>Asignación de Exámen</legend>
					<div class="form-group">
						<label for="nombreUsuario" class="col-md-5 control-label">Nombre Usuario:</label>
						<div class="col-md-5">
							<input id="nombreUsuario" name="nombreUsuario" type="text" class="form-control" placeholder="user56">
						</div>
						<label id="MensajeBuscar" class="Warning">*Debes de escribir un nombre de usuario</label>
						<div class="col-md-2">
							<button type="submit" class="btn btn-primary">Buscar</button>
						</div>
					</div>
					<form action="index.php?controlador=examen&accion=crear" class="form-horizontal" method="POST" onsubmit="return asignarExamen()">
					<div class="table-responsive">
					<input type="hidden" name="id-usuario" id="id-usuario" value="{id-usuario}">
					<table class="table table-hover" id="usuario" onmouseup="CambioExamen()">
					<thead>
						<tr>
							<th>ID</th>
							<th>Nombre</th>
							<th>Categoria</th>
							<th>Total Preguntas</th>
							<th>Tiempo (min)</th>
							<th>Calificación minima</th>
							<th>Selección</th>
						</tr>
					</thead>
					<tbody>
						<tr>
							<td>{ID}</td>
							<td>{Nombre}</td>
							<td>{Categoria}</td>
							<td>{Preguntas}</td>
							<td>{Tiempo}</td>
							<td>{Calificacion}</td>
							<td><input name="seleccion" type="checkbox"></td>
						</tr>
					</tbody>
				</table>
				</div>
				<div class="form-group row">
					<label id="MensajeAsignar" class="Warning">*Debes de seleccionar un usuario</label>
					<div class="col-xs-2 col-xs-offset-10">
						<button class="btn btn-primary" type="submit">Asignar</button>
					</div>
				</div>
				</fieldset>
			</div>
		</article>
	</section>
<script type="text/javascript" src="js/ValidacionesCrearExamen.js"></script>
<?php include("Footer.php"); ?>