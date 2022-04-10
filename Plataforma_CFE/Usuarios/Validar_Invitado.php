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
		include ("../api/php/Conexion_Plataforma.php");
    $conexion = Conectar();
    session_start();
	  $nombre = $_POST['nombre'];
    $apellido = $_POST['apellido'];
    $name = "Invitado: ".$nombre." ".$apellido;
    $_SESSION['usuario'] = $name;
		echo '<center>'."Entraste como: ".'<b>';
		echo $nombre;
		echo '</b>'."<br>".date("d/m/Y H:i:s")."<br>"."<br>";
		echo '</center>';
    $fecha = date("d-m-Y");
    $hora = date ("H:i:s");
    $direccion_ip = $_SERVER['REMOTE_ADDR'];
    $user_agent = $_SERVER['HTTP_USER_AGENT'];
    function Browser($user_agent)
    {
      if(strpos($user_agent, 'MSIE') !== FALSE)
          return 'Internet explorer';
      elseif(strpos($user_agent, 'Edge') !== FALSE) 
          return 'Microsoft Edge';
      elseif(strpos($user_agent, 'Trident') !== FALSE) 
          return 'Internet explorer';
      elseif(strpos($user_agent, 'Opera Mini') !== FALSE)
          return "Opera Mini";
      elseif(strpos($user_agent, 'Opera') || strpos($user_agent, 'OPR') !== FALSE)
          return "Opera";
      elseif(strpos($user_agent, 'Firefox') !== FALSE)
          return 'Mozilla Firefox';
      elseif(strpos($user_agent, 'Chrome') !== FALSE)
          return 'Google Chrome';
      elseif(strpos($user_agent, 'Safari') !== FALSE)
          return "Safari";
      else
          return 'No hemos podido detectar su navegador';
    }
    $navegador = Browser($user_agent);
    $sql="INSERT INTO invitados (Nombre,Apellido,Fecha,Hora,Direccion_IP,Navegador) VALUES ('$nombre','$apellido','$fecha','$hora','$direccion_ip','$navegador');";
    if ($conexion->query($sql) === TRUE) 
    {
        //echo '<center>'.'<font color="red">'."Ingreso registrado satisfactoriamente.".'</font>'."<br>"."<br>".'</center>';
    } 
    else 
    {
        echo "Error: " . $sql . "<br>" . $conexion->error;
    }
    include ("Historial.php");
    $actividad = "Inicio de sesión como invitado.";
    historial($actividad,$conexion);
    mysqli_close($conexion);
    header('Location: ../home.php');
	?>
	</center>
  <br>     
</div>

</font>
</body>
</html>
