<?php
require_once("../funciones.inc.php");
/*

if (falta_logueo())
{ 
	header('location:login.php');
	exit();
}
*/
 //$Xnombre = trim(strtoupper($_SESSION['usuario']));
 $Xnombre ="";
 session_start();

	$Xbuscar = $_GET['busco'];
	//para ver si es por busqueda..

if($Xbuscar=="E"){

	$TXTBcoEmiCHE	= $_GET['TXTBcoEmiCHE'];
	$TXTNroEmiCHE	= $_GET['TXTNroEmiCHE'];
	
	$TXTPerEmiCHE	= $_GET['TXTPerEmiCHE'];
	$TXTConIngCHE	= $_GET['TXTConIngCHE'];
	
	$TXTConSalCHE	= $_GET['TXTConSalCHE'];
	
	$TXTFeDifCHEiN 	= $_GET['TXTFeDifCHEiN'];
	$TXTFeDifCHEouT = $_GET['TXTFeDifCHEouT'];
	$RDOFechadif	= $_GET['RDOFechadif'];
	
	$FEECheiN 		= $_GET['FEECheiN'];
	$FEECheOut 		= $_GET['FEECheOut'];
	$RDOFecha		= $_GET['RDOFecha'];
	
	$FEEsalCheIn 	= $_GET['FEEsalCheIn'];
	$RDOFechaSal	= $_GET['RDOFechaSal'];
	$FEEsalCheOut 	= $_GET['FEEsalCheOut'];
	
	$busqueda = " true ";
	
	if(strlen($TXTBcoEmiCHE)!=0)
		$busqueda.= " and bco_emi_che like '%".$TXTBcoEmiCHE."%' ";

	if(strlen($TXTNroEmiCHE)!=0)
		$busqueda.= " and nro_che = '".$TXTNroEmiCHE."' ";

	if(strlen($TXTPerEmiCHE)!=0)
		$busqueda.= " and emi_che like '%".$TXTPerEmiCHE."%' ";
		
	if(strlen($TXTConIngCHE)!=0)
		$busqueda.= " and concep_ing_che like '%".$TXTConIngCHE."%' ";

	if(strlen($TXTConSalCHE)!=0)
		$busqueda.= " and concep_sal_che like '%".$TXTConSalCHE."%' ";
						
	if($RDOFechadif=="S"){
		$busqueda.= " and fe_dif_che BETWEEN '".$TXTFeDifCHEiN."' AND  '".$TXTFeDifCHEouT."' ";
	}	

	if($RDOFecha=="S"){
		$busqueda.= " and fe_emi_che BETWEEN '".$FEECheiN."' AND  '".$FEECheOut."' ";
	}	
	
	if($RDOFechaSal=="S"){
		$busqueda.= " and fe_sal_che BETWEEN '".$FEEsalCheIn."' AND  '".$FEEsalCheOut."' ";
	}	
		
	$sqla = "select count(*) as canti  from cheques where ".$busqueda." ";		
    //echo $sqla; exit();
	$dba  = conecto();
 
	$ra   = mysqli_query(conecto(),$sqla);
			
	if (!$ra){
		mysqli_close($dba);
		$error = "Error: (" . mysql_errno() . ") " . mysql_error().")";
		//gestion_errores();
	}
		mysqli_close($dba);	
									
     $arrx = mysqli_fetch_array($ra);
     $cantidad = $arrx['canti'];
      //echo 'canti:'.$cantidad;
     if ($cantidad > 1000){
        header("Location: excede.php");
        exit;
     }	
	 
	if($cantidad>0){//Si encontro algo		
		$sqlc = " select * from cheques 
					inner join ordenes  on ordenes.cod_ord = cheques.cod_ord
					where ".$busqueda." order by cheques.cod_ord DESC ";	
		#echo $sqlc;
		$dbc  = conecto();
	 
		$rc   = mysqli_query($dbc, $sqlc);
	
		if ($rc == false){
			mysqli_close($dbc);
			$error = "Error: (" . mysql_errno() . ") " . mysql_error().")";
			//gestion_errores();
		}
			mysqli_close($dbc); 
	}//fin si encontro algo
	else{
	//NO SE ENCONTRO NADA	
	}
											
}

