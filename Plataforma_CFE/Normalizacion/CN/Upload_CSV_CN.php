<?php
   session_start();
   if (!isset($_SESSION['usuario'])) {header('Location:../../index.html');}
   $año = $_POST['id'];
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

<div class="panel-heading"> 
    <ul class="pager">
      <li class="previous"><a href="Base_Datos_CN.php?id=<?=$año?>">Regresar</a></li>
    </ul>
</div>

<?php
include ("../../api/php/Conexion_Plataforma.php");
$conexion = Conectar();
$tipo = $_FILES['archivo']['type'];
$tamanio = $_FILES['archivo']['size'];
$archivotmp = $_FILES['archivo']['tmp_name'];
$lineas = file($archivotmp);
$base_datos = "bd_".$año;
$i=0;
foreach ($lineas as $linea_num => $linea)
{ 
   if($i != 0) 
   { 
      $datos = explode(",",$linea);
      $id = trim($datos[0]);
      $fecha_Recepción = trim($datos[1]);
      $especificacion = trim($datos[2]);
      $sello = trim($datos[3]);
      $empresa = trim($datos[4]);
      $remitente = trim($datos[5]);
      $familia = trim($datos[6]);
      $responsable = trim($datos[7]);
      $status = trim($datos[8]);
      $oficio = trim($datos[9]);
      $fecha_oficio = trim($datos[10]);
      $fecha_atencion = trim($datos[11]);
      $oficios_atendidos = trim($datos[12]);
      $plan_piloto = trim($datos[13]);  
      $tiempo_respuesta = trim($datos[14]); 
      $baja_sao = trim($datos[15]);
      if (isset($datos[16])) {$total_saos = trim($datos[16]);}
      else {$total_saos = 1;}
      if ($oficios_atendidos == NULL) {$oficios_atendidos = 0;}
      if ($tiempo_respuesta == NULL) {$tiempo_respuesta = 0;}
      if ($total_saos == NULL) {$total_saos = 1;}
 
      $sql="INSERT INTO $base_datos (Id,Fecha_Recepcion,Especificacion,Sello,Empresa,Remitente,Familia,Responsable,Status,Oficio,Fecha_Oficio,Fecha_Atencion,Oficios_Atendidos,Plan_Piloto,Tiempo_Respuesta,Baja_SAO,Total_SAOs) VALUES ('$id','$fecha_Recepción','$especificacion','$sello','$empresa','$remitente','$familia','$responsable','$status','$oficio','$fecha_oficio','$fecha_atencion','$oficios_atendidos','$plan_piloto','$tiempo_respuesta','$baja_sao','$total_saos');";
      if ($conexion->query($sql) === TRUE) 
      {
        //echo "Base de datos subida satisfactoriamente.";
      } 
      else 
      {
        echo '<font color="red"><b>ERROR:</b> ' .'</font><br>' . $sql . '<br><font color="green">'.$conexion->error.'</font>'."<font color='Navy'><br>Asegúrese de que el documneto csv contenga las mismas columnas que la tabla de la página web y que su contenido corresponda con cada una, que los campos no contengan comas o comillas, que no se repita el mismo numero para el campo Id, que cada campo contenga caracteres válidos según el tipo de dato para cada columna.<br><br></font>";
      }
   }
   $i++;
}
include ("../../Usuarios/Historial.php");
$actividad = "Subir registros mediante un documento .csv a la base de datos ".$año." de Conformidad Normativa.";
historial($actividad,$conexion);
mysqli_close($conexion);
//header("Location: Base_Datos_CN.php?id=$año");
?>

<div class="container">
  <div class="alert alert-success">
      <data-dismiss="alert"><center><strong>Archivo subido. </strong></center>
  </div>
</div>

</font>
</body>
</html>
