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
		
		$TXTNomArt	 	= strtoupper(trim($_POST['TXTNomArt']));
		$LSTfechaCOT 	= trim($_POST['LSTfechaCOT_anio'].'-'.$_POST['LSTfechaCOT_mes'].'-'.$_POST['LSTfechaCOT_dia']);
		$LSTfechaCOTFIN = trim($_POST['LSTfechaCOTFIN_anio'].'-'.$_POST['LSTfechaCOTFIN_mes'].'-'.$_POST['LSTfechaCOTFIN_dia']);
		$TXTcodBA	 	= strtoupper(trim($_POST['TXTcodBA']));
		$RDOFecha	 	= strtoupper(trim($_POST['RDOFecha']));

		$muestro_error = "";
		
		if(strlen($TXTNomArt)!=0){
		
		}else{
			$TXTNomArt ="";
		}
		
		if(strlen($TXTcodBA)!=0){
			/*if(!is_numeric($TXTcodCH)){
				$muestro_error.= " CODIGO CHINA ";
				$algo_mal = true;
			}*/		
		}else{
			$TXTcodBA = "";	
		}
		
		$muestro_error.= " DEBE/DEBEN SER NUMERICO/S ";
		
		if($algo_mal == false){	//Si esta todo bien
			header("Location: resucotcli.php?busco=E&nom=".$TXTNomArt."&fecha=".$LSTfechaCOT."&codba=".$TXTcodBA."&feson=".$RDOFecha."&fechaf=".$LSTfechaCOTFIN.""); 
			exit;
		}//fin Si esta todo bien
		
						
	}
	if($_POST['BTNvolver']){
		header("Location: index.php"); 
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
			<th colspan="7" ><div align="center">BUSQUEDA DE COTIZACION</div></th>
		  </tr>
		</thead>
		<tbody>
		<tr>
		  <td><div align="right"><strong>Nombre del Articulo:</strong></div></td>
		  <td colspan="4"><strong>
		    <input name="TXTNomArt" type="text" class="button" id="TXTNomArt" size="70" maxlength="80">
		  </strong></td>
		  <td colspan="2">&nbsp;</td>
		  </tr>
		<tr>
		  <td><strong>Fecha Inicio:</strong></td>
		  <td><strong>
		    <?php pinto_fecha('LSTfechaCOT','',$LSTfechaCOT);?>
		  </strong></td>
		  <td><strong>Fecha Fin:</strong></td>
		  <td><strong>
		    <?php pinto_fecha('LSTfechaCOTFIN','',$LSTfechaCOTFIN);?>
		  </strong></td>
		  <td><strong>
		    <input type="radio" name="RDOFecha" id="radio" value="S">
SI
<input name="RDOFecha" type="radio" id="radio2" value="N" checked="checked">
NO</strong></td>
		  <td><strong>Codigo en Bs. As.:</strong></td>
		  <td><input type="text" name="TXTcodBA" id="TXTcodBA" class="button"></td>
		  </tr>
		<tr>
		  <td colspan="7"><div align="center"><input type="submit" name="BTNBusco" id="BTNBusco" class="button" value="BUSCAR">
		    <span style="color: #000">
		    <input type="submit" name="BTNvolver" id="BTNvolver" class="button" value="Volver Al Menu">
		    </span></div></td>
		  </tr>
		<tr>
			<td colspan="7">&nbsp;</td>
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
