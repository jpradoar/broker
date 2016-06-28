<?php
		#ADELANTO china
		$db1  = conecto();
		$sql1 = "select * from adelantochina where cod_ord = ".$cod." ";
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
			$codch			= trim($arr1['cod_ch']);
			$LSTfechaPADC	= trim($arr1['fe_prim_ch']);
			$RDOTipPago  	= trim($arr1['tipo_ch']);
			$TXTMontoCH		= trim($arr1['monto_ch']);
			$TXTNotasADC	= trim($arr1['notas_ch']);
			#formateo las que no tienen nada																											
	
		if(strlen($LSTfechaPADC)<4){$LSTfechaPADC = "";}
		if(strlen($TXTMontoCH)==0){$TXTMontoCH = "";}
		if(strlen($TXTNotasADC)==0){$TXTNotasADC = "";}
?>
<table align="center" class="sombra" id="report">
  <tbody>
    <tr class="accordion">
      <td colspan="4" align="center" style="color:#903;"><h3><input type="text" value="<?php echo $codch; ?>" style="display:none;" ><div align="center" class="subtitulo"><strong>GIROS / PAGOS EN ORIGEN</strong></div></h3></td>
      <td align="center" style="color:#903;" width="10"><div class="arrow"></div></td> 
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td colspan="2"><div align="right"><strong>TIPO DE PAGO
      :
          <?php if($RDOTipPago=="G"){
      				echo "GIRO";	
                    }else{
                    echo "PAGO";	
                    }?>
      </strong></div></td>
    </tr>
    <tr>
      <td><strong>FECHA PRIMER AD. A CHINA:</strong></td>
	            <td><?php echo ordenofecha($LSTfechaPADC);?></td>
	            <td colspan="2"><strong>MONTO:
	              <input name="TXTMontoCH" type="text" id="TXTMontoCH" maxlength="15" value="<?php echo $TXTMontoCH; ?>" disabled class="button">
	              .U$S</strong></td>
	            </tr>
	          <tr>
	            <td><strong>NOTAS AD. A CHINA</strong></td>
	            <td colspan="3"><strong>
	              <input name="TXTNotasADC" type="text" id="TXTNotasADC" value="<?php echo $TXTNotasADC; ?>" size="70" maxlength="150" disabled class="button">
	            </strong></td>
    </tr>
    <tr>
      <td colspan="4"><div align="right">
      <a href="<?php echo "abms/adelantochina.php?accion=ALT&cod=".$cod; ?>"><input name="BTNALT" type="button" class="button" id="BTNALT" value="ALTA"></a>
      				<a href="<?php echo "abms/adelantochina.php?accion=MOD&cod=".$cod."&codch=".$codch; ?>"><input name="BTNmod" type="button" class="button" id="BTNmod" value="MODIFICAR"></a>
                    <a href="<?php echo "abms/adelantochina.php?accion=ELI&cod=".$cod."&codch=".$codch; ?>"><input name="BTNeli" type="button" class="button" id="BTNeli" value="ELIMINAR"></a></div></td>
    </tr>    
  </tbody>
</table>
<?php }?>