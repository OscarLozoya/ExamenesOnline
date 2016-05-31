<?php 

/**
* 
*/
class usuarioMdl
{
	private $driver;
	function __construct()
	{
		include_once('datos_conexion.inc.php');
		$this->driver=new mysqli($servidor,$usuario,$pass,$bd);
	}
	
	function alta($usuario, $correo, $token, $tipo, $estado,$Ruta)
	{
		if($this->driver->connect_errno)
			return false;
		if($stmt = $this->driver->prepare("INSERT INTO Usuario VALUES(?,?,?,?,?)")) 
		{
			$Usuario = $this->driver->real_escape_string($Usuario);
	  	$Correo = $this->driver->real_escape_string($Correo);
	  	$Contrasena = $this->driver->real_escape_string($Contrasena);//En este momento la Contraseña es un token generado y servira para crear el enlace de reediccionamiento
	  	$Tipo = $this->driver->real_escape_string($Tipo);
	  	$Estado = $this->driver->real_escape_string($Estado);
	  	$Ruta = $this->driver->real_escape_string($Ruta);
	  	$stmt->bind_param("sssiis",$Usuario,$Correo,$Contrasena,$Tipo,$Estado,$Ruta);
			if($stmt->execute()){
				$stmt->close();
				date_default_timezone_set ('America/Mexico_City');//se establece la zona horaria para la funcion mail
	  		//Se crea el enlace que guiara al usuario a  completar su registro
		  	$enlace = "http://examenesonline.no-ip.org/index.php?controlador=usuario&accion=completarRegistro&response=".$Contrasena;
		  	//Las siguientes variables son parametros para la funcion mail() de php que permite enviar emails
		    $From = 'From: "Team Dead Developers" deaddevelopers@gmail.com';//Esta linea modifica el remitente se debe de poner por que sino el remitente sera el servidor interprete de php
				$asunto="Completar registro en ExamenesOnline";
				$mensaje="Hola ".$Usuario.": \n\nYa casi eres miembro de ExamenesOnline por favor completa tu registro en el siguiente enlace: \n\n"
				         .$enlace."\n\n Si tu navegador no te redirecciona por favor copia elenlace en la barra de busqueda."
				         ." \n\n Si no fuiste tu quien registro este correo contactanos a la direccion"
				         ." deaddevelopers@gmail.com con el asunto: 'Eiminar registro' y solucionaremos este error";
	      if(mail($Correo,$asunto,$mensaje,$From))
	        return true;
	      else
	        return false;//Si el mensaje no se puede enviar se retorna un false para que elcontrolador muestre un mensaje
	    }
      else //Si la consulta no fue satisfactoria regresa falso para que el controlador maneje el error
      	return false;
		}
	}
	/**
	*Esta Funcion se encarga de pre-registrar al usuario guardando sus datos y reportanto su estatus como
	*no activo [Estatus = 0]
	*/
	function registrar($Usuario,$Correo,$Contrasena,$Tipo,$Estado,$Ruta)
	{
		if($this->driver->connect_errno)//Se conecta con la BD si no hay error se prosigue
			return false;
	  if($stmt = $this->driver->prepare("INSERT INTO Usuario VALUES(?,?,?,?,?,?)")){//Se implementa el "cascaron de la consulta"
	  	//Se limpian los datos que se reciben para evitar inyecciones de sql
	  	$Usuario = $this->driver->real_escape_string($Usuario);
	  	$Correo = $this->driver->real_escape_string($Correo);
	  	$Contrasena = $this->driver->real_escape_string($Contrasena);//En este momento la Contraseña es un token generado y servira para crear el enlace de reediccionamiento
	  	$Tipo = $this->driver->real_escape_string($Tipo);
	  	$Estado = $this->driver->real_escape_string($Estado);
	  	$Ruta = $this->driver->real_escape_string($Ruta);
	  	//Se cambian los '?' por los datos reales en la consulta
	  	$stmt->bind_param("sssiis",$Usuario,$Correo,$Contrasena,$Tipo,$Estado,$Ruta);
	  	if($stmt->execute())
	  	{//Si la consulta se puede ejecutar envia un email al usuario para que complete su registro y cierra el query
	  		$stmt->close();
	  		date_default_timezone_set ('America/Mexico_City');//se establece la zona horaria para la funcion mail
	  		//Se crea el enlace que guiara al usuario a  completar su registro
		  	$enlace = "http://examenesonline.no-ip.org/index.php?controlador=usuario&accion=completarRegistro&response=".$Contrasena;
		  	//Las siguientes variables son parametros para la funcion mail() de php que permite enviar emails
		    $From = 'From: "Team Dead Developers" deaddevelopers@gmail.com';//Esta linea modifica el remitente se debe de poner por que sino el remitente sera el servidor interprete de php
				$asunto="Completar registro en ExamenesOnline";
				$mensaje="Hola ".$Usuario.": \n\nYa casi eres miembro de ExamenesOnline por favor completa tu registro en el siguiente enlace: \n\n"
				         .$enlace."\n\n Si tu navegador no te redirecciona por favor copia elenlace en la barra de busqueda."
				         ." \n\n Si no fuiste tu quien registro este correo contactanos a la direccion"
				         ." deaddevelopers@gmail.com con el asunto: 'Eiminar registro' y solucionaremos este error";
	      if(mail($Correo,$asunto,$mensaje,$From))
	        return true;
	      else
	        return false;//Si el mensaje no se puede enviar se retorna un false para que elcontrolador muestre un mensaje
	    }
      else //Si la consulta no fue satisfactoria regresa falso para que el controlador maneje el error
      	return false;
	  }

	}
	function baja()
	{

	}
	function mostrarPerfil()
	{
		
	}
	function cambioContrasena()
	{
		
	}

