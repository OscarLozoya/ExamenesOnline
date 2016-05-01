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
          <li><a href="IndexMod.php">Inicio</a></li>
          <li class="dropdown">
            <a class="dropdown-toggle" data-toggle="dropdown" href="#">Preguntas <span class="caret"></span></a>
            <ul class="dropdown-menu">
              <li><a href="AgregarPregunta.php">Nueva</a></li>
              <li><a href="BuscarPregunta.php">Modificar/Eliminar</a></li>
            </ul>
          </li>
          <li class="dropdown">
            <a class="dropdown-toggle" data-toggle="dropdown" href="#">Examenes <span class="caret"></span></a>
            <ul class="dropdown-menu">
              <li><a href="CrearExamen.php">Nuevo</a></li>
              <li><a href="ModElimExamen.php">Modificar/Eliminar</a></li>
            </ul>
          </li>
        </ul>
        <ul class="nav navbar-nav navbar-right">
              <li><a href="index.php"><span class="glyphicon glyphicon-log-out"></span> Salir</a></li>
        </ul> 
      </div>
    </div>
  </nav>