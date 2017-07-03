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

if($Xbuscar=="F"){

	$BuscoFe 	= $_GET['BuscoFe'];
	$fechaIN	= $_GET['fechaIN'];
	$LSTfeFIN	= $_GET['fechaFIN'];
	$EstFac		= $_GET['EstFac'];
	
	$busqueda = " true ";

	if($EstFac=="CE"){	
		$busqueda.= " and fe_cierre_fac != '0000-00-00 00:00:00' ";
		
		if($BuscoFe=="S"){
			$busqueda.= " and fe_cierre_fac BETWEEN '".$fechaIN."' AND  '".$LSTfeFIN."' ";
		}	
		$estado = "CERRADAS";
	}
	
	if($EstFac=="AB"){
		$busqueda.= " and fe_cierre_fac = '0000-00-00 00:00:00' ";
		
		if($BuscoFe=="S"){
			$busqueda.= " and fe_a_fac_ing BETWEEN '".$fechaIN."' AND  '".$LSTfeFIN."' ";
		}
		$estado = "ABIERTAS";			
	}

	if($EstFac=="AM"){
		
		if($BuscoFe=="S"){
			$busqueda.= " and fe_a_fac_ing BETWEEN '".$fechaIN."' AND  '".$LSTfeFIN."' ";
			$busqueda.= " OR fe_cierre_fac BETWEEN '".$fechaIN."' AND  '".$LSTfeFIN."' ";
		}			
		$estado = "ABIERTAS Y CERRADAS";	
	}
		
	$sqla = "select count(*) as canti from facturas_ingresantes where ".$busqueda." ";		
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
		$sqlc = " select * from facturas_ingresantes 
					INNER JOIN ordenes on ordenes.cod_ord = facturas_ingresantes.cod_ord
					INNER JOIN clientes on clientes.cod_cli = ordenes.cod_cli
					where ".$busqueda." 
					and ordenes.estado_ord != 0
					and tipo_fac_ing = 'F' order by fe_cierre_fac DESC ";	
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

	#---------->Excel
	if($_POST['exelr']){

		$sqlc = " select * from facturas_ingresantes 
					INNER JOIN ordenes on ordenes.cod_ord = facturas_ingresantes.cod_ord
					INNER JOIN clientes on clientes.cod_cli = ordenes.cod_cli
					where ".$busqueda." 
					and ordenes.estado_ord != 1
					and tipo_fac_ing = 'F' order by fe_cierre_fac DESC ";	
		//echo $sqlc;exit();
		$dbc  = conecto();
	 
		$rc   = mysqli_query($dbc, $sqlc);
	
		if ($rc == false){
			mysqli_close($dbc);
			$error = "Error: (" . mysql_errno() . ") " . mysql_error().")";
			//gestion_errores();
		}
			mysqli_close($dbc); 
		
		$X=0;	
		while ($imprime = mysqli_fetch_array($rc)){	
			$datos[$X]['ape_cli'] 	=  trim($imprime['ape_cli']);
			$datos[$X]['nom_cli'] 	=  trim($imprime['nom_cli']);
				
			$datos[$X]['lugar_fac_ing'] 	=  trim($imprime['lugar_fac_ing']);
			$datos[$X]['cod_ord'] 			=  trim($imprime['cod_ord']);
			$datos[$X]['fe_a_fac_ing'] 		=  trim($imprime['fe_a_fac_ing']);
			$datos[$X]['met_pag_fac_ing']	=  trim($imprime['met_pag_fac_ing']);
			$datos[$X]['banco_fac_ing'] 	=  trim($imprime['banco_fac_ing']);
				
			$datos[$X]['percep_iva_fac_ing'] =  trim($imprime['percep_iva_fac_ing']);
			$datos[$X]['ganancias_fac_ing'] =  trim($imprime['ganancias_fac_ing']);
			$datos[$X]['gravado_fac_ing'] 	=  trim($imprime['gravado_fac_ing']);
				
			$datos[$X]['iva_ins_fac_ing'] 	=  trim($imprime['iva_ins_fac_ing']);
			$datos[$X]['iva_no_ins_fac_ing'] =  trim($imprime['iva_no_ins_fac_ing']);
			$datos[$X]['nro_remito_fac_ing'] =  trim($imprime['nro_remito_fac_ing']);
			$datos[$X]['recep_iibb_fac_ing'] =  trim($imprime['recep_iibb_fac_ing']);
			$datos[$X]['no_grabado_fac_ing'] =  trim($imprime['no_grabado_fac_ing']);
			$datos[$X]['total_fac_ing'] 	=  trim($imprime['total_fac_ing']);

			$X++;
		}
			
		header("Content-type: application/vnd.ms-excel");
 		header("Content-Disposition:  filename=Facturas_".date('d-m-Y_His').".xls");
	
		echo "<table border=1>";
		
		echo "<tr><td>LISTADO DE FACTURAS EN ESTADO: $estado ENTRE FECHAS: INICIO  ".ordenofecha($fechaIN)." - FIN  ".ordenofecha($LSTfeFIN)."</td></tr>";
		
		echo "<tr><td>APELLIDOS</td><td>NOMBRES</td><td>PERTENECE</td><td>ORDEN DE COMPRA</td><td>FECHA ALTA</td><td>METODO DE PAGO</td><td>BANCO</td><td>PERCEPCION IVA INGRESOS BRUTOS</td><td>GANANCIAS</td><td>GRABADO</td><td>IVA INSCRIPTO</td><td>IVA NO INSCRIPTO</td><td>NUMERO DE REMITO</td><td>RECEPCION IIBB CAJA 3,5</td><td>NO GRABADO</td><td>TOTAL</td></tr>";
		
		foreach($datos as $fila){	
		echo 	"<tr><td>$fila[ape_cli]</td>
					 <td>$fila[nom_cli]</td>
					 <td>$fila[lugar_fac_ing]</td>
					 <td>$fila[cod_ord]</td>
					 
					 <td>$fila[fe_a_fac_ing]</td>
					 <td>$fila[met_pag_fac_ing]</td>
					 <td>$fila[banco_fac_ing]</td>
					 
					 <td>$fila[percep_iva_fac_ing]</td>
					 <td>$fila[ganancias_fac_ing]</td>
					 <td>$fila[gravado_fac_ing]</td>
					 
					 <td>$fila[iva_ins_fac_ing]</td>
					 <td>$fila[iva_no_ins_fac_ing]</td>
					 
					 <td>$fila[nro_remito_fac_ing]</td>
					 <td>$fila[recep_iibb_fac_ing]</td>
					 <td>$fila[no_grabado_fac_ing]</td>
					 <td>$fila[total_fac_ing]</td>
				</tr>";
		}
		echo "</table>"; 					
		exit();
										
	}#---------->Fin Excel
	
	if($_POST['BTNBusco']){
		header("Location: factura.bus.php"); 
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
	<title>_%%_empresanombre_%%_</title>
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
	<div class="logo">_%%_empresanombre_%%_</div> 
	<div id="page-wrap"> 
    
    <?php include 'menu.php'; ?>
     <form id="form1" name="form1" method="post">

	<p>USUARIO: <?php echo $Xnombre; ?></p>
    <table class="sombra">
      <thead>
        <tr>
          <th colspan="6" >RESULTADO DE LA BUSQUEDA DE FACTURAS </th>
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
		if($cantidad>0){   
			while ($arr = mysqli_fetch_array($rc))			
			{		
		 ?>
        <tr>
          <td><?php echo $cod_ord = trim($arr['cod_ord']);?></td>
          <td><?php 
					$ape_cli = trim($arr['ape_cli']);
					$nom_cli = trim($arr['nom_cli']);
					echo $ape_cli." ".$nom_cli;				
				?></td>
          <td><?php $fecha_alta = trim($arr['fe_cierre_fac']);
		
				if($fecha_alta=="0000-00-00 00:00:00"){
					echo "-";
				}else{
					echo $fecha_alta = date("d-m-Y", strtotime($fecha_alta));	
				}
				  ?></td>
                 
          <td><?php echo $lugar = trim($arr['lugar_fac_ing']);?></td>
          <td><?php echo $total_fac_ing = trim($arr['total_fac_ing']);?></td>
          <td><a href="<?php $codfac = trim($arr['cod_fac_ing']);
							echo 'facingc.php?accion=MOD&cod='.$cod_ord.'&codfac='.$codfac.'&lugar='.$lugar.'&Conta=S'; ?>">
            <input type="button" value="ABRIR" class="button"></a>
          
          <a href="javascript: void(0)" 
   onclick="popup('<?php $codfac = trim($arr['cod_fac_ing']);
							echo 'facingc.php?accion=MOD&cod='.$cod_ord.'&codfac='.$codfac.'&lugar='.$lugar.'&Conta=S'; ?>')"><button class="button"><?php echo 'VER';?></button></a>   
                            </td>
        </tr>
        <?php 
			}
		}else{
		?>	
		<tr>
		  <td colspan="6"><div align="center"><strong>NO SE ENCONTRO RESULTADO</strong></div></td>
	    </tr>		
		<?php 	
			
			}	
 		 ?>
		<tr>
			<td colspan="6"><div align="center"><span style="color: #000">
			  <input type="submit" name="exelr" id="exelr" class="button" value="GENERAR EXCEL">
			  <input type="submit" name="BTNBusco" id="BTNBusco" class="button" value="VOLVER BUSCAR">
			  <input type="submit" name="BTNvolver" id="BTNvolver" class="button" value="VOLVER AL MENU">
			</span></div></td>
        </tr>	  
      </tbody>
    </table>
    <br>
    <div align="center">
    <?php
    	if(($pagina - 1) > 0){
        	echo "<a href='factura.res.php?pagina=".($pagina-1)."'>Anterior</a>";
        }
            for ($i=1;$i<=$total_paginas;$i++){
            	if($pagina == $i){
                	echo "<b> ".$pagina."</b>";
                }else{
                	echo " <a href=factura.res.php?pagina=$i>$i</a>";
                }
            }
            if(($pagina + 1) <= $total_paginas){
            	 echo " <a href='factura.res.php?pagina=".($pagina+1)."'>Siguiente</a>";
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
