<?php
  session_start();
  if (!isset($_SESSION['usuario'])) {header('Location:../../index.html');}
  $año = $_GET['id'];
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
    <p>Conformidad Normativa</p>      
  </div>
  <h2>Nuevo registro</h2> 

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
  $result=mysqli_query($conexion,"SELECT Id FROM $base_datos ORDER BY Id DESC");
  $row=mysqli_fetch_array($result);
  $id = $row["Id"]+1;
?> 

    <form name="Registro" action="Insertar_CN.php?id=<?=$año?>" method="post">
    <div class="row">
    <div class="col-sm-2">
      <br>No. de SAO: <input type="number" class="form-control" min="0" step="any" name="sao" value="<?=$id?>" required>
    </div>
    <div class="col-sm-4">
      <br>Fecha Recepción: <input type="text" class="form-control" name="fecha_recepcion" placeholder="dd/mm/aaaa" value="<?=date('d/m/Y')?>">
    </div>
    <div class="col-sm-6">
      <br>Especificación / Familia:
      <select class="form-control" name="especificacion" autofocus>
        <option value="NO ESPECIFICADO" selected>Seleccionar</option>
        <?php
        $filtro=mysqli_query($conexion,"SELECT * FROM cn_especificacion");
        while($fila=mysqli_fetch_array($filtro))
        {
            ?>
            <option value="<?=$fila['Especificacion']?>"><?=$fila['Especificacion']?> / <?=$fila['Familia']?></option>
            <?php
        }
        ?>
      </select>
    </div>
    </div>
    <div class="row">
    <div class="col-sm-4">
      <br>Sello: <input type="text" class="form-control" name="sello" value="PE-K3000-001">
    </div>
    <div class="col-sm-8">
      <br>Empresa:
      <select class="form-control" name="empresa">
        <option value="NO ESPECIFICADO" selected>Seleccionar</option>
        <?php
        $filtro=mysqli_query($conexion,"SELECT Empresa FROM cn_empresa");
        while($fila=mysqli_fetch_array($filtro))
        {
            ?>
            <option value="<?=$fila['Empresa']?>"><?=$fila['Empresa']?></option>
            <?php
        }
        mysqli_free_result($filtro);
        mysqli_free_result($query);
        mysqli_close($conexion);
        ?>
      </select>
    </div>
    </div>
    <div class="row">
    <div class="col-sm-6">
      <br>Remitente: <input type="text" class="form-control" name="remitente">
    </div>
    <div class="col-sm-6">
      <br>Responsable: <input type="text" class="form-control" name="responsable">
    </div>
    </div>
      <input type="hidden" name="oficio" value="" />
      <input type="hidden" name="fecha_oficio" value="" />
      <input type="hidden" name="fecha_atencion" value="" />
      <input type="hidden" name="oficios_atendidos" value="0" />
      <input type="hidden" name="plan_piloto" value="" />
      <input type="hidden" name="baja_sao" value="" />
      <input type="hidden" name="status" value="PENDIENTE" />
      <input type="hidden" name="tiempo_respuesta" value="0" />
      <input type="hidden" name="total_saos" value="1" />
      <input type="hidden" name="id" value=<?=$año?> />
    <br><br><center><input type="submit" class="btn btn-primary" value="Guardar" required> 
    <a href="Base_Datos_CN.php?id=<?=$año?>" class="btn btn-primary">Cancelar</a></center><br>
    </form>
    
    <div class="panel-heading"> 
      <ul class="pager">
        <li class="previous"><a href="Base_Datos_CN.php?id=<?=$año?>">Regresar</a></li>
      </ul>
    </div>

   </div>

</font>
</body>
</html>
