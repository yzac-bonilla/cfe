<?php
  session_start();
  if (!isset($_SESSION['usuario'])) {header('Location:../../index.html');}
  $año = $_GET['id'];
  $base_datos = "bd_".$año;
  $archivo = "Base de datos ".$año.".xls";
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
  $actividad = "Descarga del archivo .xlsx de la base de datos ".$año." en Conformidad Normativa.";
  historial($actividad,$conexion);
?>

<div class="container">

  <table class="overflow-y" border="1">
    <thead>
    <tr align="center">
      <th bgcolor="#31bc86"><font color="white"><b>SAO</b></font></th>
      <th bgcolor="#31bc86"><font color="white"><b>Fecha Recepción</b></font></th>
      <th bgcolor="#31bc86"><font color="white"><b>Especificación</b></font></th>
      <th bgcolor="#31bc86"><font color="white"><b>Sello</b></font></th>
      <th bgcolor="#31bc86"><font color="white"><b>Empresa</b></font></th>
      <th bgcolor="#31bc86"><font color="white"><b>Remitente</b></font></th>
      <th bgcolor="#31bc86"><font color="white"><b>Familia</b></font></th>
      <th bgcolor="#31bc86"><font color="white"><b>Responsable</b></font></th>
      <th bgcolor="#31bc86"><font color="white"><b>Status</b></font></th>
      <th bgcolor="#31bc86"><font color="white"><b>Oficio</b></font></th>
      <th bgcolor="#31bc86"><font color="white"><b>Fecha Oficio</b></font></th>
      <th bgcolor="#31bc86"><font color="white"><b>Fecha Atención</b></font></th>
      <th bgcolor="#31bc86"><font color="white"><b>Oficios Atendidos</b></font></th>
      <th bgcolor="#31bc86"><font color="white"><b>Plan Piloto</b></font></th>
      <th bgcolor="#31bc86"><font color="white"><b>Tiempo Respuesta</b></font></th>
      <th bgcolor="#31bc86"><font color="white"><b>Baja SAO</b></font></th>
    </tr>
    </thead>
    <tbody>
  <?php
  $result=mysqli_query($conexion,"SELECT * FROM $base_datos ORDER BY Id DESC");
  while($row=mysqli_fetch_array($result))
  {
    ?>
    <tr align="center">
      <th bgcolor="#31bc86"><font color="white"><b><?=$row["Id"]?></b></font></th>
      <td><?=$row["Fecha_Recepcion"]?></td>
      <td><?=$row["Especificacion"]?></td>
      <td><?=$row["Sello"]?></td>
      <td><b><?=$row["Empresa"]?></b></td>
      <td><?=$row["Remitente"]?></td>
      <td><b><?=$row["Familia"]?></b></td>
      <td><?=$row["Responsable"]?></td>
      <td><?=$row["Status"]?></td>
      <td><?=$row["Oficio"]?></td>
      <td><?=$row["Fecha_Oficio"]?></td>
      <td><?=$row["Fecha_Atencion"]?></td>
      <td><?=$row["Oficios_Atendidos"]?></td>
      <td><?=$row["Plan_Piloto"]?></td>
      <td><?=$row["Tiempo_Respuesta"]?></td>
      <td><?=$row["Baja_SAO"]?></td>
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

