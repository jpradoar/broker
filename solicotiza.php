<?php
require_once("funciones.inc.php");
/*if (falta_logueo())
{ 
	header ('location:login.php');
	exit();
}

 //SI NO ES EL ADMINISTRADOR NO TENES NADA QUE HACER ACA
 $Xusuario = $_SESSION['usuario'];
  */
  $Xnombre ="";
 session_start();
 
///////////////////////////// LISTADOS /////////////////////////////

	#TRAIGO EL NOMBRE DE LOS ARTICULOS PARA COTIZAR
	$db_Elemento  = conecto();
	$sql_Elemento = "select nom_ele_cot, cod_ele_cot from elementoscot order by nom_ele_cot ASC ";
	$r_Elemento   = mysqli_query($db_Elemento, $sql_Elemento);

	if ($r_Elemento == false){
    	mysqli_close($db_Elemento);
        $error = "Error: (" . mysql_errno() . ") " . mysql_error().")";
        //gestion_errores();
    }
        mysqli_close($db_Elemento);
		
///////////////////////////// FIN LISTADOS /////////////////////////////	

 if($_POST){//SEGUNDOS POST
 	
	$cod 	= trim($_GET['cod']);

	if($_POST['BTNcrea']){

		$Xtodo_ok 		= true;
		$Xtodo_ok2 		= true;
		$Xerror_num 	= "";
				
		$TXTCanti 		= trim($_POST['TXTCanti']);
		$LSTfechaCOT	= trim($_POST['LSTfechaCOT_anio'].'-'.$_POST['LSTfechaCOT_mes'].'-'.$_POST['LSTfechaCOT_dia']);
		$TXTpre_ch 		= trim($_POST['TXTpre_ch']);
		$TXTafactu 		= trim($_POST['TXTafactu']);
		$TXTpreCiva 	= trim($_POST['TXTpreCiva']);
		$TXTpreSiva 	= trim($_POST['TXTpreSiva']);
		$TXTtiemProd 	= trim($_POST['TXTtiemProd']);
		$LSTElemento 	= trim($_POST['LSTElemento']);
				
		if(strlen($TXTpre_ch)==0)$TXTpre_ch="";
		if(strlen($TXTafactu)==0)$TXTafactu="";
		if(strlen($TXTpreSiva)==0)$TXTpreSiva="";
		if(strlen($TXTpreCiva)==0)$TXTpreCiva="";
		//if(strlen($LSTfechaCOT)==0)$LSTfechaCOT="";
		//if(strlen($LSTElemento)==0)$LSTElemento="";
		if(strlen($TXTCanti)==0)$TXTCanti="";
		if(strlen($TXTtiemProd)==0)$TXTtiemProd="";	

		#VALIDACIONES
		if(strlen($TXTpre_ch)==0){
				$Xtodo_ok = FALSE;
				$Xerror_num.= " PRECIO CHINA ";		
		}else{
			if(!is_numeric($TXTpre_ch)){
				$Xtodo_ok = FALSE;
				$Xerror_num.= " PRECIO CHINA ";		
			}
		}

		if(strlen($TXTafactu)==0){
			$TXTafactu = "";	
		}else{
			if(!is_numeric($TXTafactu)){
				$Xtodo_ok = FALSE;
				$Xerror_num.= " FACTURAR ";		
			}
		}

		if(strlen($TXTCanti)==0){
				$Xtodo_ok = FALSE;
				$Xerror_num.= " CANTIDAD ";	
		}else{
			if(!is_numeric($TXTCanti)){
				$Xtodo_ok = FALSE;
				$Xerror_num.= " CANTIDAD ";		
			}
		}

		if(strlen($TXTpreCiva)==0){
			$TXTpreCiva = "";	
		}else{
			if(!is_numeric($TXTpreCiva)){
				$Xtodo_ok = FALSE;
				$Xerror_num.= " PRECIO CON IVA ";		
			}
		}

		if(strlen($TXTpreSiva)==0){
			$TXTpreSiva = "";	
		}else{
			if(!is_numeric($TXTpreSiva)){
				$Xtodo_ok = FALSE;
				$Xerror_num.= " PRECIO SIN IVA ";		
			}
		}

		if(strlen($TXTtiemProd)==0){
			$TXTtiemProd = "";	
		}else{
			if(!is_numeric($TXTtiemProd)){
				$Xtodo_ok = FALSE;
				$Xerror_num.= " TIEMPO PRODUCCION ";		
			}
		}
		

		
		if($Xtodo_ok == FALSE){										
			if(strlen($Xerror_num)!=0){
				$Xerror_num.= " DEBE/DEBEN SER NUMERICO/NUMERICOS ";
			}		
		}

		if($LSTElemento==000){
			$Xtodo_ok2 = FALSE;
			$Xerror_num.= " DEBE SELECCIONAR UN ELEMENTO A COTIZAR ";
		
		}
				
		if(($Xtodo_ok==true)and($Xtodo_ok2==true)){#Si esta todo bien	
				
		#guardo los datos en la base correspondiente  //////////////////////////////////////////////////////				
		$db2  = conecto();
		$sql2 = " INSERT INTO cotizachina 
				(pre_ch_cot, a_fac_cot, pres_siva, pres_civa, fe_cot, cod_ele_cot, cant_cot, tiempo_max_prod) 
				VALUES 
				('".$TXTpre_ch."','".$TXTafactu."','".$TXTpreSiva."','".$TXTpreCiva."','".$LSTfechaCOT."','".$LSTElemento."','".$TXTCanti."','".$TXTtiemProd."') ";
		//echo $sql2;exit();
		$r2   = mysqli_query($db2, $sql2);
	
		if ($r2 == false){
			mysqli_close($db2);
			$error = "Error: (" . mysql_errno() . ") " . mysql_error().")";
			//gestion_errores();
		}
			mysqli_close($db2);	

		echo "<script language='javascript'>
				 alert('El Registro a sido Creado');
				window.location.href='cotiza.php'; </script>"; 
		}#Si esta todo bien
	}

	if($_POST['BTNmod']){
		$Xtodo_ok 		= true;
		$Xtodo_ok2 		= true;
		$Xerror_num 	= "";
				
		$TXTCanti 		= trim($_POST['TXTCanti']);
		$LSTfechaCOT	= trim($_POST['LSTfechaCOT_anio'].'-'.$_POST['LSTfechaCOT_mes'].'-'.$_POST['LSTfechaCOT_dia']);
		$TXTpre_ch 		= trim($_POST['TXTpre_ch']);
		$TXTafactu 		= trim($_POST['TXTafactu']);
		$TXTpreCiva 	= trim($_POST['TXTpreCiva']);
		$TXTpreSiva 	= trim($_POST['TXTpreSiva']);
		$TXTtiemProd 	= trim($_POST['TXTtiemProd']);
		$LSTElemento 	= trim($_POST['LSTElemento']);
		
		if(strlen($TXTpre_ch)==0)$TXTpre_ch="";
		if(strlen($TXTafactu)==0)$TXTafactu="";
		if(strlen($TXTpreSiva)==0)$TXTpreSiva="";
		if(strlen($TXTpreCiva)==0)$TXTpreCiva="";
		if(strlen($LSTfechaCOT)==0)$LSTfechaCOT="";
		//if(strlen($LSTElemento)==0)$LSTElemento="";
		if(strlen($TXTCanti)==0)$TXTCanti="";
		if(strlen($TXTtiemProd)==0)$TXTtiemProd="";	

		#VALIDACIONES
		if(strlen($TXTpre_ch)==0){
				$Xtodo_ok = FALSE;
				$Xerror_num.= " PRECIO CHINA ";		
		}else{
			if(!is_numeric($TXTpre_ch)){
				$Xtodo_ok = FALSE;
				$Xerror_num.= " PRECIO CHINA ";		
			}
		}

		if(strlen($TXTafactu)==0){
			$TXTafactu = "";	
		}else{
			if(!is_numeric($TXTafactu)){
				$Xtodo_ok = FALSE;
				$Xerror_num.= " FACTURAR ";		
			}
		}

		if(strlen($TXTCanti)==0){
				$Xtodo_ok = FALSE;
				$Xerror_num.= " CANTIDAD ";	
		}else{
			if(!is_numeric($TXTCanti)){
				$Xtodo_ok = FALSE;
				$Xerror_num.= " CANTIDAD ";		
			}
		}

		if(strlen($TXTpreCiva)==0){
			$TXTpreCiva = "";	
		}else{
			if(!is_numeric($TXTpreCiva)){
				$Xtodo_ok = FALSE;
				$Xerror_num.= " PRECIO CON IVA ";		
			}
		}

		if(strlen($TXTpreSiva)==0){
			$TXTpreSiva = "";	
		}else{
			if(!is_numeric($TXTpreSiva)){
				$Xtodo_ok = FALSE;
				$Xerror_num.= " PRECIO SIN IVA ";		
			}
		}

		if(strlen($TXTtiemProd)==0){
			$TXTtiemProd = "";	
		}else{
			if(!is_numeric($TXTtiemProd)){
				$Xtodo_ok = FALSE;
				$Xerror_num.= " TIEMPO PRODUCCION ";		
			}
		}
		
		if($Xtodo_ok == FALSE){										
			if(strlen($Xerror_num)!=0){
				$Xerror_num.= " DEBE/DEBEN SER NUMERICO/NUMERICOS ";
			}		
		}

		if($LSTElemento==000){
			$Xtodo_ok2 = FALSE;
			$Xerror_num.= " DEBE SELECCIONAR UN ELEMENTO A COTIZAR ";
		
		}
				
	if(($Xtodo_ok==true)and($Xtodo_ok2==true)){#Si esta todo bien
			
			
		$db3  = conecto();
		$sql3 = " update cotizachina set 
					pre_ch_cot  = '".$TXTpre_ch."',
					a_fac_cot  = '".$TXTafactu."',
					pres_siva  = '".$TXTpreSiva."',
					pres_civa  = '".$TXTpreCiva."',
					fe_cot  = '".$LSTfechaCOT."',
					cod_ele_cot  = '".$LSTElemento."',
					cant_cot  = '".$TXTCanti."',
					tiempo_max_prod = '".$TXTtiemProd."'								
					where cod_prod_cotch = ".$cod." ";
								
		$r3   = mysqli_query($db3, $sql3);

		if ($r3 == false){
	    	mysqli_close($db3);
	        $error = "Error: (" . mysql_errno() . ") " . mysql_error().")";
	        //gestion_errores();
	    }
	      mysqli_close($db3);
		  
		echo "<script language='javascript'>
				 alert('El Registro a sido Modificado');
				window.location.href='cotiza.php'; </script>"; 		  				
		}
	}
	
	if($_POST['BTNelimina']){

		$db4  = conecto();
		$sql4 = " delete from cotizachina where cod_prod_cotch = ".$cod." ";
		$r4   = mysqli_query($db4, $sql4);

		if ($r4 == false){
	    	mysqli_close($db4);
	        $error = "Error: (" . mysql_errno() . ") " . mysql_error().")";
	        //gestion_errores();
	    }
	      mysqli_close($db4);
		  
		echo "<script language='javascript'>
				 alert('El Registro a sido Eliminado');
				window.location.href='cotiza.php'; </script>"; 	
	}
		
	if($_POST['BTNvolver']){//volver al menu
 		header ('location:index.php');
		exit();		
	}	
		
}else{

	$cod 	 	= trim($_GET['cod']);
	//Si vengo de una modificacion o eliminacion traigo los datos	

      
	//FORMATEO LAS VARIABLES QUE VOY A UTILIZAR
	$TXTCanti		= "";
	$LSTfechaCOT	= "";
	$TXTpre_ch		= "";
	$TXTafactu		= "";
	$TXTpreCiva		= "";
	$TXTpreSiva		= "";
	$TXTtiemProd	= "";
	$LSTElemento	= "";
	
	$Xerror 		= "";
	
			
	if(strlen($cod)!=0){
		#SI ES ELIMINAR O MODIFICAR	
	
		$db  = conecto();
		$sql = " select * from cotizachina where cod_prod_cotch = '".$cod."' ";
		//echo $sql;
		$r   = mysqli_query($db, $sql);
	
		if ($r == false){
	          mysqli_close($db);
	          $error = "Error: (" . mysql_errno() . ") " . mysql_error().")";
	          //gestion_errores();
	    }
	    	  mysqli_close($db);
			  
		while ($arr = mysqli_fetch_array($r))		
		{
			#$cod      = trim($arr['cod_prod_cotch']);
			$TXTpre_ch       = trim($arr['pre_ch_cot']);
			$TXTafactu       = trim($arr['a_fac_cot']);
			$TXTpreSiva      = trim($arr['pres_siva']);
			$TXTpreCiva      = trim($arr['pres_civa']);
			$LSTfechaCOT     = trim($arr['fe_cot']);
			$LSTElemento     = trim($arr['cod_ele_cot']);
			$TXTCanti 	 	 = trim($arr['cant_cot']);
			$TXTtiemProd	 = trim($arr['tiempo_max_prod']);
		}
		
		if(strlen($TXTpre_ch)==0)$TXTpre_ch="";
		if(strlen($TXTafactu)==0)$TXTafactu="";
		if(strlen($TXTpreSiva)==0)$TXTpreSiva="";
		if(strlen($TXTpreCiva)==0)$TXTpreCiva="";
		if(strlen($LSTfechaCOT)==0)$LSTfechaCOT="";
		if(strlen($LSTElemento)==0)$LSTElemento="";
		if(strlen($TXTCanti)==0)$TXTCanti="";
		if(strlen($TXTtiemProd)==0)$TXTtiemProd="";
		  
	}#FIN SI ES ELIMINAR O MODIFICAR	  

}
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

	<!-- AUTOCOMPLETAR -->
    <link rel="stylesheet" href="development/themes/base/jquery.ui.all.css">
    <script src="development/jquery-1.7.2.js"></script>
    <script src="development/ui/jquery.ui.core.js"></script>
    <script src="development/ui/jquery.ui.widget.js"></script>
    <script src="development/ui/jquery.ui.button.js"></script>
    <script src="development/ui/jquery.ui.position.js"></script>
    <script src="development/ui/jquery.ui.autocomplete.js"></script>
    <link rel="stylesheet"  type="text/css" href="css/menues.css">
    <script src="js/menues.js"></script>
    <!-- AUTOCOMPLETAR -->

        
 </head>
