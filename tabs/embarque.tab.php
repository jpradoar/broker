<?php
		#ADELANTOCLIENTE
		$db1  = conecto();
		$sql1 = "select * from embarques where cod_ord = ".$cod." ";
		$r1   = mysqli_query($db1, $sql1);
	
		if ($r1 == false){
	    	mysqli_close($db1);
	        $error = "Error: (" . mysql_errno() . ") " . mysql_error().")";
	        //gestion_errores();
	    }
	    	mysqli_close($db1);
			
		while ($arr1 = mysqli_fetch_array($r1))		
		{
			$TXTnumBL 	 = trim($arr1['num_bl']);
			$FILEemba	 = trim($arr1['file_emb']);
			
			$LSTfechaIdE = trim($arr1['fe_inst_emb']);
			$LSTfechaFE  = trim($arr1['fe_emb']);
			$LSTfechaFLL = trim($arr1['fe_llegada_emb']);
			$LstEstadoBL = trim($arr1['estado_emb']);
			$TXTNotaBL	 = trim($arr1['notas_emb']);
			#formateo las que no tienen nada																											
		}
		if(strlen($TXTnumBL)==0){$TXTnumBL = "";}
		if(strlen($FILEemba)==0){$FILEemba = "";}
		
		if(strlen($LSTfechaIdE)<4){$LSTfechaIdE = "";}
		if(strlen($LSTfechaFE)<4){$LSTfechaFE = "";}
		if(strlen($LSTfechaFLL)<4){$LSTfechaFLL = "";}				
		if(strlen($LstEstadoBL)==0){$LstEstadoBL = "";}
		if(strlen($TXTNotaBL)==0){$TXTNotaBL = "";}	
?>
<table align="center" class="sombra" id="report">
  <tbody>
    <tr class="accordion">
      <td colspan="4" align="center" style="color:#903;"><h3><div align="center" class="subtitulo"><strong>EMBARQUES</strong></div></h3></td>
      <td align="center" style="color:#903;" width="10"><div class="arrow"></div></td> 
    </tr>
    <tr>
      <td><strong>ARCHIVO EMBARQUE:</strong></td>
      <td><div align="left"><span style="color: #000">
        <?php 
			if(strlen($FILEemba)!=0){ 				
					 
				echo "Archivo : "."$FILEemba"; 
			  	echo "<a href=\"ordenes/".$cod."/".$FILEemba."\" target='_blank'><img src='images/Down.png' height=50  ></a>"; 
				
			} ?>
      </span></div></td>
    </tr>
    <tr>
      <td width="31%"><strong>NRO. B.L.:</strong></td>
	            <td><strong>
	              <input name="TXTnumBL" type="text" id="TXTnumBL" maxlength="15" value="<?php echo $TXTnumBL; ?>" disabled class="button">
	            </strong></td>
	            </tr>
	          <tr>
	            <td><strong>INSTRUCCIONES DE EMBARQUE:</strong></td>
	            <td><?php echo ordenofecha($LSTfechaIdE);?></td>
              </tr>
	          <tr>
	            <td><strong>FECHA EMBARQUE:</strong></td>
	            <td><?php echo ordenofecha($LSTfechaFE);?></td>
	            </tr>
	          <tr>
	            <td><strong>FECHA LLEGADA:</strong></td>
	            <td><?php echo ordenofecha($LSTfechaFLL);?></td>
	            </tr>
	          <tr>
	            <td><strong>ESTADO:</strong></td>
	            <td><strong>
	              <select name="LstEstadoBL" id="LstEstadoBL" value="<?php echo $LstEstadoBL; ?>" disabled class="button">
	                <option value="1" <?php if($LstEstadoBL==1){ echo 'selected';}?> >Producción</option>
	                <option value="2" <?php if($LstEstadoBL==2){ echo 'selected';}?> >Embarcada</option>
	                <option value="3" <?php if($LstEstadoBL==3){ echo 'selected';}?> >En puerto</option>
	                <option value="4" <?php if($LstEstadoBL==4){ echo 'selected';}?> >Entregada</option>
	                <option value="5" <?php if($LstEstadoBL==5){ echo 'selected';}?> >Saldada</option>
	                </select>
	              </strong></td>
	            </tr>
	          <tr>
	            <td><strong>NOTAS:</strong></td>
	            <td><strong>
	              <textarea name="TXTNotaBL" cols="50" maxlength="400" id="TXTNotaBL" disabled class="button"><?php echo $TXTNotaBL; ?></textarea>
	              </strong></td>
    </tr>
    <tr>
      <td colspan="4"><div align="right">
      				<a href="<?php echo "abms/embarques.php?accion=MOD&cod=".$cod; ?>"><input name="BTNmod" type="button" class="button" id="BTNmod" value="MODIFICAR"></a>
                    <a href="<?php echo "abms/embarques.php?accion=ELI&cod=".$cod; ?>"><input name="BTNeli" type="button" class="button" id="BTNeli" value="ELIMINAR"></a></div></td>
    </tr>    
  </tbody>
</table>