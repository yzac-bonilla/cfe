<?php
  session_start();
  if (!isset($_SESSION['usuario'])) {header('Location:../../index.html');}
  header("Content-type: application/vnd.ms-excel");
  header("Content-Disposition: attachment; filename=Compras_Consolidadas.xls");
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
  $actividad = "Descarga del archivo .xlsx de Compras Consolidadas.";
  historial($actividad,$conexion);
?>

<div class="container">

  <div id="imprimir">
  <table class="overflow-y" border="1">
    <thead>
    <tr align="center">
      <th bgcolor="#31bc86"><font color="white"><b>Solped</b></font></th>
      <th bgcolor="#31bc86"><font color="white"><b>Familia</b></font></th>
      <th bgcolor="#31bc86"><font color="white"><b>Piezas</b></font></th>
      <th bgcolor="#31bc86"><font color="white"><b>Importe</b></font></th>
      <th bgcolor="#31bc86"><font color="white"><b>Junta</b></font></th>
      <th bgcolor="#31bc86"><font color="white"><b>Fallo</b></font></th>
      <th bgcolor="#31bc86"><font color="white"><b>Contrato</b></font></th>
    </tr>
    </thead>
    <tbody>
  <?php
  $result=mysqli_query($conexion,"SELECT * FROM cc ORDER BY Familia");
  while($row=mysqli_fetch_array($result))
  {
    ?>
    <tr align="center">
      <th bgcolor="#31bc86"><font color="white"><b><?=$row["Solped"]?></b></font></th>
      <td><b><?=$row["Familia"]?></b></td>
      <td><?=$row["Piezas"]?></td>
      <td><?=$row["Importe"]?></td>
      <td><?=$row["Junta"]?></td>
      <td><?=$row["Fallo"]?></td>
      <td><?=$row["Contrato"]?></td>
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

