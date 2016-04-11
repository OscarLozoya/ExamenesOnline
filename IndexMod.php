<?php include("Header.php"); ?>
<ol class="breadcrumb">
		  <li><a href="#">Home</a></li>
		  <li><a href="#">Configuración</a></li>
		  <li class="active">Slider</li>
</ol>
<?php include("MenuMod.php"); ?>
	<section class="container-fluid">
		<aside class="col-xs-12 col-sm-3 aside lines">
			<div class="form-group">
				<div class="col-xs-12">
					<figure>
	                    <img class="img-responsive" src="images/logo_user.gif">
	                </figure>
				</div>
				<div class="col-xs-12">
					<label class="control-label">Nombre completo</label>
				</div>
				<div class="col-xs-12">
					<a href="Perfil.php">Ver Perfil</a>
				</div>
			</div>
		</aside>

		<article class="col-xs-12 col-sm-9 content lines">
            <div class="text-center">
				<h1>Notificaciones</h1>
			</div>
			<div class="container">
				<p>ID del Examen</p>
				<p>Pregunta</p>
				<button class="btn btn-primary">Calificar</button>
			</div>
			<hr noshade="noshade" />
    </article>
	</section>
<?php include("Footer.php"); ?>