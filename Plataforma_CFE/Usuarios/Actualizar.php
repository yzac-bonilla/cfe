<?php
  session_start();
  if (!isset($_SESSION['usuario'])) {header('Location:../index.html');}
  $id = $_GET['id'];
?>

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
      <li class="active"><a href="../home.php">Inicio</a></li>
      <li class="dropdown"><a class="dropdown-toggle" data-toggle="dropdown" href="#">Normalización<span class="caret"></span></a>
        <ul class="dropdown-menu">
          <li><a href="../Normalizacion/CC/CC.php">Compras Consolidadas</a></li>
          <li><a href="../Normalizacion/CN/Conformidad_Normativa.php">Conformidad Normativa</a></li>
        </ul>
      </li>
      <li class="dropdown"><a class="dropdown-toggle" data-toggle="dropdown" href="#">Construccción<span class="caret"></span></a>
        <ul class="dropdown-menu">
          <li><a href="../Construccion/PGL/OPF.php">Obras Publicas Financiadas</a></li>
          <li><a href="../Construccion/Inversion/Inversion.php">Inversión</a></li>
        </ul>
      </li>
    </ul>
    <ul class="nav navbar-nav navbar-right">
      <li class="dropdown"><a class="dropdown-toggle" data-toggle="dropdown" href="#"><span class="glyphicon glyphicon-user"></span> <?=$_SESSION['usuario']?><span class="caret"></span></a>
        <ul class="dropdown-menu">
        <li><a href="Cerrar_Sesion.php"><span class="glyphicon glyphicon-log-out"></span> Cerrar Sesión</a></li>
        </ul>
      </li>
    </ul>
    </div>
  </div>
</nav>

<div class="container">

  <div class="jumbotron">
    <h1>Usuarios</h1>
    <p>Actualizar usuario.</p>      
  </div>     

<?php
  if ($_SESSION['usuario']!="admin") 
  {
      ?>
      <div class="container">
      <div class="alert alert-danger">
      <data-dismiss="alert"><strong>Acceso Denegado: </strong>Solo el usuario "admin" puede actualizar los usuarios.
      </div>
      <div class="panel-heading"> 
      <ul class="pager">
        <li class="previous"><a href="Consulta_Usuarios.php">Regresar</a></li>
      </ul>
      </div>
      </div>
      <?php
      die();
  }
  include ("../api/php/Conexion_Plataforma.php");
  $conexion = Conectar();
  $result=mysqli_query($conexion,"SELECT * FROM usuarios WHERE Id='$id'");
?>

  <?php
  while($row=mysqli_fetch_array($result))
  {
    if ($row["Usuario"] == "admin") {$opcion = "readonly";}
    else {$opcion = "";}
    $user = $row["Usuario"];
  ?>
    <form action="Update.php" method="post" onSubmit="return validarForm(this)">
    <div class="row">
    <div class="col-sm-2">
      <br>No.: 
      <input type="number" name="id" class="form-control" value="<?=$row["Id"]?>" required readonly>
    </div>
    <div class="col-sm-10">
	    <br>Nombre de usuario: 
      <input type="text" name="usuario" class="form-control" value="<?=$row["Usuario"]?>" required autofocus <?=$opcion?>>
    </div>
    </div>
    <div class="row">
    <div class="col-sm-4">
	    <br>Nueva contraseña: 
      <input type="password" name="clave" class="form-control" required>
    </div>
    <div class="col-sm-4">
      <br>Confirme la contraseña: 
      <input type="password" class="form-control" name="clave_ok" required>
    </div>
    <div class="col-sm-4">
      <br>Tipo de usuario actual: 
      <input type="text" class="form-control" name="permiso_actual" value="<?=$row["Permisos"]?>" readonly>
    </div>
    </div>
      <?php 
        if ($user != "admin") 
        {
          ?>
    	    <center><br>Nuevo permiso: 
          <input type="radio" name="permiso" value="Administrador" required> Administrador
          <input type="radio" name="permiso" value="Limitado" required> Limitado
          <a href="Ayuda_Usuario.php" target="_blank">[Ayuda]</a>
          <?php
        }
        else 
        {
          ?>
          <input type="hidden" name="permiso" value="Administrador" />
          <?php
        }
      ?>
      <input type="hidden" name="id" value=<?=$id?> />
	    <center><br><br><input type="submit" class="btn btn-primary" value="Actualizar" required> 
      <a href="Actualizar_Usuario.php" class="btn btn-primary">Cancelar</a><br><br></center>
    </form>
    <?php
  }
  ?>

	<div class="panel-heading"> 
	  <ul class="pager">
	    <li class="previous"><a href="Actualizar_Usuario.php">Regresar</a></li>
	  </ul>
	</div>

</div>

<script type="text/javascript">
    function validarForm(formulario) 
    {
        temp = "<?php echo($user); ?>";
        if(formulario.usuario.value == "admin" && temp != "admin") 
        { 
            formulario.clave_ok.focus(); 
            alert('Nombre de usuario inválido. Intente nuevamente.'); 
            return false; 
        } 
        if(formulario.clave.value != formulario.clave_ok.value) 
        { 
            formulario.clave_ok.focus(); 
            alert('Las contraseñas no coinciden. Intente nuevamente.'); 
            return false; 
        } 
        return true;
     }
</script>

</font>
</body>
</html>