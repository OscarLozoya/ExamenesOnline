<?php include("Header.php"); ?>
<div class="form-group">
	<ol class="breadcrumb">
	  <li><a href="#">Home</a></li>
	  <li><a href="#">Configuración</a></li>
	  <li class="active">Slider</li>
	</ol>
</div>
<?php include("MenuAdmin.php"); ?>
	<section class="container-fluid">
		<article class="content lines">
			<div class="col-md-offset-1 col-md-10 col-xs-12 col-lg-offset-1 col-lg-10 col-sm-offset-1 col-sm-10">
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
				<div class="form-group col-md-3">
					<button class="btn btn-danger">Borrar</button>
					<button class="btn btn-warning">Modificar</button>
				</div>
				<div class="well form-horizontal col-md-9">
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
		</article>
	</section>
<?php include("Footer.php"); ?>