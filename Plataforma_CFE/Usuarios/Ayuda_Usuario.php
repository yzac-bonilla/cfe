<?php
  session_start();
  if (!isset($_SESSION['usuario'])) {header('Location:../index.html');}
?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Base de datos</title>
  <link rel="stylesheet" href="../api/css/bootstrap.min.css">
  <link rel="stylesheet" type="text/css" href="../api/css/styles.css" />
  <link type="image/x-icon" href="../api/img/favicon.ico" rel="icon" />
  <script src="../api/js/jquery.min.js"></script>
  <script src="../api/js/bootstrap.min.js"></script>
  <script src="../api/js/jquery.ba-throttle-debounce.min.js"></script>
  <script src="../api/js/jquery.stickyheader.js"></script>
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
      <a class="navbar-brand" href="http://www.cfe.gob.mx/paginas/home.aspx"><img class="img-responsive" src="../api/img/logohome1.png" alt="logo" height="120" width="100"></a>
    </div>
    <div id="navbar" class="collapse navbar-collapse">
    <ul class="nav navbar-nav">
      <li class="active"><a href="../home.php">Inicio</a></li>
      <li class="dropdown"><a class="dropdown-toggle" data-toggle="dropdown" href="#">Normalización<span class="caret"></span></a>
        <ul class="dropdown-menu">
          <li><a href="../Normalizacion/CC/CC.php">Compras Consolidadas</a></li>
          <li><a href="../Normalizacion/CN/Conformidad_Normativa.php">Conformidad Normativa</a></li>
        </ul>
      </li>
      <li class="dropdown"><a class="dropdown-toggle" data-toggle="dropdown" href="#">Construccción<span class="caret"></span></a>
        <ul class="dropdown-menu">
          <li><a href="../Construccion/PGL/OPF.php">Obras Publicas Financiadas</a></li>
          <li><a href="../Construccion/Inversion/Inversion.php">Inversión</a></li>
        </ul>
      </li>
    </ul>
    <ul class="nav navbar-nav navbar-right">
      <li class="dropdown"><a class="dropdown-toggle" data-toggle="dropdown" href="#"><span class="glyphicon glyphicon-user"></span> <?=$_SESSION['usuario']?><span class="caret"></span></a>
        <ul class="dropdown-menu">
        <li><a href="Cerrar_Sesion.php"><span class="glyphicon glyphicon-log-out"></span> Cerrar Sesión</a></li>
        </ul>
      </li>
    </ul>
    </div>
  </div>
</nav>

<div class="container">

  <div class="jumbotron">
    <h1>Usuarios</h1>
    <p>Ayuda con tipos de usuario.</p>      
  </div>     

</div>

<section>
<font size="2">
<table class="overflow-y">
    <thead>
    <tr>
      <th>Tipo de usuario</th>
      <th>Consulta de información</th>
      <th>Crear registros</th>
      <th>Modificar registros</th>
      <th>Eliminar registros</th>
      <th>Imprimir registros</th>
      <th>Subir documentos PDF</th>
      <th>Subir registros CSV</th>
      <th>Descargar documentos PDF y XLSX</th>
      <th>Crear base de datos</th>
      <th>Eliminar base de datos</th>
      <th>Crear usuarios</th>
      <th>Modificar usuarios</th>
      <th>Eliminar usuarios</th>
      <th>Ver historial de usuarios e invitados</th>
    </tr>
    </thead>
    <tbody>
    <tr>
      <th>admin</th>
      <td><span class="glyphicon glyphicon-ok"></span></td>
      <td><span class="glyphicon glyphicon-ok"></span></td>
      <td><span class="glyphicon glyphicon-ok"></span></td>
      <td><span class="glyphicon glyphicon-ok"></span></td>
      <td><span class="glyphicon glyphicon-ok"></span></td>
      <td><span class="glyphicon glyphicon-ok"></span></td>
      <td><span class="glyphicon glyphicon-ok"></span></td>
      <td><span class="glyphicon glyphicon-ok"></span></td>
      <td><span class="glyphicon glyphicon-ok"></span></td>
      <td><span class="glyphicon glyphicon-ok"></span></td>
      <td><span class="glyphicon glyphicon-ok"></span></td>
      <td><span class="glyphicon glyphicon-ok"></span></td>
      <td><span class="glyphicon glyphicon-ok"></span></td>
      <td><span class="glyphicon glyphicon-ok"></span></td>
    </tr>
    <tr>
      <th>Administrador</th>
      <td><span class="glyphicon glyphicon-ok"></span></td>
      <td><span class="glyphicon glyphicon-ok"></span></td>
      <td><span class="glyphicon glyphicon-ok"></span></td>
      <td><span class="glyphicon glyphicon-ok"></span></td>
      <td><span class="glyphicon glyphicon-ok"></span></td>
      <td><span class="glyphicon glyphicon-ok"></span></td>
      <td><span class="glyphicon glyphicon-ok"></span></td>
      <td><span class="glyphicon glyphicon-ok"></span></td>
      <td><span class="glyphicon glyphicon-ok"></span></td>
      <td></td>
      <td></td>
      <td></td>
      <td></td>
      <td><span class="glyphicon glyphicon-ok"></span></td>
    </tr>
    <tr>
      <th>Limitado</th>
      <td><span class="glyphicon glyphicon-ok"></span></td>
      <td><span class="glyphicon glyphicon-ok"></span></td>
      <td><span class="glyphicon glyphicon-ok"></span></td>
      <td></td>
      <td><span class="glyphicon glyphicon-ok"></span></td>
      <td><span class="glyphicon glyphicon-ok"></span></td>
      <td></td>
      <td><span class="glyphicon glyphicon-ok"></span></td>
      <td></td>
      <td></td>
      <td></td>
      <td></td>
      <td></td>
      <td></td>
    </tr>
    <tr>
      <th>Invitado</th>
      <td><span class="glyphicon glyphicon-ok"></span></td>
      <td></td>
      <td></td>
      <td></td>
      <td><span class="glyphicon glyphicon-ok"></span></td>
      <td></td>
      <td></td>
      <td><span class="glyphicon glyphicon-ok"></span></td>
      <td></td>
      <td></td>
      <td></td>
      <td></td>
      <td></td>
      <td></td>
    </tr>
    </tbody>
  </table>
  </font>
</section>

</font>
</body>
</html>

