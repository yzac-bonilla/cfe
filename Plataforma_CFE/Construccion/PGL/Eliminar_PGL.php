<?php
	session_start();
	include("../../api/php/Conexion_Plataforma.php");
	$conexion = Conectar();
	$id=$_GET['id'];
	include ("../../Usuarios/Historial.php");
    $actividad = "Eliminación de un registro en Programa General de Licitaciones.";
    historial($actividad,$conexion);
	mysqli_query($conexion,"DELETE FROM pgl WHERE No=$id",header("Location: Eliminar_Registro_PGL.php"));
?>