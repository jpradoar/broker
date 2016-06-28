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

		$TXTBcoEmiCHE	= "";
		$TXTNroEmiCHE	= "";
		$TXTPerEmiCHE	= "";
		$TXTConIngCHE	= "";
		$TXTConSalCHE	= "";
		$TXTFeDifCHEiN 	= "";
		$TXTFeDifCHEouT = "";
		$RDOFechadif	= "";
		$FEECheiN 		= "";
		$FEECheOut 		= "";
		$RDOFecha		= "";
		$FEEsalCheIn 	= "";
		$RDOFechaSal	= "";
		$FEEsalCheOut 	= "";
		
 
if($_POST){//SEGUNDOS POST
	if($_POST['BTNBusco']){
		
		$muestro_error = "";
		$algo_mal = false;
		//             
		$TXTBcoEmiCHE	= strtoupper(trim($_POST['TXTBcoEmiCHE']));
		$TXTNroEmiCHE	= strtoupper(trim($_POST['TXTNroEmiCHE']));
		$TXTPerEmiCHE	= strtoupper(trim($_POST['TXTPerEmiCHE']));
		$TXTConIngCHE	= strtoupper(trim($_POST['TXTConIngCHE']));
		$TXTConSalCHE	= strtoupper(trim($_POST['TXTConSalCHE']));
		$TXTFeDifCHEiN 	= trim($_POST['TXTFeDifCHEiN_anio'].'-'.$_POST['TXTFeDifCHEiN_mes'].'-'.$_POST['TXTFeDifCHEiN_dia']);
		$TXTFeDifCHEouT = trim($_POST['TXTFeDifCHEouT_anio'].'-'.$_POST['TXTFeDifCHEouT_mes'].'-'.$_POST['TXTFeDifCHEouT_dia']);
		$RDOFechadif	= strtoupper(trim($_POST['RDOFechadif']));
		$FEECheiN 		= trim($_POST['FEECheiN_anio'].'-'.$_POST['FEECheiN_mes'].'-'.$_POST['FEECheiN_dia']);
		$FEECheOut 		= trim($_POST['FEECheOut_anio'].'-'.$_POST['FEECheOut_mes'].'-'.$_POST['FEECheOut_dia']);
		$RDOFecha		= strtoupper(trim($_POST['RDOFecha']));
		$FEEsalCheIn 	= trim($_POST['FEEsalCheIn_anio'].'-'.$_POST['FEEsalCheIn_mes'].'-'.$_POST['FEEsalCheIn_dia']);
		$RDOFechaSal	= strtoupper(trim($_POST['RDOFechaSal']));
		$FEEsalCheOut 	= trim($_POST['FEEsalCheOut_anio'].'-'.$_POST['FEEsalCheOut_mes'].'-'.$_POST['FEEsalCheOut_dia']);


		$muestro_error = "";
		
		if(strlen($TXTNroEmiCHE)!=0){
			if(!is_numeric($TXTNroEmiCHE)){
				$muestro_error.= " NRO CHEQUE";
				$algo_mal = true;
			}		
		}else{
			$TXTNroEmiCHE = "";	
		}
		
		$muestro_error.= " DEBE/DEBEN SER NUMERICO/S ";
				
		if($algo_mal == false){	//Si esta todo bien
			header("Location: resucheque.php?busco=E&TXTBcoEmiCHE=".$TXTBcoEmiCHE."&TXTNroEmiCHE=".$TXTNroEmiCHE."&TXTPerEmiCHE=".$TXTPerEmiCHE."&TXTConIngCHE=".$TXTConIngCHE."&TXTConSalCHE=".$TXTConSalCHE."&TXTFeDifCHEiN=".$TXTFeDifCHEiN."&TXTFeDifCHEouT=".$TXTFeDifCHEouT."&RDOFechadif=".$RDOFechadif."&FEECheiN=".$FEECheiN."&FEECheOut=".$FEECheOut."&RDOFecha=".$RDOFecha.		"&FEEsalCheIn=".$FEEsalCheIn."&RDOFechaSal=".$RDOFechaSal."&FEEsalCheOut=".$FEEsalCheOut.""); 
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
			<th colspan="6"><div align="center">BUSQUEDA <strong>CHEQUES</strong></div></th>
		  </tr>
		</thead>
		<tbody>
    		<tr> 
               <td width="21%"><strong>BANCO EMISOR:</strong></td>
                <td><strong>
                <input type="text" class="button" id="TXTBcoEmiCHE" name="TXTBcoEmiCHE" value="<?php echo $TXTBcoEmiCHE; ?>" >
                </strong></td>
                <td><strong>NUMERO DEL CHEQUE:</strong></td>
                <td><strong>
                  <input type="text" class="button" id="TXTNroEmiCHE" name="TXTNroEmiCHE" value="<?php echo $TXTNroEmiCHE; ?>" >
                </strong></td>
            </tr>
             <tr>
                 <td><strong>EMISOR:</strong></td>
                 <td><strong>
                 <input type="text" class="button" id="TXTPerEmiCHE" name="TXTPerEmiCHE" value="<?php echo $TXTPerEmiCHE; ?>">
                 </strong></td>
                 <td><strong>CONCEPTO INGRESO:</strong></td>
                 <td><strong>
                   <input type="text" class="button" id="TXTConIngCHE" name="TXTConIngCHE" value="<?php echo $TXTConIngCHE; ?>">
                 </strong></td>
             </tr>
             <tr>
                 <td><strong>CONCEPTO SALIDA:</strong></td>
                 <td colspan="3"><strong>
                 <input type="text" class="button" id="TXTConSalCHE" name="TXTConSalCHE" value="<?php echo $TXTConSalCHE; ?>">
                 </strong></td>
              </tr>
              <tr>
                <td colspan="4"><div align="center"><strong>BUSQUEDA POR FECHAS</strong></div></td>
              </tr>
              <tr>
                  <td><strong>FECHA DIFERIDO DEL CHEQUE:</strong></td>
                  <td><strong>INICIO
                  <?php pinto_fecha('TXTFeDifCHEiN','','');?> FIN 
                  <?php pinto_fecha('TXTFeDifCHEouT','','');?>
                  </strong></td>
                  <td><strong>BUSCAR POR DIFERIDO</strong></td>
                  <td><strong>
                    <input type="radio" name="RDOFechadif" id="RDOFechadif" value="S">SI
					<input type="radio" name="RDOFechadif" id="RDOFechadif" value="N" checked="checked">NO</strong></td>
              </tr>        
	      <tr>
	        <td><strong>FECHA DEL CHEQUE:</strong></td>
	        <td><strong>
	          INICIO
              <?php pinto_fecha('FEECheiN','','');?>
	          FIN
	          <?php pinto_fecha('FEECheOut','','');?>
	        </strong></td>
	        <td><strong>BUSCAR POR FECHA DEL CHEQUE</strong></td>
	        <td><strong>
	         	<input type="radio" name="RDOFecha" id="RDOFecha" value="S">SI
				<input name="RDOFecha" type="radio" id="RDOFecha" value="N" checked="checked">NO</strong></td>
          </tr>
	      <tr>
	        <td><strong>FECHA SALIDA CHEQUE:</strong></td>
	        <td><strong>
	          INICIO
              <?php pinto_fecha('FEEsalCheIn','','');?>
	        FIN
	        <?php pinto_fecha('FEEsalCheOut','','');?>
	        </strong></td>
	        <td><strong>BUSCAR SALIDA CHEQUE</strong></td>
	        <td><strong>
	          	<input type="radio" name="RDOFechaSal" id="RDOFechaSal" value="S">SI
				<input type="radio" name="RDOFechaSal" id="RDOFechaSal" value="N" checked="checked">NO</strong></td>
          </tr>
	      <tr>
		  <td colspan="4">&nbsp;</td>
		  </tr>
		<tr>
		  <td colspan="6"><div align="center"><input type="submit" name="BTNBusco" id="BTNBusco" class="button" value="BUSCAR">
		    <span style="color: #000">
		    <input type="submit" name="BTNvolver" id="BTNvolver" class="button" value="Volver Al Menu">
		    </span></div></td>
		  </tr>
		<tr>
			<td colspan="6">&nbsp;</td>
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
