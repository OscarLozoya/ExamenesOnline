<?php	
  /**
  * 
  */
  class CategoriaMdl
  {
  	
  	private $driver;
		function __construct()
		{
			include_once('datos_conexion.inc.php');
			$this->driver=new mysqli($servidor,$usuario,$pass,$bd);
		}

		function buscaUltimo()
		{
				$ultimo = '';
				if($this->driver->connect_errno)
					return false;
				if($stmt = $this->driver->prepare("SELECT MAX(ID) FROM Categoria")) 
				{
					$stmt->execute();
					$stmt->bind_result($ultimo);
					while($stmt->fetch())
					{
						$ultimo = $ultimo + 1;
					}
					$stmt->close();
					return $ultimo;
				}
				else
					return $ultimo;
		}

		function AgregarCategoria($NombreCat)
		{
			if($this->driver->connect_errno)
					return false;
			if($stmt = $this->driver->prepare("INSERT INTO Categoria(Nombre) VALUES (?)")) 
			{
				$NombreCat = $this->driver->real_escape_string($NombreCat);
				$stmt->bind_param("s",$NombreCat);
				if (!$stmt->execute())
				   return false;
			  $stmt->close();
			}
			return true;
		}

		function buscaCategoria($Parametro){
			$Resultado = null;
			if($this->driver->connect_errno)
					return false;
			if($stmt = $this->driver->prepare("SELECT ID,Nombre FROM Categoria WHERE Nombre LIKE ? OR ID LIKE ?")) 
			{
				$Parametro = $this->driver->real_escape_string($Parametro);
				$Nombre = "%".$Parametro."%";
				$stmt->bind_param("ss",$Nombre,$Parametro);
				if (!$stmt->execute())
				   return false;
				$stmt->bind_result($IdRec,$NombreRec);
				while ($stmt->fetch()) {
						$Resultado[] = array('Id' => $IdRec,
							                   'Nombre' => $NombreRec
															  );
				}
				$stmt->close();
			}
			return $Resultado;
		}

		function buscaCategoriaE($Parametro){
			$Resultado = null;
			if($this->driver->connect_errno)
					return false;
			if($stmt = $this->driver->prepare("SELECT ID,Nombre FROM Categoria WHERE ID = ?")) 
			{
				$Parametro = $this->driver->real_escape_string($Parametro);
				$stmt->bind_param("s",$Parametro);
				if (!$stmt->execute())
				   return false;
				$stmt->bind_result($IdRec,$NombreRec);
				while ($stmt->fetch()) {
						$Resultado = array('Id' => $IdRec,
							                   'Nombre' => $NombreRec
															  );
				}
				$stmt->close();
			}
			return $Resultado;
		}

		function eliminaCategoria($Id_Cat)
		{
			$Resultado = false;
			if($this->driver->connect_errno)
					return false;
			if($stmt = $this->driver->prepare("DELETE FROM Categoria WHERE ID = ?")) 
			{
				$Id_Cat = $this->driver->real_escape_string($Id_Cat);
				$stmt->bind_param("s",$Id_Cat);
				if (!$stmt->execute())
				   return false;
				$Resultado = true;
				$stmt->close();
			}
			return $Resultado;
		}

		function actualizaCategoria($Id_Cat,$NombreCat){
			if($this->driver->connect_errno)
					return false;
			$this->eliminaCategoria($Id_Cat);
			if($stmt = $this->driver->prepare("INSERT INTO Categoria VALUES (?,?)")) 
			{
				$NombreCat = $this->driver->real_escape_string($NombreCat);
				$stmt->bind_param("is",$Id_Cat,$NombreCat);
				if (!$stmt->execute())
				   return false;
			  $stmt->close();
			}
			return true;

		}

  }
?>