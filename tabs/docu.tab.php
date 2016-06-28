<?php
		#documentaciones
		$db1  = conecto();
		$sql1 = " select * from documentaciones where cod_ord = '".$cod."' ";
		$r1   = mysqli_query($db1, $sql1);
	
		if ($r1 == false){
	    	mysqli_close($db1);
	        $error = "Error: (" . mysql_errno() . ") " . mysql_error().")";
	        //gestion_errores();
	    }
	    	mysqli_close($db1);
			
		while ($arr1 = mysqli_fetch_array($r1))		
		{
			$RDOIP 			= trim($arr1['ins_pic_doc']);
			$FILEPacLis		= trim($arr1['packing_list']);
			$FILEInsEmb		= trim($arr1['ins_emb']);
			$FILELoadPic	= trim($arr1['load_pic_doc']);
			#formateo las que no tienen nada																											
		}
		if(strlen($RDOIP)==0){$RDOIP = "";}
		if(strlen($FILEPacLis)==0){$FILEPacLis = "";}
		if(strlen($FILEInsEmb)==0){$FILEInsEmb = "";}
		if(strlen($FILELoadPic)==0){$FILELoadPic = "";}
?>
<table align="center" class="sombra" id="report">
  <tbody>
    <tr class="accordion">
      <td colspan="2" align="center" style="color:#903;"><h3><div align="center" class="subtitulo"><strong>DOCUMENTACIONES</strong></div></h3></td>
      <td align="center" style="color:#903;" width="10"><div class="arrow"></div></td> 
    </tr>
    <tr>
      <td><strong>INSPECTION PICTURES:</strong></td>
	            <td><?php if($RDOIP=="S"){ echo "SI";
			  }else{ echo "NO";}
			 ?></td>
              </tr>
	          <tr>
	            <td><strong>PACKING LIST:</strong></td>
	            <td><div align="left"><span style="color: #000">
                <?php 
			  	if(strlen($FILEPacLis)!=0){ #Si tiene archivo en el directorio y db muestro borrar, sino muestro para subir				
					//$_SESSION['FILEdespa']=$FILEdespa;  // guardo la variable en sesion 
			  		echo "Archivo : "."$FILEPacLis"; // imprimo en pantalla el nombre del archivo que subo.
			  		echo "<a href=\"ordenes/".$cod."/".$FILEPacLis."\" target='_blank'><img src='images/Down.png' height=50  ></a>"; } ?>
                </span></div></td>
	            </tr>
	          <tr>
	            <td><strong>INSTRUCCIONES DE EMBARQUE: </strong></td>
	            <td colspan="2"><div align="left"><span style="color: #000">
                <?php 
			  	if(strlen($FILEInsEmb)!=0){ #Si tiene archivo en el directorio y db muestro borrar, sino muestro para subir				
					//$_SESSION['FILEdespa']=$FILEdespa;  // guardo la variable en sesion 
			  		echo "Archivo : "."$FILEInsEmb"; // imprimo en pantalla el nombre del archivo que subo.
			  		echo "<a href=\"ordenes/".$cod."/".$FILEInsEmb."\" target='_blank'><img src='images/Down.png' height=50  ></a>"; } ?>
                </span></div></td>
	            </tr>
	          <tr>
	            <td><strong>LOADING PICTURES:
                </strong></td>
	            <td><div align="left"><span style="color: #000">
				<?php 
			  	if(strlen($FILELoadPic)!=0){ #Si tiene archivo en el directorio y db muestro borrar, sino muestro para subir				
					//$_SESSION['FILEdespa']=$FILEdespa;  // guardo la variable en sesion 
			  		echo "Archivo : "."$FILELoadPic"; // imprimo en pantalla el nombre del archivo que subo.
			  		echo "<a href=\"ordenes/".$cod."/".$FILELoadPic."\" target='_blank'><img src='images/Down.png' height=50  ></a>"; } ?></span></div></td>
              </tr>
    <tr>
      <td colspan="2"><div align="right">
      				<a href="<?php echo "abms/docu.php?accion=MOD&cod=".$cod; ?>"><input name="BTNmod" type="button" class="button" id="BTNmod" value="MODIFICAR"></a>
                    <a href="<?php echo "abms/docu.php?accion=ELI&cod=".$cod; ?>"><input name="BTNeli" type="button" class="button" id="BTNeli" value="ELIMINAR"></a></div></td>
    </tr>    
  </tbody>
</table>