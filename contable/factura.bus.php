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
		#LSTfeIn LSTfeFIN RDOFecha RDOEstFac
		
		
		$RDOFecha	= strtoupper(trim($_POST['RDOFecha']));
		
		$LSTfeIn 	= trim($_POST['LSTfeIn_anio'].'-'.$_POST['LSTfeIn_mes'].'-'.$_POST['LSTfeIn_dia']);
		$LSTfeFIN 	= trim($_POST['LSTfeFIN_anio'].'-'.$_POST['LSTfeFIN_mes'].'-'.$_POST['LSTfeFIN_dia']);
		
		$RDOEstFac	 	= strtoupper(trim($_POST['RDOEstFac']));
		
		header("Location: factura.res.php?busco=F&BuscoFe=".$RDOFecha."&fechaIN=".$LSTfeIn."&fechaFIN=".$LSTfeFIN."&EstFac=".$RDOEstFac.""); 
		exit;				
	}
	
	if($_POST['BTNvolver']){
		header("Location: index.php"); 
		exit;	
	}
		
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
	<div class="logo">BHI - BROKERS</div> 
	<div id="page-wrap"> 
    
    <?php include 'menu.php'; ?>
     <form id="form1" name="form1" method="post">
	<p>USUARIO: <?php echo $Xnombre; ?></p>
    <table class="sombra">
		<thead>
		<tr>
			<th colspan="5" ><div align="center">BUSQUEDA DE FACTURAS</div></th>
		  </tr>
		</thead>
		<tbody>
		<tr>
		  <td colspan="5">&nbsp;</td>
		  </tr>
		<tr>
		  <td colspan="5"><div align="center"><strong>BUSCAR FACTURAS ENTRE FECHAS</strong></div></td>
		  </tr>
		<tr>
		  <td width="28%"><strong>Fecha Inicio:</strong></td>
		  <td width="16%"><strong>
		    <?php pinto_fecha('LSTfeIn','','');?>
		  </strong></td>
		  <td width="19%"><strong>Fecha Fin:</strong></td>
		  <td width="23%"><strong>
		    <?php pinto_fecha('LSTfeFIN','','');?>
		  </strong></td>
		  <td width="14%"><strong>
		    <input type="radio" name="RDOFecha" id="radio" value="S">
SI
<input name="RDOFecha" type="radio" id="RDOFecha" value="N" checked="checked">
NO</strong></td>
		  </tr>
		<tr>
		  <td>&nbsp;</td>
		  <td>&nbsp;</td>
		  <td>&nbsp;</td>
		  <td>&nbsp;</td>
		  <td>&nbsp;</td>
		  </tr>
		<tr>
		  <td><strong>Estado Facturas:</strong></td>
		  <td colspan="3"><strong>
		    <input type="radio" name="RDOEstFac" id="RDOEstFac" value="AB">
		  Abierto 
		    <input type="radio" name="RDOEstFac" id="RDOEstFac" value="CE" checked>
		  Cerrado
		    <input type="radio" name="RDOEstFac" id="RDOEstFac" value="AM">
		  Ambos</strong></td>
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
