<?php
  session_start();
  if (!isset($_SESSION['usuario'])) {header('Location:../../index.html');}
  $empresa = $_POST['empresa'];
  $familia = $_POST['familia'];
  if ($empresa=="NO ESPECIFICADO" && $familia=="NO ESPECIFICADO") 
  {
    header("Location: Buscar_BD_CN.php");
  }
  if ($empresa!="NO ESPECIFICADO" && $familia!="NO ESPECIFICADO") 
  {
    $aux="AND";
  }
  else
  {
    $aux="";
  }
  if ($empresa=="NO ESPECIFICADO") 
  {
    $buscar_x="";
    $color_x="";
  }
  else
  {
    $buscar_x="Empresa like '%".$empresa."%'";
    $color_x="#cc0000";
  }
  if ($familia=="NO ESPECIFICADO") 
  {
    $buscar_y="";
    $color_y="";
  }
  else
  {
    $buscar_y="Familia like '%".$familia."%'";
    $color_y="#cc0000";
  }
?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Base de datos</title>
  <link rel="stylesheet" href="../../api/css/bootstrap.min.css">
  <link rel="stylesheet" type="text/css" href="../../api/css/styles.css" />
  <link type="image/x-icon" href="../../api/img/favicon.ico" rel="icon" />
  <script src="../../api/js/jquery.min.js"></script>
  <script src="../../api/js/bootstrap.min.js"></script>
  <script src="../../api/js/jquery.ba-throttle-debounce.min.js"></script>
  <script src="../../api/js/jquery.stickyheader.js"></script>
</head>
<body>
<font size=4>

<nav class="navbar navbar-inverse navbar-fixed-top">
  <div class="container-fluid">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="http://www.cfe.gob.mx/paginas/home.aspx"><img class="img-responsive" src="../../api/img/logohome1.png" alt="logo" height="120" width="100"></a>
    </div>
    <div id="navbar" class="collapse navbar-collapse">
    <ul class="nav navbar-nav">
      <li class="active"><a href="../../home.php">Inicio</a></li>
      <li class="dropdown"><a class="dropdown-toggle" data-toggle="dropdown" href="#">Normalización<span class="caret"></span></a>
        <ul class="dropdown-menu">
          <li><a href="../CC/CC.php">Compras Consolidadas</a></li>
          <li><a href="Conformidad_Normativa.php">Conformidad Normativa</a></li>
        </ul>
      </li>
      <li class="dropdown"><a class="dropdown-toggle" data-toggle="dropdown" href="#">Construccción<span class="caret"></span></a>
        <ul class="dropdown-menu">
          <li><a href="../../Construccion/PGL/OPF.php">Obras Publicas Financiadas</a></li>
          <li><a href="../../Construccion/Inversion/Inversion.php">Inversión</a></li>
        </ul>
      </li>
    </ul>
    <ul class="nav navbar-nav navbar-right">
      <li class="dropdown"><a class="dropdown-toggle" data-toggle="dropdown" href="#"><span class="glyphicon glyphicon-user"></span> <?=$_SESSION['usuario']?><span class="caret"></span></a>
        <ul class="dropdown-menu">
        <li><a href="../../Usuarios/Cerrar_Sesion.php"><span class="glyphicon glyphicon-log-out"></span> Cerrar Sesión</a></li>
        </ul>
      </li>
    </ul>
    </div>
  </div>
</nav>

<div class="container">

  <div class="jumbotron">
    <h1>Normalización</h1>
    <p>Conformidad Normativa</p>      
  </div> 
  <h2>Resultados de la busqueda</h2>

  <?php
      include ("../../api/php/Conexion_Plataforma.php");
      $conexion = Conectar();
      $año = array("");
      $i = 0;
      $result = mysqli_query($conexion,"SELECT * FROM cn ORDER BY Base_Datos DESC");
      while($row=mysqli_fetch_array($result))
      {
          $año[$i]=$row["Base_Datos"];
          $i++;
      }
      $contador=count($año);
      //echo "Número de bases de datos = ".$contador."<br>";
      for ($i=0; $i < $contador; $i++) 
      {
          $base_datos = "bd_".$año[$i];
          ?>
          <center><br><a href=Base_Datos_CN.php?id=<?=$año[$i]?>>Base de datos <?=$año[$i]?></a><br></center>
          <font size=2>
          <div id="imprimir">
          <table class="overflow-y" border="1">
            <thead>
            <tr>
              <th>SAO</th>
              <th>Fecha Recepción</th>
              <th>Especificación</th>
              <th>Sello</th>
              <th>Empresa</th>
              <th>Remitente</th>
              <th>Familia</th>
              <th>Responsable</th>
              <th>Status</th>
              <th>Oficio</th>
              <th>Fecha Oficio</th>
              <th>Fecha Atención</th>
              <th>Oficios Atendidos</th>
              <th>Plan Piloto</th>
              <th>Tiempo Respuesta</th>
              <th>Baja SAO</th>
            </tr>
            </thead>
            <tbody>
          <?php
          $sql=mysqli_query($conexion,"SELECT * FROM $base_datos WHERE $buscar_x $aux $buscar_y");
          while($row=mysqli_fetch_array($sql))
          {
            ?>
              <tr>
                <th><b><?=$row["Id"]?></b></th>
                <td><?=$row["Fecha_Recepcion"]?></td>
                <td><?=$row["Especificacion"]?></td>
                <td><?=$row["Sello"]?></td>
                <td><font color="<?=$color_x?>"><b><?=$row["Empresa"]?></b></font></td>
                <td><?=$row["Remitente"]?></td>
                <td><font color="<?=$color_y?>"><b><?=$row["Familia"]?></b></font></td>
                <td><?=$row["Responsable"]?></td>
                <td><?=$row["Status"]?></td>
                <td><a href="Contenido/<?=$base_datos?>/pdf/<?=$row["Oficio"]?>.pdf" target="_blank"><?=$row["Oficio"]?></a></td>
                <td><?=$row["Fecha_Oficio"]?></td>
                <td><?=$row["Fecha_Atencion"]?></td>
                <td><?=$row["Oficios_Atendidos"]?></td>
                <td><?=$row["Plan_Piloto"]?></td>
                <td><?=$row["Tiempo_Respuesta"]?></td>
                <td><?=$row["Baja_SAO"]?></td>
              </tr>
              <?php
          }
          ?>
            </tbody>
          </table>
          </div>
          </font>
          <hr>
          <?php
      }
      mysqli_free_result($sql);
      mysqli_free_result($result);
      mysqli_close($conexion);
  ?>

  <div class="panel-heading"> 
    <ul class="pager">
      <li class="previous"><a href="Buscar_BD_CN.php">Regresar</a></li>
    </ul>
  </div>

</div>

</font>
</body>
</html>