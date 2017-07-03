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
 


if($_POST){//SEGUNDOS POST

	$cod 	= trim($_GET['cod']);
	
	if(strlen($cod)==0){
		$cod="";
	}
	
	if($_POST['BTNcrea']){

		$Xtodo_ok 		= true;
		$Xerror_num 	= "";
		     		
		$TXTNomEle 		= strtoupper(trim($_POST['TXTNomEle']));
		$TXTCodBsAs 	= trim($_POST['TXTCodBsAs']);
		$TXTCodCh 		= trim($_POST['TXTCodCh']);
		$TXTDesc 		= trim($_POST['TXTDesc']);
		$TXTPeso 		= trim($_POST['TXTPeso']);
		$TXTAnch 		= trim($_POST['TXTAnch']);
		$TXTCantiMax 	= trim($_POST['TXTCantiMax']);
		$TXTNotas 		= trim($_POST['TXTNotas']);
		
		if(strlen($TXTNomEle)==0)$TXTNomEle="";
		if(strlen($TXTCodBsAs)==0)$TXTCodBsAs="";
		if(strlen($TXTCodCh)==0)$TXTCodCh="";
		if(strlen($TXTDesc)==0)$TXTDesc="";
		if(strlen($TXTPeso)==0)$TXTPeso="";
		if(strlen($TXTAnch)==0)$TXTAnch="";
		if(strlen($TXTCantiMax)==0)$TXTCantiMax="";
		if(strlen($TXTNotas)==0)$TXTNotas="";


		#VALIDACIONES
		if(strlen($TXTPeso)==0){
			$TXTPeso = "";	
		}else{
			if(!is_numeric($TXTPeso)){
				$Xtodo_ok = FALSE;
				$Xerror_num.= " PESO ";		
			}
		}

		if(strlen($TXTAnch)==0){
			$TXTAnch = "";	
		}else{
			if(!is_numeric($TXTAnch)){
				$Xtodo_ok = FALSE;
				$Xerror_num.= " ANCHO ";		
			}
		}

		if(strlen($TXTCantiMax)==0){
			$TXTCantiMax = "";	
		}else{
			if(!is_numeric($TXTCantiMax)){
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
		$sql2 = " INSERT INTO elementoscot 
				(nom_ele_cot, cod_ele_ba, cod_ele_ch, des_ele_cot, peso_ele_cot, ancho_ele_cot, cant_max_cot, notas) 
				VALUES 
				('".$TXTNomEle."','".$TXTCodBsAs."','".$TXTCodCh."','".$TXTDesc."','".$TXTPeso."','".$TXTAnch."','".$TXTCantiMax."','".$TXTNotas."') ";
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
				window.location.href='veoelecotiza.php'; </script>"; 
		}#Si esta todo bien
	}

	if($_POST['BTNmod']){
		echo 2;
		$Xtodo_ok 		= true;
		$Xerror_num 	= "";
				
		$TXTNomEle 		= strtoupper(trim($_POST['TXTNomEle']));
		$TXTCodBsAs 	= trim($_POST['TXTCodBsAs']);
		$TXTCodCh 		= trim($_POST['TXTCodCh']);
		$TXTDesc 		= trim($_POST['TXTDesc']);
		$TXTPeso 		= trim($_POST['TXTPeso']);
		$TXTAnch 		= trim($_POST['TXTAnch']);
		$TXTCantiMax 	= trim($_POST['TXTCantiMax']);
		$TXTNotas 		= trim($_POST['TXTNotas']);
		
		if(strlen($TXTNomEle)==0)$TXTNomEle="";
		if(strlen($TXTCodBsAs)==0)$TXTCodBsAs="";
		if(strlen($TXTCodCh)==0)$TXTCodCh="";
		if(strlen($TXTDesc)==0)$TXTDesc="";
		if(strlen($TXTPeso)==0)$TXTPeso="";
		if(strlen($TXTAnch)==0)$TXTAnch="";
		if(strlen($TXTCantiMax)==0)$TXTCantiMax="";
		if(strlen($TXTNotas)==0)$TXTNotas="";


		#VALIDACIONES
		if(strlen($TXTPeso)==0){
			$TXTPeso = "";	
		}else{
			if(!is_numeric($TXTPeso)){
				$Xtodo_ok = FALSE;
				$Xerror_num.= " PESO ";		
			}
		}

		if(strlen($TXTAnch)==0){
			$TXTAnch = "";	
		}else{
			if(!is_numeric($TXTAnch)){
				$Xtodo_ok = FALSE;
				$Xerror_num.= " ANCHO ";		
			}
		}

		if(strlen($TXTCantiMax)==0){
			$TXTCantiMax = "";	
		}else{
			if(!is_numeric($TXTCantiMax)){
				$Xtodo_ok = FALSE;
				$Xerror_num.= " CANTIDAD ";		
			}
		}

												
		if(strlen($Xerror_num)!=0){
			$Xerror_num.= " DEBE/DEBEN SER NUMERICO/NUMERICOS ";
		}		
		
		if($Xtodo_ok==true){#Si esta todo bien	
			echo 1;
			
		$db3  = conecto();
		$sql3 = " update elementoscot set 
					nom_ele_cot  = '".$TXTNomEle."',
					cod_ele_ba  = '".$TXTCodBsAs."',
					cod_ele_ch  = '".$TXTCodCh."',
					des_ele_cot  = '".$TXTDesc."',
					peso_ele_cot  = '".$TXTPeso."',
					ancho_ele_cot  = '".$TXTAnch."',
					cant_max_cot  = '".$TXTCantiMax."',
					notas = '".$TXTNotas."'								
					where cod_ele_cot = ".$cod." ";

												
		$r3   = mysqli_query($db3, $sql3);

		if ($r3 == false){
	    	mysqli_close($db3);
	        $error = "Error: (" . mysql_errno() . ") " . mysql_error().")";
	        //gestion_errores();
	    }
	      mysqli_close($db3);
		  
		echo "<script language='javascript'>
				 alert('El Registro a sido Modificado');
				window.location.href='veoelecotiza.php'; </script>"; 		  				
		}
	}
	
	if($_POST['BTNelimina']){

		$db4  = conecto();
		$sql4 = " delete from elementoscot where cod_ele_cot = ".$cod." ";
		$r4   = mysqli_query($db4, $sql4);

		if ($r4 == false){
	    	mysqli_close($db4);
	        $error = "Error: (" . mysql_errno() . ") " . mysql_error().")";
	        //gestion_errores();
	    }
	      mysqli_close($db4);
		  
		echo "<script language='javascript'>
				 alert('El Registro a sido Eliminado');
				window.location.href='veoelecotiza.php'; </script>"; 	
	}
		
	if($_POST['BTNvolver']){//volver al menu
 		header ('location:veoelecotiza.php');
		exit();		
	}	
		
}

	$cod 	 = trim($_GET['cod']);
	//Si vengo de una modificacion o eliminacion traigo los datos	
      
	//FORMATEO LAS VARIABLES QUE VOY A UTILIZAR
	$TXTNomEle 		= "";
	$TXTCodBsAs 	= "";
	$TXTCodCh 		= "";
	$TXTDesc 		= "";
	$TXTPeso 		= "";
	$TXTAnch 		= "";
	$TXTCantiMax 	= "";
	$TXTNotas 		= "";
	
	$Xerror 		= "";
	
			
	if(strlen($cod)!=0){
		#SI ES ELIMINAR O MODIFICAR	
	
		$db  = conecto();
		$sql = " select * from elementoscot where cod_ele_cot = '".$cod."' ";
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
			$cod      		= trim($arr['cod_ele_cot']);
			$TXTNomEle 		= trim($arr['nom_ele_cot']);
			$TXTCodBsAs 	= trim($arr['cod_ele_ba']);
			$TXTCodCh 		= trim($arr['cod_ele_ch']);
			$TXTDesc 		= trim($arr['des_ele_cot']);
			$TXTPeso 		= trim($arr['peso_ele_cot']);
			$TXTAnch 		= trim($arr['ancho_ele_cot']);
			$TXTCantiMax 	= trim($arr['cant_max_cot']);
			$TXTNotas 		= trim($arr['notas']);			
		}
		
		if(strlen($TXTNomEle)==0)$TXTNomEle="";
		if(strlen($TXTCodBsAs)==0)$TXTCodBsAs="";
		if(strlen($TXTCodCh)==0)$TXTCodCh="";
		if(strlen($TXTDesc)==0)$TXTDesc="";
		if(strlen($TXTPeso)==0)$TXTPeso="";
		if(strlen($TXTAnch)==0)$TXTAnch="";
		if(strlen($TXTCantiMax)==0)$TXTCantiMax="";
		if(strlen($TXTNotas)==0)$TXTNotas="";
		  
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
 </head>
<body>
	<div class="logo">_%%_empresanombre_%%_</div>
	<div id="page-wrap"> 
 	<form action="" method="post" name="form4" enctype="multipart/form-data" >    
    <?php include 'menu.php';?>
    <table class="sombra">
		<thead>
		<tr>
			<th width="60" colspan="4" align="center"><div align="center">ARTICULOS COTIZACION</div></th>
		  </tr>
		</thead>
		<tbody>
		 <tr>
		   <td colspan="4"><?php echo '<div align="center" style="color:red; font-weight: bold;">'.$Xerror." ".$Xerror_num.'</div>'; ?></td>
	      </tr>
		 <tr>
		   <td width="25%"><strong>Nombre del Elemento :</strong></td>
		   <td colspan="3"><strong><span style="color: #000">
		     <input name="TXTNomEle" type="text" class="button" id="TXTNomEle" size="60" maxlength="100" value="<?php echo $TXTNomEle; ?>">
		   </span></strong></td>
	      </tr>
		 <tr>
		   <td width="60"><strong>Codigo en Buenos Aires</strong></td>
		   <td width="25%"><strong>
	        <input name="TXTCodBsAs" type="text" class="button" id="TXTCodBsAs" size="11" value="<?php echo $TXTCodBsAs; ?>">
		   </strong></td>
		   <td><strong>Codigo en China:</strong></td>
		   <td><strong>
		     <input name="TXTCodCh" type="text" class="button" id="TXTCodCh" size="11" value="<?php echo $TXTCodCh; ?>">
		   </strong></td>
	      </tr>
		 <tr>
		   <td><strong>Descripcion:</strong></td>
		   <td colspan="3"><strong>
	        <input name="TXTDesc" type="text" class="button" id="TXTDesc" value="<?php echo $TXTDesc; ?>" size="60" maxlength="100">
		   </strong></td>
	      </tr>
		 <tr>
		   <td><strong>Peso:</strong></td>
		   <td><strong>
	        <input name="TXTPeso" type="text" id="TXTPeso" maxlength="15" class="button" value="<?php echo $TXTPeso; ?>">
		   </strong></td>
		   <td><strong>Ancho:</strong></td>
		   <td><strong>
	        <input name="TXTAnch" type="text" id="TXTAnch" maxlength="15" class="button" value="<?php echo $TXTAnch; ?>">
		   </strong></td>
	      </tr>
		 <tr>
		   <td><strong>Cantidad Maxima por Contenedor:</strong></td>
		   <td colspan="3"><strong>
	        <input name="TXTCantiMax" type="text" id="TXTCantiMax" maxlength="11" class="button" value="<?php echo $TXTCantiMax; ?>">
	        Kg.
		   </strong></td>
	      </tr>
		 <tr>
		   <td><strong>Notas:</strong></td>
		   <td colspan="3"><textarea name="TXTNotas" cols="80" rows="6" class="button" id="TXTNotas" value="<?php echo $TXTNotas; ?>"></textarea></td>
	      </tr>
		 <tr>
		   <td colspan="4">&nbsp;</td>
	      </tr>
		 <tr>
		   <td colspan="4"><div align="center"><span style="color: #000">
           <?php 
		   		if(strlen($cod)==0){
					echo '<input type="submit" name="BTNcrea" id="BTNcrea" class="button" value="CREAR ARTICULO">';
				}else{
					// if($est_accion!="disabled"){
					echo '<input type="submit" name="BTNmod" id="BTNmod" class="button" value="MODIFICAR COTIZACION">';
					echo '<input type="submit" name="BTNelimina" id="BTNelimina" class="button" value="ELIMINAR COTIZACION">';
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