//////////////////////////////////////////////////////////////////////////////
if($_POST){//SEGUNDOS POST

	if($_POST['BTNExcel']){#Genero excel
		$TXTBcoEmiCHE	= $_POST['TXTBcoEmiCHE'];
		$TXTNroEmiCHE	= $_POST['TXTNroEmiCHE'];
		
		$TXTPerEmiCHE	= $_POST['TXTPerEmiCHE'];
		$TXTConIngCHE	= $_POST['TXTConIngCHE'];
		
		$TXTConSalCHE	= $_POST['TXTConSalCHE'];
		
		$TXTFeDifCHEiN 	= $_POST['TXTFeDifCHEiN'];
		$TXTFeDifCHEouT = $_POST['TXTFeDifCHEouT'];
		$RDOFechadif	= $_POST['RDOFechadif'];
		
		$FEECheiN 		= $_POST['FEECheiN'];
		$FEECheOut 		= $_POST['FEECheOut'];
		$RDOFecha		= $_POST['RDOFecha'];
		
		$FEEsalCheIn 	= $_POST['FEEsalCheIn'];
		$RDOFechaSal	= $_POST['RDOFechaSal'];
		$FEEsalCheOut 	= $_POST['FEEsalCheOut'];

		$busqueda = " true ";
		
		if(strlen($TXTBcoEmiCHE)!=0)
			$busqueda.= " and bco_emi_che like '%".$TXTBcoEmiCHE."%' ";
	
		if(strlen($TXTNroEmiCHE)!=0)
			$busqueda.= " and nro_che = '".$TXTNroEmiCHE."' ";
	
		if(strlen($TXTPerEmiCHE)!=0)
			$busqueda.= " and emi_che like '%".$TXTPerEmiCHE."%' ";
			
		if(strlen($TXTConIngCHE)!=0)
			$busqueda.= " and concep_ing_che like '%".$TXTConIngCHE."%' ";
	
		if(strlen($TXTConSalCHE)!=0)
			$busqueda.= " and concep_sal_che like '%".$TXTConSalCHE."%' ";
							
		if($RDOFechadif=="S"){
			$busqueda.= " and fe_dif_che BETWEEN '".$TXTFeDifCHEiN."' AND  '".$TXTFeDifCHEouT."' ";
		}	
	
		if($RDOFecha=="S"){
			$busqueda.= " and fe_emi_che BETWEEN '".$FEECheiN."' AND  '".$FEECheOut."' ";
		}	
		
		if($RDOFechaSal=="S"){
			$busqueda.= " and fe_sal_che BETWEEN '".$FEEsalCheIn."' AND  '".$FEEsalCheOut."' ";
		}	

		#BUSCO!
		$sqlc = " select * from cheques where ".$busqueda." order by cod_ord DESC ";	
		//echo $sqlc;
		$dbc  = conecto();
	 
		$rc   = mysqli_query($dbc, $sqlc);
	
		if ($rc == false){
			mysqli_close($dbc);
			$error = "Error: (" . mysql_errno() . ") " . mysql_error().")";
			//gestion_errores();
		}
			mysqli_close($dbc); 
	
		$X =0;
		while ($imprime = mysqli_fetch_array($rc))			
		{
			$datos[$X]['bco_emi_che'] 	= trim($imprime['bco_emi_che']);
			$datos[$X]['nro_che'] 		= trim($imprime['nro_che']);
			$datos[$X]['fe_emi_che'] 	= trim($imprime['fe_emi_che']);
			$datos[$X]['emi_che'] 		= trim($imprime['emi_che']);
			$datos[$X]['paga_che'] 		= trim($imprime['paga_che']);
			$datos[$X]['observa_che'] 	= trim($imprime['observa_che']);
			
			$datos[$X]['fe_sal_che'] 	 = trim($imprime['fe_sal_che']);
			$datos[$X]['concep_ing_che'] = trim($imprime['concep_ing_che']);
			$datos[$X]['concep_sal_che'] = trim($imprime['concep_sal_che']);
			$datos[$X]['fe_dif_che'] 	 = trim($imprime['fe_dif_che']);
			$datos[$X]['lugar_che'] 	 = trim($imprime['lugar_che']);	
			
			$X++;		
		}
		//Genero el excel
		header("Content-type: application/vnd.ms-excel");
 		header("Content-Disposition:  filename=Cheques_al_dia:_".date('d-m-Y_His').".xls");
	
		$titulo = "<tr><td>BANCO EMISOR</td><td>NUMERO DEL CHEQUE</td><td>FECHA DEL CHEQUE</td><td>EMISOR</td><td>FECHA SALIDA CHEQUE</td><td>CONCEPTO INGRESO</td><td>CONCEPTO SALIDA</td><td>FECHA DIFERIDO DEL CHEQUE</td><td>OBSERVACIONES</td><td>LUGAR</td></tr>";
				
		echo "<table border=1>";
		echo $titulo;
		
		foreach($datos as $fila){
			echo "<tr><td>$fila[bco_emi_che]</td>
					  <td>$fila[nro_che]</td>
					  <td>$fila[fe_emi_che]</td>
					  <td>$fila[emi_che]</td>
					  <td>$fila[fe_sal_che]</td>
					  <td>$fila[concep_ing_che]</td>
					  <td>$fila[concep_sal_che]</td>
					  <td>$fila[fe_dif_che]</td>
					  <td>$fila[observa_che]</td>
					  <td>$fila[lugar_che]</td>
					  </tr>";
					  				
		/*	echo "<tr><td>$fila['bco_emi_che']</td>
					  <td>$fila['nro_che']</td>
					  <td>$fila['fe_emi_che']</td>
					  <td>$fila['emi_che']</td>
					  <td>$fila['paga_che']</td>
					  <td>$fila['observa_che']</td>
					  <td>$fila['fe_sal_che']</td>
					  <td>$fila['concep_ing_che']</td>
					  <td>$fila['concep_sal_che']</td>
					  <td>$fila['fe_dif_che']</td></tr>";*/
						
		}//FIn foreach
		echo "</table>"; 					
		exit();		
	}#Fin genero excel
	
	if($_POST['BTNBusco']){
		header("Location: cheques.bus.php"); 
		exit;	
	}

	if($_POST['BTNvolver']){
		header("Location: ../index.php"); 
		exit;	
	}


			
}
?>
<!DOCTYPE html>
<html>
 <head>
	<meta charset='iso-8859-1'>
	<title>_%%_empresanombre_%%_</title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="../css/style.css">
    
    <link rel="stylesheet" type="text/css" href="../css/slimmenu.css">
   	<script src="../js/jquery.min.js"></script>
    
 </head>
