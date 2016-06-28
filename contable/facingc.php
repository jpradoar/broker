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
	
 // PRIMER POST
	
	$Xerror = "";
	
	$cod 	= $_GET['cod'];
	$accion = $_GET['accion'];
	$lugar 	= $_GET['lugar'];
	$codfac = $_GET['codfac'];
	
	$veo_cheque = "n";
	$Xerror_num	= "";
       
// Formateo las variables: 
		$NUMFacIng 		= "";
		$RDODES 		= "";
		$FILEfactu 		= "";
		$LSTfechaFI 	= "";
		$RDObancoFI 	= "";
		$TXTBancoFI 	= "";
        $TXTIvaIngBru 	= "";
		$TXTGanancia 	= "";
		$NUMIvaIns 		= "";
		$NUMIvaNoIns 	= "";
		$NUMRemito 		= "";
		$TXTIibb 		= "";
		$TXTNoGrab 		= "";
		$NUMMonTotal	= "";
		$TXTGrab		= "";

		$TXTBcoEmiCHE 	= "";
		$TXTNroEmiCHE 	= "";
		$FEEmiChe 		= "";
		$TXTPerEmiCHE 	= "";
		$TXTObservaCHE  = "";
			
		$FESalCHE  		= "";
		$TXTConIngCHE  	= "";
		$TXTConSalCHE   = "";
		$TXTFeDifCHE  	= "";
		$cantidad		= "";
		
		$FECierreFac	="";
		#Metodo de pago obligatorio
		$RDObancoFI		="E";
								
	if($accion == "MOD"){		
		
		#Datos Facturas de todos los tipos
		$db1  = conecto();
		$sql1 = "select * from facturas_ingresantes where cod_ord = ".$cod." and  cod_fac_ing = ".$codfac." ";
		$r1   = mysqli_query($db1, $sql1);
	
		if ($r1 == false){
	    	mysqli_close($db1);
	        $error = "Error: (" . mysql_errno() . ") " . mysql_error().")";
	        //gestion_errores();
	    }
	    	mysqli_close($db1);
			
		while ($arr1 = mysqli_fetch_array($r1))		
		{
			$cod_fac_ing 	= trim($arr1['cod_fac_ing']);
			$lugar			= trim($arr1['lugar_fac_ing']);
				
			$NUMFacIng 		= trim($arr1['nro_fac_ing']);
			$RDODES 		= trim($arr1['tipo_fac_ing']);
			$FILEfactu 		= trim($arr1['arch_fac_ing']);
			$LSTfechaFI 	= trim($arr1['fe_a_fac_ing']);
			
			$RDObancoFI 	= trim($arr1['met_pag_fac_ing']);
			$TXTBancoFI 	= trim($arr1['banco_fac_ing']);
			$TXTIvaIngBru 	= trim($arr1['percep_iva_fac_ing']);
			$TXTGanancia 	= trim($arr1['ganancias_fac_ing']);
			
			$NUMIvaIns 		= trim($arr1['iva_ins_fac_ing']);
			$NUMIvaNoIns 	= trim($arr1['iva_no_ins_fac_ing']);
			$NUMRemito 		= trim($arr1['nro_remito_fac_ing']);
			$TXTIibb 		= trim($arr1['recep_iibb_fac_ing']);
			
			$TXTNoGrab 		= trim($arr1['no_grabado_fac_ing']);
			$NUMMonTotal	= trim($arr1['total_fac_ing']);			
			$TXTGrab		= trim($arr1['gravado_fac_ing']);
			$FECierreFac	= trim($arr1['fe_cierre_fac']);																									
		}				
				
		if(strlen($cod_fac_ing)==0){$cod_fac_ing = "";}
		if(strlen($lugar)==0){$lugar = "";}
		
		if(strlen($NUMFacIng)==0){$NUMFacIng = "";}
		if(strlen($RDODES)==0){$RDODES = "";}
		if(strlen($FILEfactu)==0){$FILEfactu = "";}
		
		if(strlen($LSTfechaFI)<4){$LSTfechaFI = "";}
		if(strlen($RDObancoFI)==0){$RDObancoFI = "";}
		if(strlen($TXTIvaIngBru)==0){$TXTIvaIngBru = "";}
		if(strlen($TXTGanancia)==0){$TXTGanancia = "";}
		
		if(strlen($NUMIvaIns)==0){$NUMIvaIns = "";}
		if(strlen($NUMIvaNoIns)==0){$NUMIvaNoIns = "";}
		if(strlen($NUMRemito)==0){$NUMRemito = "";}
		if(strlen($TXTIibb)==0){$TXTIibb = "";}
		
		if(strlen($TXTNoGrab)==0){$TXTNoGrab = "";}
		if(strlen($NUMMonTotal)==0){$NUMMonTotal = "";}
		if(strlen($TXTGrab)==0){$TXTGrab = "";}
		if(strlen($FECierreFac)<4){$FECierreFac = "";}
		
#------------------------------------CHEQUES
		$db_vc  = conecto();
		$sql_vc = " select count(*) as canti from cheques where cod_ord = ".$cod." and lugar_che  = '".$lugar."' ";
		
		$r_vc	  = mysqli_query($db_vc, $sql_vc);
		//echo $sql_vc;exit();
		if ($r_vc == false){
			mysqli_close($db_vc);
			//$error = "Error: (" . mysql_errno() . ") " . mysql_error().")";
			gestion_errores();
		}
			mysqli_close($db_vc);	
		
		$arrx = mysqli_fetch_array($r_vc);
		$cantidad = $arrx['canti'];
		//echo $cantidad; exit();
		
		
		
		$dbch  = conecto();
		$sqlch = "select * from cheques where cod_ord = '".$cod."' and lugar_che = '".$lugar."' ";
		$rch   = mysqli_query($dbch, $sqlch);
	
		if ($rch == false){
	    	mysqli_close($dbch);
	        $error = "Error: (" . mysql_errno() . ") " . mysql_error().")";
	        //gestion_errores();
	    }
	    	mysqli_close($dbch);	

		if( strlen($TXTBcoEmiCHE)!=0 ){
			$veo_cheque = "S";
		}
		#FIN 
	}#FIN SI ES MODIFICAR	

 
