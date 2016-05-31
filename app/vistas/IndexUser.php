<?php include("Header.php");?>
<?php include("Slider.php");?>
<secction class="container-fluid row">
    <aside class="col-xs-12 col-sm-3 lines aside">
        <div class="form-group row">
            <br>
            <div class="col-xs-12 col-sm-6">
                <figure>
                    {iniciaFoto}<img class="img-responsive" src="{Foto}">{terminaFoto}
                </figure>
            </div>
            <div class="col-xs-12 col-sm-6">
                <label class="control-label">{Nombre_usuario}</label>
                <a href="index.php?controlador=usuario&accion=Perfil">Ver Perfil</a>
            </div>
        </div>
        <div class="form-group">
                <a href="index.php?controlador=usuario&accion=detalleExamen">Detalles Examenes</a>
        </div>
    </aside>


    <section class="col-xs-12 col-sm-9 content lines">
            <div class="text-center">
                <h1>Examenes Pendientes</h1>
            </div>
            <div class="jumbotron">
                {ini_Examen}
                <div class="form-horizontal well">
                    <div class="form-group row">
                            <input type="hidden" id="id-examen" value="{id-examen}">
                            <div class="col-xs-12 col-md-2">
                                <label class="col-md-3">Categoria:</label>
                            </div>
                            <div class="col-xs-12 col-md-9">
                                <label class="col-md-3">{Categoria}</label>
                            </div>
                            <div class="col-xs-12 col-md-2">
                                <label class="col-md-3">Examen:</label>
                            </div>
                            <div class="col-xs-12 col-md-9">
                                <label class="col-md-3">{Examen}</label>
                            </div>
                            <div class="col-xs-12 col-md-2">
                                <label class="col-md-3">Preguntas:</label>
                            </div>
                            <div class="col-xs-12 col-md-9">
                                <label class="col-md-3">{Preguntas}</label>
                            </div>
                            <div class="col-xs-12 col-md-2">
                                <label class="col-md-3">Tiempo:</label>
                            </div>
                            <div class="col-xs-12 col-md-9">
                                <label class="col-md-3">{Tiempo}</label>
                            </div>
                            <div class="col-xs-12 col-md-6">
                                <button class="btn btn-primary" onclick="irExamen()">Ir al Exámen</button>
                            </div>
                    </div>
                </div>
                {fin_Examen}
            </div>
            <hr noshade="noshade" />
    </section>
</section>
<div class="clear-fix visible-sm-block"></div>
<script type="text/javascript" src="js/ValidacionesIndexUser.js"></script>
<?php include("Footer.php");?>