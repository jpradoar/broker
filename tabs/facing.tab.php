<?php

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

	#facturas ingresantes
	$db1  = conecto();
	$sql1 = " select * from facturas_ingresantes where cod_ord = '".$cod."' ";
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
	
	#formateo las que no tienen nada
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
		
		$dbch  = conecto();
		$sqlch = "select * from cheques where cod_ord = '".$cod."' and lugar_che = '".$lugar."' ";
		$rch   = mysqli_query($dbch, $sqlch);
	
		if ($rch == false){
	    	mysqli_close($dbch);
	        $error = "Error: (" . mysql_errno() . ") " . mysql_error().")";
	        //gestion_errores();
	    }
	    	mysqli_close($dbch);			
?>
<table class="sombra" id="report">
  <tbody>
    <tr class="accordion">
      <td colspan="5" align="center" style="color:#903;"><h3><div align="center" class="subtitulo">FACTURA DE <?php echo strtoupper($lugar); ?></div></h3></th>
      <td align="center" style="color:#903;" width="10"><div class="arrow"></div></td> 
    </tr>
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
      <td><div align="left"><strong><?php 
	  		if($RDODES=="F"){
      			echo "FACTURA";
			}
			if($RDODES=="N"){
      			echo "NOTA DE CREDITO";
			}
			?></strong></div></td>
    </tr>
    <tr>
      <td><strong>ARCHIVO:</strong></td>
      <td><div align="left">
	              <span style="color: #000">
	              <?php 
					if(strlen($FILEfactu)!=0){ 				
						echo "Archivo : "."$FILEfactu"; 
					} ?>
                  </span><?php echo $FILEfactu; ?></div></td>
      <td colspan="3"><?php if(strlen($FILEfactu)!=0){ 
	  							echo "<a href=\"ordenes/".$cod."/".$FILEfactu."\" target='_blank'><img src='images/Down.png' height=50  ></a>"; }?></td>
    </tr>
    <tr>
      <td><strong>FECHA FACTURA: </strong></td>
      <td><?php echo ordenofecha($LSTfechaFI);?></td>
      <td><strong><div align="right">METODO DE PAGO:</div></strong></td>
      <td colspan="2"><strong>
        <?php if($RDObancoFI=="E"){ echo "EFECTIVO"; }
			  if($RDObancoFI=="C"){ echo "CHEQUE";	}
			  if($RDObancoFI=="B"){ echo "BANCO"; }?>

                <?php   
					if($RDObancoFI=="B"){ 
				 ?> 
                <input name="TXTBancoFI" type="text" id="TXTBancoFI" value="<?php echo $TXTBancoFI; ?>" maxlength="15" disabled class="button">
                <?php   
					}
				 ?> 

        </strong></td>
    </tr>
    
	<?php if($RDObancoFI=="C"){  ?>
	
	<tr>
      <td colspan="5"><div align="center"><strong>CHEQUES</strong></div></td>
    </tr>
    
	<?php  
          	while ($arrch = mysqli_fetch_array($rch))	
            {
				$cod_che 		= trim($arrch['cod_che']); 
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
        <td><a href="<?php $cod_che = trim($arrch['cod_che']);
                                       echo 'veocheque.php?cod='.$cod_che; ?>"><button class="button" type="button"><?php 
                                        echo 'Ver';         
		                ?></button></a> </td>
    </tr>
    
	<?php } 
		}
	?>
     
    <tr>
      <td colspan="5">&nbsp;</td>
    </tr>
    <tr>
      <td colspan="5"><div align="center"><strong>OTROS IMPUESTOS</strong></div></td>
    </tr>
    <tr>
      <td><strong>PERCEPCION IVA INGRESOS BRUTOS :</strong></td>
      <td><input name="TXTIvaIngBru" type="text" class="button" id="TXTIvaIngBru" value="<?php echo $TXTIvaIngBru; ?>" maxlength="14"></td>
      <td><div align="right"><strong>GANANCIAS:</strong></div></td>
      <td colspan="2"><strong><input name="TXTGanancia" type="text" class="button" id="TXTGanancia" value="<?php echo $TXTGanancia; ?>" maxlength="14"></strong></td>
    </tr>
    <tr>
      <td><strong>IVA INSCRIPTO:</strong></td>
      <td><strong>
        <input name="NUMIvaIns" type="text" class="button" id="NUMIvaIns" value="<?php echo $NUMIvaIns; ?>" maxlength="14">
      </strong></td>
      <td><div align="right"><strong>IVA NO INSCRIPTO:</strong></div></td>
      <td colspan="2"><input name="NUMIvaNoIns" type="text" class="button" id="NUMIvaNoIns" value="<?php echo $NUMIvaNoIns; ?>" maxlength="14"></td>
    </tr>
    <tr>
      <td><strong>NUMERO DE REMITO:</strong></td>
      <td><strong>
        <input name="NUMRemito" type="text" class="button" id="NUMRemito" value="<?php echo $NUMRemito; ?>" maxlength="14">
      </strong></td>
      <td><div align="right"><strong>RECEPCI&Oacute;N IIBB CAJA 3,5</strong></div></td>
      <td colspan="2"><input name="TXTIibb" type="text" class="button" id="TXTIibb" value="<?php echo $TXTIibb; ?>" maxlength="14"></td>
    </tr>
    <tr>
      <td><strong>NO GRABADO :</strong></td>
      <td><strong>
        <input name="TXTNoGrab" type="text" class="button" id="TXTNoGrab" value="<?php echo $TXTNoGrab; ?>" maxlength="14">
      </strong></td>
      <td><div align="right"><strong>GRABADO:</strong></div></td>
      <td colspan="2"><input name="TXTGrab" type="text" class="button" id="TXTGrab" value="<?php echo $TXTGrab; ?>" maxlength="14"></td>
    </tr>
    <tr>
      <td><strong>TOTAL : </strong></td>
      <td><strong>
        <input name="NUMMonTotal" type="text" class="button" id="NUMMonTotal" value="<?php echo $NUMMonTotal; ?>" maxlength="15">
      </strong></td>
      <td colspan="3">&nbsp;</td>
    </tr>
    <tr>
      <td colspan="5">&nbsp;</td>
    </tr>
    <tr>
      <td colspan="5"><div align="right">
      				<a href="<?php echo "abms/facing.php?accion=ALT&cod=".$cod."&lugar=".$lugar; ?>"><input name="BTNALT" type="button" class="button" id="BTNALT" value="ALTA"></a>
      				<a href="<?php echo "abms/facing.php?accion=MOD&cod=".$cod."&codfac=".$cod_fac_ing."&lugar=".$lugar; ?>"><input name="BTNmod" type="button" class="button" id="BTNmod" value="MODIFICAR"></a>
                    <a href="<?php echo "abms/facing.php?accion=ELI&cod=".$cod."&codfac=".$cod_fac_ing."&lugar=".$lugar; ?>"><input name="BTNeli" type="button" class="button" id="BTNeli" value="ELIMINAR"></a></div></td>
    </tr>
  </tbody>
</table>
<?php }?>