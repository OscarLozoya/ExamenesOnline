<?php include("Header.php"); ?>

<?php include("MenuAdmin.php"); ?>
<secction class="container-fluid row">
    <aside class="col-xs-12 col-sm-3 lines aside">
        <div class="form-group row">
            <br>
            <div class="col-xs-12 col-sm-6">
                <figure>
                    <img class="img-responsive" src="images/logo_user.gif">
                </figure>
            </div>
            <div class="col-xs-12 col-sm-6">
                <label class="control-label">{Nombre_usuario}</label>
                <a href="index.php?controlador=usuario&accion=Perfil">Ver Perfil</a>
            </div>
        </div>
    </aside>


    <section class="col-xs-12 col-sm-9 content lines">
            <div class="text-center">
                <h1>Pendientes</h1>
            </div>
            {ini_pregunta}
            <form method="POST" action="index.php?controlador=examen&accion=calificar">
            	<input type="hidden" value="{usuario}">
            	<input type="hidden" value="{ID_Examen}">
            	<input type="hidden" value="{ID_Pregunta}">
            	<input type="hidden" value="{pregunta}">
            	<input type="hidden" value="{respuesta}">
            	<div class="form-group row">
            		<div class="col-xs-12">
            			<label class="control-label" >{pregunta}</label>
            		</div>
            		<div class="col-xs-12">
            			<label class="control-label">{respuesta}</label>
            		</div>
            		<div class="col-xs-12">
            			<input type="radio"  name="resultado" value="1">Correcto
            			<input type="radio"  name="resultado" value="0">Incorrecto
            		</div>
            		<div class="col-xs-12">
            			<button class="btn btn-primary" type="submit">Calificar</button>
            		</div>
            	</div>
            </form>
            {fin_pregunta}
    </section>
</section>
<div class="clear-fix visible-sm-block"></div>
<?php include("Footer.php"); ?>
