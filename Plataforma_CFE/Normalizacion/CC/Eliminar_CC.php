<?php
	session_start();
	include("../../api/php/Conexion_Plataforma.php");
	$conexion = Conectar();
	$id=$_GET['id'];
	include ("../../Usuarios/Historial.php");
	$actividad = "Eliminación de un registro en Compras Consolidadas.";
	historial($actividad,$conexion);
	mysqli_query($conexion,"DELETE FROM cc WHERE Solped='$id'",header("Location: Eliminar_Registro_CC.php"));
?>