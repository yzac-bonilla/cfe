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
          <li><a href="CC.php">Compras Consolidadas</a></li>
          <li><a href="../CN/Conformidad_Normativa.php">Conformidad Normativa</a></li>
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
    <p>Compras Consolidadas</p>      
  </div>     

  <div class="btn-group">
    <a href="Insertar_Registro_CC.php" class="btn btn-primary">Nuevo Registro</a></button>
    <a href="Actualizar_Registro_CC.php" class="btn btn-primary">Actualizar Registro</a></button>
    <a href="Eliminar_Registro_CC.php" class="btn btn-primary">Eliminar Registro</a></button>
    <a href="Subir_Registros_CC.php" class="btn btn-primary">Subir Registros</a></button>
    <a href="Subir_PDF_CC.php" class="btn btn-primary">Subir PDF</a></button>
    <a href="Download_XLSX_CC.php" class="btn btn-primary">Descargar</a></button>
    <a onclick="PrintElem('#imprimir')" class="btn btn-primary">Imprimir</a></button>
    <a href="Consulta_CC.php" class="btn btn-info">Ver Todo</a></button>
  </div>
  <br><br>

  <div class="row">
  <div class="col-md-6" align="left">
    <form action="Consulta_CC_Filtros.php" name="opcion" method="post">
      <select name="seleccion">
      <option value="Piezas">Piezas</option>
      <option value="Importe">Importe</option>
      <option value="Junta">Junta de Aclaraciones</option>
      <option value="Fallo">Fallo</option>
      <option value="Contrato">Contrato</option>
      </select>
      <br><select name="seleccion2">
      <option value="Importe">Piezas</option>
      <option value="Piezas" selected>Importe</option>
      <option value="Junta">Junta de Aclaraciones</option>
      <option value="Fallo">Fallo</option>
      <option value="Contrato">Contrato</option>
    </select>
    <button type="submit" value="Ver" class="btn btn-info">Ver</button>
    </form>
  </div>
  <div class="col-md-6" align="right">
    <br>
    <form method="POST" action="Consulta_CC_Busqueda.php" onSubmit="return validarForm(this)">
        <input type="search" placeholder="Buscar familia" name="palabra">
        <button type="submit" value="Buscar" name="buscar" class="btn btn-info"><span class="glyphicon glyphicon-search"></span></button>
    </form>
  </div>
  </div>

<?php  
 if($_POST['buscar']) 
 {   
	include ("../../api/php/Conexion_Plataforma.php");
  $conexion = Conectar();
	$buscar = $_POST["palabra"];
  $consulta_mysql= mysqli_query ($conexion,"SELECT * FROM cc WHERE Familia like '%$buscar%'");
?>
  <font size="2">
  <div id="imprimir">
  <table class="overflow-y" border="1">
    <thead>
    <tr>
      <th>Solped</th>
      <th>Familia</th>
      <th>Piezas</th>
      <th>Importe</th>
      <th>Junta</th>
      <th>Fallo</th>
      <th>Contrato</th>
    </tr>
    </thead>
    <tbody>
     <?php
     while($row = mysqli_fetch_assoc($consulta_mysql)) 
     {
	    ?> 
	    <tr>
        <th><?=$row["Solped"]?></th>
        <td><a href="Contenido/pdf/<?=$row["Familia"]?>.pdf" target="_blank"><?=$row["Familia"]?></a></td>
        <td><?=$row["Piezas"]?></td>
        <td><?=$row["Importe"]?></td>
        <td><?=$row["Junta"]?></td>
        <td><?=$row["Fallo"]?></td>
        <td><?=$row["Contrato"]?></td>
      </tr>
	    <?php 
     }
     ?>
     </tbody>
    </table>
    </div>
    </font>
    <?php
 }
  mysqli_free_result($consulta_mysql);
  mysqli_close($conexion);
?>
  
  <div class="panel-heading"> 
    <ul class="pager">
      <li class="previous"><a href="CC.php">Regresar</a></li>
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
        mywindow.document.write('<html><head><title>Compras Consolidadas</title>');
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
