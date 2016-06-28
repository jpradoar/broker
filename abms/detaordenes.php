<?php
require_once("../funciones.inc.php");
/*
if (falta_logueo())
{ 
	header('location:login.php');
	exit();
}
	if(strlen($cod)==0){header ('location:index.php');exit();}#SI llegaron por error
	
 $Xnombre = trim(strtoupper($_SESSION['usuario']));
 */
 $Xnombre ="";
 session_start();


///////////////////////////// SI ELIMINO UN DETALLE /////////////////////////////			
	$accion	= trim($_GET['accion']);
	$coddet	= trim($_GET['coddet']);
	
	if($accion == "ELI"){//si borro un detalle..
	 
		$db8  = conecto();
		$sql8 = "delete from elementosord where cod_eleord = ".$coddet." ";
		$r8   = mysqli_query($db8, $sql8);
	
		if ($r8 == false){
	          mysqli_close($db8);
	          //$error = "Error: (" . mysql_errno() . ") " . mysql_error().")";
	          gestion_errores();
	    }
	    	  mysqli_close($db8);	
	}
///////////////////////////// FIN SI ELIMINO UN DETALLE /////////////////////////////
	
if($_POST){//SEGUNDOS POST
	
	$cod = $_GET['cod'];
	$Xerror = "";

	if($_POST['bt_plus_plus']){
		$Xerror_num 	= "";
		
		$TXTelem_plus		 = trim($_POST['TXTelem_plus']);
		$TXTanota_ord		 = trim($_POST['TXTanota_ord']);
		$TXTprecio_plus 	 = trim($_POST['TXTprecio_plus']);
		$TXTpreciochina_plus = trim($_POST['TXTpreciochina_plus']); 
		$TXTcantidad_plus	 = trim($_POST['TXTcantidad_plus']);
		
		$todo_ok = true;
		

		if(!is_numeric($TXTprecio_plus)){
			$todo_ok = false;
			$Xerror_num.= " PRECIO U$S";	
		}

		if(!is_numeric($TXTpreciochina_plus)){
			$todo_ok = false;
			$Xerror_num.= " PRECIO CHINA";	
		}

		if(!is_numeric($TXTcantidad_plus)){
			$todo_ok = false;
			$Xerror_num.= " CANTIDAD ";	
		}

		if(($TXTcantidad_plus=="0")||($TXTcantidad_plus=="00")||($TXTcantidad_plus=="000")){
			$todo_ok = false;
			$Xerror= " DEBE AGREGAR UNA CANTIDAD VALIDA ";	
		}

		if(strlen($Xerror_num)!=0){
			$Xerror_num.= " DEBE/DEBEN SER NUMERICO/NUMERICOS ";
		}
						
		if($todo_ok == true){							
			$db1  = conecto();
			$sql1 = " INSERT INTO elementosord (cod_ord, des_ord, anota_ord, precio_ba_ord, precio_china_ord, canti_ord ) VALUES ('".$cod."','".$TXTelem_plus."','".$TXTanota_ord."','".$TXTprecio_plus."','".$TXTpreciochina_plus."','".$TXTcantidad_plus."') ";
			//echo $sql1; exit();
			$r1   = mysqli_query($db1, $sql1);
	
			if ($r1 == false){
				mysqli_close($db1);
				$error = "Error: (" . mysql_errno() . ") " . mysql_error().")";
				//gestion_errores();
			}
				mysqli_close($db1);
			
			#SE AGREGO NUEVO ELEMENTO	
					
			echo "<script language='javascript'>alert('El Registro a sido Agregado');
					window.location.href='detaordenes.php?cod=$cod'; </script>"; 
		}
		/*else{
			echo "<script language='javascript'>alert('ERROR VERIFIQUE LOS CAMPOS NUMERICOS');
					window.location.href='detaordenes.php?cod=$cod'; </script>"; 	
		}*/
	}

	if($_POST['BTNvolver']){//volver al menu
 		header ('location:../veoordenes.php?cod='.$cod);
		exit();		
	}	
				
}
//else{
	
	$Xerror 	= "";
	$Xerror_num = "";
	$cod 	= $_GET['cod'];
	
	//$cod = 14;	
	if(strlen($cod)!=0){#SI ES ELIMINAR O MODIFICAR	

		#DETALLE - ORDENES
		$db  = conecto();
		$sql = " select * from elementosord where cod_ord = '".$cod."' ";
		$r   = mysqli_query($db, $sql);
	
		if ($r == false){
	    	mysqli_close($db);
	        $error = "Error: (" . mysql_errno() . ") " . mysql_error().")";
	        //gestion_errores();
	    }
	    	mysqli_close($db);
		#FIN DETALLE - ORDENES
									
	}#FIN SI ES ELIMINAR O MODIFICAR
	
//}
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

	<!-- AUTOCOMPLETAR -->
    <link rel="stylesheet" href="../development/themes/base/jquery.ui.all.css">
    <script src="../development/jquery-1.7.2.js"></script>
    <script src="../development/ui/jquery.ui.core.js"></script>
    <script src="../development/ui/jquery.ui.widget.js"></script>
    <script src="../development/ui/jquery.ui.button.js"></script>
    <script src="../development/ui/jquery.ui.position.js"></script>
    <script src="../development/ui/jquery.ui.autocomplete.js"></script>
    <link rel="stylesheet"  type="text/css" href="../css/menues.css">
    <script src="../js/menues.js"></script>
    <!-- AUTOCOMPLETAR -->
    
 </head>
