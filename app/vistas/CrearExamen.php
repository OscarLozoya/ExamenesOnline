<?php include("Header.php"); ?>
<?php include("MenuAdmin.php"); ?>
	<section class="container-fluid lines">
		<article class="jumbotron">
			<div class="form-horizontal well">
				<form name="creandoexamen" action="index.php?controlador=examen&accion=crear" method="post" onsubmit="return asignarExamen()">
				<fieldset>
				<legend>Diseño De Exámen</legend>
				<div class="form-group">
					<label for="id" class="col-xs-2 control-label">ID Exámen: </label>
					<div class="col-xs-1">
						{inicio_idExamen}<input id="id" name="id-examen" type="text" value="{ID}" disabled class="form-control" placeholder="18">{fin_idExamen}
					</div>
					<label for="categoria" class="col-xs-2 control-label">Categoría: </label>
					<div class="col-xs-2">
						<select id="categoria" name="categoria" class="form-control" onchange="CambioAlgo('categoria')">
							{inicio_categoria}<option value="{ID_Categoria}">{Categoria}</option>{fin_categoria}
						</select>
					</div>
					<label for="cantidad_preguntas" class="col-xs-2 control-label">Cantidad Preguntas:</label>
					<div class="col-xs-2">
						<input id="cantidad_preguntas" value="{cantidadPreguntas}" name="cantidadPreguntas" type="number" class="form-control" placeholder="20" onchange="CambioAlgo('cantidad')">
					</div>
				</div>
				<div class="form-group">
					<label for="tiempo" class="col-xs-2 control-label">Tiempo Limite (Min):</label>
					<div class="col-xs-1">
						<input id="tiempo" name="tiempoLimite" value="{tiempoLimite}" type="number" class="form-control" placeholder="5" onchange="CambioAlgo('tiempo')">
					</div>
					<label for="calificacion" class="col-xs-3 col-xs-offset-3 control-label">Calificación Mínima Aprobatoria:</label>
					<div class="col-xs-2">
						<input id="calificacion" name="calificacionMinima" value="{calificacionMinima}" type="number" class="form-control" placeholder="60" onchange="CambioAlgo('calificacion')">
					</div>
				</div>
				<div class="form-group">
					<label for="nombre" class="col-xs-2 control-label">Nombre Exámen:</label>
					<div class="col-xs-9">
						<input id="nombre" name="nombreExamen" value="{nombreExamen}" type="text" class="form-control" placeholder="Manejo de arreglos en PHP" onchange="CambioAlgo('nombre')">
					</div>
				</div>
				<div class="form-group">
					<div class="col-xs-2 col-xs-offset-9">
						<button type="submit" class="btn btn-primary form-control" onclick="return validarExamen()">Guardar Exámen</button>
					</div>
					<label id="MensajeAsignar" class="Warning">*Debes de seleccionar un usuario</label>
				</div>
				<div class="form-group">
					<div class="col-xs-12">
						<label id="MensajeCategoria" class="Warning control-label">*Debes seleccionar una categoria</label>
						<label id="MensajeCantidad" class="Warning control-label">*Debes escribir una cantidad de preguntas</label>
						<label id="MensajeTiempo" class="Warning control-label">*Escribe una cantidad de tiempo</label>
						<label id="MensajeCalificacion" class="Warning control-label">*Escribe una calificacion</label>
						<label id="MensajeNombre" class="Warning control-label">*Escribe un nombre de examen</label>
					</div>
				</div>
				</fieldset>
				<input type="hidden" name="id-usuario" id="id-usuario" value="{id-usuario}">
				</form>
				
				<form action="index.php?controlador=examen&accion=crear&response=buscar" class="form-horizontal" method="POST">
				<fieldset>
				<legend>Asignación De Exámen</legend>
				<div class="form-group">
					<label for="nombreUsuario" class="col-xs-5 control-label">Nombre Usuario:</label>
					<div class="col-xs-5">
						<input id="nombreUsuario" name="nombreUsuario" type="text" class="form-control" placeholder="user56" onchange="mostrarUsuario(this.value())">
					</div>
					<label id="MensajeBuscar" class="Warning">*Debes de escribir un nombre de usuario</label>
					<div class="col-md-2">
						<button type="submit" class="btn btn-primary">Buscar</button>
					</div>
				</div>
				<div class="table-responsive">
					<table class="table table-hover" id="usuario">
						<thead>
							<tr>
								<th>Usuario</th>
								<th>Nombre</th>
								<th>Apellido Pateno</th>
								<th>Apellido Materno</th>
								<th>Universidad</th>
							</tr>
						</thead>
						<tbody>
							<tr>
								<td>{Usuario}</td>
								<td>{Nombre}</td>
								<td>{Apellido Paterno}</td>
								<td>{Apellido Materno}</td>
								<td>{Universidad}</td>
								<td><input name="seleccion" type="checkbox"></td>
							</tr>
						</tbody>
					</table>
				</div>
			</fieldset>
			</form>
			</div>
		</article>
	</section>
<script type="text/javascript" src="js/ValidacionesCrearExamen.js"></script>
<?php include("Footer.php"); ?>