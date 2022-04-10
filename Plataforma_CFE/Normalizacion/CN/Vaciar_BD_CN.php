<?php
	session_start();
	include("../../api/php/Conexion_Plataforma.php");
	$conexion = Conectar();
	$año=$_GET['id'];
	$base_datos = "bd_".$año;
	include ("../../Usuarios/Historial.php");
  	$actividad = "Eliminación de todos los registros de la base de datos ".$año." en Conformidad Normativa.";
  	historial($actividad,$conexion);
	mysqli_query($conexion,"TRUNCATE TABLE $base_datos");
  	mysqli_close($conexion);
	header("Location: Base_Datos_CN.php?id=$año");
?>