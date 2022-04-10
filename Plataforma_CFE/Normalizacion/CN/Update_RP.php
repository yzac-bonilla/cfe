<?php
  session_start();
  if (!isset($_SESSION['usuario'])) {header('Location:../../index.html');}
  $no=$_POST['id'];
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
      <li class="previous"><a href="Actualizar_RP.php?id=<?=$no?>">Regresar</a></li>
    </ul>
</div>

<?php
  include ("../../api/php/Conexion_Plataforma.php");
  $conexion = Conectar();
  $fecha = $_POST['fecha'];
  $otro_provedor = $_POST['otro_provedor'];
  $otro_tema = $_POST['otro_tema'];
  $provedor_existente = $_POST['provedor'];
  $tema_existente =  $_POST['tema'];
  $si_no = $_POST['si_no'];

  if ($otro_provedor == NULL) {$provedor = $provedor_existente;}
  else{$provedor = $otro_provedor;}
  if ($otro_tema == NULL) {$tema = $tema_existente;}
  else{$tema = $otro_tema;}

  $date = str_replace("/","-",$fecha);
  
  include ("../../Usuarios/Historial.php");
  $actividad = "Actualización de un registro en reunión con los provedores de Conformidad Normativa.";
  historial($actividad,$conexion);
  $sql=mysqli_query($conexion,"UPDATE cn_reunion_provedor SET Fecha='$date', Provedor='$provedor', Tema='$tema', Si_No='$si_no' WHERE Id='$no'",header("Location: Reunion_Provedores_CN.php"));
  /*if ($conexion->query($sql) === TRUE) 
      {
      	header("Location: Reunion_Provedores_CN.php");
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