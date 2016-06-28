<?php
		#ADELANTOCLIENTE
		$db1  = conecto();
		$sql1 = "select * from adelantocliente where cod_ord = ".$cod." ";
		#echo $sql1;
		$r1   = mysqli_query($db1, $sql1);
	
		if ($r1 == false){
	    	mysqli_close($db1);
	        $error = "Error: (" . mysql_errno() . ") " . mysql_error().")";
	        //gestion_errores();
	    }
	    	mysqli_close($db1);
			
		while ($arr1 = mysqli_fetch_array($r1))		
		{
			$Xtotal = "";
			
			$cod_adcli	 = trim($arr1['cod_adcli']);
			$RDOCerOr	 = trim($arr1['cer_ori']);
			$LSTfechaFdC = trim($arr1['fe_firm_contra']);
			$RDOTipPago  = trim($arr1['tipo_ad']);
			$LSTfechaPAC = trim($arr1['fe_pri_ad']);
			$TXTMontoPA	 = trim($arr1['monto_ad']); 	
			$RDOCO 		 = trim($arr1['tipo_cam_ad']);
			$RDOMetPagCO = trim($arr1['met_pag_ad']);
			$TXTBancoCO	 = trim($arr1['banco_ad']);
			$TXTMontoCO  = trim($arr1['mon_ar_ad']);	
			#formateo las que no tienen nada																											
		
			if(strlen($RDOCerOr)==0)
				$RDOCerOr = "";	
				
			if(strlen($TXTMontoPA)==0)
				$TXTMontoPA = "";
				
			if(strlen($RDOCO)==0)
				$RDOCO = "";
				
			if(strlen($RDOMetPagCO)==0)
				$RDOMetPagCO = "";

			if(strlen($TXTBancoCO)==0)
				$TXTBancoCO = "";

			if(strlen($TXTMontoCO)==0)
				$TXTMontoCO = "";

			$lugar_adcli = "adelantocliente";
			
			$dbch  = conecto();
			$sqlch = "select * from cheques where cod_ord = '".$cod."' and lugar_che = '".$lugar_adcli."' and cod_ref = '".$cod_adcli."' ";
			//echo $sqlch;
			$rch   = mysqli_query($dbch, $sqlch);
		
			if ($rch == false){
				mysqli_close($dbch);
				$error = "Error: (" . mysql_errno() . ") " . mysql_error().")";
				//gestion_errores();
			}
				mysqli_close($dbch);				
?>
<table align="center" class="sombra" id="report">
  <tbody>
    <tr class="accordion">
      <td colspan="5" align="center" style="color:#903;"><h3><input type="text" value="<?php echo $cod_adcli; ?>" style="display:none;" ><div align="center" class="subtitulo"><strong>ADELANTOS / PAGOS DEL CLIENTE</strong></div></h3></td>
      <td align="center" style="color:#903;" width="10"><div class="arrow"></div></td> 
    </tr>
    <tr>
    	
      <td width="316"><strong>TIPO DE PAGO
      :</strong></td>
      <td width="156"><strong>
        <?php if($RDOTipPago=="A"){
      			echo "ADELANTO";	
              }else{
                echo "PAGO";	
              }
		?>
      </strong></td>
      <td colspan="4">&nbsp;</td>
    </tr>
    <tr>
      <td width="316"><strong>FECHA FIRMA DE CONTRATO: </strong></td>
      <td width="156"><?php echo ordenofecha($LSTfechaFdC); ?></td>
      <td colspan="4">&nbsp;</td>
    </tr>
    <tr>
      <td><strong>FECHA ADELANTO:</strong></td>
      <td><?php echo ordenofecha($LSTfechaPAC); ?></td>
      <td colspan="4"><strong>MONTO:
        <input name="TXTMontoPA" type="text" id="TXTMontoPA" maxlength="11" value="<?php echo $TXTMontoPA; ?>" disabled class="button">
        .$AR </strong></td>
    </tr>
    <tr>
      <td><strong>TIPO DE CAMBIO:</strong></td>
      <td colspan="5"><strong>
        <?php if($RDOCO=="B"){ echo "BLUE";}
			  if($RDOCO=="P"){ echo "PESOS";}
			  if($RDOCO=="S"){ echo "OFICIAL";}?>
            <input name="TXTMontoCO" type="text" id="TXTMontoCO" maxlength="11" value="<?php echo $TXTMontoCO; ?>" disabled class="button">
            .AR$</strong></td>
    </tr>
    <tr>
      <td><strong>METODO DE PAGO:</strong></td>
      <td colspan="5"><strong>
        <?php if($RDOMetPagCO=="E"){ echo "EFECTIVO"; }
			  if($RDOMetPagCO=="C"){ echo "CHEQUE";	}
			  if($RDOMetPagCO=="B"){ echo "BANCO"; }?>

                <?php   
					if($RDOMetPagCO=="B"){ 
				 ?> 
                <input name="TXTBancoCO" type="text" id="TXTBancoCO" value="<?php echo $TXTBancoCO; ?>" maxlength="15" disabled class="button">
                <?php   
					}
				 ?> 
        </strong></td>
    </tr>
	<tr>
	  <td><strong>MONTO TOTAL EN U$S:</strong></td>
	  <td><?php echo  round($totaluss = $TXTMontoPA / $TXTMontoCO, 2);?></td>
	  <td colspan="4">&nbsp;</td>
    </tr>  
  	<?php if($RDOMetPagCO=="C"){  ?>
	

	<tr>
	  <td colspan="6">&nbsp;</td>
    </tr>
	<tr>
      <td colspan="6"><div align="center"><strong>CHEQUES</strong></div></td>
    </tr>
    
	<?php  
		$Xtotal = 0;
		
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
				//$monto_che  	= trim($arrch['monto_che']);

				$resto12	 	= trim($arrch['resto12']); 
				$monto_che  	= trim($arrch['monto_che']);
						
				if($resto12=="S"){ 
					$monto_resta 	= $monto_che * 0.012; 
					$monto_che	= $monto_che - $monto_resta;
				}
										
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
				

						
				$Xtotal = $Xtotal + $monto_che;	
				//echo $Xtotal;
		?> 

    <tr>
    	<td><strong>NUMERO:</strong> <?php echo $nro_che = trim($arrch['nro_che']);?></td>
        <td><strong>BANCO:</strong> <?php  echo $bco_emi_che = trim($arrch['bco_emi_che']); ?></td>
        <td><strong>FECHA:</strong> <?php echo $fecha_alta = date("d-m-Y", strtotime($arrch['fe_emi_che'])); ?></td>
        <td><strong>MONTO:</strong> <?php echo  round($monto_che, 2);?></td>
        <td><strong>-1.2:</strong>
        <?php if($resto12=="S"){ echo "SI"; }else{ echo "NO"; }?></td>
        <td><a href="<?php $cod_che = trim($arrch['cod_che']);
                           echo 'veocheque.php?cod='.$cod_che; ?>"><button class="button" type="button"><?php echo 'Ver';?></button></a></td>
    </tr>
    
	<?php 
		} 
	?>
    <tr>
      <td><strong>TOTALES</strong></td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td colspan="2"><?php echo round($Xtotal, 2); ?></td>
      <td>&nbsp;</td>
    </tr>    
	<?php
		}
	?>  

    <tr>
      <td colspan="6"><div align="right">
      				 <a href="<?php echo "abms/adelantocliente.php?accion=ALT&cod=".$cod; ?>"><input name="BTNALT" type="button" class="button" id="BTNALT" value="NUEVO"></a>
                     
                    <a href="<?php echo "abms/adelantocliente.php?accion=MOD&cod=".$cod."&codadcli=".$cod_adcli; ?>"><input name="BTNmod" type="button" class="button" id="BTNmod" value="MODIFICAR"></a>
                   
      				<a href="<?php echo "abms/adelantocliente.php?accion=ELI&cod=".$cod."&codadcli=".$cod_adcli; ?>"><input name="BTNeli" type="button" class="button" id="BTNeli" value="ELIMINAR"></a></div></td>
    </tr>    
  </tbody>
</table>
<?php }?>