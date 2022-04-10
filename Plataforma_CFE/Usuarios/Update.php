<?php
  session_start();
  include ("../api/php/Conexion_Plataforma.php");
  $conexion = Conectar();
  $id=$_POST['id'];
  $usuario = $_POST['usuario'];
  $contraseña = md5($_POST['clave']);
  $permiso = $_POST['permiso'];
  include ("Historial.php");
  $actividad = "Actualización de datos de un usuario.";
  historial($actividad,$conexion);
  $sql=mysqli_query($conexion,"UPDATE usuarios SET Usuario='$usuario', Password='$contraseña', Permisos='$permiso' WHERE Id='$id'",header("Location: Consulta_Usuarios.php"));
	mysqli_close($conexion);
?>
