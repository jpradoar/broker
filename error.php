<?php
require_once('funciones.inc.php');

 $Xaccion = $_GET['accion'];

 //Veo el tipo de error para completar la pagina

 if($Xaccion == "Err01"){
	$Xboton	= '<p>EN ESTOS MOMENTOS NO PODEMOS RESPODER SU CONSULTA. </p><p>POR FAVOR INTENTE NUEVAMENTE MAS TARDE.</p><br>';
 }

 if($Xaccion == "Err02" || $Xaccion	== "Err03"){
	$Xaccion = $_GET['accion'];
		
	switch ($Xaccion){
		case 'Err02':$xrta = "No se hallo ese usuario.";
		break;
		case 'Err03':$xrta = "Password incorrecto.";
		break;
		default :$xrta = "           ";
	}
			
	$Xveo_nota	=	"Verifique";
  }
	
	
 if($_POST){	
	if($_POST['XBOTON']){
		header('location:index.php');
		die;
	}
 }	
?>
<!DOCTYPE html>
<html>
 <head>
	<meta charset='iso-8859-1'>
	<title>Hotel Masliah - Gestion de Limpieza de las Habitaciones</title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!--<meta http-equiv="refresh" content="5;url=http://localhost/Limpieza/index.php">-->
	<link rel="stylesheet" href="css/style.css">
 </head>
<body>
	<div class="logo">_%%_empresanombre_%%_</div>
	<div id="page-wrap">    
	<form action="" method="post" name="form1" >
    <table class="sombra">
		<thead>
		<tr>
        	<th><div align="center"> Ha ocurrido un error, vuelva a intentarlo mas tarde.<?php echo '<br>'.$xrta.'<br>'.$Xveo_nota.'<br>'; ?></div>
       	    </th>
		</tr>
		</thead>
		<tbody>
		<tr>
			<td><div align="center"><button type="submit" name="XBOTON" id="XBOTON" value="Enviar" class="button">Volver</button></div></td>
		</tr>
		</tbody>
	</table>
    </form>
	</div>
</body>
</html>