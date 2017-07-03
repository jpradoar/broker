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

	if ($DEL == "EM"){
		$CampoDel = "file_emb";
	}
		$db6  = conecto();
		$sql6 = " update embarques set ".$CampoDel."  = '' where cod_ord = ".$cod." ";
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
		
		$TXTnumBL	 = trim($_POST['TXTnumBL']);		
		$FILEemb	 = $_FILES['FILEemba']['name'];
		
		$LSTfechaIdE = trim($_POST['LSTfechaIdE_anio'].'-'.$_POST['LSTfechaIdE_mes'].'-'.$_POST['LSTfechaIdE_dia']);
		$LSTfechaFE  = trim($_POST['LSTfechaFE_anio'].'-'.$_POST['LSTfechaFE_mes'].'-'.$_POST['LSTfechaFE_dia']);
		$LSTfechaFLL = trim($_POST['LSTfechaFLL_anio'].'-'.$_POST['LSTfechaFLL_mes'].'-'.$_POST['LSTfechaFLL_dia']);				
		$LstEstadoBL = trim($_POST['LstEstadoBL']);
		$TXTNotaBL	 = trim($_POST['TXTNotaBL']);

		if(strlen($TXTnumBL)==0){$TXTnumBL = "";}
		if(strlen($LSTfechaIdE)<4){$LSTfechaIdE = "";}
		if(strlen($LSTfechaFE)<4){$LSTfechaFE = "";}
		if(strlen($LSTfechaFLL)<4){$LSTfechaFLL = "";}				
		if(strlen($LstEstadoBL)==0){$LstEstadoBL = "";}
		if(strlen($TXTNotaBL)==0){$TXTNotaBL = "";}
	

		if(strlen($TXTnumBL)==0){
				$Xtodo_ok = FALSE;
				$Xerror_num.= " NUMERO DE BL ";	
		}
		/*else{
			if(!is_numeric($TXTnumBL)){
				$Xtodo_ok = FALSE;
				$Xerror_num.= " NUMERO DE BL ";		
			}
		}*/

		if(strlen($Xerror_num)!=0){
			$Xerror_num.= " DEBE SER COMPLETADO ";
		}	
				
		#guardo los datos en la base correspondiente  //////////////////////////////////////////////////////	
	
	if($Xtodo_ok==true){#Si esta todo bien	
			
		$db2  = conecto();
		$sql2 = " INSERT INTO embarques (cod_ord, num_bl, fe_inst_emb, fe_emb, fe_llegada_emb, estado_emb, notas_emb, file_emb) VALUES ('".$cod."','".$TXTnumBL."','".$LSTfechaIdE."','".$LSTfechaFE."','".$LSTfechaFLL."','".$LstEstadoBL."','".$TXTNotaBL."','".$FILEemb."') ";
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
				$FILEemb		= $_FILES['FILEemba']['name'];
				$tmp_nameemb	= $_FILES['FILEemba']['tmp_name'];
				$erroremb 		= $_FILES['FILEemba']['error'];
				suboarchivos($estructura,$FILEemb,$tmp_nameemb,$erroremb,$cod); 
			
			}else{//si salio todo genial

//########################### ARCHIVO DE COMERCIAL INVOICE ############################### 
				$FILEemb		= $_FILES['FILEemba']['name'];
				$tmp_nameemb	= $_FILES['FILEemba']['tmp_name'];
				$erroremb 		= $_FILES['FILEemba']['error'];
				suboarchivos($estructura,$FILEemb,$tmp_nameemb,$erroremb,$cod); 
								
			}//FIN si salio todo genial	
				
		echo "<script language='javascript'>
				 alert('El Registro a sido Creado');
				window.location.href='../veoordenes.php?cod=$cod'; </script>"; 	
		}#Fin Si esta todo bien				
	}#fin alta

	if($_POST['BTNMOD']){

		$Xtodo_ok 		= true;
		$Xerror_num 	= "";		
		
		$TXTnumBL	 = trim($_POST['TXTnumBL']);	
		$FILEemb	 = $_FILES['FILEemba']['name'];
			
		$LSTfechaIdE = trim($_POST['LSTfechaIdE_anio'].'-'.$_POST['LSTfechaIdE_mes'].'-'.$_POST['LSTfechaIdE_dia']);
		$LSTfechaFE  = trim($_POST['LSTfechaFE_anio'].'-'.$_POST['LSTfechaFE_mes'].'-'.$_POST['LSTfechaFE_dia']);
		$LSTfechaFLL = trim($_POST['LSTfechaFLL_anio'].'-'.$_POST['LSTfechaFLL_mes'].'-'.$_POST['LSTfechaFLL_dia']);				
		$LstEstadoBL = trim($_POST['LstEstadoBL']);
		$TXTNotaBL	 = trim($_POST['TXTNotaBL']);

		if(strlen($TXTnumBL)==0){$TXTnumBL = "";}
		if(strlen($LSTfechaIdE)<4){$LSTfechaIdE = "";}
		if(strlen($LSTfechaFE)<4){$LSTfechaFE = "";}
		if(strlen($LSTfechaFLL)<4){$LSTfechaFLL = "";}				
		if(strlen($LstEstadoBL)==0){$LstEstadoBL = "";}
		if(strlen($TXTNotaBL)==0){$TXTNotaBL = "";}

		if(strlen($TXTnumBL)==0){
				$Xtodo_ok = FALSE;
				$Xerror_num.= " NUMERO DE BL ";
		}
		/*else{
			if(!is_numeric($TXTnumBL)){
				$Xtodo_ok = FALSE;
				$Xerror_num.= " NUMERO DE BL ";		
			}
		}*/

		if(strlen($Xerror_num)!=0){
			$Xerror_num.= " DEBE SER COMPLETADO ";
		}	

	if($Xtodo_ok==true){#Si esta todo bien			
		$db3  = conecto();
		$sql3 = " update embarques set 
					num_bl = '".$TXTnumBL."',
					fe_inst_emb  = '".$LSTfechaIdE."',
					fe_emb  = '".$LSTfechaFE."',
					fe_llegada_emb  = '".$LSTfechaFLL."',
					estado_emb  = '".$LstEstadoBL."',
					notas_emb  = '".$TXTNotaBL."',
					file_emb = '".$FILEemb."'
					where cod_ord = ".$cod." ";
					 
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
				$FILEemb		= $_FILES['FILEemba']['name'];
				$tmp_nameemb	= $_FILES['FILEemba']['tmp_name'];
				$erroremb 		= $_FILES['FILEemba']['error'];
				suboarchivos($estructura,$FILEemb,$tmp_nameemb,$erroremb,$cod); 
			
			}else{//si salio todo genial

//########################### ARCHIVO DE COMERCIAL INVOICE ############################### 
				$FILEemb		= $_FILES['FILEemba']['name'];
				$tmp_nameemb	= $_FILES['FILEemba']['tmp_name'];
				$erroremb 		= $_FILES['FILEemba']['error'];
				suboarchivos($estructura,$FILEemb,$tmp_nameemb,$erroremb,$cod); 
								
			}//FIN si salio todo genial	
			
		echo "<script language='javascript'>
				 alert('El Registro a sido Modificado');
				window.location.href='../veoordenes.php?cod=$cod'; </script>"; 	
		}#Fin Si esta todo bien				
	}#fin MODIFICACION
	
	if($_POST['BTNELI']){

		$db4  = conecto();
		$sql4 = " delete from embarques where cod_ord = ".$cod." ";
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
	
	$Xerror = "";
	$cod 	= $_GET['cod'];
	$accion = $_GET['accion'];
	
	if(strlen($cod)!=0){#SI ES ELIMINAR O MODIFICAR	
		
		#ADELANTOCLIENTE
		$db1  = conecto();
		$sql1 = "select * from embarques where cod_ord = ".$cod." ";
		$r1   = mysqli_query($db1, $sql1);
	
		if ($r1 == false){
	    	mysqli_close($db1);
	        $error = "Error: (" . mysql_errno() . ") " . mysql_error().")";
	        //gestion_errores();
	    }
	    	mysqli_close($db1);
			
		while ($arr1 = mysqli_fetch_array($r1))		
		{
			$emba	 	 = trim($arr1['file_emb']);
			$TXTnumBL 	 = trim($arr1['num_bl']);
			$LSTfechaIdE = trim($arr1['fe_inst_emb']);
			$LSTfechaFE  = trim($arr1['fe_emb']);
			$LSTfechaFLL = trim($arr1['fe_llegada_emb']);
			$LstEstadoBL = trim($arr1['estado_emb']);
			$TXTNotaBL	 = trim($arr1['notas_emb']);
			#formateo las que no tienen nada																											
		}
		if(strlen($emba)==0){$emba = "";}
		if(strlen($TXTnumBL)==0){$TXTnumBL = "";}
		if(strlen($LSTfechaIdE)<4){$LSTfechaIdE = "";}
		if(strlen($LSTfechaFE)<4){$LSTfechaFE = "";}
		if(strlen($LSTfechaFLL)<4){$LSTfechaFLL = "";}				
		if(strlen($LstEstadoBL)==0){$LstEstadoBL = "";}
		if(strlen($TXTNotaBL)==0){$TXTNotaBL = "";}	
				
		#FIN ADELANTOCLIENTE
	}#FIN SI ES ELIMINAR O MODIFICAR	
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
 <form action="" method="post" name="form1" enctype="multipart/form-data">   
    <?php include 'menu.php'; ?>

    <div class="caption">_%%_empresanombre_%%_.</div> 
	<p>USUARIO: <?php echo $Xnombre; ?></p>
	<table class="sombra">
      <thead>
	          <tr>
	            <th colspan="3" align="center"><div align="center">EMBARQUES </div></th>
	            </tr>
	          </thead>
	        <tbody>
	          <tr>
	            <td colspan="3"><?php echo '<div align="center" style="color:red; font-weight: bold;">'.$Xerror." ".$Xerror_num.'</div>'; ?></td>
              </tr>
	          <tr>
	            <td colspan="3"><div align="center"><span style="color: #000"><strong>DETALLE</strong></span></div></td>
	            </tr>
	          <tr>
	            <td><strong>ARCHIVO EMBARQUES:</strong></td>
	            <td><div align="left"><span style="color: #000">
	              <?php if(strlen($emba)!=0){?>
	              <b>Nombre del archivo:</b>
	              <input type="text" value="<?php echo $emba; ?>" name="emba" id="emba"  class="button">
	              <?php } else { ?>
	              <input name="FILEemba" type="file" id="FILEemba" title="SELECCIONE.." class="button" style="width: 75%">
	              </span></div>
	              <?php } ?></td>
	            <td><div align="right">
	              <?php 	
				if(strlen($emba)!=0){?>
	              <a href="<?php echo 'embarques.php?accion=MOD&cod='.$cod.'&DEL=EM'; ?>">
	                <button class="button" type="button">Eliminar</button>
                  </a>
	              <?php }?>
	              </div></td>
              </tr>
	          <tr>
	            <td width="31%"><strong>NRO. B.L.:</strong></td>
	            <td colspan="2"><strong>
	              <input name="TXTnumBL" type="text" id="TXTnumBL" maxlength="25" value="<?php echo $TXTnumBL; ?>" class="button">
	            </strong></td>
	            </tr>
	          <tr>
	            <td><strong>INSTRUCCIONES DE EMBARQUE:</strong></td>
	            <td colspan="2"><?php pinto_fecha('LSTfechaIdE','',$LSTfechaIdE);?></td>
              </tr>
	          <tr>
	            <td><strong>FECHA EMBARQUE:</strong></td>
	            <td colspan="2"><?php pinto_fecha('LSTfechaFE','',$LSTfechaFE);?></td>
	            </tr>
	          <tr>
	            <td><strong>FECHA LLEGADA:</strong></td>
	            <td colspan="2"><?php pinto_fecha('LSTfechaFLL','',$LSTfechaFLL);?></td>
	            </tr>
	          <tr>
	            <td><strong>ESTADO:</strong></td>
	            <td colspan="2"><strong>
	              <select name="LstEstadoBL" class="mini-button" id="LstEstadoBL" >
	                <option value="1" <?php if($LstEstadoBL==1){ echo 'selected';}?> >Produccion</option>
	                <option value="2" <?php if($LstEstadoBL==2){ echo 'selected';}?> >Embarcada</option>
	                <option value="3" <?php if($LstEstadoBL==3){ echo 'selected';}?> >En puerto</option>
	                <option value="4" <?php if($LstEstadoBL==4){ echo 'selected';}?> >Entregada</option>
	                <option value="5" <?php if($LstEstadoBL==5){ echo 'selected';}?> >Saldada</option>
	                </select>
	              </strong></td>
	            </tr>
	          <tr>
	            <td><strong>NOTAS:</strong></td>
	            <td colspan="2"><strong>
	              <textarea name="TXTNotaBL" cols="50" maxlength="150" id="TXTNotaBL" class="button"><?php echo $TXTNotaBL; ?></textarea>
	              </strong></td>
	            </tr>
	          <tr>
	            <td colspan="3">&nbsp;</td>
	            </tr>
	          <tr>
	            <td colspan="3"><div align="center"><span style="color: #000">
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
