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

<div class="container">

  <div class="jumbotron">
    <h1>Normalización</h1>
    <p>Reunión con los provedores</p>      
  </div> 
  <h2>Subir documento PDF, Word, PowerPoint,Excel o Imagen</h2><br>  

<?php
  include ("../../api/php/Conexion_Plataforma.php");
  $conexion = Conectar();
  $usuario = $_SESSION['usuario'];
  $query = mysqli_query($conexion,"SELECT * FROM usuarios WHERE Usuario='$usuario'");
  $numrows = mysqli_num_rows($query);
  if ($numrows!==0) 
  {
      while ($row = mysqli_fetch_assoc($query)) 
      {
        $permisos_bd = $row['Permisos'];
      }
      if ($permisos_bd!="Administrador" && $permisos_bd!="Limitado") 
      {
        ?>
        <div class="container">
        <div class="alert alert-danger">
          <data-dismiss="alert"><strong>Acceso Denegado: </strong>Usted no cuenta con permisos de administrador.
        </div>
        <div class="panel-heading"> 
        <ul class="pager">
          <li class="previous"><a href="Reunion_Provedores_CN.php">Regresar</a></li>
        </ul>
        </div>
        </div>
        <?php
        die();
      }
  }
  else
  {
      ?>
      <div class="container">
      <div class="alert alert-danger">
      <data-dismiss="alert"><strong>Acceso Denegado: </strong>Los Invitados no cuentan con permisos de administrador.
      </div>
      <div class="panel-heading"> 
      <ul class="pager">
        <li class="previous"><a href="Reunion_Provedores_CN.php">Regresar</a></li>
      </ul>
      </div>
      </div>
      <?php
      die();
  }
?> 

  <form action="Upload_Documento_RP.php" method="post" enctype="multipart/form-data">
    <select class="form-control" name="id" autofocus>
      <option value="NO ESPECIFICADO" selected>Seleccionar registro</option>
      <?php
      $filtro=mysqli_query($conexion,"SELECT * FROM cn_reunion_provedor ORDER BY Id DESC");
      while($fila=mysqli_fetch_array($filtro))
      {
          ?>
          <option value="<?=$fila['Id']?>"><?=$fila['Id']?>.- <?=$fila["Provedor"]?> / <?=$fila["Tema"]?> / (<?=$fila["Fecha"]?>)</option>
          <?php
      }
      mysqli_free_result($filtro);
      mysqli_free_result($query);
      mysqli_close($conexion);
      ?>
    </select>
    <br><select class="form-control" name="campo">
      <option value="NO ESPECIFICADO" selected>Seleccionar campo</option>
      <option value="Documentacion">Información de la Reunión</option>
      <option value="Nota_Informativa">Nota Informativa</option>
    </select>
    <br><input type="file" class="form-control" accept=".pdf,.docx,.doc,.xlsx,.xls,.xlsm,.pptx,.ppt,image/*" name="fileToUpload" id="fileToUpload">
    <br><center><input type="submit" value="Subir documento" name="submit" class="btn btn-primary">
    <a href="Reunion_Provedores_CN.php" class="btn btn-primary">Cancelar</a></center><br>
  </form>

  <div class="panel-heading"> 
    <ul class="pager">
      <li class="previous"><a href="Reunion_Provedores_CN.php">Regresar</a></li>
    </ul>
  </div>

</div>

</font>
</body>
</html>

