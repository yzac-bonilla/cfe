<?php
  session_start();
  include ("../api/php/Conexion_Plataforma.php");
  $conexion = Conectar();
  $usuario = $_POST['usuario'];
  $contraseña = md5($_POST['clave']);
  $permiso = $_POST['permiso'];
  $result=mysqli_query($conexion,"SELECT Id FROM usuarios ORDER BY Id DESC");
  $row=mysqli_fetch_array($result);
  $id = $row["Id"]+1;
	$sql="INSERT INTO usuarios (Id,Usuario,Password,Permisos) VALUES ('$id','$usuario','$contraseña','$permiso');";
	if ($conexion->query($sql) === TRUE) 
	{
      include ("Historial.php");
      $actividad = "Creación de un nuevo usuario.";
      historial($actividad,$conexion);
      mysqli_close($conexion);
      header('Location:Consulta_Usuarios.php');
    	//echo '<center>'.'<font color="red">'."Nuevo Usuario creado satisfactoriamente.".'</center>';
	} 
	else 
	{
    	echo "Error: " . $sql . "<br>" . $conexion->error;
	}
	mysqli_close($conexion);
?>
