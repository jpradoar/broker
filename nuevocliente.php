<?php
require_once("funciones.inc.php");
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

if($_POST){//SEGUNDOS POST
	$Xcod_clinte = trim($_GET['cod_cli']);
	$Xaccion	 = trim($_GET['accion']);
	
	if(strlen($Xcod_clinte)==0){
		$Xcod_clinte ="000";
	}
	
	if($_POST['BTNvolver']){//volver al menu
 		header ('location:index.php');
		exit();		
	}
	
	if($_POST['BTNnuecli']){//si creo un nuevo cliente
		
		$Xtodo_ok 		= true;
		$Xerror 		= "";
		$Xerror_TXTape	= "";
		$Xerror_TXTnom	= "";
		$ya_existe		= false;
		$Xerror_num 	= "";
		
		$TXTape 	= strtoupper($_POST['TXTape']);
		$TXTnom 	= strtoupper($_POST['TXTnom']);
		$TXTdni 	= $_POST['TXTdni'];
		$TXTcuil	= $_POST['TXTcuil'];
		$TXTdirper	= strtoupper($_POST['TXTdirper']);
		$TXTtelper	= $_POST['TXTtelper'];
		$TXTtelmov	= $_POST['TXTtelmov'];
		$TXTcodpos	= strtoupper($_POST['TXTcodpos']);
		
		$TXTcuilempre 		= $_POST['TXTcuilempre'];
		$TXTdirempre 		= strtoupper($_POST['TXTdirempre']);
		$TXTtelempre 		= $_POST['TXTtelempre'];
		$TXTcodposempre 	= strtoupper($_POST['TXTcodposempre']);
		$TXTtelinterno	 	= $_POST['TXTtelinterno'];

	//// CHEQUEO CUALES CONTIENEN DATOS ////								
		if(strlen($TXTape)==0){
			$Xtodo_ok = FALSE;
			$Xerror	= "DEBE AGREGAR UN APELLIDO";	
		}
		
		if(strlen($TXTnom)==0){
			$Xtodo_ok = FALSE;
			$Xerror	= "DEBE AGREGAR UN NOMBRE";	
		}		
		
		if(strlen($TXTdni)==0){
			$TXTdni = "";	
		}else{
			if(!is_numeric($TXTdni)){
				$Xtodo_ok = FALSE;
				$Xerror_num.= " DNI ";		
			}
		}

		if(strlen($TXTcuil)==0){
			$TXTcuil = "";	
		}else{	
			if(!is_numeric($TXTcuil)){
				$Xtodo_ok = FALSE;
				$Xerror_num.= " CUIL ";		
			}
		}
		
		if(strlen($TXTdirper)==0){
			$TXTdirper = "";	
		}

		if(strlen($TXTtelper)==0){
			$TXTtelper = "";	
		}else{
			if(!is_numeric($TXTtelper)){
				$Xtodo_ok = FALSE;
				$Xerror_num.= " TELEFONO PERSONAL ";		
			}
		}
		
		if(strlen($TXTtelmov)==0){
			$TXTtelmov = "";	
		}else{
			if(!is_numeric($TXTtelmov)){
				$Xtodo_ok = FALSE;
				$Xerror_num.= " CELULAR  ";		
			}
		}
		
		if(strlen($TXTcodpos)==0){
			$TXTcodpos = "";	
		}else{
			if(!is_numeric($TXTcodpos)){
				$Xtodo_ok = FALSE;
				$Xerror_num.= " CODIGO POSTAL ";		
			}
		}
		
		if(strlen($TXTcuilempre)==0){
			$TXTcuilempre = "";	
		}else{
			if(!is_numeric($TXTcuilempre)){
				$Xtodo_ok = FALSE;
				$Xerror_num.= " CUIL DE LA EMPRESA  ";		
			}
		}
		
		if(strlen($TXTdirempre)==0){
			$TXTdirempre = "";	
		}
		
		if(strlen($TXTtelempre)==0){
			$TXTtelempre = "";	
		}else{
			if(!is_numeric($TXTtelempre)){
				$Xtodo_ok = FALSE;
				$Xerror_num.= " TEL DE LA EMPRESA  ";		
			}
		}
		
		if(strlen($TXTcodposempre)==0){
			$TXTcodposempre = "";	
		}else{
			if(!is_numeric($TXTcodposempre)){
				$Xtodo_ok = FALSE;
				$Xerror_num.= " CODIGO POSTAL DE LA EMPRESA ";		
			}
		}
		
		if(strlen($TXTtelinterno)==0){
			$TXTtelinterno = "";	
		}else{
			if(!is_numeric($TXTtelinterno)){
				$Xtodo_ok = FALSE;
				$Xerror_num.= " TEL. INTERNO DE LA EMPRESA ";		
			}
		}
				
		if(strlen($Xerror_num)!=0){
			$Xerror_num.= " DEBE/DEBEN SER NUMERICO/NUMERICOS ";
		}
	//// FIN CHEQUEO CUALES CONTIENEN DATOS ////
			
		if($Xtodo_ok==true){#Si esta todo bien								
			$db  = conecto();
			$sql = " INSERT INTO clientes (ape_cli, nom_cli, dni, cuil, dir_per, tel_per, tel_movil, cp_per, cuil_empre, dir_empre, tel_empre, cp_empre, int_empre) VALUES ('".$TXTape."','".$TXTnom."', '".$TXTdni."', '".$TXTcuil."','".$TXTdirper."', '".$TXTtelper."', '".$TXTtelmov."', '".$TXTcodpos."', '".$TXTcuilempre."','".$TXTdirempre."', '".$TXTtelempre."', '".$TXTcodposempre."', '".$TXTtelinterno."') ";									
			$r   = mysqli_query($db, $sql);

				if ($r == false){
                        mysqli_close($db);
                        $error = "Error: (" . mysql_errno() . ") " . mysql_error().")";
                        //gestion_errores();
                 }
				 		$Xcod_clinte = mysqli_insert_id($db);//veo cual fue el ultimo registro ingresado..
                        mysqli_close($db);
			
			if($Xaccion!="crear"){
				echo "<script language='javascript'>
						 alert('El Registro a sido Creado');
						window.location.href='nuevocliente.php?cod_cli=".$Xcod_clinte."'; </script>";	
			}else{
				echo "<script language='javascript'>
						 alert('El Registro a sido Creado');
						window.location.href='nuevopresu.php?cod_cli=".$Xcod_clinte."'; </script>";			
			}
								
		}#Fin Si esta todo bien
	}#FIN ALTA
	
	if($_POST['BTNmodcli']){//si MODIFICO
	
		$Xtodo_ok 		= true;
		$Xerror 		= "";
		$Xerror_TXTape	= "";
		$Xerror_TXTnom	= "";
		$ya_existe		= false;
		
		$TXTape 	= strtoupper($_POST['TXTape']);
		$TXTnom 	= strtoupper($_POST['TXTnom']);
		$TXTdni 	= $_POST['TXTdni'];
		$TXTcuil	= $_POST['TXTcuil'];
		$TXTdirper	= strtoupper($_POST['TXTdirper']);
		$TXTtelper	= $_POST['TXTtelper'];
		$TXTtelmov	= $_POST['TXTtelmov'];
		$TXTcodpos	= strtoupper($_POST['TXTcodpos']);
		
		$TXTcuilempre 		= $_POST['TXTcuilempre'];
		$TXTdirempre 		= strtoupper($_POST['TXTdirempre']);
		$TXTtelempre 		= $_POST['TXTtelempre'];
		$TXTcodposempre 	= strtoupper($_POST['TXTcodposempre']);
		$TXTtelinterno	 	= $_POST['TXTtelinterno'];

		if(strlen($TXTape)==0){
			$Xtodo_ok = FALSE;
			$Xerror	= "DEBE AGREGAR UN APELLIDO";	
		}
		
		if(strlen($TXTnom)==0){
			$Xtodo_ok = FALSE;
			$Xerror	= "DEBE AGREGAR UN NOMBRE";	
		}		
		
		if(strlen($TXTdni)==0){
			$TXTdni = "";	
		}else{
			if(!is_numeric($TXTdni)){
				$Xtodo_ok = FALSE;
				$Xerror_num.= " DNI ";		
			}
		}

		if(strlen($TXTcuil)==0){
			$TXTcuil = "";	
		}else{	
			if(!is_numeric($TXTcuil)){
				$Xtodo_ok = FALSE;
				$Xerror_num.= " CUIL ";		
			}
		}
		
		if(strlen($TXTdirper)==0){
			$TXTdirper = "";	
		}

		if(strlen($TXTtelper)==0){
			$TXTtelper = "";	
		}else{
			if(!is_numeric($TXTtelper)){
				$Xtodo_ok = FALSE;
				$Xerror_num.= " TELEFONO PERSONAL ";		
			}
		}
		
		if(strlen($TXTtelmov)==0){
			$TXTtelmov = "";	
		}else{
			if(!is_numeric($TXTtelmov)){
				$Xtodo_ok = FALSE;
				$Xerror_num.= " CELULAR  ";		
			}
		}
		
		if(strlen($TXTcodpos)==0){
			$TXTcodpos = "";	
		}else{
			if(!is_numeric($TXTcodpos)){
				$Xtodo_ok = FALSE;
				$Xerror_num.= " CODIGO POSTAL ";		
			}
		}
		
		if(strlen($TXTcuilempre)==0){
			$TXTcuilempre = "";	
		}else{
			if(!is_numeric($TXTcuilempre)){
				$Xtodo_ok = FALSE;
				$Xerror_num.= " CUIL DE LA EMPRESA  ";		
			}
		}
		
		if(strlen($TXTdirempre)==0){
			$TXTdirempre = "";	
		}
		
		if(strlen($TXTtelempre)==0){
			$TXTtelempre = "";	
		}else{
			if(!is_numeric($TXTtelempre)){
				$Xtodo_ok = FALSE;
				$Xerror_num.= " TEL DE LA EMPRESA  ";		
			}
		}
		
		if(strlen($TXTcodposempre)==0){
			$TXTcodposempre = "";	
		}else{
			if(!is_numeric($TXTcodposempre)){
				$Xtodo_ok = FALSE;
				$Xerror_num.= " CODIGO POSTAL DE LA EMPRESA ";		
			}
		}
		
		if(strlen($TXTtelinterno)==0){
			$TXTtelinterno = "";	
		}else{
			if(!is_numeric($TXTtelinterno)){
				$Xtodo_ok = FALSE;
				$Xerror_num.= " TEL. INTERNO DE LA EMPRESA ";		
			}
		}
				
		if(strlen($Xerror_num)!=0){
			$Xerror_num.= " DEBE/DEBEN SER NUMERICO/NUMERICOS ";
		}
				
		if($Xtodo_ok==true){#Si esta todo bien								
			$db  = conecto();
			$sql = " UPDATE clientes SET 
					ape_cli = '".$TXTape."', 
					nom_cli = '".$TXTnom."',
					dni = '".$TXTdni."',
					cuil = '".$TXTcuil."',
					dir_per = '".$TXTdirper."',
					tel_per = '".$TXTtelper."',
					tel_movil = '".$TXTtelmov."',
					cp_per = '".$TXTcodpos."',
					cuil_empre = '".$TXTcuilempre."',
					dir_empre = '".$TXTdirempre."',
					tel_empre = '".$TXTtelempre."',
					cp_empre = '".$TXTcodposempre."',
					int_empre = '".$TXTtelinterno."' 
					where cod_cli = '".$Xcod_clinte."' ";	
													
			$r   = mysqli_query($db, $sql);

				if ($r == false){
                        mysqli_close($db);
                        $error = "Error: (" . mysql_errno() . ") " . mysql_error().")";
                        //gestion_errores();
                 }
                        mysqli_close($db);

			echo "<script language='javascript'>
					 alert('El Registro a sido Modificado');
					window.location.href='nuevocliente.php?cod_cli=".$Xcod_clinte."'; </script>";
											
		}#Fin Si esta todo bien
						
	}
	
	if($_POST['BTNdelcli']){//si ELIMINO
		$Xtodo_ok=true;
		
		if($Xtodo_ok==true){#Si esta todo bien	
			$db  = conecto();
			$sql = " DELETE FROM clientes where cod_cli = '".$Xcod_clinte."' ";	
				//echo $sql; exit();									
			$r   = mysqli_query($db, $sql);

				if ($r == false){
                        mysqli_close($db);
                        $error = "Error: (" . mysql_errno() . ") " . mysql_error().")";
                        //gestion_errores();
                 }
                        mysqli_close($db);
		
		echo "<script language='javascript'>
				 alert('El Registro a sido Eliminado');
				window.location.href='cliente.php'; </script>"; 
								
		}#Fin Si esta todo bien			
	}
	
}else{//PRIMER POST
	//Si vengo de una modificacion traigo los datos	
	$Xerror 		= "";
	$Xerror_TXTape	= "";
	$Xerror_TXTnom	= "";
	
	$Xcod_clinte = trim($_GET['cod_cli']);

	if(strlen($Xcod_clinte)==0){
		$Xcod_clinte ="000";
	}
	
	if($Xcod_clinte!="000"){
		
	$db1  = conecto();
	$sql1 = " SELECT * FROM clientes where cod_cli = '".$Xcod_clinte."' ";	
												
	$r1   = mysqli_query($db1, $sql1);

	if ($r1 == false){
    	mysqli_close($db1);
        $error = "Error: (" . mysql_errno() . ") " . mysql_error().")";
        //gestion_errores();
    }
        mysqli_close($db1);

		while ($arr1 = mysqli_fetch_array($r1))		
		{		
			$TXTape 	= $arr1['ape_cli'];
			$TXTnom 	= $arr1['nom_cli'];
			$TXTdni 	= $arr1['dni'];
			$TXTcuil	= $arr1['cuil'];
			$TXTdirper	= $arr1['dir_per'];
			$TXTtelper	= $arr1['tel_per'];
			$TXTtelmov	= $arr1['tel_movil'];
			$TXTcodpos	= $arr1['cp_per'];
			$TXTcuilempre 	= $arr1['cuil_empre'];
			$TXTdirempre 	= $arr1['dir_empre'];
			$TXTtelempre 	= $arr1['tel_empre'];
			$TXTcodposempre = $arr1['cp_empre'];
			$TXTtelinterno 	= $arr1['int_empre'];
		}
		if(strlen($TXTape)==0){$TXTape = "";}
		if(strlen($TXTnom)==0){$TXTnom = "";}
		if(strlen($TXTdni)==0){$TXTdni = "";}
		if($TXTdni==0){$TXTdni = "";}
		if(strlen($TXTcuil)==0){$TXTcuil = "";}
		if($TXTcuil==0){$TXTcuil = "";}
		if(strlen($TXTdirper)==0){$TXTdirper = "";}
		if(strlen($TXTtelper)==0){$TXTtelper = "";}
		if($TXTtelper==0){$TXTtelper = "";}
		if(strlen($TXTtelmov)==0){$TXTtelmov = "";}
		if($TXTtelmov==0){$TXTtelmov = "";}
		if(strlen($TXTcodpos)==0){$TXTcodpos = "";}
		if($TXTcodpos==0){$TXTcodpos = "";}
		if(strlen($TXTcuilempre)==0){$TXTcuilempre = "";}
		if($TXTcuilempre==0){$TXTcuilempre = "";}
		if(strlen($TXTdirempre)==0){$TXTdirempre = "";}
		if(strlen($TXTtelempre)==0){$TXTtelempre = "";}
		if($TXTtelempre==0){$TXTtelempre = "";}
		if(strlen($TXTcodposempre)==0){$TXTcodposempre = "";}
		if($TXTcodposempre==0){$TXTcodposempre = "";}
		if(strlen($TXTtelinterno)==0){$TXTtelinterno = "";}
		if($TXTtelinterno==0){$TXTtelinterno = "";}
	}else{
		$TXTape 	= "";
		$TXTnom 	= "";
		$TXTdni 	= "";
		$TXTcuil	= "";
		$TXTdirper	= "";
		$TXTtelper	= "";
		$TXTtelmov	= "";;
		$TXTcodpos	= "";
		$TXTcuilempre 	= "";
		$TXTdirempre 	= "";
		$TXTtelempre 	= "";
		$TXTcodposempre = "";
		$TXTtelinterno 	= "";	
		
		}
	
}//FIN POST
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
    
 </head>
