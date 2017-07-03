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
		
	 $codche 	= $_GET['codche'];
	 $DEL 		= $_GET['DEL'];
	 $cod 		= $_GET['cod'];
	 
 if(strlen($DEL)!=0){//Si borra un archivo
	 
	 $cod_fac_ing = $_GET['codfac'];
	  	
	if ($DEL == "F"){
		$CampoDel = "arch_fac_ing";
	}	 
		$db0  = conecto();
		$sql0 = " update facturas_ingresantes set ".$CampoDel."  = '' where cod_fac_ing = '".$cod_fac_ing."' ";
		#echo $sql0;exit();
		$r0   = mysqli_query($db0, $sql0);

		if ($r0 == false){
	    	mysqli_close($db0);
	        $error = "Error: (" . mysql_errno() . ") " . mysql_error().")";
	        //gestion_errores();
	    }
	      mysqli_close($db0);
 }//Si borra un archivo	 

 if(strlen($codche)!=0){//SI borra un cheque

	$db_delche  = conecto(); 	
	$sql_delche = " DELETE FROM cheques where cod_che = ".$codche." ";		
	#echo $sql_delche;exit();
	$r_delche   = mysqli_query($db_delche, $sql_delche);
				
	if ($r_delche == false){
		mysqli_close($db_delche);
		$error = "Error: (" . mysql_errno() . ") " . mysql_error().")";
		//gestion_errores();
	}
					
		mysqli_close($db_delche);	
 }//fin SI borra un cheque
	
