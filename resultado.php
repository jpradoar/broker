<?php
require_once('funciones.inc.php');
/*
if (falta_logueo())
{ 
	header ('location:login.php');
	exit();
}
*/ 
 $Xaccion	= $_GET['acc'];

 if($Xaccion=="ELI"){
	$xrta = "EL USUARIO HA SIDO ELIMINADO";
 }

 if($Xaccion=="MOD"){
	$xrta = "EL USUARIO HA SIDO MODIFICADO";
 }
	
		
 if($_POST){	
 
	if($_POST['XBOTON']){
		header('location:index.php');
		die;
	}
	
	if($_POST['XBOTONCM']){
		header('location:usuarios.php');
		die;
	}
 }	
?>
<!DOCTYPE html>
<html>
 <head>
	<meta charset='iso-8859-1'>
	<title>BHI - Sistema Administrativo</title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!--<meta http-equiv="refresh" content="5;url=http://localhost/Limpieza/index.php">-->
	<link rel="stylesheet" href="css/style.css">
 </head>
<body>
	<div class="logo">BHI - BROKERS</div>
	<div id="page-wrap">   
	<form action="" method="post" name="form1" >
    <table class="sombra" border="0">
		<thead>
		<tr>
        	<th><div align="center"> FELICITACIONES.<?php echo '<br>'.$xrta.'<br>'; ?></div>
       	    </th>
		</tr>
		</thead>
		<tbody>
		<tr>
			<td><div align="center"><button type="submit" name="XBOTON" id="XBOTON" value="Enviar" class="button">Volver Menu</button><button type="submit" name="XBOTONCM" id="XBOTONCM" value="Enviar" class="button">Continuar Modificaciones</button></div></td>
		</tr>
		</tbody>
	</table>
    </form>
	</div>
</body>
</html>