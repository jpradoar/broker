<?php
require_once("../funciones.inc.php");
/*
if (falta_logueo())
{ 
	header('location:login.php');
	exit();
}

 $Xnombre = trim(strtoupper($_SESSION['usuario']));
 */
 $Xnombre ="";
 session_start();
		

if($_POST){//SEGUNDOS POST
	
	$Xerror = "";
	$cod 	= $_GET['cod'];
	$accion = $_GET['accion'];
	$codch	= $_GET['codch'];
	

	if($_POST['BTNALTA']){

		$Xtodo_ok 		= true;
		$Xerror_num 	= "";
		$xerror_tip 	= true;
		$Xerror 		= "";
		#recibo los datos del formulario//////////////////////////////////////////////////////

		$LSTfechaPADC	= trim($_POST['LSTfechaPADC_anio'].'-'.$_POST['LSTfechaPADC_mes'].'-'.$_POST['LSTfechaPADC_dia']);
		$RDOTipPago  	= trim($_POST['RDOTipPago']); 
		$TXTMontoCH		= trim($_POST['TXTMontoCH']);
		$TXTNotasADC	= trim($_POST['TXTNotasADC']);

		if(strlen($LSTfechaPADC)<4){$LSTfechaPADC = "";}
		if(strlen($RDOTipPago)==0){$RDOTipPago = "";}
		if(strlen($TXTMontoCH)==0){$TXTMontoCH = "";}
		if(strlen($TXTNotasADC)==0){$TXTNotasADC = "";}
	
		#VALIDACIONES
		if(strlen($TXTMontoCH)==0){
			$Xerror = " DEBE AGREGAR UN MONTO ";
			$Xtodo_ok = FALSE;
		}else{
			if(!is_numeric($TXTMontoCH)){
				$Xtodo_ok = FALSE;
				$Xerror_num.= " MONTO ";		
			}
		}

		if(strlen($RDOTipPago)==0){	
			$Xtodo_ok = FALSE;
			$xerror_tip = FALSE;
			$Xerror_num.= " ";
		}
				
		if(strlen($Xerror_num)!=0){
			if($xerror_tip!= FALSE){
				$Xerror_num.= " DEBE/DEBEN SER NUMERICO/NUMERICOS ";
			}
			
			if($xerror_tip== FALSE){
				$Xerror_num.= " DEBE SELECCIONAR UN TIPO DE PAGO, VERIFIQUE ";	
			}
		}		
	
		if($Xtodo_ok==true){#Si esta todo bien				
			#guardo los datos en la base correspondiente  //////////////////////////////////////////////////////		
			$db2  = conecto();
			$sql2 = " INSERT INTO adelantochina (cod_ord, tipo_ch, fe_prim_ch, monto_ch, notas_ch) VALUES ('".$cod."','".$RDOTipPago."','".$LSTfechaPADC."','".$TXTMontoCH."','".$TXTNotasADC."') ";
			#echo $sql2;exit();
			$r2   = mysqli_query($db2, $sql2);
		
			if ($r2 == false){
				mysqli_close($db2);
				$error = "Error: (" . mysql_errno() . ") " . mysql_error().")";
				//gestion_errores();
			}
				mysqli_close($db2);
		
	
		echo "<script language='javascript'>
				 alert('El Registro a sido Creado');
				window.location.href='../veoordenes.php?cod=$cod'; </script>"; 	
		}#Si esta todo bien			
	}

	if($_POST['BTNMOD']){
		
		$Xtodo_ok 		= true;
		$Xerror_num 	= "";
		$xerror_tip 	= true;
		$Xerror 		= "";
				
		$LSTfechaPADC	= trim($_POST['LSTfechaPADC_anio'].'-'.$_POST['LSTfechaPADC_mes'].'-'.$_POST['LSTfechaPADC_dia']);
		$RDOTipPago  	= trim($_POST['RDOTipPago']);
		$TXTMontoCH		= trim($_POST['TXTMontoCH']);
		$TXTNotasADC	= trim($_POST['TXTNotasADC']);
		
		if(strlen($LSTfechaPADC)<4){$LSTfechaPADC = "";}
		if(strlen($TXTMontoCH)==0){$TXTMontoCH = "";}
		if(strlen($TXTNotasADC)==0){$TXTNotasADC = "";}

		#VALIDACIONES
		if(strlen($TXTMontoCH)==0){
			$Xerror = " DEBE AGREGAR UN MONTO ";
			$Xtodo_ok = FALSE;	
		}else{
			if(!is_numeric($TXTMontoCH)){
				$Xtodo_ok = FALSE;
				$Xerror_num.= " MONTO ";		
			}
		}

		if(strlen($RDOTipPago)==0){	
			$Xtodo_ok = FALSE;
			$xerror_tip = FALSE;
			$Xerror_num.= " "; 
		}
		
		if(strlen($Xerror_num)!=0){
			
			if($xerror_tip!= FALSE){
				$Xerror_num.= " DEBE/DEBEN SER NUMERICO/NUMERICOS ";
			}
			
			if($xerror_tip== FALSE){
				$Xerror_num.= " DEBE SELECCIONAR UN TIPO DE PAGO, VERIFIQUE ";	
			}
		}		

		if($Xtodo_ok==true){#Si esta todo bien		
									
			$db3  = conecto();
			$sql3 = " update adelantochina set fe_prim_ch  = '".$LSTfechaPADC."', tipo_ch  = '".$RDOTipPago."', monto_ch  = '".$TXTMontoCH."', notas_ch  = '".$TXTNotasADC."' where cod_ord = ".$cod." and cod_ch = ".$codch." ";
			//echo $sql3;exit();				 
			$r3   = mysqli_query($db3, $sql3);
	
			if ($r3 == false){
				mysqli_close($db3);
				$error = "Error: (" . mysql_errno() . ") " . mysql_error().")";
				//gestion_errores();
			}
			  mysqli_close($db3);
	
			echo "<script language='javascript'>
					 alert('El Registro a sido Modificado');
					window.location.href='../veoordenes.php?cod=$cod'; </script>"; 
		}#Si esta todo bien					
	}
	
	if($_POST['BTNELI']){

		$db4  = conecto();
		$sql4 = " delete from adelantochina where cod_ord = ".$cod." and cod_ch = ".$codch." ";
		$r4   = mysqli_query($db4, $sql4);

		if ($r4 == false){
	    	mysqli_close($db4);
	        $error = "Error: (" . mysql_errno() . ") " . mysql_error().")";
	        //gestion_errores();
	    }
	      mysqli_close($db4);
		  
		echo "<script language='javascript'>
				 alert('El Registro a sido Eliminado');
				window.location.href='../veoordenes.php?cod=$cod'; </script>"; 	
	}
	
	if($_POST['BTNvolver']){//volver al menu
 		header ('location:../veoordenes.php?cod='.$cod);
		exit();		
	}			
	
}else{#PRIMER POST
	
	$Xerror = "";
	$cod 	= $_GET['cod'];
	$accion = $_GET['accion'];
	$codch	= $_GET['codch'];
	
	$LSTfechaPADC	= "";
	$TXTMontoCH 	= "";
	$TXTNotasADC 	= "";
	$RDOTipPago 	= "";
	
	#SI ES ELIMINAR O MODIFICAR	
	if(($accion == "MOD")or($accion == "ELI")){	
		#ADELANTOCHINA
		$db1  = conecto();
		$sql1 = "select * from adelantochina where cod_ch = ".$codch." ";
		$r1   = mysqli_query($db1, $sql1);
	
		if ($r1 == false){
	    	mysqli_close($db1);
	        $error = "Error: (" . mysql_errno() . ") " . mysql_error().")";
	        //gestion_errores();
	    }
	    	mysqli_close($db1);
			
		while ($arr1 = mysqli_fetch_array($r1))		
		{
			$LSTfechaPADC	= trim($arr1['fe_prim_ch']);
			$RDOTipPago  	= trim($arr1['tipo_ch']);
			$TXTMontoCH		= trim($arr1['monto_ch']);
			$TXTNotasADC	= trim($arr1['notas_ch']);
			#formateo las que no tienen nada																											
		}

		if(strlen($LSTfechaPADC)<4){$LSTfechaPADC = "";}
		if(strlen($TXTMontoCH)==0){$TXTMontoCH = "";}
		if(strlen($TXTNotasADC)==0){$TXTNotasADC = "";}		
		#FIN ADELANTOchina
	}#FIN SI ES ELIMINAR O MODIFICAR	
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
 	<form action="" method="post" name="form1" >   
    <?php include 'menu.php'; ?>

    <div class="caption">BHI - BROKERS.</div> 
	<p>USUARIO: <?php echo $Xnombre; ?></p>
	<table class="sombra">
      <thead>
	          <tr>
	            <th width="829" align="center" colspan="4"><div align="center"> PAGOS EN ORIGEN <input name="RDOTipPago" type="radio" id="RDOTipPago" value="P" class="button" <?php if($RDOTipPago=="P"){ echo "checked";} ?> checked></div></th>
	            </tr>
	          </thead>
	        <tbody>
	          <tr>
	            <td colspan="4"><?php echo '<div align="center" style="color:red; font-weight: bold;">'.$Xerror." ".$Xerror_num.'</div>'; ?></td>
	            </tr>
	          <tr>
	            <td colspan="4"><div align="center"><span style="color: #000"><strong>DETALLE</strong></span></div></td>
	            </tr>
	          <tr>
	            <td><strong>FECHA  AD. A CHINA:</strong></td>
	            <td><?php pinto_fecha('LSTfechaPADC','','');?></td>
	            <td colspan="2"><strong>MONTO: <input name="TXTMontoCH" type="text" id="TXTMontoCH" maxlength="15" value="<?php echo $TXTMontoCH; ?>" class="button"> .U$S</strong></td>
	            </tr>
	          <tr>
	            <td><strong>NOTAS AD. A CHINA</strong></td>
	            <td colspan="3"><strong><input name="TXTNotasADC" type="text" id="TXTNotasADC" value="<?php echo $TXTNotasADC; ?>" size="70" maxlength="150" class="button"></strong></td>
              </tr>
	          <tr>
	            <td colspan="4">&nbsp;</td>
	            </tr>
	          <tr>
	            <td colspan="4"><div align="center"><span style="color: #000">
	              <?php  
				  if($accion == "ALT"){
					  	echo '<input name="BTNALTA" type="submit" class="button" id="BTNALTA" value="ALTA">';
					  	} 
						 if($accion == "MOD"){
					  	echo '<input name="BTNMOD" type="submit" class="button" id="BTNMOD" value="MODIFICAR">';
					  	}
						 if($accion == "ELI"){
					  	echo '<input name="BTNELI" type="submit" class="button" id="BTNELI" value="ELIMINAR">';
					  	}
					?>
	              </span><span style="color: #000">
	              <input type="submit" name="BTNvolver" id="BTNvolver" class="button" value="Volver Al Menu">
                </span></div></td>
	            </tr>
	          </tbody>
	        </table>
	      <span style="color: #000"></span></td>

    </form>
    <br>
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
