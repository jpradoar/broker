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
		
		
		$SELFactu	 	= strtoupper(trim($_POST['SELFactu']));
		$LSTfechaCOT 	= trim($_POST['LSTfechaCOT_anio'].'-'.$_POST['LSTfechaCOT_mes'].'-'.$_POST['LSTfechaCOT_dia']);
		$LSTfechaCOTFIN = trim($_POST['LSTfechaCOTFIN_anio'].'-'.$_POST['LSTfechaCOTFIN_mes'].'-'.$_POST['LSTfechaCOTFIN_dia']);
		$RDOFecha	 	= strtoupper(trim($_POST['RDOFecha']));

		header("Location: resugiro.php?busco=E&fecha=".$LSTfechaCOT."&empre=".$SELFactu."&feson=".$RDOFecha."&fechaf=".$LSTfechaCOTFIN.""); 
		exit;
						
	}
	if($_POST['BTNvolver']){
		header("Location: ../index.php");
		exit;	
	}
		
}//SEGUNDOS POST
else{
	$SELFactu	 	="";
	$LSTfechaCOT 	="";
	$LSTfechaCOTFIN ="";
	$RDOFecha	 	="";	
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
			<th colspan="5" ><div align="center">BUSQUEDA DE GIROS A CHINA</div></th>
		  </tr>
		</thead>
		<tbody>
		<tr>
		  <td width="20%"><strong>FACTURADO COMO:</strong></td>
		  <td><select name="SELFactu" class="button" id="SELFactu">
		    <option value="***">Seleccione..</option>
		    <option value="BHI">BHI</option>
		    <option value="EMPRINCE">EMPRINCE</option>
		    <option value="BSD">BSD</option>
	      </select></td>
		  <td>&nbsp;</td>
		  <td colspan="2">&nbsp;</td>
		  </tr>
		<tr>
		  <td colspan="5"><div align="center"><strong>BUSQUEDA POR FECHAS</strong></div></td>
		  </tr>
		<tr>
		  <td><strong>Fecha Inicio:</strong></td>
		  <td><strong>
		    <?php pinto_fecha('LSTfechaCOT','','');?>
		  </strong></td>
		  <td><strong>Fecha Fin:</strong></td>
		  <td><strong>
		    <?php pinto_fecha('LSTfechaCOTFIN','','');?>
		  </strong></td>
		  <td><strong>
		    <input type="radio" name="RDOFecha" id="radio" value="S">SI<input name="RDOFecha" type="radio" id="radio2" value="N" checked="checked">NO</strong></td>
		  </tr>
		<tr>
		  <td colspan="5">&nbsp;</td>
		  </tr>
		<tr>
		  <td colspan="5"><div align="center"><input type="submit" name="BTNBusco" id="BTNBusco" class="button" value="BUSCAR">
		    <input type="submit" name="BTNvolver" id="BTNvolver" class="button" value="Volver Al Menu">
		    </div></td>
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
