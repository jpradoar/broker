<?php

	$FILEdjai		= "";
	$FILEmed_cau	= "";
	$FILEseg_cau	= "";
	$FILEoficio		= "";
	$FILEventaja	= "";
	$FILEpack_list	= "";
	$FILEexp_decla	= "";
	$FILEprice_list	= "";
	$FILEnot_comp	= "";
	$FILEcer_or		= "";
	$FILEdespa		= "";
	$FILEpol_seg	= "";


	#amparos
	$db1  = conecto();
	$sql1 = " select * from amparos where cod_ord = '".$cod."' ";
	$r1   = mysqli_query($db1, $sql1);
	
	if ($r1 == false){
	   	mysqli_close($db1);
        $error = "Error: (" . mysql_errno() . ") " . mysql_error().")";
        //gestion_errores();
    }
    	mysqli_close($db1);
			
	while ($arr1 = mysqli_fetch_array($r1))		
	{
		$FILEdjai		= trim($arr1['djai']);
		$FILEmed_cau	= trim($arr1['med_cau']);
		$FILEseg_cau	= trim($arr1['seg_cau']);
		$FILEoficio		= trim($arr1['oficio']);
		$FILEventaja	= trim($arr1['ventaja']);
		$FILEpack_list	= trim($arr1['packing_list']);
		$FILEexp_decla	= trim($arr1['exp_decla']);
		$FILEprice_list	= trim($arr1['price_list']);
		$FILEnot_comp	= trim($arr1['not_comp']);
		$FILEcer_or		= trim($arr1['cer_ori']);
		$FILEdespa		= trim($arr1['desp']);
		$FILEpol_seg	= trim($arr1['pol_seg']);
		#formateo las que no tienen nada																											
	}
		if(strlen($FILEdjai)==0){$FILEdjai = "";}
		if(strlen($FILEmed_cau)==0){$FILEmed_cau = "";}
		if(strlen($FILEseg_cau)==0){$FILEseg_cau = "";}
		if(strlen($FILEoficio)==0){$FILEoficio = "";}
		if(strlen($FILEventaja)==0){$FILEventaja = "";}
		if(strlen($FILEpack_list)==0){$FILEpack_list = "";}
		if(strlen($FILEexp_decla)==0){$FILEexp_decla = "";}
		if(strlen($FILEprice_list)==0){$FILEprice_list = "";}
		if(strlen($FILEnot_comp)==0){$FILEnot_comp = "";}
		if(strlen($FILEcer_or)==0){$FILEcer_or = "";}
		if(strlen($FILEdespa)==0){$FILEdespa = "";}
		if(strlen($FILEpol_seg)==0){$FILEpol_seg = "";}
