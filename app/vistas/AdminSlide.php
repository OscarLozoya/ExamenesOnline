<?php include("Header.php"); ?>

<?php include("MenuAdmin.php"); ?>
	<section class="container-fluid lines form-horizontal col-xs-12 col-lg-10 col-lg-offset-1">
			<div class="jumbotron">
				<div> 
					<table class="table table-hover">
					<tr>
						<th>Nombre Imagen</th>
						<th>Nombre Alternativo</th>
						<th>Seleccionar</th>
					</tr>
					<tr>
						<td>imagen.png</td>
						<td>Diapositiva 1</td>
						<td><input type="checkbox"></td>
					</tr>
					<tr>
						<td>hola.png</td>
						<td>Diapositiva 2</td>
						<td><input type="checkbox"></td>
					</tr>
					<tr>
						<td></td>
						<td></td>
						<td><input type="checkbox"></td>
					</tr>
				</table>
				</div>
				<div class="form-group">
					<button class="btn btn-danger">Borrar</button>
					<button class="btn btn-warning">Modificar</button>
				</div>
				<div class="well form-horizontal">
					<div class="form-group">
						<div class="col-md-8">
							<input type="text" class="form-control" placeholder="NuevoAviso.png">
						</div>
						<div class="col-md-4">
							<button class="btn">Seleccionar Imagen</button>
						</div>
					</div>
					<div class="form-group">
						<label class="col-md-4 control-label">Nombre Alterno</label>
						<div class="col-md-8">
							<input type="text" class="form-control" placeholder="Diapositiva Marzo">
						</div>
					</div>
					<div class="form-group">
						<label class="col-md-3 col-xs-6 control-label">Posicion</label>
						<div class="col-md-2 col-xs-6">
							<select>
							<option>1</option>
							<option>2</option>
							<option>3</option>
						</select>
						</div>
						<div class="col-md-offset-1 col-md-1 col-xs-12">
							<button class="btn">Subir Imagen</button>
						</div>
					</div>
				</div>
			</div>
	</section>
<?php include("Footer.php"); ?>