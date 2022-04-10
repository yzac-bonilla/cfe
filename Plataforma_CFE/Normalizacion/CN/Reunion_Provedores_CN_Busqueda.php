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
    <p>Reunión con los provedores</p>      
  </div>    

  <div class="btn-group">
    <a href="Insertar_Registro_RP.php" class="btn btn-primary">Nuevo Registro</a></button>
    <a href="Actualizar_Registro_RP.php" class="btn btn-primary">Actualizar Registro</a></button>
    <a href="Eliminar_Registro_RP.php" class="btn btn-primary">Eliminar Registro</a></button>
    <a href="Subir_Documento_RP.php" class="btn btn-primary">Subir documentos</a></button>
    <a href="Download_XLSX_RP.php" class="btn btn-primary">Descargar</a></button>
    <a onclick="PrintElem('#imprimir')" class="btn btn-primary">Imprimir</a></button>
    <a href="Reunion_Provedores_CN.php" class="btn btn-info">Ver todo</a></button>
  </div>
  <br><br>

  <form action="Reunion_Provedores_CN_Filtros.php" name="opcion" method="post">
      <select name="seleccion_2">
      <option value="Default">Filtrar por Empresa</option>
      <?php
      include ("../../api/php/Conexion_Plataforma.php");
      $conexion = Conectar();
      $filtro=mysqli_query($conexion,"SELECT DISTINCT Provedor FROM cn_reunion_provedor ORDER BY Provedor");
      while($fila=mysqli_fetch_array($filtro))
      {
          ?>
          <option value="<?=$fila['Provedor']?>"><?=$fila['Provedor']?></option>
          <?php
      }
      ?>
      </select>
    <div class="row">
    <div class="col-md-6" align="left">
      <select name="seleccion_1">
      <option value="Default">Filtrar por Familia</option>
      <?php
      $filtro=mysqli_query($conexion,"SELECT DISTINCT Tema FROM cn_reunion_provedor ORDER BY Tema");
      while($fila=mysqli_fetch_array($filtro))
      {
          ?>
          <option value="<?=$fila['Tema']?>"><?=$fila['Tema']?></option>
          <?php
      }
      ?>
      </select>
    <button type="submit" value="Ver" class="btn btn-info">Ver</button>
    </div>
  </form>

  <form method="POST" action="Reunion_Provedores_CN_Busqueda.php" onSubmit="return validarForm(this)">
    <div class="col-md-6" align="right">
        <input type="search" placeholder="Buscar provedor o tema" name="palabra">
        <button type="submit" value="Buscar" name="buscar" class="btn btn-info"><span class="glyphicon glyphicon-search"></span></button>
    </div>
    </div>
  </form>
  
<?php  
 if($_POST['buscar']) 
 {   
    $buscar = $_POST["palabra"];
    $consulta_mysql= mysqli_query ($conexion,"SELECT * FROM cn_reunion_provedor WHERE Tema like '%$buscar%' OR Provedor like '%$buscar%'");
?>
  <font size="2">
  <div id="imprimir">
  <table class="overflow-y" border="1">
    <thead>
    <tr>
      <th>Id</th>
      <th>Fecha</th>
      <th>Provedor</th>
      <th>Tema</th>
      <th>Info de la reunión</th>
      <th>Nota Informativa</th>
      <th></th>
    </tr>
    </thead>
    <tbody>
     <?php
     while($row = mysqli_fetch_assoc($consulta_mysql)) 
     {
      ?> 
        <tr>
          <th><?=$row["Id"]?></th>
          <?php
          $today = date("d-m-Y H:i:s");
          $datetime2 = new DateTime($today);
          $color = "#ffbfbf";
          $date1 = $row["Fecha"];
          if(DateTime::createFromFormat('d-m-Y', $date1) !== false || DateTime::createFromFormat('d-M-Y', $date1) !== false)
          {
              $datetime1 = new DateTime($date1);
              if ($datetime1 < $datetime2) 
              {
                $color = "#36eb88";
              }
          }
          ?>
          <td bgcolor=<?=$color?>><b><?=$row["Fecha"]?></b></td>
          <td><b><?=$row["Provedor"]?></b></td>
          <td><?=$row["Tema"]?></td>
          <td><?=$row["Documentacion"]?></td>
          <td><?=$row["Nota_Informativa"]?></td>
          <td><?=$row["Si_No"]?></td>
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
        mywindow.document.write('<html><head><title>Reunión con los provedores</title>');
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