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
  include ("../../Usuarios/Historial.php");
  $actividad = "Actualización de un registro en Programa General de Licitaciones.";
  historial($actividad,$conexion);
  $id=$_POST['id'];
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

  $sql=mysqli_query($conexion,"UPDATE pgl SET Proyecto='$proyecto', Entidad_Federativa='$entidad', Division='$division', Obras='$obras', SE='$se', LT='$lt', Alimentadores_AT='$aliment_at', Alimentadores_MT='$aliment_mt', MVA='$mva', MVAr='$mvar', kmC='$kmc', Numero_Aliment='$num_aliment', Medidores='$medidores', Transformadores_Distribucion='$transf_dist',Postes='$postes', Difusion_Proyecto_Convocatoria='$replaced_1', Publicacion_Convocatoria='$replaced_2', Visita_Sitio='$replaced_3', Inicio_Primera_Junta='$replaced_4', Cierre_Primera_Junta='$replaced_5', Inicio_Segunda_Junta='$replaced_6',Cierre_Segunda_Junta='$replaced_7', Inicio_Tercera_Junta='$replaced_8', Cierre_Tercera_Junta='$replaced_9', Inicio_Cuarta_Junta='$replaced_10', Cierre_Cuarta_Junta='$replaced_11',Recepcion_Propuesta='$replaced_12', Fallo='$replaced_13', Firma_Contrato='$replaced_14', Inicio_Construccion='$replaced_15', Termino_Construccion='$replaced_16', Act_Prev_Inv='$act_prev', Monto_Max_Publicado='$monto_max', Monto_Adjudicado='$monto_adjudicado', Empresa_Consorcio_Ganador='$empresa_ganador' WHERE No='$id'",header("Location: Consulta_PGL.php"));
  /*if ($conexion->query($sql) === TRUE) 
      {
      	//header("Location: Actualizar_Registro_CC.php");
        echo "Registro actualizado satisfactoriamente.";
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