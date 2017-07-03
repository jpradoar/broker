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

	#TRAIGO EL NOMBRE DE LOS CLIENTES
	$db_Cliente  = conecto();
	$sql_Cliente = " select ape_cli, nom_cli, cod_cli from clientes order by ape_cli ASC ";
	$r_Cliente   = mysqli_query($db_Cliente, $sql_Cliente);

	if ($r_Cliente == false){
    	mysqli_close($db_Cliente);
        $error = "Error: (" . mysql_errno() . ") " . mysql_error().")";
        //gestion_errores();
    }
        mysqli_close($db_Cliente);
		
///////////////////////////// FIN LISTADOS /////////////////////////////	

	  
 	$cod 	= trim($_GET['cod']);
	$accion	= trim($_GET['accion']);
	$coddet	= trim($_GET['coddet']);
	
	if($accion == "ELI"){//si borro un detalle..
	
		$db8  = conecto();
		$sql8 = "delete from elementospresu where cod_elepresu = ".$coddet." ";
		$r8   = mysqli_query($db8, $sql8);
	
		if ($r8 == false){
	          mysqli_close($db8);
	          //$error = "Error: (" . mysql_errno() . ") " . mysql_error().")";
	          gestion_errores();
	    }
	    	  mysqli_close($db8);	
	}

	$cod_po	= trim($_GET['cod_po']);
	
	if(strlen($cod_po)!=0){//si borro un detalle.
	
		$db13  = conecto();
		$sql13 = " delete from pos where cod_po = '".$cod_po."' ";
		$r13   = mysqli_query($db13, $sql13);
	
		if ($r13 == false){
			mysqli_close($db13);
	         //$error = "Error: (" . mysql_errno() . ") " . mysql_error().")";
	        gestion_errores();
	    }
	        mysqli_close($db13);
	}		  