	/**
	*
	*/
	function comprobarRegistro($Token)
	{
		$Activo=true;//Variable para verificar que la cuenta este activa o no
		if($this->driver->connect_errno)//Se conecta con la BD si no hay error se prosigue
			return false;
	  if($stmt = $this->driver->prepare("SELECT * FROM Usuario WHERE Contrasena=?")){//Se busca que el token este asignado a un usuario
	  	$Token = $this->driver->real_escape_string($Token);
	  	$stmt->bind_param("s",$Token);
	  	if($stmt->execute()){
	  		$stmt->bind_result($Usuario,$Correo,$Contrasena,$Tipo,$Estado,$Ruta);
	  		while ($stmt->fetch()) {
	  			if($Estado==0){//Si no esta activa el estado sera 0 y tenemos que regrsar que puede y debe completar el Regitro
	  				$_SESSION['usuario'] = $Usuario;
						$_SESSION['tipo'] = $Tipo;
						$_SESSION['estado'] = $Estado;
						$_SESSION['img_ruta'] = $Ruta;//Al ser la primera vez ruta tentra none
						$_SESSION['nombre'] = $Ruta;//Como aun no termina el registro solo creamos el indice de su nombre y como registra none no es muy relevante 
						$Activo = false;//En este caso false es lo que se busca para tener acceso a la vista Completar Registro
	  			}
	  			else
	  				$Activo = true;//Si esta Activo el link sera no valido
	  		}
	  	}
	  	return $Activo;
	  }
	}

	  function comprobarDesactivado($Token)
	  {
			$Activo=true;//Variable para verificar que la cuenta este activa o no
			if($this->driver->connect_errno)//Se conecta con la BD si no hay error se prosigue
				return false;
		  if($stmt = $this->driver->prepare("SELECT Estado,Usuario FROM Usuario WHERE Contrasena=?"))
		  {//Se busca que el token este asignado a un usuario
		  	$Token = $this->driver->real_escape_string($Token);
		  	$stmt->bind_param("s",$Token);
		  	if($stmt->execute()){
		  		$stmt->bind_result($Estado,$Usuario);
		  		while ($stmt->fetch()) {
		  			if($Estado==0){//Si no esta activa el estado sera 0 y tenemos que regrsar que puede y debe completar el Regitro
							$_SESSION['usuario']=$Usuario;
							$Activo = true;//En este caso false es lo que se busca para tener acceso a la vista Completar Registro
		  			}
		  			else
		  				$Activo = false;//Si esta Activo el link sera no valido
		  		}
		  	}
		  	return $Activo;
		  }
	  }

