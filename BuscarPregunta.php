<?php include("Header.php"); ?>
	<div class="form-group">
		<label class="label-control">Historial de Navegación</label>
	</div>
	<?php include("MenuAdmin.php"); ?>
	<section class="form-horizontal col-xs-12 col-sm-10 col-sm-offset-1">
		<div class="jumbotron">
			<div class="form-group col-xs-12 col-sm-9 col-lg-10"><!--SECCION DE BUSQUEDA PRINCIPAL-->
				<div class="form-group col-xs-12"><!--CAJA DE PREGUNTA-->
					<label for="" class="control-label col-sm-2">Contiene:</label>
					<div class="col-sm-10">
						<input type="text" class="form-control" placeholder="Pregunta o parte de la pregunta">
					</div>
				</div>
					<div class="form-group col-xs-12"><!--CAJA DE PREGUNTA-->
						<label for="" class="control-label col-sm-2">ID:</label>
						<div class="col-sm-2">
							<input type="text" class="form-control" placeholder="256">
						</div>
						<label for="" class="control-label col-sm-2">Categoria:</label>
						<div class="col-sm-6">
							<select class="form-control">
								<option>CAT POO</option>
								<option>CAT MAQUETADO</option>
								<option>CAT PHP</option>
							</select>
						</div>
					</div>
				</div><!--SECCION DE BUSQUEDA PRINCIPAL 10 col-->
				<div class="form-group col-xs-12 col-sm-3 col-lg-2"><!--BOTONES 2 col-->
				 	<div class="form-group col-xs-6 col-sm-12">
						<button class="btn btn-primary col-xs-6 col-xs-offset-3 col-sm-12"> Buscar</button>
				 	</div>
				 	<div class="form-group col-xs-6 col-sm-12">
					  <button class="btn btn-primary col-xs-6 col-xs-offset-3 col-sm-12"> Limpiar</button>	
					</div>
			</div><!---Fin Botones de busqueda->
			<!--Termina primera seccion campos de busqueda-->
			<div class="form-group"><!--DIV TABLA RESULTADO INICIA-->
				<div class="col-xs-12 col-sm-10 col-sm-offset-1">
					<div class="table-responsive">
						<table class="table table-bordered">
							<tr>
								<th>ID PREGUNTA</th>
								<th>DESCRIPCION</th>
								<th>CATEGORIA</th>
							</tr>
						</table>
					</div>
				</div>
			</div><!--DIV TABLA RESULTADO TERMINA-->
			<div class="form-group"><!--DIV BOTONES RESULTADOS INICIA-->
				<div class="col-xs-10 col-xs-offset-1">
					<button class="btn btn-primary">MODIFICAR SELECCION</button>
					<button class="btn btn-primary">ELIMINAR SELECCION</button>
				</div>
			</div>
		</div><!--finJumbotron-->
	</section>
<?php include("Footer.php"); ?>