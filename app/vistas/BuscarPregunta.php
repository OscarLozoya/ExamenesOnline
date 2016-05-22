<?php include("Header.php"); ?>
	<div class="form-group">
		<label class="label-control">Historial de Navegación</label>
	</div>
	<?php include("MenuAdmin.php"); ?>
	<section class="form-horizontal col-xs-12 col-sm-10 col-sm-offset-1">
		<div class="jumbotron">
			<form action="index.php?controlador=pregunta&accion=buscar" class="form-horizontal" method="POST" onsubmit="return Buscar()">
				<div class="form-group col-xs-12 col-sm-9 col-lg-10"><!--SECCION DE BUSQUEDA PRINCIPAL-->
					<div class="form-group col-xs-12"><!--CAJA DE PREGUNTA-->
						<label for="" class="control-label col-sm-2">Contiene:</label>
						<div class="col-sm-10">
							<input type="text" class="form-control" placeholder="Pregunta o parte de la pregunta" id="Pregunta" name="Pregunta">
						</div>
					</div>
						<div class="form-group col-xs-12"><!--CAJA DE PREGUNTA-->
							<label for="" class="control-label col-sm-2">ID:</label>
							<div class="col-sm-2">
								<input type="text" class="form-control" placeholder="256" id="ID" name="ID">
							</div>
							<label for="" class="control-label col-sm-2">Categoria:</label>
							<div class="col-sm-6">
								<select class="form-control" id="Categoria" name="Categoria">
									{inicio_catego}<option value="{id-categoria}">{nombre-categoria}</option>{fin_catego}
								</select>
							</div>
						</div>
					</div><!--SECCION DE BUSQUEDA PRINCIPAL 10 col-->
					<label id="MensajeBuscar" class="Warning">*Debes de escribir el id, o la descripcion o seleccionar una categoria</label>
					<div class="form-group col-xs-12 col-sm-3 col-lg-2"><!--BOTONES 2 col-->
					 	<div class="form-group col-xs-6 col-sm-12">
							<button class="btn btn-primary col-xs-6 col-xs-offset-3 col-sm-12" type="submit"> Buscar</button>
					 	</div>
					 	<div class="form-group col-xs-6 col-sm-12">
						  <button class="btn btn-primary col-xs-6 col-xs-offset-3 col-sm-12" type="button" onclick="Limpiar()"> Limpiar</button>	
						</div>
				</div><!---Fin Botones de busqueda->
				<!--Termina primera seccion campos de busqueda-->
			</form>
			<form action="index.php?controlador=pregunta&accion=buscar&response=eliminar" class="form-horizontal" method="POST" onsubmit="return EliminarPregunta()">
				<div class="form-group"><!--DIV TABLA RESULTADO INICIA-->
					<div class="col-xs-12 col-sm-10 col-sm-offset-1">
						<div class="table-responsive">
							<input type="hidden" name="id-eliminar" id="id-eliminar" value="{id}">
							<table class="table table-hover" id="Pregunta">
								<tr>
									<th>ID PREGUNTA</th>
									<th>DESCRIPCION</th>
									<th>CATEGORIA</th>
									<th>SELECCION</th>
								</tr>
								<tr>
									<td>{ID}</td>
									<td>{Descripcion}</td>
									<td>{Categoria}</td>
									<td><input name="seleccion" type="checkbox"></td>
								</tr>
							</table>
						</div>
					</div>
				</div><!--DIV TABLA RESULTADO TERMINA-->
				<label id="MensajeEliminar" class="Warning">*Debes de seleccionar una pregunta</label>
				<div class="form-group"><!--DIV BOTONES RESULTADOS INICIA-->
					<div class="col-xs-10 col-xs-offset-1">
						<button class="btn btn-primary" type="button" onclick="ModificarPregunta()">MODIFICAR SELECCION</button>
						<button class="btn btn-primary" type="submit">ELIMINAR SELECCION</button>
					</div>
			</form>
			</div>
		</div><!--finJumbotron-->
	</section>
<script type="text/javascript" src="js/ValidacionesBuscarPregunta.js"></script>
<?php include("Footer.php"); ?>