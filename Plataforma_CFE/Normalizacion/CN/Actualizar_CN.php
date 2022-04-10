<?php
  session_start();
  if (!isset($_SESSION['usuario'])) {header('Location:../../index.html');}
  $X=$_GET['reg'];
  $datos = explode(",",$X);
  $reg = trim($datos[0]);
  $año = trim($datos[1]);
  $base_datos = "bd_".$año;
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
    <p>Base de Datos <?=$año?></p>      
  </div>  
  <h2>Actualizar Registro</h2><br>

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
          <li class="previous"><a href="Base_Datos_CN.php?id=<?=$año?>">Regresar</a></li>
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
        <li class="previous"><a href="Base_Datos_CN.php?id=<?=$año?>">Regresar</a></li>
      </ul>
      </div>
      </div>
      <?php
      die();
  }
?>

  <?php
  $result=mysqli_query($conexion,"SELECT * FROM $base_datos WHERE Id='$reg'");
  while($row=mysqli_fetch_array($result))
  {
  ?>
  <form action="Update_CN.php" method="POST">
  <div class="row">
  <div class="col-sm-2">
      No. de SAO: <input type="number" class="form-control" name="sao" min="0" step="any" value="<?=$row["Id"]?>" required readonly>
  </div>
  <div class="col-sm-2">
      Fecha Recepción: <input type="text" class="form-control" name="fecha_recepcion" placeholder="dd/mm/aaaa" value="<?=$row["Fecha_Recepcion"]?>">
  </div>
  <div class="col-sm-4">
      Especificación: <input type="text" class="form-control" name="especificacion" value="<?=$row["Especificacion"]?>">
  </div>
  <div class="col-sm-4">
      Familia: <input type="text" class="form-control" name="familia" value="<?=$row["Familia"]?>">
  </div>
  </div>
  <div class="row">
  <div class="col-sm-4">
      <br>Sello: <input type="text" class="form-control" name="sello" value="<?=$row["Sello"]?>">
  </div>
  <div class="col-sm-8">
      <br>Empresa: <input type="text" class="form-control" name="empresa" value="<?=$row["Empresa"]?>">
  </div>
  </div>
  <div class="row">
  <div class="col-sm-6">
      <br>Remitente: <input type="text" class="form-control" name="remitente" value="<?=$row["Remitente"]?>">
  </div>
  <div class="col-sm-6">
      <br>Responsable: <input type="text" class="form-control" name="responsable" value="<?=$row["Responsable"]?>">
  </div>
  </div>
  <div class="row">
  <div class="col-sm-2">
      <br>Oficio: <input type="text" class="form-control" name="oficio" value="<?=$row["Oficio"]?>" autofocus>
  </div>
  <div class="col-sm-2">
      <br>Fecha Oficio: <input type="text" class="form-control" name="fecha_oficio" placeholder="dd/mm/aaaa" value="<?=$row["Fecha_Oficio"]?>">
  </div>
  <div class="col-sm-2">
      <br>Fecha Atención: <input type="text" class="form-control" name="fecha_atencion" placeholder="dd/mm/aaaa" value="<?=$row["Fecha_Atencion"]?>">
  </div>
  <div class="col-sm-2">
      <br>Oficios Atendidos: <input type="number" class="form-control" min="0" step="any" value="<?=$row["Oficios_Atendidos"]?>" name="oficios_atendidos" required>
  </div>
  <div class="col-sm-2">
      <br>Plan Piloto:
      <select class="form-control" name="plan_piloto">
        <option value="No" selected>No</option>
        <option value="Si">Si</option>
      </select>
  </div>
  <div class="col-sm-2">
      <br>Baja SAO:
      <select class="form-control" name="baja_sao">
        <option value="No" selected>No</option>
        <option value="Si">Si</option>
      </select>
  </div>
  </div>
      <input type="hidden" name="tiempo_respuesta" value=<?=$row["Tiempo_Respuesta"]?> />
      <input type="hidden" name="status" value=<?=$row["Status"]?> />
      <input type="hidden" name="total_saos" value=<?=$row["Total_SAOs"]?> />
      <input type="hidden" name="id" value=<?=$año?> />
      <input type="hidden" name="reg" value=<?=$reg?> />
    <br><br><center><button type="submit" value="Actualizar" class="btn btn-primary">Actualizar</button>
    <a href="Actualizar_Registro_CN.php?id=<?=$año?>" class="btn btn-primary">Cancelar</a></center><br>
  </form>
  <?php
  }
  mysqli_free_result($query);
  mysqli_free_result($result);
  mysqli_close($conexion);
  ?>

  <div class="panel-heading"> 
    <ul class="pager">
      <li class="previous"><a href="Actualizar_Registro_CN.php?id=<?=$año?>">Regresar</a></li>
    </ul>
  </div>

</div>

</font>
</body>
</html>