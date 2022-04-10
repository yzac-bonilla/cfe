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

      <table border="1">
      <?php
      include ("Conexion_Plataforma.php");
      $conexion = Conectar();
      $result=mysqli_query($conexion,"SELECT * FROM cn_especificacion");
      while($row=mysqli_fetch_array($result))
      {
          ?>
            <tr>
              <td><?=$row['Id']?></td>
              <td><?=$row['Familia']?></td>
              <td><a href="ModifyScriptSelected.php?id=<?=$row['Id']?>">Modificar</a></td>
            </tr>
          <?php
      }
      mysqli_free_result($result);
      mysqli_close($conexion);
      ?>
      </table>

</center>
</font>
</body>
</html>