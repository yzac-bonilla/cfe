<?php
  session_start();
  if (!isset($_SESSION['usuario'])) {header('Location:../../index.html');}
  header("Content-type: application/vnd.ms-excel");
  header("Content-Disposition: attachment; filename=Programa_General_Licitaciones.xls");
?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="utf-8">
  <title>Base de datos</title>
</head>
<body>

<div class="container"> 

  <?php
    include ("../../api/php/Conexion_Plataforma.php");
    $conexion = Conectar();
    include ("../../Usuarios/Historial.php");
    $actividad = "Descarga del archivo .xlsx del Programa General de Licitaciones.";
    historial($actividad,$conexion);
  ?>

  <table class="overflow-y" border="1">
    <thead>
    <tr align="center">
      <th bgcolor="#31bc86"><font color="white">No</font></th>
      <th bgcolor="#31bc86"><font color="white">Proyecto</font></th>
      <th bgcolor="#31bc86"><font color="white">Entidad Federativa</font></th>
      <th bgcolor="#31bc86"><font color="white">División</font></th>
      <th bgcolor="#31bc86"><font color="white">Obras</font></th>
      <th bgcolor="#31bc86"><font color="white">S.E.</font></th>
      <th bgcolor="#31bc86"><font color="white">LT</font></th>
      <th bgcolor="#31bc86"><font color="white">Aliment. AT</font></th>
      <th bgcolor="#31bc86"><font color="white">Aliment. MT</font></th>
      <th bgcolor="#31bc86"><font color="white">MVA</font></th>
      <th bgcolor="#31bc86"><font color="white">MVAr</font></th>
      <th bgcolor="#31bc86"><font color="white">kmC</font></th>
      <th bgcolor="#31bc86"><font color="white">No. Aliment</th>
      <th bgcolor="#31bc86"><font color="white">Medidores</font></th>
      <th bgcolor="#31bc86"><font color="white">Transformadores Distribución</font></th>
      <th bgcolor="#31bc86"><font color="white">Postes</font></th>
      <th bgcolor="#31bc86"><font color="white">Difusión Convocatoria</font></th>
      <th bgcolor="#31bc86"><font color="white">Publicación Convocatoria</font></th>
      <th bgcolor="#31bc86"><font color="white">Visita Sitio</font></th>
      <th bgcolor="#31bc86"><font color="white">Inicio JA 1</font></th>
      <th bgcolor="#31bc86"><font color="white">Cierre JA 1</font></th>
      <th bgcolor="#31bc86"><font color="white">Inicio JA 2</font></th>
      <th bgcolor="#31bc86"><font color="white">Cierre JA 2</font></th>
      <th bgcolor="#31bc86"><font color="white">Inicio JA 3</font></th>
      <th bgcolor="#31bc86"><font color="white">Cierre JA 3</font></th>
      <th bgcolor="#31bc86"><font color="white">Recepción Propuesta</font></th>
      <th bgcolor="#31bc86"><font color="white">Fallo</font></th>
      <th bgcolor="#31bc86"><font color="white">Firma del Contrato</font></th>
      <th bgcolor="#31bc86"><font color="white">Inicio de la Construcción</font></th>
      <th bgcolor="#31bc86"><font color="white">Término de la Construcción</font></th>
      <th bgcolor="#31bc86"><font color="white">Act.Prev.Inv.(MDD)</font></th>
      <th bgcolor="#31bc86"><font color="white">Monto.Max. Publicado(MDD)</font></th>
      <th bgcolor="#31bc86"><font color="white">Monto Adjudicado(MDD)</font></th>
      <th bgcolor="#31bc86"><font color="white">Empresa/Consorcio Ganador</font></th>
    </tr>
    </thead>
    <tbody>
  <?php
  $today = date("d-m-Y H:i:s");
  $datetime2 = new DateTime($today);
  $contador=0;
  $result=mysqli_query($conexion,"SELECT * FROM pgl ORDER BY No");
  while($row=mysqli_fetch_array($result))
  {
    $contador++;
    ?>
    <tr align="center">
      <th bgcolor="#31bc86"><font color="white"><strong><?=$row["No"]?></strong></font></th>
      <td><strong><?=$row["Proyecto"]?></strong></td>
      <td><strong><?=$row["Entidad_Federativa"]?></strong></td>
      <td><strong><?=$row["Division"]?></strong></td>
      <td><strong><?=$row["Obras"]?></strong></td>
      <td><?=$row["SE"]?></td>
      <td><?=$row["LT"]?></td>
      <td><?=$row["Alimentadores_AT"]?></td>
      <td><?=$row["Alimentadores_MT"]?></td>
      <td><?=$row["MVA"]?></td>
      <td><?=$row["MVAr"]?></td>
      <td><?=$row["kmC"]?></td>
      <td><?=$row["Numero_Aliment"]?></td>
      <td><?=$row["Medidores"]?></td>
      <td><?=$row["Transformadores_Distribucion"]?></td>
      <td><?=$row["Postes"]?></td>
      <?php
      $color = "";
      $date1 = $row["Difusion_Proyecto_Convocatoria"];
      if(DateTime::createFromFormat('d-m-Y', $date1) !== false || DateTime::createFromFormat('d-M-Y', $date1) !== false || DateTime::createFromFormat('d/m/Y', $date1) !== false)
      {
          $datetime1 = new DateTime($date1);
          if ($datetime1 < $datetime2) 
          {
            $color = "#36eb88";
          }
      }
      ?>
      <td bgcolor=<?=$color?>><?=$row["Difusion_Proyecto_Convocatoria"]?></td>
      <?php
      $color = "";
      $date1 = $row["Publicacion_Convocatoria"];
      if(DateTime::createFromFormat('d-m-Y', $date1) !== false || DateTime::createFromFormat('d-M-Y', $date1) !== false || DateTime::createFromFormat('d/m/Y', $date1) !== false)
      {
          $datetime1 = new DateTime($date1);
          if ($datetime1 < $datetime2) 
          {
            $color = "#36eb88";
          }
      }
      ?>
      <td bgcolor=<?=$color?>><?=$row["Publicacion_Convocatoria"]?></td>
      <?php
      $color = "";
      $date1 = $row["Visita_Sitio"];
      if(DateTime::createFromFormat('d-m-Y', $date1) !== false || DateTime::createFromFormat('d-M-Y', $date1) !== false || DateTime::createFromFormat('d/m/Y', $date1) !== false)
      {
          $datetime1 = new DateTime($date1);
          if ($datetime1 < $datetime2) 
          {
            $color = "#36eb88";
          }
      }
      ?>
      <td bgcolor=<?=$color?>><?=$row["Visita_Sitio"]?></td>
      <?php
      $color = "";
      $date1 = $row["Inicio_Primera_Junta"];
      if(DateTime::createFromFormat('d-m-Y', $date1) !== false || DateTime::createFromFormat('d-M-Y', $date1) !== false || DateTime::createFromFormat('d/m/Y', $date1) !== false)
      {
          $datetime1 = new DateTime($date1);
          if ($datetime1 < $datetime2) 
          {
            $color = "#36eb88";
          }
      }
      ?>
      <td bgcolor=<?=$color?>><?=$row["Inicio_Primera_Junta"]?></td>
      <?php
      $color = "";
      $date1 = $row["Cierre_Primera_Junta"];
      if(DateTime::createFromFormat('d-m-Y', $date1) !== false || DateTime::createFromFormat('d-M-Y', $date1) !== false || DateTime::createFromFormat('d/m/Y', $date1) !== false)
      {
          $datetime1 = new DateTime($date1);
          if ($datetime1 < $datetime2) 
          {
            $color = "#36eb88";
          }
      }
      ?>
      <td bgcolor=<?=$color?>><?=$row["Cierre_Primera_Junta"]?></td>
      <?php
      $color = "";
      $date1 = $row["Inicio_Segunda_Junta"];
      if(DateTime::createFromFormat('d-m-Y', $date1) !== false || DateTime::createFromFormat('d-M-Y', $date1) !== false || DateTime::createFromFormat('d/m/Y', $date1) !== false)
      {
          $datetime1 = new DateTime($date1);
          if ($datetime1 < $datetime2) 
          {
            $color = "#36eb88";
          }
      }
      ?>
      <td bgcolor=<?=$color?>><?=$row["Inicio_Segunda_Junta"]?></td>
      <?php
      $color = "";
      $date1 = $row["Cierre_Segunda_Junta"];
      if(DateTime::createFromFormat('d-m-Y', $date1) !== false || DateTime::createFromFormat('d-M-Y', $date1) !== false || DateTime::createFromFormat('d/m/Y', $date1) !== false)
      {
          $datetime1 = new DateTime($date1);
          if ($datetime1 < $datetime2) 
          {
            $color = "#36eb88";
          }
      }
      ?>
      <td bgcolor=<?=$color?>><?=$row["Cierre_Segunda_Junta"]?></td>
      <?php
      $color = "";
      $date1 = $row["Inicio_Tercera_Junta"];
      if(DateTime::createFromFormat('d-m-Y', $date1) !== false || DateTime::createFromFormat('d-M-Y', $date1) !== false || DateTime::createFromFormat('d/m/Y', $date1) !== false)
      {
          $datetime1 = new DateTime($date1);
          if ($datetime1 < $datetime2) 
          {
            $color = "#36eb88";
          }
      }
      ?>
      <td bgcolor=<?=$color?>><?=$row["Inicio_Tercera_Junta"]?></td>
      <?php
      $color = "";
      $date1 = $row["Cierre_Tercera_Junta"];
      if(DateTime::createFromFormat('d-m-Y', $date1) !== false || DateTime::createFromFormat('d-M-Y', $date1) !== false || DateTime::createFromFormat('d/m/Y', $date1) !== false)
      {
          $datetime1 = new DateTime($date1);
          if ($datetime1 < $datetime2) 
          {
            $color = "#36eb88";
          }
      }
      ?>
      <td bgcolor=<?=$color?>><?=$row["Cierre_Tercera_Junta"]?></td>
      <?php
      $color = "";
      $date1 = $row["Recepcion_Propuesta"];
      if(DateTime::createFromFormat('d-m-Y', $date1) !== false || DateTime::createFromFormat('d-M-Y', $date1) !== false || DateTime::createFromFormat('d/m/Y', $date1) !== false)
      {
          $datetime1 = new DateTime($date1);
          if ($datetime1 < $datetime2) 
          {
            $color = "#36eb88";
          }
      }
      ?>
      <td bgcolor=<?=$color?>><?=$row["Recepcion_Propuesta"]?></td>
      <?php
      $color = "";
      $date1 = $row["Fallo"];
      if(DateTime::createFromFormat('d-m-Y', $date1) !== false || DateTime::createFromFormat('d-M-Y', $date1) !== false || DateTime::createFromFormat('d/m/Y', $date1) !== false)
      {
          $datetime1 = new DateTime($date1);
          if ($datetime1 < $datetime2) 
          {
            $color = "#36eb88";
          }
      }
      ?>
      <td bgcolor=<?=$color?>><?=$row["Fallo"]?></td>
      <?php
      $color = "";
      $date1 = $row["Firma_Contrato"];
      if(DateTime::createFromFormat('d-m-Y', $date1) !== false || DateTime::createFromFormat('d-M-Y', $date1) !== false || DateTime::createFromFormat('d/m/Y', $date1) !== false)
      {
          $datetime1 = new DateTime($date1);
          if ($datetime1 < $datetime2) 
          {
            $color = "#36eb88";
          }
      }
      ?>
      <td bgcolor=<?=$color?>><?=$row["Firma_Contrato"]?></td>
      <?php
      $color = "";
      $date1 = $row["Inicio_Construccion"];
      if(DateTime::createFromFormat('d-m-Y', $date1) !== false || DateTime::createFromFormat('d-M-Y', $date1) !== false || DateTime::createFromFormat('d/m/Y', $date1) !== false)
      {
          $datetime1 = new DateTime($date1);
          if ($datetime1 < $datetime2) 
          {
            $color = "#36eb88";
          }
      }
      ?>
      <td bgcolor=<?=$color?>><?=$row["Inicio_Construccion"]?></td>
      <?php
      $color = "";
      $date1 = $row["Termino_Construccion"];
      if(DateTime::createFromFormat('d-m-Y', $date1) !== false || DateTime::createFromFormat('d-M-Y', $date1) !== false || DateTime::createFromFormat('d/m/Y', $date1) !== false)
      {
          $datetime1 = new DateTime($date1);
          if ($datetime1 < $datetime2) 
          {
            $color = "#36eb88";
          }
      }
      ?>
      <td bgcolor=<?=$color?>><?=$row["Termino_Construccion"]?></td>
      <td>$<?=$row["Act_Prev_Inv"]?></td>
      <td>$<?=$row["Monto_Max_Publicado"]?></td>
      <td>$<?=$row["Monto_Adjudicado"]?></td>
      <td><?=$row["Empresa_Consorcio_Ganador"]?></td>
    </tr>
    <?php
  }
  ?>
    <tr align="center">
      <th bgcolor="#31bc86"><strong>Tot</strong></th>
      <td bgcolor="#31bc86"><strong>Subdirección de Distribución</strong></td>
      <td bgcolor="#31bc86" colspan="3"><strong><?=$contador?> Proyectos</strong></td>
      <?php  
        $result = mysqli_query($conexion,'SELECT SUM(SE) AS sum FROM pgl'); 
        $row = mysqli_fetch_assoc($result); 
      ?>
      <td bgcolor="#31bc86"><strong><?=$row['sum']?></strong></td>
      <?php  
        $result = mysqli_query($conexion,'SELECT SUM(LT) AS sum FROM pgl'); 
        $row = mysqli_fetch_assoc($result); 
      ?>
      <td bgcolor="#31bc86"><strong><?=$row['sum']?></strong></td>
      <?php  
        $result = mysqli_query($conexion,'SELECT SUM(Alimentadores_AT) AS sum FROM pgl'); 
        $row = mysqli_fetch_assoc($result); 
      ?>
      <td bgcolor="#31bc86"><strong><?=$row['sum']?></strong></td>
      <?php  
        $result = mysqli_query($conexion,'SELECT SUM(Alimentadores_MT) AS sum FROM pgl'); 
        $row = mysqli_fetch_assoc($result); 
      ?>
      <td bgcolor="#31bc86"><strong><?=$row['sum']?></strong></td>
      <?php  
        $result = mysqli_query($conexion,'SELECT SUM(MVA) AS sum FROM pgl'); 
        $row = mysqli_fetch_assoc($result); 
      ?>
      <td bgcolor="#31bc86"><strong><?=$row['sum']?></strong></td>
      <?php  
        $result = mysqli_query($conexion,'SELECT SUM(MVAr) AS sum FROM pgl'); 
        $row = mysqli_fetch_assoc($result); 
      ?>
      <td bgcolor="#31bc86"><strong><?=$row['sum']?></strong></td>
      <?php  
        $result = mysqli_query($conexion,'SELECT SUM(KmC) AS sum FROM pgl'); 
        $row = mysqli_fetch_assoc($result); 
      ?>
      <td bgcolor="#31bc86"><strong><?=$row['sum']?></strong></td>
      <?php  
        $result = mysqli_query($conexion,'SELECT SUM(Numero_Aliment) AS sum FROM pgl'); 
        $row = mysqli_fetch_assoc($result); 
      ?>
      <td bgcolor="#31bc86"><strong><?=$row['sum']?></strong></td>
      <?php  
        $result = mysqli_query($conexion,'SELECT SUM(Medidores) AS sum FROM pgl'); 
        $row = mysqli_fetch_assoc($result); 
      ?>
      <td bgcolor="#31bc86"><strong><?=$row['sum']?></strong></td>
      <?php  
        $result = mysqli_query($conexion,'SELECT SUM(Transformadores_Distribucion) AS sum FROM pgl'); 
        $row = mysqli_fetch_assoc($result); 
      ?>
      <td bgcolor="#31bc86"><strong><?=$row['sum']?></strong></td>
      <?php  
        $result = mysqli_query($conexion,'SELECT SUM(Postes) AS sum FROM pgl'); 
        $row = mysqli_fetch_assoc($result); 
      ?>
      <td bgcolor="#31bc86"><strong><?=$row['sum']?></strong></td>
      <td bgcolor="#31bc86" colspan="14"></td>
      <?php  
        $result = mysqli_query($conexion,'SELECT SUM(Act_Prev_Inv) AS sum FROM pgl'); 
        $row = mysqli_fetch_assoc($result); 
      ?>
      <td bgcolor="#31bc86"><strong>$<?=$row['sum']?></strong></td>
      <?php  
        $result = mysqli_query($conexion,'SELECT SUM(Monto_Max_Publicado) AS sum FROM pgl'); 
        $row = mysqli_fetch_assoc($result); 
      ?>
      <td bgcolor="#31bc86"><strong>$<?=$row['sum']?></strong></td>
      <?php  
        $result = mysqli_query($conexion,'SELECT SUM(Monto_Adjudicado) AS sum FROM pgl'); 
        $row = mysqli_fetch_assoc($result); 
        mysqli_free_result($result);
        mysqli_close($conexion);
      ?>
      <td bgcolor="#31bc86"><strong>$<?=$row['sum']?></strong></td>
      <td bgcolor="#31bc86"></td>
    </tr>
    </tbody>
  </table>

</body>
</html>

