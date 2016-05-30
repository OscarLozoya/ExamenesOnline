<?php include("Header.php"); ?>
	<?php include("MenuAdmin.php"); ?>
	{Notificacion}
	<section class="container-fluid lines form-horizontal col-xs-12 col-lg-10 col-lg-offset-1">
		<div class="jumbotron">
			<form action="index.php?controlador=categoria&accion=buscar" method="post">
				<div class="form-group"><!--DIV BARRA DE BUSQUEDA INICIA-->
					<div class="form-append col-xs-12 col-sm-10 col-sm-offset-1 col-md-8 col-md-offset-2">
						<div class="col-xs-9 col-sm-10">
							<input id="inpBusqueda" name="parametro" class="form-control" type="text" placeholder="Maquetado Web">
						</div>
						<button class="btn btn-primary col-xs-3 col-sm-2" type="submit" onclick="return ValidaBusqueda()">Buscar</button>
					</div>
				</div><!--DIV BARRA DE BUSQUEDA TERMINA-->
      </form>
			<div class="form-group "><!--DIV TABLA RESULTADO INICIA-->
				<div class="col-xs-12 col-sm-10 col-sm-offset-1">
					<div class="table-responsive">
						<table class="table table-hover">
							<tr>
								<th>ID</th>
								<th>NOMBRE</th>
							</tr>
							{inicia_FilaTabla}
								<tr>
									<td>{ID_Categoria}</td>
									<td>{Nombre}</td>
									<td><input type="radio" name="categorias"></td>
								</tr>
								{fin_FilaTabla}
						</table>
					</div>
				</div>
			</div><!--DIV TABLA RESULTADO TERMINA-->
			<div class="form-group"><!--DIV BOTONES RESULTADOS INICIA-->
				<div class="col-xs-12 col-sm-10 col-sm-offset-1">
					<button class="btn btn-primary">Eliminar</button>
					<button class="btn btn-primary">Modificar</button>
				</div>
			</div><!--DIV BOTONES RESULTADOS termina-->
			<div class="form-group"><!--DIV DATOS CATEGORIA INICIA-->
				<div class="col-xs-12 col-sm-10 col-sm-offset-1">
					<section class="well">
						<fieldset>
						<legend>Datos Categoría</legend>
						<form action="index.php?controlador=categoria&accion=agregar" method="post">
							<div class="form-group col-xs-12">
								<div class="form-group col-xs-12 col-sm-6">
									<label for="" class="control-label col-xs-2 col-sm-2">Nombre</label>
									<div class="col-xs-10 col-sm-10">
										<input id="inpAgregar" name="nombreCategoria" class="form-control" type="text" value="{valorCategoria}" placeholder="Diseño Responsivo">
									</div>
								</div>
								<div class="form-group col-xs-10 col-sm-5">
									<label for="" class="control-label col-xs-2 col-sm-1">ID</label>
									<div class="col-xs-8 col-sm-8">
										<input class="form-control" type="text" disabled value="{valorID}">
									</div>
								</div>
								<button class="btn btn-primary" type="submit" onclick="return ValidaAgregar()">Agregar</button>
							</div>
						</form>
					</fieldset>
					</section>
					
				</div>
			</div>
		</div><!--DIV JUMBOTRON TERMINA-->
		
	</section>
<?php include("Footer.php"); ?>
<script type="text/javascript" src="js/ValidacionesCategoria.js"></script>