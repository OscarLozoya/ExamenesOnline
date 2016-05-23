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
	function registrar($Usuario,$Correo,$Contrasena,$Tipo,$Estado)
	{
		if($this->driver->connect_errno)//Se conecta con la BD si no hay error se prosigue
			return false;
	  if($stmt = $this->driver->prepare("INSERT INTO Usuario VALUES(?,?,?,?,?)")){//Se implementa el "cascaron de la consulta"
	  	//Se limpian los datos que se reciben para evitar inyecciones de sql
	  	$Usuario = $this->driver->real_escape_string($Usuario);
	  	$Correo = $this->driver->real_escape_string($Correo);
	  	$Contrasena = $this->driver->real_escape_string($Contrasena);//En este momento la Contraseña es un token generado y servira para crear el enlace de reediccionamiento
	  	$Tipo = $this->driver->real_escape_string($Tipo);
	  	$Estado = $this->driver->real_escape_string($Estado);
	  	//Se cambian los '?' por los datos reales en la consulta
	  	$stmt->bind_param("sssii",$Usuario,$Correo,$Contrasena,$Tipo,$Estado);
	  	if($stmt->execute())
	  	{//Si la consulta se puede ejecutar envia un email al usuario para que complete su registro y cierra el query
	  		$stmt->close();
	  		//Se crea el enlace que guiara al usuario a  completar su registro
		  	$enlace = "http://examenesonline.no-ip.org/index.php?controlador=Usuario&accion=completarRegistro&response=".$Contrasena;
		  	//Las siguientes variables son parametros para la funcion mail() de php que permite enviar emails
		    $From = 'From: "Team Dead Developers" deaddevelopers@gmail.com';//Esta linea modifica el remitente se debe de poner por que sino el remitente sera el servidor interprete de php
				$asunto="Completar registro en ExamenesOnline";
				$mensaje="Hola ".$Usuario.": \n\nYa casi eres miembro de ExamenesOnline por favor completa tu registro en el siguiente enlace: \n\n"
				         .$enlace."\n\n Si tu navegador no te redirecciona por favor copia elenlace en la barra de busqueda."
				         ." \n\n Si no fuiste tu quien registro este correo contactanos a la direccion"
				         ." deaddevelopers@gmail.com con el asunto: 'Eiminar registro' y solucionaremos este error";
	      mail($Correo,$asunto,$mensaje,$From) or return false; //Si el mensaje no se puede enviar se retorna un false para que elcontrolador muestre un mensaje
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
	function completarRegistro()
	{
		
	}
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
			$stmt->bind_result($usuario_consulta,$correo_consulta,$contrasena_consulta,$tipo_consulta,$status_consulta);
			while ($stmt->fetch()) {
				$_SESSION['usuario'] = $usuario_consulta;
				$_SESSION['tipo'] = $tipo_consulta;
				$existe = true;
			}
			$stmt->close();
		}
		return $existe;

	}
}
?>