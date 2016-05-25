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
	
	function alta($usuario, $correo, $token, $tipo, $estado)
	{
		if($this->driver->connect_errno)
			return false;
		if($stmt = $this->driver->prepare("INSERT INTO Usuario VALUES(?,?,?,?,?)")) 
		{
			$token = $this->driver->real_escape_string($token); //Aegurarnos que el usuario no ingrese palabras reservadas
			$correo = $this->driver->real_escape_string($correo);
			$usuario = $this->driver->real_escape_string($usuario);
			$tipo = $this->driver->real_escape_string($tipo);
			$estado = $this->driver->real_escape_string($estado);
			$stmt->bind_param("sssii",$usuario,$correo,$token,$tipo,$estado); 
			if($stmt->execute())
			$stmt->close();
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
		if($desde == $hasta)
			return false;
		if($stmt = $this->driver->prepare("INSERT INTO Horario VALUES(?,?,?,?)")){
			$Usuario =  $this->driver->real_escape_string($Usuario);
			$Dia = $this->driver->real_escape_string($Dia);
			$desde = $this->driver->real_escape_string($desde);
			$hasta = $this->driver->real_escape_string($hasta);
			$stmt->bind_param("ssss",$Usuario,$Dia,$desde,$hasta);
			if($stmt->execute()){
				$stmt->close();
				return true;
			}
		}
	}
	
	/**
	*
	*/
	function guardaTelefonos($Usuario,$Telefono){
		if($this->driver->connect_errno)//Se conecta con la BD si no hay error se prosigue
			return false;
		if(isset($Telefono)){
			$Usuario = $this->driver->real_escape_string($Usuario);
			//var_dump($Telefono);
		  $Telefonos = explode(',', $Telefono);
			foreach ($Telefonos as $Tel){
				if ($stmt = $this->driver->prepare("INSERT INTO Telefono VALUES(?,?)")) {
					$Tel = $this->driver->real_escape_string($Tel);
					$stmt->bind_param("ss",$Usuario,$Tel);
					if(!$stmt->execute())
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
	function guardaRedes($Usuario,$RedesSociales){
		if($this->driver->connect_errno)//Se conecta con la BD si no hay error se prosigue
			return false;
		if(isset($RedesSociales)){
			$Usuario = $this->driver->real_escape_string($Usuario);
			foreach ($RedesSociales as $Red){
				if ($stmt = $this->driver->prepare("INSERT INTO Telefono VALUES(?,?)")) {
					$Red = $this->driver->real_escape_string($Red);
					$stmt->bind_param("ss",$Usuario,$Red);
					if($stmt->execute())
						$stmt->execute();
					else{
						echo "ERROR AL WARDAR Una RED";
						return false;
					}
				}
			}
			return true;
		}
	}

	/**
	*
	*/
	function actualizaEstatus($Usuario,$Estado){
		if($this->driver->connect_errno)//Se conecta con la BD si no hay error se prosigue
			return false;
		if($stmt = $this->driver->prepare("UPDATE Usuario SET Estado = ? WHERE Usuario = ?")){
			$Usuario =  $this->driver->real_escape_string($Usuario);
			$Estado = $this->driver->real_escape_string($Estado);
			$stmt->bind_param('si',$Usuario,$Estado);
			if($stmt->execute()){
				$stmt->close();
				return true;
			}
		}

	}

	//
	function eventosProximos()
	{
		
	}
	function detalleExamen()
	{
		
	}
	function ingresar($usuario,$contrasena)
	{
		$existe=false;
		if($this->driver->connect_errno)
			return false;
		if($stmt = $this->driver->prepare("SELECT * FROM Usuario WHERE Usuario=? and Contrasena=?")) 
		{
			$usuario = $this->driver->real_escape_string($usuario);
			$contrasena = $this->driver->real_escape_string($contrasena);
			$stmt->bind_param("ss",$usuario,$contrasena);
			$stmt->execute();
			$stmt->bind_result($usuario_consulta,$correo_consulta,$contrasena_consulta,$tipo_consulta,$status_consulta,$Ruta_imagen);
			while ($stmt->fetch()) {
				$_SESSION['usuario'] = $usuario_consulta;
				$_SESSION['tipo'] = $tipo_consulta;
				$_SESSION['estado'] = $status_consulta;
				$_SESSION['img_ruta'] = $Ruta_imagen;
				$existe = true;
			}
			$stmt->close();
		}
		return $existe;

	}
}
?>