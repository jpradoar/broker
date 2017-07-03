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


	#TRAIGO EL NOMBRE DE LOS CLIENTES
	$db_Cliente  = conecto();
	$sql_Cliente = "select ape_cli, nom_cli, cod_cli from clientes order by ape_cli ASC ";
	$r_Cliente   = mysqli_query($db_Cliente, $sql_Cliente);

	if ($r_Cliente == false){
    	mysqli_close($db_Cliente);
        $error = "Error: (" . mysql_errno() . ") " . mysql_error().")";
        //gestion_errores();
    }
        mysqli_close($db_Cliente);
				
///////////////////////////// FIN LISTADOS /////////////////////////////	

 if($_POST){//SEGUNDOS POST
 	
	$cod 	= trim($_GET['cod']);

	if($_POST['BTNcrea']){

		$Xtodo_ok 		= true;
		$Xerror_num 	= "";  

		$cod_cli       = trim($_POST['LSTElemento']);
		$cod_ele_cot   = trim($_POST['LSTCliente']);
		$precio_cot    = trim($_POST['TXTPrecio']);
		$notas_cot     = trim($_POST['TXTNotas']);
		$TXTCanti      = trim($_POST['TXTCanti']);
		

		if(strlen($cod_cli)==0)$cod_cli="";
		if(strlen($cod_ele_cot)==0)$cod_ele_cot="";
		if(strlen($precio_cot)==0)$precio_cot="";
		if(strlen($notas_cot)==0)$notas_cot="";
		if(strlen($TXTCanti)==0)$TXTCanti="";				

		#VALIDACIONES
		if(strlen($precio_cot)==0){
			$precio_cot = "";	
		}else{
			if(!is_numeric($precio_cot)){
				$Xtodo_ok = FALSE;
				$Xerror_num.= " PRECIO ";		
			}
		}

		if(strlen($TXTCanti)==0){
			$TXTCanti = "";	
		}else{
			if(!is_numeric($TXTCanti)){
				$Xtodo_ok = FALSE;
				$Xerror_num.= " CANTIDAD ";		
			}
		}
												
		if(strlen($Xerror_num)!=0){
			$Xerror_num.= " DEBE/DEBEN SER NUMERICO/NUMERICOS ";
		}		
		
		if($Xtodo_ok==true){#Si esta todo bien	

						
		#guardo los datos en la base correspondiente  //////////////////////////////////////////////////////				
		$db2  = conecto();
		$sql2 = " INSERT INTO cotizacliente 
				(cod_cli, cod_ele_cot, precio_cot, notas_cot, canti_cot) 
				VALUES 
				('".$cod_cli."','".$cod_ele_cot."','".$precio_cot."','".$notas_cot."','".$TXTCanti."') ";
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
				window.location.href='cotizacli.php'; </script>"; 
		}#Si esta todo bien
	}

	if($_POST['BTNMOD']){
		$Xtodo_ok 		= true;
		$Xerror_num 	= "";
				
		$cod_cli       = trim($_POST['LSTElemento']);
		$cod_ele_cot   = trim($_POST['LSTCliente']);
		$precio_cot    = trim($_POST['TXTPrecio']);
		$notas_cot     = trim($_POST['TXTNotas']);
		$TXTCanti      = trim($_POST['TXTCanti']);
		

		if(strlen($cod_cli)==0)$cod_cli="";
		if(strlen($cod_ele_cot)==0)$cod_ele_cot="";
		if(strlen($precio_cot)==0)$precio_cot="";
		if(strlen($notas_cot)==0)$notas_cot="";
		if(strlen($TXTCanti)==0)$TXTCanti="";			

		#VALIDACIONES
		if(strlen($precio_cot)==0){
			$precio_cot = "";	
		}else{
			if(!is_numeric($precio_cot)){
				$Xtodo_ok = FALSE;
				$Xerror_num.= " PRECIO ";		
			}
		}

		if(strlen($TXTCanti)==0){
			$TXTCanti = "";	
		}else{
			if(!is_numeric($TXTCanti)){
				$Xtodo_ok = FALSE;
				$Xerror_num.= " CANTIDAD ";		
			}
		}
												
		if(strlen($Xerror_num)!=0){
			$Xerror_num.= " DEBE/DEBEN SER NUMERICO/NUMERICOS ";
		}		
		
		if($Xtodo_ok==true){#Si esta todo bien	
			
					
		$db3  = conecto();
		$sql3 = " update cotizacliente set 
					cod_cli  = '".$cod_cli."',
					cod_ele_cot  = '".$cod_ele_cot."',
					precio_cot  = '".$precio_cot."',
					notas_cot  = '".$notas_cot."',
					canti_cot  = '".$TXTCanti."'								
					where cod_cot_cli = ".$cod." ";
								
		$r3   = mysqli_query($db3, $sql3);

		if ($r3 == false){
	    	mysqli_close($db3);
	        $error = "Error: (" . mysql_errno() . ") " . mysql_error().")";
	        //gestion_errores();
	    }
	      mysqli_close($db3);
		  
		echo "<script language='javascript'>
				 alert('El Registro a sido Modificado');
				window.location.href='cotizacli.php'; </script>"; 		  				
		}
	}
	
	if($_POST['BTNELI']){

		$db4  = conecto();
		$sql4 = " delete from cotizacliente where cod_cot_cli = ".$cod." ";
		$r4   = mysqli_query($db4, $sql4);

		if ($r4 == false){
	    	mysqli_close($db4);
	        $error = "Error: (" . mysql_errno() . ") " . mysql_error().")";
	        //gestion_errores();
	    }
	      mysqli_close($db4);
		  
		echo "<script language='javascript'>
				 alert('El Registro a sido Eliminado');
				window.location.href='cotizacli.php'; </script>"; 	
	}
		
	if($_POST['BTNvolver']){//volver al menu
 		header ('location:index.php');
		exit();		
	}	
		
}

	$cod 	 	= trim($_GET['cod']);
	//Si vengo de una modificacion o eliminacion traigo los datos	

	//FORMATEO LAS VARIABLES QUE VOY A UTILIZAR
	$LSTElemento	= "";
	$LSTCliente		= "000";
	$TXTPrecio    	= "";
	$TXTNotas     	= "";
	$TXTCanti     	= "";
	
	$Xerror			= "";
	
			
	if(strlen($cod)!=0){
		#SI ES ELIMINAR O MODIFICAR	
	
		$db  = conecto();
		$sql = " select * from cotizacliente where cod_cot_cli = '".$cod."' ";
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
			#$cod      = trim($arr['cod_cot_cli']);
			$LSTCliente   = trim($arr['cod_cli']);
			$LSTElemento  = trim($arr['cod_ele_cot']);
			$TXTPrecio    = trim($arr['precio_cot']);
			$TXTNotas     = trim($arr['notas_cot']);
			$TXTCanti     = trim($arr['canti_cot']);
		}
		     
		if(strlen($LSTCliente)==0)$LSTCliente="";
		if(strlen($LSTElemento)==0)$LSTElemento="";
		if(strlen($TXTPrecio)==0)$TXTPrecio="";
		if(strlen($TXTNotas)==0)$TXTNotas="";
		if(strlen($TXTCanti)==0)$TXTCanti="";
		  
	}#FIN SI ES ELIMINAR O MODIFICAR	  

	
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

    <!-- PARA AGREGAR ARCHIVOS-->    
	<!--<script type="text/javascript" src="jquery.js"></script>-->
	<script type="text/javascript" src="js/jquery.addfield.js"></script> 
    <!-- FIN PARA AGREGAR ARCHIVOS-->

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
			<th width="60" colspan="4" align="center"><div align="center">SOLICITAR COTIZACION A CLIENTE</div></th>
		  </tr>
		</thead>
		<tbody>
		 <tr>
		   <td colspan="4"><?php echo '<div align="center" style="color:red; font-weight: bold;">'.$Xerror." ".$Xerror_num.'</div>'; ?></td>
	      </tr>
		 <tr>
		   <td width="30%"><strong>Articulo a cotizar:</strong></td>
		   <td><strong><span style="color: #000">
		     <select name="LSTElemento" id="combobox" value="<?php echo $LSTElemento; ?>" class="button" >
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
		   <td colspan="2">&nbsp;</td>
	      </tr>
		 <tr>
		   <td><strong>Cliente: </strong></td>
		   <td><span style="color: #000">
		     <select name="LSTCliente" id="combox" value="<?php echo $LSTCliente; ?>" class="button">
		       <option value="000">Seleccione</option>
		       <?php 
				while ($arr_Cliente = mysqli_fetch_array($r_Cliente))			
				{		
					$XseltCliente = '';
					
					if (trim($arr_Cliente['cod_cli'])==trim($LSTCliente)){	
						$XseltCliente = 'selected ';
					}	
			
					echo '<option value="'.trim($arr_Cliente['cod_cli']).'" '.$XseltCliente.'>'.' '.trim($arr_Cliente['ape_cli']).', ' .trim($arr_Cliente['nom_cli']).'</option>'."\n\t\t";
				}
					
				?>
	        </select>
		   </span></td>
		   <td colspan="2">&nbsp;</td>
	      </tr>
		 <tr>
		   <td width="60"><strong>Cantidad:</strong></td>
		   <td width="25%"><strong>
	        <input name="TXTCanti" type="text" class="button" id="TXTCanti" value="<?php echo $TXTCanti; ?>" size="11" maxlength="15">
		   </strong></td>
		   <td><strong>Precio:</strong></td>
		   <td><strong>
		     <input name="TXTPrecio" type="text" class="button" id="TXTPrecio" value="<?php echo $TXTCanti; ?>" size="11" maxlength="15">
		   </strong></td>
	      </tr>
		 <tr>
		   <td><strong>Notas:</strong></td>
		   <td colspan="3"><textarea name="TXTNotas" cols="70" rows="6" maxlength="250" class="button" id="TXTNotas"><?php echo $TXTNotas; ?></textarea></td>
	      </tr>
		 <tr>
		   <td colspan="4">&nbsp;</td>
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
					 if($est_accion!="disabled"){
					echo '<input type="submit" name="BTNMOD" id="BTNMOD" class="button" value="MODIFICAR COTIZACION">
						  <input type="submit" name="BTNELI" id="BTNELI" class="button" value="ELIMINAR COTIZACION">';
					 }
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
