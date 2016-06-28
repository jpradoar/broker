<?php
		#DOCUMENTACION DESPACHO
		$db1  = conecto();
		$sql1 = "select * from inspectionpictures where cod_ord = ".$cod." ";
		$r1   = mysqli_query($db1, $sql1);
	
		if ($r1 == false){
	    	mysqli_close($db1);
	        $error = "Error: (" . mysql_errno() . ") " . mysql_error().")";
	        //gestion_errores();
	    }
	    	mysqli_close($db1);
			
		while ($arr1 = mysqli_fetch_array($r1))		
		{
			$TXTdjai		= trim($arr1['djai']);
			$FILEdespa		= trim($arr1['file_desp']);
			$LSTfechaFD 	= trim($arr1['fe_desp']);
			$TXTnroDesp 	= trim($arr1['num_desp']);
			$TXTMontoDES 	= trim($arr1['monto_desp']);
			$RDODES 		= trim($arr1['tip_cam_desp']);
			$TXTMontoDESar 	= trim($arr1['moto_ar_desp']);
			$TXTPosAra 		= trim($arr1['pos_ara']);
			$RDObancoDES 	= trim($arr1['met_pag_desp']);
			$TXTBancoDES 	= trim($arr1['banco_desp']);
			$TXTDerImpo 	= trim($arr1['der_imp']);
			$TXTTasaEst 	= trim($arr1['tas_estad']);
			$TXTMultaFue 	= trim($arr1['multa_desp']);
			$TXTIvaDES 		= trim($arr1['iva_ad_desp']);
			$TXTIvaAdIns 	= trim($arr1['iva_desp']);
			$TXTImpGanDES 	= trim($arr1['imp_gan']);
			$TXTAraSimImp 	= trim($arr1['ara_desp']);
			$TXTServGuarDES = trim($arr1['serv_guar']);
			$TXTIngBru 		= trim($arr1['ing_bru']);	
			#formateo las que no tienen nada																											
		}
		if(strlen($TXTdjai)==0){$TXTdjai = "";}
		if(strlen($FILEdespa)==0){$FILEdespa = "";}
		if(strlen($LSTfechaFD)<4){$LSTfechaFD = "";}
		if(strlen($TXTnroDesp)==0){$TXTnroDesp = "";}
		if(strlen($TXTMontoDES)==0){$TXTMontoDES = "";}
		if(strlen($RDODES)==0){$RDODES = "";}
		if(strlen($TXTMontoDESar)==0){$TXTMontoDESar = "";}
		if(strlen($TXTPosAra)==0){$TXTPosAra = "";}
		if(strlen($RDObancoDES)==0){$RDObancoDES = "";}
		if(strlen($TXTBancoDES)==0){$TXTBancoDES = "";}
		if(strlen($TXTDerImpo)==0){$TXTDerImpo = "";}
		if(strlen($TXTTasaEst)==0){$TXTTasaEst = "";}
		if(strlen($TXTMultaFue)==0){$TXTMultaFue = "";}
		if(strlen($TXTIvaDES)==0){$TXTIvaDES = "";}
		if(strlen($TXTIvaAdIns)==0){$TXTIvaAdIns = "";}
		if(strlen($TXTImpGanDES)==0){$TXTImpGanDES = "";}
		if(strlen($TXTAraSimImp)==0){$TXTAraSimImp = "";}
		if(strlen($TXTServGuarDES)==0){$TXTServGuarDES = "";}
		if(strlen($TXTIngBru)==0){$TXTIngBru = "";}
?>
<table align="center" class="sombra" id="report">
  <tbody>
    <tr class="accordion">
      <td colspan="4" align="center" style="color:#903;"><h3><div align="center" class="subtitulo">DOCUMENTACION DESPACHO</div></h3></td>
      <td align="center" style="color:#903;" width="10"><div class="arrow"></div></td> 
    </tr>
	          <tr>
	            <td><strong>ARCHIVO DESPACHO:</strong></td>
	            <td colspan="2"><div align="center"><span style="color: #000">
	     <?php 
			  	if(strlen($FILEdespa)!=0){ #Si tiene archivo en el directorio y db muestro borrar, sino muestro para subir				
					//$_SESSION['FILEdespa']=$FILEdespa;  // guardo la variable en sesion 
			  		echo "Archivo : "."$FILEdespa"; // imprimo en pantalla el nombre del archivo que subo.
			  		echo "<a href=\"ordenes/".$cod."/".$FILEdespa."\" target='_blank'><img src='images/Down.png' height=50  ></a>"; } ?>
                </span></div></td>
	            <td>&nbsp;</td>
	            </tr>
	          <tr>
	            <td><strong>FECHA DESPACHO: </strong></td>
	            <td><?php echo ordenofecha($LSTfechaFD);?></td>
	            <td><div align="right"><strong>N&ordm;:</strong></div></td>
	            <td><strong>
	              <input name="TXTnroDesp" type="text" id="TXTnroDesp" value="<?php echo $TXTnroDesp; ?>" maxlength="15" disabled class="button">
	            </strong></td>
	            </tr>
	          <tr>
	            <td><strong>MONTO:
                </strong></td>
	            <td colspan="2"><strong>
	              <input name="TXTMontoDES" type="text" id="TXTMontoDES" value="<?php echo $TXTMontoDES; ?>" disabled class="button">
