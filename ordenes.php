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

 $criterio = " true ";
 $TAMANO_PAGINA = 20;
 
 /// cuento total para la paginacion ...
 $pagina = $_GET['pagina'];
                              
 if (!$pagina){
 
 	$sqla = "select count(*) as canti from ordenes where $criterio ";
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
      // fin de la contada!!
                                              
     $_SESSION['canti'] = $cantidad;
     $inicio = 0;
     $pagina = 1;
     }
    else
    {
     $cantidad = $_SESSION['canti'];
     $inicio = ($pagina-1) * $TAMANO_PAGINA;
    }
 
                                            
   //
 
 
  // realizo la consulta....
    $criterio.=" order by fe_alt_ord DESC LIMIT ".$TAMANO_PAGINA." OFFSET ".$inicio." ";
 	$sqlc = "select * from ordenes INNER JOIN clientes ON ordenes.cod_cli = clientes.cod_cli where $criterio ";
  	$total_paginas = ceil($cantidad/$TAMANO_PAGINA);
    $dbc  = conecto();
 
	$rc   = mysqli_query($dbc, $sqlc);

	if ($rc == false){
    	mysqli_close($dbc);
        $error = "Error: (" . mysql_errno() . ") " . mysql_error().")";
       //gestion_errores();
    }
    	mysqli_close($dbc)

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

	<p>USUARIO: <?php echo $Xnombre; ?></p>
    <table class="sombra">
		<thead>
		<tr>
			<th colspan="3"><p>ULTIMAS ORDENES DE COMPRA CARGADAS</p></th>
			<th></th>
            <th>&nbsp;</th>
		  </tr>
		<tr>
			<th>NUMERO</th>
			<th>CLIENTE</th>
			<th>FECHA CONTRATO</th>
			<th>OBSERVACIONES</th>
            <th>ACCION</th>
		</tr>
		</thead>
		<tbody>
        <?php    
			while ($arr = mysqli_fetch_array($rc))		
			{		
		 ?>
		<tr>
			<td><?php echo $num_ord = trim($arr['cod_ord']);?></td>
			<td><?php 
					$ape_cli = trim($arr['ape_cli']);
					$nom_cli = trim($arr['nom_cli']);
					echo $ape_cli." ".$nom_cli;				
				?>
				</td>
				<td><div style="background-color:<?php echo $color;?>"><?php echo $fecha_alta = date("d-m-Y  H:i:s", strtotime($arr['fe_alt_ord'])); ?></div></td>
            <td><?php 
            			echo $observa_ord = trim($arr['observa_ord']);	
            	?></td>
			<td><a href="<?php 	echo 'veoordenes.php?cod='.$num_ord; ?>"><button class="button"><?php 
								echo 'Ver';
							?></button></a></td>
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
        	echo "<a href='ordenes.php?pagina=".($pagina-1)."'>Anterior</a>";
        }
            for ($i=1;$i<=$total_paginas;$i++){
            	if($pagina == $i){
                	echo "<b> ".$pagina."</b>";
                }else{
                	echo " <a href=ordenes.php?pagina=$i>$i</a>";
                }
            }
            if(($pagina + 1) <= $total_paginas){
            	 echo " <a href='ordenes.php?pagina=".($pagina+1)."'>Siguiente</a>";
            }
     ?>
     </div>
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
