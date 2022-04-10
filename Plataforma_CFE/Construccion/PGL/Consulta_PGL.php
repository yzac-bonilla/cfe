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

  <div class="btn-group">
    <a href="Insertar_Registro_PGL.php" class="btn btn-primary">Nuevo Registro</a></button>
    <a href="Actualizar_Registro_PGL.php" class="btn btn-primary">Actualizar Registro</a></button>
    <a href="Eliminar_Registro_PGL.php" class="btn btn-primary">Eliminar Registro</a></button>
    <a href="Subir_Registros_PGL.php" class="btn btn-primary">Subir Registros</a></button>
    <a href="Download_XLSX_PGL.php" class="btn btn-primary">Descargar</a></button>
    <a onclick="PrintElem('#imprimir')" class="btn btn-primary">Imprimir</a></button>
    <a href="OPF.php" class="btn btn-info">Atras</a></button>
  </div>
  <br><br>
  
  <form action="Consulta_PGL_Filtros.php" name="opcion" method="post">
      <select name="seleccion_2">
      <option value="Default">Filtrar por división</option>
      <?php
      include ("../../api/php/Conexion_Plataforma.php");
      $conexion = Conectar();
      $filtro=mysqli_query($conexion,"SELECT DISTINCT Division FROM pgl ORDER BY Division");
      while($fila=mysqli_fetch_array($filtro))
      {
          ?>
          <option value="<?=$fila['Division']?>"><?=$fila['Division']?></option>
          <?php
      }
      ?>
      </select>
    <div class="row">
    <div class="col-md-6" align="left">
      <select name="seleccion_1">
      <option value="Default">Filtrar por entidad federativa</option>
      <?php
      $filtro=mysqli_query($conexion,"SELECT DISTINCT Entidad_Federativa FROM pgl ORDER BY Entidad_Federativa");
      while($fila=mysqli_fetch_array($filtro))
      {
          ?>
          <option value="<?=$fila['Entidad_Federativa']?>"><?=$fila['Entidad_Federativa']?></option>
          <?php
      }
      ?>
      </select>
    <button type="submit" value="Ver" class="btn btn-info">Ver</button>
    </div>
  </form>

  <form method="POST" action="Consulta_PGL_Busqueda.php" onSubmit="return validarForm(this)">
    <div class="col-md-6" align="right">
        <input type="search" placeholder="Buscar proyecto" name="palabra">
        <button type="submit" value="Buscar" name="buscar" class="btn btn-info"><span class="glyphicon glyphicon-search"></span></button>
    </div>
  </form>
  </div>

</div>