<body>
	<div class="logo">_%%_empresanombre_%%_</div>
	<div id="page-wrap"> 
 
 	<form action="" method="post" name="form1" enctype="multipart/form-data">   
    <?php include 'menu.php';?>

    <table class="sombra">
		<thead>
		<tr>
			<th width="60" colspan="4" align="center"><div align="center">SOLICITAR COTIZACION</div></th>
		  </tr>
		</thead>
		<tbody>
		 <tr>
		   <td colspan="4"><?php echo '<div align="center" style="color:red; font-weight: bold;">'.$Xerror." ".$Xerror_num.'</div>'; ?></td>
	      </tr>
		 <tr>
		   <td colspan="4"><strong>Articulo a cotizar:<span style="color: #000">
		     <select name="LSTElemento" id="combox" value="<?php echo $LSTElemento; ?>" class="button" >
		       <option value="000" >Seleccione</option>
		       <?php 
				while ($arr_Elemento = mysqli_fetch_array($r_Elemento))			
				{		
					$Xselt_Elemento = '';
					
					if (trim($arr_Elemento['cod_ele_cot'])==trim($LSTElemento)){	
						$Xselt_Elemento = 'selected ';
					}	
			
					echo '<option value="'.trim($arr_Elemento['cod_ele_cot']).'" '.$Xselt_Elemento.'>'.' '.trim($arr_Elemento['nom_ele_cot']).'</option>'."\n\t\t";
				}
					
				?>
	        </select>
		   </span></strong></td>
	      </tr>
		 <tr>
		   <td width="60"><strong>Cantidad:</strong></td>
		   <td width="25%"><strong>
	        <input name="TXTCanti" type="text" class="button" id="TXTCanti" size="11" value="<?php echo $TXTCanti; ?>">
		   </strong></td>
		   <td colspan="2"><strong>Fecha:<?php pinto_fecha('LSTfechaCOT','',$LSTfechaCOT);?>
		   </strong></td>
	      </tr>
		 <tr>
		   <td><strong>Precio China:</strong></td>
		   <td><strong>
	        <input name="TXTpre_ch" type="text" id="TXTpre_ch" maxlength="15" class="button" value="<?php echo $TXTpre_ch; ?>">
		   </strong></td>
		   <td><strong>A Facturar:</strong></td>
		   <td><strong>
	        <input name="TXTafactu" type="text" id="TXTafactu" maxlength="20" class="button" value="<?php echo $TXTafactu; ?>">
		   </strong></td>
	      </tr>
		 <tr>
		   <td><strong>Precio C/IVA:</strong></td>
		   <td><strong>
	        <input name="TXTpreCiva" type="text" id="TXTpreCiva" maxlength="15" class="button" value="<?php echo $TXTpreCiva; ?>">
		   </strong></td>
		   <td><strong>Precio S/IVA:</strong></td>
		   <td><strong>
	        <input name="TXTpreSiva" type="text" id="TXTpreSiva" maxlength="15" class="button" value="<?php echo $TXTpreSiva; ?>">
		   </strong></td>
	      </tr>
		 <tr>
		   <td><strong>Tiempo de Produccion:	       </strong></td>
		   <td colspan="3"><strong>
	        <input name="TXTtiemProd" type="text" id="TXTtiemProd" maxlength="11" class="button" value="<?php echo $TXTtiemProd; ?>">
	        dias.
		   </strong></td>
	      </tr>
		 <tr>
		   <td colspan="4">&nbsp;</td>
	      </tr>
		 <tr>
		   <td colspan="4"><div align="center"><span style="color: #000">
           <?php 
		   		if(strlen($cod)==0){
					echo '<input type="submit" name="BTNcrea" id="BTNcrea" class="button" value="CREAR COTIZACION">';
				}else{
					// if($est_accion!="disabled"){
					echo '<input type="submit" name="BTNmod" id="BTNmod" class="button" value="MODIFICAR COTIZACION">
						  <input type="submit" name="BTNelimina" id="BTNelimina" class="button" value="ELIMINAR COTIZACION">';
					 //}
				}
			?>
		     <input type="submit" name="BTNvolver" id="BTNvolver" class="button" value="Volver Al Menu">             
		   </span></div></td>
	      </tr>                                                            
		</tbody>
	</table>
     </form>
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