// ================================== BORRADO DE ARCHIVOS  ==================================================	 
 if($_POST){//SEGUNDOS POST
 	
	$cod 	= trim($_GET['cod']);

//----------------------------------- AGREGAR PO   -------------------
	if($_POST['BTNagregaPO']){

		//para el alta de las carpetas
		$raiz		= "presupuestos/";
		$estructura = $raiz . trim($cod);	
	
		if (!is_dir($estructura)){
			mkdir($estructura, 0777, true);
    	}
		
		$nom_FILEpo = $_FILES['FILEpo']['name'];
		
		
		if(strlen($nom_FILEpo)==0){//si no cargue nada
			$guardopo ="";//devuelvo vacio	
		}else{
			$guardopo = $nom_FILEpo;
			//########################### ARCHIVO PO ############################### 
			$nombrepo 	= $_FILES['FILEpo']['name'];
			$tmp_namepo = $_FILES['FILEpo']['tmp_name'];
			$errorpo 	= $_FILES['FILEpo']['error'];
			suboarchivos($estructura,$nombrepo,$tmp_namepo,$errorpo,$cod); 					

			$db_po  = conecto();	 
			$sql_po = "INSERT INTO pos (cod_presu, des_po) VALUES ('".$cod."','".$nom_FILEpo."')";
			//echo $sql_po; exit();
			$r_po   = mysqli_query($db_po, $sql_po);
		
			if ($r_po == false){
				mysqli_close($db_po);
				$error = "Error: (" . mysql_errno() . ") " . mysql_error().")";
				//gestion_errores();
			}
					
				mysqli_close($db_po);	
		}
		
	}
//----------------------------------- DUPLICAR PRESUPUESTO -------------------
	if($_POST['BTNdup']){
		
		$dbdup  = conecto();
		$sqldup = " select * from presupuestos where cod_presu = ".$cod." ";
		//echo $sqldup;exit();
		$rdup   = mysqli_query($dbdup, $sqldup);
	
		if ($rdup== false){
	          mysqli_close($dbdup);
	          $error = "Error: (" . mysql_errno() . ") " . mysql_error().")";
	          //gestion_errores();
	    }
	    	  mysqli_close($dbdup);
			  
		while ($arrdup = mysqli_fetch_array($rdup))		
		{
			$LSTCliente  = trim($arrdup['cod_cli']);
			$XTXTobserva = trim($arrdup['observa_presu']);	
			$Xcontrato   = trim($arrdup['contrato']);
			$Xpi 		 = trim($arrdup['pi']);
			$Xpo 		 = trim($arrdup['po']);	
			$fecha_alta	 = trim($arrdup['fecha_alta']);
		}
			  
		$dbdup2  = conecto();
		
		$sqldup2 = " INSERT INTO presupuestos (cod_cli,observa_presu,contrato,pi,po,estado_presu) VALUES ('".$LSTCliente."','".$XTXTobserva."','".$nom_FILEcontra."','".$nom_FILEpi."','".$nom_FILEpo."','1')";
		$rdup2   = mysqli_query($dbdup2, $sqldup2);

		if ($rdup2 == false){
              mysqli_close($dbdup2);
              $error = "Error: (" . mysql_errno() . ") " . mysql_error().")";
              //gestion_errores();
        }
			 $ultimo_id = mysqli_insert_id($dbdup2);
              mysqli_close($dbdup2);	  
			  

		//para el alta de las carpetas
		$raiz		= "presupuestos/";
		$estructura = $raiz . trim($ultimo_id);	
	
		if (is_dir($estructura)){
			$Xtodo_ok	= false;
			$ya_existe	= true;
    	}

		if(!mkdir($estructura, 0777, true))//si no se creo la carpeta contenedora
		{
			header ('location:error.php?accion=Err04');
			die;
		}
			
		//HAY QUE MOVER LOS ARCHIVOS
		
		$dbdup2  = conecto();
		$sqldup2 = " select * from elementospresu where cod_presu = ".$cod." ";
		//echo $sqldup;exit();
		$rdup2   = mysqli_query($dbdup2, $sqldup2);
	
		if ($rdup2== false){
	          mysqli_close($dbdup2);
	          $error = "Error: (" . mysql_errno() . ") " . mysql_error().")";
	          //gestion_errores();
	    }
	    	  mysqli_close($dbdup2);	
		
		
		
		
		while ($arrdup2 = mysqli_fetch_array($rdup2))		
		{
			
			//$cod_detallesxpresu = trim($arr10['cod_elepresu']);
			$elemento 	 		= trim($arrdup2['des_elepresu']);
			$anotaciones 		= trim($arrdup2['anota_elepresu']);	
			$precio  	 		= trim($arrdup2['precio_ba']);
			$precio_ch 	 		= trim($arrdup2['precio_china']);	
			$cantidad 	 		= trim($arrdup2['canti_presu']);
			
 			$dbdup3  = conecto();
			$sqldup3 = " INSERT INTO elementospresu	(cod_presu, des_elepresu, anota_elepresu, precio_ba, precio_china, canti_presu) VALUES ('".$ultimo_id."','".$elemento."','".$anotaciones."','".$precio."','".$precio_ch."','".$cantidad."') ";
			//echo $sqldup3;exit();
			$rdup3   = mysqli_query($dbdup3, $sqldup3);

			if ($rdup3 == false){
				mysqli_close($dbdup3);
				$error = "Error: (" . mysql_errno() . ") " . mysql_error().")";
				//gestion_errores();
			 }
				mysqli_close($dbdup3);		
		}

		echo "<script language='javascript'>
				 alert('El Registro a sido Duplicado');
				window.location.href='index.php'; </script>";
				
		}//-----FIN DUPLICAR PRESUPUESTO -------------------


//-----------------------------------BORRAR ARCHIVO CONTRATO------------------------------------------	
	 if($_POST['BTNdeletecontra']){//si borro un detalle..
	 
		$lugarcontra=$_SESSION['contrato']; // traigo por sesion el archivo. 
		$valorcontrato = ""; // pongo la variable en cero, o vacía.
		$db12  = conecto();   // conecto a la db
		$sql12 = " update presupuestos set contrato = '".$valorcontrato."' where cod_presu = ".$cod." ";
		$r12   = mysqli_query($db12, $sql12);
				if ($r12 == false){
	    	      mysqli_close($db12);
	        	  //$error = "Error: (" . mysql_errno() . ") " . mysql_error().")";
	          		gestion_errores();
	    	}
	    	  mysqli_close($db12);
			  unlink("presupuestos/".$cod."/".$lugarcontra); // borro el archivo fisicamente del equipo usando el path completo.
			  $lugarcontra=""; // pongo la variable en cero, o vacía.
			  $_SESSION['contrato'] = ""; // cierro la secion que contiene el dato o variable.
			  
		}
//-------------------------------------BORRAR ARCHIVO ----------------------------------------
		if($_POST['BTNdeletepo']){//si borro un detalle..
			$lugarpo=$_SESSION['po'];
			//$valorpo = "";
			$db13  = conecto();
			$sql13 = " update presupuestos set po = '".$valorpo."' where cod_presu = ".$cod." ";
			$r13   = mysqli_query($db13, $sql13);
				if ($r13 == false){
	    	      mysqli_close($db13);
	        	  //$error = "Error: (" . mysql_errno() . ") " . mysql_error().")";
	          		gestion_errores();
	    	}
	    	  mysqli_close($db13);
			  unlink("presupuestos/".$cod."/".$lugarpo);
			  $lugarpo="";
			  $_SESSION['po']="";
		}		
//--------------------------------------BORRAR ARCHIVO PI---------------------------------------	 
		if($_POST['BTNdeletepi']){//si borro un detalle..
			$lugarpi=$_SESSION['pi'];
			//$valorpi = "";
			$db14  = conecto();
			$sql14 = " update presupuestos set pi = '".$valorpi."' where cod_presu = '".$cod."' ";unlink($lugarpi); // borro el archivo fisicamente del equipo.
			$r14   = mysqli_query($db14, $sql14);
				if ($r14 == false){
	    	      mysqli_close($db14);
	        	  //$error = "Error: (" . mysql_errno() . ") " . mysql_error().")";
	          		gestion_errores();
	    	}
	    	  mysqli_close($db14);
			  unlink("presupuestos/".$cod."/".$lugarpi);
			  $lugarpi="";
			  $_SESSION['pi']="";
		}
// ================================== FIN BORRAR ARCHIVOS  ================================================== 			


	if($_POST['bt_plus_plus']){//Si agrego un detalle nuevo..

		$TXTelem_plus		 = trim($_POST['TXTelem_plus']);
		$TXTanota_plus		 = trim($_POST['TXTanota_plus']);
		$TXTprecio_plus 	 = trim($_POST['TXTprecio_plus']);
		$TXTpreciochina_plus = trim($_POST['TXTpreciochina_plus']); 
		$TXTcantidad_plus	 = trim($_POST['TXTcantidad_plus']);
		
		$db9  = conecto();
		$sql9 = " INSERT INTO elementospresu (cod_presu, des_elepresu, anota_elepresu, precio_ba, precio_china, canti_presu ) VALUES ('".$cod."','".$TXTelem_plus."','".$TXTanota_plus."','".$TXTprecio_plus."','".$TXTpreciochina_plus."','".$TXTcantidad_plus."') ";
		$r9   = mysqli_query($db9, $sql9);

		if ($r9 == false){
			mysqli_close($db9);
			$error = "Error: (" . mysql_errno() . ") " . mysql_error().")";
			//gestion_errores();
		}
			mysqli_close($db9);
		
		#SE AGREGO NUEVO ELEMENTO					
	}	
		
	if($_POST['BtnNueClie']){//Si es nuevo cliente
 		header ('location:nuevocliente.php?accion=crear');
		exit();		
	}	

	if($_POST['BTNvolver']){//volver al menu
 		header ('location:index.php');
		exit();		
	}	
	
	if($_POST['BTNcrea']){//si creo un nuevo presupuesto
	
		$Xtodo_ok 		= true;
		$Xerror 		= "";
		$Xerror_contra 	= "";
		$Xerror_pi 		= "";
		$Xerror_po 		= "";
		$ya_existe		= false;
		
		$LSTCliente = $_POST['LSTCliente'];
		
		if($LSTCliente=="000"){
			$Xtodo_ok = false;
			echo "<script type='text/javascript'>alert('ERROR: DEBE SELECCIONAR UN CLIENTE')</script>";	
		}

		$XTXTobserva = $_POST['TXTobserva'];
		$TXTcantidad = $_POST['TXTcantidad'];
				
		//------------ captura de nombre de archivos a subir -------
		$nom_FILEcontra = $_FILES['FILEcontra']['name']; 
		$nom_FILEpi = $_FILES['FILEpi']['name'];
		$nom_FILEpo = $_FILES['FILEpo']['name'];
		
	if ($Xtodo_ok == true) {#Si esta todo bien
		
		//--- Inserto los datos capturados anteriormente en la DB -----------
		$estado_presu = "1"; //Estado activo es 1 
		
		$db  = conecto();
		
		$sql = "INSERT INTO presupuestos (cod_cli, observa_presu, contrato, pi, estado_presu) VALUES ('".$LSTCliente."', '".$XTXTobserva."', '".$nom_FILEcontra."', '".$nom_FILEpi."', '".$estado_presu."')";
		$r   = mysqli_query($db, $sql);

		if ($r == false){
              mysqli_close($db);
              $error = "Error: (" . mysql_errno() . ") " . mysql_error().")";
              //gestion_errores();
        }
			 $ultimo_id = mysqli_insert_id($db);
             mysqli_close($db);
		
		
		$raiz		= "presupuestos/";
		$estructura = $raiz . trim($ultimo_id);	
	
		if (!is_dir($estructura)){
			mkdir($estructura, 0777, true);
    	}
		
		if(strlen($nom_FILEpo)!=0){
			$db_po  = conecto();	 
			$sql_po = "INSERT INTO pos (cod_presu, des_po) VALUES ('".$ultimo_id."','".$nom_FILEpo."')";
			//echo $sql_po; exit();
			$r_po   = mysqli_query($db_po, $sql_po);
	
			if ($r_po == false){
				mysqli_close($db_po);
				$error = "Error: (" . mysql_errno() . ") " . mysql_error().")";
				//gestion_errores();
			}
				
				mysqli_close($db_po);
		}
			  
		// ------------------------- UPLOAD ------------------------
		$TXTelem 		= $_POST['TXTelem'];
		$TXTanota 		= $_POST['TXTanota'];
		$TXTprecio 		= $_POST['TXTprecio'];
		$TXTpreciochina = $_POST['TXTpreciochina'];
		$TXTcantidad 	= $_POST['TXTcantidad'];
			
		$X=0;
		
		foreach($TXTelem as $array){
			
			if(strlen($array)>0){		
			
				$db3  = conecto();
				$sql3 = " INSERT INTO elementospresu (cod_presu, des_elepresu, anota_elepresu, precio_ba, precio_china, canti_presu ) VALUES ('".$ultimo_id."','".$TXTelem[$X]."','".$TXTanota[$X]."','".$TXTprecio[$X]."','".$TXTpreciochina[$X]."','".$TXTcantidad[$X]."') ";
				
				$r3   = mysqli_query($db3, $sql3);

				if ($r3 == false){
					mysqli_close($db3);
					$error = "Error: (" . mysql_errno() . ") " . mysql_error().")";
					//gestion_errores();
				 }
					mysqli_close($db3);
													
			}
		$X++;		
		}	
		
		//para el alta de las carpetas
		$raiz		= "presupuestos/";
		$estructura = $raiz . trim($ultimo_id);	
	
		if (is_dir($estructura)){
			$Xtodo_ok	= false;
			$ya_existe	= true;
    	}

		if($Xtodo_ok	== true)//si esta todo bien
		{///creamos el directorio
			if(!mkdir($estructura, 0777, true))//si no se creo la carpeta contenedora
				
			{
				header ('location:error.php?accion=Err04');
				die;
			}else{//si salio todo genial

//########################### ARCHIVO DE CONTRATO ############################### 
			$nombrecontra = $_FILES['FILEcontra']['name'];
			$tmp_namecontra = $_FILES['FILEcontra']['tmp_name'];
			$errorcontra = $_FILES['FILEcontra']['error'];
			suboarchivos($estructura,$nombrecontra,$tmp_namecontra,$errorcontra,$cod); 
//########################### ARCHIVO PI ############################### 
			$nombrepi = $_FILES['FILEpi']['name'];
			$tmp_namepi = $_FILES['FILEpi']['tmp_name'];
			$errorpi = $_FILES['FILEpi']['error'];
			suboarchivos($estructura,$nombrepi,$tmp_namepi,$errorpi,$cod); 
//########################### ARCHIVO PO ###############################
			$nombrepo = $_FILES['FILEpo']['name'];
			$tmp_namepo = $_FILES['FILEpo']['tmp_name'];
			$errorpo = $_FILES['FILEpo']['error'];
			suboarchivos($estructura,$nombrepo,$tmp_namepo,$errorpo,$cod); 
					
				 }//FIN si salio todo genial
			}
			echo "<script language='javascript'>
				 alert('El Registro a sido Creado');
				window.location.href='index.php'; </script>"; 
		 }#Fin si esta todo bien

 	}  
 
 	if($_POST['BTNmod']){//si es una modificacion presupuesto
	
		$Xcontrato		= trim($_SESSION['contrato']);
		//echo ".--------".$Xcontrato; exit();
		$Xpi			= trim($_SESSION['pi']);
		$Xpo			= trim($_SESSION['po']);
				
		$XLstCliente	= $_POST['LSTCliente'];
		$XTXTobserva 	= $_POST['TXTobserva'];
		 
			
//---------------------- AGREGAR ARCHIVOS FALTANTES ----------------------------
//------------ captura de nombre de archivos a updatear -------
		$nom_FILEcontra = $_FILES['FILEcontra']['name'];
		$raiz		= "presupuestos/";
		$estructura = $raiz.$cod;
		
	if(strlen($Xcontrato)==0){//SI NO HABia nada en la base de datos
		if(strlen($nom_FILEcontra)==0){//si no cargue nada
			$guardocontra ="";//devuelvo vacio
		}else{
			$guardocontra = $nom_FILEcontra;
			//########################### ARCHIVO DE CONTRATO ######### x1###################### 
			$nombrecontra = $_FILES['FILEcontra']['name'];
			$tmp_namecontra = $_FILES['FILEcontra']['tmp_name'];
			$errorcontra = $_FILES['FILEcontra']['error'];
			suboarchivos($estructura,$nombrecontra,$tmp_namecontra,$errorcontra,$cod); 
			//echo $estructura."----".$nombrecontra."----".$tmp_namecontra."----".$errorcontra."----".$cod;				
		}
		//$guardocontra;exit();
	}else{
		if($nom_FILEcontra==$Xcontrato){
			$guardocontra = $Xcontrato; //actualizas EL NUEVO ARCHIVO fisicamente
			//########################### ARCHIVO DE CONTRATO ############################### 
			$nombrecontra = $_FILES['FILEcontra']['name'];
			$tmp_namecontra = $_FILES['FILEcontra']['tmp_name'];
			$errorcontra = $_FILES['FILEcontra']['error'];
			//suboarchivos($estructura,$nombrecontra,$tmp_namecontra,$errorcontra,$cod); 
		}else{
			$guardocontra = $Xcontrato;
			$nombrecontra = $_FILES['FILEcontra']['name'];
			$tmp_namecontra = $_FILES['FILEcontra']['tmp_name'];
			$errorcontra = $_FILES['FILEcontra']['error'];
			//suboarchivos($estructura,$nombrecontra,$tmp_namecontra,$errorcontra,$cod); 		 
		}	
	}
	
//--------------------------- FIN MOD CONTRATO --------------------------------	

//--------------------------- INICIO MOD PI --------------------------------	
	$nom_FILEpi = $_FILES['FILEpi']['name'];
	if(strlen($Xpi)==0){//SI NO HABia nada en la base de datos
		if(strlen($nom_FILEpi)==0){//si no cargue nada
			$guardopi ="";//devuelvo vacio	
		}else{
			$guardopi = $nom_FILEpi;
//########################### ARCHIVO PI ############################### 
			$nombrepi = $_FILES['FILEpi']['name'];
			$tmp_namepi = $_FILES['FILEpi']['tmp_name'];
			$errorpi = $_FILES['FILEpi']['error'];
			suboarchivos($estructura,$nombrepi,$tmp_namepi,$errorpi,$cod); 					
		}
	}else{
		if($nom_FILEpi==$Xpi){
			$guardopi = $Xpi; //actualizas EL NUEVO ARCHIVO fisicamente
//########################### ARCHIVO PI ############################### 
			$nombrepi = $_FILES['FILEpi']['name'];
			$tmp_namepi = $_FILES['FILEpi']['tmp_name'];
			$errorpi = $_FILES['FILEpi']['error'];
			suboarchivos($estructura,$nombrepi,$tmp_namepi,$errorpi,$cod); 			
		}else{
			$guardopi = $Xpi; 
//########################### ARCHIVO PI ############################### 
			$nombrepi = $_FILES['FILEpi']['name'];
			$tmp_namepi = $_FILES['FILEpi']['tmp_name'];
			$errorpi = $_FILES['FILEpi']['error'];
			suboarchivos($estructura,$nombrepi,$tmp_namepi,$errorpi,$cod); 
		}	
	}
	
//--------------------------- FIN MOD PI --------------------------------

//--------------------------- INICIO MOD PO --------------------------------	
	$nom_FILEpo = $_FILES['FILEpo']['name'];
	/*
	if(strlen($Xpo)==0){//SI NO HABia nada en la base de datos
		if(strlen($nom_FILEpo)==0){//si no cargue nada
			$guardopo ="";//devuelvo vacio	
		}else{
			$guardopo = $nom_FILEpo;
//########################### ARCHIVO PO ############################### 
			$nombrepo = $_FILES['FILEpo']['name'];
			$tmp_namepo = $_FILES['FILEpo']['tmp_name'];
			$errorpo = $_FILES['FILEpo']['error'];
			suboarchivos($estructura,$nombrepo,$tmp_namepo,$errorpo,$cod); 					
		}
	}else{
		if($nom_FILEpo==$Xpo){
			$guardopo = $Xpo; //actualizas EL NUEVO ARCHIVO fisicamente
//########################### ARCHIVO PI ############################### 
			$nombrepo = $_FILES['FILEpo']['name'];
			$tmp_namepo = $_FILES['FILEpo']['tmp_name'];
			$errorpo = $_FILES['FILEpo']['error'];
			suboarchivos($estructura,$nombrepo,$tmp_namepo,$errorpo,$cod); 			
		}else{
			$guardopo = $Xpo; 
//########################### ARCHIVO PI ############################### 
			$nombrepo = $_FILES['FILEpo']['name'];
			$tmp_namepo = $_FILES['FILEpo']['tmp_name'];
			$errorpo = $_FILES['FILEpo']['error'];
			suboarchivos($estructura,$nombrepo,$tmp_namepo,$errorpo,$cod); 
		}	
	}*/
		$estructura = "";
	/*	
		$db_po  = conecto();	 
		$sql_po = "INSERT INTO pos (cod_presu, des_po) VALUES ('".$cod."','".$nom_FILEpo."')";
		//echo $sql_po; exit();
		$r_po   = mysqli_query($db_po, $sql_po);

		if ($r_po == false){
            mysqli_close($db_po);
            $error = "Error: (" . mysql_errno() . ") " . mysql_error().")";
            //gestion_errores();
        }
			
            mysqli_close($db_po);	
	*/			
//--------------------------- FIN MOD PO --------------------------------
			  			  
		$db4  = conecto();				  
		$sql4 = " UPDATE presupuestos SET observa_presu='".$XTXTobserva."', cod_cli='".$XLstCliente."',  contrato='".$guardocontra."', pi='".$guardopi."' WHERE cod_presu ='".$cod."' ";		  	  
		//echo "$sql4";exit;
		$r4   = mysqli_query($db4, $sql4);
		
		if ($r4 == false){
            mysqli_close($db4);
            //$error = "Error: (" . mysql_errno() . ") " . mysql_error().")";
            gestion_errores();
         }
            mysqli_close($db4);
			
		echo "<script language='javascript'> alert('El Registro a sido Modificado'); </script>"; 
			
	}
	
	if($_POST['BTNelimina']){//si elimina el presupuesto

		$db5  = conecto();
		$sql5 = " UPDATE presupuestos
				  SET estado_presu = 0
				  WHERE cod_presu = $cod";
				  
		$r5   = mysqli_query($db5, $sql5);

		if ($r5 == false){
            mysqli_close($db5);
            //$error = "Error: (" . mysql_errno() . ") " . mysql_error().")";
            gestion_errores();
         }
            mysqli_close($db5);
		
		echo "<script language='javascript'> alert('El Registro a sido Eliminado'); window.location.href='index.php'; </script>"; 			
	}
	
//////////////////////////////////////////////////////////////////////////////////////////////////////////////
	if($_POST['BTNcreaOC']){//si genero una orden de compra..
	
		$cod 		 = trim($_GET['cod']);
		$Xest_presu  = trim($_SESSION['estado_presu']);
		
		//VEO SI TIENE AL MENOS UN DETALLE PARA PODER REALIZAR LAS O.C..
		$db81  = conecto();
		$sql81 = " select count(*) as canti from elementospresu where cod_presu = ".$cod." ";
		
		$r81   = mysqli_query($db81, $sql81);
	
		if ($r81== false){
	          mysqli_close($db81);
	          $error = "Error: (" . mysql_errno() . ") " . mysql_error().")";
	          //gestion_errores();
	    }
	    	  mysqli_close($db81);
			  
		$arrx = mysqli_fetch_array($r81);
		$cantidad = $arrx['canti'];
			
		if ($cantidad > "0"){
			
		$db8  = conecto();
		$sql8 = " select * from presupuestos where cod_presu = ".$cod." and estado_presu != 0 ";
		
		$r8   = mysqli_query($db8, $sql8);
	
		if ($r8== false){
	          mysqli_close($db8);
	          $error = "Error: (" . mysql_errno() . ") " . mysql_error().")";
	          //gestion_errores();
	    }
	    	  mysqli_close($db8);
			  
		while ($arr8 = mysqli_fetch_array($r8))		
		{
			$LSTCliente  = trim($arr8['cod_cli']);
			$XTXTobserva = trim($arr8['observa_presu']);	
			$Xcontrato   = trim($arr8['contrato']);
			$Xpi 		 = trim($arr8['pi']);
			$Xpo 		 = trim($arr8['po']);	
			$fecha_alta	 = trim($arr8['fecha_alta']);
		}
			
		
		// Chequeo el ulimo numero_unico
		$dbnu  = conecto();
		$sqlnu = " SELECT num_unico FROM `ordenes` ORDER BY num_unico DESC LIMIT 1 ";
		
		$rnu   = mysqli_query($dbnu, $sqlnu);
	
		if ($rnu== false){
	          mysqli_close($dbnu);
	          $error = "Error: (" . mysql_errno() . ") " . mysql_error().")";
	          //gestion_errores();
	    }
	    	  mysqli_close($dbnu);
		
		while ($arrnu = mysqli_fetch_array($rnu))		
		{
			$num_unico  = trim($arrnu['num_unico']);
  	   }
	   // sumo el numero_unico para el proximo dato
		$num_unico  = $num_unico+1;
		
		//echo $num_unico;exit();	
			
 		$db9  = conecto();
		$sql9 = " INSERT INTO ordenes
		(cod_cli, observa_ord, num_unico ,cod_presu_or, contrato_or, pi_or, po_or, fe_alt_ord) VALUES ('".$LSTCliente."','".$XTXTobserva."','".$num_unico."','".$cod."','".$Xcontrato."','".$Xpi."','".$Xpo."','".$fecha_alta."') ";
		//echo $sql9;exit();
		$r9   = mysqli_query($db9, $sql9);

		if ($r9 == false){
			mysqli_close($db9);
			$error = "Error: (" . mysql_errno() . ") " . mysql_error().")";
			//gestion_errores();
		 }
		 	$codigo = trim(mysqli_insert_id($db9));
			mysqli_close($db9);
		
			
		#Inserto los detalles en ordenes
		$db10  = conecto();
		$sql10 = " select * from elementospresu where cod_presu = ".$cod." ";
		$r10   = mysqli_query($db10, $sql10);
	
		if ($r10 == false){
	    	mysqli_close($db10);
	        $error = "Error: (" . mysql_errno() . ") " . mysql_error().")";
	        //gestion_errores();
	    }
	    	mysqli_close($db10);
		 
		while ($arr10 = mysqli_fetch_array($r10))		
		{
			//$cod_detallesxpresu = trim($arr10['cod_elepresu']);
			$elemento 	 		= trim($arr10['des_elepresu']);
			$anotaciones 		= trim($arr10['anota_elepresu']);	
			$precio  	 		= trim($arr10['precio_ba']);
			$precio_ch 	 		= trim($arr10['precio_china']);	
			$cantidad 	 		= trim($arr10['canti_presu']);	
			
 			$db11  = conecto();
			$sql11 = " INSERT INTO elementosord	(cod_presu_or, des_ord, anota_ord, precio_ba_ord, precio_china_ord, canti_ord,cod_ord) VALUES ('".$cod."','".$elemento."','".$anotaciones."','".$precio."','".$precio_ch."','".$cantidad."','".$codigo."') ";
			$r11   = mysqli_query($db11, $sql11);

			if ($r11 == false){
				mysqli_close($db11);
				$error = "Error: (" . mysql_errno() . ") " . mysql_error().")";
				//gestion_errores();
			 }
				mysqli_close($db11);		
		}

		#Aviso que este presupuesto ya tiene una orden de compra asignada
		# estado_presu = 2 es que ya tiene OC asignada		 
 		$db111  = conecto();		
		$sql111 = " UPDATE presupuestos SET estado_presu = '2' WHERE cod_presu = '".$cod."' ";
		
		$r111   = mysqli_query($db111, $sql111);

		if ($r111 == false){
			mysqli_close($db111);
			$error = "Error: (" . mysql_errno() . ") " . mysql_error().")";
			//gestion_errores();
		 }
			mysqli_close($db111);			
		
		//Creo la carpeta contenedora de OC
		$estructura = 'ordenes/'.$codigo;
		mkdir($estructura, 0777, true);
		
		echo "<script language='javascript'>
				 alert('Felicitaciones la Orden de Compra fue Generada!');
				window.location.href='veoordenes.php?cod=".$codigo."'; </script>"; 
		}else{
		echo "<script language='javascript'>
				 alert('ERROR! Debe agregar al menos un detalle para generar una orden de compra');
				window.location.href='nuevopresu.php?cod=".$cod."'; </script>"; 
		}
						
	}//FIN si genero una orden de compra..
//////////////////////////////////////////////////////////////////////////////////////////////////////////////			 
}

	$cod 	 	= trim($_GET['cod']);//Si vengo de una modificacion o eliminacion traigo los datos	
	$LSTCliente = trim($_GET['cod_cli']);

	//FORMATEO LAS VARIABLES QUE VOY A UTILIZAR
	$ele	= "";
	$ano	= "";
	$pre	= "";
	$prech	= "";
	
	//formateo todas las seciones
	$_SESSION['contrato']="";
	$_SESSION['pi']="";
	$_SESSION['po']="";	
		
	//Para modificaciones del detalle
	$ele	= trim($_GET['ele']);
	$ano	= trim($_GET['ano']);
	$pre	= trim($_GET['pre']);
	$prech	= trim($_GET['prech']);
	//FIN Para modificaciones del detalle
	
	$Xerror 		= "";
	$Xerror_contra  = "";
	$Xerror_pi 		= "";
	$Xerror_po 		= "";	
	
	$LSTCliente    	= "";
	$XTXTobserva   	= "";	
	$Xcontrato     	= "";
	$Xpi 		   	= "";
	$Xpo 		   	= "";
	$Xestado_presu 	= "";	
	$est_accion		= "";
			
	if(strlen($XTXTobserva)==0)$XTXTobserva="";
	if(strlen($est_accion)==0)$est_accion="";
			
	if(strlen($LSTCliente)==0)$LSTCliente="";
	if(strlen($Xcontrato)==0)$Xcontrato="";
	if(strlen($Xpi)==0)$Xpi="";
	if(strlen($Xpo)==0)$Xpo="";
	if(strlen($Xestado_presu)==0)$Xestado_presu="";				
	
	if(strlen($cod)!=0){#SI ES ELIMINAR O MODIFICAR	
	
		$db6  = conecto();
		$sql6 = " select * from presupuestos where cod_presu = ".$cod." and estado_presu != 0 ";

		$r6   = mysqli_query($db6, $sql6);
	
		if ($r6 == false){
	          mysqli_close($db6);
	          $error = "Error: (" . mysql_errno() . ") " . mysql_error().")";
	          //gestion_errores();
	    }
	    	  mysqli_close($db6);
			  
		while ($arr = mysqli_fetch_array($r6))		
		{
			$LSTCliente    = trim($arr['cod_cli']);
			$XTXTobserva   = trim($arr['observa_presu']);	
			$Xcontrato     = trim($arr['contrato']);
			$Xpi 		   = trim($arr['pi']);
			#$Xpo 		   = trim($arr['po']);
			$Xestado_presu = trim($arr['estado_presu']);		  
		}

		$db_po  = conecto();
		$sql_po = " select count(*) as canti from pos where cod_presu = ".$cod." ";
		//echo $sql_po ;
		$r_po   = mysqli_query($db_po, $sql_po);
	
		if ($r_po == false){
	          mysqli_close($db_po);
	          $error = "Error: (" . mysql_errno() . ") " . mysql_error().")";
	          //gestion_errores();
	    }
	    	  mysqli_close($db_po);

		$arrx 		 = mysqli_fetch_array($r_po);
		$cantidad_po = $arrx['canti'];
		//echo $cantidad_po;
		if($cantidad_po!=0){		  
			$db_po  = conecto();
			$sql_po = " select * from pos where cod_presu = ".$cod." ";
	
			$r_po   = mysqli_query($db_po, $sql_po);
		
			if ($r_po == false){
				  mysqli_close($db_po);
				  $error = "Error: (" . mysql_errno() . ") " . mysql_error().")";
				  //gestion_errores();
			}
				  mysqli_close($db_po);
		}
		
		$est_accion = "";
		
		if($Xestado_presu==2){//Si ya existe una orden de compra no puedo modificar nada
			$est_accion = 'disabled';
		};
		
		$_SESSION['estado_presu'] = $Xestado_presu;//Para generar OC
		
//------------------------ LEER CONTENIDO DE LOS DETALLES -------------------------------//

		$db7  = conecto();
		$sql7 = "select * from elementospresu where cod_presu = ".$cod." ";
		$r7   = mysqli_query($db7, $sql7);
	
		if ($r7 == false){
	          mysqli_close($db7);
	          //$error = "Error: (" . mysql_errno() . ") " . mysql_error().")";
	          gestion_errores();
	    }
	    	  mysqli_close($db7);
			  					
												
//------------------------ FIN DE LEER CONTENIDO DE LOS DETALLES -------------------------------//

//------------------------ LEER CONTENIDO DE CARPETAS -------------------------------//
			$dir 	 = "presupuestos/";
			$enlaceX = ""; 
			$directorio = opendir($dir.$cod); 
			
			while ($archivo = readdir($directorio)){ 
				if($archivo=='.' or $archivo=='..'){ 
				//echo $enlace."<br>";
				}else{ 
					//$enlace = $dir.$cod."/".$archivo; 
					$enlaceX = $dir.$cod."/";
					//echo "<a href=$enlace class='menu' target='_blank'>$archivo<br></a>"; 
					//echo $enlaceX;
					 } 
				}
				 
			closedir($directorio); 
//------------------------ FIN LEER CONTENIDO DE CARPETAS -------------------------------//
				  
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
			<th colspan="5" align="center"><div align="center">NUEVO PRESUPUESTO</div></th>
		  </tr>
		</thead>
		<tbody>
		 <tr>
			<td width="78%"><div align="center"><strong>CLIENTE</strong><span style="color: #000">
			   <select name="LSTCliente" id="combox" value="<?php echo $LSTCliente; ?>" class="button" <?php echo $est_accion; ?>>
                <option value="000" <?php echo $est_accion; ?>>Seleccione</option>
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
            
			</span>
           </div></td>
			<td width="22%" colspan="3"><div align="center"><span style="color: #000">
			  <input type="submit" name="BtnNueClie" id="BtnNueClie" value="NUEVO CLIENTE" class="button" >
			</span></div></td>
		  </tr>
         <tr>
			<td colspan="5"><?php echo $Xerror; ?></td>
		  </tr>
		 <tr>
		   <td colspan="5"><div align="center"><strong><span style="color: #000">DESCRIPCION DEL PRESUPUESTO</span></strong></div>		     <div align="center"></div></td>
	      </tr>          
         <tr>
			<td colspan="5"><div id="div_1" align="center" <?php if(strlen($cod)>0){echo 'style="display:none;"'; }?> >
			  <label> <span class="small">ELEMENTO</span> </label>
			  <input  name="TXTelem[]"  type="text" class="mini-button"  id="TXTelem1" size="10" maxlength="250" <?php echo $est_accion; ?>/>
			  <label> <span class="small">ANOTACIONES</span> </label>
			  <input name="TXTanota[]" type="text" class="mini-button" id="TXTanota[]" value=""  size="10" maxlength="250">
			  <label> <span class="small">PRECIO</span> </label>
			  <input name="TXTprecio[]" type="text" class="mini-button"  id="TXTprecio[]"  value="" size="8" maxlength="11">
			  <label> <span class="small">PRECIO CH</span> </label>
			  <input name="TXTpreciochina[]" type="text" class="mini-button" id="TXTpreciochina[]"  value="" size="8" maxlength="11">
			  <label> <span class="small">CANTIDAD</span> </label>
			  <input name="TXTcantidad[]" type="text" class="mini-button" id="TXTcantidad[]" value="" size="8" maxlength="11">
			  <input class="bt_del" id="1" type="button" value="-" />
			  <input class="bt_plus" id="1" type="button" value="+" />
			  <div class="error_form"></div>
		    </div></td>
	      </tr>
          
          <?php
		  if(strlen($cod)!=0){#SI ES ELIMINAR O MODIFICAR	
		  	while ($arr = mysqli_fetch_array($r7))		
			{
				$cod_detallesxpresu = trim($arr['cod_elepresu']);
				$elemento 	 		= trim($arr['des_elepresu']);
				$anotaciones 		= trim($arr['anota_elepresu']);	
				$precio  	 		= trim($arr['precio_ba']);
				$precio_ch 	 		= trim($arr['precio_china']);	
				$cantidad 	 		= trim($arr['canti_presu']); 	
			//}
				 		  
		  // if(strlen($cod_detallesxpresu)!=0){
			echo "<tr>
					<td colspan=\"5\"><div align=\"center\">
			   	    <label> <span class=\"small\">ELEMENTO</span> </label>
					<input type=\"text\"  name=\"TXTelem\"  id=\"TXTelem\" size=\"10\" value=\"$elemento\" maxlength=\"250\" class=\"mini-button\"/>
					<label> <span class=\"small\">ANOTACIONES</span> </label>
					<input type=\"text\" name=\"TXTanota\" id=\"TXTanota\"  size=\"10\" value=\"$anotaciones\" maxlength=\"250\" class=\"mini-button\">
					<label> <span class=\"small\">PRECIO</span> </label>
					<input type=\"text\" name=\"TXTprecio\"  id=\"TXTprecio\" size=\"8\"  value=\"$precio\" maxlength=\"11\" class=\"mini-button\">
					<label> <span class=\"small\">PRECIO CH</span> </label>
					<input type=\"text\" name=\"TXTpreciochina\" id=\"TXTpreciochina\" size=\"8\"  value=\"$precio_ch\" maxlength=\"11\" class=\"mini-button\">
					<label><span class=\"small\">CANTIDAD</span></label>            
            		<input name=\"TXTcantidad\" type=\"text\" id=\"TXTcantidad\"  value=\"$cantidad\" size=\"8\" maxlength=\"11\" class=\"mini-button\">";
				if($est_accion!="disabled"){
					echo"<a href=\"nuevopresu.php?coddet=$cod_detallesxpresu&accion=ELI&cod=$cod\"><input type=\"button\" class=\"bt_del\" value=\"-\"/></a>";
					echo"<a href=\"detapresu.php?coddet=$cod_detallesxpresu&accion=MOD&cod=$cod\"><input type=\"button\" class=\"bt_del\" value=\"MODIFICAR\"/></a>";
				}
				echo"</div></td>
				  </tr>";
				 ;}
	if($est_accion!="disabled"){
		echo "<tr>
				<td colspan=\"5\"><div  align=\"center\">
		   	    <label> <span class=\"small\">ELEMENTO</span> </label>
				<input  type=\"text\"  name=\"TXTelem_plus\"  id=\"TXTelem_plus\" size=\"10\" maxlength=\"250\" class=\"mini-button\" />
				<label> <span class=\"small\">ANOTACIONES</span> </label>
				<input type=\"text\" name=\"TXTanota_plus\" id=\"TXTanota_plus\"  size=\"10\" maxlength=\"250\" class=\"mini-button\">
				<label> <span class=\"small\">PRECIO</span> </label>
				<input type=\"text\" name=\"TXTprecio_plus\"  id=\"TXTprecio_plus\" size=\"8\" maxlength=\"11\" class=\"mini-button\">
				<label> <span class=\"small\">PRECIO CH</span> </label>
				<input type=\"text\" name=\"TXTpreciochina_plus\" id=\"TXTpreciochina_plus\" size=\"8\" maxlength=\"11\" class=\"mini-button\">
				<label><span class=\"small\">CANTIDAD</span></label>            
            	<input name=\"TXTcantidad_plus\" type=\"text\" id=\"TXTcantidad_plus\"  value=\"\" size=\"8\" maxlength=\"11\" class=\"mini-button\">						
				<input class=\"bt_plus_plus\" id=\"bt_plus_plus\" name=\"bt_plus_plus\" type=\"submit\" value=\"AGREGAR\" /> 
				</div></td>
			  </tr>";
			}  
		  }
		  ?>
		  <tr>
			<td colspan="5">&nbsp;</td>
		  </tr>
		 <tr>
			<td width="78%"><div align="center"><span style="color: #000"><strong>ADJUNTAR ARCHIVOS (EXCEL, WORD O JPG)</strong><strong></strong></span></div></td>
			<td colspan="3"><div align="center"><strong>TIPO DE ARCHIVO</strong></div></td>
		  </tr>
		 <tr>
			<td>
<!--============================== LISTADO DE ARCHIVOS 	====================================== -->
<!-------------------------- CONTRATO -------------------------->
				
			  <?php 
			  	if(strlen($Xcontrato)!=0){ #Si tiene archivo en el directorio y db muestro borrar, sino muestro para subir				
					$_SESSION['contrato']=$Xcontrato;  // guardo la variable en sesion 
			  		echo "Archivo : "."$Xcontrato"; // imprimo en pantalla el nombre del archivo que subo.
			  		echo "<a href=\"presupuestos/".$cod."/".$Xcontrato."\" target='_blank'><img src='images/Down.png' height=50  ></a>";?>
			  		<input type="submit" value="Borrar Contrato" id="BTNdeletecontra"  name="BTNdeletecontra" class="button" height="50" width="50"/>	
		<?php } else { ?>
			  		<div align="center"><span style="color: #000">
			  		<input name="FILEcontra" type="file" id="FILEcontra" title="" class="button" style="width: 75%" <?php echo $est_accion; ?>>
		<?php } ?>	  	
			</span></div></td>
			<td colspan="3"><div align="center"><strong>CONTRATO</strong></div></td>
		  </tr>
		 <tr>
		   <td>
<!-------------------------- PI -------------------------->
		     <?php
			  	if(strlen($Xpi)!=0){ #Si tiene archivo en el directorio y db muestro borrar, sino muestro para subir);
					$_SESSION['pi']=$Xpi;
					echo "Archivo :  "."$Xpi"."   "; 
					echo "<a href=\"presupuestos/".$cod."/".$Xpi."\" target='_blank'><img src=\"images/Down.png\"></a>"; ?> 
			  		<input type="submit" value="Borrar PI" id="BTNdeletepi"  name="BTNdeletepi" class="button" height="50" width="50"/>
		<?php } else{ ?>
			  		<div align="center"><span style="color: #000">
		     		<input name="FILEpi" type="file" id="FILEpi" title=" " class="button" style="width: 75%" <?php echo $est_accion; ?>>
			<?php } ?>
		     </span></div></td>
		   <td colspan="3"><div align="center"><strong>PI
		   </strong></div></td>
	      </tr>

<!-------------------------- PO -------------------------->
		     <?php 
			 if($cantidad_po!=0){
				while ($arr_po = mysqli_fetch_array($r_po))		
				{
			?>
             <tr>
               <td >
               <?php
					$cod_po    = trim($arr_po['cod_po']); 
					$des_po    = trim($arr_po['des_po']);
					echo "Archivo :  "."$des_po"."   ";
					//echo '</td><td>';	
					echo "<a href=\"presupuestos/".$cod."/".$des_po."\" target='_blank'><img src=\"images/Down.png\"></a>"; ?><a href="<?php echo 'nuevopresu.php?cod_po='.$cod_po.'&cod='.$cod; ?>"><button class="button" type="button"><?php  echo 'Eliminar'; ?></button></a></td>
		   <td colspan="3"><div align="center"><strong>PO</strong></div></td>
	      </tr>
          		<?php	}
			 }
			 ?>
		  <tr>
		    <td><div align="center"><span style="color: #000"><input name="FILEpo" type="file" id="FILEpo" title=" " class="button" style="width: 75%" <?php echo $est_accion; ?>></span>
            <?php
				if(strlen($cod)!=0){
			?>		
				<input type="submit" value="AGREGAR" id="BTNagregaPO"  name="BTNagregaPO" class="button" height="50" width="50"/>		<?php
				}
			?>
            </div>
            </td>
            <td colspan="3"><div align="center"><strong>PO</strong></div></td>
          </tr>
          
         <tr>
		   <td>
<!-- ============================== FIN LISTADO DE ARCHIVOS ========================================== --> 
		 <tr>
			<td colspan="5">&nbsp;</td>
		  </tr>
		 <tr>
		   <td colspan="5"><div align="center"><span style="color: #000"><strong>OBSERVACIONES</strong></span></div></td>
	      </tr>
		 <tr>
		   <td colspan="5"><div align="center"><span style="color: #000">
		     <textarea name="TXTobserva" cols="80" rows="8" id="TXTobserva" <?php echo $est_accion; ?>><?php echo $XTXTobserva; ?></textarea>
		   </span></div></td>
	      </tr>
		 <tr>
		   <td colspan="5">&nbsp;</td>
	      </tr>
		 <tr>
		   <td colspan="5"><div align="center"><span style="color: #000">
           <?php 
		   		if(strlen($cod)==0){
					echo '<input type="submit" name="BTNcrea" id="BTNcrea" class="button" value="CREAR PRESUPUESTO">';
					
				}else{
					 if($est_accion!="disabled"){
					echo '<input type="submit" name="BTNmod" id="BTNmod" class="button" value="MODIFICAR PRESUPUESTO">
						  <input type="submit" name="BTNelimina" id="BTNelimina" class="button" value="ELIMINAR PRESUPUESTO">
             			  <input type="submit" name="BTNcreaOC" id="BTNcreaOC" class="button" value="GENERAR OC">';
					 }else{
						 echo '<input type="submit" name="BTNdup" id="BTNdup" class="button" value="DUPLICAR PRESUPUESTO">';
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