<nav class="navbar navbar-inverse">
    <div class="container-fluid">
      <div class="navbar-header">
        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>                        
        </button>
      </div>
      <div class="collapse navbar-collapse" id="myNavbar">
        <ul class="nav navbar-nav">
          <li><a href="index.php?controlador=usuario&accion">Inicio</a></li>
          <li class="dropdown">
            <a class="dropdown-toggle" data-toggle="dropdown" href="#">Usuario <span class="caret"></span></a>
            <ul class="dropdown-menu">
              <li><a href="index.php?controlador=usuario&accion=Alta">Nuevo</a></li>
              <li><a href="index.php?controlador=usuario&accion=Modificar">Modificar</a></li>
              <li><a href="index.php?controlador=usuario&accion=Baja">Dar de baja</a></li>
            </ul>
          </li>
          <li><a href="index.php?controlador=categoria&accion=crear">Categorias </a></li> 
          <li class="dropdown">
            <a class="dropdown-toggle" data-toggle="dropdown" href="#">Preguntas <span class="caret"></span></a>
            <ul class="dropdown-menu">
              <li><a href="index.php?controlador=pregunta&accion=agregar">Nueva</a></li>
              <li><a href="index.php?controlador=pregunta&accion=modificar">Modificar</a></li>
              <li><a href="index.php?controlador=pregunta&accion=eliminar">Eliminar</a></li>
            </ul>
          </li>
          <li class="dropdown">
            <a class="dropdown-toggle" data-toggle="dropdown" href="#">Examenes <span class="caret"></span></a>
            <ul class="dropdown-menu">
              <li><a href="index.php?controlador=examen&accion=crear">Nuevo</a></li>
              <li><a href="index.php?controlador=examen&accion=modificar">Modificar</a></li>
              <li><a href="index.php?controlador=examen&accion=eliminar">Eliminar</a></li>
            </ul>
          </li>
          <li><a href="index.php?controlador=slider&accion=crear">Slide </a></li> 
        </ul>
        <ul class="nav navbar-nav navbar-right">
              <li><a href="index.php?controlador=usuario&accion=salir"><span class="glyphicon glyphicon-log-out"></span> Salir</a></li>
        </ul> 
      </div>
    </div>
  </nav>