<body>
	<div id="page-wrap"> 
 <form action="" method="post" name="form1" >   
    <?php include 'menu.php'; ?>

    <div class="caption">BHI - BROKERS.</div> 
	<p>USUARIO: <?php echo $Xnombre; ?></p>
	<table class="sombra">
      <thead>
	          <tr>
	            <th align="center" colspan="6"><h3><div align="center"><strong>DETALLE DE LA ORDEN DE COMPRA</strong></div></h3></th>
	            </tr>
	          </thead>
	        <tbody>
	          <tr>
	            <td colspan="6"><div align="center"><strong>Numero: <?php echo $cod; ?></strong></div></td>
	            </tr>
	          <tr>
	            <td colspan="6"><?php echo '<div align="center" style="color:red; font-weight: bold;">'.$Xerror." ".$Xerror_num.'</div>'; ?></td>
	            </tr>
	          <tr>
	            <td colspan="6"><div align="center"><span style="color: #000"><strong>DETALLE</strong></span></div></td>
	            </tr>
	          <tr>
	           
	                <tr>
	                  <td width="250"><strong>ELEMENTOS DE LA ORDEN</strong></td>
	                  <td width="226"><strong>DESCRIPCION</strong></td>
	                  <td width="145"><strong>PRECIO(U$S)</strong></td>
	                  <td width="176"><strong>PRECIO CHINA</strong></td>
	                  <td width="76"><strong>CANTIDAD</strong></td>
	                  <td width="74">&nbsp;</td>
	                  </tr>
                      <?php 
					  	#$Xtotal_precio_ba =0;
						#$Xtotal_precio_ch =0;
						
						$subtotal1 	 =0;
						$total1		 =0;
						$subtotal2	 =0;
						$total2		 =0;
						$total3 	 =0;	
					  	while ($arr = mysqli_fetch_array($r))		
						{
							$Xcod_eleord 		= trim($arr['cod_eleord']);
							$Xdes_ord 			= trim($arr['des_ord']);
							$Xanota_ord 		= trim($arr['anota_ord']);
							$Xprecio_ba_ord 	= trim($arr['precio_ba_ord']);
							$Xprecio_china_ord	= trim($arr['precio_china_ord']);
							$Xcanti_ord			= trim($arr['canti_ord']);
					  	#Incremento los valores para saber los totales
						/*$Xtotal_precio_uni_ba = $Xtotal_precio_uni_ba + $Xanota_ord; 
						$Xtotal_precio_ba = $Xtotal_precio_ba + $Xprecio_ba_ord;
						$Xtotal_precio_ch = $Xtotal_precio_ch + $Xprecio_china_ord;	
						*/
						$subtotal1 = $Xprecio_ba_ord*$Xcanti_ord;
						$total1 = $total1 + $subtotal1;
						$subtotal2 = $Xprecio_china_ord*$Xcanti_ord;
						$total2 = $total2 + $subtotal2;
						$total3 = $total3 + $Xcanti_ord;

				echo "<tr>
						<td>$Xdes_ord</td>
	                    <td>$Xanota_ord</td>
	                    <td>$Xprecio_ba_ord</td>
	                    <td>$Xprecio_china_ord</td>
	                    <td>$Xcanti_ord</td>
	                    <td><a href=\"detaordenes.php?coddet=$Xcod_eleord&accion=ELI&cod=$cod\"><input type=\"button\" class=\"bt_del\" value=\"-\"/></a></td>
				  	</tr>";
				  											

						if(strlen($Xcod_eleord)==0){$Xcod_eleord = "";}
						if(strlen($Xdes_ord)==0){$Xdes_ord = "";}
						if(strlen($Xanota_ord)==0){$Xanota_ord = "";}
						if(strlen($Xprecio_ba_ord)==0){$Xprecio_ba_ord = "";}
						if(strlen($Xprecio_china_ord)==0){$Xprecio_china_ord = "";}
						if(strlen($Xcanti_ord)==0){$Xcanti_ord = "";}						  
						}   
					  ?>
					<tr>
	                    <td><input  type="text"  name="TXTelem_plus"  id="TXTelem_plus" size="30" maxlength="250" class="button"/></td>
	                    <td><input type="text" name="TXTanota_ord" id="TXTanota_ord"  size="6" maxlength="250" class="button"></td>
	                    <td><input type="text" name="TXTprecio_plus"  id="TXTprecio_plus" size="6" maxlength="11" class="button"></td>
	                    <td><input type="text" name="TXTpreciochina_plus" id="TXTpreciochina_plus" size="6" maxlength="11" class="button"></td>
	                    <td><input name="TXTcantidad_plus" type="text" id="TXTcantidad_plus"  value="" size="6" maxlength="11" class="button"></td>
	                    <td><input class="bt_plus_plus" id="bt_plus_plus" name="bt_plus_plus" type="submit" value=" + " /> </td>		   	   
			  		</tr>                    
                    <tr>
	                    <td>&nbsp;</td>
	                    <td>&nbsp;</td>
	                    <td>&nbsp;</td>
	                    <td>&nbsp;</td>
	                    <td>&nbsp;</td>
	                    <td>&nbsp;</td>
                    </tr>
                    <tr>                      
	                  <td><strong>TOTALES</strong></td>
	                  <td><?php echo $total1;	 ?></td>
	                  <td><?php echo $total2;	 ?></td>
	                  <td><?php echo $total3;	 ?></td>
	                  <td>&nbsp;</td>
	                  <td><strong>U$S.</strong></td>
	                  </tr>
	                
	          <tr>
	            <td colspan="6"><div align="center"><span style="color: #000">
	              </span><span style="color: #000">
	              <input type="submit" name="BTNvolver" id="BTNvolver" class="button" value="Volver Al Menu">
                </span></div></td>
	            </tr>
	          </tbody>
	        </table>
	      <span style="color: #000"></span></td>

 </form>
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