<body>
	<div id="page-wrap"> 
    
    <?php include 'menu.php'; ?>
     <form id="form1" name="form1" method="post">
    <div class="caption">_%%_empresanombre_%%_.</div> 
	<p>USUARIO: <?php echo $Xnombre; ?></p>
    <table class="sombra">
		<thead>
		<tr>
			<th colspan="4"> RESULTADO BUSQUEDA CHEQUES</th>
			<th>&nbsp;</th>
		  </tr>
		<tr>
			<th>ORDEN DE COMPRA</th>
			<th>LUGAR</th>
			<th>BANCO</th>
			<th>NRO CHEQUE</th>
			<th></th>
		</tr>
		</thead>
		<tbody>
        <?php 
		if($cantidad>0){  
		#Genero los botones por si quiere hacer un listado
		 ?>
         <input name="TXTBcoEmiCHE"  id="TXTBcoEmiCHE"  value="<?php echo $TXTBcoEmiCHE; ?>" type="hidden">
         <input name="TXTNroEmiCHE"  id="TXTNroEmiCHE"  value="<?php echo $TXTNroEmiCHE; ?>" type="hidden">
         
         <input name="TXTPerEmiCHE"  id="TXTPerEmiCHE"  value="<?php echo $TXTPerEmiCHE; ?>" type="hidden">
         <input name="TXTConIngCHE"  id="TXTConIngCHE"  value="<?php echo $TXTConIngCHE; ?>" type="hidden">
         
         <input name="TXTConSalCHE"  id="TXTConSalCHE"  value="<?php echo $TXTConSalCHE; ?>" type="hidden">                  
         
         <input name="TXTFeDifCHEiN"  id="TXTFeDifCHEiN"  value="<?php echo $TXTFeDifCHEiN; ?>" type="hidden">
         <input name="TXTFeDifCHEouT"  id="TXTFeDifCHEouT"  value="<?php echo $TXTFeDifCHEouT; ?>" type="hidden">
         <input name="RDOFechadif"  id="RDOFechadif"  value="<?php echo $RDOFechadif; ?>" type="hidden">         

         <input name="FEECheiN"  id="FEECheiN"  value="<?php echo $FEECheiN; ?>" type="hidden">
         <input name="FEECheOut"  id="FEECheOut"  value="<?php echo $FEECheOut; ?>" type="hidden">
         <input name="RDOFecha"  id="RDOFecha"  value="<?php echo $RDOFecha; ?>" type="hidden"> 

         <input name="FEEsalCheIn"  id="FEEsalCheIn"  value="<?php echo $FEEsalCheIn; ?>" type="hidden">
         <input name="RDOFechaSal"  id="RDOFechaSal"  value="<?php echo $RDOFechaSal; ?>" type="hidden">
         <input name="FEEsalCheOut"  id="FEEsalCheOut"  value="<?php echo $FEEsalCheOut; ?>" type="hidden">          
         <?php 
		 	#Muestro el listado
			while ($arr = mysqli_fetch_array($rc))			
			{		
		 ?>
		<tr>
			<td><?php echo	$num_unico	 = trim($arr['num_unico'])."/".substr((trim($arr['fe_alt_ord'])),0,4);?></td>
			<td><?php echo $lugar_che  = trim($arr['lugar_che']);			
				?></td>
			<td><?php echo $bco_emi_che  = trim($arr['bco_emi_che']);?></td>
			<td><?php echo $nro_che  = trim($arr['nro_che']); ?></td>
            <td>
            <a href="<?php $cod_che  = trim($arr['cod_che']);
			echo "../veocheque.php?cod=".$cod_che; ?>"><input name="BTNir" type="button" class="button" id="BTNir" value=" VER "></a></td>
		</tr>
        <?php 
			}
		}else{
		?>	
		<tr>
		  <td colspan="5"><div align="center">NO SE ENCONTRO RESULTADO</div></td>
		  </tr>		
		<?php 	
			
			}	
 		 ?>
		<tr>
			<td colspan="5"><div align="center"><span style="color: #000">
           	  <input type="submit" name="BTNExcel" id="BTNExcel" class="button" value="GENERAR EXCEL">
			  <input type="submit" name="BTNBusco" id="BTNBusco" class="button" value="VOLVER BUSCAR">
			  <input type="submit" name="BTNvolver" id="BTNvolver" class="button" value="VOLVER AL MENU">
			</span></div></td>
          </tr>
		<tr>
			<td colspan="5">
            <br>
    		<br>
    		<div align="center">
			<?php
                if(($pagina - 1) > 0){
                    echo "<a href='resucheque.php?pagina=".($pagina-1)."'>Anterior</a>";
                }
                    for ($i=1;$i<=$total_paginas;$i++){
                        if($pagina == $i){
                            echo "<b> ".$pagina."</b>";
                        }else{
                            echo " <a href=resucheque.php?pagina=$i>$i</a>";
                        }
                    }
                    if(($pagina + 1) <= $total_paginas){
                         echo " <a href='resucheque.php?pagina=".($pagina+1)."'>Siguiente</a>";
                    }
             ?>
            </div></td>
          </tr>	           	         
	</tbody>
	</table>

     </form>
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
