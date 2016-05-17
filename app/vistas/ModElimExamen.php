<?php include("Header.php"); ?>
<?php include("MenuAdmin.php"); ?>
<section class="col-xs-12 col-md-10 col-md-offset-1 content lines">
	<br>
	<form action="index.php?controlador=examen&accion=eliminar&response=buscar" class="form-horizontal" method="POST">
		<div class="form-group row">
			<div class="col-xs-12 col-md-1">
				<label for="id" class="control-label">ID</label>
			</div>
			<div class="col-xs-12 col-md-3">
				<input type="text" class="form-control" id="id" name="id" placeholder="45" onchange="CambioControl()">
			</div>
			<div class="col-xs-12 col-md-1">
				<label for="nombre" class="control-label">Nombre</label>
			</div>
			<div class="col-xs-12 col-md-3">
				<input type="text" class="form-control" id="nombre" name="nombre" placeholder="CSS Avanzado" onchange="CambioControl()">
			</div>
		    <div class="col-xs-12 col-md-1">
				<label for="categoria" class="control-label">Categoria</label>
			</div>
			<div class="col-xs-12 col-md-3">
				<select class="form-control" id="categoria" name="categoria" onchange="CambioControl()">
					<option>{Categoria}</option>
				</select>
			</div>
		</div>
		<label id="MensajeBuscar" class="Warning">*Debes de escribir el id, o el nombre o seleccionar una categoria</label>
		<div class="form-group row">
			<div class="col-xs-6 col-sm-2 col-sm-offset-8">
				<button class="btn btn-primary" type="submit" onclick="Buscar()">Buscar</button>
			</div>
			<div class="col-xs-6 col-sm-2">
				<button class="btn btn-primary" type="button" onclick="Limpiar()">Limpiar</button>
			</div>
		</div>
	</form>
	<form action="index.php?controlador=examen&accion=eliminar" class="form-horizontal" method="POST">
		<div class="form-group row">
			<div class="table-responsive">
				<table class="table table-hover" id="examen" onmouseup="CambioExamen()">
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
							<td>{ID}<input type="hidden" name="id" id="id" value="{id}"></td>
							<td>{Nombre}</td>
							<td>{Categoria}</td>
							<td>{Preguntas}</td>
							<td>{Tiempo}</td>
							<td>{Calificacion}</td>
							<td><input type="checkbox"></td>
						</tr>
					</tbody>
				</table>
			</div>
		</div>

		<div class="form-group row">
			<label id="MensajeEliminar" class="Warning">*Debes de seleccionar un examen</label>
			<div class="col-xs-6 col-sm-2 col-sm-offset-8">
				<button class="btn btn-primary" type="submit" onclick="EliminarExamen()">Eliminar</button>
			</div>
			<div class="col-xs-6 col-sm-2">
				<button class="btn btn-primary" type="button" onclick="ModificarExamen()">Modificar</button>
			</div>
		</div>
	</form>
</section>
<script type="text/javascript" src="js/ValidacionesModElimExamen.js"></script>
<?php include("Footer.php");?>	