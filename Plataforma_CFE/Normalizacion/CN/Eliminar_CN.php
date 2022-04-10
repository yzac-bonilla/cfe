<?php
	session_start();
	include("../../api/php/Conexion_Plataforma.php");
	$conexion = Conectar();
	$X=$_GET['id'];
	$datos = explode(",",$X);
	$id = trim($datos[0]);
	$año = trim($datos[1]);
	$base_datos = "bd_".$año;
	include ("../../Usuarios/Historial.php");
	$actividad = "Eliminación de un registro de la base de datos ".$año." en Conformidad Normativa.";
	historial($actividad,$conexion);
	mysqli_query($conexion,"DELETE FROM $base_datos WHERE Id=$id",header("Location: Eliminar_Registro_CN.php?id=$año"));
?>