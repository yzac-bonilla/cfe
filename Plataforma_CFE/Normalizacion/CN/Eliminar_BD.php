<?php
	session_start();
	include("../../api/php/Conexion_Plataforma.php");
	$conexion = Conectar();
	$id=$_GET['id'];
	mysqli_query($conexion,"DELETE FROM cn WHERE Base_Datos=$id");
	$base_datos = "bd_".$id;
	rmdir("Contenido/".$base_datos."/pdf");
	rmdir("Contenido/".$base_datos);
	include ("../../Usuarios/Historial.php");
  	$actividad = "Eliminación de la base de datos ".$id." en Conformidad Normativa.";
  	historial($actividad,$conexion);
	mysqli_query($conexion,"DROP TABLE $base_datos",header("Location: Eliminar_BD_CN.php"));
?>