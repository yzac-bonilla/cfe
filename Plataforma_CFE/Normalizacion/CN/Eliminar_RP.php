<?php
	session_start();
	include("../../api/php/Conexion_Plataforma.php");
	$conexion = Conectar();
	$id=$_GET['id'];
	include ("../../Usuarios/Historial.php");
	$actividad = "Eliminación de un registro de reunion con los provedores en Conformidad Normativa.";
	historial($actividad,$conexion);
	mysqli_query($conexion,"DELETE FROM cn_reunion_provedor WHERE Id=$id",header("Location: Eliminar_Registro_RP.php"));
?>