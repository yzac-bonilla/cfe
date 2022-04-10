<?php
  session_start();
  if (!isset($_SESSION['usuario'])) {header('Location:../../index.html');}
  $año = $_GET['id'];
?>

<!DOCTYPE HTML>
<html lang="es">
	<head>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
		<title>Base de Datos</title>
    <link rel="stylesheet" href="../../api/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="../../api/css/styles.css" />
    <link type="image/x-icon" href="../../api/img/favicon.ico" rel="icon" />
		<script type="text/javascript" src="../../api/js/jquery.min.js"></script>
    <script src="../../api/js/bootstrap.min.js"></script>
		<style type="text/css">
        ${demo.css}
		</style>

<?php
  include ("../../api/php/Conexion_Plataforma.php");
  $conexion = Conectar();
  $base_datos = "bd_".$año;
  $sql=mysqli_query($conexion,"SELECT DISTINCT Familia FROM $base_datos GROUP BY Familia");
  $familia=array("");
  $i=0;
  while($row=mysqli_fetch_array($sql))
  {
      $familia[$i]=$row["Familia"];
      $i++;
  }
  $contador=count($familia);
  $cantidad=array("");
  for ($i=0; $i < $contador; $i++) 
  {
    $sql=mysqli_query($conexion,"SELECT SUM(Total_SAOs) AS sum FROM $base_datos WHERE Familia='$familia[$i]'");
    while($row=mysqli_fetch_array($sql))
    {
        $cantidad[$i]=$row["sum"];
    }
  }
  mysqli_free_result($sql);
  mysqli_close($conexion);
?>

<script type="text/javascript">
$(function () {
    $('#container').highcharts({
        chart: {
            type: 'column'
        },
        title: {
            text: 'Solicitudes por Familia'
        },
        subtitle: {
            text: '<?=$año?>'
        },
        xAxis: {
            type: 'category',
            labels: {
                rotation: -45,
                style: {
                    fontSize: '13px',
                    fontFamily: 'Verdana, sans-serif'
                }
            }
        },
        yAxis: {
            min: 0,
            title: {
                text: 'Cantidad'
            }
        },
        legend: {
            enabled: false
        },
        tooltip: {
            pointFormat: 'Cantidad: <b>{point.y:.1f}</b>'
        },
        series: [{
            name: 'Familia',
            data: [
            <?php 
              for ($i=0; $i < $contador; $i++) 
              {
                ?>
                  ['<?=$familia[$i]?>', <?=$cantidad[$i]?>],
                <?php
              }
              ?>
            ],
            dataLabels: {
                enabled: true,
                rotation: -90,
                color: '#FFFFFF',
                align: 'right',
                format: '{point.y:.1f}', // one decimal
                y: 10, // 10 pixels down from the top
                style: {
                    fontSize: '13px',
                    fontFamily: 'Verdana, sans-serif'
                }
            }
        }]
    });
});
</script>
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
    <p>Base de Datos <?=$año?></p>      
  </div>     

<script src="../../api/js/highcharts.js"></script>
<script src="../../api/js/exporting.js"></script>

<div id="container" style="min-width: 310px; height: 600px; margin: 0 auto"></div>

  <div class="panel-heading"> 
    <ul class="pager">
      <li class="previous"><a href="Base_Datos_CN.php?id=<?=$año?>">Regresar</a></li>
    </ul>
  </div>

</div>

</font>
</body>
</html>
