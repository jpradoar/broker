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

	$fecha	= $_GET['fecha'];
	$empre	= $_GET['empre'];
	$feson	= $_GET['feson'];
	$fechaf	= $_GET['fechaf'];
	
	$busqueda = " true ";

	if(strlen($empre)!="***")
		$busqueda.= " and destino = '".$empre."' ";
		
	if($feson=="S"){
		$busqueda.= " and fe_prim_ch BETWEEN '".$fecha."' AND  '".$fechaf."' ";
	}	
		

	$sqla = "select count(*) as canti from adelantochina inner join ordenes on adelantochina.cod_ord = ordenes.cod_ord where ".$busqueda." and tipo_ch = 'G' ";		
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
		$sqlc = " select * from adelantochina inner join ordenes on adelantochina.cod_ord = ordenes.cod_ord  where ".$busqueda." and tipo_ch = 'G' order by ordenes.cod_ord  DESC ";	
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
	
		$fecha	= $_POST['fecha'];
		$empre	= $_POST['empre'];
		$feson	= $_POST['feson'];
		$fechaf	= $_POST['fechaf'];
		
		$busqueda = " true ";
	
		if(strlen($empre)!="***")
			$busqueda.= " and destino = '".$empre."' ";
			
		if($feson=="S"){
			$busqueda.= " and fe_prim_ch BETWEEN '".$fecha."' AND  '".$fechaf."' ";
		}		
		
		#BUSCO!
		$sqlc = " select * from adelantochina inner join ordenes on adelantochina.cod_ord = ordenes.cod_ord  where ".$busqueda." and tipo_ch = 'G' order by ordenes.cod_ord  DESC ";	
							
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
			#$datos[$X]['num_unico'] 	= trim($imprime['num_unico']);
			#$datos[$X]['fe_alt_ord'] 	= trim($imprime['fe_alt_ord']);
			$datos[$X]['codigo']	 = trim($imprime['num_unico'])."/".substr((trim($imprime['fe_alt_ord'])),0,4);
			
			$datos[$X]['fe_prim_ch'] = ordenofecha(trim($imprime['fe_prim_ch']));
			$datos[$X]['monto_ch'] 	 = trim($imprime['monto_ch']);
			$datos[$X]['destino'] 	 = trim($imprime['destino']);
			
			$X++;		
		}
		//Genero el excel
		header("Content-type: application/vnd.ms-excel");
 		header("Content-Disposition:  filename=Giros_al_dia:_".date('d-m-Y_His').".xls");
	
		$titulo = "<tr><td>NUMERO ORDEN DE COMPRA</td><td>FECHA AD. A CHINA</td><td>MONTO</td><td>EMPRESA</td></tr>";
				
		echo "<table border=1>";
		echo $titulo;
		
		foreach($datos as $fila){
			
			echo "<tr><td>$fila[codigo]</td><td>$fila[fe_prim_ch]</td><td>$fila[destino]</td><td>$fila[monto_ch]</td></tr>";
					  						  					  	
		}//FIn foreach
		
		echo "</table>"; 					
		exit();
	}#Fin genero excel
	
	if($_POST['BTNBusco']){
		header("Location: giros.bus.php"); 
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
			<th colspan="2"> RESULTADO GIROS A CHINA</th>
			<th>&nbsp;</th>
		  </tr>
		<tr>
			<th>CODIGO O.C.</th>
			<th>FECHA DEL GIRO</th>
			<th></th>
		</tr>
		</thead>
		<tbody>
        <?php 
		if($cantidad>0){   
		#Genero los botones por si quiere hacer un listado
		 ?>	
 	
			<input name="fecha"  id="fecha"  value="<?php echo $fecha; ?>" type="hidden">
            <input name="empre"  id="empre"  value="<?php echo $empre; ?>" type="hidden">
            <input name="feson"  id="feson"  value="<?php echo $feson; ?>" type="hidden">  
            <input name="fechaf"  id="fechaf"  value="<?php echo $fechaf; ?>" type="hidden">

         <?php 
		 	#Muestro el listado  
			while ($arr = mysqli_fetch_array($rc))			
			{									
		 ?>
		<tr>
			<td><?php echo	$num_unico	 = trim($arr['num_unico'])."/".substr((trim($arr['fe_alt_ord'])),0,4);?></td>
			<td><?php echo ordenofecha($arr['fe_prim_ch']); ?></td>
			<td>
            <a href="<?php $cod_ord  = trim($arr['cod_ord']);
			echo "../veoordenes.php?cod=".$cod_ord; ?>"><input name="BTNir" type="button" class="button" id="BTNir" value=" VER "></a></td>
		</tr>
        <?php 
			}
		}else{
		?>	
		<tr>
		  <td colspan="3"><br>
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
			<td colspan="3"><div align="center"><span style="color: #000">
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
        	echo "<a href='resugiro.php?pagina=".($pagina-1)."'>Anterior</a>";
        }
            for ($i=1;$i<=$total_paginas;$i++){
            	if($pagina == $i){
                	echo "<b> ".$pagina."</b>";
                }else{
                	echo " <a href=resugiro.php?pagina=$i>$i</a>";
                }
            }
            if(($pagina + 1) <= $total_paginas){
            	 echo " <a href='resugiro.php?pagina=".($pagina+1)."'>Siguiente</a>";
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
