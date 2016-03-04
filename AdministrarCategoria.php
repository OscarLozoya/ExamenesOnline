<?php include("Header.php"); ?>
	<div class="form-group">
		<label class="label-control">Historial de Navegación</label>
	</div>
	<?php include("MenuAdmin.php"); ?>
	<section class="form-horizontal col-xs-12 col-lg-10 col-lg-offset-1">
		<div class="jumbotron">
			<div class="form-group"><!--DIV BARRA DE BUSQUEDA INICIA-->
				<div class="form-append col-xs-12 col-sm-10 col-sm-offset-1 col-md-8 col-md-offset-2">
					<div class="col-xs-9 col-sm-10">
						<input class="form-control" type="text">
					</div>
					<button class="btn btn-primary col-xs-3 col-sm-2" type="button">Buscar</button>
				</div>
			</div><!--DIV BARRA DE BUSQUEDA TERMINA-->
			<div class="form-group "><!--DIV TABLA RESULTADO INICIA-->
				<div class="col-xs-12 col-sm-10 col-sm-offset-1">
					<div class="table-responsive">
						<table class="table table-bordered">
							<tr>
								<th>ID</th>
								<th>NOMBRE</th>
							</tr>
						</table>
					</div>
				</div>
			</div><!--DIV TABLA RESULTADO TERMINA-->
			<div class="form-group"><!--DIV BOTONES RESULTADOS INICIA-->
				<div class="col-xs-12 col-sm-10 col-sm-offset-1">
					<button class="btn btn-primary">BORRAR</button>
					<button class="btn btn-primary">MODIFICAR</button>
				</div>
			</div><!--DIV BOTONES RESULTADOS termina-->
			<div class="form-group"><!--DIV DATOS CATEGORIA INICIA-->
				<div class="col-xs-12 col-sm-10 col-sm-offset-1">
					<section class="well">
						<fieldset>
						<legend>Datos Categoria</legend>
						<div class="form-group col-xs-12">
							<div class="form-group col-xs-12 col-sm-6">
								<label for="" class="control-label col-xs-2 col-sm-2">Nombre</label>
								<div class="col-xs-10 col-sm-10">
									<input class="form-control" type="text">
								</div>
							</div>
							<div class="form-group col-xs-10 col-sm-5">
								<label for="" class="control-label col-xs-2 col-sm-1">ID</label>
								<div class="col-xs-8 col-sm-8">
									<input class="form-control" type="text">
								</div>
							</div>
							<button class="btn btn-primary">Agregar</button>
						</div>
					</fieldset>
					</section>
					
				</div>
			</div>
		</div><!--DIV JUMBOTRON TERMINA-->
		
	</section>
<?php include("Footer.php"); ?>
6242121572