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
		
		$TXTNroBL	 	= strtoupper(trim($_POST['TXTNroBL']));
		$LSTCliente	 	= strtoupper(trim($_POST['LSTCliente']));
		$SELFactu	 	= strtoupper(trim($_POST['SELFactu']));
		
		$LSTfechaCOT 	= trim($_POST['LSTfechaCOT_anio'].'-'.$_POST['LSTfechaCOT_mes'].'-'.$_POST['LSTfechaCOT_dia']);
		$LSTfechaCOTFIN = trim($_POST['LSTfechaCOTFIN_anio'].'-'.$_POST['LSTfechaCOTFIN_mes'].'-'.$_POST['LSTfechaCOTFIN_dia']);
		$RDOFecha	 	= strtoupper(trim($_POST['RDOFecha']));


		$LSTfechaLlegaI 	= trim($_POST['LSTfechaLlegaI_anio'].'-'.$_POST['LSTfechaLlegaI_mes'].'-'.$_POST['LSTfechaLlegaI_dia']);
		$LSTfechaLlegaFIN = trim($_POST['LSTfechaLlegaFIN_anio'].'-'.$_POST['LSTfechaLlegaFIN_mes'].'-'.$_POST['LSTfechaLlegaFIN_dia']);
		$RDOFechaLlega	 	= strtoupper(trim($_POST['RDOFechaLlega']));
		
		$muestro_error = "";
		
		if(strlen($TXTNroBL)!=0){
			if(!is_numeric($TXTNroBL)){
				$muestro_error.= " NUMERO BL ";
				$algo_mal = true;
			}		
		}else{
			$TXTNroBL = "";	
		}
		
		$muestro_error.= " DEBE/DEBEN SER NUMERICO/S ";

		if($algo_mal == false){	//Si esta todo bien
			header("Location: resuemba.php?busco=E&cli=".$LSTCliente."&fecha=".$LSTfechaCOT."&nrobl=".$TXTNroBL."&feson=".$RDOFecha."&fechaf=".$LSTfechaCOTFIN."&destino=".$SELFactu."&fechallega=".$RDOFechaLlega."&fechellegai=".$LSTfechaLlegaI."&fechellegaf=".$LSTfechaLlegaFIN.""); 
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
			<th colspan="5" ><div align="center">BUSQUEDA EMBARQUES</div></th>
		  </tr>
		</thead>
		<tbody>
		<tr>
		  <td><strong>FACTURADO COMO:</strong></td>
		  <td><select name="SELFactu" id="SELFactu" class="button">
		    <option value="***">Seleccione..</option>
		    <option value="BHI">BHI</option>
		    <option value="EMPRINCE">EMPRINCE</option>
		    <option value="BSD">BSD</option>
		    </select></td>
		  <td colspan="3">&nbsp;</td>
		  </tr>
		<tr>
		  <td><strong>NRO. BL.:</strong></td>
		  <td><input type="text" name="TXTNroBL" id="TXTNroBL" class="button"></td>
		  <td>&nbsp;</td>
		  <td>&nbsp;</td>
		  <td>&nbsp;</td>
		  </tr>
		<tr>
		  <td colspan="5"><div align="center"><strong>BUSQUEDA POR FECHAS</strong></div></td>
		  </tr>
		<tr>
		  <td colspan="5"><strong>Fecha Embarque</strong></td>
		  </tr>
		<tr>
		  <td width="20%"><strong>Fecha Inicio:</strong></td>
		  <td><strong>
		    <?php pinto_fecha('LSTfechaCOT','','');?>
		  </strong></td>
		  <td><strong>Fecha Fin:</strong></td>
		  <td><strong>
		    <?php pinto_fecha('LSTfechaCOTFIN','','');?>
		  </strong></td>
		  <td><strong>
		    <input type="radio" name="RDOFecha" id="radio" value="S">
SI
<input name="RDOFecha" type="radio" id="radio2" value="N" checked="checked">
NO</strong></td>
		  </tr>
		<tr>
		  <td colspan="5">&nbsp;</td>
		  </tr>
		<tr>
		  <td colspan="5"><strong>Fecha Llegada</strong></td>
		  </tr>
		<tr>
		  <td><strong>Fecha Inicio:</strong></td>
		  <td><strong>
		    <?php pinto_fecha('LSTfechaLlegaI','','');?>
		    </strong></td>
		  <td><strong>Fecha Fin:</strong></td>
		  <td><strong>
		    <?php pinto_fecha('LSTfechaLlegaFIN','','');?>
		    </strong></td>
		  <td><strong>
		    <input type="radio" name="RDOFechaLlega" id="RDOFechaLlega" value="S">
		    SI
		    <input name="RDOFechaLlega" type="radio" id="RDOFechaLlega" value="N" checked="checked">
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
