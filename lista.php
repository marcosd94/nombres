<?php
header('Content-Type: text/html; charset=UTF-8');
$nombre = strtoupper($_POST['nombre']);
$apellido = strtoupper($_POST['apellido']);
$apellido =str_replace("ñ","Ñ",$apellido);
echo "<div><p align='center'><b>Persona: ".$nombre."  ".$apellido."</b></p></div>";
if ($nombre == null || $apellido == null )
{
    echo "<p align='center'><span>Por favor completa todos los campos.  </pan></p>";
echo'<script type="text/javascript">alert("POR FAVOR COMPLETA TODOS LOS CAMPOS");</script>';
    echo '<script>location.href= "index.php";</script>';
}else{
    
    $servidor = "10.2.29.182";
			$usuariodb = "wssfp";
			$passdb = "w3bs3rv!c3";
			$db = "identificaciones";
			
			try {
			 
			 $idConexion = pg_connect("host=" . $servidor . " port=5432 user=" . $usuariodb . " password=" . $passdb . " dbname=" . $db);
			 
			}
			catch (Exception $e) {
				echo $e;
			}

			$sql = "SELECT cedula,nombres,apellido,fech_nacim,lugar_nacim,nacionalidad,sexo,estado_civil FROM cedulas WHERE nombres like '%".pg_escape_string($nombre)."%' AND apellido LIKE '%".pg_escape_string($apellido)."%' AND (fech_nacim < '1998-01-01' AND  fech_nacim > '1930-01-01') ORDER BY fech_nacim DESC";
			$datos = pg_query($idConexion, $sql);
			if (pg_num_rows($datos) > 0) {
			
				//la fecha de nacimiento la pasamos en formato ISO 8601 YYY-MM-DD 
				//$registro = pg_fetch_array($datos);
        ?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<link rel="stylesheet" type="text/css" href="estilos.css">
<title>Lista</title>
</head>

<body>
  <div style="overflow-x:auto;">
    <table>
      <tr>
        <th>Nro.</th>
        <th>Cédula</th>
        <th>Nombres</th>
        <th>Apellidos</th>
        <th>Fecha de Nacimiento</th>
        <th>Lugar de Nacimiento</th>
        <th>Nacionalidad</th>
        <th>Sexo</th>
        <th>Estado Civil</th>
      </tr>
<?php
     $c=0;
     while($registro = pg_fetch_array($datos)){
        $c++;
?>
      <tr>
        <td><?php echo $c;?></td>
        <td><?php echo utf8_decode($registro['cedula']);?></td>
        <td><?php echo str_replace("Ã","Ñ",utf8_encode($registro['nombres']));?></td>
        <td><?php echo str_replace("Ã","Ñ",utf8_encode($registro['apellido']));?></td>
        <td><?php echo $registro['fech_nacim'];?></td>
        <td><?php echo str_replace("Ã","Ñ",utf8_encode($registro['lugar_nacim']));?></td>
        <td><?php echo str_replace("Ã","Ñ",utf8_encode($registro['nacionalidad']));?></td>
        <td><?php echo str_replace("Ã","Ñ",utf8_encode($registro['sexo']));?></td>
        <td><?php echo str_replace("Ã","Ñ",utf8_encode($registro['estado_civil']));?></td>
      </tr>
        <?php 
     
     
     }
    pg_close($idConexion);
            }else{
        echo "<p align='center'>Los datos de la persona: ".$nombre."  ".$apellido." no existen en la BD Identificaciones. Favor verifique.</p>";  
    pg_close($idConexion);  
            }
}
        ?>
    </table>
</div>
</body>
</html>