.U$S</strong></td>
	            <td><?php if($RDODES=="B"){ echo "BLUE";}
			  if($RDODES=="P"){ echo "PESOS";}
			  if($RDODES=="S"){ echo "OFICIAL";}?>
                  <input name="TXTMontoDESar" type="text" id="TXTMontoDESar" value="<?php echo $TXTMontoDESar; ?>" maxlength="15" disabled class="button">
                <strong>.AR$ </strong></strong></td>
              </tr>
	          <tr>
	            <td><strong>POSICION ARANCELARIA:</strong></td>
	            <td>
                  <strong>
                  <input name="TXTPosAra" type="text" id="TXTPosAra" value="<?php echo $TXTPosAra; ?>" maxlength="15" disabled class="button">
                </strong></td>
	            <td><div align="right"><strong>
                <?php 
				if($RDObancoDES=="E"){ echo "EFECTIVO"; }
			  	if($RDObancoDES=="C"){ echo "CHEQUE";	}
			  	if($RDObancoDES=="B"){ echo "BANCO"; }
				?>
                
	            </strong></div></td>
	            <td><strong>
				<?php   
					if($RDObancoDES=="B"){ 
				 ?> 
                <input name="TXTBancoDES" type="text" id="TXTBancoDES" value="<?php echo $TXTBancoDES; ?>" maxlength="30" disabled class="button">
                <?php   
					}
				 ?> 
  
                 <?php  
					if($RDObancoDES=="C"){ 
					$codigoche_docdes = veocheque($cod,"Documentacion Despacho");
				 ?> 
 				<input type="button" class="button" value="VER" name="Veodocdes" id="Veodocdes" onclick="abrirLink_docdes()">            
                <script>
                	function abrirLink_docdes() {
						var codigo_docdes = "<?php echo $codigoche_docdes; ?>" ;
                    	window.open("veocheque.php?cod="+codigo_docdes);
                	}
                </script>                
                <?php   
					}
				 ?>             
	            </strong></td>
              </tr>
	          <tr>
	            <td><strong>DERECHOS IMPORTACION:</strong></td>
	            <td>
	              <strong>
	              <input name="TXTDerImpo" type="text" id="TXTDerImpo" value="<?php echo $TXTDerImpo; ?>" maxlength="15" disabled class="button">
	              </strong></td>
	            <td><div align="right"><strong>TASA ESTADISTICA:</strong></div></td>
	            <td><input name="TXTTasaEst" type="text" id="TXTTasaEst" value="<?php echo $TXTTasaEst; ?>" maxlength="15" disabled class="button"></td>
              </tr>
	          <tr>
	            <td><strong>MULTA DEST. FUERA DE TER.:</strong></td>
	            <td><strong>
                <input name="TXTMultaFue" type="text" id="TXTMultaFue" value="<?php echo $TXTMultaFue; ?>" maxlength="15" disabled class="button">
	            </strong></td>
	            <td><div align="right"><strong>IVA:</strong></div></td>
	            <td><input name="TXTIvaDES" type="text" id="TXTIvaDES" value="<?php echo $TXTIvaDES; ?>" maxlength="15" disabled class="button"></td>
              </tr>
	          <tr>
	            <td><strong>IVA AD. INS.:</strong></td>
	            <td><strong>
                <input name="TXTIvaAdIns" type="text" id="TXTIvaAdIns" value="<?php echo $TXTIvaAdIns; ?>" maxlength="15" disabled class="button">
	            </strong></td>
	            <td><div align="right"><strong>IMPUESTO A LAS GANANCIAS:</strong></div></td>
	            <td><input name="TXTImpGanDES" type="text" id="TXTImpGanDES" value="<?php echo $TXTImpGanDES; ?>" maxlength="15" disabled class="button"></td>
              </tr>
	          <tr>
	            <td><strong>ARANCEL SIM. IMPO.:                </strong></td>
	            <td><strong>
                <input name="TXTAraSimImp" type="text" id="TXTAraSimImp" value="<?php echo $TXTAraSimImp; ?>" maxlength="15" disabled class="button">
	            </strong></td>
	            <td><div align="right"><strong>SERV. GUARDA</strong></div></td>
	            <td><input name="TXTServGuarDES" type="text" id="TXTServGuarDES" value="<?php echo $TXTServGuarDES; ?>" maxlength="15" disabled class="button"></td>
              </tr>
	          <tr>
	            <td><strong>INGRESOS BRUTOS:</strong></td>
	            <td><strong>
                <input name="TXTIngBru" type="text" id="TXTIngBru" value="<?php echo $TXTIngBru; ?>" maxlength="15" disabled class="button">
	            </strong></td>
	            <td><div align="right"><strong>DJAI</strong></div></td>
	            <td><input name="TXTdjai" type="text" class="button" id="TXTdjai" value="<?php echo $TXTdjai; ?>" maxlength="15"></td>
    </tr>
    <tr>
      <td colspan="4"><div align="right">
      				<a href="<?php echo "abms/inspic.php?accion=MOD&cod=".$cod; ?>"><input name="BTNmod" type="button" class="button" id="BTNmod" value="MODIFICAR"></a>
                    <a href="<?php echo "abms/inspic.php?accion=ELI&cod=".$cod; ?>"><input name="BTNeli" type="button" class="button" id="BTNeli" value="ELIMINAR"></a></div></td>
    </tr>    
  </tbody>
</table>