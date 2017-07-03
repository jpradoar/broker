<?php

require_once("funciones.inc.php");
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
	#TRAIGO LOS PRESUPUESTOS-->
	$db  = conecto();
	$sql = " select cod_presu, fecha_alta, observa_presu, ape_cli, nom_cli from presupuestos
		inner join clientes on presupuestos.cod_cli=clientes.cod_cli
		where presupuestos.estado_presu != 0
		 order by cod_presu DESC limit 5 ";
		 
	$r   = mysqli_query($db, $sql);

	if($r == false){
    	mysqli_close($db);
        $error = "Error: (" . mysql_errno() . ") " . mysql_error().")";
        //gestion_errores();
    }
        mysqli_close($db);
	#FIN TRAIGO LOS PRESUPUESTOS-->

	#FIN TRAIGO LOS ORDENES DE COMPRA-->            
    $db2  = conecto();
	$sql2 =" select cod_ord, fe_alt_ord, observa_ord, ape_cli, nom_cli from ordenes
		inner join clientes on ordenes.cod_cli=clientes.cod_cli
		where ordenes.estado_ord != 0
		 order by cod_ord DESC limit 5 ";
		 
	$r2   = mysqli_query($db2, $sql2);

	if ($r2 == false){
    	mysqli_close($db2);
        $error = "Error: (" . mysql_errno() . ") " . mysql_error().")";
        //gestion_errores();
    }
        mysqli_close($db2);
	#FIN TRAIGO LOS ORDENES DE COMPRA--> 			

/*
	#FIN TRAIGO LAS FACTURAS-->            
        $db3  = conecto();
		$sql3 =" select cod_fac, fe_fac, monto_fac, ape_cli, nom_cli from facturas
		inner join clientes on facturas.cod_cli=clientes.cod_cli
		 order by cod_ord DESC limit 5 ";
		 
		$r3   = mysqli_query($db3, $sql3);

		if ($r3 == false){
            mysqli_close($db3);
            $error = "Error: (" . mysql_errno() . ") " . mysql_error().")";
             //gestion_errores();
         }
            mysqli_close($db3);
	#FIN TRAIGO  LAS FACTURAS--> 
*/					
?>
<!DOCTYPE html>
<html>
 <head>
	<meta charset='iso-8859-1'>
	<title>_%%_empresanombre_%%_</title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="css/style.css">
    
    <link rel="stylesheet" type="text/css" href="css/slimmenu.css">
   	<script src="js/jquery.min.js"></script>
    
 </head>
<body>
	<div class="logo">_%%_empresanombre_%%_</div> 
	<div id="page-wrap"> 
    
    <?php include 'menu.php'; ?>

	<p>USUARIO: <?php echo $Xnombre; ?></p>
    <table class="sombra">
		<thead>
		<tr>
			<th colspan="5" >ULTIMOS PRESUPUESTOS CARGADOS</th>
		  </tr>
		<tr>
			<th>NUMERO</th>
			<th>CLIENTE</th>
			<th>FECHA ALTA</th>
			<th>OBSERVACIONES</th>
			<th>ACCION</th>
		</tr>
		</thead>
		<tbody>
        <?php    
			while ($arr = mysqli_fetch_array($r))		
			{		
		 ?>
		<tr>
			<td><?php echo "P".$num_presu = trim($arr['cod_presu']);?></td>
			<td><?php 
					$ape_cli = trim($arr['ape_cli']);
					$nom_cli = trim($arr['nom_cli']);
					echo $ape_cli." ".$nom_cli;				
				?>
		  </td>
				<td><div style="background-color:<?php $fecha_alta = trim($arr['fecha_alta']);
														echo $color;?>"><?php echo $fecha_alta = date("d-m-Y", strtotime($fecha_alta)); ?></div></td>
            <td><?php 
            			echo $observa_presu = trim($arr['observa_presu']);	
            	?></td>
			<td><a href="<?php 	echo 'nuevopresu.php?cod='.$num_presu; ?>"><button class="button"><?php 
								echo 'Ver';
							?></button></a></td>
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
			<th colspan="5">ULTIMAS ORDENES DE COMPRA CARGADAS</th>
		  </tr>
		<tr>
			<th>NUMERO</th>
			<th>CLIENTE</th>
			<th>FECHA ALTA</th>
			<th>OBSERVACIONES</th>
			<th>ACCION</th>
		</tr>
		</thead>
		<tbody>
        <?php    
			while ($arr2 = mysqli_fetch_array($r2))		
			{		
		 ?>
		<tr>
			<td><?php echo $num_presu = trim($arr2['cod_ord']);?></td>
			<td><?php 
					$ape_cli = trim($arr2['ape_cli']);
					$nom_cli = trim($arr2['nom_cli']);
					echo $ape_cli." ".$nom_cli;				
				?>
		  </td>
				<td><div style="background-color:<?php echo $color;?>"><?php  $fecha_alta_ord = trim($arr2['fe_alt_ord']);
				echo date("d-m-Y ", strtotime($fecha_alta_ord)); ?></div></td>
            <td><?php 
            			echo $observa_presu = trim($arr['observa_ord']);	
            	?></td>
			<td><a href="<?php 	echo 'veoordenes.php?cod='.$num_presu; ?>"><button class="button"><?php 
								echo 'Ver';
							?></button></a></td>
		</tr>
        <?php 
			}
 		 ?>
		</tbody>
	</table>
    <br><!--
    <table class="sombra">
      <thead>
        <tr>
          <th colspan="5">ULTIMAS FACTURAS CARGADAS</th>
        </tr>
        <tr>
          <th>NUMERO</th>
          <th>CLIENTE</th>
          <th>FECHA ALTA</th>
          <th>MONTO</th>
          <th>Accion</th>
        </tr>
      </thead>
      <tbody>
        <?php    
			#while ($arr3 = mysqli_fetch_array($r3))		
			#{		
		 ?>
        <tr>
          <td><?php #echo $cod_fac = trim($arr3['cod_fac']);?></td>
          <td><?php 
					#$ape_cli = trim($arr3['ape_cli']);
					#$nom_cli = trim($arr3['nom_cli']);
					#echo $ape_cli." ".$nom_cli;				
				?></td>
          <td><div style="background-color:<?php # echo $color;?>"><?php  #$fecha_alta =  trim($arr3['fe_fac']);
		# echo date("d-m-Y", strtotime($fecha_alta)); ?></div></td>
          <td><?php 
            		#	echo $monto_fac = trim($arr3['monto_fac']);	
            	?></td>
          <td><a href="<?php #	echo 'veofac.php?cod='.$cod_fac; ?>">
            <button class="button">
              <?php 
				#				echo 'Ver';
							?>
          </button>
          </a></td>
        </tr>
        <?php 
		#	}
 		 ?>
      </tbody>
    </table>
    -->
    <br>
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
