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
    <p>Programa General de Licitaciones <?php echo date("Y") ?> </p>      
  </div>  
  <h2>Actualizar Registros</h2> 

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
?>

  <?php
  $result=mysqli_query($conexion,"SELECT * FROM pgl WHERE No='$id'");
  while($row=mysqli_fetch_array($result))
  {
  ?>
  <form action="Update_PGL.php" method="POST">
  <div class="row">
  <div class="col-sm-2">
    <br>No. de Proyecto: <input type="number" class="form-control" min="0" step="any" name="no" value="<?=$row["No"]?>" required readonly>
  </div>
  <div class="col-sm-10">
    <br>Proyecto: <input type="text" class="form-control" name="proyecto" value="<?=$row["Proyecto"]?>" autofocus>
  </div>
  </div>
  <div class="row">
  <div class="col-sm-6">
    <br>Entidad Federativa: <input type="text" class="form-control" name="entidad" value="<?=$row["Entidad_Federativa"]?>">
  </div>
  <div class="col-sm-6">
    <br>División: <input type="text" class="form-control" name="division" value="<?=$row["Division"]?>">
  </div>
  </div>
    <br>Obras: <input type="text" class="form-control" name="obras" value="<?=$row["Obras"]?>">
  <br><hr>
  <div class="row">
  <div class="col-sm-2">
    <br>S.E.: <input type="number" class="form-control" min="0" step="any" name="se" value="<?=$row["SE"]?>" required>
  </div>
  <div class="col-sm-2">
    <br>LT: <input type="number" class="form-control" min="0" step="any" name="lt"  value="<?=$row["LT"]?>" required>
  </div>
  <div class="col-sm-2">
    <br>Alimentadores AT: <input type="number" class="form-control" min="0" step="any" name="aliment_at" value="<?=$row["Alimentadores_AT"]?>" required>
  </div>
  <div class="col-sm-2">
    <br>Alimentadores MT: <input type="number" class="form-control" min="0" step="any" name="aliment_mt" value="<?=$row["Alimentadores_MT"]?>" required>
  </div>
  <div class="col-sm-2">
    <br>MVA: <input type="number" class="form-control" min="0" step="any" name="mva" value="<?=$row["MVA"]?>" required>
  </div>
  <div class="col-sm-2">
    <br>MVAr: <input type="number" class="form-control" min="0" step="any" name="mvar" value="<?=$row["MVAr"]?>" required>
  </div>
  </div>
  <div class="row">
  <div class="col-sm-2">
    <br>kmC: <input type="number" class="form-control" min="0" step="any" name="kmc" value="<?=$row["kmC"]?>" required>
  </div>
  <div class="col-sm-2">
    <br>Numero Aliment: <input type="number" class="form-control" min="0" step="any" name="num_aliment" value="<?=$row["Numero_Aliment"]?>" required>
  </div>
  <div class="col-sm-2">
    <br>Medidores: <input type="number" class="form-control" min="0" step="any" name="medidores" value="<?=$row["Medidores"]?>" required>
  </div>
  <div class="col-sm-4">
    <br>Transformadores de Distribución: <input type="number" class="form-control" min="0" step="any" name="transf_dist" value="<?=$row["Transformadores_Distribucion"]?>" required>
  </div>
  <div class="col-sm-2">
    <br>Postes: <input type="number" class="form-control" min="0" step="any" name="postes" value="<?=$row["Postes"]?>" required>
  </div>
  </div>
  <br><hr>
  <div class="row">
  <div class="col-sm-2">
    <br>Difusión Proyecto de Convocatoria: <input type="text" class="form-control" placeholder="dd-mm-aaaa" name="difusion_proy" value="<?=$row["Difusion_Proyecto_Convocatoria"]?>">
  </div>
  <div class="col-sm-2">
    <br>Publicación Convocatoria: <input type="text" class="form-control" placeholder="dd-mm-aaaa" name="pub_conv" value="<?=$row["Publicacion_Convocatoria"]?>">
  </div>
  <div class="col-sm-2">
    <br>Visita al Sitio: <input type="text" class="form-control" placeholder="dd-mm-aaaa" name="visita_sitio" value="<?=$row["Visita_Sitio"]?>">
  </div>
  <div class="col-sm-2">
    <br>Inicio de la Primera Junta de Aclaraciones: <input type="text" class="form-control" placeholder="dd-mm-aaaa" name="inicio_junta_1" value="<?=$row["Inicio_Primera_Junta"]?>">
  </div>
  <div class="col-sm-2">
    <br>Cierre de la Primera Junta de Aclaraciones: <input type="text" class="form-control" placeholder="dd-mm-aaaa" name="cierre_junta_1" value="<?=$row["Cierre_Primera_Junta"]?>">
  </div>
  <div class="col-sm-2">
    <br>Inicio de la Segunda Junta de Aclaraciones: <input type="text" class="form-control" placeholder="dd-mm-aaaa" name="inicio_junta_2" value="<?=$row["Inicio_Segunda_Junta"]?>">
  </div>
  </div>
  <div class="row">
  <div class="col-sm-2">
    <br>Cierre de la Segunda Junta de Aclaraciones: <input type="text" class="form-control" placeholder="dd-mm-aaaa" name="cierre_junta_2" value="<?=$row["Cierre_Segunda_Junta"]?>">
  </div>
  <div class="col-sm-2">
    <br>Inicio de la Tercera Junta de Aclaraciones: <input type="text" class="form-control" placeholder="dd-mm-aaaa" name="inicio_junta_3" value="<?=$row["Inicio_Tercera_Junta"]?>">
  </div>
  <div class="col-sm-2">
    <br>Cierre de la Tercera Junta de Aclaraciones: <input type="text" class="form-control" placeholder="dd-mm-aaaa" name="cierre_junta_3" value="<?=$row["Cierre_Tercera_Junta"]?>">
  </div>
  <div class="col-sm-2">
    <br>Inicio de la Cuarta Junta de Aclaraciones: <input type="text" class="form-control" placeholder="dd-mm-aaaa" name="inicio_junta_4" value="<?=$row["Inicio_Cuarta_Junta"]?>">
  </div>
  <div class="col-sm-2">
    <br>Cierre de la Cuarta Junta de Aclaraciones: <input type="text" class="form-control" placeholder="dd-mm-aaaa" name="cierre_junta_4" value="<?=$row["Cierre_Cuarta_Junta"]?>">
  </div>
  <div class="col-sm-2">
    <br>Recepción Propuestas: <input type="text" class="form-control" placeholder="dd-mm-aaaa" name="recepcion_prop" value="<?=$row["Recepcion_Propuesta"]?>">
  </div>
  </div>
  <div class="row">
  <div class="col-sm-3">
    <br>Fallo: <input type="text" class="form-control" placeholder="dd-mm-aaaa" name="fallo" value="<?=$row["Fallo"]?>">
  </div>
  <div class="col-sm-3">
    <br>Firma del Contrato: <input type="text" class="form-control" placeholder="dd-mm-aaaa" name="firma_contrato" value="<?=$row["Firma_Contrato"]?>">
  </div>
  <div class="col-sm-3">
    <br>Inicio de la Construcción: <input type="text" class="form-control" placeholder="dd-mm-aaaa" name="inicio_const" value="<?=$row["Inicio_Construccion"]?>">
  </div>
  <div class="col-sm-3">
    <br>Término de la Construcción: <input type="text" class="form-control" placeholder="dd-mm-aaaa" name="termino_const" value="<?=$row["Termino_Construccion"]?>">
  </div>
  </div>
  <br><hr>
  <div class="row">
  <div class="col-sm-4">
    <br>Act. Prev. Inv. (MDD): <input type="number" class="form-control" min="0" step="any" name="act_prev" value="<?=$row["Act_Prev_Inv"]?>" required>
  </div>
  <div class="col-sm-4">
    <br>Monto Max Publicado (USD): <input type="number" class="form-control" min="0" step="any" name="monto_max" value="<?=$row["Monto_Max_Publicado"]?>" required>
  </div>
  <div class="col-sm-4">
    <br>Monto Adjudicado (USD): <input type="number" class="form-control" min="0" step="any" name="monto_adjudicado" value="<?=$row["Monto_Adjudicado"]?>" required>
  </div>
  </div>
    <br>Empresa/Consorcio Ganador: <input type="text" class="form-control" name="empresa_ganador" value="<?=$row["Empresa_Consorcio_Ganador"]?>">
    <input type="hidden" name="id" value=<?=$id?> />
    <br><br><center><button type="submit" value="Actualizar" class="btn btn-primary">Actualizar</button>
    <a href="Actualizar_Registro_PGL.php" class="btn btn-primary">Cancelar</a><center><br>
  </form>
  <?php
  }
  mysqli_free_result($query);
  mysqli_free_result($result);
  mysqli_close($conexion);
  ?>

  <div class="panel-heading"> 
    <ul class="pager">
      <li class="previous"><a href="Actualizar_Registro_PGL.php">Regresar</a></li>
    </ul>
  </div>

</div>

</font>
</body>
</html>