if($_POST){
	
	if($_POST['BTNcerrar']){//cierra la factura, osea agrega fecha al cierre
 		
		$cod_fac_ing	= $_POST['cod_fac_ing'];
		$FECierreFac 	= trim($_POST['FECierreFac_anio'].'-'.$_POST['FECierreFac_mes'].'-'.$_POST['FECierreFac_dia']);
		
		$db  = conecto();
		$sql = " update facturas_ingresantes set 
					fe_cierre_fac  = '".$FECierreFac."'							
					where cod_fac_ing = ".$cod_fac_ing." ";
		#echo $sql;exit();		
		$r   = mysqli_query($db, $sql);

		if ($r == false){
	    	mysqli_close($db);
	        $error = "Error: (" . mysql_errno() . ") " . mysql_error().")";
	        //gestion_errores();
	    }
	      mysqli_close($db);
		  		
		header ('location:index.php');
		exit();		
	}
	 
	if($_POST['BTNModCierre']){//modificacion del cierre
		
		$cod_fac_ing	= $_POST['cod_fac_ing'];
		$FEModFac 		= trim($_POST['FEModFac_anio'].'-'.$_POST['FEModFac_mes'].'-'.$_POST['FEModFac_dia']);
		
		$db  = conecto();
		$sql = " update facturas_ingresantes set 
					fe_cierre_fac  = '".$FEModFac."'							
					where cod_fac_ing = ".$cod_fac_ing." ";
		#echo $sql;exit();		
		$r   = mysqli_query($db, $sql);

		if ($r == false){
	    	mysqli_close($db);
	        $error = "Error: (" . mysql_errno() . ") " . mysql_error().")";
	        //gestion_errores();
	    }
	      mysqli_close($db);
		   		
		header ('location:index.php');
		exit();		
	}

	if($_POST['BTNAbrir']){//volver a abrir 
 		
		$db  = conecto();
		$sql = " update facturas_ingresantes set 
					fe_cierre_fac  = '0000-00-00 00:00:00'							
					where cod_fac_ing = ".$cod_fac_ing." ";
		#echo $sql;exit();		
		$r   = mysqli_query($db, $sql);

		if ($r == false){
	    	mysqli_close($db);
	        $error = "Error: (" . mysql_errno() . ") " . mysql_error().")";
	        //gestion_errores();
	    }
	      mysqli_close($db);
		  
 		header ('location:index.php');
		exit();		
	}
		
	if($_POST['BTNvolver']){//volver al menu
 		header ('location:index.php');
		exit();		
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
 <form action="" method="post" name="form1" enctype="multipart/form-data" >   
    <?php include 'menu.php'; ?>
	<p>USUARIO: <?php echo $Xnombre; ?></p>
	<table class="sombra">
      <thead>
	          <tr>
	            <th colspan="5" align="center"><input name="cod_fac_ing"  id="cod_fac_ing"  value="<?php echo $cod_fac_ing; ?>" type="hidden"><div align="center">FACTURA DE <?php echo strtoupper($lugar); ?></div></th>
	            </tr>
	          </thead>
	        <tbody>
	          <tr>
	            <td colspan="5">&nbsp;</td>
              </tr>
              
			  <?php if($FECierreFac=="0000-00-00 00:00:00"){   ?> 
	          <tr>
	            <td colspan="5"><div align="center" class="titulo"><strong>CIERRE FACTURA</strong></div></td>
              </tr>
	          <tr>
	            <td colspan="2"><strong>FECHA CIERRE FACTURA </strong></td>
	            <td><strong>
	              <?php pinto_fecha('FECierreFac','','');?>
	            </strong></td>
	            <td>&nbsp;</td>
	            <td><span style="color: #000">
	              <input type="submit" name="BTNcerrar" id="BTNcerrar" class="button" value="CERRAR">
	            </span></td>
              </tr>
	          <?php }else{   ?>
              <tr>
                <td colspan="5"><div align="center" class="titulo">APERTURA FACTURA / MODIFICAR FECHA CIERRE</div></td>
              </tr>
              <tr>
                <td colspan="2"><strong>FECHA ACTUAL DE CIERRE FACTURA </strong></td>
                <td><?php echo ordenofecha($FECierreFac); ?></td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
              </tr>
              <tr>
                <td colspan="2"><strong>NUEVA FECHA CIERRE FACTURA </strong></td>
                <td><strong>
                  <?php pinto_fecha('FEModFac','','');?>
                </strong></td>
                <td>&nbsp;</td>
                <td><span style="color: #000">
                  <input type="submit" name="BTNModCierre" id="BTNModCierre" class="button" value="MODIFICAR CIERRE">
                </span></td>
              </tr>
              <tr>
                <td><strong>ABRIR FACTURA</strong></td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
                <td><span style="color: #000">
                  <input type="submit" name="BTNAbrir" id="BTNAbrir" class="button" value="ABRIR">
                </span></td>
              </tr>
              <?php  }  ?>
              <tr>
	            <td colspan="5">&nbsp;</td>
              </tr>
	          <tr>
	            <td colspan="5"><div align="center"><span style="color: #000"><strong>DETALLE</strong></span></div></td>
	            </tr>
	          <tr>
	            <td><strong>NUM. FACTURA:</strong></td>
	            <td><strong><input name="NUMFacIng" type="text" class="button" id="NUMFacIng" value="<?php echo $NUMFacIng; ?>" maxlength="20" disabled></strong></td>
	            <td><strong>TIPO:</strong></td>
	            <td><strong>FACTURA</strong><input name="RDODES" type="radio" class="button" id="RDODES" value="F" checked disabled></td>
	            <td><strong>NOTA DE CREDITO</strong><input name="RDODES" type="radio" class="button" id="RDODES" value="N" disabled></td>
              </tr>
	          <tr>
	            <td><strong>ARCHIVO:</strong> </td>
	            <td colspan="4"><div align="left"><span style="color: #000"><?php echo $FILEfactu; ?></span></div></td>
	            </tr>
	          <tr>
	            <td><strong>FECHA FACTURA: </strong></td>
	            <td><?php pinto_fecha('LSTfechaFI','','');?></td>
	            <td>&nbsp;</td>
	            <td colspan="2">&nbsp;</td>
	           </tr>
              
         	 <?php
			 	if ($cantidad <= "0"){//Si ya tenia cheques..
		
			   ?>
              <tr>
                <td><strong>METODO DE PAGO:</strong></td>
                <td colspan="2"><div align="right"><strong> EFECTIVO:
                  <input type="radio" name="RDObancoFI" id="RDObancoFI" value="E" onclick="toggle(this)" class="button" <?php if($RDObancoFI=="E"){ echo "checked";}?> disabled>
                  CHEQUE:
  <input type="radio" name="RDObancoFI" id="RDObancoFI" value="C" onclick="toggle(this)" class="button" <?php if($RDObancoFI=="C"){ echo "checked";}?> disabled>
                  BANCO:
  <input type="radio" name="RDObancoFI" id="RDObancoFI" value="B" onclick="toggle(this)" class="button" <?php if($RDObancoFI=="B"){ echo "checked";}?> disabled>
  <input name="TXTBancoFI" type="text" class="button" id="TXTBancoFI" value="<?php echo $TXTBancoFI; ?>" size="8" maxlength="30" disabled>
                </strong></div></td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
              </tr>
              <?php 
			  	}else{  
			  		$veo_cheque="S";
			   ?>
              <tr>
                <td colspan="5"><div align="center" class="subtitulo"><strong>CHEQUES<input type="radio" name="RDObancoFI" id="RDObancoFI" value="C" class="button" checked disabled></strong></div></td>
              </tr>              
              
              <!--CHEQUES-->
				<?php    
                    while ($arrch = mysqli_fetch_array($rch))	
                    {
						$TXTBcoEmiCHE 	= trim($arrch['bco_emi_che']);
						
						$TXTNroEmiCHE 	= trim($arrch['nro_che']);
						$FEEmiChe 		= trim($arrch['fe_emi_che']);
						$TXTPerEmiCHE 	= trim($arrch['emi_che']);
						$TXTObservaCHE  = trim($arrch['observa_che']);
						
						$FESalCHE  		= trim($arrch['fe_sal_che']);
						$TXTConIngCHE  	= trim($arrch['concep_ing_che']);
						$TXTConSalCHE  	= trim($arrch['concep_sal_che']);
						$TXTFeDifCHE  	= trim($arrch['fe_dif_che']);
						$monto_che  	= trim($arrch['monto_che']);
						
						#Formateo lOS CHEQUES
						if(strlen($TXTBcoEmiCHE)==0){$TXTBcoEmiCHE = "";}	
						if(strlen($TXTNroEmiCHE)==0){$TXTNroEmiCHE = "";}	
						if(strlen($FEEmiChe)<4){$FEEmiChe = "";}	
						if(strlen($TXTPerEmiCHE)==0){$TXTPerEmiCHE = "";}	
						if(strlen($TXTObservaCHE)==0){$TXTObservaCHE = "";}	
				
						if(strlen($FESalCHE)<4){$FESalCHE = "";}	
						if(strlen($TXTConIngCHE)==0){$TXTConIngCHE = "";}	
						if(strlen($TXTConSalCHE)==0){$TXTConSalCHE = "";}		
						if(strlen($TXTFeDifCHE)<4){$TXTFeDifCHE = "";}	
						if(strlen($monto_che)==0){$monto_che = "";}					
                 ?>
                <tr>
                    <td><strong>NUMERO:</strong> <?php echo $nro_che = trim($arrch['nro_che']);?></td>
                    <td><strong>BANCO:</strong> <?php  echo $bco_emi_che = trim($arrch['bco_emi_che']); ?></td>
                    <td><strong>FECHA:</strong> <?php echo $fecha_alta = date("d-m-Y", strtotime($arrch['fe_emi_che'])); ?></td>
                    <td><strong>MONTO:</strong> <?php echo $monto_che;?></td>
                    <td>                                    
                        <a href="<?php 	$cod_che = trim($arrch['cod_che']);
                                        echo '../veocheque.php?cod='.$cod_che; ?>"><button class="button" type="button"><?php 
                                        echo 'Ver';
                                    ?></button></a></td>
                </tr>
                <?php }  ?>
            <?php }   ?>           
                          
                <!--CHEQUES--> 
              <tr>
                <td colspan="5">&nbsp;</td>
              </tr>
              <tr>
	          	<td colspan="5"><div align="center" class="subtitulo"><strong>OTROS IMPUESTOS</strong></div></td>
              </tr>
              <tr>
	            <td><strong>PERCEPCION IVA INGRESOS BRUTOS :</strong></td>
	            <td><input name="TXTIvaIngBru" type="text" class="button" id="TXTIvaIngBru" value="<?php echo $TXTIvaIngBru; ?>" maxlength="14" disabled></td>
	            <td><div align="right"><strong>GANANCIAS:</strong></div></td>
	            <td colspan="2"><strong>
	              <input name="TXTGanancia" type="text" class="button" id="TXTGanancia" value="<?php echo $TXTGanancia; ?>" maxlength="14" disabled></strong></td>
              </tr>
	          <tr>
	            <td><strong>IVA INSCRIPTO:</strong></td>
	            <td><strong>
                <input name="NUMIvaIns" type="text" class="button" id="NUMIvaIns" value="<?php echo $NUMIvaIns; ?>" maxlength="14" disabled></strong></td>
	            <td><div align="right"><strong>IVA NO INSCRIPTO:</strong></div></td>
	            <td colspan="2"><input name="NUMIvaNoIns" type="text" class="button" id="NUMIvaNoIns" value="<?php echo $NUMIvaNoIns; ?>" maxlength="14" disabled></td>
              </tr>
	          <tr>
	            <td><strong>NUMERO DE REMITO:</strong></td>
	            <td><strong><input name="NUMRemito" type="text" class="button" id="NUMRemito" value="<?php echo $NUMRemito; ?>" maxlength="14" disabled></strong></td>
	            <td><div align="right"><strong>RECEPCI&Oacute;N IIBB CAJA 3,5</strong></div></td>
	            <td colspan="2"><input name="TXTIibb" type="text" class="button" id="TXTIibb" value="<?php echo $TXTIibb; ?>" maxlength="14" disabled></td>
              </tr>
	          <tr>
	            <td><strong>NO GRABADO :</strong></td>
	            <td><strong><input name="TXTNoGrab" type="text" class="button" id="TXTNoGrab" value="<?php echo $TXTNoGrab; ?>" maxlength="14" disabled></strong></td>
	            <td><div align="right"><strong>GRABADO:</strong></div></td>
	            <td colspan="2"><input name="TXTGrab" type="text" class="button" id="TXTGrab" value="<?php echo $TXTGrab; ?>" maxlength="14" disabled></td>
	            </tr>
	          <tr>
	            <td><strong>TOTAL : </strong></td>
	            <td><strong>
	              <input name="NUMMonTotal" type="text" class="button" id="NUMMonTotal" value="<?php echo $NUMMonTotal; ?>" maxlength="15" disabled>
	            </strong></td>
	            <td colspan="3">&nbsp;</td>
              </tr>
	          <tr>
	            <td colspan="5">&nbsp;</td>
	            </tr>
	          <tr>
	            <td colspan="5"><div align="center"><span style="color: #000">
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