<section>

  <font size="1">
  <div id="imprimir">
  <table class="overflow-y" border="1">
    <thead>
    <tr>
      <th>No</th>
      <th>Proyecto</th>
      <th>Entidad Federativa</th>
      <th>División</th>
      <th>Obras</th>
      <th>S.E.</th>
      <th>LT</th>
      <th>Aliment. AT</th>
      <th>Aliment. MT</th>
      <th>MVA</th>
      <th>MVAr</th>
      <th>kmC</th>
      <th>No. Aliment</th>
      <th>Medidores</th>
      <th>Transformadores Distribución</th>
      <th>Postes</th>
      <th>Difusión Convocatoria</th>
      <th>Publicación Convocatoria</th>
      <th>Visita Sitio</th>
      <th>Inicio JA 1</th>
      <th>Cierre JA 1</th>
      <th>Inicio JA 2</th>
      <th>Cierre JA 2</th>
      <th>Inicio JA 3</th>
      <th>Cierre JA 3</th>
      <th>Inicio JA 4</th>
      <th>Cierre JA 4</th>
      <th>Recepción Propuesta</th>
      <th>Fallo</th>
      <th>Firma del Contrato</th>
      <th>Inicio de la Construcción</th>
      <th>Término de la Construcción</th>
      <th>Act.Prev.Inv.(MDD)</th>
      <th>Monto.Max. Publicado (USD)</th>
      <th>Monto Adjudicado (USD)</th>
      <th>Empresa / Consorcio Ganador</th>
    </tr>
    </thead>
    <tbody>
  <?php
  $today = date("d-m-Y H:i:s");
  $datetime2 = new DateTime($today);
  $result=mysqli_query($conexion,"SELECT * FROM pgl ORDER BY No");
  $contador=0;
  while($row=mysqli_fetch_array($result))
  {
    $contador++;
    ?>
    <tr>
      <th><b><?=$row["No"]?></b></th>
      <td><b><?=$row["Proyecto"]?></b></td>
      <td><b><?=$row["Entidad_Federativa"]?></b></td>
      <td><b><?=$row["Division"]?></b></td>
      <td><b><?=$row["Obras"]?></b></td>
      <td><?=$row["SE"]?></td>
      <td><?=$row["LT"]?></td>
      <td><?=$row["Alimentadores_AT"]?></td>
      <td><?=$row["Alimentadores_MT"]?></td>
      <td><?=$row["MVA"]?></td>
      <td><?=$row["MVAr"]?></td>
      <td><?=$row["kmC"]?></td>
      <td><?=$row["Numero_Aliment"]?></td>
      <td><?=$row["Medidores"]?></td>
      <td><?=$row["Transformadores_Distribucion"]?></td>
      <td><?=$row["Postes"]?></td>
      <?php
      $color = "";
      $date1 = $row["Difusion_Proyecto_Convocatoria"];
      if(DateTime::createFromFormat('d-m-Y', $date1) !== false || DateTime::createFromFormat('d-M-Y', $date1) !== false)
      {
          $datetime1 = new DateTime($date1);
          if ($datetime1 < $datetime2) 
          {
            $color = "#36eb88";
          }
      }
      ?>
      <td bgcolor=<?=$color?>><?=$row["Difusion_Proyecto_Convocatoria"]?></td>
      <?php
      $color = "";
      $date1 = $row["Publicacion_Convocatoria"];
      if(DateTime::createFromFormat('d-m-Y', $date1) !== false || DateTime::createFromFormat('d-M-Y', $date1) !== false)
      {
          $datetime1 = new DateTime($date1);
          if ($datetime1 < $datetime2) 
          {
            $color = "#36eb88";
          }
      }
      ?>
      <td bgcolor=<?=$color?>><?=$row["Publicacion_Convocatoria"]?></td>
      <?php
      $color = "";
      $date1 = $row["Visita_Sitio"];
      if(DateTime::createFromFormat('d-m-Y', $date1) !== false || DateTime::createFromFormat('d-M-Y', $date1) !== false)
      {
          $datetime1 = new DateTime($date1);
          if ($datetime1 < $datetime2) 
          {
            $color = "#36eb88";
          }
      }
      ?>
      <td bgcolor=<?=$color?>><?=$row["Visita_Sitio"]?></td>
      <?php
      $color = "";
      $date1 = $row["Inicio_Primera_Junta"];
      if(DateTime::createFromFormat('d-m-Y', $date1) !== false || DateTime::createFromFormat('d-M-Y', $date1) !== false)
      {
          $datetime1 = new DateTime($date1);
          if ($datetime1 < $datetime2) 
          {
            $color = "#36eb88";
          }
      }
      ?>
      <td bgcolor=<?=$color?>><?=$row["Inicio_Primera_Junta"]?></td>
      <?php
      $color = "";
      $date1 = $row["Cierre_Primera_Junta"];
      if(DateTime::createFromFormat('d-m-Y', $date1) !== false || DateTime::createFromFormat('d-M-Y', $date1) !== false)
      {
          $datetime1 = new DateTime($date1);
          if ($datetime1 < $datetime2) 
          {
            $color = "#36eb88";
          }
      }
      ?>
      <td bgcolor=<?=$color?>><?=$row["Cierre_Primera_Junta"]?></td>
      <?php
      $color = "";
      $date1 = $row["Inicio_Segunda_Junta"];
      if(DateTime::createFromFormat('d-m-Y', $date1) !== false || DateTime::createFromFormat('d-M-Y', $date1) !== false)
      {
          $datetime1 = new DateTime($date1);
          if ($datetime1 < $datetime2) 
          {
            $color = "#36eb88";
          }
      }
      ?>
      <td bgcolor=<?=$color?>><?=$row["Inicio_Segunda_Junta"]?></td>
      <?php
      $color = "";
      $date1 = $row["Cierre_Segunda_Junta"];
      if(DateTime::createFromFormat('d-m-Y', $date1) !== false || DateTime::createFromFormat('d-M-Y', $date1) !== false)
      {
          $datetime1 = new DateTime($date1);
          if ($datetime1 < $datetime2) 
          {
            $color = "#36eb88";
          }
      }
      ?>
      <td bgcolor=<?=$color?>><?=$row["Cierre_Segunda_Junta"]?></td>
      <?php
      $color = "";
      $date1 = $row["Inicio_Tercera_Junta"];
      if(DateTime::createFromFormat('d-m-Y', $date1) !== false || DateTime::createFromFormat('d-M-Y', $date1) !== false)
      {
          $datetime1 = new DateTime($date1);
          if ($datetime1 < $datetime2) 
          {
            $color = "#36eb88";
          }
      }
      ?>
      <td bgcolor=<?=$color?>><?=$row["Inicio_Tercera_Junta"]?></td>
      <?php
      $color = "";
      $date1 = $row["Cierre_Tercera_Junta"];
      if(DateTime::createFromFormat('d-m-Y', $date1) !== false || DateTime::createFromFormat('d-M-Y', $date1) !== false)
      {
          $datetime1 = new DateTime($date1);
          if ($datetime1 < $datetime2) 
          {
            $color = "#36eb88";
          }
      }
      ?>
      <td bgcolor=<?=$color?>><?=$row["Cierre_Tercera_Junta"]?></td>
      <?php
      $color = "";
      $date1 = $row["Inicio_Cuarta_Junta"];
      if(DateTime::createFromFormat('d-m-Y', $date1) !== false || DateTime::createFromFormat('d-M-Y', $date1) !== false)
      {
          $datetime1 = new DateTime($date1);
          if ($datetime1 < $datetime2) 
          {
            $color = "#36eb88";
          }
      }
      ?>
      <td bgcolor=<?=$color?>><?=$row["Inicio_Cuarta_Junta"]?></td>
      <?php
      $color = "";
      $date1 = $row["Cierre_Cuarta_Junta"];
      if(DateTime::createFromFormat('d-m-Y', $date1) !== false || DateTime::createFromFormat('d-M-Y', $date1) !== false)
      {
          $datetime1 = new DateTime($date1);
          if ($datetime1 < $datetime2) 
          {
            $color = "#36eb88";
          }
      }
      ?>
      <td bgcolor=<?=$color?>><?=$row["Cierre_Cuarta_Junta"]?></td>
      <?php
      $color = "";
      $date1 = $row["Recepcion_Propuesta"];
      if(DateTime::createFromFormat('d-m-Y', $date1) !== false || DateTime::createFromFormat('d-M-Y', $date1) !== false)
      {
          $datetime1 = new DateTime($date1);
          if ($datetime1 < $datetime2) 
          {
            $color = "#36eb88";
          }
      }
      ?>
      <td bgcolor=<?=$color?>><?=$row["Recepcion_Propuesta"]?></td>
      <?php
      $color = "";
      $date1 = $row["Fallo"];
      if(DateTime::createFromFormat('d-m-Y', $date1) !== false || DateTime::createFromFormat('d-M-Y', $date1) !== false)
      {
          $datetime1 = new DateTime($date1);
          if ($datetime1 < $datetime2) 
          {
            $color = "#36eb88";
          }
      }
      ?>
      <td bgcolor=<?=$color?>><?=$row["Fallo"]?></td>
      <?php
      $color = "";
      $date1 = $row["Firma_Contrato"];
      if(DateTime::createFromFormat('d-m-Y', $date1) !== false || DateTime::createFromFormat('d-M-Y', $date1) !== false)
      {
          $datetime1 = new DateTime($date1);
          if ($datetime1 < $datetime2) 
          {
            $color = "#36eb88";
          }
      }
      ?>
      <td bgcolor=<?=$color?>><?=$row["Firma_Contrato"]?></td>
      <?php
      $color = "";
      $date1 = $row["Inicio_Construccion"];
      if(DateTime::createFromFormat('d-m-Y', $date1) !== false || DateTime::createFromFormat('d-M-Y', $date1) !== false)
      {
          $datetime1 = new DateTime($date1);
          if ($datetime1 < $datetime2) 
          {
            $color = "#36eb88";
          }
      }
      ?>
      <td bgcolor=<?=$color?>><?=$row["Inicio_Construccion"]?></td>
      <?php
      $color = "";
      $date1 = $row["Termino_Construccion"];
      if(DateTime::createFromFormat('d-m-Y', $date1) !== false || DateTime::createFromFormat('d-M-Y', $date1) !== false)
      {
          $datetime1 = new DateTime($date1);
          if ($datetime1 < $datetime2) 
          {
            $color = "#36eb88";
          }
      }
      ?>
      <td bgcolor=<?=$color?>><?=$row["Termino_Construccion"]?></td>
      <td>$<?php echo number_format($row["Act_Prev_Inv"], 2, '.', ','); ?></td>
      <td>$<?php echo number_format($row["Monto_Max_Publicado"], 2, '.', ','); ?></td>
      <td>$<?php echo number_format($row["Monto_Adjudicado"], 2, '.', ','); ?></td>
      <td><?=$row["Empresa_Consorcio_Ganador"]?></td>
    </tr>
    <?php
  }
  ?>
    <tr>
      <th><strong>Tot</strong></th>
      <td><strong>Subdirección de Distribución</strong></td>
      <td colspan="3"><strong><?=$contador?> Proyectos</strong></td>
      <?php  
        $result = mysqli_query($conexion,'SELECT SUM(SE) AS sum FROM pgl'); 
        $row = mysqli_fetch_assoc($result); 
      ?>
      <td><strong><?=$row['sum']?></strong></td>
      <?php  
        $result = mysqli_query($conexion,'SELECT SUM(LT) AS sum FROM pgl'); 
        $row = mysqli_fetch_assoc($result); 
      ?>
      <td><strong><?=$row['sum']?></strong></td>
      <?php  
        $result = mysqli_query($conexion,'SELECT SUM(Alimentadores_AT) AS sum FROM pgl'); 
        $row = mysqli_fetch_assoc($result); 
      ?>
      <td><strong><?=$row['sum']?></strong></td>
      <?php  
        $result = mysqli_query($conexion,'SELECT SUM(Alimentadores_MT) AS sum FROM pgl'); 
        $row = mysqli_fetch_assoc($result); 
      ?>
      <td><strong><?=$row['sum']?></strong></td>
      <?php  
        $result = mysqli_query($conexion,'SELECT SUM(MVA) AS sum FROM pgl'); 
        $row = mysqli_fetch_assoc($result); 
      ?>
      <td><strong><?=$row['sum']?></strong></td>
      <?php  
        $result = mysqli_query($conexion,'SELECT SUM(MVAr) AS sum FROM pgl'); 
        $row = mysqli_fetch_assoc($result); 
      ?>
      <td><strong><?=$row['sum']?></strong></td>
      <?php  
        $result = mysqli_query($conexion,'SELECT SUM(KmC) AS sum FROM pgl'); 
        $row = mysqli_fetch_assoc($result); 
      ?>
      <td><strong><?=$row['sum']?></strong></td>
      <?php  
        $result = mysqli_query($conexion,'SELECT SUM(Numero_Aliment) AS sum FROM pgl'); 
        $row = mysqli_fetch_assoc($result); 
      ?>
      <td><strong><?=$row['sum']?></strong></td>
      <?php  
        $result = mysqli_query($conexion,'SELECT SUM(Medidores) AS sum FROM pgl'); 
        $row = mysqli_fetch_assoc($result); 
      ?>
      <td><strong><?=$row['sum']?></strong></td>
      <?php  
        $result = mysqli_query($conexion,'SELECT SUM(Transformadores_Distribucion) AS sum FROM pgl'); 
        $row = mysqli_fetch_assoc($result); 
      ?>
      <td><strong><?=$row['sum']?></strong></td>
      <?php  
        $result = mysqli_query($conexion,'SELECT SUM(Postes) AS sum FROM pgl'); 
        $row = mysqli_fetch_assoc($result); 
      ?>
      <td><strong><?=$row['sum']?></strong></td>
      <td colspan="14"></td>
      <?php  
        $result = mysqli_query($conexion,'SELECT SUM(Act_Prev_Inv) AS sum FROM pgl'); 
        $row = mysqli_fetch_assoc($result); 
      ?>
      <td><strong>$<?php echo number_format($row['sum'], 2, '.', ','); ?></strong></td>
      <?php  
        $result = mysqli_query($conexion,'SELECT SUM(Monto_Max_Publicado) AS sum FROM pgl'); 
        $row = mysqli_fetch_assoc($result); 
      ?>
      <td><strong>$<?php echo number_format($row['sum'], 2, '.', ','); ?></strong></td>
      <?php  
        $result = mysqli_query($conexion,'SELECT SUM(Monto_Adjudicado) AS sum FROM pgl'); 
        $row = mysqli_fetch_assoc($result); 
        mysqli_free_result($filtro);
        mysqli_free_result($result);
        mysqli_close($conexion);
      ?>
      <td><strong>$<?php echo number_format($row['sum'], 2, '.', ','); ?></strong></td>
      <td></td>
    </tr>
    </tbody>
  </table>
  </div>
  </font>

</section>
  
<div class="container">

  <div class="panel-heading"> 
    <ul class="pager">
      <li class="previous"><a href="OPF.php">Regresar</a></li>
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
        mywindow.document.write('<html><head><title>Programa General de Licitaciones</title>');
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