<body>
	<div class="logo">_%%_empresanombre_%%_</div>
	<div id="page-wrap"> 
 	<form action="" method="post" name="form1" >   
   <?php include 'menu.php'; ?>

	<p>USUARIO: <?php echo $Xnombre; ?></p>
    <table class="sombra">
		<thead>
		<tr>
			<th colspan="4" align="center"><div align="center">NUEVO CLIENTE</div></th>
		  </tr>
		</thead>
		<tbody>     
		 <tr>
		   <td colspan="2"><div align="center">APELLIDO<span style="color: #000">
		     <label for="TXTape">:</label>
		     <input name="TXTape" type="text" class="button" id="TXTape" maxlength="40" <?php echo 'value="'.$TXTape.'"'; ?>>
		     <?php if(strlen($Xerror!=0)) echo "*";?>
		     </span>
	       </div></td>
			<td colspan="4"><div align="center">NOMBRES
			  <label for="TXTnom">:</label>
              <input name="TXTnom" type="text" class="button" id="TXTnom" maxlength="40" <?php echo 'value="'.$TXTnom.'"'; ?>>
		      <span style="color: #000">
		      <?php if(strlen($Xerror!=0)) echo "*";?>
		      </span></div></td>
		  </tr>
         <tr>
			<td colspan="4"><?php echo '<div align="center" style="color:red; font-weight: bold;">'.$Xerror." ".$Xerror_num.'</div>'; ?></td>
		  </tr>
		 <tr>
		   <td colspan="4"><div align="center"><span style="color: #000">DATOS DE CLIENTE</span></div></td>
	      </tr>          
         <tr>
           <td width="21%">DNI<span style="color: #000">
           <label for="TXTape3">:</label>
           </span></td>
           <td width="30%"><div align="center"><span style="color: #000">
             <input name="TXTdni" type="text" class="button" id="TXTdni" maxlength="8" <?php echo 'value="'.$TXTdni.'"'; ?>>
           </span> </div></td>
           <td width="21%">CUIL
           <label for="textfield3">:</label></td>
           <td width="28%"><div align="center">
             <input name="TXTcuil" type="text" class="button" id="TXTcuil" maxlength="11" <?php echo 'value="'.$TXTcuil.'"'; ?>>
           </div></td>
         </tr>
         <tr>
           <td>DIRECCION PERSONAL<span style="color: #000">
           <label for="TXTape4">:</label>
           </span></td>
           <td><div align="center"><span style="color: #000">
             <input name="TXTdirper" type="text" class="button" id="TXTdirper" maxlength="80" <?php echo 'value="'.$TXTdirper.'"'; ?>>
           </span></div></td>
           <td>TELEFONO PERSONAL
           <label for="textfield4">:</label></td>
           <td><div align="center">
             <input name="TXTtelper" type="text" class="button" id="TXTtelper" maxlength="20" <?php echo 'value="'.$TXTtelper.'"'; ?>>
           </div></td>
          </tr>
         <tr>
           <td>TELEFONO MOVIL <span style="color: #000">
           <label for="TXTape5">:</label>
           </span></td>
           <td><div align="center"><span style="color: #000">
             <input name="TXTtelmov" type="text" class="button" id="TXTtelmov" maxlength="24" <?php echo 'value="'.$TXTtelmov.'"'; ?>>
           </span></div></td>
           <td>CODIGO POSTAL <span style="color: #000">
           <label for="TXTape7">:</label>
           </span></td>
           <td><div align="center"><span style="color: #000">
             <input name="TXTcodpos" type="text" class="button" id="TXTcodpos" maxlength="40" <?php echo 'value="'.$TXTcodpos.'"'; ?>>
           </span></div></td>
          </tr>
         <tr>
           <td colspan="4">&nbsp;</td>
         </tr>
         <tr>
           <td colspan="4"><div align="center"><span style="color: #000">DATOS DE LA EMPRESA</span></div></td>
         </tr>
         <tr>
           <td width="21%">CUIL
           <label for="textfield6">:</label></td>
           <td width="30%"><div align="center">
             <input name="TXTcuilempre" type="text" class="button" id="TXTcuilempre" maxlength="11" <?php echo 'value="'.$TXTcuilempre.'"'; ?>>
           </div></td>
           <td width="21%">&nbsp;</td>
           <td width="28%">&nbsp;</td>
          </tr>
         <tr>
           <td>DIRECCION EMPRESA<span style="color: #000">
             <label for="TXTape4">:</label>
           </span></td>
           <td><div align="center"><span style="color: #000">
             <input name="TXTdirempre" type="text" class="button" id="TXTdirempre" maxlength="150" <?php echo 'value="'.$TXTdirempre.'"'; ?>>
           </span></div></td>
           <td>TELEFONO EMPRESA
           <label for="textfield4">:</label></td>
           <td><div align="center">
             <input name="TXTtelempre" type="text" class="button" id="TXTtelempre" maxlength="20" <?php echo 'value="'.$TXTtelempre.'"'; ?>>
           </div></td>
          </tr>
		 <tr>
		   <td>CODIGO POSTAL <span style="color: #000">
		     <label for="TXTape5">:</label>
		     </span></td>
		   <td><div align="center"><span style="color: #000">
		     <input name="TXTcodposempre" type="text" class="button" id="TXTcodposempre" maxlength="40" <?php echo 'value="'.$TXTcodposempre.'"'; ?>>
		   </span></div></td>
		   <td>TELEFONO INTERNO
		     <label for="textfield5">:</label></td>
		   <td><div align="center">
		     <input name="TXTtelinterno" type="text" class="button" id="TXTtelinterno" maxlength="8" <?php echo 'value="'.$TXTtelinterno.'"'; ?>>
	       </div></td>
	      </tr>
		 <tr>
		   <td colspan="4">&nbsp;</td>
	      </tr>

		 <tr>
		   <td colspan="4"><div align="center"><span style="color: #000">
           <?php if ($Xcod_clinte !="000"){
			   //if (strlen($Xcod_clinte) !=0){
			   		echo '<input type="submit" name="BTNmodcli" id="BTNmodcli" class="button" value="MODIFICAR CLIENTE"><input type="submit" name="BTNdelcli" id="BTNdelcli" class="button" value="ELIMINAR CLIENTE">';
			   
			   	 }else{
					echo '<input type="submit" name="BTNnuecli" id="BTNnuecli" class="button" value="ALTA CLIENTE">';
				} ?>
		     

		   </span><span style="color: #000">
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
