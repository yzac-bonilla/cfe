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

<div class="container">

  <div class="jumbotron">
    <h1>Construcción</h1>
    <p>Programa General de Licitaciones <?php echo date("Y") ?></p>      
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
          <li class="previous"><a href="Consulta_PGL.php">Regresar</a></li>
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
        <li class="previous"><a href="Consulta_PGL.php">Regresar</a></li>
      </ul>
      </div>
      </div>
      <?php
      die();
  }
  $result=mysqli_query($conexion,"SELECT No FROM pgl ORDER BY No DESC");
  $row=mysqli_fetch_array($result);
  $id = $row["No"]+1;
  mysqli_free_result($query);
  mysqli_free_result($result);
  mysqli_close($conexion);
?>

    <form name="Registro" action="Insertar_PGL.php" method="post">
    <div class="row">
    <div class="col-sm-2">
      <br>No. de Proyecto: <input type="number" class="form-control" min="0" step="any" name="no" value="<?=$id?>" required>
    </div>
    <div class="col-sm-10">
      <br>Proyecto: <input type="text" class="form-control" name="proyecto" autofocus>
    </div>
    </div>
    <div class="row">
    <div class="col-sm-6">
      <br>Entidad Federativa: <input type="text" class="form-control" name="entidad">
    </div>
    <div class="col-sm-6">
      <br>División: <input type="text" class="form-control" name="division">
    </div>
    </div>
      <br>Obras: <input type="text" class="form-control" name="obras">
    <br><hr>
    <div class="row">
    <div class="col-sm-2">
      <br>S.E.: <input type="number" class="form-control" min="0" step="any" name="se" value="0.00" required>
    </div>
    <div class="col-sm-2">
      <br>LT: <input type="number" class="form-control" min="0" step="any" name="lt" value="0.00" required>
    </div>
    <div class="col-sm-2">
      <br>Alimentadores AT: <input type="number" class="form-control" min="0" step="any" name="aliment_at" value="0.00" required>
    </div>
    <div class="col-sm-2">
      <br>Alimentadores MT: <input type="number" class="form-control" min="0" step="any" name="aliment_mt" value="0.00" required>
    </div>
    <div class="col-sm-2">
      <br>MVA: <input type="number" class="form-control" min="0" step="any" name="mva" value="0.00" required>
    </div>
    <div class="col-sm-2">
      <br>MVAr: <input type="number" class="form-control" min="0" step="any" name="mvar" value="0.00" required>
    </div>
    </div>
    <div class="row">
    <div class="col-sm-2">
      <br>kmC: <input type="number" class="form-control" min="0" step="any" name="kmc" value="0.00" required>
    </div>
    <div class="col-sm-2">
      <br>Numero Aliment: <input type="number" class="form-control" min="0" step="any" name="num_aliment" value="0.00" required>
    </div>
    <div class="col-sm-2">
      <br>Medidores: <input type="number" class="form-control" min="0" step="any" name="medidores" value="0.00" required>
    </div>
    <div class="col-sm-4">
      <br>Transformadores de Distribución: <input type="number" class="form-control" min="0" step="any" name="transf_dist" value="0.00" required>
    </div>
    <div class="col-sm-2">
      <br>Postes: <input type="number" class="form-control" min="0" step="any" name="postes" value="0.00" required>
    </div>
    </div>
    <br><hr>
    <div class="row">
    <div class="col-sm-2">
      <br>Difusión Proyecto de Convocatoria: <input type="text" class="form-control" placeholder="dd-mm-aaaa" name="difusion_proy">
    </div>
    <div class="col-sm-2">
      <br>Publicación Convocatoria: <input type="text" class="form-control" placeholder="dd-mm-aaaa" name="pub_conv">
    </div>
    <div class="col-sm-2">
      <br>Visita al Sitio: <input type="text" class="form-control" placeholder="dd-mm-aaaa" name="visita_sitio">
    </div>
    <div class="col-sm-2">
      <br>Inicio de la Primera Junta de Aclaraciones: <input type="text" class="form-control" placeholder="dd-mm-aaaa" name="inicio_junta_1">
    </div>
    <div class="col-sm-2">
      <br>Cierre de la Primera Junta de Aclaraciones: <input type="text" class="form-control" placeholder="dd-mm-aaaa" name="cierre_junta_1">
    </div>
    <div class="col-sm-2">
      <br>Inicio de la Segunda Junta de Aclaraciones: <input type="text" class="form-control" placeholder="dd-mm-aaaa" name="inicio_junta_2">
    </div>
    </div>
    <div class="row">
    <div class="col-sm-2">
      <br>Cierre de la Segunda Junta de Aclaraciones: <input type="text" class="form-control" placeholder="dd-mm-aaaa" name="cierre_junta_2">
    </div>
    <div class="col-sm-2">
      <br>Inicio de la Tercera Junta de Aclaraciones: <input type="text" class="form-control" placeholder="dd-mm-aaaa" name="inicio_junta_3">
    </div>
    <div class="col-sm-2">
      <br>Cierre de la Tercera Junta de Aclaraciones: <input type="text" class="form-control" placeholder="dd-mm-aaaa" name="cierre_junta_3">
    </div>
    <div class="col-sm-2">
      <br>Inicio de la Cuarta Junta de Aclaraciones: <input type="text" class="form-control" placeholder="dd-mm-aaaa" name="inicio_junta_4">
    </div>
    <div class="col-sm-2">
      <br>Cierre de la Cuarta Junta de Aclaraciones: <input type="text" class="form-control" placeholder="dd-mm-aaaa" name="cierre_junta_4">
    </div>
    <div class="col-sm-2">
      <br>Recepción Propuestas: <input type="text" class="form-control" placeholder="dd-mm-aaaa" name="recepcion_prop">
    </div>
    
    </div>
    <div class="row">
    <div class="col-sm-3">
      <br>Fallo: <input type="text" class="form-control" placeholder="dd-mm-aaaa" name="fallo">
    </div>
    <div class="col-sm-3">
      <br>Firma del Contrato: <input type="text" class="form-control" placeholder="dd-mm-aaaa" name="firma_contrato">
    </div>
    <div class="col-sm-3">
      <br>Inicio de la Construcción: <input type="text" class="form-control" placeholder="dd-mm-aaaa" name="inicio_const">
    </div>
    <div class="col-sm-3">
      <br>Término de la Construcción: <input type="text" class="form-control" placeholder="dd-mm-aaaa" name="termino_const">
    </div>
    </div>
    <br><hr>
    <div class="row">
    <div class="col-sm-4">
      <br>Act. Prev. Inv. (MDD): <input type="number" class="form-control" min="0" step="any" name="act_prev" value="0.00" required>
    </div>
    <div class="col-sm-4">
      <br>Monto Max Publicado (MDD): <input type="number" class="form-control" min="0" step="any" name="monto_max" value="0.00" required>
    </div>
    <div class="col-sm-4">
      <br>Monto Adjudicado (MDD): <input type="number" class="form-control" min="0" step="any" name="monto_adjudicado" value="0.00" required>
    </div>
    </div>
      <br>Empresa/Consorcio Ganador: <input type="text" class="form-control" name="empresa_ganador">
    <br><br><center><input type="submit" class="btn btn-primary" value="Guardar"> 
    <a href="Consulta_PGL.php" class="btn btn-primary">Cancelar</a></center><br>
    </form>
    
    <div class="panel-heading"> 
      <ul class="pager">
        <li class="previous"><a href="Consulta_PGL.php">Regresar</a></li>
      </ul>
    </div>

 </div>

</font>
</body>
</html>
