<?php

require_once("../funciones.inc.php");
/*if (falta_logueo())
{ 
	header('location:login.php');
	exit();
}

 $Xnombre = trim(strtoupper($_SESSION['usuario']));
 
 //session_start();
*/	
 $Xnombre ="";
 session_start();
	#TRAIGO LAS FACTURAS SIN CERRAR-->
		$db  = conecto();
		$sql = " select cod_fac_ing, lugar_fac_ing, total_fac_ing, facturas_ingresantes.cod_ord, fe_a_fac_ing, ape_cli, nom_cli from facturas_ingresantes 
left join ordenes on facturas_ingresantes.cod_ord = ordenes.cod_ord 
left join clientes on ordenes.cod_cli=clientes.cod_cli  where ordenes.estado_ord != 0 and facturas_ingresantes.fe_cierre_fac = '0000-00-00 00:00:00' order by fe_a_fac_ing DESC limit 10  ";
		# echo $sql;
		$r   = mysqli_query($db, $sql);

		if ($r == false){
            mysqli_close($db);
            $error = "Error: (" . mysql_errno() . ") " . mysql_error().")";
             //gestion_errores();
         }
            mysqli_close($db);
	#FIN TRAIGO LAS FACTURAS SIN CERRAR-->

	#FIN TRAIGO LOS FACTURAS CERRADAS-->            
        $db2  = conecto();
		$sql2 =" select fe_cierre_fac, cod_fac_ing, lugar_fac_ing, total_fac_ing, facturas_ingresantes.cod_ord, fe_a_fac_ing, ape_cli, nom_cli from facturas_ingresantes 
left join ordenes on facturas_ingresantes.cod_ord = ordenes.cod_ord 
left join clientes on ordenes.cod_cli=clientes.cod_cli  where ordenes.estado_ord != 0 and facturas_ingresantes.fe_cierre_fac != '0000-00-00 00:00:00' order by fe_a_fac_ing DESC limit 10  ";
		 
		$r2   = mysqli_query($db2, $sql2);
		#echo $sql2;
		if ($r2 == false){
            mysqli_close($db2);
            $error = "Error: (" . mysql_errno() . ") " . mysql_error().")";
             //gestion_errores();
         }
            mysqli_close($db2);
	#FIN TRAIGO LOS FACTURAS CERRADAS--> 			
				
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
 
	<script type="text/javascript">
    <!--
    function popup(url) 
    {
     var width  = 1024;
     var height = 600;
     var left   = (screen.width  - width)/2;
     var top    = (screen.height - height)/2;
     var params = 'width='+width+', height='+height;
     params += ', top='+top+', left='+left;
     params += ', directories=no';
     params += ', location=no';
     params += ', menubar=no';
     params += ', resizable=no';
     params += ', scrollbars=no';
     params += ', status=no';
     params += ', toolbar=no';
     newwin=window.open(url,'windowname5', params);
     if (window.focus) {newwin.focus()}
     return false;
    }
    // -->
    </script>
   
 </head>
<body>
	<div class="logo">BHI - BROKERS</div> 
	<div id="page-wrap"> 

    <?php include 'menu.php'; ?>

	<p>USUARIO: <?php echo $Xnombre; ?></p>
    <table class="sombra">
	 <thead>
		<tr>
			<th colspan="6" >FACTURAS SIN CERRAR</th>
		</tr>
		<tr>
			<th>CODIGO DE OC</th>
			<th>CLIENTE</th>
			<th>FECHA ALTA</th>
			<th>PERTENECE</th>
			<th>MONTO</th>
			<th>Accion</th>
		</tr>
	 </thead>
	<tbody>
        <?php    
			while ($arr = mysqli_fetch_array($r))		
			{		
		 ?>
		<tr>
			<td><?php echo $cod_ord = trim($arr['cod_ord']);?></td>
			<td><?php 
					$ape_cli = trim($arr['ape_cli']);
					$nom_cli = trim($arr['nom_cli']);
					echo $ape_cli." ".$nom_cli;				
				?>
		  </td>
			<td><div style="background-color:<?php $fecha_alta = trim($arr['fe_a_fac_ing']);
														echo $color;?>"><?php echo $fecha_alta = date("d-m-Y", strtotime($fecha_alta)); ?></div></td>
            <td><?php echo $lugar = trim($arr['lugar_fac_ing']);?></td>
          <td><?php echo $total_fac_ing = trim($arr['total_fac_ing']);?></td>
			<td><a href="<?php 	$codfac = trim($arr['cod_fac_ing']);
							echo 'facingc.php?accion=MOD&cod='.$cod_ord.'&codfac='.$codfac.'&lugar='.$lugar.'&Conta=S'; ?>"><button class="button"><?php echo 'ABRIR';?></button></a>
                            
              <a href="javascript: void(0)" 
   onclick="popup('<?php 	$codfac = trim($arr['cod_fac_ing']);
							echo 'facingc.php?accion=MOD&cod='.$cod_ord.'&codfac='.$codfac.'&lugar='.$lugar.'&Conta=S'; ?>')"><button class="button"><?php echo 'VER';?></button></a>              
                            </td>
		</tr>
        <?php 
			}
 		 ?>
		</tbody>
	</table>
    <br>
    <table class="sombra">
		<thead>
		<tr>
			<th colspan="6">ULTIMAS FACTURAS CERRADAS</th>
		  </tr>
		<tr>
			<th>CODIGO DE OC</th>
			<th>CLIENTE</th>
			<th>FECHA CIERRE</th>
			<th>PERTENECE</th>
		  	<th>MONTO</th>
			<th>Accion</th>
		</tr>
		</thead>
		<tbody>
        <?php    
			while ($arr2 = mysqli_fetch_array($r2))		
			{		
		 ?>
		<tr>
			<td><?php echo $cod_ord = trim($arr2['cod_ord']);?></td>
			<td><?php 
					$ape_cli = trim($arr2['ape_cli']);
					$nom_cli = trim($arr2['nom_cli']);
					echo $ape_cli." ".$nom_cli;				
				?></td>
			<td><?php $fe_cierre_fac = trim($arr2['fe_cierre_fac']);
						echo $fe_cierre_fac2 = date("d-m-Y", strtotime($fe_cierre_fac)); ?></td>
            <td><?php echo $lugar = trim($arr2['lugar_fac_ing']);?></td>
            <td><?php echo $total_fac_ing = trim($arr2['total_fac_ing']); ?></td>
			<td><a href="<?php $cod_fac_ing = trim($arr2['cod_fac_ing']);
			echo 'facingc.php?accion=MOD&cod='.$cod_ord.'&codfac='.$cod_fac_ing.'&lugar='.$lugar.'&Conta=S'; ?>"><button class="button"><?php echo 'ABRIR';?></button></a>
            <a href="javascript: void(0)" onclick="popup('<?php $codfac = trim($arr['cod_fac_ing']);
						echo 'facingc.php?accion=MOD&cod='.$cod_ord.'&codfac='.$cod_fac_ing.'&lugar='.$lugar.'&Conta=S'; ?>')"><button class="button"><?php echo 'VER';?></button></a></td>
		</tr>
        <?php 
			}
 		 ?>
		</tbody>
	</table>
    <br>
    <br>
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