	/*
	*
	*/
	function eliminaDatosPerfil($Usuario)
	{
		if($this->driver->connect_errno)//Se conecta con la BD si no hay error se prosigue
			return false;
     $Usuario = $this->driver->real_escape_string($Usuario);
		if($stmt = $this->driver->prepare("DELETE FROM Perfil WHERE Usuario = ?"))
		{
			$stmt->bind_param("s",$Usuario);
     if(!$stmt->execute())
				return $stmt->errno;
			$stmt->close();
		}
		if($stmt = $this->driver->prepare("DELETE FROM Telefono WHERE Usuario = ?"))
		{
			$stmt->bind_param("s",$Usuario);
     if(!$stmt->execute())
				return $stmt->errno;
			$stmt->close();
		}
		if($stmt = $this->driver->prepare("DELETE FROM  Red_Social WHERE Usuario = ?"))
		{
			$stmt->bind_param("s",$Usuario);
     if(!$stmt->execute())
				return $stmt->errno;
			$stmt->close();
		}
		if($stmt = $this->driver->prepare("DELETE FROM  Horario WHERE Usuario = ?"))
		{
			$stmt->bind_param("s",$Usuario);
     if(!$stmt->execute())
				return $stmt->errno;
			$stmt->close();
		}
	}
	/**
	*
	*/
	function datosPersonales($Usuario,$Nombre,$ApellidoP,$ApellidoM,$Universidad,$Carrera,$Promedio,$Estado,$Porcentaje,$TiempoRestante,$Lapso)
	{
		if($this->driver->connect_errno)//Se conecta con la BD si no hay error se prosigue
			return false;
		if($stmt = $this->driver->prepare("INSERT INTO Perfil VALUES (?,?,?,?,?,?,?,?,?,?)"))
		{
			$Usuario = $this->driver->real_escape_string($Usuario);
			$Nombre = $this->driver->real_escape_string($Nombre);
			$ApellidoP = $this->driver->real_escape_string($ApellidoP);
			$ApellidoM = $this->driver->real_escape_string($ApellidoM);
			$Universidad = $this->driver->real_escape_string($Universidad);
			$Carrera = $this->driver->real_escape_string($Carrera);
			$Promedio = $this->driver->real_escape_string($Promedio);
			$Estado = $this->driver->real_escape_string($Estado);
			$Porcentaje = (int) $this->driver->real_escape_string($Porcentaje);
			if($Lapso =='Semestres')
		    $TiempoRestante = round($TiempoRestante/2);
			$TiempoRestante = $this->driver->real_escape_string($TiempoRestante);
			$stmt->bind_param('ssssssdsii',$Usuario,$Nombre,$ApellidoP,$ApellidoM,$Universidad,$Carrera,$Promedio,$Estado,$Porcentaje,$TiempoRestante);
			if($stmt->execute()){
				$stmt->close();
				return true;
			}
			else
				return $stmt->errno;
		}
	}

	
	/**
	*
	*/
	function guardaHorario($Usuario,$Dia,$desde,$hasta){
		if($this->driver->connect_errno)//Se conecta con la BD si no hay error se prosigue
			return false;
		if($desde == $hasta)//Para las variables de control si no se necesita guardar algo en la Bd regresa true purs no ha ocurrido error en la BD
			return true;
		if($stmt = $this->driver->prepare("INSERT INTO Horario VALUES(?,?,?,?)")){
			$Usuario =  $this->driver->real_escape_string($Usuario);
			$Dia = $this->driver->real_escape_string($Dia);
			$desde = $this->driver->real_escape_string($desde);
			$hasta = $this->driver->real_escape_string($hasta);
			$stmt->bind_param("ssss",$Usuario,$Dia,$desde,$hasta);
			if(!$stmt->execute())
				return $stmt->errno;
			$stmt->close();
			return true;
		}
	}
	
	/**
	*
	*/
	function guardaTelefonos($Usuario,$Telefonos)
	{
		if($this->driver->connect_errno)//Se conecta con la BD si no hay error se prosigue
			return false;
		if(isset($Telefonos)){
			$Usuario = $this->driver->real_escape_string($Usuario);
			for ($i=0; $i <count($Telefonos) ; $i++) //La variable Telefonos es un arreglo que contiene los numeros que el usuario puso
			{ 
				if ($stmt = $this->driver->prepare("INSERT INTO Telefono VALUES(?,?)")) //Se prepara la consulta
				{
					$Tel = $this->driver->real_escape_string($Telefonos[$i]);
					$stmt->bind_param("ss",$Usuario,$Tel);
					if(!$stmt->execute())//y se ejecuta
						return $stmt->errno;
					 $stmt->close();
				}
			}
			return true;
		}
	}

