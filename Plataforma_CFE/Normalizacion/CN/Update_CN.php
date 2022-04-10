<?php
  session_start();
  if (!isset($_SESSION['usuario'])) {header('Location:../../index.html');}
  $año = $_POST['id'];
  $base_datos = "bd_".$año;
  $reg=$_POST['reg'];
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
  $sao = $_POST['sao'];
  $fecha_recepcion = $_POST['fecha_recepcion'];
  $especificacion =  $_POST['especificacion'];
  $sello = $_POST['sello'];
  $empresa = $_POST['empresa'];
  $remitente = $_POST['remitente'];
  $familia = $_POST['familia'];
  $responsable = $_POST['responsable'];
  $status = $_POST['status'];
  $oficio = $_POST['oficio'];
  $fecha_oficio = $_POST['fecha_oficio'];
  $fecha_atencion = $_POST['fecha_atencion'];
  $oficios_atendidos = $_POST['oficios_atendidos'];
  $plan_piloto = $_POST['plan_piloto'];   
  $total_saos = $_POST['total_saos'];
  $baja_sao = $_POST['baja_sao'];
  
  if ($oficio == NULL){$status = "PENDIENTE";} 
  else{$status = "ATENDIDO";}
  $dato1 = explode("/",$fecha_recepcion);
  $reg1 = trim($dato1[0]);
  $dato2 = explode("/",$fecha_atencion);
  $reg2 = trim($dato2[0]); 
  if ($fecha_atencion != NULL && $fecha_recepcion != NULL){$tiempo_respuesta = $reg2-$reg1;}
  else{$tiempo_respuesta=0;}
  if ($oficios_atendidos == NULL) {$oficios_atendidos = 0;}
  if ($tiempo_respuesta == NULL) {$tiempo_respuesta = 0;}
  if ($total_saos == NULL) {$total_saos = 1;}
  
  include ("../../Usuarios/Historial.php");
  $actividad = "Actualización de un registro en la base de datos ".$año." en Conformidad Normativa.";
  historial($actividad,$conexion);
  $sql=mysqli_query($conexion,"UPDATE $base_datos SET Fecha_Recepcion='$fecha_recepcion', Especificacion='$especificacion', Sello='$sello', Empresa='$empresa', Remitente='$remitente', Familia='$familia', Responsable='$responsable', Status='$status', Oficio='$oficio', Fecha_Oficio='$fecha_oficio', Fecha_Atencion='$fecha_atencion', Oficios_Atendidos='$oficios_atendidos', Plan_Piloto='$plan_piloto', Tiempo_Respuesta='$tiempo_respuesta', Baja_SAO='$baja_sao', Total_SAOs='$total_saos' WHERE Id='$reg'",header("Location: Base_Datos_CN.php?id=$año"));
  /*if ($conexion->query($sql) === TRUE) 
      {
      	header("Location: Actualizar_Registro_CN.php");
        //echo "Registro actualizado satisfactoriamente.";
      } 
  else 
      {
        echo '<font color="red"><b>ERROR:</b> ' .'</font><br>' . $sql . '<br><font color="green">'.$conexion->error.'</font>'."<font color='Navy'><br>Asegúrese de que cada campo contenga caracteres válidos según su tipo de dato.<br><br></font>";
      }*/
  mysqli_close($conexion);
?>

</font>
</body>
</html>