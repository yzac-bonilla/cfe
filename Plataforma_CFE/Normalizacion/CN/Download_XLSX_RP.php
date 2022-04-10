<?php
  session_start();
  if (!isset($_SESSION['usuario'])) {header('Location:../../index.html');}
  $archivo = "Reunión con los Provedores.xls";
  header("Content-type: application/vnd.ms-excel");
  header("Content-Disposition: attachment; filename= $archivo");
?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="utf-8">
  <title>Base de datos</title>
</head>
<body>
<font size=4>

<?php
  include ("../../api/php/Conexion_Plataforma.php");
  $conexion = Conectar();
  include ("../../Usuarios/Historial.php");
  $actividad = "Descarga del archivo .xlsx de reunión con los provedores en Conformidad Normativa.";
  historial($actividad,$conexion);
?>

<div class="container">

  <table class="overflow-y" border="1">
    <thead>
    <tr align="center">
      <th bgcolor="#31bc86"><font color="white"><b>Id</b></font></th>
      <th bgcolor="#31bc86"><font color="white"><b>Fecha</b></font></th>
      <th bgcolor="#31bc86"><font color="white"><b>Provedor</b></font></th>
      <th bgcolor="#31bc86"><font color="white"><b>Tema</b></font></th>
      <th bgcolor="#31bc86"><font color="white"><b>Documentación</b></font></th>
      <th bgcolor="#31bc86"><font color="white"><b>Nota Informativa</b></font></th>
    </tr>
    </thead>
    <tbody>
  <?php
  $result=mysqli_query($conexion,"SELECT * FROM cn_reunion_provedor ORDER BY Id DESC");
  while($row=mysqli_fetch_array($result))
  {
    ?>
    <tr align="center">
      <th bgcolor="#31bc86"><font color="white"><b><?=$row["Id"]?></b></font></th>
      <td><?=$row["Fecha"]?></td>
      <td><b><?=$row["Provedor"]?></b></td>
      <td><b><?=$row["Tema"]?></b></td>
      <td><?=$row["Documentacion"]?></td>
      <td><?=$row["Nota_Informativa"]?></td>
    </tr>
    <?php
  }
  mysqli_free_result($result);
  mysqli_close($conexion);
  ?>
  </tbody>
  </table>

</div>

</font>
</body>
</html>

