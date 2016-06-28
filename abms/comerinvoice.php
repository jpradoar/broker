<?php
require_once("../funciones.inc.php");
/*
if (falta_logueo())
{ 
	header('location:login.php');
	exit();
}

 $Xnombre = trim(strtoupper($_SESSION['usuario']));
 */
 $Xnombre ="";
 session_start();
		
 	$DEL = $_GET['DEL'];
	$cod = $_GET['cod'];
		
if (strlen($DEL)!=0){

	if ($DEL == "CI"){
		$CampoDel = "file_com_inv";
	}
		$db6  = conecto();
		$sql6 = " update comercialinvoice set ".$CampoDel."  = '' where cod_ord = ".$cod." ";
		//echo $sql6;exit();
		$r6   = mysqli_query($db6, $sql6);

		if ($r5 == false){
	    	mysqli_close($db6);
	        $error = "Error: (" . mysql_errno() . ") " . mysql_error().")";
	        //gestion_errores();
	    }
	      mysqli_close($db6);
	
}

if($_POST){//SEGUNDOS POST
	$cod 	= $_GET['cod'];
	$accion = $_GET['accion'];
	

	if($_POST['BTNALTA']){
		
		$Xtodo_ok 		= true;
		$Xerror_num 	= "";
		
		#recibo los datos del formulario//////////////////////////////////////////////////////
		$FILEci		 = $_FILES['FILEcomerinv']['name'];
		$LSTfechaEFP = trim($_POST['LSTfechaEFP_anio'].'-'.$_POST['LSTfechaEFP_mes'].'-'.$_POST['LSTfechaEFP_dia']);
		$TXTnroCI	 = trim($_POST['TXTnroCI']);
		$TXTMontoCI	 = trim($_POST['TXTMontoCI']);
		$RDOCI	 	 = trim($_POST['RDOCI']);
		
		if(strlen($FILEci)==0){$FILEci = "";}
		if(strlen($LSTfechaEFP)<4){$LSTfechaEFP = "";}
		if(strlen($TXTnroCI)==0){$TXTnroCI = "";}
		if(strlen($TXTMontoCI)==0){$TXTMontoCI = "";}
		if(strlen($RDOCI)==0){$RDOCI = "";}
	
		if(strlen($TXTMontoCI)==0){
				$Xtodo_ok = FALSE;
				$Xerror_num.= " MONTO ";	
		}else{
			if(!is_numeric($TXTMontoCI)){
				$Xtodo_ok = FALSE;
				$Xerror_num.= " MONTO ";		
			}
		}		

		if(strlen($Xerror_num)!=0){
			$Xerror_num.= " DEBE/DEBEN SER NUMERICO/NUMERICOS ";
		}	
				
		#guardo los datos en la base correspondiente  //////////////////////////////////////////////////////	
		
		///////FALTA AGREGAR EN LA BASE DE DATOS!!	
		if($Xtodo_ok==true){#Si esta todo bien	
		
			$db2  = conecto();
			$sql2 = " INSERT INTO comercialinvoice (cod_ord, fe_fin_prod, num_com_inv, monto_com_inv, giro_com_inv, file_com_inv) VALUES ('".$cod."','".$LSTfechaEFP."','".$TXTnroCI."','".$TXTMontoCI."','".$RDOCI."','".$FILEci."') "; 
			//echo $sql2;exit();
			$r2   = mysqli_query($db2, $sql2);
		
			if ($r2 == false){
				mysqli_close($db2);
				$error = "Error: (" . mysql_errno() . ") " . mysql_error().")";
				//gestion_errores();
			}
				mysqli_close($db2);
//-------------------------------------------- UPLOAD DE ARCHIVOS -----------------------	
			//para el alta de las carpetas
			$raiz		= "../ordenes/";
			$estructura = $raiz . trim($cod);
		
			if(!mkdir($estructura, 0777, true))//si no se creo la carpeta, la creo y meto los datos
			{
				
//########################### ARCHIVO DE COMERCIAL INVOICE ############################### 
				$FILEci		= $_FILES['FILEci']['name'];
				$tmp_nameCI	= $_FILES['FILEci']['tmp_name'];
				$errorCI 	= $_FILES['FILEci']['error'];
				suboarchivos($estructura,$FILEci,$tmp_nameCI,$errorCI,$cod); 
			
			}else{//si salio todo genial

//########################### ARCHIVO DE COMERCIAL INVOICE ############################### 
				$FILEci		= $_FILES['FILEci']['name'];
				$tmp_nameCI	= $_FILES['FILEci']['tmp_name'];
				$errorCI 	= $_FILES['FILEci']['error'];
				suboarchivos($estructura,$FILEci,$tmp_nameCI,$errorCI,$cod); 
								
			}//FIN si salio todo genial	
								
			echo "<script language='javascript'>
					 alert('El Registro a sido Creado');
					window.location.href='../veoordenes.php?cod=$cod'; </script>"; 	
		}#Fin Si esta todo bien				
	}#fin alta

	if($_POST['BTNMOD']){
		
		$Xtodo_ok 		= true;
		$Xerror_num 	= "";
		
		$FILEci		 = $_FILES['FILEcomerinv']['name'];
		$LSTfechaEFP = trim($_POST['LSTfechaEFP_anio'].'-'.$_POST['LSTfechaEFP_mes'].'-'.$_POST['LSTfechaEFP_dia']);
		$TXTnroCI	 = trim($_POST['TXTnroCI']);
		$TXTMontoCI	 = trim($_POST['TXTMontoCI']);
		$RDOCI	 	 = trim($_POST['RDOCI']);

		if(strlen($FILEci)==0){$FILEci = "";}
		if(strlen($LSTfechaEFP)<4){$LSTfechaEFP = "";}
		if(strlen($TXTnroCI)==0){$TXTnroCI = "";}
		if(strlen($TXTMontoCI)==0){$TXTMontoCI = "";}
		if(strlen($RDOCI)==0){$RDOCI = "";}

		if(strlen($TXTMontoCI)==0){
				$Xtodo_ok = FALSE;
				$Xerror_num.= " MONTO ";	
		}else{
			if(!is_numeric($TXTMontoCI)){
				$Xtodo_ok = FALSE;
				$Xerror_num.= " MONTO ";		
			}
		}		

		if(strlen($Xerror_num)!=0){
			$Xerror_num.= " DEBE/DEBEN SER NUMERICO/NUMERICOS ";
		}	
		
		if($Xtodo_ok==true){#Si esta todo bien			
			$db3  = conecto();
			$sql3 = " update comercialinvoice set 
						fe_fin_prod = '".$LSTfechaEFP."',
						num_com_inv  = '".$TXTnroCI."',
						monto_com_inv  = '".$TXTMontoCI."',
						giro_com_inv  = '".$RDOCI."',
						file_com_inv = '".$FILEci."'
						where cod_ord = ".$cod." ";
			//echo $sql3;exit();		 
			$r3   = mysqli_query($db3, $sql3);
	
			if ($r3 == false){
				mysqli_close($db3);
				$error = "Error: (" . mysql_errno() . ") " . mysql_error().")";
				//gestion_errores();
			}
			  mysqli_close($db3);

//-------------------------------------------- UPLOAD DE ARCHIVOS -----------------------	
			//para el alta de las carpetas
			$raiz		= "../ordenes/";
			$estructura = $raiz . trim($cod);
		
			if(!mkdir($estructura, 0777, true))//si no se creo la carpeta, la creo y meto los datos
			{
				
//########################### ARCHIVO DE COMERCIAL INVOICE ############################### 
				$FILEci		= $_FILES['FILEci']['name'];
				$tmp_nameCI	= $_FILES['FILEci']['tmp_name'];
				$errorCI 	= $_FILES['FILEci']['error'];
				suboarchivos($estructura,$FILEci,$tmp_nameCI,$errorCI,$cod); 
			
			}else{//si salio todo genial

//########################### ARCHIVO DE COMERCIAL INVOICE ############################### 
				$FILEci		= $_FILES['FILEci']['name'];
				$tmp_nameCI	= $_FILES['FILEci']['tmp_name'];
				$errorCI 	= $_FILES['FILEci']['error'];
				suboarchivos($estructura,$FILEci,$tmp_nameCI,$errorCI,$cod); 
								
			}//FIN si salio todo genial	
				
			echo "<script language='javascript'>
					 alert('El Registro a sido Modificado');
					window.location.href='../veoordenes.php?cod=$cod'; </script>"; 	
		}#Fin Si esta todo bien				
	}#fin modificacion
	
	if($_POST['BTNELI']){

		$db4  = conecto();
		$sql4 = " delete from comercialinvoice where cod_ord = ".$cod." ";
		$r4   = mysqli_query($db4, $sql4);

		if ($r4 == false){
	    	mysqli_close($db4);
	        $error = "Error: (" . mysql_errno() . ") " . mysql_error().")";
	        //gestion_errores();
	    }
	      mysqli_close($db4);
		  
		echo "<script language='javascript'>
				 alert('El Registro a sido Eliminado');
				window.location.href='../veoordenes.php?cod=$cod'; </script>"; 	
	}
	
	if($_POST['BTNvolver']){//volver al menu
 		header ('location:../veoordenes.php?cod='.$cod);
		exit();		
	}			
}else{
	
	$Xerror 	 = "";
	$cod 		 = $_GET['cod'];
	$accion 	 = $_GET['accion'];
	$FILEci 	 = "";
	$ci			 = "";
	$LSTfechaEFP = "";
	$TXTnroCI 	 = "";
	$TXTMontoCI  = "";
	$RDOCI	 	 = "";
				
	if(strlen($cod)!=0){#SI ES ELIMINAR O MODIFICAR	
		
		#ADELANTOCLIENTE
		$db1  = conecto();
		$sql1 = "select * from comercialinvoice where cod_ord = ".$cod." ";
		$r1   = mysqli_query($db1, $sql1);
	
		if ($r1 == false){
	    	mysqli_close($db1);
	        $error = "Error: (" . mysql_errno() . ") " . mysql_error().")";
	        //gestion_errores();
	    }
	    	mysqli_close($db1);
			
		while ($arr1 = mysqli_fetch_array($r1))		
		{
			$ci			 = trim($arr1['file_com_inv']); 
			$LSTfechaEFP = trim($arr1['fe_com_inv']);
			$TXTnroCI 	 = trim($arr1['num_com_inv']);
			$TXTMontoCI  = trim($arr1['monto_com_inv']);
			$RDOCI	 	 = trim($arr1['giro_com_inv']);
			#formateo las que no tienen nada																											
		}
			if(strlen($ci)==0){$ci = "";}
			if(strlen($LSTfechaEFP)<4){$LSTfechaEFP = "";}
			if(strlen($TXTnroCI)==0){$TXTnroCI = "";}
			if(strlen($TXTMontoCI)==0){$TXTMontoCI = "";}
			if(strlen($RDOCI)==0){$RDOCI = "";}
					
		#FIN ADELANTOCLIENTE
	}#FIN SI ES ELIMINAR O MODIFICAR	
}
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
	<div class="logo">BHI - BROKERS</div>
	<div id="page-wrap"> 
 	<form action="" method="post" name="form1" enctype="multipart/form-data" >   
    <?php include 'menu.php'; ?>
	<p>USUARIO: <?php echo $Xnombre; ?></p>
	<table class="sombra">
      <thead>
	          <tr>
	            <th colspan="4" align="center"><div align="center">COMERCIAL INVOICE</div></th>
	            </tr>
	          </thead>
	        <tbody>
	          <tr>
	            <td colspan="4"><?php echo '<div align="center" style="color:red; font-weight: bold;">'.$Xerror." ".$Xerror_num.'</div>'; ?></td>
              </tr>
	          <tr>
	            <td colspan="4"><div align="center"><span style="color: #000"><strong>DETALLE</strong></span></div></td>
	            </tr>
	          <tr>
	            <td><strong>ARCHIVO C.I.:</strong></td>
	            <td colspan="2"><div align="left"><span style="color: #000">
	              <?php if(strlen($ci)!=0){?>
	              <b>Nombre del archivo:</b>
	              <input type="text" value="<?php echo $ci; ?>" name="ci" id="ci"  class="button">
	              <?php } else { ?>
	              <input name="FILEcomerinv" type="file" id="FILEcomerinv" title="SELECCIONE.." class="button" style="width: 75%">
                </span></div>
                <?php } ?></td>
	            <td><div align="right">
	              <?php 	
				if(strlen($ci)!=0){?>
	              <a href="<?php echo 'comerinvoice.php?accion=MOD&cod='.$cod.'&DEL=CI'; ?>">
	                <button class="button" type="button">Eliminar</button>
                  </a>
	              <?php }?>
                </div></td>
              </tr>
	          <tr>
	            <td width="235"><strong>FECHA ESTIMADA FIN PROD.:</strong></td>
	            <td width="254"><?php pinto_fecha('LSTfechaEFP','','');?></td>
	            <td width="306">&nbsp;</td>
	            <td width="159"><strong>GIRADO</strong></td>
	            </tr>
	          <tr>
	            <td><strong>NRO. COMERCIAL INVOICE:</strong></td>
	            <td><strong>
	              <input name="TXTnroCI" type="text" id="TXTnroCI" value="<?php echo $TXTnroCI; ?>" maxlength="15" class="button">
	              </strong></td>
	            <td><strong>MONTO:
	                <input name="TXTMontoCI" type="text" id="TXTMontoCI" value="<?php echo $TXTMontoCI; ?>" maxlength="15" class="button">.U$S</strong></td>
	            <td><p><strong>SI
	                    <input type="radio" name="RDOCI" id="RDOCI" value="S" class="button" <?php if($RDOCI=="S"){ echo "checked";} ?>>
	            </strong><strong>
	                NO
	                    <input name="RDOCI" type="radio" id="RDOCI" value="N" class="button" <?php if($RDOCI=="N"){ echo "checked";} ?> checked>
	                </strong></p></td>
	            </tr>
	          <tr>
	            <td colspan="4">&nbsp;</td>
	            </tr>
	          <tr>
	            <td colspan="4"><div align="center"><span style="color: #000">
	              <?php  
				  if($accion == "ALT"){
					  	echo '<input name="BTNALTA" type="submit" class="button" id="BTNALTA" value="ALTA">';
					  	} 
						 if($accion == "MOD"){
					  	echo '<input name="BTNMOD" type="submit" class="button" id="BTNMOD" value="MODIFICAR">';
					  	}
						 if($accion == "ELI"){
					  	echo '<input name="BTNELI" type="submit" class="button" id="BTNELI" value="ELIMINAR">';
					  	}
					?>
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
