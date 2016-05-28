<!DOCTYPE html>
<html>
<head>
	<title> Examenes en Linea</title>
	<meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="css/vendor/bootstrap.min.css">
  <link rel="stylesheet" href="css/generales.css">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
<!--CSS para bajar el FOOTER-->
<link rel="stylesheet" type="text/css" href="css/FooterAbajo.css">
	<script type="text/javascript" src="js/vendor/jquery.min.js"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
  <script src="js/vendor/bootstrap.min.js"></script>
</head>
<body onload="IniciaTiempo()">
	
		<aside class="lines TiempoRestante">
			<fieldset>
				<div class="col-xs-12  col-md-6 col-md-offset-3">
					<legend>Tiempo Restante</legend>
					<h1 id="tiempoRestante" >{Tiempo}</h1>
				</div>
			</fieldset>
		</aside>
		<div class="col-xs-12 col-sm-10 col-sm-offset-1">
		<section class="content lines preguntas">
			<article>
				<header>
					<h1>{Examen}	/	{Total_preguntas} Preguntas</h1>
				</header>
				<form method="POST" id="formulario" class=" form-group">
					
					<div>
					{ini_pregunta}
						<p>{Pregunta}</p>
					<div>
						<p>{Respuesta}</p>
					</div>
					<hr>
					{fin_pregunta}
					</div>
					<footer>
						<button class="btn btn-primary" type="submit">Enviar</button>
					</footer>
				</form>
			</article>	
		</section>
		</div>
<script type="text/javascript" src="js/ValidacionesVistaExamen.js"></script>
<?php include("Footer.php");?>
