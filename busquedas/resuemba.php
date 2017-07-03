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

	$cli	= $_GET['cli'];
	$fecha	= $_GET['fecha'];
	$nrobl	= $_GET['nrobl'];
	$feson	= $_GET['feson'];
	$fechaf	= $_GET['fechaf'];
	$destino= $_GET['destino'];

	$fechallega	= $_GET['fechallega'];
	$fechellegai= $_GET['fechellegai'];
	$fechellegaf= $_GET['fechellegaf'];
 
			
	$busqueda = " true ";
	
	if(strlen($cli)!=0)
		$busqueda.= " and ordenes.cod_cli like '%".$cli."%' ";

	if(strlen($nrobl)!=0)
		$busqueda.= " and embarques.num_bl = '".$nrobl."' ";

	if($destino!="***")
		$busqueda.= " and ordenes.destino = '".$destino."' ";
		
	if($feson=="S"){
		$busqueda.= " and embarques.fe_emb BETWEEN '".$fecha."' AND  '".$fechaf."' ";
	}	

	if($fechallega=="S"){
		$busqueda.= " and embarques.fe_llegada_emb BETWEEN '".$fechellegai."' AND  '".$fechellegaf."' ";
	}
	
	$sqla = "select count(*) as canti  from embarques
				inner join ordenes  on ordenes.cod_ord = embarques.cod_ord
				inner join clientes on ordenes.cod_cli = clientes.cod_cli where ".$busqueda." ";		
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
		$sqlc = " select * from embarques
				inner join ordenes  on ordenes.cod_ord = embarques.cod_ord
				inner join clientes on ordenes.cod_cli = clientes.cod_cli where ".$busqueda." order by ordenes.cod_ord DESC ";	
		//echo $sqlc;
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
	
		$cli	= $_POST['cli'];
		$fecha	= $_POST['fecha'];
		$nrobl	= $_POST['nrobl'];
		$feson	= $_POST['feson'];
		$fechaf	= $_POST['fechaf'];
		$destino= $_POST['destino'];

		$fechallega	= $_POST['fechallega'];
		$fechellegai= $_POST['fechellegai'];
		$fechellegaf= $_POST['fechellegaf'];
	
		$busqueda = " true ";
		
		if(strlen($cli)!=0)
			$busqueda.= " and ordenes.cod_cli like '%".$cli."%' ";
	
		if(strlen($nrobl)!=0)
			$busqueda.= " and embarques.num_bl = '".$nrobl."' ";
	
		if($destino!="***")
			$busqueda.= " and ordenes.destino = '".$destino."' ";
			
		if($feson=="S"){
			$busqueda.= " and embarques.fe_emb BETWEEN '".$fecha."' AND  '".$fechaf."' ";
		}	

		if($fechallega=="S"){
			$busqueda.= " and embarques.fe_llegada_emb BETWEEN '".$fechellegai."' AND  '".$fechellegaf."' ";
		}		

		#BUSCO!
		$sqlc = " select * from embarques
				inner join ordenes  on ordenes.cod_ord = embarques.cod_ord
				inner join clientes on ordenes.cod_cli = clientes.cod_cli where ".$busqueda." order by ordenes.cod_ord DESC ";
							
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
			#$datos[$X]['num_unico'] 	= trim($imprime['num_unico']);
			#$datos[$X]['fe_alt_ord'] 	= trim($imprime['fe_alt_ord']);
			$datos[$X]['codigo']		= trim($imprime['num_unico'])."/".substr((trim($imprime['fe_alt_ord'])),0,4);
			
			$datos[$X]['num_bl'] 		= trim($imprime['num_bl']);
			$datos[$X]['fe_emb'] 		= ordenofecha(trim($imprime['fe_emb']));
			$datos[$X]['fe_inst_emb'] 	= ordenofecha(trim($imprime['fe_inst_emb']));
			$datos[$X]['fe_llegada_emb']= ordenofecha(trim($imprime['fe_llegada_emb']));
			$datos[$X]['estado_emb'] 	= trim($imprime['estado_emb']);

			$X++;		
		}
		//Genero el excel
		header("Content-type: application/vnd.ms-excel");
 		header("Content-Disposition:  filename=Cheques_al_dia:_".date('d-m-Y_His').".xls");
	
		$titulo = "<tr><td>NUMERO ORDEN DE COMPRA</td>
						<td>NUMERO DE BL</td>
						<td>FECHA EMBARQUE</td>
						<td>INSTRUCCIONES DE EMBARQUE</td>
						<td>FECHA LLEGADA</td>
						<td>ESTADO</td></tr>";
				
		echo "<table border=1>";
		echo $titulo;
		
		foreach($datos as $fila){
			echo "<tr><td>$fila[codigo]</td>
					  <td>$fila[num_bl]</td>
					  <td>$fila[fe_emb]</td>
					  <td>$fila[fe_inst_emb]</td>
					  <td>$fila[fe_llegada_emb]</td>
					  <td>$fila[estado_emb]</td>
					  </tr>";
					  						  					  						
		}//FIn foreach
		echo "</table>"; 					
		exit();		
	}#Fin genero excel
	
	if($_POST['BTNBusco']){
		header("Location: ordenes.bus.php"); 
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
			<th colspan="4"> RESULTADO BUSQUEDA EMBARQUES</th>
			<th>&nbsp;</th>
		  </tr>
		<tr>
			<th>CODIGO</th>
			<th>CLIENTE</th>
			<th>EMPRESA</th>
			<th>FECHA EMBARQUE</th>
			<th></th>
		</tr>
		</thead>
		<tbody>
        <?php 
		if($cantidad>0){ 
		#Genero los botones por si quiere hacer un listado
		 ?>		
      
			<input name="cli"  id="cli"  value="<?php echo $cli; ?>" type="hidden">
            <input name="fecha"  id="fecha"  value="<?php echo $fecha; ?>" type="hidden">
            <input name="nrobl"  id="nrobl"  value="<?php echo $nrobl; ?>" type="hidden">
            
            <input name="feson"  id="feson"  value="<?php echo $feson; ?>" type="hidden">
            <input name="fechaf"  id="fechaf"  value="<?php echo $fechaf; ?>" type="hidden">
            <input name="destino"  id="destino"  value="<?php echo $destino; ?>" type="hidden">
            
            <input name="fechallega"  id="fechallega"  value="<?php echo $fechallega; ?>" type="hidden">
            <input name="fechellegai"  id="fechellegai"  value="<?php echo $fechellegai; ?>" type="hidden">
            <input name="fechellegaf"  id="fechellegaf"  value="<?php echo $fechellegaf; ?>" type="hidden">

         <?php 
		 	#Muestro el listado            
			while ($arr = mysqli_fetch_array($rc))			
			{		
		 ?>
		<tr>
			<td><?php echo	$num_unico	 = trim($arr['num_unico'])."/".substr((trim($arr['fe_alt_ord'])),0,4);?></td>
			<td><?php 
					$ape_cli = trim($arr['ape_cli']);
					$nom_cli = trim($arr['nom_cli']);
					echo $ape_cli." ".$nom_cli;				
				?></td>
			<td><?php echo $destino  = trim($arr['destino']);?></td>
			<td><?php echo $fe_emb = date("d-m-Y", strtotime($arr['fe_emb'])); ?></td>
            <td>
            <a href="<?php $cod_ord  = trim($arr['cod_ord']);
			echo "../veoordenes.php?cod=".$cod_ord; ?>"><input name="BTNir" type="button" class="button" id="BTNir" value=" VER "></a></td>
		</tr>
        <?php 
			}
		}else{
		?>	
		<tr>
		  <td colspan="5"><br>
                        <br>
                        <br>
                        <div align="center">NO SE ENCONTRO RESULTADO</div><br>
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
        	echo "<a href='resuemba.php?pagina=".($pagina-1)."'>Anterior</a>";
        }
            for ($i=1;$i<=$total_paginas;$i++){
            	if($pagina == $i){
                	echo "<b> ".$pagina."</b>";
                }else{
                	echo " <a href=resuemba.php?pagina=$i>$i</a>";
                }
            }
            if(($pagina + 1) <= $total_paginas){
            	 echo " <a href='resuemba.php?pagina=".($pagina+1)."'>Siguiente</a>";
            }
     ?>
	</div>
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
