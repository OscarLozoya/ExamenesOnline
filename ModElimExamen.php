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
				<input type="text" class="form-control" id="id" placeholder="45">
			</div>
			<div class="col-xs-12 col-md-1">
				<label for="nombre" class="control-label">Nombre</label>
			</div>
			<div class="col-xs-12 col-md-3">
				<input type="text" class="form-control" id="nombre" placeholder="CSS Avanzado">
			</div>
		    <div class="col-xs-12 col-md-1">
				<label for="categoria" class="control-label">Categoria</label>
			</div>
			<div class="col-xs-12 col-md-3">
				<select class="form-control" id="categoria">
					<option>Categoria 1: POO</option>
					<option>Categoria 2: Maquetado Web</option>
				</select>
			</div>
		</div>

		<div class="form-group row">
			<div class="col-xs-6 col-sm-2 col-sm-offset-8">
				<button class="btn btn-primary">Buscar</button>
			</div>
			<div class="col-xs-6 col-sm-2">
				<button class="btn btn-primary">Limpiar</button>
			</div>
		</div>

		<div class="form-group row">
			<div class="table-responsive">
				<table class="table table-hover">
					<tr>
						<th>ID</th>
						<th>Categoria</th>
						<th>Total Preguntas</th>
						<th>Tiempo</th>
					</tr>
					<tr>
						<td>01</td>
						<td>Web</td>
						<td>14</td>
						<td>0:30</td>
					</tr>
				</table>
			</div>
		</div>

		<div class="form-group row">
			<div class="col-xs-6 col-sm-2 col-sm-offset-8">
				<button class="btn btn-primary">Eliminar</button>
			</div>
			<div class="col-xs-6 col-sm-2">
				<button class="btn btn-primary">Modificar</button>
			</div>
		</div>
	</form>
</section>
<?php include("Footer.php");?>	