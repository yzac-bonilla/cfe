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
  $no = $_POST['no'];
  $proyecto = $_POST['proyecto'];
  $entidad = $_POST['entidad'];
  $division = $_POST['division'];
  $obras = $_POST['obras'];
  $se = $_POST['se'];
  $lt = $_POST['lt'];
  $aliment_at = $_POST['aliment_at'];
  $aliment_mt = $_POST['aliment_mt'];
  $mva = $_POST['mva'];
  $mvar = $_POST['mvar'];
  $kmc = $_POST['kmc'];
  $num_aliment = $_POST['num_aliment'];
  $medidores = $_POST['medidores'];
  $transf_dist = $_POST['transf_dist'];
  $postes = $_POST['postes'];
  $difusion_proy = $_POST['difusion_proy'];
  $pub_conv = $_POST['pub_conv'];
  $visita_sitio = $_POST['visita_sitio'];
  $inicio_junta_1 = $_POST['inicio_junta_1'];
  $cierre_junta_1 = $_POST['cierre_junta_1'];
  $inicio_junta_2 = $_POST['inicio_junta_2'];
  $cierre_junta_2 = $_POST['cierre_junta_2'];
  $inicio_junta_3 = $_POST['inicio_junta_3'];
  $cierre_junta_3 = $_POST['cierre_junta_3'];
  $inicio_junta_4 = $_POST['inicio_junta_4'];
  $cierre_junta_4 = $_POST['cierre_junta_4'];
  $recepcion_prop = $_POST['recepcion_prop'];
  $fallo = $_POST['fallo'];
  $firma_contrato = $_POST['firma_contrato'];
  $inicio_const = $_POST['inicio_const'];
  $termino_const = $_POST['termino_const'];
  $act_prev = $_POST['act_prev'];
  $monto_max = $_POST['monto_max'];
  $monto_adjudicado = $_POST['monto_adjudicado'];
  $empresa_ganador = $_POST['empresa_ganador'];

  if ($se == NULL) {$se = 0;}
  if ($lt == NULL) {$lt = 0;}
  if ($aliment_at == NULL) {$aliment_at = 0;}
  if ($aliment_mt == NULL) {$aliment_mt = 0;}
  if ($mva == NULL) {$mva = 0;}
  if ($mvar == NULL) {$mvar = 0;}
  if ($kmc == NULL) {$kmc = 0;}
  if ($num_aliment == NULL) {$num_aliment = 0;}
  if ($medidores == NULL) {$medidores = 0;}
  if ($transf_dist == NULL) {$transf_dist = 0;}
  if ($postes == NULL) {$postes = 0;}
  if ($act_prev == NULL) {$act_prev = 0;}
  if ($monto_max == NULL) {$monto_max = 0;}
  if ($monto_adjudicado == NULL) {$monto_adjudicado = 0;}

  $replaced_1 = str_replace("/","-",$difusion_proy);
  $replaced_2 = str_replace("/","-",$pub_conv);
  $replaced_3 = str_replace("/","-",$visita_sitio);
  $replaced_4 = str_replace("/","-",$inicio_junta_1);
  $replaced_5 = str_replace("/","-",$cierre_junta_1);
  $replaced_6 = str_replace("/","-",$inicio_junta_2);
  $replaced_7 = str_replace("/","-",$cierre_junta_2);
  $replaced_8 = str_replace("/","-",$inicio_junta_3);
  $replaced_9 = str_replace("/","-",$cierre_junta_3);
  $replaced_10 = str_replace("/","-",$inicio_junta_4);
  $replaced_11 = str_replace("/","-",$cierre_junta_4);
  $replaced_12 = str_replace("/","-",$recepcion_prop);
  $replaced_13 = str_replace("/","-",$fallo);
  $replaced_14 = str_replace("/","-",$firma_contrato);
  $replaced_15 = str_replace("/","-",$inicio_const);
  $replaced_16 = str_replace("/","-",$termino_const);

	$sql="INSERT INTO pgl (No,Proyecto,Entidad_Federativa,Division,Obras,SE,LT,Alimentadores_AT,Alimentadores_MT,MVA,MVAr,kmC,Numero_Aliment,Medidores,Transformadores_Distribucion,Postes,Difusion_Proyecto_Convocatoria,Publicacion_Convocatoria,Visita_Sitio,Inicio_Primera_Junta,Cierre_Primera_Junta,Inicio_Segunda_Junta,Cierre_Segunda_Junta,Inicio_Tercera_Junta,Cierre_Tercera_Junta,Inicio_Cuarta_Junta,Cierre_Cuarta_Junta,Recepcion_Propuesta,Fallo,Firma_Contrato,Inicio_Construccion,Termino_Construccion,Act_Prev_Inv,Monto_Max_Publicado,Monto_Adjudicado,Empresa_Consorcio_Ganador) VALUES ('$no', '$proyecto','$entidad','$division','$obras','$se','$lt','$aliment_at','$aliment_mt','$mva','$mvar','$kmc','$num_aliment','$medidores','$transf_dist','$postes','$replaced_1','$replaced_2','$replaced_3','$replaced_4','$replaced_5','$replaced_6','$replaced_7','$replaced_8','$replaced_9','$replaced_10','$replaced_11','$replaced_12','$replaced_13','$replaced_14','$replaced_15','$replaced_16','$act_prev','$monto_max','$monto_adjudicado','$empresa_ganador');";
	if ($conexion->query($sql) === TRUE) 
	{
      include ("../../Usuarios/Historial.php");
      $actividad = "Creación de un nuevo registro en Programa General de Licitaciones.";
      historial($actividad,$conexion);
      mysqli_close($conexion);
    	header('Location:Consulta_PGL.php');
      //echo '<center>'.'<font color="red">'."Nuevo registro creado satisfactoriamente.".'</center>';
	} 
	else 
	{
    	echo '<font color="red"><b>ERROR:</b> ' .'</font><br>' . $sql . '<br><font color="green">'.$conexion->error.'</font>'."<font color='Navy'><br>Asegúrese de que cada campo contenga caracteres válidos según su tipo de dato.<br><br></font>";
	}
	mysqli_close($conexion);
?>

</font>
</body>
</html>
