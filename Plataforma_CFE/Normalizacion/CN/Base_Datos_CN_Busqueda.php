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
  
 <div class="btn-group">
    <a href="Insertar_Registro_CN.php?id=<?=$año?>" class="btn btn-primary">Nuevo Registro</a></button>
    <a href="Actualizar_Registro_CN.php?id=<?=$año?>" class="btn btn-primary">Actualizar Registro</a></button>
    <a href="Eliminar_Registro_CN.php?id=<?=$año?>" class="btn btn-primary">Eliminar Registro</a></button>
    <a href="Subir_BD_CN.php?id=<?=$año?>" class="btn btn-primary">Subir Base de Datos</a></button>
    <a href="Subir_PDF_CN.php?id=<?=$año?>" class="btn btn-primary">Subir PDF</a></button>
    <a href="Grafica_BD_CN.php?id=<?=$año?>" class="btn btn-primary">Gráfica</a></button>
    <a href="Download_XLSX_CN.php?id=<?=$año?>" class="btn btn-primary">Descargar</a></button>
    <a onclick="PrintElem('#imprimir')" class="btn btn-primary">Imprimir</a></button>
    <a href="Conformidad_Normativa.php" class="btn btn-info">Atras</a></button>
  </div>
  <br><br>
  
  <form action="Base_Datos_CN_Filtros.php?id=<?=$año?>" name="opcion" method="post">
      <select name="seleccion_2">
      <option value="Default">Filtrar por empresa</option>
      <?php
      include ("../../api/php/Conexion_Plataforma.php");
      $conexion = Conectar();
      $filtro=mysqli_query($conexion,"SELECT DISTINCT Empresa FROM $base_datos ORDER BY Empresa");
      while($fila=mysqli_fetch_array($filtro))
      {
          ?>
          <option value="<?=$fila['Empresa']?>"><?=$fila['Empresa']?></option>
          <?php
      }
      ?>
      </select>
    <div class="row">
    <div class="col-md-6" align="left">
      <select name="seleccion_1">
      <option value="Default">Filtrar por familia</option>
      <?php
      $filtro=mysqli_query($conexion,"SELECT DISTINCT Familia FROM $base_datos ORDER BY Familia");
      while($fila=mysqli_fetch_array($filtro))
      {
          ?>
          <option value="<?=$fila['Familia']?>"><?=$fila['Familia']?></option>
          <?php
      }
      ?>
      </select>
    <button type="submit" value="Ver" class="btn btn-info">Ver</button>
    </div>
  </form>

  <form method="POST" action="Base_Datos_CN_Busqueda.php?id=<?=$año?>" onSubmit="return validarForm(this)">
    <div class="col-md-6" align="right">
        <input type="search" placeholder="Buscar familia o empresa" name="palabra">
        <button type="submit" value="Buscar" name="buscar" class="btn btn-info"><span class="glyphicon glyphicon-search"></span></button>
    </div>
    </div>
  </form>
  
<?php  
 if($_POST['buscar']) 
 {   
    $buscar = $_POST["palabra"];
    $consulta_mysql= mysqli_query ($conexion,"SELECT * FROM $base_datos WHERE Familia like '%$buscar%' OR Empresa like '%$buscar%'");
?>

</div>

<section>

  <font size="1">
  <div id="imprimir">
  <table class="overflow-y" border="1">
    <thead>
    <tr>
      <th>SAO</th>
      <th>Fecha Recepción</th>
      <th>Especificación</th>
      <th>Sello</th>
      <th>Empresa</th>
      <th>Remitente</th>
      <th>Familia</th>
      <th>Responsable</th>
      <th>Status</th>
      <th>Oficio</th>
      <th>Fecha Oficio</th>
      <th>Fecha Atención</th>
      <th>Oficios Atendidos</th>
      <th>Plan Piloto</th>
      <th>Tiempo Respuesta</th>
      <th>Baja SAO</th>
    </tr>
    </thead>
    <tbody>
     <?php
     while($row = mysqli_fetch_assoc($consulta_mysql)) 
     {
      ?> 
        <tr>
          <th><b><?=$row["Id"]?></b></th>
          <td><?=$row["Fecha_Recepcion"]?></td>
          <td><?=$row["Especificacion"]?></td>
          <td><?=$row["Sello"]?></td>
          <td><font color="#cc0000"><b><?=$row["Empresa"]?></b></font></td>
          <td><?=$row["Remitente"]?></td>
          <td><font color="#cc0000"><b><?=$row["Familia"]?></b></font></td>
          <td><?=$row["Responsable"]?></td>
          <td><?=$row["Status"]?></td>
          <td><a href="Contenido/<?=$base_datos?>/pdf/<?=$row["Oficio"]?>.pdf" target="_blank"><?=$row["Oficio"]?></a></td>
          <td><?=$row["Fecha_Oficio"]?></td>
          <td><?=$row["Fecha_Atencion"]?></td>
          <td><?=$row["Oficios_Atendidos"]?></td>
          <td><?=$row["Plan_Piloto"]?></td>
          <td><?=$row["Tiempo_Respuesta"]?></td>
          <td><?=$row["Baja_SAO"]?></td>
        </tr>
      <?php 
     }
     mysqli_free_result($filtro);
     mysqli_free_result($consulta_mysql);
     mysqli_close($conexion);
     ?>
     </tbody>
    </table>
    </div>
    </font>
    <?php
 }
?>

</section>
  
<div class="container">

  <div class="panel-heading"> 
    <ul class="pager">
      <li class="previous"><a href="Conformidad_Normativa.php">Regresar</a></li>
    </ul>
  </div>

</div>

<script type="text/javascript">
    function validarForm(formulario) 
    {
        if(formulario.palabra.value.length==0) 
        { 
            formulario.palabra.focus(); 
            alert('Escriba en el cuadro de texto o use los filtros para buscar.'); 
            return false; 
         }  
         return true;
     }   
    function PrintElem(elem)
    {
        Popup($(elem).html());
    }
    function Popup(data) 
    {
        var mywindow = window.open('', 'imprimir', 'height=400,width=600');
        mywindow.document.write('<html><head><title>Base de datos <?=$año?></title>');
        //mywindow.document.write('<link rel="stylesheet" href="../../../css/bootstrap.min.css">');
        mywindow.document.write('</head><body >');
        mywindow.document.write(data);
        mywindow.document.write('</body></html>');
        mywindow.document.close(); // necessary for IE >= 10
        mywindow.focus(); // necessary for IE >= 10
        mywindow.print();
        mywindow.close();
        return true;
    }
</script>

</font>
</body>
</html>