	/**
	*
	*/
	function guardaRedes($Usuario,$RedesSociales)
	{
		if($this->driver->connect_errno)//Se conecta con la BD si no hay error se prosigue
			return false;
		if(isset($RedesSociales)){
			$Usuario = $this->driver->real_escape_string($Usuario);
			for ($i=0; $i <count($RedesSociales) ; $i++) //La variable RedesSociales es un arreglo que contiene los numeros que el usuario puso
			{ 
				if ($stmt = $this->driver->prepare("INSERT INTO Red_Social VALUES(?,?)")) //Se prepara la consulta
				{
					$Red = $this->driver->real_escape_string($RedesSociales[$i]);
					$stmt->bind_param("ss",$Usuario,$Red);
					if(!$stmt->execute())//y se ejecuta
						return $stmt->errno;
					 $stmt->close();
				}
			}
			return true;
		}
	}

	/*
	*
	*/
	function recuperaHorario($Usuario){
		$Resultado = null;
		if($this->driver->connect_errno)
			return false;
		if ($stmt = $this->driver->prepare("SELECT Dia, Desde, Hasta FROM Horario WHERE Usuario = ?")) 
		{
			$Usuario = $this->driver->real_escape_string($Usuario);
			$stmt->bind_param("s",$Usuario);
			if (! $stmt->execute()) 
				return $stmt->error;
			$stmt->bind_result($Dia,$Desde,$Hasta);//Se recuperan las columnas de la consulta
			while ($stmt->fetch()) {
				$Resultado[$Dia] = array('Dia' => $Dia,
													 'Desde' => $Desde,
													 'Hasta' => $Hasta );
			}
			$stmt->close();
			return $Resultado;
		}
		else
			return $stmt->error;

	}

	function recuperaRedes($Usuario)
	{
		$Resultado = null;
		if($this->driver->connect_errno)
			return false;
		if($stmt = $this->driver->prepare("SELECT URL FROM Red_Social WHERE Usuario = ?"))
		{
			$Usuario = $this->driver->real_escape_string($Usuario);
			$stmt->bind_param("s",$Usuario);
			if (!$stmt->execute())
				return $stmt->error;
			$stmt->bind_result($Url);
			$Icon = "glyphicon-plus";
			$IdEsp = "EspRedSocial";
      $ClassBtn ='';
      $FunctionBtn = 'NuevaRedSocial()';
      $toolTip = 'Agregar otra Red';
			while ($stmt->fetch()) {
				$Resultado[] = array('Url' => $Url,
														  'Icon' => $Icon,
														  'IdEsp' => $IdEsp,
														  'ClassBtn' => $ClassBtn,
															'FunctionBtn' => $FunctionBtn,
															'toolTip' => $toolTip
														);
				$Icon = "glyphicon-minus";
				$IdEsp = "EspRedSocialCopy";
	      $ClassBtn ="btn-danger";
	      $FunctionBtn = "EliminarSubNodoURL(this)";
	      $toolTip = "Eliminar Red Social";
			}
		}
		return $Resultado;
	}
	/**
	*
	*/

