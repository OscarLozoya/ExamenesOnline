<?php include("Header.php"); ?>

<?php include("MenuAdmin.php"); ?>
<section class="container-fluid lines col-xs-12 col-md-10 col-md-offset-1">
	<div class="jumbotron">
		<form action="{accion}" class="form-horizontal" method="POST" onsubmit="return ValidaAgregarPregunta()">
		<br>
		<div class="form-group row">

					<div class="col-xs-12 col-md-1">
						<label for="descripcion" class="control-label">Descripción</label>
					</div>
					<div class="col-xs-12 col-md-9">
					 	<textarea class="form-control noresize" id="Pregunta" name="Pregunta" rows="5" cols="20" id="descripcion" placeholder="Ingresa la descripción de tu pregunta" onchange="CambioPregunta()" >{Pregunta}</textarea>
					 	<label id="MensagePregunta" class="Warning">*Debes de ingresar la pregunta</label>
					</div>
				
					<div class="col-xs-12 col-md-2">
						<div class="row">
							<div class="col-xs-12">
								<label for="id-pregunta" class="control-label">ID Pregunta</label>
							</div>
							<div class="col-xs-12">
								<input type="text" class="form-control" id="id-pregunta" disabled name="id-pregunta" value="{ID_Pregunta}">
							</div>
						</div>	
					</div>

		</div>

		<div class="form-group row">
				<input type='hidden' id="id_categorias" name="id_categorias" value='{id_categorias}'>
				<div class="col-xs-12 col-md-1">
					<label for="categoria" class="control-label">Categoria</label>
				</div>
				<div class="col-xs-12 col-md-6">
					<select class="form-control" id="categoria">
						{inicio_catego}<option value="{id-categoria}">{nombre-categoria}</option>{fin_catego}
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
								{inicia_Categoria}
								<tr>
									<td>{ID_Categoria}</td>
									<td>{Nombre}</td>
									<td><input type="checkbox"></td>
								</tr>
								{fin_categoria}
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
					<input type='hidden' id="id_respuestas" name="id_respuestas" value='{id_respuestas}'>
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
									{inicia_respuesta}
									<tr>
										<td>{respuesta}</td>
										<td><input type="radio" name="respuestaCorrecta" {correcto}></td>
										<td><input type="checkbox"></td>
									</tr>
									{fin_respuesta}
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
				<p>{ini_resultado}{fin_resultado}</p>
				<button class="btn btn-primary" type="submit" >Agregar Pregunta</button>
			</div>
		</div>
	</form>
	</div>
</section>
<script type="text/javascript" src="js/ValidacionesAgregarPregunta.js"></script>
<?php include("Footer.php");?>
			
			