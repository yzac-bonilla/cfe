<?php
  session_start();
  if (!isset($_SESSION['usuario'])) {header('Location:index.html');}
?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Base de datos</title>
  <link rel="stylesheet" href="api/css/bootstrap.min.css">
  <link rel="stylesheet" type="text/css" href="api/css/styles.css" />
  <link type="image/x-icon" href="api/img/favicon.ico" rel="icon" />
  <script src="api/js/jquery.min.js"></script>
  <script src="api/js/bootstrap.min.js"></script>
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
      <a class="navbar-brand" href="http://www.cfe.gob.mx/paginas/home.aspx"><img class="img-responsive" src="api/img/logohome1.png" alt="logo" height="120" width="100"></a>
    </div>
    <div id="navbar" class="collapse navbar-collapse">
    <ul class="nav navbar-nav">
      <li class="active"><a href="home.php">Inicio</a></li>
      <li class="dropdown"><a class="dropdown-toggle" data-toggle="dropdown" href="#">Normalización<span class="caret"></span></a>
        <ul class="dropdown-menu">
          <li><a href="Normalizacion/CC/CC.php">Compras Consolidadas</a></li>
          <li><a href="Normalizacion/CN/Conformidad_Normativa.php">Conformidad Normativa</a></li>
        </ul>
      </li>
      <li class="dropdown"><a class="dropdown-toggle" data-toggle="dropdown" href="#">Construccción<span class="caret"></span></a>
        <ul class="dropdown-menu">
          <li><a href="Construccion/PGL/OPF.php">Obras Publicas Financiadas</a></li>
          <li><a href="Construccion/Inversion/Inversion.php">Inversión</a></li>
        </ul>
      </li>
      <li class="dropdown"><a class="dropdown-toggle" data-toggle="dropdown" href="#">Contacto<span class="caret"></span></a>
        <ul class="dropdown-menu">
          <li><a href="mailto:nombre@dominio.com?subject=Sitio Web"><i>nombre@dominio.com</i></a></li>
        </ul>
      </li>
    </ul>
    <ul class="nav navbar-nav navbar-right">
      <li class="dropdown"><a class="dropdown-toggle" data-toggle="dropdown" href="#"><span class="glyphicon glyphicon-user"></span> <?=$_SESSION['usuario']?><span class="caret"></span></a>
        <ul class="dropdown-menu">
      	<li><a href="Usuarios/Cerrar_Sesion.php"><span class="glyphicon glyphicon-log-out"></span> Cerrar Sesión</a></li>
      	</ul>
      </li>
    </ul>
    </div>
  </div>
</nav>

<div class="container">

  <div class="jumbotron">
    <h1>Base de datos</h1>
    <p>Bienvenido</p>      
  </div>     

  <div class="panel-group">

  <div class="row">
  <div class="col-md-6">
    <div class="panel panel-primary">
      <div class="panel-heading">Normalización</div>
      <div class="panel-body">
        <a href="Normalizacion/CC/CC.php">- Compras Consolidadas</a><br>
        <a href="Normalizacion/CN/Conformidad_Normativa.php">- Conformidad Normativa</a>
      </div>
    </div>
  </div>
  <div class="col-md-6">
    <div class="panel panel-primary">
      <div class="panel-heading">Construcción</div>
      <div class="panel-body">
        <a href="Construccion/PGL/OPF.php">- Obras Publicas Financiadas</a><br>
        <a href="Construccion/Inversion/Inversion.php">- Inversión</a>
      </div>
    </div>
  </div>
  </div>

  <div class="row">
  <div class="col-md-6">
    <br>
    <div class="panel panel-primary">
      <div class="panel-heading">Administrador</div>
      <div class="panel-body">
        <a href="Usuarios/Consulta_Usuarios.php">- Administrar usuarios</a><br>
        <a href="Usuarios/Historial_Usuarios.php">- Actividad de usuarios</a><br>
        <a href="Usuarios/Historial_Invitados.php">- Invitados registrados</a>
      </div>
    </div>
  </div>
  </div>

  </div>
</div>

</font>
</body>
</html>