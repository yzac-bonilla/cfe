<?php
  session_start();
  if (!isset($_SESSION['usuario'])) {header('Location:../../index.html');}
  $id=$_GET['id'];
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

<div class="container">

  <div class="jumbotron">
    <h1>Normalización</h1>
    <p>Compras Consolidadas</p>
  </div>
  <h2>Actualizar Registro</h2>

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
      if ($permisos_bd!="Administrador") 
      {
        ?>
        <div class="container">
        <div class="alert alert-danger">
          <data-dismiss="alert"><strong>Acceso Denegado: </strong>Usted no cuenta con permisos de administrador.
        </div>
        <div class="panel-heading"> 
        <ul class="pager">
          <li class="previous"><a href="Consulta_CC.php">Regresar</a></li>
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
        <li class="previous"><a href="Consulta_CC.php">Regresar</a></li>
      </ul>
      </div>
      </div>
      <?php
      die();
  }
?>

  <?php
  $result=mysqli_query($conexion,"SELECT * FROM cc WHERE Solped='$id'");
  while($row=mysqli_fetch_array($result))
  {
  ?>
  <form action="Update_CC.php">
  <div class="row">
  <div class="col-sm-3">
    <br>Solped: <input type="text" class="form-control" name="solped" min="0" step="any" value="<?=$row["Solped"]?>" required readonly>
  </div>
  <div class="col-sm-6">
    <br>Familia: <input type="text" class="form-control" name="familia" value="<?=$row["Familia"]?>" autofocus>
  </div>
  <div class="col-sm-3">
    <br>Piezas: <input type="number" class="form-control" name="piezas" min="0" step="any" value="<?=$row["Piezas"]?>" required>
  </div>
  </div>
  <div class="row">
  <div class="col-sm-3">
    <br>Importe: <input type="number" class="form-control" name="importe" min="0" step="any" value="<?=$row["Importe"]?>" required>
  </div>
  <div class="col-sm-3">
    <br>Junta de Aclaraciones: <input type="text" class="form-control" name="junta" value="<?=$row["Junta"]?>">
  </div>
  <div class="col-sm-3">
    <br>Fallo: <input type="text" class="form-control" name="fallo" value="<?=$row["Fallo"]?>">
  </div>
  <div class="col-sm-3">
    <br>Contrato: <input type="text" class="form-control" name="contrato" value="<?=$row["Contrato"]?>">
  </div>
  </div>
    <input type="hidden" name="id" value=<?=$id?> />
    <br><br><center><button type="submit" value="Actualizar" class="btn btn-primary">Actualizar</button>
    <a href="Actualizar_Registro_CC.php" class="btn btn-primary">Cancelar</a></center><br>
  </form>
  <?php
  }
  mysqli_free_result($query);
  mysqli_free_result($result);
  mysqli_close($conexion);
  ?>

  <div class="panel-heading"> 
    <ul class="pager">
      <li class="previous"><a href="Actualizar_Registro_CC.php">Regresar</a></li>
    </ul>
  </div>

</div>

</font>
</body>
</html>