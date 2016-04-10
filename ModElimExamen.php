<?php include("Header.php"); ?>
<?php include("MenuAdmin.php"); ?>
<section class="col-xs-12 col-md-10 col-md-offset-1 content lines">
	<br>
	<form action="" class="form-horizontal">
		<div class="form-group row">
			<div class="col-xs-12 col-md-1">
				<label for="id" class="control-label">ID</label>
			</div>
			<div class="col-xs-12 col-md-3">
				<input type="text" class="form-control" id="id" placeholder="45" onchange="CambioControl()">
			</div>
			<div class="col-xs-12 col-md-1">
				<label for="nombre" class="control-label">Nombre</label>
			</div>
			<div class="col-xs-12 col-md-3">
				<input type="text" class="form-control" id="nombre" placeholder="CSS Avanzado" onchange="CambioControl()">
			</div>
		    <div class="col-xs-12 col-md-1">
				<label for="categoria" class="control-label">Categoria</label>
			</div>
			<div class="col-xs-12 col-md-3">
				<select class="form-control" id="categoria" onchange="CambioControl()">
					<option>Categoria 1: POO</option>
					<option>Categoria 2: Maquetado Web</option>
				</select>
			</div>
		</div>
		<label id="MensajeBuscar" class="Warning">*Debes de escribir el id, o el nombre o seleccionar una categoria</label>
		<div class="form-group row">
			<div class="col-xs-6 col-sm-2 col-sm-offset-8">
				<button class="btn btn-primary" type="button" onclick="Buscar()">Buscar</button>
			</div>
			<div class="col-xs-6 col-sm-2">
				<button class="btn btn-primary" type="button" onclick="Limpiar()">Limpiar</button>
			</div>
		</div>

		<div class="form-group row">
			<div class="table-responsive">
				<table class="table table-hover" id="examen" onmouseup="CambioExamen()">
					<tbody>
						<tr>
							<th>ID</th>
							<th>Nombre</th>
							<th>Categoria</th>
							<th>Total Preguntas</th>
							<th>Tiempo (min)</th>
							<th>Calificación minima</th>
							<th>Selección</th>
						</tr>
						<tr>
							<td>01</td>
							<td>HTML basico facil</td>
							<td>Web</td>
							<td>14</td>
							<td>30</td>
							<td>70</td>
							<td><input type="checkbox"></td>
						</tr>
					</tbody>
				</table>
			</div>
		</div>

		<div class="form-group row">
			<label id="MensajeEliminar" class="Warning">*Debes de seleccionar un examen</label>
			<div class="col-xs-6 col-sm-2 col-sm-offset-8">
				<button class="btn btn-primary" type="button" onclick="EliminarExamen()">Eliminar</button>
			</div>
			<div class="col-xs-6 col-sm-2">
				<button class="btn btn-primary" type="button" onclick="ModificarExamen()">Modificar</button>
			</div>
		</div>
	</form>
</section>
<script type="text/javascript" src="js/ValidacionesModElimExamen.js"></script>
<?php include("Footer.php");?>	