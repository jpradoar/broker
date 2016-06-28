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

	$nrocominv	= $_GET['nrocominv'];
	$destino	= $_GET['destino'];
	
	$busqueda 	= " true ";
	
	if(strlen($nrocominv)!=0)
		$busqueda.= " and comercialinvoice.num_com_inv = '".$nrocominv."' ";

	if($destino!="***")
		$busqueda.= " and ordenes.destino = '".$destino."' ";
		

	$sqla = "select count(*) as canti  from comercialinvoice
				inner join ordenes  on ordenes.cod_ord = comercialinvoice.cod_ord
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
		$sqlc = " select * from comercialinvoice
				inner join ordenes  on ordenes.cod_ord = comercialinvoice.cod_ord
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
		
		$TXTNumComImv	= strtoupper(trim($_POST['TXTNumComImv']));
		$SELFactu	 	= strtoupper(trim($_POST['SELFactu']));
		
		$busqueda = " true ";
		
		if(strlen($TXTNumComImv)!=0)
			$busqueda.= " and comercialinvoice.num_com_inv = '".$TXTNumComImv."' ";
	
		if($SELFactu!="***")
			$busqueda.= " and ordenes.destino = '".$SELFactu."' ";

		$sqlc = " select * from comercialinvoice
				inner join ordenes  on ordenes.cod_ord = comercialinvoice.cod_ord
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
			$datos[$X]['num_com_inv'] 	= trim($imprime['num_com_inv']);
			$datos[$X]['monto_com_inv'] = trim($imprime['monto_com_inv']);
			$datos[$X]['fe_fin_prod'] 	= trim($imprime['fe_fin_prod']);
			$datos[$X]['giro_com_inv'] 	= trim($imprime['giro_com_inv']);
			
			$datos[$X]['ape_cli'] 	= trim($imprime['ape_cli']);
			$datos[$X]['nom_cli'] 	= trim($imprime['nom_cli']);
			$datos[$X]['destino'] 	= trim($imprime['destino']);
			
			$X++;
		}

		//Genero el excel
		header("Content-type: application/vnd.ms-excel");
 		header("Content-Disposition:  filename=Cheques_al_dia:_".date('d-m-Y_His').".xls");
	
		$titulo = "<tr><td>NRO. COMERCIAL INVOICE</td><td>MONTO</td><td>FECHA ESTIMADA FIN PROD</td><td>GIRADO</td><td>APELLIDOS</td><td>NOMBRES</td><td>DESTINO</td></tr>";
				
		echo "<table border=1>";
		echo $titulo;
	
		foreach($datos as $fila){
			echo "<tr><td>$fila[num_com_inv]</td>
					  <td>$fila[monto_com_inv]</td>
					  <td>$fila[fe_fin_prod]</td>
					  <td>$fila[giro_com_inv]</td>
					  <td>$fila[ape_cli]</td>
					  <td>$fila[nom_cli]</td>
					  <td>$fila[destino]</td>
					  </tr>";
					  								  					 						
		}//FIn foreach
		echo "</table>"; 					
		exit();				
	}
	
	if($_POST['BTNBusco']){
		header("Location: cominv.bus.php"); 
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
	<title>BHI - Sistema Administrativo</title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="../css/style.css">
    
    <link rel="stylesheet" type="text/css" href="../css/slimmenu.css">
   	<script src="../js/jquery.min.js"></script>
    
 </head>
<body>
	<div id="page-wrap"> 
    <?php include 'menu.php'; ?>
     <form id="form1" name="form1" method="post">
    <div class="caption">BHI - BROKERS.</div> 
	<p>USUARIO: <?php echo $Xnombre; ?></p>
    <table class="sombra">
		<thead>
		<tr>
			<th colspan="3"> RESULTADO BUSQUEDA COMERCIAL INVOICE</th>
			<th>&nbsp;</th>
		  </tr>
		<tr>
			<th>CODIGO</th>
			<th>CLIENTE</th>
			<th>EMPRESA</th>
			<th></th>
		</tr>
		</thead>
		<tbody>
        <?php 
		if($cantidad>0){ 
		#Genero los botones por si quiere hacer un listado
		 ?>	 
         <input name="TXTNumComImv"  id="TXTNumComImv"  value="<?php echo $nrocominv; ?>" type="hidden">
         <input name="SELFactu"  id="SELFactu"  value="<?php echo $destino; ?>" type="hidden">
		 
		 <?php    
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
			<td>
            <a href="<?php $cod_ord  = trim($arr['cod_ord']);
			echo "veoordenes.php?cod=".$cod_ord; ?>"><input name="BTNir" type="button" class="button" id="BTNir" value=" VER "></a></td>
		</tr>
        <?php 
			}
		}else{
		?>	
		<tr>
		  <td colspan="4"><br>
                        <br>
                        <br>
                        <br>
                        <div align="center">NO SE ENCONTRO RESULTADO</div><br>
                        <br>
                        <br>
                        <br></td>
		  </tr>		
		<?php 	
			
			}	
 		 ?>
		<tr>
			<td colspan="4"><div align="center"><span style="color: #000">
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
        	echo "<a href='resuminv.php?pagina=".($pagina-1)."'>Anterior</a>";
        }
            for ($i=1;$i<=$total_paginas;$i++){
            	if($pagina == $i){
                	echo "<b> ".$pagina."</b>";
                }else{
                	echo " <a href=resuminv.php?pagina=$i>$i</a>";
                }
            }
            if(($pagina + 1) <= $total_paginas){
            	 echo " <a href='resuminv.php?pagina=".($pagina+1)."'>Siguiente</a>";
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
