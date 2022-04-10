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

  <form action="ModifyScriptAction.php">
      <?php
      $id = $_GET['id'];
      include ("Conexion_Plataforma.php");
      $conexion = Conectar();
      $result=mysqli_query($conexion,"SELECT * FROM cn_especificacion WHERE Id='$id'");
      while($row=mysqli_fetch_array($result))
      {
          ?>
            <br><input type="text" name="id" class="form-control" value="<?=$row['Id']?>" readonly>
            <input type="text" name="texto" class="form-control" value="<?=$row['Familia']?>"><br>
          <?php
      }
      mysqli_free_result($result);
      mysqli_close($conexion);
      ?>
    </div>
    <br><br><input type="submit" class="btn btn-primary" value="Guardar" required> 
  </form>

</center>
</font>
</body>
</html>