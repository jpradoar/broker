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

///////////////////////////// LISTADOS /////////////////////////////

	#TRAIGO EL NOMBRE DE LOS ARTICULOS PARA COTIZAR
	$db_Elemento  = conecto();
	$sql_Elemento = "select nom_ele_cot, cod_ele_cot from elementoscot order by nom_ele_cot ASC ";
	$r_Elemento   = mysqli_query($db_Elemento, $sql_Elemento);

	if ($r_Elemento == false){
    	mysqli_close($db_Elemento);
        $error = "Error: (" . mysql_errno() . ") " . mysql_error().")";
        //gestion_errores();
    }
        mysqli_close($db_Elemento);
		
///////////////////////////// FIN LISTADOS /////////////////////////////
 
if($_POST){//SEGUNDOS POST
	if($_POST['BTNBusco']){
		
		$muestro_error = "";
		$algo_mal = false;
		
		$TXTNomArt	 	= strtoupper(trim($_POST['LSTElemento']));
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
			header("Location: resucot.php?busco=E&nom=".$TXTNomArt."&fecha=".$LSTfechaCOT."&codba=".$TXTcodBA."&feson=".$RDOFecha."&fechaf=".$LSTfechaCOTFIN.""); 
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
	<title>BHI - Sistema Administrativo</title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="css/style.css">
    
    <link rel="stylesheet" type="text/css" href="css/slimmenu.css">
   	<script src="js/jquery.min.js"></script>
 	<!-- AUTOCOMPLETAR -->
    <link rel="stylesheet" href="development/themes/base/jquery.ui.all.css">
    <script src="development/jquery-1.7.2.js"></script>
    <script src="development/ui/jquery.ui.core.js"></script>
    <script src="development/ui/jquery.ui.widget.js"></script>
    <script src="development/ui/jquery.ui.button.js"></script>
    <script src="development/ui/jquery.ui.position.js"></script>
    <script src="development/ui/jquery.ui.autocomplete.js"></script>
    <link rel="stylesheet"  type="text/css" href="css/menues.css">
    <script src="js/menues.js"></script>
    <!-- AUTOCOMPLETAR -->   
 </head>
<body>
	<div class="logo">BHI - BROKERS</div>
	<div id="page-wrap"> 
    
    <?php include 'menu.php'; ?>
    <form id="form1" name="form1" method="post">
    <div class="caption">BHI - BROKERS.</div> 
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
		  <td colspan="4"><strong><span style="color: #000">
		    <select name="LSTElemento" id="combox" value="<?php echo $LSTElemento; ?>" class="button" >
		      <option value="000" >Seleccione</option>
		      <?php 
				while ($arr_Elemento = mysqli_fetch_array($r_Elemento))			
				{		
					$Xselt_Elemento = '';
					
					if (trim($arr_Elemento['cod_ele_cot'])==trim($LSTElemento)){	
						$Xselt_Elemento = 'selected ';
					}	
			
					echo '<option value="'.trim($arr_Elemento['cod_ele_cot']).'" '.$Xselt_Elemento.'>'.' '.trim($arr_Elemento['nom_ele_cot']).'</option>'."\n\t\t";
				}
					
				?>
	        </select>
		  </span></strong></td>
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
