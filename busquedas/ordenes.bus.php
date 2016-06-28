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
		
		
		$TXTNroOrd	 	= strtoupper(trim($_POST['TXTNroOrd']));
		$SELFactu	 	= strtoupper(trim($_POST['SELFactu']));
		$LSTCliente	 	= strtoupper(trim($_POST['LSTCliente']));
		
		$LSTfechaCOT 	= trim($_POST['LSTfechaCOT_anio'].'-'.$_POST['LSTfechaCOT_mes'].'-'.$_POST['LSTfechaCOT_dia']);
		$LSTfechaCOTFIN = trim($_POST['LSTfechaCOTFIN_anio'].'-'.$_POST['LSTfechaCOTFIN_mes'].'-'.$_POST['LSTfechaCOTFIN_dia']);
		$RDOFecha	 	= strtoupper(trim($_POST['RDOFecha']));

		$muestro_error = "";
				
		if(strlen($TXTNroOrd)!=0){
			if(!is_numeric($TXTNroOrd)){
				$muestro_error.= " NRO DE ORDEN ";
				$algo_mal = true;
			}		
		}else{
			$TXTNroOrd = "";	
		}
		
		$muestro_error.= " DEBE/DEBEN SER NUMERICO/S ";
		
		if($algo_mal == false){	//Si esta todo bien
			header("Location: resuord.php?busco=E&cli=".$LSTCliente."&fecha=".$LSTfechaCOT."&nrofac=".$SELFactu."&feson=".$RDOFecha."&fechaf=".$LSTfechaCOTFIN."&nroord=".$TXTNroOrd.""); 
			exit;
		}//fin Si esta todo bien
		
						
	}
	if($_POST['BTNvolver']){
		header("Location: ../index.php");
		exit;	
	}
		
}//SEGUNDOS POST
else{
	$TXTNroOrd	 	="";
	$SELFactu	 	="";
	$LSTCliente	 	="";
		
	$LSTfechaCOT 	="";
	$LSTfechaCOTFIN ="";
	$RDOFecha	 	="";
}

///////////////////////////// LISTADOS /////////////////////////////

	#TRAIGO EL NOMBRE DE LOS CLIENTES------------------->
	$db_Cliente  = conecto();
	$sql_Cliente = " select ape_cli, nom_cli, cod_cli from clientes order by ape_cli ASC ";
	$r_Cliente   = mysqli_query($db_Cliente, $sql_Cliente);

	if ($r_Cliente == false){
    	mysqli_close($db_Cliente);
        $error = "Error: (" . mysql_errno() . ") " . mysql_error().")";
        //gestion_errores();
    }
        mysqli_close($db_Cliente);
	#FIN TRAIGO EL NOMBRE DE LOS CLIENTES------------------->

///////////////////////////// fin LISTADOS /////////////////////////////	
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
 
 	<!-- AUTOCOMPLETAR -->
    <link rel="stylesheet" href="../development/themes/base/jquery.ui.all.css">
    <script src="../development/jquery-1.7.2.js"></script>
    <script src="../development/ui/jquery.ui.core.js"></script>
    <script src="../development/ui/jquery.ui.widget.js"></script>
    <script src="../development/ui/jquery.ui.button.js"></script>
    <script src="../development/ui/jquery.ui.position.js"></script>
    <script src="../development/ui/jquery.ui.autocomplete.js"></script>
    <link rel="stylesheet"  type="text/css" href="../css/menues.css">
    <script src="../js/menues.js"></script>
    <!-- AUTOCOMPLETAR -->
       
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
			<th colspan="5" ><div align="center">BUSQUEDA  ORDENES DE COMPRA</div></th>
		  </tr>
		</thead>
		<tbody> 
		<tr>
		  <td width="20%"><strong>NUMERO DE ORDEN:</strong></td>
		  <td><input type="text" name="TXTNroOrd" id="TXTNroOrd" class="button"></td>
		  <td><strong>FACTURADO COMO:</strong></td>
		  <td colspan="2"><select name="SELFactu" class="button" id="SELFactu">
		    <option value="***">Seleccione..</option>
            <option value="BHI">BHI</option>
		    <option value="EMPRINCE">EMPRINCE</option>
		    <option value="BSD">BSD</option>
	      </select></td>
		  </tr>
		<tr>
		  <td><strong>CLIENTE:</strong></td>
		  <td colspan="4"><span style="color: #000">
		    <select name="LSTCliente" id="combox" value="<?php echo $XLSTCliente; ?>" class="button">
		      <option value="000"></option>
		      <?php 
				while ($arr_Cliente = mysqli_fetch_array($r_Cliente))			
				{		
					$XseltCliente = '';
					
					if (trim($arr_Cliente['cod_cli'])==trim($XLSTCliente)){	
						$XseltCliente = 'selected ';
					}	
			
					echo '<option value="'.trim($arr_Cliente['cod_cli']).'" '.$XseltCliente.'>'.' '.trim($arr_Cliente['ape_cli']).', ' .trim($arr_Cliente['nom_cli']).'</option>'."\n\t\t";
				}
					
				?>
	      </select>
		  </span></td>
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
		    <input type="radio" name="RDOFecha" id="RDOFecha" value="S">SI<input name="RDOFecha" type="radio" id="RDOFecha" value="N" checked="checked">NO</strong></td>
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
