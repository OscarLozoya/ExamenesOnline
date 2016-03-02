<?php include("Header.php"); ?>

	<section class="container-fluid">
		<aside class="col-xs-12 col-sm-3 aside lines">
			<br>
			<form action="" class="form-horizontal">
				<div class="form-group">
					<div class="col-md-6">
						<img src="" alt="Icon-user" class="form-control"></img>
					</div>
					<div class="col-md-6">
						<label for="Nombre_completo" class="control-label">Nombre Completo</label><br>
						<a href="Perfil.php" class="control-label">Ver Perfil</a>
					</div>
				</div>
				<div class="form-group col-md-12">
					<label for="Examenes_pendientes" class="control-label">Exámenes pendientes</label>
					<select class="form-control input-sm">
						<option>Categoría 1</option>
						<option>Categoría 2</option>
						<option>Categoría 3</option>
						<option>Categoría 4</option>
					</select>
				</div>
				<div class="form-group col-md-12">
					<label for="Categoria" class="control-label text-center">Categoría</label><br>
					<label for="duracion" class="control-label">Duración<label>
				</div>

				<div class="form-group">
					<div class="col-xs-6">
						<button class="btn btn-primary btn-block">Ir al Examen</button>
					</div>
					<div class="col-xs-6">
						<button class="btn btn-warning btn-block">Salir</button>
					</div>
				</div>
			</form>
		</aside>

		<article class="col-xs-12 col-sm-9 content lines">
			<h1 class="text-center">Detalle Exámenes</h1>
			<table class="table">
				<tr>
					<th>Fecha</th>
					<th>Categoría</th>
					<th>Título</th>
					<th>No. Preguntas</th>
					<th>Aciertos</th>
					<th>Estado</th>
					<th>Calificacion</th>
				</tr>
			</table>
		</article>
	</section>
<?php include("Footer.php");?>
