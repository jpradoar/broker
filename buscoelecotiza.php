<?php
require_once("funciones.inc.php");
/*

if (falta_logueo())
{ 
	header('location:login.php');
	exit();
}
*/
 //$Xnombre = trim(strtoupper($_SESSION['usuario']));
 $Xnombre ="";
 session_start();

 
if($_POST){//SEGUNDOS POST
	if($_POST['BTNBusco']){
		
		$muestro_error = "";
		$algo_mal = false;
		
		$TXTNomArt	= strtoupper(trim($_POST['TXTNomArt']));
		$TXTCodBA	= strtoupper(trim($_POST['TXTCodBA']));
		$TXTcodCH	= strtoupper(trim($_POST['TXTcodCH']));

		$muestro_error = "";
		
		if(strlen($TXTNomArt)!=0){
		
		}else{
			$TXTNomArt ="";
		}

		if(strlen($TXTCodBA)!=0){
			/*if(!is_numeric($TXTCodBA)){
				$muestro_error.= " CODIGO BS AS ";
				$algo_mal = true;
			}*/	
		}else{
			$TXTCodBA = "";
		}
		
		if(strlen($TXTcodCH)!=0){
			/*if(!is_numeric($TXTcodCH)){
				$muestro_error.= " CODIGO CHINA ";
				$algo_mal = true;
			}*/		
		}else{
			$TXTcodCH = "";	
		}
		
		$muestro_error.= " DEBE/DEBEN SER NUMERICO/S ";
		
		if($algo_mal == false){	//Si esta todo bien
			header("Location: resuelecot.php?busco=E&nom=".$TXTNomArt."&codiba=".$TXTCodBA."&codch=".$TXTcodCH.""); 
			exit;
		}//fin Si esta todo bien
		
						
	}
}//SEGUNDOS POST
?>
<!DOCTYPE html>
<html>
 <head>
	<meta charset='iso-8859-1'>
	<title>_%%_empresanombre_%%_</title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="css/style.css">
    
    <link rel="stylesheet" type="text/css" href="css/slimmenu.css">
   	<script src="js/jquery.min.js"></script>
    
 </head>
<body>
	<div class="logo">_%%_empresanombre_%%_</div>
	<div id="page-wrap"> 
    
    <?php include 'menu.php'; ?>
    <form id="form1" name="form1" method="post">
	<p>USUARIO: <?php echo $Xnombre; ?></p>
    <table class="sombra">
		<thead>
		<tr>
			<th colspan="4" ><div align="center">BUSQUEDA ARTICULOS COTIZACION</div></th>
		  </tr>
		</thead>
		<tbody>
		<tr>
		  <td colspan="2"><div align="right"><strong>Nombre del Articulo:</strong></div></td>
		  <td colspan="2"><strong>
	      <input type="text" name="TXTNomArt" id="TXTNomArt" class="button">
		  </strong></td>
		  </tr>
		<tr>
		  <td><strong>Codigo en Bs. As.</strong></td>
		  <td><strong>
	      <input type="text" name="TXTCodBA" id="TXTCodBA" class="button">
		  </strong></td>
		  <td><strong>Codigo en China:</strong></td>
		  <td><input type="text" name="TXTcodCH" id="TXTcodCH" class="button"></td>
		  </tr>
		<tr>
		  <td colspan="4"><div align="center"><input type="submit" name="BTNBusco" id="BTNBusco" class="button" value="BUSCAR"></div></td>
		  </tr>
		<tr>
			<td colspan="4">&nbsp;</td>
		  </tr>
		</tbody>
	</table>
    <br>
    <br>
     </form>  
     </div> 
<script src="js/jquery.slimmenu.js"></script>
<script src="js/jquery.easing.min.js"></script>
<script>
	$('ul.slimmenu').slimmenu(
	{
		resizeWidth: '800',
		collapserTitle: 'Seleccione',
		easingEffect:'easeInOutQuint',
		animSpeed:'medium',
		indentChildren: true,
		childrenIndenter: '&raquo;'
	});
</script>    
</body>
</html>
