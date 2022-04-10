<?php 
  session_start();
  include ("../api/php/Conexion_Plataforma.php");
  $conexion = Conectar();
  include ("Historial.php");
  $actividad = "Cierre de sesión.";
  historial($actividad,$conexion);
  unset($_SESSION['usuario']);
  mysqli_close($conexion);
  header('Location: ../index.html');
?>
