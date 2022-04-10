<?php 
	function historial($actividad,$conexion)
	{
	    $usuario = $_SESSION['usuario'];
	    $fecha = date("d-m-Y");
	    $hora = date ("H:i:s");
	    $direccion_ip = $_SERVER['REMOTE_ADDR'];
	    $user_agent = $_SERVER['HTTP_USER_AGENT'];	    
	    $result=mysqli_query($conexion,"SELECT Id FROM historial ORDER BY Id DESC");
	    $row=mysqli_fetch_array($result);
	    $id = $row["Id"]+1;
	    function getBrowser($user_agent)
	    {
	    	if(strpos($user_agent, 'MSIE') !== FALSE)
	        	return 'Internet Explorer';
	        elseif(strpos($user_agent, 'Edge') !== FALSE) 
	        	return 'Microsoft Edge';
	        elseif(strpos($user_agent, 'Trident') !== FALSE) 
	            return 'Internet Explorer';
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
	    $navegador = getBrowser($user_agent);
	    $sql="INSERT INTO historial (Id,Usuario,Fecha,Hora,Actividad,Direccion_IP,Navegador) VALUES ('$id','$usuario','$fecha','$hora','$actividad','$direccion_ip','$navegador');";
        if ($conexion->query($sql) === TRUE) 
        {
            //echo '<center>'.'<font color="red">'."Historial registrado satisfactoriamente.".'</font>'."<br>"."<br>".'</center>';
        } 
        else 
        {
            echo "Error: " . $sql . "<br>" . $conexion->error;
        }
    }
?>
