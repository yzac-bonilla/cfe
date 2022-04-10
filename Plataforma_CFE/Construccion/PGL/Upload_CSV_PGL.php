<?php
  session_start();
  if (!isset($_SESSION['usuario'])) {header('Location:../../index.html');}
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
          <li><a href="../../Normalizacion/CC/CC.php">Compras Consolidadas</a></li>
          <li><a href="../../Normalizacion/CN/Conformidad_Normativa.php">Conformidad Normativa</a></li>
        </ul>
      </li>
      <li class="dropdown"><a class="dropdown-toggle" data-toggle="dropdown" href="#">Construccción<span class="caret"></span></a>
        <ul class="dropdown-menu">
          <li><a href="OPF.php">Obras Publicas Financiadas</a></li>
          <li><a href="../Inversion/Inversion.php">Inversión</a></li>
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
      <li class="previous"><a href="Consulta_PGL.php">Regresar</a></li>
    </ul>
</div>

<?php
include ("../../api/php/Conexion_Plataforma.php");
$conexion = Conectar();
$tipo = $_FILES['archivo']['type'];
$tamanio = $_FILES['archivo']['size'];
$archivotmp = $_FILES['archivo']['tmp_name'];
$lineas = file($archivotmp);
$i=0;

foreach ($lineas as $linea_num => $linea)
{ 
   if($i != 0) 
   { 
      $datos = explode(",",$linea);
      $no = trim($datos[0]);
      $proyecto = trim($datos[1]);
      $entidad = trim($datos[2]);
      $division = trim($datos[3]);
      $obras = trim($datos[4]);
      $se = trim($datos[5]);
      $lt = trim($datos[6]);
      $aliment_at = trim($datos[7]);
      $aliment_mt = trim($datos[8]);
      $mva = trim($datos[9]);
      $mvar = trim($datos[10]);
      $kmc = trim($datos[11]);
      $num_aliment = trim($datos[12]);
      $medidores = trim($datos[13]);
      $transf_dist = trim($datos[14]);
      $postes = trim($datos[15]);
      $difusion_proy = trim($datos[16]);
      $pub_conv = trim($datos[17]);
      $visita_sitio = trim($datos[18]);
      $inicio_junta_1 = trim($datos[19]);
      $cierre_junta_1 = trim($datos[20]);
      $inicio_junta_2 = trim($datos[21]);
      $cierre_junta_2 = trim($datos[22]);
      $inicio_junta_3 = trim($datos[23]);
      $cierre_junta_3 = trim($datos[24]);
      $recepcion_prop = trim($datos[25]);
      $fallo = trim($datos[26]);
      $firma_contrato = trim($datos[27]);
      $inicio_const = trim($datos[28]);
      $termino_const = trim($datos[29]);
      $act_prev = trim($datos[30]);
      $monto_max = trim($datos[31]);
      $monto_adjudicado = trim($datos[32]);
      $empresa_ganador = trim($datos[33]);

      if ($no == NULL) {$no = 0;}
      if ($se == NULL || $se == "-") {$se = 0;}
      if ($lt == NULL || $lt == "-") {$lt = 0;}
      if ($aliment_at == NULL || $aliment_at == "-") {$aliment_at = 0;}
      if ($aliment_mt == NULL || $aliment_mt == "-") {$aliment_mt = 0;}
      if ($mva == NULL ||  == "-") {$mva = 0;}
      if ($mvar == NULL || $mva == "-") {$mvar = 0;}
      if ($kmc == NULL || $kmc == "-") {$kmc = 0;}
      if ($num_aliment == NULL || $num_aliment == "-") {$num_aliment = 0;}
      if ($medidores == NULL || $medidores == "-") {$medidores = 0;}
      if ($transf_dist == NULL || $transf_dist == "-") {$transf_dist = 0;}
      if ($postes == NULL || $postes == "-") {$postes = 0;}
      if ($act_prev == NULL || $act_prev == "-") {$act_prev = 0;}
      if ($monto_max == NULL || $monto_max == "-") {$monto_max = 0;}
      if ($monto_adjudicado == NULL || $monto_adjudicado == "-") {$monto_adjudicado = 0;}
 
       $sql="INSERT INTO pgl (No,Proyecto,Entidad_Federativa,Division,Obras,SE,LT,Alimentadores_AT,Alimentadores_MT,MVA,MVAr,kmC,Numero_Aliment,Medidores,Transformadores_Distribucion,Postes,Difusion_Proyecto_Convocatoria,Publicacion_Convocatoria,Visita_Sitio,Inicio_Primera_Junta,Cierre_Primera_Junta,Inicio_Segunda_Junta,Cierre_Segunda_Junta,Inicio_Tercera_Junta,Cierre_Tercera_Junta,Recepcion_Propuesta,Fallo,Firma_Contrato,Inicio_Construccion,Termino_Construccion,Act_Prev_Inv,Monto_Max_Publicado,Monto_Adjudicado,Empresa_Consorcio_Ganador) VALUES ('$no', '$proyecto','$entidad','$division','$obras','$se','$lt','$aliment_at','$aliment_mt','$mva','$mvar','$kmc','$num_aliment','$medidores','$transf_dist','$postes','$difusion_proy','$pub_conv','$visita_sitio','$inicio_junta_1','$cierre_junta_1','$inicio_junta_2','$cierre_junta_2','$inicio_junta_3','$cierre_junta_3','$recepcion_prop','$fallo','$firma_contrato','$inicio_const','$termino_const','$act_prev','$monto_max','$monto_adjudicado','$empresa_ganador');";
       if ($conexion->query($sql) === TRUE) 
      {
         //echo "Base de datos subida satisfactoriamente.";
      }
      else 
      {
         echo '<font color="red"><b>ERROR:</b> ' .'</font><br>' . $sql . '<br><font color="green">'.$conexion->error.'</font>'."<font color='Navy'><br>Asegúrese de que el documneto csv contenga las mismas columnas que la tabla de la página web, que los campos no contengan comas o comillas, que no se repita el mismo número para el campo Id, que cada campo contenga caracteres válidos según su tipo de dato.<br><br></font>";
      }
   }
   $i++;
}
include ("../../Usuarios/Historial.php");
$actividad = "Subió registros mediante un archivo .csv al Programa General de Licitaciones.";
historial($actividad,$conexion);
mysqli_close($conexion);
//header("Location: Consulta_PGL.php");
?>

<div class="container">
  <div class="alert alert-success">
      <data-dismiss="alert"><center><strong>Archivo subido. </strong></center>
  </div>
</div>

</font>
</body>
</html>