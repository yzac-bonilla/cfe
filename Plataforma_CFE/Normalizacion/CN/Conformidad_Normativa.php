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
    <p>Conformidad Normativa</p>      
  </div>     

<div class="btn-group">
  <a href="Reunion_Provedores_CN.php" class="btn btn-primary">Reunión con provedores</a></button>
  <a href="Agregar_BD_CN.php" class="btn btn-primary">Nueva base de datos</a></button>
  <?php
  if ($_SESSION['usuario']=="admin") 
  {
      ?>
      <a href="Eliminar_BD_CN.php" class="btn btn-primary">Eliminar base de datos</a></button>
      <?php
  }
  ?>
  <a href="Buscar_BD_CN.php" class="btn btn-primary">Busqueda global</a></button>
  <a href="../../home.php" class="btn btn-info">Atras</a></button>
</div>
<br>

<form action="Base_Datos_CN.php">
<?php
  include ("../../api/php/Conexion_Plataforma.php");
  $conexion = Conectar();
  $x = date("Y");
  $fecha = new DateTime($x);
  ?>
  <h1>Actual:</h1>
  <?php
  $result = mysqli_query($conexion,"SELECT * FROM cn ORDER BY Base_Datos DESC");
  while ($row = mysqli_fetch_assoc($result)) 
  {
    $actual = new DateTime($row['Base_Datos']);
    if ($actual >= $fecha) 
    {
      ?>
      <div class="list-group">
         <a href="Base_Datos_CN.php?id=<?=$row["Base_Datos"]?>" class="list-group-item list-group-item-success">Base de datos <?=$row["Base_Datos"]?></a>
      </div>
      <?php
    }
  }
  $query = mysqli_query($conexion,"SELECT * FROM cn WHERE Base_Datos='$x'");
  $numrows = mysqli_num_rows($query);
  if($numrows==0)
  {
    ?>
    <a href="Agregar_BD_CN.php">Agregar base de datos <?=$x?>.</a>
    <?php
  }
  ?>
  <h1>Histórico:</h1>
  <?php
    $result = mysqli_query($conexion,"SELECT * FROM cn ORDER BY Base_Datos DESC");
    while ($row = mysqli_fetch_assoc($result)) 
    {
      $historico = new DateTime($row['Base_Datos']);
      if ($historico < $fecha) 
      {
        ?>
        <div class="list-group">
          <a href="Base_Datos_CN.php?id=<?=$row["Base_Datos"]?>" class="list-group-item list-group-item-warning">Base de datos <?=$row["Base_Datos"]?></a>
        </div>
        <?php
      }
    }
  mysqli_free_result($result);
  mysqli_close($conexion);
?>
</form>

  <div class="panel-heading"> 
    <ul class="pager">
      <li class="previous"><a href="../../home.php">Regresar</a></li>
    </ul>
  </div>

</div>

</font>
</body>
</html>

