<?php include("Header.php"); ?>

	<section class="container-fluid row">
		<article class="col-xs-12  container-fluid content lines">
			<h1 class="text-center">Detalle Exámenes</h1>
			<div class="table-responsive">
				<table class="table table-hover">
					<tr>
						<th>Categoría</th>
						<th>Título</th>
						<th>No. Preguntas</th>
						<th>Aciertos</th>
						<th>Estado</th>
						<th>Calificacion</th>
					</tr>
					<tr>
						<td>{Categoria}</td>
						<td>{Examen}</td>
						<td>{Num_Preguntas}</td>
						<td>{Aciertos}</td>
						<td>{Estado}</td>
						<td>{Calificacion}</td>
					</tr>
				</table>
			</div>
		</article>
	</section>
<?php include("Footer.php");?>
