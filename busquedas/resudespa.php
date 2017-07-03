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

	$TXTNumDesp		= strtoupper(trim($_GET['despa']));
	$LSTfechaDES 	= strtoupper(trim($_GET['feson']));
	$LSTfechaDESFIN = strtoupper(trim($_GET['fechaf']));
	$RDOFecha	 	= strtoupper(trim($_GET['fecha']));
	$TXTPosAra		= strtoupper(trim($_POST['posara']));
			
	$busqueda 	= " true ";
	
	if(strlen($TXTNumDesp)!=0)
		$busqueda.= " and inspectionpictures.num_desp = '".$TXTNumDesp."' ";

	if(strlen($TXTPosAra)!=0)
		$busqueda.= " and inspectionpictures.pos_ara = '".$TXTPosAra."' ";
		
	if($RDOFecha=="S"){
		$busqueda.= " and inspectionpictures.fe_desp BETWEEN '".$LSTfechaDES."' AND  '".$LSTfechaDESFIN."' ";
	}	
		

	$sqla = "select count(*) as canti  from inspectionpictures
				inner join ordenes  on ordenes.cod_ord = inspectionpictures.cod_ord where ".$busqueda." ";		
    #echo $sqla; exit();
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
		$sqlc = " select * from inspectionpictures
				inner join ordenes  on ordenes.cod_ord = inspectionpictures.cod_ord 
				inner join clientes on ordenes.cod_cli = clientes.cod_cli where ".$busqueda." order by ordenes.cod_ord DESC ";	
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

