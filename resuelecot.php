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
	$codiba		= $_GET['codiba'];
	$codch		= $_GET['codch'];

	
	$busqueda = " true ";
	
	if(strlen($nom)!=0)
		$busqueda.= " and nom_ele_cot like '%".$nom."%' ";

	if(strlen($codiba)!=0)
		$busqueda.= " and cod_ele_ba = '".$codiba."' ";

	if(strlen($codch)!=0)
		$busqueda.= " and cod_ele_ch = '".$codch."' ";
		
		

	$sqla = "select count(*) as canti from elementoscot where ".$busqueda." ";		
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
	 
	if($canti>0){//Si encontro algo		
		$sqlc = " select * from elementoscot where ".$busqueda." order by nom_ele_cot DESC ";	
		//echo $sqlC;
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
			<th colspan="3">ARTICULOS COTIZACION</th>
			<th><a href="altacotiza.php"> <input name="BTNnuevo" type="button" class="button" id="BTNnuevo" value="NUEVO"></a></th>
		  </tr>
		<tr>
			<th>NOMBRE</th>
			<th>CODIGO EN BS AS</th>
			<th>CODIGO EN CHINA</th>
			<th></th>
		</tr>
		</thead>
		<tbody>
        <?php    
			while ($arr = mysqli_fetch_array($rc))			
			{		
		 ?>
		<tr>
			<td><?php echo $nom_ele_cot  = trim($arr['nom_ele_cot']);?></td>
			<td><?php echo $cod_ele_ba   = trim($arr['cod_ele_ba']);?></td>
			<td><?php echo $cod_ele_ch   = trim($arr['cod_ele_ch']);?></td>
            <td>
            <a href="<?php $cod_ele_cot  = trim($arr['cod_ele_cot']);
			echo "altacotiza.php?cod=".$cod_ele_cot; ?>"><input name="BTNir" type="button" class="button" id="BTNir" value=" VER "></a></td>
		</tr>
        <?php 
			}
 		 ?>
		</tbody>
	</table>
    <br>
    <br>
    <div align="center">
    <?php
    	if(($pagina - 1) > 0){
        	echo "<a href='veoelecotiza.php?pagina=".($pagina-1)."'>Anterior</a>";
        }
            for ($i=1;$i<=$total_paginas;$i++){
            	if($pagina == $i){
                	echo "<b> ".$pagina."</b>";
                }else{
                	echo " <a href=veoelecotiza.php?pagina=$i>$i</a>";
                }
            }
            if(($pagina + 1) <= $total_paginas){
            	 echo " <a href='veoelecotiza.php?pagina=".($pagina+1)."'>Siguiente</a>";
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
