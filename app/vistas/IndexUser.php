<?php include("Header.php");?>
<?php include("Slider.php");?>
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
        <p>Examenes Pendietes</p>
        <form action="">
            <select class="form-control">
                <option value="">Opcion1</option>
                <option value="">Opcion2</option>
                <option value="">Opcion3</option>
                <option value="">Opcion4</option>
            </select>
            <label class="control-label col-xs-12">Categoria</label>
            <label class="control-label col-xs-12">Duración del Examen</label>
        <div class="form-group">
            <button class="btn btn-primary">Ir al Examen</button>
            <button class="btn btn-primary">Salir</button>
        </div>
        </form>
    </aside>


    <section class="col-xs-12 col-sm-6 content lines">
            <div class="text-center">
                <h1>Categorias</h1>
            </div>
            <a href=""><h3>Programación</h3></a>
            <hr noshade="noshade" />
            <a href=""><h3>Web</h3></a>
            <hr noshade="noshade" />
            <a href=""><h3>Algortimos</h3></a>
            <hr noshade="noshade" />
    </section>

    <aside class="col-xs-12 col-sm-3 lines aside">
        <br>
        <form action="">
            <div class="form-group">
                <input class="form-control" type="date">
            </div>
            <div class="form-group">
                <a href="index.php?controlador=usuario&accion=eventosProximos">Ver Eventos Proximos</a>
            </div>
            <div class="form-group">
                <a href="index.php?controlador=usuario&accion=detalleExamen">Detalles Examenes</a>
            </div>
        </form>
    </aside>
</section>
<div class="clear-fix visible-sm-block"></div>
<?php include("Footer.php");?>