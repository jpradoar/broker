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
		
		$TXTNumDesp		= strtoupper(trim($_POST['TXTNumDesp']));
		$LSTfechaDES 	= trim($_POST['LSTfechaDES_anio'].'-'.$_POST['LSTfechaDES_mes'].'-'.$_POST['LSTfechaDES_dia']);
		$LSTfechaDESFIN = trim($_POST['LSTfechaDESFIN_anio'].'-'.$_POST['LSTfechaDESFIN_mes'].'-'.$_POST['LSTfechaDESFIN_dia']);
		$RDOFecha	 	= strtoupper(trim($_POST['RDOFecha']));	
		$TXTPosAra		= strtoupper(trim($_POST['TXTPosAra']));

		
		if($algo_mal == false){	//Si esta todo bien
			header("Location: resudespa.php?busco=E&fecha=".$LSTfechaDES."&despa=".$TXTNumDesp."&feson=".$RDOFecha."&fechaf=".$LSTfechaDESFIN."&posara=".$TXTPosAra."");  
			exit;
		}//fin Si esta todo bien
		
						
	}
	if($_POST['BTNvolver']){
		header("Location: index.php"); 
		exit;	
	}
		
}//SEGUNDOS POST
else{
	$TXTNumDesp		="";
	$LSTfechaDES 	="";
	$LSTfechaDESFIN ="";
	$RDOFecha	 	="";		
}
?>
<!DOCTYPE html>
<html>
 <head>
	<meta charset='iso-8859-1'>
	<title>_%%_empresanombre_%%_</title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="../css/style.css">
    
    <link rel="stylesheet" type="text/css" href="../css/slimmenu.css">
   	<script src="../js/jquery.min.js"></script>
    
 </head>
<body>
	<div id="page-wrap"> 
    
    <?php include 'menu.php'; ?>
     <form id="form1" name="form1" method="post">
    <div class="caption">_%%_empresanombre_%%_.</div> 
	<p>USUARIO: <?php echo $Xnombre; ?></p>
    <table class="sombra">
		<thead>
		<tr>
			<th colspan="5" ><div align="center">BUSQUEDA DESPACHO</div></th>
		  </tr>
		</thead>
		<tbody>
		<tr>
		  <td width="20%"><strong>N&ordm; DESPACHO:</strong></td>
		  <td><input type="text" name="TXTNumDesp" id="TXTNumDesp" class="button"></td>
		  <td><strong>POSICION ARANCELARIA:</strong></td>
		  <td colspan="2"><input type="text" name="TXTPosAra" id="TXTPosAra" class="button"></td>
		  </tr>
		<tr>
		  <td colspan="5">&nbsp;</td>
		  </tr>
		<tr>
		  <td colspan="5"><div align="center"><strong>BUSQUEDA POR FECHA DE OFICIALIZACION</strong></div></td>
		  </tr>
		<tr>
		  <td><strong>Fecha Inicio:</strong></td>
		  <td><strong>
		    <?php pinto_fecha('LSTfechaDES','','');?>
		    </strong></td>
		  <td><strong>Fecha Fin:</strong></td>
		  <td><strong>
		    <?php pinto_fecha('LSTfechaDESFIN','','');?>
		    </strong></td>
		  <td><strong>
		    <input type="radio" name="RDOFecha" id="RDOFecha" value="S">
		    SI
		    <input type="radio" name="RDOFecha"  id="RDOFecha" value="N" checked="checked">
		    NO</strong></td>
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
     </form>
     	</div>   
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