if($_POST){//SEGUNDOS POST

	$cod 	= $_GET['cod'];
	$accion = $_GET['accion'];

	
	if($_POST['BTNALTA']){
		
		$Xtodo_ok 		= true;
		$Xerror_num 	= "";
		$Xerror = "";
		$accion = $_GET['accion'];
		$lugar 	= $_GET['lugar'];	
  
// Formateo las variables: 
		$NUMFacIng 		= "";
		$RDODES 		= "";
		$FILEfactu 		= "";
		$LSTfechaFI 	= "";
		$RDObancoFI 	= "";
		$TXTBancoFI 	= "";
        $TXTIvaIngBru 	= "";
		$TXTGanancia 	= "";
		$NUMIvaIns 		= "";
		$NUMIvaNoIns 	= "";
		$NUMRemito 		= "";
		$TXTIibb 		= "";
		$TXTNoGrab 		= "";
		$NUMMonTotal	= "";
		$TXTGrab		= "";
		
		$NUMFacIng 		= trim($_POST['NUMFacIng']);
		$RDODES 		= trim($_POST['RDODES']);
		$FILEfactu 		= $_FILES['FILEfactu']['name'];
		$LSTfechaFI 	= trim($_POST['LSTfechaFI_anio'].'-'.$_POST['LSTfechaFI_mes'].'-'.$_POST['LSTfechaFI_dia']);
		$RDObancoFI 	= trim($_POST['RDObancoFI']);
		$TXTBancoFI 	= trim($_POST['TXTBancoFI']);
        $TXTIvaIngBru 	= trim($_POST['TXTIvaIngBru']);
		$TXTGanancia 	= trim($_POST['TXTGanancia']);
		$NUMIvaIns 		= trim($_POST['NUMIvaIns']);
		$NUMIvaNoIns 	= trim($_POST['NUMIvaNoIns']);
		$NUMRemito 		= trim($_POST['NUMRemito']);
		$TXTIibb 		= trim($_POST['TXTIibb']);
		$TXTNoGrab 		= trim($_POST['TXTNoGrab']);
		$NUMMonTotal	= trim($_POST['NUMMonTotal']);
		$TXTGrab		= trim($_POST['TXTGrab']);
		
		if(strlen($cod_fac_ing)==0){$cod_fac_ing = "";}
		if(strlen($lugar)==0){$lugar = "";}
		
		if(strlen($NUMFacIng)==0){$NUMFacIng = "";}
		if(strlen($RDODES)==0){$RDODES = "";}
		if(strlen($FILEfactu)==0){$FILEfactu = "";}
		
		if(strlen($LSTfechaFI)<4){$LSTfechaFI = "";}
		if(strlen($RDObancoFI)==0){$RDObancoFI = "";}
		if(strlen($TXTIvaIngBru)==0){$TXTIvaIngBru = "";}
		if(strlen($TXTGanancia)==0){$TXTGanancia = "";}
		
		if(strlen($NUMIvaIns)==0){$NUMIvaIns = "";}
		if(strlen($NUMIvaNoIns)==0){$NUMIvaNoIns = "";}
		if(strlen($NUMRemito)==0){$NUMRemito = "";}
		if(strlen($TXTIibb)==0){$TXTIibb = "";}
		
		if(strlen($TXTNoGrab)==0){$TXTNoGrab = "";}
		if(strlen($NUMMonTotal)==0){$NUMMonTotal = "";}
		if(strlen($TXTGrab)==0){$TXTGrab = "";}

		#Datos del cheque//////////////////////////////////////////////////////
		$TXTBcoEmiCHE 	= strtoupper(trim($_POST['TXTBcoEmiCHE']));
		$TXTNroEmiCHE 	= trim($_POST['TXTNroEmiCHE']);
		$FEEmiChe 		= trim($_POST['FEEmiChe_anio'].'-'.$_POST['FEEmiChe_mes'].'-'.$_POST['FEEmiChe_dia']);
		$TXTPerEmiCHE 	= strtoupper(trim($_POST['TXTPerEmiCHE']));
		$TXTObservaCHE  = trim($_POST['TXTObservaCHE']);
		
		$FESalCHE 		= trim($_POST['FESalCHE_anio'].'-'.$_POST['FESalCHE_mes'].'-'.$_POST['FESalCHE_dia']);
		$TXTConIngCHE	= strtoupper(trim($_POST['TXTConIngCHE']));
		$TXTConSalCHE	= strtoupper(trim($_POST['TXTConSalCHE']));
		$TXTFeDifCHE	= trim($_POST['TXTFeDifCHE_anio'].'-'.$_POST['TXTFeDifCHE_mes'].'-'.$_POST['TXTFeDifCHE_dia']);
		$TXTMonChe		= strtoupper(trim($_POST['TXTMonChe']));
		
		#Formateo lOS CHEQUES
		if(strlen($TXTBcoEmiCHE)==0){$TXTBcoEmiCHE = "";}	
		if(strlen($TXTNroEmiCHE)==0){$TXTNroEmiCHE = "";}	
		if(strlen($FEEmiChe)<4){$FEEmiChe = "";}	
		if(strlen($TXTPerEmiCHE)==0){$TXTPerEmiCHE = "";}	
		if(strlen($TXTObservaCHE)==0){$TXTObservaCHE = "";}	
		
		if(strlen($FESalCHE)<4){$FESalCHE = "";}	
		if(strlen($TXTConIngCHE)==0){$TXTConIngCHE = "";}	
		if(strlen($TXTConSalCHE)==0){$TXTConSalCHE = "";}
		if(strlen($TXTMonChe)==0){$TXTMonChe = "";}		
		if(strlen($TXTFeDifCHE)<4){$TXTFeDifCHE = "";}	
		
//
//---------------VALIDACIONES  ----------------------
		
		if(strlen($NUMFacIng)==0){
			$Xtodo_ok = FALSE;
			$Xerror_num.= " NRO DE FACTURA ";
		}else{
			if(!is_numeric($NUMFacIng)){
				$Xtodo_ok = FALSE;
				$Xerror_num.= " NRO DE FACTURA ";		
				}
		}
//------------------------------------------------------
		if(strlen($TXTIvaIngBru)==0){
			$TXTIvaIngBru 	= "";
			}else{
				if(!is_numeric($TXTIvaIngBru)){
					$Xtodo_ok = FALSE;
					$Xerror_num.= " IVA INGRESOS BRUSTOS ";		
					}
				}
//------------------------------------------------------
		if(strlen($TXTGanancia)==0){
			$TXTGanancia 	= "";
			}else{
				if(!is_numeric($TXTGanancia)){
					$Xtodo_ok = FALSE;
					$Xerror_num.= " GANANCIAS ";		
					}
				}
			
//------------------------------------------------------
		if(strlen($NUMIvaIns)==0){
			$NUMIvaIns 	= "";
			}else{
				if(!is_numeric($NUMIvaIns)){
					$Xtodo_ok = FALSE;
					$Xerror_num.= " IVA INSCRIPTO ";		
					}
				}
//------------------------------------------------------
		if(strlen($NUMIvaNoIns)==0){
			$NUMIvaNoIns 	= "";
			}else{
				if(!is_numeric($NUMIvaNoIns)){
					$Xtodo_ok = FALSE;
					$Xerror_num.= " IVA NO INSCRIPTO ";		
					}
				}
//------------------------------------------------------
		if(strlen($NUMRemito)==0){
			$NUMRemito 	= "";
			}else{
				if(!is_numeric($NUMRemito)){
					$Xtodo_ok = FALSE;
					$Xerror_num.= " NUMERO DE REMITO ";		
					}
				}
//------------------------------------------------------
		if(strlen($TXTIibb)==0){
			$TXTIibb 	= "";
			}else{
				if(!is_numeric($TXTIibb)){
					$Xtodo_ok = FALSE;
					$Xerror_num.= " RECEPCION IIBB  ";		
					}
				}
//------------------------------------------------------
		if(strlen($TXTNoGrab)==0){
			$TXTNoGrab 	= "";
		}else{
			if(!is_numeric($TXTNoGrab)){
					$Xtodo_ok = FALSE;
					$Xerror_num.= " NO GRABADO ";		
				}
		}
//------------------------------------------------------

		if(strlen($NUMMonTotal)==0){
			$NUMMonTotal 	= "";
		}else{
			if(!is_numeric($NUMMonTotal)){
					$Xtodo_ok = FALSE;
					$Xerror_num.= " TOTAL ";		
				}
		}
//------------------------------------------------------		
		if(strlen($TXTGrab)==0){
			$TXTGrab 	= "";
		}else{
			if(!is_numeric($TXTGrab)){
					$Xtodo_ok = FALSE;
					$Xerror_num.= " GRABADO ";		
				}
		}		
//------------------------------------------------------
	if($RDObancoFI=="C"){
		if(strlen($TXTNroEmiCHE)==0){
			$TXTNroEmiCHE = "";
		}else{
			if(!is_numeric($TXTNroEmiCHE)){
				$Xtodo_ok = FALSE;
				$Xerror_num.= " NUMERO CHEQUE ";		
			}
		}

		if(strlen($TXTMonChe)==0){
				$Xtodo_ok = FALSE;
				$Xerror_num.= " INGRESE UN MONTO DEL CHEQUE ";	
		}else{
			if(!is_numeric($TXTMonChe)){
				$Xtodo_ok = FALSE;
				$Xerror_num.= " MONTO CHEQUE ";		
			}
		}		
	}
//------------------------------------------------------
		if(strlen($Xerror_num)!=0){
			$Xerror_num.= " DEBE/DEBEN SER NUMERICO/NUMERICOS ";
		}	
			
		if($Xtodo_ok==true){
			
			//  guardo los datos en la base correspondiente  ///////////////	
			$db2  = conecto(); 
			$sql2 = " INSERT INTO facturas_ingresantes 
			(lugar_fac_ing, cod_ord, arch_fac_ing, nro_fac_ing, fe_a_fac_ing, met_pag_fac_ing, banco_fac_ing, tipo_fac_ing, percep_iva_fac_ing,	ganancias_fac_ing, gravado_fac_ing, iva_ins_fac_ing, iva_no_ins_fac_ing, nro_remito_fac_ing, recep_iibb_fac_ing, no_grabado_fac_ing, total_fac_ing) VALUES ('".$lugar."', '".$cod."', '".$FILEfactu."', '".$NUMFacIng."', '".$LSTfechaFI."', '".$RDObancoFI."', '".$TXTBancoFI."', '".$RDODES."', '".$TXTIvaIngBru."', '".$TXTGanancia."', '".$TXTGrab."', '".$NUMIvaIns."', '".$NUMIvaNoIns."', '".$NUMRemito."', '".$TXTIibb."', '".$TXTNoGrab."', '".$NUMMonTotal."') ";
			
			#echo $sql2;exit();
			$r2   = mysqli_query($db2, $sql2);
	
			if ($r2 == false){
				mysqli_close($db2);
				$error = "Error: (" . mysql_errno() . ") " . mysql_error().")";
				//gestion_errores();
			}
				$Xultimocod_AC = mysqli_insert_id($db2);
				mysqli_close($db2);	


//-------------------------------------------- UPLOAD DE ARCHIVOS -----------------------	
		//para el alta de las carpetas
		$raiz		= "../ordenes/";
		$estructura = $raiz . trim($NUMFacIng);
		
		if(!mkdir($estructura, 0777, true))//si no se creo la carpeta, la creo y meto los datos
		{
				
	//########################### ARCHIVO DE FILEPacLis ############################### 
			$FILEfactu			= $_FILES['FILEfactu']['name'];
			$tmp_FILEfactu 		= $_FILES['FILEfactu']['tmp_name'];
			$errorFILEfactu 	= $_FILES['FILEfactu']['error'];
			suboarchivos($estructura,$FILEfactu,$tmp_FILEfactu,$errorFILEfactu,$cod); 		
		
 		}else{//Si la carpeta existe, tiro solo los datos dentro.

			$FILEfactu			= $_FILES['FILEfactu']['name'];
			$tmp_FILEfactu 		= $_FILES['FILEfactu']['tmp_name'];
			$errorFILEfactu 	= $_FILES['FILEfactu']['error'];
			suboarchivos($estructura,$FILEfactu,$tmp_FILEfactu,$errorFILEfactu,$cod);  
								
		}//FIN si salio todo genial	
//-------------------------------------------- UPLOAD DE ARCHIVOS -----------------------


		if(strlen($TXTBcoEmiCHE)!=0){//Si agrego un cheque..
				
			$db5  = conecto(); 
			$sql5 = " INSERT INTO cheques (cod_ord, lugar_che, bco_emi_che, nro_che, fe_emi_che, emi_che, paga_che, observa_che, cod_ref, fe_sal_che, fe_dif_che, monto_che) VALUES ('".$cod."','".$lugar."','".$TXTBcoEmiCHE."','".$TXTNroEmiCHE."','".$FEEmiChe."','".$TXTPerEmiCHE."','".$TXTPagadoCHE."','".$TXTObservaCHE."','".$Xultimocod_AC."','".$FESalCHE."','".$TXTFeDifCHE."','".$TXTMonChe."') "; 
			//echo $sql5;exit();
			$r5   = mysqli_query($db5, $sql5);
			if ($r5 == false){
				mysqli_close($db5);
				$error = "Error: (" . mysql_errno() . ") " . mysql_error().")";
				//gestion_errores();
			}
				
				mysqli_close($db5);			
		
		}//fin Si agrego un cheque..
						
//-------------------------------------------- UPLOAD DE ARCHIVOS -----------------------	
			//para el alta de las carpetas
			$raiz		= "../ordenes/";
			$estructura = $raiz . trim($cod);
		
			if(!mkdir($estructura, 0777, true))//si no se creo la carpeta, la creo y meto los datos
			{
				
//########################### ARCHIVO DE DESPACHO ############################### 
				$FILEdespa		= $_FILES['FILEfactu']['name'];
				$tmp_namedespa	= $_FILES['FILEfactu']['tmp_name'];
				$errordespa		= $_FILES['FILEfactu']['error'];
				suboarchivos($estructura,$FILEfactu,$tmp_namedespa,$errordespa,$cod); 
			
			}else{//si salio todo genial

//########################### ARCHIVO DE DESPACHO ############################### 
				$FILEdespa		= $_FILES['FILEfactu']['name'];
				$tmp_namedespa	= $_FILES['FILEfactu']['tmp_name'];
				$errordespa 	= $_FILES['FILEfactu']['error'];
				suboarchivos($estructura,$FILEfactu,$tmp_namedespa,$errordespa,$cod);  
								
			}//FIN si salio todo genial				
//-------------------------------------------- UPLOAD DE ARCHIVOS -----------------------
		
		echo "<script language='javascript'>
				 alert('El Registro a sido Creado');
				window.location.href='../veoordenes.php?cod=$cod'; </script>"; 	
		}
	}// FIN ALTA 
	
	

	if($_POST['BTNMOD']){
		
		$Xtodo_ok 		= true;
		$Xerror_num 	= "";
		$Xerror 		= "";
		$accion 		= $_GET['accion'];
		$lugar 			= $_GET['lugar'];
		$cod_fac_ing 	= $_GET['codfac'];	
       
// Formateo las variables: 
		$NUMFacIng 		= "";
		$RDODES 		= "";
		$FILEfactu 		= "";
		$LSTfechaFI 	= "";
		$RDObancoFI 	= "";
		$TXTBancoFI 	= "";
        $TXTIvaIngBru 	= "";
		$TXTGanancia 	= "";
		$NUMIvaIns 		= "";
		$NUMIvaNoIns 	= "";
		$NUMRemito 		= "";
		$TXTIibb 		= "";
		$TXTNoGrab 		= "";
		$NUMMonTotal	= "";
		$TXTGrab		= "";
		$factu			= "";

		$NUMFacIng 		= trim($_POST['NUMFacIng']);
		$RDODES 		= trim($_POST['RDODES']);
		$FILEfactu 		= $_FILES['FILEfactu']['name'];
		$LSTfechaFI 	= trim($_POST['LSTfechaFI_anio'].'-'.$_POST['LSTfechaFI_mes'].'-'.$_POST['LSTfechaFI_dia']);
		$RDObancoFI 	= trim($_POST['RDObancoFI']);
		$TXTBancoFI 	= trim($_POST['TXTBancoFI']);
        $TXTIvaIngBru 	= trim($_POST['TXTIvaIngBru']);
		$TXTGanancia 	= trim($_POST['TXTGanancia']);
		$NUMIvaIns 		= trim($_POST['NUMIvaIns']);
		$NUMIvaNoIns 	= trim($_POST['NUMIvaNoIns']);
		$NUMRemito 		= trim($_POST['NUMRemito']);
		$TXTIibb 		= trim($_POST['TXTIibb']);
		$TXTNoGrab 		= trim($_POST['TXTNoGrab']);
		$NUMMonTotal	= trim($_POST['NUMMonTotal']);
		$TXTGrab		= trim($_POST['TXTGrab']);
		$factu			= trim($_POST['factu']);
		
		if(strlen($cod_fac_ing)==0){$cod_fac_ing = "";}
		if(strlen($lugar)==0){$lugar = "";}
		
		if(strlen($NUMFacIng)==0){$NUMFacIng = "";}
		if(strlen($RDODES)==0){$RDODES = "";}
		if(strlen($FILEfactu)==0){$FILEfactu = "";}
		
		if(strlen($LSTfechaFI)<4){$LSTfechaFI = "";}
		if(strlen($RDObancoFI)==0){$RDObancoFI = "";}
		if(strlen($TXTIvaIngBru)==0){$TXTIvaIngBru = "";}
		if(strlen($TXTGanancia)==0){$TXTGanancia = "";}
		
		if(strlen($NUMIvaIns)==0){$NUMIvaIns = "";}
		if(strlen($NUMIvaNoIns)==0){$NUMIvaNoIns = "";}
		if(strlen($NUMRemito)==0){$NUMRemito = "";}
		if(strlen($TXTIibb)==0){$TXTIibb = "";}
		
		if(strlen($TXTNoGrab)==0){$TXTNoGrab = "";}
		if(strlen($NUMMonTotal)==0){$NUMMonTotal = "";}
		if(strlen($TXTGrab)==0){$TXTGrab = "";}
		if(strlen($factu)==0){$factu = "";}
		
		#Datos del cheque//////////////////////////////////////////////////////
		$TXTBcoEmiCHE 	= strtoupper(trim($_POST['TXTBcoEmiCHE']));
		$TXTNroEmiCHE 	= trim($_POST['TXTNroEmiCHE']);
		$FEEmiChe 		= trim($_POST['FEEmiChe_anio'].'-'.$_POST['FEEmiChe_mes'].'-'.$_POST['FEEmiChe_dia']);
		$TXTPerEmiCHE 	= strtoupper(trim($_POST['TXTPerEmiCHE']));
		$TXTObservaCHE  = trim($_POST['TXTObservaCHE']);
		
		$FESalCHE 		= trim($_POST['FESalCHE_anio'].'-'.$_POST['FESalCHE_mes'].'-'.$_POST['FESalCHE_dia']);
		$TXTConIngCHE	= strtoupper(trim($_POST['TXTConIngCHE']));
		$TXTConSalCHE	= strtoupper(trim($_POST['TXTConSalCHE']));
		$TXTFeDifCHE	= trim($_POST['TXTFeDifCHE_anio'].'-'.$_POST['TXTFeDifCHE_mes'].'-'.$_POST['TXTFeDifCHE_dia']);
		$TXTMonChe		= strtoupper(trim($_POST['TXTMonChe']));
		
		#Formateo lOS CHEQUES
		if(strlen($TXTBcoEmiCHE)==0){$TXTBcoEmiCHE = "";}	
		if(strlen($TXTNroEmiCHE)==0){$TXTNroEmiCHE = "";}	
		if(strlen($FEEmiChe)<4){$FEEmiChe = "";}	
		if(strlen($TXTPerEmiCHE)==0){$TXTPerEmiCHE = "";}	
		if(strlen($TXTObservaCHE)==0){$TXTObservaCHE = "";}	
		
		if(strlen($FESalCHE)<4){$FESalCHE = "";}	
		if(strlen($TXTConIngCHE)==0){$TXTConIngCHE = "";}	
		if(strlen($TXTConSalCHE)==0){$TXTConSalCHE = "";}		
		if(strlen($TXTFeDifCHE)<4){$TXTFeDifCHE = "";}	
		if(strlen($TXTMonChe)==0){$TXTMonChe = "";}
		
		
		$F ="";
		
		if(strlen($FILEfactu)!=0){
			 $F =	$FILEfactu;
		}
		
		if(strlen($factu)!=0){
			 $F =	$factu;
		}
		
		
//---------------VALIDACIONES  ----------------------

		if(strlen($NUMFacIng)==0){
				$Xtodo_ok = FALSE;
				$Xerror_num.= " NRO DE FACTURA ";
		}else{
			if(!is_numeric($NUMFacIng)){
				$Xtodo_ok = FALSE;
				$Xerror_num.= " NRO DE FACTURA ";		
				}
		}
//------------------------------------------------------
		if(strlen($TXTIvaIngBru)==0){
			$TXTIvaIngBru 	= "";
			}else{
				if(!is_numeric($TXTIvaIngBru)){
					$Xtodo_ok = FALSE;
					$Xerror_num.= " IVA INGRESOS BRUSTOS ";		
					}
				}
//------------------------------------------------------
		if(strlen($TXTGanancia)==0){
			$TXTGanancia 	= "";
			}else{
				if(!is_numeric($TXTGanancia)){
					$Xtodo_ok = FALSE;
					$Xerror_num.= " GANANCIAS ";		
					}
				}
			
//------------------------------------------------------
		if(strlen($NUMIvaIns)==0){
			$NUMIvaIns 	= "";
			}else{
				if(!is_numeric($NUMIvaIns)){
					$Xtodo_ok = FALSE;
					$Xerror_num.= " IVA INSCRIPTO ";		
					}
				}
//------------------------------------------------------
		if(strlen($NUMIvaNoIns)==0){
			$NUMIvaNoIns 	= "";
			}else{
				if(!is_numeric($NUMIvaNoIns)){
					$Xtodo_ok = FALSE;
					$Xerror_num.= " IVA NO INSCRIPTO ";		
					}
				}
//------------------------------------------------------
		if(strlen($NUMRemito)==0){
			$NUMRemito 	= "";
			}else{
				if(!is_numeric($NUMRemito)){
					$Xtodo_ok = FALSE;
					$Xerror_num.= " NUMERO DE REMITO ";		
					}
				}
//------------------------------------------------------
		if(strlen($TXTIibb)==0){
			$TXTIibb 	= "";
			}else{
				if(!is_numeric($TXTIibb)){
					$Xtodo_ok = FALSE;
					$Xerror_num.= " RECEPCION IIBB  ";		
					}
				}
//------------------------------------------------------
		if(strlen($TXTNoGrab)==0){
			$TXTNoGrab 	= "";
		}else{
			if(!is_numeric($TXTNoGrab)){
					$Xtodo_ok = FALSE;
					$Xerror_num.= " NO GRABADO ";		
				}
		}
//------------------------------------------------------

		if(strlen($NUMMonTotal)==0){
			$NUMMonTotal 	= "";
		}else{
			if(!is_numeric($NUMMonTotal)){
					$Xtodo_ok = FALSE;
					$Xerror_num.= " TOTAL ";		
				}
		}
//------------------------------------------------------		
		if(strlen($TXTGrab)==0){
			$TXTGrab 	= "";
		}else{
			if(!is_numeric($TXTGrab)){
					$Xtodo_ok = FALSE;
					$Xerror_num.= " GRABADO ";		
				}
		}	


 if($RDObancoFI=="C"){	#Si es un chequeeee		
//------------------------------------------------------
		if(strlen($TXTNroEmiCHE)==0){
			$TXTNroEmiCHE = "";	
		}else{
			if(!is_numeric($TXTNroEmiCHE)){
				$Xtodo_ok = FALSE;
				$Xerror_num.= " NUMERO CHEQUE ";		
			}
		}
//------------------------------------------------------
		if(strlen($TXTMonChe)==0){
				$Xtodo_ok = FALSE;
				$Xerror_num.= " INGRESE UN MONTO DEL CHEQUE ";	
		}else{
			if(!is_numeric($TXTMonChe)){
				$Xtodo_ok = FALSE;
				$Xerror_num.= " MONTO CHEQUE ";		
			}
		}	
 }
 
		if(strlen($Xerror_num)!=0){
			$Xerror_num.= " DEBE/DEBEN SER NUMERICO/NUMERICOS ";
		}	
	
	if($Xtodo_ok==true){
			
		$db3  = conecto();
		$sql3 = " update facturas_ingresantes set 
					arch_fac_ing  = '".$F."',
					nro_fac_ing  = '".$NUMFacIng."',
					fe_a_fac_ing  = '".$LSTfechaFI."',
					met_pag_fac_ing  = '".$RDObancoFI."',
					banco_fac_ing  = '".$TXTBancoFI."',
					tipo_fac_ing = '".$RDODES."',					
					percep_iva_fac_ing  = '".$TXTIvaIngBru."',
					ganancias_fac_ing  = '".$TXTGanancia."',
					gravado_fac_ing  = '".$TXTGrab."',
					iva_ins_fac_ing  = '".$NUMIvaIns."',
					iva_no_ins_fac_ing  = '".$NUMIvaNoIns."',
					nro_remito_fac_ing = '".$NUMRemito."',
					recep_iibb_fac_ing  = '".$TXTIibb."',
					no_grabado_fac_ing  = '".$TXTNoGrab."',
					total_fac_ing  = '".$NUMMonTotal."'								
					where cod_ord = ".$cod." and cod_fac_ing = ".$cod_fac_ing." ";
		#echo $sql3;exit();		
		$r3   = mysqli_query($db3, $sql3);

		if ($r3 == false){
	    	mysqli_close($db3);
	        $error = "Error: (" . mysql_errno() . ") " . mysql_error().")";
	        //gestion_errores();
	    }
	      mysqli_close($db3);


	if(strlen($TXTBcoEmiCHE)!=0){//Si agrego un cheque..		
		
		$db5  = conecto(); 
		$sql5 = " INSERT INTO cheques (cod_ord, lugar_che, bco_emi_che, nro_che, fe_emi_che, emi_che, paga_che, observa_che, cod_ref, fe_sal_che, fe_dif_che, monto_che) VALUES ('".$cod."','".$lugar."','".$TXTBcoEmiCHE."','".$TXTNroEmiCHE."','".$FEEmiChe."','".$TXTPerEmiCHE."','".$TXTPagadoCHE."','".$TXTObservaCHE."','".$cod_fac_ing."','".$FESalCHE."','".$TXTFeDifCHE."','".$TXTMonChe."') ";
			
		//echo $sql5;exit();
		$r5   = mysqli_query($db5, $sql5);
		if ($r5 == false){
			mysqli_close($db5);
			$error = "Error: (" . mysql_errno() . ") " . mysql_error().")";
			//gestion_errores();
		}
				
			mysqli_close($db5);	
			
	}//Si agrego un cheque..
	
//-------------------------------------------- UPLOAD DE ARCHIVOS -----------------------	
			//para el alta de las carpetas
			$raiz		= "../ordenes/";
			$estructura = $raiz . trim($cod);
		
			if(!mkdir($estructura, 0777, true))//si no se creo la carpeta, la creo y meto los datos
			{
				
//########################### ARCHIVO DE DESPACHO ############################### 
				$FILEdespa		= $_FILES['FILEfactu']['name'];
				$tmp_namedespa	= $_FILES['FILEfactu']['tmp_name'];
				$errordespa		= $_FILES['FILEfactu']['error'];
				suboarchivos($estructura,$FILEfactu,$tmp_namedespa,$errordespa,$cod); 
			
			}else{//si salio todo genial

//########################### ARCHIVO DE DESPACHO ############################### 
				$FILEdespa		= $_FILES['FILEfactu']['name'];
				$tmp_namedespa	= $_FILES['FILEfactu']['tmp_name'];
				$errordespa 	= $_FILES['FILEfactu']['error'];
				suboarchivos($estructura,$FILEfactu,$tmp_namedespa,$errordespa,$cod);  
								
			}//FIN si salio todo genial				
//-------------------------------------------- UPLOAD DE ARCHIVOS -----------------------
		
		echo "<script language='javascript'>
				 alert('El Registro a sido Modificado');
				window.location.href='../veoordenes.php?cod=$cod'; </script>"; 				
	}
}
	#Si agrega un cheque
	if($_POST['BTNAgrChe']){
		
		$Xtodo_ok 		= true;
		$Xerror_num 	= "";
		$Xerror 		= "";
		$accion 		= $_GET['accion'];
		$lugar 			= $_GET['lugar'];
		$cod_fac_ing 	= $_GET['codfac'];	
       				
		if(strlen($cod_fac_ing)==0){$cod_fac_ing = "";}
		if(strlen($lugar)==0){$lugar = "";}
				
		#Datos del cheque//////////////////////////////////////////////////////
		$TXTBcoEmiCHE 	= strtoupper(trim($_POST['TXTBcoEmiCHE']));
		$TXTNroEmiCHE 	= trim($_POST['TXTNroEmiCHE']);
		$FEEmiChe 		= trim($_POST['FEEmiChe_anio'].'-'.$_POST['FEEmiChe_mes'].'-'.$_POST['FEEmiChe_dia']);
		$TXTPerEmiCHE 	= strtoupper(trim($_POST['TXTPerEmiCHE']));
		$TXTObservaCHE  = trim($_POST['TXTObservaCHE']);
		
		$FESalCHE 		= trim($_POST['FESalCHE_anio'].'-'.$_POST['FESalCHE_mes'].'-'.$_POST['FESalCHE_dia']);
		$TXTConIngCHE	= strtoupper(trim($_POST['TXTConIngCHE']));
		$TXTConSalCHE	= strtoupper(trim($_POST['TXTConSalCHE']));
		$TXTFeDifCHE	= trim($_POST['TXTFeDifCHE_anio'].'-'.$_POST['TXTFeDifCHE_mes'].'-'.$_POST['TXTFeDifCHE_dia']);
		$TXTMonChe		= strtoupper(trim($_POST['TXTMonChe']));
		
		#Formateo lOS CHEQUES
		if(strlen($TXTBcoEmiCHE)==0){$TXTBcoEmiCHE = "";}	
		if(strlen($TXTNroEmiCHE)==0){$TXTNroEmiCHE = "";}	
		if(strlen($FEEmiChe)<4){$FEEmiChe = "";}	
		if(strlen($TXTPerEmiCHE)==0){$TXTPerEmiCHE = "";}	
		if(strlen($TXTObservaCHE)==0){$TXTObservaCHE = "";}	
		
		if(strlen($FESalCHE)<4){$FESalCHE = "";}	
		if(strlen($TXTConIngCHE)==0){$TXTConIngCHE = "";}	
		if(strlen($TXTConSalCHE)==0){$TXTConSalCHE = "";}		
		if(strlen($TXTFeDifCHE)<4){$TXTFeDifCHE = "";}	
		if(strlen($TXTMonChe)==0){$TXTMonChe = "";}
		
		if(strlen($TXTBcoEmiCHE)!=0){//Si agrego un cheque..		
			
			$db5  = conecto(); 
			$sql5 = " INSERT INTO cheques (cod_ord, lugar_che, bco_emi_che, nro_che, fe_emi_che, emi_che, paga_che, observa_che, cod_ref, fe_sal_che, fe_dif_che, monto_che) VALUES ('".$cod."','".$lugar."','".$TXTBcoEmiCHE."','".$TXTNroEmiCHE."','".$FEEmiChe."','".$TXTPerEmiCHE."','".$TXTPagadoCHE."','".$TXTObservaCHE."','".$cod_fac_ing."','".$FESalCHE."','".$TXTFeDifCHE."','".$TXTMonChe."') ";
				
			//echo $sql5;exit();
			$r5   = mysqli_query($db5, $sql5);
			if ($r5 == false){
				mysqli_close($db5);
				$error = "Error: (" . mysql_errno() . ") " . mysql_error().")";
				//gestion_errores();
			}
					
				mysqli_close($db5);	
				
		}//Si agrego un cheque..

		echo "<script language='javascript'>
				 alert('El Registro a sido Modificado');
				window.location.href='facing.php?accion=MOD&cod=".$cod."&codfac=".$cod_fac_ing."&lugar=".$lugar."'; </script>"; 	
								
	}
	#Fin Si agrega un cheque
	
	if($_POST['BTNELI']){
		$lugar 		 = $_GET['lugar'];
		$cod_fac_ing = $_GET['codfac'];	
		
		$db4  = conecto();
		$sql4 = " delete from facturas_ingresantes where cod_fac_ing = ".$cod_fac_ing." ";
		$r4   = mysqli_query($db4, $sql4);

		if ($r4 == false){
	    	mysqli_close($db4);
	        $error = "Error: (" . mysql_errno() . ") " . mysql_error().")";
	        //gestion_errores();
	    }
	      mysqli_close($db4);

		#if(strlen($TXTBcoEmiCHE)!=0){// ELIMINO CHEQUE
		//Si tenia uno o mas cheques y cambio la opcion, se elimina el cheque..
		#if(($RDObancoDES=="E")||($RDObancoDES=="B")){ 
							
		$db_delche  = conecto(); 
		$sql_delche = " DELETE FROM cheques where cod_ord = ".$cod." and lugar_che  = '".$lugar."' and cod_ref  = '".$cod_fac_ing."'  ";		
		#echo $sql_delche;exit();
		$r_delche   = mysqli_query($db_delche, $sql_delche);
				
		if ($r_delche == false){
			mysqli_close($db_delche);
			$error = "Error: (" . mysql_errno() . ") " . mysql_error().")";
			//gestion_errores();
		}
					
			mysqli_close($db_delche);			
		#}
		#	}//FIN ELIMINO CHEQUE	
				  
		echo "<script language='javascript'>
				 alert('El Registro a sido Eliminado');
				window.location.href='../veoordenes.php?cod=$cod'; </script>"; 	
	}
	
	if($_POST['BTNvolver']){//volver al menu
 		header ('location:../veoordenes.php?cod='.$cod);
		exit();		
	}			
}
else{ // PRIMER POST
	
	$Xerror = "";
	
	$cod 	= $_GET['cod'];
	$accion = $_GET['accion'];
	$lugar 	= $_GET['lugar'];
	$codfac = $_GET['codfac'];
	
	$veo_cheque = "N";
	$Xerror_num	= "";
       
// Formateo las variables: 
		$NUMFacIng 		= "";
		$RDODES 		= "";
		$FILEfactu 		= "";
		$LSTfechaFI 	= "";
		$RDObancoFI 	= "";
		$TXTBancoFI 	= "";
        $TXTIvaIngBru 	= "";
		$TXTGanancia 	= "";
		$NUMIvaIns 		= "";
		$NUMIvaNoIns 	= "";
		$NUMRemito 		= "";
		$TXTIibb 		= "";
		$TXTNoGrab 		= "";
		$NUMMonTotal	= "";
		$TXTGrab		= "";

		$TXTBcoEmiCHE 	= "";
		$TXTNroEmiCHE 	= "";
		$FEEmiChe 		= "";
		$TXTPerEmiCHE 	= "";
		$TXTObservaCHE  = "";
			
		$FESalCHE  		= "";
		$TXTConIngCHE  	= "";
		$TXTConSalCHE   = "";
		$TXTFeDifCHE  	= "";
		$cantidad		= "";
		#Metodo de pago obligatorio
		$RDObancoFI		="E";
								
	if(($accion == "MOD")or($accion == "ELI")){		
	
		#Datos Facturas de todos los tipos
		$db1  = conecto();
		$sql1 = "select * from facturas_ingresantes where cod_ord = ".$cod." and  cod_fac_ing = ".$codfac." ";
		$r1   = mysqli_query($db1, $sql1);
	
		if ($r1 == false){
	    	mysqli_close($db1);
	        $error = "Error: (" . mysql_errno() . ") " . mysql_error().")";
	        //gestion_errores();
	    }
	    	mysqli_close($db1);
			
		while ($arr1 = mysqli_fetch_array($r1))		
		{
			$cod_fac_ing 	= trim($arr1['cod_fac_ing']);
			$lugar			= trim($arr1['lugar_fac_ing']);
				
			$NUMFacIng 		= trim($arr1['nro_fac_ing']);
			$RDODES 		= trim($arr1['tipo_fac_ing']);
			$FILEfactu 		= trim($arr1['arch_fac_ing']);
			$LSTfechaFI 	= trim($arr1['fe_a_fac_ing']);
			
			$RDObancoFI 	= trim($arr1['met_pag_fac_ing']);
			$TXTBancoFI 	= trim($arr1['banco_fac_ing']);
			$TXTIvaIngBru 	= trim($arr1['percep_iva_fac_ing']);
			$TXTGanancia 	= trim($arr1['ganancias_fac_ing']);
			
			$NUMIvaIns 		= trim($arr1['iva_ins_fac_ing']);
			$NUMIvaNoIns 	= trim($arr1['iva_no_ins_fac_ing']);
			$NUMRemito 		= trim($arr1['nro_remito_fac_ing']);
			$TXTIibb 		= trim($arr1['recep_iibb_fac_ing']);
			
			$TXTNoGrab 		= trim($arr1['no_grabado_fac_ing']);
			$NUMMonTotal	= trim($arr1['total_fac_ing']);			
			$TXTGrab		= trim($arr1['gravado_fac_ing']);																										
		}				
				
		if(strlen($cod_fac_ing)==0){$cod_fac_ing = "";}
		if(strlen($lugar)==0){$lugar = "";}
		
		if(strlen($NUMFacIng)==0){$NUMFacIng = "";}
		if(strlen($RDODES)==0){$RDODES = "";}
		if(strlen($FILEfactu)==0){$FILEfactu = "";}
		
		if(strlen($LSTfechaFI)<4){$LSTfechaFI = "";}
		if(strlen($RDObancoFI)==0){$RDObancoFI = "";}
		if(strlen($TXTIvaIngBru)==0){$TXTIvaIngBru = "";}
		if(strlen($TXTGanancia)==0){$TXTGanancia = "";}
		
		if(strlen($NUMIvaIns)==0){$NUMIvaIns = "";}
		if(strlen($NUMIvaNoIns)==0){$NUMIvaNoIns = "";}
		if(strlen($NUMRemito)==0){$NUMRemito = "";}
		if(strlen($TXTIibb)==0){$TXTIibb = "";}
		
		if(strlen($TXTNoGrab)==0){$TXTNoGrab = "";}
		if(strlen($NUMMonTotal)==0){$NUMMonTotal = "";}
		if(strlen($TXTGrab)==0){$TXTGrab = "";}
		
		
#------------------------------------CHEQUES
		$db_vc  = conecto();
		$sql_vc = " select count(*) as canti from cheques where cod_ord = ".$cod." and lugar_che  = '".$lugar."' ";
		
		$r_vc	  = mysqli_query($db_vc, $sql_vc);
		//echo $sql_vc;exit();
		if ($r_vc == false){
			mysqli_close($db_vc);
			//$error = "Error: (" . mysql_errno() . ") " . mysql_error().")";
			gestion_errores();
		}
			mysqli_close($db_vc);	
		
		$arrx = mysqli_fetch_array($r_vc);
		$cantidad = $arrx['canti'];
		//echo $cantidad; exit();
		
		
		
		$dbch  = conecto();
		$sqlch = "select * from cheques where cod_ord = '".$cod."' and lugar_che = '".$lugar."' ";
		$rch   = mysqli_query($dbch, $sqlch);
	
		if ($rch == false){
	    	mysqli_close($dbch);
	        $error = "Error: (" . mysql_errno() . ") " . mysql_error().")";
	        //gestion_errores();
	    }
	    	mysqli_close($dbch);	
		/*while ($arrch = mysqli_fetch_array($rch))		
		{
			$TXTBcoEmiCHE 	= trim($arrch['bco_emi_che']);
			$TXTNroEmiCHE 	= trim($arrch['nro_che']);
			$FEEmiChe 		= trim($arrch['fe_emi_che']);
			$TXTPerEmiCHE 	= trim($arrch['emi_che']);
			$TXTObservaCHE  = trim($arrch['observa_che']);
			
			$FESalCHE  		= trim($arrch['fe_sal_che']);
			$TXTConIngCHE  	= trim($arrch['concep_ing_che']);
			$TXTConSalCHE  	= trim($arrch['concep_sal_che']);
			$TXTFeDifCHE  	= trim($arrch['fe_dif_che']);		
		}
		#Formateo lOS CHEQUES
		if(strlen($TXTBcoEmiCHE)==0){$TXTBcoEmiCHE = "";}	
		if(strlen($TXTNroEmiCHE)==0){$TXTNroEmiCHE = "";}	
		if(strlen($FEEmiChe)<4){$FEEmiChe = "";}	
		if(strlen($TXTPerEmiCHE)==0){$TXTPerEmiCHE = "";}	
		if(strlen($TXTObservaCHE)==0){$TXTObservaCHE = "";}	

		if(strlen($FESalCHE)<4){$FESalCHE = "";}	
		if(strlen($TXTConIngCHE)==0){$TXTConIngCHE = "";}	
		if(strlen($TXTConSalCHE)==0){$TXTConSalCHE = "";}		
		if(strlen($TXTFeDifCHE)<4){$TXTFeDifCHE = "";}	
 		*/
		if( strlen($TXTBcoEmiCHE)!=0 ){
			$veo_cheque = "S";
		}
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

    
    <script type="text/javascript">

        function toggle(elemento) {			   			
          if((elemento.value=="B")||(elemento.value=="E")) {
              document.getElementById("uno").style.display = "none";
              document.getElementById("dos").style.display = "none";
           }else{
               if(elemento.value=="C"){
                   document.getElementById("uno").style.display = "block";
                   document.getElementById("dos").style.display = "none";
               }
            }			
		}	
</script>
    
 </head>
<body>
	<div class="logo">_%%_empresanombre_%%_</div>
	<div id="page-wrap"> 
 	<form action="" method="post" name="form1" enctype="multipart/form-data" >   
    <?php include 'menu.php'; ?>

	<p>USUARIO: <?php echo $Xnombre; ?></p>
	<table class="sombra">
      <thead>
	          <tr>
	            <th colspan="5" align="center"><input name="cod_fac_ing"  id="cod_fac_ing"  value="<?php echo $cod_fac_ing; ?>" type="hidden"><div align="center">FACTURA DE <?php echo strtoupper($lugar); ?></div></th>
	            </tr>
	          </thead>
	        <tbody>
	          <tr>
	            <td colspan="5"><?php echo '<div align="center" style="color:red; font-weight: bold;">'.$Xerror." ".$Xerror_num.'</div>'; ?></td>
              </tr>
	          <tr>
	            <td colspan="5"><div align="center"><span style="color: #000"><strong>DETALLE</strong></span></div></td>
	            </tr>
	          <tr>
	            <td><strong>NUM. FACTURA:</strong></td>
	            <td><strong><input name="NUMFacIng" type="text" class="button" id="NUMFacIng" value="<?php echo $NUMFacIng; ?>" maxlength="20"></strong></td>
	            <td><strong>TIPO:</strong></td>
	            <td><strong>FACTURA:</strong><input name="RDODES" type="radio" class="button" id="RDODES" value="F" checked></td>
	            <td><strong>NOTA DE CREDITO:</strong><input name="RDODES" type="radio" class="button" id="RDODES" value="N"></td>
              </tr>
	          <tr>
	            <td ><strong>ARCHIVO:</strong> </td>
	            <td colspan="2" ><div align="center"><span style="color: #000">
	              <?php if(strlen($FILEfactu)!=0){?>	  	
	              <b>Nombre del archivo:</b>
	              <input type="text" value="<?php echo $FILEfactu; ?>" name="factu" id="factu"  class="button">
	              <?php } else { ?>
	              <input name="FILEfactu" type="file" id="FILEfactu" title="SELECCIONE.." class="button" style="width: 75%">
	              </span></div>
	              </td></td>
				 <?php } ?>
				 <td><div align="right">
            	   <?php 	
						if(strlen($FILEfactu)!=0){	?>
            	  			 <a href="<?php echo 'facing.php?accion=MOD&cod='.$cod.'&DEL=F&codfac='.$cod_fac_ing.'&lugar='.$lugar; ?>">
            	    		 <button class="button" type="button" id="DEL" name="DEL">Eliminar</button></a>     
            	   <?php }?></div></td>
	            </tr>
	          <tr>
	            <td><strong>FECHA FACTURA: </strong></td>
	            <td><?php pinto_fecha('LSTfechaFI','','');?></td>
	            <td>&nbsp;</td>
	            <td colspan="2">&nbsp;</td>
	           </tr>
              
         	 <?php
			 	if ($cantidad <= "0"){//Si ya tenia cheques..
		
			   ?>
              <tr>
                <td><strong>METODO DE PAGO:</strong></td>
                <td colspan="2"><div align="right"><strong> EFECTIVO:
                  <input type="radio" name="RDObancoFI" id="RDObancoFI" value="E" onclick="toggle(this)" class="button" <?php if($RDObancoFI=="E"){ echo "checked";}?>>
                  CHEQUE:
  <input type="radio" name="RDObancoFI" id="RDObancoFI" value="C" onclick="toggle(this)" class="button" <?php if($RDObancoFI=="C"){ echo "checked";}?>>
                  BANCO:
  <input type="radio" name="RDObancoFI" id="RDObancoFI" value="B" onclick="toggle(this)" class="button" <?php if($RDObancoFI=="B"){ echo "checked";}?>>
                </strong></div></td>
                <td><strong>
                  <input name="TXTBancoFI" type="text" class="button" id="TXTBancoFI" value="<?php echo $TXTBancoFI; ?>" size="8" maxlength="30">
                </strong></td>
                <td>&nbsp;</td>
              </tr>
              <?php 
			  	}else{  
			  		$veo_cheque="S";
			   ?>
              <tr>
                <td colspan="5"><div align="center" class="subtitulo"><strong>CHEQUES<input type="radio" name="RDObancoFI" id="RDObancoFI" value="C" class="button" checked disabled></strong></div></td>
              </tr>              
              
              <!--CHEQUES-->
				<?php    
                    while ($arrch = mysqli_fetch_array($rch))	
                    {
						$TXTBcoEmiCHE 	= trim($arrch['bco_emi_che']);
						
						$TXTNroEmiCHE 	= trim($arrch['nro_che']);
						$FEEmiChe 		= trim($arrch['fe_emi_che']);
						$TXTPerEmiCHE 	= trim($arrch['emi_che']);
						$TXTObservaCHE  = trim($arrch['observa_che']);
						
						$FESalCHE  		= trim($arrch['fe_sal_che']);
						$TXTConIngCHE  	= trim($arrch['concep_ing_che']);
						$TXTConSalCHE  	= trim($arrch['concep_sal_che']);
						$TXTFeDifCHE  	= trim($arrch['fe_dif_che']);
						$monto_che  	= trim($arrch['monto_che']);
						
						#Formateo lOS CHEQUES
						if(strlen($TXTBcoEmiCHE)==0){$TXTBcoEmiCHE = "";}	
						if(strlen($TXTNroEmiCHE)==0){$TXTNroEmiCHE = "";}	
						if(strlen($FEEmiChe)<4){$FEEmiChe = "";}	
						if(strlen($TXTPerEmiCHE)==0){$TXTPerEmiCHE = "";}	
						if(strlen($TXTObservaCHE)==0){$TXTObservaCHE = "";}	
				
						if(strlen($FESalCHE)<4){$FESalCHE = "";}	
						if(strlen($TXTConIngCHE)==0){$TXTConIngCHE = "";}	
						if(strlen($TXTConSalCHE)==0){$TXTConSalCHE = "";}		
						if(strlen($TXTFeDifCHE)<4){$TXTFeDifCHE = "";}	
						if(strlen($monto_che)==0){$monto_che = "";}					
                 ?>
                <tr>
                    <td><strong>NUMERO:</strong> <?php echo $nro_che = trim($arrch['nro_che']);?></td>
                    <td><strong>BANCO:</strong> <?php  echo $bco_emi_che = trim($arrch['bco_emi_che']); ?></td>
                    <td><strong>FECHA:</strong> <?php echo $fecha_alta = date("d-m-Y", strtotime($arrch['fe_emi_che'])); ?></td>
                    <td><strong>MONTO:</strong> <?php echo $monto_che;?></td>
                    <td><a href="<?php 	$cod_che = trim($arrch['cod_che']);
                                        echo 'facing.php?codche='.$cod_che.'&accion='.$accion.'&cod='.$cod.'&codfac='.$cod_fac_ing.'&lugar='.$lugar; ?>"><button class="button" type="button"><?php 
                                        echo 'Eliminar';
                                    ?></button></a>
                                    
                        <a href="<?php 	$cod_che = trim($arrch['cod_che']);
                                        echo '../veocheque.php?cod='.$cod_che; ?>"><button class="button" type="button"><?php 
                                        echo 'Ver';
                                    ?></button></a></td>
                </tr>
                <?php }  ?>
            <?php } ?>        
        	<tr>
	            <td colspan="5"><div id="uno" <?php #echo $veo_cheque;
													if($veo_cheque!="S"){
														echo 'style="display:none;"';
													} ?> >
                				<div align="center"><p><strong>DATOS DEL CHEQUE</strong></p>
                				</div>
                                <table width="100%" border="0">
                                  <tr>
                                    <td width="20%"><strong>BANCO EMISOR:</strong></td>
                                    <td><strong>
                                    <input type="text" class="button" id="TXTBcoEmiCHE" name="TXTBcoEmiCHE">
                                    </strong></td>
                                  </tr>
                                  <tr>
                                    <td><strong>NUMERO DEL CHEQUE:</strong></td>
                                    <td><strong>
                                    <input type="text" class="button" id="TXTNroEmiCHE" name="TXTNroEmiCHE">
                                    </strong></td>
                                  </tr>
                                  <tr>
                                    <td><strong>FECHA DEL CHEQUE:</strong></td>
                                    <td><strong>
                                    <?php pinto_fecha('FEEmiChe','','');?>
                                    </strong></td>
                                  </tr>
                                  <tr>
                                    <td><strong>EMISOR:</strong></td>
                                    <td><strong>
                                    <input type="text" class="button" id="TXTPerEmiCHE" name="TXTPerEmiCHE">
                                    </strong></td>
                                  </tr>
                                  <tr>
                                    <td><strong>FECHA SALIDA CHEQUE:</strong></td>
                                    <td><?php pinto_fecha('FESalCHE','','');?></td>
                                  </tr>
                                  <tr>
                                    <td><strong>CONCEPTO INGRESO:</strong></td>
                                    <td><strong>
                                    <input type="text" class="button" id="TXTConIngCHE" name="TXTConIngCHE">
                                    </strong></td>
                                  </tr>
                                  <tr>
                                    <td><strong>CONCEPTO SALIDA:</strong></td>
                                    <td><strong>
                                    <input type="text" class="button" id="TXTConSalCHE" name="TXTConSalCHE" >
                                    </strong></td>
                                  </tr>
                                  <tr>
                                    <td><strong>FECHA DIFERIDO DEL CHEQUE:</strong></td>
                                    <td><strong>
                                    <?php pinto_fecha('TXTFeDifCHE','','');?>
                                    </strong></td>
                                  </tr>                                  
                                  <tr>
                                    <td><strong>MONTO:</strong></td>
                                    <td><strong>
                                      <input type="text" class="button" id="TXTMonChe" name="TXTMonChe" >
                                    </strong></td>
                                  </tr>
                                  <tr>
                                    <td><strong>OBSERVACIONES:</strong></td>
                                    <td><strong>
                                    <input type="text" class="button" id="TXTObservaCHE" name="TXTObservaCHE" >
                                    </strong></td>
                                  </tr>
                                   <tr>
                                    <td>&nbsp;</td>
                                    <td><div align="right">
									<?php if(($accion == "MOD")or($accion == "ELI")){?>
                                    
										<input name="BTNAgrChe" type="submit" class="button" id="BTNAgrChe" value="AGREGAR">
									
                                    <?php }?></div></td>
                                  </tr> 
                                </table>

                                </div></td>
              </tr>    
                          
                <!--CHEQUES--> 
              <tr>
                <td colspan="5">&nbsp;</td>
              </tr>
              <tr>
	          	<td colspan="5"><div align="center" class="subtitulo"><strong>OTROS IMPUESTOS</strong></div></td>
              </tr>
              <tr>
	            <td><strong>PERCEPCION IVA INGRESOS BRUTOS :</strong></td>
	            <td><input name="TXTIvaIngBru" type="text" class="button" id="TXTIvaIngBru" value="<?php echo $TXTIvaIngBru; ?>" maxlength="14"></td>
	            <td><div align="right"><strong>GANANCIAS:</strong></div></td>
	            <td colspan="2"><strong>
	              <input name="TXTGanancia" type="text" class="button" id="TXTGanancia" value="<?php echo $TXTGanancia; ?>" maxlength="14"></strong></td>
              </tr>
	          <tr>
	            <td><strong>IVA INSCRIPTO:</strong></td>
	            <td><strong>
                <input name="NUMIvaIns" type="text" class="button" id="NUMIvaIns" value="<?php echo $NUMIvaIns; ?>" maxlength="14"></strong></td>
	            <td><div align="right"><strong>IVA NO INSCRIPTO:</strong></div></td>
	            <td colspan="2"><input name="NUMIvaNoIns" type="text" class="button" id="NUMIvaNoIns" value="<?php echo $NUMIvaNoIns; ?>" maxlength="14"></td>
              </tr>
	          <tr>
	            <td><strong>NUMERO DE REMITO:</strong></td>
	            <td><strong><input name="NUMRemito" type="text" class="button" id="NUMRemito" value="<?php echo $NUMRemito; ?>" maxlength="14"></strong></td>
	            <td><div align="right"><strong>RECEPCI&Oacute;N IIBB CAJA 3,5</strong></div></td>
	            <td colspan="2"><input name="TXTIibb" type="text" class="button" id="TXTIibb" value="<?php echo $TXTIibb; ?>" maxlength="14"></td>
              </tr>
	          <tr>
	            <td><strong>NO GRABADO :</strong></td>
	            <td><strong><input name="TXTNoGrab" type="text" class="button" id="TXTNoGrab" value="<?php echo $TXTNoGrab; ?>" maxlength="14"></strong></td>
	            <td><div align="right"><strong>GRABADO:</strong></div></td>
	            <td colspan="2"><input name="TXTGrab" type="text" class="button" id="TXTGrab" value="<?php echo $TXTGrab; ?>" maxlength="14"></td>
	            </tr>
	          <tr>
	            <td><strong>TOTAL : </strong></td>
	            <td><strong>
	              <input name="NUMMonTotal" type="text" class="button" id="NUMMonTotal" value="<?php echo $NUMMonTotal; ?>" maxlength="15">
	            </strong></td>
	            <td colspan="3">&nbsp;</td>
              </tr>
	          <tr>
	            <td colspan="5">&nbsp;</td>
	            </tr>
	          <tr>
	            <td colspan="5"><div align="center"><span style="color: #000">
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
