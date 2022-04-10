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
  <script src="../../api/js/jquery.ba-throttle-debounce.min.js"></script>
  <script src="../../api/js/jquery.stickyheader.js"></script>
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
  <h2>Eliminar Registro</h2> 

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

  <font size=2>
  <table class="overflow-y">
    <thead>
    <tr>
      <th>No</th>
      <th>Acción</th>
      <th>Proyecto</th>
    </tr>
    </thead>
    <tbody>
<?php
  $result=mysqli_query($conexion,"SELECT * FROM pgl ORDER BY No");
	while ($row=mysqli_fetch_array($result)) 
	{
		?>
	    <tr>
	      <th><b><?=$row["No"]?></b></th>
        <?php
        printf("<td bgcolor='#ffbfbf'><a href='Eliminar_PGL.php? id=%d' onclick=\"return confirmar('¿Está seguro que desea eliminar el registro?')\">Borrar</a></td>",$row["No"]);
        ?>
        <td><b><?=$row["Proyecto"]?></b></td>
	    </tr>
	    <?php
	  }
	mysqli_free_result($query);
  mysqli_free_result($result);
  mysqli_close($conexion);
?>
</tbody>
</table>
</font>

  <div class="panel-heading"> 
    <ul class="pager">
      <li class="previous"><a href="Consulta_PGL.php">Regresar</a></li>
    </ul>
  </div>

</div>

<script type="text/javascript">
  function confirmar (mensaje) 
  { 
      return confirm(mensaje); 
  } 
</script>

</font>
</body>
</html>