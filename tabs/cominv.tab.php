<?php
		#ADELANTOCLIENTE
		$db1  = conecto();
		$sql1 = "select * from comercialinvoice where cod_ord = ".$cod." ";
		$r1   = mysqli_query($db1, $sql1);
	
		if ($r1 == false){
	    	mysqli_close($db1);
	        $error = "Error: (" . mysql_errno() . ") " . mysql_error().")";
	        //gestion_errores();
	    }
	    	mysqli_close($db1);
			
		while ($arr1 = mysqli_fetch_array($r1))		
		{
			$LSTfechaEFP = trim($arr1['fe_fin_prod']);//ARREGLAR!!
			$TXTnroCI 	 = trim($arr1['num_com_inv']);
			$TXTMontoCI  = trim($arr1['monto_com_inv']);
			$RDOCI	 	 = trim($arr1['giro_com_inv']);
			$FILEci		 = trim($arr1['file_com_inv']);
			#formateo las que no tienen nada																											
		}
			if(strlen($LSTfechaEFP)<4){$LSTfechaEFP = "";}
			if(strlen($TXTnroCI)==0){$TXTnroCI = "";}
			if(strlen($TXTMontoCI)==0){$TXTMontoCI = "";}
			if(strlen($RDOCI)==0){$RDOCI = "";}
			if(strlen($FILEci)==0){$FILEci = "";}
?>
<table align="center" class="sombra" id="report">
  <tbody>
    <tr class="accordion">
      <td colspan="3" align="center" style="color:#903;"><h3><div align="center" class="subtitulo"><strong>COMERCIAL INVOICE</strong></div></h3></td>
      <td align="center" style="color:#903;" width="10"><div class="arrow"></div></td>
    </tr>
    <tr>
      <td><strong>ARCHIVO C.I.:</strong></td>
      <td colspan="2"><div align="left"><span style="color: #000">
        <?php 
			if(strlen($FILEci)!=0){ 				
					 
				echo "Archivo : "."$FILEci"; 
			  	echo "<a href=\"ordenes/".$cod."/".$FILEci."\" target='_blank'><img src='images/Down.png' height=50  ></a>"; 
				
			} ?>
      </span></div></td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td><strong>FECHA ESTIMADA FIN PROD.:</strong></td>
	            <td><?php echo ordenofecha($LSTfechaEFP);?></td>
	            <td>&nbsp;</td>
	            <td><strong>GIRADO</strong></td>
	            </tr>
	          <tr>
	            <td><strong>NRO. COMERCIAL INVOICE:</strong></td>
	            <td><strong>
	              <input name="TXTnroCI" type="text" id="TXTnroCI" value="<?php echo $TXTnroCI; ?>" maxlength="15" disabled class="button">
	              </strong></td>
	            <td><strong>MONTO:
	                <input name="TXTMontoCI" type="text" id="TXTMontoCI" value="<?php echo $TXTMontoCI; ?>" maxlength="15" disabled class="button">.U$S</strong></td>
	            <td><p><strong>
                <?php 
				 	if($RDOCI=="S"){ echo "SI";}
			  		if($RDOCI=="N"){ echo "NO";}
			  	?>
	                </strong></p></td>
    </tr>
    <tr>
      <td colspan="4"><div align="right">
      				<a href="<?php echo "abms/comerinvoice.php?accion=MOD&cod=".$cod; ?>"><input name="BTNmod" type="button" class="button" id="BTNmod" value="MODIFICAR"></a>
                    <a href="<?php echo "abms/comerinvoice.php?accion=ELI&cod=".$cod; ?>"><input name="BTNeli" type="button" class="button" id="BTNeli" value="ELIMINAR"></a></div></td>
    </tr>    
  </tbody>
</table>