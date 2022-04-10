
<?php
  session_start();
  include ("../../api/php/Conexion_Plataforma.php");
  $conexion = Conectar();
  $año = $_GET['nombre_bd'];
  $query = mysqli_query($conexion,"SELECT * FROM cn WHERE Base_Datos='$año'");
  $numrows = mysqli_num_rows($query);
  if ($numrows!==0) 
  {
      while ($row = mysqli_fetch_assoc($query)) 
      {
        $año_bd = $row['Base_Datos'];
      }
      if ($año_bd==$año) 
      {
      	header('Location:Conformidad_Normativa.php');
        ?>
        <div class="container">
        <div class="alert alert-danger">
          <data-dismiss="alert"><strong>Error: </strong>Ya existe una base de datos para <?=$año_bd?>.
        </div>
        <div class="panel-heading"> 
        <ul class="pager">
          <li class="previous"><a href="Agregar_BD_CN.php">Regresar</a></li>
        </ul>
        </div>
        </div>
        <?php
        die();
      }
  }
  else
  {
    $result=mysqli_query($conexion,"SELECT Id FROM cn ORDER BY Id DESC");
    $row=mysqli_fetch_array($result);
    $id = $row["Id"]+1;
    $sql="INSERT INTO cn (Id,Base_Datos) VALUES ('$id','$año');";
	  if ($conexion->query($sql) === TRUE) 
	  {
	    //echo "Database created successfully. ";
	  } 
	  else 
	  {
      mysqli_free_result($query);
      mysqli_close($conexion);
	    header('Location:Conformidad_Normativa.php');
	    echo "Error creating database: " . $conexion->error;
	    die();
	  }
	  $nombre = "bd_".$año;
	  $sql = "CREATE TABLE temp LIKE bd_formato";
	  if ($conexion->query($sql) === TRUE) 
	  {
	    //echo "Table created successfully. ";
	  } 
	  else 
	  {
      mysqli_free_result($query);
      mysqli_close($conexion);
	    header('Location:Conformidad_Normativa.php');
	    echo "Error creating table: " . $conexion->error;
	    die();
	  }
	  $sql = "ALTER TABLE temp RENAME $nombre";
	  //$sql = "RENAME TABLE temp TO bd_2000";
	  if ($conexion->query($sql) === TRUE) 
	  {
	    //echo "Table renamed successfully. ";
	  } 
	  else 
	  {
      mysqli_free_result($query);
      mysqli_close($conexion);
	  	header('Location:Conformidad_Normativa.php');
	    echo "Error renaming table: " . $conexion->error;
	    die();
	  } 
    mkdir("Contenido/bd_".$año, 0777);
    mkdir("Contenido/bd_".$año."/pdf", 0777);
    include ("../../Usuarios/Historial.php");
  	$actividad = "Creación de una nueva base de datos ".$año." en Conformidad Normativa.";
   	historial($actividad,$conexion);
    mysqli_free_result($query);
    mysqli_close($conexion);
	  header('Location:Conformidad_Normativa.php');
  }
?>


