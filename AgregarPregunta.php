<?php include("Header.php"); ?>
<section class="container-fluid col-xs-12 col-md-10 col-md-offset-1 content lines">
	<form action="" class="form-horizontal">
		<br>
		<div class="form-group row">

					<div class="col-xs-12 col-md-1">
						<label for="descripcion" class="control-label">Descripción</label>
					</div>
					<div class="col-xs-12 col-md-9">
					 	<textarea class="form-control noresize" rows="5" cols="20" id="descripcion" placeholder="Ingresa la descripción"></textarea>
					</div>
				
					<div class="col-xs-12 col-md-2">
						<div class="row">
							<div class="col-xs-12">
								<label for="id-pregunta" class="control-label">ID Pregunta</label>
							</div>
							<div class="col-xs-12">
								<input type="text" class="form-control" id="id-pregunta" disabled>
							</div>
						</div>	
					</div>

		</div>

		<div class="form-group row">

				<div class="col-xs-12 col-md-1">
					<label for="categoria" class="control-label">Categoria</label>
				</div>
				<div class="col-xs-12 col-md-6">
					<select class="form-control" id="categoria">
						<option>Categoria 1: POO</option>
						<option>Categoria 2: Maquetado Web</option>
					</select>
				</div>
				<div class="col-xs-3 col-md-2">
					<button class="btn btn-default">Agregar Categoria</button>
				</div>

		</div>

		<div class="form-group row">

				<div class="col-xs-12 col-md-9 col-md-offset-1">
					<div class="table-responsive">
						<table class="table table-bordered">
							<tr>
								<th>ID</th>
								<th>Nombre Categoria</th>
							</tr>
						</table>
					</div>	
				</div>
				<div class="col-xs-3 col-md-2">
					<button class="btn btn-default">Eliminar Categoria</button>
				</div>

		</div>

		<div class="form-group row">

				<div class="col-xs-12 col-md-1">
					<label for="tipo" class="control-label">Tipo</label>
				</div>
				<div class="col-xs-12 col-md-6">
					<select class="form-control" id="tipo">
						<option>Abierta</option>
						<option>Opciones</option>
					</select>
				</div>

		</div>

		<div class="form-group row">
				<div class="col-xs-12 col-md-1">
					<label for="respuesta" class="control-label">Respuesta</label>
				</div>
				<div class="col-xs-12 col-md-6">
					<input class="form-control" type="text"></input>
				</div>
				<div class="col-xs-3 col-md-2">
					<button class="btn btn-default">Agregar Respuesta</button>
				</div>
			
		</div>

		<div class="form-group row">

				<div class="col-xs-12 col-md-9 col-md-offset-1">
					<div class="table-responsive">
						<table class="table table-bordered">
							<tr>
								<th>Respuesta</th>
								<th>Resultado</th>
							</tr>
						</table>
					</div>	
				</div>
				<div class="col-xs-3 col-md-2">
					<button class="btn btn-default">Eliminar Respuesta</button>
				</div>

		</div>
	</form>
</section>

<?php include("Footer.php");?>
			
			