?>
<table align="center" class="sombra" id="report">
  <tbody>
    <tr class="accordion">
      <td colspan="2" align="center" style="color:#903;"><h3><div align="center" class="subtitulo"><strong>DOCUMENTACION</strong></div></h3></td>
        <td align="center" style="color:#903;" width="10"><div class="arrow"></div></td>
    </tr>
    <tr>
      <td colspan="3">&nbsp;</td>
              </tr>
	          <tr>
	            <td width="20%"><strong>DJAI: </strong></td>
	            <td><div align="left">
	              <span style="color: #000">
	              <?php 
					if(strlen($FILEdjai)!=0){ 
					
						echo "Archivo : "."$FILEdjai"; // imprimo en pantalla el nombre del archivo que subo.
					
						 }
					?></span></div></td>
	            <td><?php 
					if(strlen($FILEdjai)!=0){
						
						echo "<a href=\"ordenes/".$cod."/".$FILEdjai."\" target='_blank'><img src='images/Down.png' height=50  ></a>"; 
					}
					?></td>
    </tr>
	          <tr>
	            <td width="20%"><strong>MEDIDA CAUTELAR: </strong></td>
	            <td><div align="left">
	              <span style="color: #000">
	              <?php 
			  		if(strlen($FILEmed_cau)!=0){ 
			  		
						echo "Archivo : "."$FILEmed_cau"; // imprimo en pantalla el nombre del archivo que subo.
			  		
					} ?></span></div></td>
	            <td><?php 
					if(strlen($FILEmed_cau)!=0){ 
					
						echo "<a href=\"ordenes/".$cod."/".$FILEmed_cau."\" target='_blank'><img src='images/Down.png' height=50  ></a>"; 
					}?></td>
	            </tr>
	          <tr>
	            <td width="20%"><strong>SEGURO DE CAUCION: </strong></td>
	            <td><div align="left">
	              <span style="color: #000">
	              <?php 
			  		if(strlen($FILEseg_cau)!=0){ 
				
			  			echo "Archivo : "."$FILEseg_cau"; 
			  	 
				 	} ?></span></div></td>
	            <td><?php 
						if(strlen($FILEseg_cau)!=0){ 
							
							echo "<a href=\"ordenes/".$cod."/".$FILEseg_cau."\" target='_blank'><img src='images/Down.png' height=50  ></a>";
						} ?></td>
    </tr>
	          <tr>
	            <td width="20%"><strong>OFICIO: </strong></td>
	            <td><div align="left">
	              <span style="color: #000">
	              <?php 
			  		if(strlen($FILEoficio)!=0){ 
			  		
					echo "Archivo : "."$FILEoficio"; 
			  		
					 } ?></span></div></td>
	            <td><?php 
						if(strlen($FILEoficio)!=0){
							
							echo "<a href=\"ordenes/".$cod."/".$FILEoficio."\" target='_blank'><img src='images/Down.png' height=50  ></a>"; 
						}	?></td>
    </tr>
	          <tr>
	            <td width="20%"><strong>VENTAJA: </strong></td>
	            <td><div align="left">
	              <span style="color: #000">
	              <?php 
					if($FILEventaja=="S"){ 
						echo "SI"; 
					}else{
						echo "NO"; 
						} ?></span></div></td>
	            <td>&nbsp;</td>
    </tr>
	          <tr>
	            <td width="20%"><strong>PACKING LIST: </strong></td>
	            <td><div align="left">
	              <span style="color: #000">
	              <?php 
			  		if(strlen($FILEpack_list)!=0){ 
				
			  			echo "Archivo : "."$FILEpack_list"; 
					
			  		} ?></span></div></td>
	            <td><?php 
						if(strlen($FILEpack_list)!=0){ 
							
							echo "<a href=\"ordenes/".$cod."/".$FILEpack_list."\" target='_blank'><img src='images/Down.png' height=50  ></a>"; 
						}?></td>
    </tr>
	          <tr>
	            <td width="20%"><strong>EXPORT DECLARATION: </strong></td>
	            <td><div align="left">
	              <span style="color: #000">
	              <?php 
					if(strlen($FILEexp_decla)!=0){ 
					
						echo "Archivo : "."$FILEexp_decla"; 
						
					 } ?></span></div></td>
	            <td><?php 
					if(strlen($FILEexp_decla)!=0){
						
						echo "<a href=\"ordenes/".$cod."/".$FILEexp_decla."\" target='_blank'><img src='images/Down.png' height=50  ></a>"; 
					 }	?></td>
    </tr>
	          <tr>
	            <td width="20%"><strong>PRICE LIST:</strong></td>
	            <td><div align="left">
	              <span style="color: #000">
	              <?php 
			  		if(strlen($FILEprice_list)!=0){ 
				
			  		echo "Archivo : "."$FILEprice_list"; 
			  		
					 } ?></span></div></td>
	            <td><?php 
					if(strlen($FILEprice_list)!=0){
						
						echo "<a href=\"ordenes/".$cod."/".$FILEprice_list."\" target='_blank'><img src='images/Down.png' height=50  ></a>"; 
					}	?></td>
    </tr>
	          <tr>
	            <td width="20%"><strong>NOTA DE COMPOSICION: </strong></td>
	            <td><div align="left">
	              <span style="color: #000">
	              <?php 
			  		if(strlen($FILEnot_comp)!=0){
					
			  		echo "Archivo : "."$FILEnot_comp"; // imprimo en pantalla el nombre del archivo que subo.
			  		
					 } ?></span></div></td>
	            <td><?php 
					if(strlen($FILEnot_comp)!=0){
						
						echo "<a href=\"ordenes/".$cod."/".$FILEnot_comp."\" target='_blank'><img src='images/Down.png' height=50  ></a>"; 
					}	?></td>
    </tr>
	          <tr>
	            <td width="20%"><strong>CERTIFICADO DE ORIGEN: </strong></td>
	            <td><div align="left">
	              <span style="color: #000">
	              <?php 
					if(strlen($FILEcer_or)!=0){ 
					
						echo "Archivo : "."$FILEcer_or"; 
					
					} ?></span></div></td>
	            <td><?php 
					if(strlen($FILEcer_or)!=0){ 
					
					echo "<a href=\"ordenes/".$cod."/".$FILEcer_or."\" target='_blank'><img src='images/Down.png' height=50  ></a>"; 
					}?></td>
    </tr>
	          <tr>
	            <td width="20%"><strong>DESPACHO: </strong></td>
	            <td><div align="left">
	              <span style="color: #000">
	              <?php 
			  		if(strlen($FILEdespa)!=0){ 
				 
			  			echo "Archivo : "."$FILEdespa"; 
			  		
					 } ?></span></div></td>
	            <td><?php 
					if(strlen($FILEdespa)!=0){ 
					
						echo "<a href=\"ordenes/".$cod."/".$FILEdespa."\" target='_blank'><img src='images/Down.png' height=50  ></a>"; 
					}?></td>
    </tr>
	          <tr>
	            <td width="20%"><strong>POLIZA DE SEGURO: </strong></td>
	            <td><div align="left"><span style="color: #000">
				<?php 
			  		if(strlen($FILEpol_seg)!=0){ 
			  		
						echo "Archivo : "."$FILEpol_seg"; // imprimo en pantalla el nombre del archivo que subo.
			  		
					 } ?></span></div></td>
	            <td><?php 
					if(strlen($FILEpol_seg)!=0){ 
					
						echo "<a href=\"ordenes/".$cod."/".$FILEpol_seg."\" target='_blank'><img src='images/Down.png' height=50  ></a>"; 
					}?></td>
              </tr>
    <tr>
      <td colspan="3"><div align="right">
      				<a href="<?php echo "abms/amparos.php?accion=MOD&cod=".$cod; ?>"><input name="BTNmod" type="button" class="button" id="BTNmod" value="MODIFICAR"></a>
                    <a href="<?php echo "abms/amparos.php?accion=ELI&cod=".$cod; ?>"><input name="BTNeli" type="button" class="button" id="BTNeli" value="ELIMINAR"></a></div></td>
    </tr>    
  </tbody>
</table>
