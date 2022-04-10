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
          <li><a href="CC.php">Compras Consolidadas</a></li>
          <li><a href="../CN/Conformidad_Normativa.php">Conformidad Normativa</a></li>
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
      <li class="previous"><a href="Consulta_CC.php">Regresar</a></li>
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
//echo '<table border=1>';
foreach ($lineas as $linea_num => $linea)
{ 
   if($i != 0) 
   { 
       $datos = explode(",",$linea);
       $solped = trim($datos[0]);
       $familia = trim($datos[1]);
       $piezas = trim($datos[2]);
       $importe = trim($datos[3]);
       $junta = trim($datos[4]);
       $fallo = trim($datos[5]);
       $contrato = trim($datos[6]);

       if ($piezas == NULL) {$piezas = 0;}
       if ($importe == NULL) {$importe = 0;}
 
       $sql="INSERT INTO cc (Solped,Familia,Piezas,Importe,Junta,Fallo,Contrato) VALUES ('$solped', '$familia','$piezas','$importe','$junta','$fallo','$contrato');";
       if ($conexion->query($sql) === TRUE) 
      {
         /*echo "Base de datos subida satisfactoriamente.";
         echo '<tr>'.'<td>'.$solped.'<td>';
         echo '<td>'.$familia.'<td>'; 
         echo '<td>'.$piezas.'<td>';
         echo '<td>'.$importe.'<td>';
         echo '<td>'.$junta.'<td>';
         echo '<td>'.$fallo.'<td>';
         echo '<td>'.$contrato.'<td>'.'</tr>'.'</center>';*/
      }
      else 
      {
        echo '<font color="red"><b>ERROR:</b> ' .'</font><br>' . $sql . '<br><font color="green">'.$conexion->error.'</font>'."<font color='Navy'><br>Asegúrese de que el documneto csv contenga las mismas columnas que la tabla de la página web, que los campos no contengan comas o comillas, que no se repita el mismo número para el campo Id, que cada campo contenga caracteres válidos según su tipo de dato.<br><br></font>";
      }
   }
   $i++;
}
//echo '</table>';
include ("../../Usuarios/Historial.php");
$actividad = "Subir registros mediante un documento .csv en Compras Consolidadas.";
historial($actividad,$conexion);
mysqli_close($conexion);
//header("Location: Consulta_CC.php");
?>

<div class="container">
  <div class="alert alert-success">
      <data-dismiss="alert"><center><strong>Archivo subido. </strong></center>
  </div>
</div>

</font>
</body>
</html>