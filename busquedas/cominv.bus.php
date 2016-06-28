<?php
require_once("../funciones.inc.php");
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
		
		$TXTNumComImv	= strtoupper(trim($_POST['TXTNumComImv']));
		$SELFactu	 	= strtoupper(trim($_POST['SELFactu']));


		$muestro_error = "";
		
		if(strlen($TXTNumComImv)!=0){
			if(!is_numeric($TXTNumComImv)){
				$muestro_error.= " NRO COMERCIAL INVOICE ";
				$algo_mal = true;
			}		
		}else{
			$TXTNumComImv = "";	
		}
		
		$muestro_error.= " DEBE/DEBEN SER NUMERICO/S ";
		
		if($algo_mal == false){	//Si esta todo bien
			header("Location: resucominv.php?busco=E&nrocominv=".$TXTNumComImv."&destino=".$SELFactu.""); 
			exit;
		}//fin Si esta todo bien
		
						
	}
	if($_POST['BTNvolver']){
		header("Location: ../index.php");
		exit;	
	}
		
}//SEGUNDOS POST
else{
	$LSTfechaCOTFIN ="";
	$LSTfechaCOT	="";
}
?>
<!DOCTYPE html>
<html>
 <head>
	<meta charset='iso-8859-1'>
	<title>BHI - Sistema Administrativo</title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="../css/style.css">
    
    <link rel="stylesheet" type="text/css" href="../css/slimmenu.css">
   	<script src="../js/jquery.min.js"></script>
    
 </head>
<body>
	<div id="page-wrap"> 
    
    <?php include 'menu.php'; ?>
     <form id="form1" name="form1" method="post">
    <div class="caption">BHI - BROKERS.</div> 
	<p>USUARIO: <?php echo $Xnombre; ?></p>
    <table class="sombra">
		<thead>
		<tr>
			<th colspan="5" ><div align="center">BUSQUEDA <strong>COMERCIAL INVOICE</strong></div></th>
		  </tr>
		</thead>
		<tbody>
		<tr>
		  <td width="20%"><strong>FACTURADO COMO:</strong></td>
		  <td><select name="SELFactu" id="SELFactu" class="button">
		    <option value="***">Seleccione..</option>
		    <option value="BHI">BHI</option>
		    <option value="EMPRINCE">EMPRINCE</option>
		    <option value="BSD">BSD</option>
		    </select></td>
		  <td colspan="3">&nbsp;</td>
		  </tr>
		<tr>
		  <td><strong>NRO. COMERCIAL INVOICE:</strong></td>
		  <td><input type="text" name="TXTNumComImv" id="TXTNumComImv" class="button"></td>
		  <td>&nbsp;</td>
		  <td>&nbsp;</td>
		  <td>&nbsp;</td>
		  </tr>
		<tr>
		  <td colspan="5">&nbsp;</td>
		  </tr>
		<tr>
		  <td colspan="5"><div align="center"><input type="submit" name="BTNBusco" id="BTNBusco" class="button" value="BUSCAR">
		    <span style="color: #000">
		    <input type="submit" name="BTNvolver" id="BTNvolver" class="button" value="Volver Al Menu">
		    </span></div></td>
		  </tr>
		<tr>
			<td colspan="5">&nbsp;</td>
		  </tr>
		</tbody>
	</table>
    <br>
    <br>
     </form>   
<script src="../js/jquery.slimmenu.js"></script>
<script src="../js/jquery.easing.min.js"></script>
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
