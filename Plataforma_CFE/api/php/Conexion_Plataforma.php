<?php
	function Conectar()
	{
		$servidor = "localhost";
		$usuario = "root";
		$contraseña = "";
		$base = "plataforma";
		$conexion = new mysqli($servidor,$usuario,$contraseña,$base);
		if ($conexion->connect_error) 
		{
			die('<center>'.'<font color="red">'."Error en la conexión con la Base de Datos".date(" d/m/Y H:i:s").'<br>'.'<br>'.'</font>'.'</center>');
		}
		return $conexion;
	}
?>