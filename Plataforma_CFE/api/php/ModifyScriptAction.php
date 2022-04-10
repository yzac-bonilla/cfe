<!DOCTYPE html>
<html lang="es">
<head>
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Base de datos</title>
</head>
<body>
<font size=4>
<center>

  <h1>Base de datos</h1>
  <p>Script de edición rápida de mysql</p><br>

  <?php
  $id = $_GET['id'];
  $texto = $_GET['texto'];
  include ("Conexion_Plataforma.php");
  $conexion = Conectar();
  $sql=mysqli_query($conexion,"UPDATE cn_especificacion SET Familia='$texto' WHERE Id='$id'");
  /*if ($conexion->query($sql) === TRUE) 
      {
        
        echo "Registro actualizado satisfactoriamente.";
      } 
  else 
      {
        echo '<font color="red"><b>ERROR:</b> ' .'</font><br>' . $sql . '<br><font color="green">'.$conexion->error.'</font>'."<font color='Navy'><br>Asegúrese de que cada campo contenga caracteres válidos según su tipo de dato.<br><br></font>";
      }*/
  mysqli_free_result($result);
  mysqli_close($conexion);
  header("Location: ModifyScript.php");
  ?>


</center>
</font>
</body>
</html>