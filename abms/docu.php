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
	// PL - IL  - LP 
	if ($DEL == "PL"){
		$CampoDel = "packing_list";
	}
	if ($DEL == "IE"){
		$CampoDel = "ins_emb";
	}
	if ($DEL == "LP"){
		$CampoDel = "load_pic_doc";
	}
			
		$db5  = conecto();
		$sql5 = " update documentaciones set ".$CampoDel."  = '' where cod_ord = ".$cod." ";
		//echo $sql5;exit();
		$r5   = mysqli_query($db5, $sql5);

		if ($r5 == false){
	    	mysqli_close($db5);
	        $error = "Error: (" . mysql_errno() . ") " . mysql_error().")";
	        //gestion_errores();
	    }
	      mysqli_close($db5);
	
}
		

if($_POST){//SEGUNDOS POST
	
	$cod = $_GET['cod'];
	$accion = $_GET['accion'];
	
	if($_POST['BTNALTA']){
		
		$Xtodo_ok 		= true;
		$Xerror_num 	= "";
 
		$RDOIP 			= trim($_POST['RDOIP']);
		$FILEPacLis		= $_FILES['FILEPacLis']['name'];
		$FILEInsEmb		= $_FILES['FILEInsEmb']['name'];
		$FILELoadPic	= $_FILES['FILELoadPic']['name'];
		 		
		if(strlen($RDOIP)==0){$RDOIP = "";}
		if(strlen($FILEPacLis)==0){$FILEPacLis = "";}
		if(strlen($FILEInsEmb)==0){$FILEInsEmb = "";}
		if(strlen($FILELoadPic)==0){$FILELoadPic = "";}

		
		if($Xtodo_ok==true){
				
			$db2  = conecto(); //  guardo los datos en la base correspondiente  ///////////////
			$sql2 = " INSERT INTO documentaciones (cod_ord, ins_pic_doc, packing_list, ins_emb,  load_pic_doc) VALUES ('".$cod."','".$RDOIP."','".$FILEPacLis."','".$FILEInsEmb."','".$FILELoadPic."') ";
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
				
//########################### ARCHIVO DE FILEPacLis ############################### 
			$FILEPacLis	= $_FILES['FILEPacLis']['name'];
			$tmp_FILEPacLis = $_FILES['FILEPacLis']['tmp_name'];
			$errorFILEPacLis = $_FILES['FILEPacLis']['error'];
			suboarchivos($estructura,$FILEPacLis,$tmp_FILEPacLis,$errorFILEPacLis,$cod); 
			
				$FILEInsEmb	= $_FILES['FILEInsEmb']['name'];
				$tmp_FILEInsEmb = $_FILES['FILEInsEmb']['tmp_name'];
				$errorFILEInsEmb = $_FILES['FILEInsEmb']['error'];
				suboarchivos($estructura,$FILEInsEmb,$tmp_FILEInsEmb,$errorFILEInsEmb,$cod); 
				
					$FILELoadPic	= $_FILES['FILELoadPic']['name'];
					$tmp_FILELoadPic = $_FILES['FILELoadPic']['tmp_name'];
					$errorFILELoadPic = $_FILES['FILELoadPic']['error'];
					suboarchivos($estructura,$FILELoadPic,$tmp_FILELoadPic,$errorFILELoadPic,$cod); 		
		
 			}else{//Si la carpeta existe, tiro solo los datos dentro.

			$FILEPacLis	= $_FILES['FILEPacLis']['name'];
			$tmp_FILEPacLis = $_FILES['FILEPacLis']['tmp_name'];
			$errorFILEPacLis = $_FILES['FILEPacLis']['error'];
			suboarchivos($estructura,$FILEPacLis,$tmp_FILEPacLis,$errorFILEPacLis,$cod); 
			
				$FILEInsEmb	= $_FILES['FILEInsEmb']['name'];
				$tmp_FILEInsEmb = $_FILES['FILEInsEmb']['tmp_name'];
				$errorFILEInsEmb = $_FILES['FILEInsEmb']['error'];
				suboarchivos($estructura,$FILEInsEmb,$tmp_FILEInsEmb,$errorFILEInsEmb,$cod); 
				
					$FILELoadPic	= $_FILES['FILELoadPic']['name'];
					$tmp_FILELoadPic = $_FILES['FILELoadPic']['tmp_name'];
					$errorFILELoadPic = $_FILES['FILELoadPic']['error'];
					suboarchivos($estructura,$FILELoadPic,$tmp_FILELoadPic,$errorFILELoadPic,$cod);   
								
				 }//FIN si salio todo genial				

		echo "<script language='javascript'>
				 alert('El Registro a sido Creado');
				window.location.href='../veoordenes.php?cod=$cod'; </script>"; 	
		}
	}// FIN ALTA 
	
	

	if($_POST['BTNMOD']){
		
		$Xtodo_ok 		= true;
		$Xerror_num 	= "";

		$RDOIP 			= trim($_POST['RDOIP']);
		$FILEPacLis		= $_FILES['FILEPacLis']['name'];
		$FILEInsEmb		= $_FILES['FILEInsEmb']['name'];
		$FILELoadPic	= $_FILES['FILELoadPic']['name'];
		
	    $PacLis 	= $_POST['PacLis'];
		$InsEmb 	= $_POST['InsEmb'];
		$LoadPic 	= $_POST['LoadPic'];
	
		if(strlen($RDOIP)==0){$RDOIP = "";}
		if(strlen($FILEPacLis)==0){$FILEPacLis = "";}
		if(strlen($FILEInsEmb)==0){$FILEInsEmb = "";}
		if(strlen($FILELoadPic)==0){$FILELoadPic = "";}

		if(strlen($PacLis)==0){$PacLis = "";}
		if(strlen($InsEmb)==0){$InsEmb = "";}
		if(strlen($LoadPic)==0){$LoadPic = "";}
		
		$PL		 ="";
		if(strlen($FILEPacLis)!=0){
				 $PL =	$FILEPacLis;
				}
		
		if(strlen($PacLis)!=0){
				 $PL =	$PacLis;
				}


		$IE		 ="";
		if(strlen($FILEInsEmb)!=0){
				 $IE =	$FILEInsEmb;
				}
		
		if(strlen($InsEmb)!=0){
				 $IE =	$InsEmb;
				}
				
		$LP		 ="";
		if(strlen($FILELoadPic)!=0){
				 $LP =	$FILELoadPic;
				}
		
		if(strlen($LoadPic)!=0){
				 $LP =	$LoadPic;
				}
		
		if($Xtodo_ok==true){

		$db3  = conecto();
		$sql3 = " update documentaciones set ins_pic_doc  = '".$RDOIP."', packing_list  = '".$PL."', ins_emb  = '".$IE."',	load_pic_doc  = '".$LP."' where cod_ord = ".$cod." ";
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
				
//########################### ARCHIVO DE DESPACHO ############################### 
			$FILEPacLis	= $_FILES['FILEPacLis']['name'];
			$tmp_FILEPacLis = $_FILES['FILEPacLis']['tmp_name'];
			$errorFILEPacLis = $_FILES['FILEPacLis']['error'];
			suboarchivos($estructura,$FILEPacLis,$tmp_FILEPacLis,$errorFILEPacLis,$cod); 
			
				$FILEInsEmb	= $_FILES['FILEInsEmb']['name'];
				$tmp_FILEInsEmb = $_FILES['FILEInsEmb']['tmp_name'];
				$errorFILEInsEmb = $_FILES['FILEInsEmb']['error'];
				suboarchivos($estructura,$FILEInsEmb,$tmp_FILEInsEmb,$errorFILEInsEmb,$cod); 
				
					$FILELoadPic	= $_FILES['FILELoadPic']['name'];
					$tmp_FILELoadPic = $_FILES['FILELoadPic']['tmp_name'];
					$errorFILELoadPic = $_FILES['FILELoadPic']['error'];
					suboarchivos($estructura,$FILELoadPic,$tmp_FILELoadPic,$errorFILELoadPic,$cod); 		
		
 			}else{//Si la carpeta existe, tiro solo los datos dentro.

			$FILEPacLis	= $_FILES['FILEPacLis']['name'];
			$tmp_FILEPacLis = $_FILES['FILEPacLis']['tmp_name'];
			$errorFILEPacLis = $_FILES['FILEPacLis']['error'];
			suboarchivos($estructura,$FILEPacLis,$tmp_FILEPacLis,$errorFILEPacLis,$cod); 
			
				$FILEInsEmb	= $_FILES['FILEInsEmb']['name'];
				$tmp_FILEInsEmb = $_FILES['FILEInsEmb']['tmp_name'];
				$errorFILEInsEmb = $_FILES['FILEInsEmb']['error'];
				suboarchivos($estructura,$FILEInsEmb,$tmp_FILEInsEmb,$errorFILEInsEmb,$cod); 
				
					$FILELoadPic	= $_FILES['FILELoadPic']['name'];
					$tmp_FILELoadPic = $_FILES['FILELoadPic']['tmp_name'];
					$errorFILELoadPic = $_FILES['FILELoadPic']['error'];
					suboarchivos($estructura,$FILELoadPic,$tmp_FILELoadPic,$errorFILELoadPic,$cod);  
								
				 }//FIN si salio todo genial

		echo "<script language='javascript'>
				 alert('El Registro a sido Modificado');
				window.location.href='../veoordenes.php?cod=$cod'; </script>"; 	
	}
}
	
	if($_POST['BTNELI']){

		$db4  = conecto();
		$sql4 = " delete from documentaciones where cod_ord = ".$cod." ";
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
}else{ // PRIMER POST

	$Xerror = "";
	$cod 	= $_GET['cod'];
	$accion = $_GET['accion'];
	
		$RDOIP 			= "";
		$FILEPacLis		= "";
		$FILEInsEmb		= "";
		$FILELoadPic	= "";
		$Xerror_num		= "";
			
	if(strlen($cod)!=0){#SI ES ELIMINAR O MODIFICAR	
		
		#ADELANTOCLIENTE
		$db1  = conecto();
		$sql1 = "select * from documentaciones where cod_ord = ".$cod." ";
		$r1   = mysqli_query($db1, $sql1);
	
		if ($r1 == false){
	    	mysqli_close($db1);
	        $error = "Error: (" . mysql_errno() . ") " . mysql_error().")";
	        //gestion_errores();
	    }
	    	mysqli_close($db1);
			
		while ($arr1 = mysqli_fetch_array($r1))		
		{
			$RDOIP 			= trim($arr1['ins_pic_doc']);
			$FILEPacLis		= trim($arr1['packing_list']);
			$FILEInsEmb		= trim($arr1['ins_emb']);
			$FILELoadPic		= trim($arr1['load_pic_doc']);																				
		}				
				
		if(strlen($RDOIP)==0){$RDOIP = "";}
		if(strlen($FILEPacLis)==0){$FILEPacLis = "";}
		if(strlen($FILEInsEmb)==0){$FILEInsEmb = "";}
		if(strlen($FILELoadPic)==0){$FILELoadPic = "";}
		

		#FIN 
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
 <form action="" method="post" name="form1" enctype="multipart/form-data" >   
    <?php include 'menu.php'; ?>

    <div class="caption">_%%_empresanombre_%%_.</div> 
	<p>USUARIO: <?php echo $Xnombre; ?></p>
	<table class="sombra">
      <thead>
	          <tr>
	            <th colspan="4" align="center"><div align="center">DOCUMENTOS</div></th>
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
	            <td width="28%"><strong>INSPECTION PICTURES:</strong></td>
	            <td colspan="2"><strong>SI
                    <input name="RDOIP" type="radio" class="button" id="RDOIP" value="SI" <?php if($RDOIP=="S"){ echo 'checked';}?>>
                </strong><strong> NO
                <input name="RDOIP" type="radio" class="button" id="RDOIP" value="NO" <?php if($RDOIP=="N"){ echo 'checked';}?>>
                </strong></td>
	            <td width="9%">&nbsp;</td>
              </tr>
	          <tr>
	            <td><strong>PACKING LIST:</strong></td>
                <td colspan="2"><div align="left"><span style="color: #000">
	              <?php if(strlen($FILEPacLis)!=0){?>	  	
                    <b>Nombre del archivo:</b> <input type="text" value="<?php echo $FILEPacLis; ?>" name="PacLis" id="PacLis"  class="button">
                  <?php } else { ?>
				  <input name="FILEPacLis" type="file" id="FILEPacLis" title="SELECCIONE.." class="button" style="width: 75%"></span></div></td>
				 <?php } ?></td>
	            	<td><?php 	
							if(strlen($FILEPacLis)!=0){?>
								<a href="<?php echo 'docu.php?accion=MOD&cod='.$cod.'&DEL=PL'; ?>"><button class="button" type="button">Eliminar</button></a>     
							<?php }?>
					</td>
	            </tr>
	          <tr>
	            <td><strong>INSTRUCCIONES DE EMBARQUE:</strong></td>
	            <td colspan="2"><div align="left"><span style="color: #000">
	              <?php if(strlen($FILEInsEmb)!=0){
				  	echo '<b>Nombre del archivo:</b>'.'<input type="text" value="'.$FILEInsEmb.'" name="InsEmb" id="InsEmb" class="button">'; 
				  } else { ?>
				  <input name="FILEInsEmb" type="file" id="FILEInsEmb" title="SELECCIONE.." class="button" style="width: 75%">
                </span></div></td>
				 <?php } ?>
	            	<td><?php 	
							if(strlen($FILEInsEmb)!=0){?>

								<a href="<?php echo 'docu.php?accion=MOD&cod='.$cod.'&DEL=IE'; ?>"><button class="button" type="button">Eliminar
                                    </button></a>
							           
							<?php }?>
					</td>
              </tr>
	          <tr>
	            <td><strong>LOADING PICTURES:</strong></td>
	            <td colspan="2"><div align="left"><span style="color: #000">
	              <?php if(strlen($FILELoadPic)!=0){
				  	echo '<b>Nombre del archivo:</b>'.'<input type="text" value="'.$FILELoadPic.'" name="LoadPic" id="LoadPic" class="button">'; 
				  } else { ?>
				  <input name="FILELoadPic" type="file" id="FILELoadPic" title="SELECCIONE.." class="button" style="width: 75%">
                </span></div></td>
				 <?php } ?>
	            	<td><?php 	
							if(strlen($FILELoadPic)!=0){?>

								<a href="<?php echo 'docu.php?accion=MOD&cod='.$cod.'&DEL=LP'; ?>"><button class="button" type="button">Eliminar
                                    </button></a>
							           
							<?php }?>
					</td>
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
