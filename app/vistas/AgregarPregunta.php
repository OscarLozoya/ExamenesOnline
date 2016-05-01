<?php include("Header.php"); ?>
<section class="container-fluid col-xs-12 col-md-10 col-md-offset-1 content lines">
	<form action="" class="form-horizontal">
		<br>
		<div class="form-group row">

					<div class="col-xs-12 col-md-1">
						<label for="descripcion" class="control-label">Descripción</label>
					</div>
					<div class="col-xs-12 col-md-9">
					 	<textarea class="form-control noresize" id="Pregunta" rows="5" cols="20" id="descripcion" placeholder="Ingresa la descripción de tu pregunta" onchange="CambioPregunta()"></textarea>
					 	<label id="MensagePregunta" class="Warning">*Debes de ingresar la pregunta</label>
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
					<button class="btn btn-primary" type="button" onclick="valAgregarCategoria()">Agregar Categoria</button>
				</div>

		</div>

		<div class="form-group row">

				<div class="col-xs-12 col-md-9 col-md-offset-1">
					<div class="table-responsive">
						<table class="table table-hover" id="Categorias" >
							<tbody>
								<tr>
									<th>ID</th>
									<th>Nombre Categoria</th>
									<th>Selección</th>
								</tr>
								<tr>
									<td>01</td>
									<td>Web</td>
									<td><input type="checkbox"></td>
								</tr>
							</tbody>
						</table>
						<label id="MensageCategoria" class="Warning">*Debes de agregar por lo menos una categoria</label>
					</div>	
				</div>
				<div class="col-xs-3 col-md-2">
					<button class="btn btn-primary" type="button" onclick="elminarCategoria()">Eliminar Categoria</button>
				</div>

		</div>

		<div class="form-group row">

				<div class="col-xs-12 col-md-1">
					<label for="tipo" class="control-label">Tipo</label>
				</div>
				<div class="col-xs-12 col-md-6">
					<select class="form-control" id="tipo" onchange="OpcionRespuesta()">
						<option>Opciones</option>
						<option>Abierta</option>
					</select>
				</div>

		</div>
		<div id="respuestaOpciones">
			<div class="form-group row">
					<div class="col-xs-12 col-md-1">
						<label for="respuesta" class="control-label">Respuesta</label>
					</div>
					<div class="col-xs-12 col-md-6">
						<input class="form-control" type="text" id="TextoRespuesta" placeholder="Respuesta a la pregunta" onchange="cambioContenidoRespuesta()"></input>
						<label id="MensageContenidoRespuesta" class="Warning">*Debes de escribir la respuesta</label>
					</div>
					<div class="col-xs-3 col-md-2">
						<button class="btn btn-primary" type="button" onclick="valAgregarRespuesta()">Agregar Respuesta</button>
					</div>
				
			</div>

			<div class="form-group row">

					<div class="col-xs-12 col-md-9 col-md-offset-1">
						<div class="table-responsive">
							<table class="table table-hover" id="Respuestas" onmouseup="CambioRespuestaCorrecta()">
								<tbody>
									<tr>
										<th>Respuesta</th>
										<th>Resultado</th>
										<th>Selección</th>
									</tr>
									<tr>
										<td>HTML</td>
										<td><input type="checkbox"></td>
										<td><input type="checkbox"></td>
									</tr>
								</tbody>
							</table>
							<label id="MensageRespuestas" class="Warning">*Debes de agregar por lo menos una respuesta</label>
							<label id="MensageRespuestaCorrecta" class="Warning">*Debes de seleccionar por lo menos una respuesta correcta</label>
						</div>	
					</div>
					<div class="col-xs-3 col-md-2">
						<button class="btn btn-primary" type="button" onclick="eliminarRespuesta()">Eliminar Respuesta</button>
					</div>

			</div>
		</div>
		<div class="form-group row">
			<div class="col-xs-5">
				<button class="btn btn-primary" type="button" onclick="ValidaAgregarPregunta()">Agregar Pregunta</button>
			</div>
		</div>
	</form>
</section>
<script type="text/javascript" src="js/ValidacionesAgregarPregunta.js"></script>
<?php include("Footer.php");?>
			
			