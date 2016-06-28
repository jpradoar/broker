<?php
require_once("funciones.inc.php");
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

	$nom 		= $_GET['nom'];
	$codba		= $_GET['codba'];
	$feson		= $_GET['feson'];
	$fecha		= $_GET['fecha'];
	$fechaf		= $_GET['fechaf'];
	
	$busqueda = " true ";
	
	if(strlen($nom)!=0)
		$busqueda.= " and nom_ele_cot like '%".$nom."%' ";

	if(strlen($codba)!=0)
		$busqueda.= " and cod_ele_ba = '".$codba."' ";

	if($feson=="S"){
		$busqueda.= " and fe_cot_cli BETWEEN '".$fecha."' AND  '".$fechaf."' ";
	}	
		

	$sqla = "select count(*) as canti from cotizacliente INNER JOIN elementoscot ON cotizacliente.cod_ele_cot = elementoscot.cod_ele_cot where ".$busqueda." ";		
   // echo $sqla; exit();
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
		$sqlc = " select * from cotizacliente INNER JOIN elementoscot ON cotizacliente.cod_ele_cot = elementoscot.cod_ele_cot where ".$busqueda." order by nom_ele_cot DESC ";	
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
	if($_POST['BTNBusco']){
		header("Location: buscocotizacli.php"); 
		exit;	
	}

	if($_POST['BTNvolver']){
		header("Location: index.php"); 
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
	<link rel="stylesheet" href="css/style.css">
    
    <link rel="stylesheet" type="text/css" href="css/slimmenu.css">
   	<script src="js/jquery.min.js"></script>
    
 </head>
<body>
	<div class="logo">BHI - BROKERS</div>
	<div id="page-wrap"> 
    
    <?php include 'menu.php'; ?>
    <form id="form1" name="form1" method="post">
 
	<p>USUARIO: <?php echo $Xnombre; ?></p>
    <table class="sombra">
		<thead>
		<tr>
			<th colspan="3"> RESULTADO COTIZACIONES</th>
			<th>&nbsp;</th>
		  </tr>
		<tr>
			<th>NOMBRE</th>
			<th>CODIGO EN BS AS</th>
			<th>FECHA</th>
			<th></th>
		</tr>
		</thead>
		<tbody>
        <?php 
		if($cantidad>0){   
			while ($arr = mysqli_fetch_array($rc))			
			{		
		 ?>
		<tr>
			<td><?php echo $nom_ele_cot  = trim($arr['nom_ele_cot']);?></td>
			<td><?php echo $cod_ele_ba   = trim($arr['cod_ele_ba']);?></td>
			<td><?php echo $fe_cot   = trim($arr['fe_cot']);?></td>
            <td>
            <a href="<?php $cod_ele_cot  = trim($arr['cod_ele_cot']);
			echo "altacotiza.php?cod=".$cod_ele_cot; ?>"><input name="BTNir" type="button" class="button" id="BTNir" value=" VER "></a></td>
		</tr>
        <?php 
			}
		}else{
		?>	
		<tr>
		  <td colspan="4"><div align="center">NO SE ENCONTRO RESULTADO</div></td>
		  </tr>		
		<?php 	
			
			}	
 		 ?>
		<tr>
			<td colspan="4"><div align="center"><span style="color: #000">
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
        	echo "<a href='resucot.php?pagina=".($pagina-1)."'>Anterior</a>";
        }
            for ($i=1;$i<=$total_paginas;$i++){
            	if($pagina == $i){
                	echo "<b> ".$pagina."</b>";
                }else{
                	echo " <a href=resucot.php?pagina=$i>$i</a>";
                }
            }
            if(($pagina + 1) <= $total_paginas){
            	 echo " <a href='resucot.php?pagina=".($pagina+1)."'>Siguiente</a>";
            }
     ?>

     </form>
    </div>

    
<script src="js/jquery.slimmenu.js"></script>
<script src="js/jquery.easing.min.js"></script>
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