	function recuperaTelefonos($Usuario){
		$Resultado = null;
		if($this->driver->connect_errno)
			return null;
		if($stmt = $this->driver->prepare("SELECT Telefono FROM Telefono WHERE Usuario = ?"))
		{
			$Usuario = $this->driver->real_escape_string($Usuario);
			$stmt->bind_param("s",$Usuario);
			if(!$stmt->execute())
				return $stmt->error;
			$stmt->bind_result($Tel);
			$Icon = "glyphicon-plus";
			$IdEsp = "EspTelefono";
			$ClassBtn = "";
			$BtnFunction = "NuevoTelefono()";
			$toolTip = "Agregar otro Número";
			while ($stmt->fetch()) 
			{
				$Resultado[] = array('Tel' => $Tel,
													 'Icon' => $Icon,
													 'IdEsp' => $IdEsp,
													 'ClassBtn' => $ClassBtn,
													 'BtnFunction' => $BtnFunction,
													 'toolTip' => $toolTip
					                );
				$Icon = "glyphicon-minus";
				$IdEsp = "EspTelefonoCopy";
				$ClassBtn = "btn-danger";
				$BtnFunction = "EliminarSubNodoTel(this)";
				$toolTip = "Eliminar Telefono";
			}
		}
		return $Resultado;
	}
	/*
	*
	*/
	function recuperaDatosPersonales($Usuario)
	{ 
		$Resultado = null;
		if($this->driver->connect_errno)
			return false;
		if ($stmt = $this->driver->prepare("SELECT Nombres, Apellido_P,Apellido_M,Universidad,Carrera,Promedio,Estado,Porcentaje,TiempoRestante FROM Perfil WHERE Usuario = ?")) 
		{
			$Usuario = $this->driver->real_escape_string($Usuario);
			$stmt->bind_param("s",$Usuario);
			if (! $stmt->execute()) 
				return $stmt->error;
			$stmt->bind_result($Nombre,$Apellido_P,$Apellido_M,$Universidad,$Carrera,$Promedio,$Estado,$Porcentaje,$TiempoRestante);//Se recuperan las columnas de la consulta
			while ($stmt->fetch()) {
				$Resultado = array( 'Nombre' => $Nombre, 
														'Apellido_P' => $Apellido_P,
														'Apellido_M' => $Apellido_M,
														'Universidad' => $Universidad,
														'Carrera' => $Carrera,
			                      'Promedio' => $Promedio,
			                      'Estado' => $Estado,
			                      'Porcentaje' => $Porcentaje,
			                      'TiempoRestante' => $TiempoRestante);
			}
			$stmt->close();
			return $Resultado;
		}
		else
			return false;
	}


	/**
	*
	*/
	function actualizaEstatus($Usuario,$Estado)
	{
		if($this->driver->connect_errno)//Se conecta con la BD si no hay error se prosigue
			return false;
		if($stmt = $this->driver->prepare("UPDATE Usuario SET Estado = ? WHERE Usuario = ?")){
			$Usuario =  $this->driver->real_escape_string($Usuario);
			$Estado = $this->driver->real_escape_string($Estado);
			$stmt->bind_param('is',$Estado,$Usuario);
			if($stmt->execute()){
				$stmt->close();
				return true;
			}
		}

	}

	function NuevaContasena($Usuario,$Contrasena)
	{
		if($this->driver->connect_errno)
			return false;
		if($stmt = $this->driver->prepare("UPDATE Usuario SET Contrasena = ? WHERE Usuario=?")) 
		{
			$Contrasena = $this->driver->real_escape_string($Contrasena);
			$Usuario = $this->driver->real_escape_string($Usuario);
			$stmt->bind_param("ss",$Contrasena,$Usuario);
			if(!$stmt->execute())
				return false;
			$stmt->close();
			return true;
		}
	}

	function NuevaContasenaEstado($Usuario,$Contrasena)
	{
		if($this->driver->connect_errno)
			return false;
		if($stmt = $this->driver->prepare("UPDATE Usuario SET Contrasena = ?,Estado = ? WHERE Usuario=?")) 
		{
			$Contrasena = $this->driver->real_escape_string($Contrasena);
			$Usuario = $this->driver->real_escape_string($Usuario);
			$Estado = 1;
			$stmt->bind_param("sis",$Contrasena,$Estado,$Usuario);
			if(!$stmt->execute())
				return false;
			$stmt->close();
			return true;
		}
	}

	function recuperaContrasena($Usuario)
	{
		//$Resultado=null;
		if($this->driver->connect_errno)//Se conecta con la BD si no hay error se prosigue
			return false;
		if($stmt = $this->driver->prepare("SELECT Contrasena FROM Usuario WHERE Usuario = ?"))
		{
			$Usuario =  $this->driver->real_escape_string($Usuario);
			$stmt->bind_param("s",$Usuario);
			if(!$stmt->execute())
				return $stmt->error;
			$stmt->bind_result($pass);
			while ($stmt->fetch())
				$Resultado = $pass;
			$stmt->close();

			return $Resultado;
		}

	}

