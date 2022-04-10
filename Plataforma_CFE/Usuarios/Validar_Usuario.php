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
      <li class="active"><a href="../index.html">Inicio</a></li>
      <li class="dropdown"><a class="dropdown-toggle" data-toggle="dropdown" href="#">Contacto<span class="caret"></span></a>
        <ul class="dropdown-menu">
          <li><a href="mailto:nombre@dominio.com?subject=Sitio Web"><i>nombre@dominio.com</i></a></li>
        </ul>
      </li>
    </ul>
    </div>
  </div>
</nav>

<div class="container">
  <br>
  <center>
	<?php
		$usuario = $_POST['usuario'];
		$contraseña = md5($_POST['contraseña']);
    session_start();
    include ("../api/php/Conexion_Plataforma.php");
    $conexion = Conectar();
    $query = mysqli_query($conexion,"SELECT * FROM usuarios WHERE Usuario='$usuario'");
    $numrows = mysqli_num_rows($query);
    if ($numrows!==0) 
    {
      while ($row = mysqli_fetch_assoc($query)) 
      {
        $usuario_bd = $row['Usuario'];
        $contraseña_bd = $row['Password'];
      }
      if ($usuario==$usuario_bd && $contraseña==$contraseña_bd) 
      {
        $_SESSION['usuario'] = $usuario;
        include ("Historial.php");
        $actividad = "Inicio de sesión.";
        historial($actividad,$conexion);
        header('Location: ../home.php');
      }
      else
      {
        ?><br><br>
        <div class="alert alert-danger">
          <data-dismiss="alert"><strong>Acceso Denegado: </strong>Contraseña incorrecta.
        </div><br>
        <a href="../index.html" class="btn btn-info" role="button">Intentar nuevamente</a>
        <?php
      }
    }
    else
    {
      ?><br><br>
      <div class="alert alert-danger">
        <data-dismiss="alert"><strong>Acceso Denegado: </strong>El usuario no existe.
      </div><br>
      <a href="../index.html" class="btn btn-info" role="button">Intentar nuevamente</a>        
      <?php
    }
  mysqli_free_result($query);
  mysqli_close($conexion);
	?>
	</center>
  <br>
</div>

</font>
</body>
</html>


