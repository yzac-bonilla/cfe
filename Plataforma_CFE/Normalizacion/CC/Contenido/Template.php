<?php
  session_start();
  if (!isset($_SESSION['usuario'])) 
  {
    header('Location:../../../../index.html');
  }
?>

<!DOCTYPE html>
<html lang="es">
<head>
  <title>Base de datos</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="../../../../css/bootstrap.min.css">
  <link type="image/x-icon" href="../../../../img/favicon.ico" rel="icon" />
  <script src="../../../../js/jquery.min.js"></script>
  <script src="../../../../js/bootstrap.min.js"></script>
  <style>
	  body {
	    background-image: url("../../../../img/contenido_fondotextura.jpg");
	  }
  </style>
</head>
<body>
<font size=4>

<nav class="navbar navbar-inverse">
  <div class="container-fluid">
    <div class="navbar-header">
      <a class="navbar-brand" href="http://www.cfe.gob.mx/paginas/home.aspx"><img class="img-responsive" src="../../../../img/logohome1.png" alt="logo" height="120" width="100"></a>
    </div>
    <ul class="nav navbar-nav">
      <li class="active"><a href="../../../home.php">Inicio</a></li>
      <li class="dropdown"><a class="dropdown-toggle" data-toggle="dropdown" href="#">Normalización<span class="caret"></span></a>
        <ul class="dropdown-menu">
          <li><a href="../../CC/CC.php">Compras Consolidadas</a></li>
          <li><a href="../../CN/Conformidad_Normativa.php">Conformidad Normativa</a></li>
        </ul>
      </li>
      <li class="dropdown"><a class="dropdown-toggle" data-toggle="dropdown" href="#">Construccción<span class="caret"></span></a>
        <ul class="dropdown-menu">
          <li><a href="../../../Construccion/PGL/OPF.php">Obras Publicas Financiadas</a></li>
          <li><a href="../../../Construccion/Inversion/Inversion.php">Inversión</a></li>
        </ul>
      </li>
    </ul>
    <ul class="nav navbar-nav navbar-right">
      <li class="dropdown"><a class="dropdown-toggle" data-toggle="dropdown" href="#"><span class="glyphicon glyphicon-user"></span> <?=$_SESSION['usuario']?><span class="caret"></span></a>
        <ul class="dropdown-menu">
        <li><a href="../../../Usuarios/Cerrar_Sesion.php"><span class="glyphicon glyphicon-log-out"></span> Cerrar Sesión</a></li>
        </ul>
      </li>
    </ul>
  </div>
</nav>

<div class="container">
  <div class="jumbotron">
    <h1>Normalización</h1>
    <p>Información</p>      
  </div>     
</div>

<div class="container">

  <iframe width="100%" height="750px" src="pdf/Prueba.pdf" name="iframe_a"></iframe>
  <p><a href="http://www.cfe.gob.mx/paginas/Home.aspx" target="iframe_a">cfe.gob.mx</a></p>


  <div class="panel-heading"> 
    <ul class="pager">
      <li class="previous"><a href="../Consulta_CC.php">Regresar</a></li>
    </ul>
  </div>

</div>

<div class="panel panel-default">
  <div class="panel-footer"><marquee>.: Comisión Federal de Electricidad :. </marquee></div>
</div>

</font>
</body>
</html>