	function detalleExamen()
	{
		$array = null;
		if($this->driver->connect_errno)//Se conecta con la BD si no hay error se prosigue
			return false;
		if($stmt = $this->driver->prepare("SELECT c.Nombre,e.Nombre,e.Num_Preguntas,count(d.Resultado),r.Calificacion,e.Calificacion_Min 
											FROM Categoria c INNER JOIN Examen e ON c.ID=e.ID_Categoria INNER JOIN Resultado_Examen r ON e.ID=r.ID_Examen INNER JOIN Detalle_Pregunta_Examen d ON r.ID_Examen=d.ID_Examen
											WHERE r.Usuario=? AND d.Resultado=1"))
		{
			$usuario = $_SESSION['usuario'];
			$usuario = $this->driver->real_escape_string($usuario);
			$stmt->bind_param("s",$usuario);
			if(!$stmt->execute())
				return $stmt->error;
			$stmt->bind_result($Categoria,$Examen,$Num_Preguntas,$aciertos,$Calificacion,$Calificacion_Min);
			while ($stmt->fetch()) {
				if(isset($Examen))
				{
					$estado = 'Aprobado';
					if($Calificacion < $Calificacion_Min)
						$estado = 'Reprobado';
					$array[] = array('Categoria' => $Categoria,
									'Examen' => $Examen,
									'Num_Preguntas' => $Num_Preguntas,
									'Aciertos' => $aciertos,
									'Calificacion' => $Calificacion,
									'Estado' => $estado);
				}
			}
			$stmt->close();
		}
		return $array;
	}

	function ingresar($usuario,$contrasena)
	{
		$existe=false;
		if($this->driver->connect_errno)
			return false;
		if($stmt = $this->driver->prepare("SELECT u.Usuario, u.Correo_Elec, u.Contrasena, u.Tipo, u.Estado, u.Imagen_Perfil, p.Nombres, p.Apellido_P 
			FROM Usuario u INNER JOIN Perfil p  ON u.Usuario = p.Usuario 
			WHERE u.Usuario=? AND u.Contrasena=?")) 
		{
			$usuario = $this->driver->real_escape_string($usuario);
			$contrasena = $this->driver->real_escape_string($contrasena);
			$stmt->bind_param("ss",$usuario,$contrasena);
			$stmt->execute();
			$stmt->bind_result($usuario_consulta,$correo_consulta,$contrasena_consulta,$tipo_consulta,$status_consulta,$Ruta_imagen,$nombres_consulta,$apellidop_consulta);
			while ($stmt->fetch()) {
				$_SESSION['usuario'] = $usuario_consulta;
				$_SESSION['tipo'] = $tipo_consulta;
//falta un selec o algo para hacer este campo$_SESSION['nombre']=
				$_SESSION['estado'] = $status_consulta;
				$_SESSION['img_ruta'] = $Ruta_imagen;
				$_SESSION['Nombres'] = $nombres_consulta;
				$_SESSION['Apellido_P'] = $apellidop_consulta;
				$existe = true;
			}
			$stmt->close();
		}
		return $existe;

	}
	function buscar($busca)
	{
		$array=null;
		if($this->driver->connect_errno)
			return false;
		//Se prepara el Query, los signos ? se sustituyen por las variables
		if($stmt = $this->driver->prepare("SELECT p.Usuario, p.Nombres, p.Apellido_P, p.Apellido_M, p.Universidad, p.Carrera, p.Promedio, p.Estado, p.Porcentaje, u.Correo_Elec, u.Imagen_Perfil FROM Perfil p INNER JOIN Usuario u ON p.Usuario = u.Usuario
		WHERE (p.Usuario LIKE ? OR p.Nombres LIKE ? OR p.Apellido_P LIKE ? OR p.Apellido_M LIKE ? OR p.Universidad LIKE ? OR p.Carrera LIKE ?) AND u.Tipo = '2';"))
		{
			//Se limpian las variables para evitar inyecciones de SQL
			$busca = $this->driver->real_escape_string($busca);
			//se agrega los % para usar la función like de SQL
			$busca='%'.$busca.'%';
			//se sustituye los ? por las variables, especificando el tipo de dato, i=integer,s=string, etc.
			$stmt->bind_param("ssssss",$busca,$busca,$busca,$busca,$busca,$busca);
			//se ejecuta el query
			$stmt->execute();
			//se establecen las variables donde se guardan los resultados de la ejecución, deben de coincidir con el numero de columnas que te devuelve el query
			$stmt->bind_result($Usuario, $Nombres, $Apellido_P, $Apellido_M, $Universidad, $Carrera, $Promedio, $Estado, $Porcentaje,$Correo,$Imagen_Perfil);
			//se setean las variables con los valores obtenidos, se hace fila por fila, si es que esperan mas
			
			while ($stmt->fetch()) {
				$array[] = array(
							'Usuario' => $Usuario,
							'Nombres' => $Nombres.' '.$Apellido_P.' '.$Apellido_M,
							'Universidad' => $Universidad,
							'Carrera' => $Carrera,
							'Promedio' => $Promedio,
							'Estado' => $Estado,
							'Porcentaje' => $Porcentaje,
							'Correo' => $Correo,
							'Foto' => $Imagen_Perfil
							);
			}
			$stmt->close();
		}
		//$this->driver->close();
		return $array;
	}
	function asignarFoto($ruta)
	{
		$guardado = false;
		if($this->driver->connect_errno)
			return false;
		if($stmt = $this->driver->prepare("UPDATE Usuario SET Imagen_Perfil = ? WHERE Usuario = ?"))
		{
			//Se limpian las variables para evitar inyecciones de SQL
			$usuario = $_SESSION['usuario'];
			//se sustituye los ? por las variables, especificando el tipo de dato, i=integer,s=string, etc.
			$stmt->bind_param("ss",$ruta,$usuario);
			//se ejecuta el query
			$stmt->execute();
			//se establecen las variables donde se guardan los resultados de la ejecución, deben de coincidir con el numero de columnas que te devuelve el query
			$stmt->close();
			$guardado = true;
			$_SESSION['img_ruta'] = $ruta;
		}
		return $guardado;
	}

	function buscaUsuario($User)
	{
   	$Resultado=null;
		if($this->driver->connect_errno)
			return false;
		if($stmt = $this->driver->prepare("SELECT Usuario,Correo_Elec FROM Usuario WHERE Usuario = ?"))
		{
			$User = $this->driver->real_escape_string($User);
			$stmt->bind_param("s",$User);
			if (!$stmt->execute()) 
				return $stmt->errno;
			$stmt->bind_result($consulta,$ccorreo);
			while ($stmt->fetch())
				$Resultado = array('usuario' => $consulta,
														'correo' => $ccorreo);
			$stmt->close();
			return $Resultado;

		}
		else
			return false;
	}

	function desactivaCuenta($Usuario,$Correo,$Token)
	{
		if($this->driver->connect_errno)
			return false;
		if($stmt = $this->driver->prepare("UPDATE  Usuario SET Contrasena = ?, Estado = ? WHERE Usuario = ?"))
		{
			$Estado = 0;
			$Usuario = $this->driver->real_escape_string($Usuario);
			$Token = $this->driver->real_escape_string($Token);
			$stmt->bind_param("sis",$Token,$Estado,$Usuario);
			if ($stmt->execute()) 
			{
				$stmt->close();
			date_default_timezone_set ('America/Mexico_City');//se establece la zona horaria para la funcion mail
	  		//Se crea el enlace que guiara al usuario a  completar su registro
		  	$enlace = "http://examenesonline.no-ip.org/index.php?controlador=usuario&accion=CambioContrasenaNueva&response=".$Token;
		  	//Las siguientes variables son parametros para la funcion mail() de php que permite enviar emails
		    $From = 'From: "Team Dead Developers" deaddevelopers@gmail.com';//Esta linea modifica el remitente se debe de poner por que sino el remitente sera el servidor interprete de php
				$asunto="Restablecer Contraseña de ExamenesOnline";
				$mensaje="Hola ".$Usuario.": \n\nSigue el enlace para que restablescar tu contraseña: \n\n"
				         .$enlace."\n\n Si tu navegador no te redirecciona por favor copia elenlace en la barra de busqueda.";
	      if(mail($Correo,$asunto,$mensaje,$From))
	        return true;
	      else
	        return false;//Si el mensaje no se puede enviar se retorna un false para que elcontrolador muestre un mensaje
				
			}
				return false;

		}
		else
			return false;
	}
}
?>