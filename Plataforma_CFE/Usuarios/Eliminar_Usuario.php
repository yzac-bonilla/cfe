<?php
	session_start();
	include("../api/php/Conexion_Plataforma.php");
	$conexion = Conectar();
	$id=$_GET['id'];
	include ("Historial.php");
    $actividad = "Eliminación de un usuario.";
    historial($actividad,$conexion);
	mysqli_query($conexion,"DELETE FROM usuarios WHERE Id=$id",header("Location: Eliminar_Registro_Usuario.php"));	
?>