if($_POST){//SEGUNDOS POST
	
	if($_POST['BTNExcel']){#Genero excel
		
		$TXTNumDesp		= strtoupper(trim($_POST['TXTNumDesp']));
		$LSTfechaDES 	= strtoupper(trim($_POST['LSTfechaDES']));
		$LSTfechaDESFIN = strtoupper(trim($_POST['LSTfechaDESFIN']));
		$RDOFecha	 	= strtoupper(trim($_POST['RDOFecha']));
		$TXTPosAra	 	= strtoupper(trim($_POST['posara']));
				
		$busqueda 	= " true ";
		
		if(strlen($TXTNumDesp)!=0)
			$busqueda.= " and inspectionpictures.num_desp = '".$TXTNumDesp."' ";
	
		if(strlen($TXTPosAra)!=0)
			$busqueda.= " and inspectionpictures.pos_ara = '".$TXTPosAra."' ";
			
		if($RDOFecha=="S"){
			$busqueda.= " and inspectionpictures.fe_desp BETWEEN '".$LSTfechaDES."' AND  '".$LSTfechaDESFIN."' ";
		}
		

		$sqlc = " select * from inspectionpictures
				inner join ordenes  on ordenes.cod_ord = inspectionpictures.cod_ord
				inner join clientes on ordenes.cod_cli = clientes.cod_cli where ".$busqueda." order by ordenes.cod_ord DESC ";	
		#echo $sqlc;
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
			$datos[$X]['ape_cli'] 	= trim($imprime['ape_cli']);
			$datos[$X]['nom_cli'] 	= trim($imprime['nom_cli']);
			$datos[$X]['codigo']	= trim($imprime['num_unico'])."/".substr((trim($imprime['fe_alt_ord'])),0,4);
			
			
			$datos[$X]['djai'] 		= trim($imprime['djai']); 
			$datos[$X]['fe_desp'] 	= trim($imprime['fe_desp']); 
			$datos[$X]['num_desp'] 	= trim($imprime['num_desp']); 
			$datos[$X]['monto_desp'] 	= trim($imprime['monto_desp']); 
			$datos[$X]['tip_cam_desp'] 	= trim($imprime['tip_cam_desp']); 
			$datos[$X]['moto_ar_desp'] 	= trim($imprime['moto_ar_desp']); 
			
			$datos[$X]['pos_ara'] 		= trim($imprime['pos_ara']); 
			$datos[$X]['met_pag_desp'] 	= trim($imprime['met_pag_desp']); 
			$datos[$X]['banco_desp'] 	= trim($imprime['banco_desp']); 
			
			$datos[$X]['der_imp'] 		= trim($imprime['der_imp']); 
			$datos[$X]['tas_estad'] 	= trim($imprime['tas_estad']); 
			$datos[$X]['multa_desp'] 	= trim($imprime['multa_desp']); 
			
			$datos[$X]['iva_ad_desp'] 	= trim($imprime['iva_ad_desp']); 
			$datos[$X]['iva_desp'] 	= trim($imprime['iva_desp']); 
			$datos[$X]['imp_gan'] 	= trim($imprime['imp_gan']); 
			
			$datos[$X]['ara_desp'] 	= trim($imprime['ara_desp']); 
			$datos[$X]['serv_guar'] = trim($imprime['serv_guar']); 
			$datos[$X]['ing_bru'] 	= trim($imprime['ing_bru']); 
			
			$X++;
		}

		//Genero el excel
		header("Content-type: application/vnd.ms-excel");
 		header("Content-Disposition:  filename=Despachos_al_dia:_".date('d-m-Y_His').".xls");
	
		$titulo = "<tr><td>CLIENTE APELLIDO</td>
						<td>CLIENTE NOMBRE</td>
						<td>CODIGO ORDEN DE COMPRA</td>
						<td>DJAI</td>
						<td>FECHA OFICIALIZACION</td>
						<td>NUMERO DESPACHO</td>
						<td>MONTO</td>
						<td>TIPO DE CAMBIO AL DIA</td>
						<td>POSICION ARANCELARIA</td>
						<td>DERECHOS IMPORTACION</td>
						<td>TASA ESTADISTICA</td>
						<td>MULTA DEST. FUERA DE TER</td>
						<td>IVA AD. INS</td>
						<td>IVA</td>
						<td>IMPUESTO A LAS GANANCIAS</td>
						<td>ARANCEL SIM. IMPO.</td>
						<td>SERV. GUARDA</td>
						<td>INGRESOS BRUTOS</td>
						</tr>";
				
		echo "<table border=1>";
		echo $titulo;
	  
		foreach($datos as $fila){
			echo "<tr><td>$fila[ape_cli]</td>
					  <td>$fila[nom_cli]</td>
					  <td>$fila[codigo]</td>
					  
					  <td>$fila[djai]</td>
					  <td>$fila[fe_desp]</td>
					  <td>$fila[num_desp]</td>
					  
					  <td>$fila[monto_desp]</td>
					  <td>$fila[moto_ar_desp]</td>
					  
					  <td>$fila[pos_ara]</td>
					  <td>$fila[der_imp]</td>
					  <td>$fila[tas_estad]</td>
					  
					  <td>$fila[multa_desp]</td>
					  
					  <td>$fila[iva_ad_desp]</td>
					  <td>$fila[iva_desp]</td>
					  <td>$fila[imp_gan]</td>
					  
					  <td>$fila[ara_desp]</td>
					  <td>$fila[serv_guar]</td>
					  <td>$fila[ing_bru]</td>
					  </tr>";
					  								  					 						
		}//FIn foreach
		echo "</table>"; 					
		exit();				
	}
	
	if($_POST['BTNBusco']){
		header("Location: despacho.bus.php"); 
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
			<th colspan="4"> RESULTADO BUSQUEDA DOCUMENTACION DESPACHO</th>
			<th>&nbsp;</th>
		  </tr>
		<tr>
			<th>NUMERO DESPACHO</th>
			<th>CLIENTE</th>
			<th>CODIGO O.C.</th>
			<th>FECHA DESPACHO</th>
			<th></th>
		</tr>
		</thead>
		<tbody>
        <?php 
		if($cantidad>0){ 
		#Genero los botones por si quiere hacer un listado
		 ?>	 
        <input name="TXTNumDesp"  id="TXTNumDesp"  value="<?php echo $TXTNumDesp; ?>" type="hidden">
        <input name="LSTfechaDES"  id="LSTfechaDES"  value="<?php echo $LSTfechaDES; ?>" type="hidden">
        <input name="LSTfechaDESFIN"  id="LSTfechaDESFIN"  value="<?php echo $LSTfechaDESFIN; ?>" type="hidden">
        <input name="RDOFecha"  id="RDOFecha"  value="<?php echo $RDOFecha; ?>" type="hidden">

    		 
		 <?php    
			while ($arr = mysqli_fetch_array($rc))			
			{		
		 ?>
		<tr>
			<td><?php echo $destino  = trim($arr['num_desp']);?></td>
			<td><?php 
					$ape_cli = trim($arr['ape_cli']);
					$nom_cli = trim($arr['nom_cli']);
					echo $ape_cli." ".$nom_cli;				
				?></td>
			<td><?php echo	$num_unico	 = trim($arr['num_unico'])."/".substr((trim($arr['fe_alt_ord'])),0,4);?></td>
		  <td><?php echo $destino  = ordenofecha(trim($arr['fe_desp']));?></td>
			<td>
            <a href="<?php $cod_ord  = trim($arr['cod_ord']);
			echo "../veoordenes.php?cod=".$cod_ord; ?>"><input name="BTNir" type="button" class="button" id="BTNir" value=" VER "></a></td>
		</tr>
        <?php 
			}
		}else{
		?>	
		<tr>
		  <td colspan="5">
          				<br>
                        <br>
                        <br>
                        <br>
                        <div align="center">NO SE ENCONTRO RESULTADO</div><br>
                        <br>
                        <br>
                        <br>
                        </td>
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
		</tbody>
	</table>
    <br>
    <br>
    <div align="center">
    <?php
    	if(($pagina - 1) > 0){
        	echo "<a href='resudespa.php?pagina=".($pagina-1)."'>Anterior</a>";
        }
            for ($i=1;$i<=$total_paginas;$i++){
            	if($pagina == $i){
                	echo "<b> ".$pagina."</b>";
                }else{
                	echo " <a href=resudespa.php?pagina=$i>$i</a>";
                }
            }
            if(($pagina + 1) <= $total_paginas){
            	 echo " <a href='resudespa.php?pagina=".($pagina+1)."'>Siguiente</a>";
            }
     ?></div>
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
