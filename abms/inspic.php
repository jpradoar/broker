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

	if ($DEL == "AD"){
		$CampoDel = "file_desp";
	}
		$db6  = conecto();
		$sql6 = " update inspectionpictures set ".$CampoDel."  = '' where cod_ord = ".$cod." ";
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
	$cod = $_GET['cod'];
	$accion = $_GET['accion'];


	if($_POST['BTNALTA']){
		
		$Xtodo_ok 		= true;
		$Xerror_num 	= "";
 
		$TXTdjai 		= trim($_POST['TXTdjai']);
		$FILEdespa		= $_FILES['FILEdespa']['name'];
		$LSTfechaFD 	= trim($_POST['LSTfechaFD_anio'].'-'.$_POST['LSTfechaFD_mes'].'-'.$_POST['LSTfechaFD_dia']);
		$TXTnroDesp 	= trim($_POST['TXTnroDesp']);
		$TXTMontoDES 	= trim($_POST['TXTMontoDES']);
		$RDODES 		= trim($_POST['RDODES']);
		$TXTMontoDESar 	= trim($_POST['TXTMontoDESar']);
		$TXTPosAra 		= trim($_POST['TXTPosAra']);
		$RDObancoDES 	= trim($_POST['RDObancoDES']);
		$TXTBancoDES 	= trim($_POST['TXTBancoDES']);// echo $RDObancoDES; exit();
		$TXTDerImpo 	= trim($_POST['TXTDerImpo']);
		$TXTTasaEst 	= trim($_POST['TXTTasaEst']);
		$TXTMultaFue 	= trim($_POST['TXTMultaFue']);
		$TXTIvaDES 		= trim($_POST['TXTIvaDES']);
		$TXTIvaAdIns 	= trim($_POST['TXTIvaAdIns']);
		$TXTImpGanDES 	= trim($_POST['TXTImpGanDES']);
		$TXTAraSimImp 	= trim($_POST['TXTAraSimImp']);
		$TXTServGuarDES = trim($_POST['TXTServGuarDES']);
		$TXTIngBru 		= trim($_POST['TXTIngBru']);
				
		if(strlen($TXTdjai)==0){$TXTdjai = "";}
		if(strlen($FILEdespa)==0){$FILEdespa = "";}
		if(strlen($LSTfechaFD)<4){$LSTfechaFD = "";}
		if(strlen($TXTnroDesp)==0){$TXTnroDesp = "";}
		if(strlen($TXTMontoDES)==0){$TXTMontoDES = "";}
		if(strlen($RDODES)==0){$RDODES = "";}
		if(strlen($TXTMontoDESar)==0){$TXTMontoDESar = "";}
		if(strlen($TXTPosAra)==0){$TXTPosAra = "";}
		if(strlen($RDObancoDES)==0){$RDObancoDES = "";}
		if(strlen($TXTBancoDES)==0){$TXTBancoDES = "";}
		if(strlen($TXTDerImpo)==0){$TXTDerImpo = "";}
		if(strlen($TXTTasaEst)==0){$TXTTasaEst = "";}
		if(strlen($TXTMultaFue)==0){$TXTMultaFue = "";}
		if(strlen($TXTIvaDES)==0){$TXTIvaDES = "";}
		if(strlen($TXTIvaAdIns)==0){$TXTIvaAdIns = "";}
		if(strlen($TXTImpGanDES)==0){$TXTImpGanDES = "";}
		if(strlen($TXTAraSimImp)==0){$TXTAraSimImp = "";}
		if(strlen($TXTServGuarDES)==0){$TXTServGuarDES = "";}
		if(strlen($TXTIngBru)==0){$TXTIngBru = "";}

		#Datos del cheque//////////////////////////////////////////////////////
		$TXTBcoEmiCHE 	= strtoupper(trim($_POST['TXTBcoEmiCHE']));
		$TXTNroEmiCHE 	= trim($_POST['TXTNroEmiCHE']);
		$FEEmiChe 		= trim($_POST['FEEmiChe_anio'].'-'.$_POST['FEEmiChe_mes'].'-'.$_POST['FEEmiChe_dia']);
		$TXTPerEmiCHE 	= strtoupper(trim($_POST['TXTPerEmiCHE']));
		$TXTPagadoCHE 	= trim($_POST['TXTPagadoCHE']);
		$TXTObservaCHE  = trim($_POST['TXTObservaCHE']);
		
		$FESalCHE 		= trim($_POST['FESalCHE_anio'].'-'.$_POST['FESalCHE_mes'].'-'.$_POST['FESalCHE_dia']);
		$TXTConIngCHE	= strtoupper(trim($_POST['TXTConIngCHE']));
		$TXTConSalCHE	= strtoupper(trim($_POST['TXTConSalCHE']));
		$TXTFeDifCHE	= trim($_POST['TXTFeDifCHE_anio'].'-'.$_POST['TXTFeDifCHE_mes'].'-'.$_POST['TXTFeDifCHE_dia']);
				
		#Formateo lOS CHEQUES
		if(strlen($TXTBcoEmiCHE)==0){$TXTBcoEmiCHE = "";}	
		if(strlen($TXTNroEmiCHE)==0){$TXTNroEmiCHE = "";}	
		if(strlen($FEEmiChe)<4){$FEEmiChe = "";}	
		if(strlen($TXTPerEmiCHE)==0){$TXTPerEmiCHE = "";}	
		if(strlen($TXTPagadoCHE)==0){$TXTPagadoCHE = "";}	
		if(strlen($TXTObservaCHE)==0){$TXTObservaCHE = "";}	
		
		if(strlen($FESalCHE)<4){$FESalCHE = "";}	
		if(strlen($TXTConIngCHE)==0){$TXTConIngCHE = "";}	
		if(strlen($TXTConSalCHE)==0){$TXTConSalCHE = "";}		
		if(strlen($TXTFeDifCHE)<4){$TXTFeDifCHE = "";}	

//
//---------------VALIDACIONES  ----------------------
		if(strlen($TXTMontoDES)==0){
			$TXTMontoDES 	= "";
			}else{
				if(!is_numeric($TXTMontoDES)){
					$Xtodo_ok = FALSE;
					$Xerror_num.= " MONTO ";		
					}
				}
//------------------------------------------------------
/*		if(strlen($TXTnroDesp)==0){
			$TXTnroDesp 	= "";
			}else{
				if(!is_numeric($TXTnroDesp)){
					$Xtodo_ok = FALSE;
					$Xerror_num.= " NUM DESP ";		
					}
				}
				*/
//------------------------------------------------------
		if(strlen($TXTMontoDESar)==0){
			$TXTMontoDESar 	= "";
			}else{
				if(!is_numeric($TXTMontoDESar)){
					$Xtodo_ok = FALSE;
					$Xerror_num.= " NUM DESP ";		
					}
				}
//------------------------------------------------------
		if(strlen($TXTTasaEst)==0){
			$TXTTasaEst 	= "";
			}else{
				if(!is_numeric($TXTTasaEst)){
					$Xtodo_ok = FALSE;
					$Xerror_num.= " NUM DESP ";		
					}
				}
//------------------------------------------------------
		if(strlen($TXTTasaEst)==0){
			$TXTTasaEst 	= "";
			}else{
				if(!is_numeric($TXTTasaEst)){
					$Xtodo_ok = FALSE;
					$Xerror_num.= " TASA ";		
					}
				}
//------------------------------------------------------
		if(strlen($TXTIvaDES)==0){
			$TXTIvaDES 	= "";
			}else{
				if(!is_numeric($TXTIvaDES)){
					$Xtodo_ok = FALSE;
					$Xerror_num.= " IVA ";		
					}
				}
//------------------------------------------------------
		if(strlen($TXTImpGanDES)==0){
			$TXTImpGanDES 	= "";
			}else{
				if(!is_numeric($TXTImpGanDES)){
					$Xtodo_ok = FALSE;
					$Xerror_num.= " IMP GAN ";		
					}
				}
//------------------------------------------------------
		if(strlen($TXTIvaAdIns)==0){
			$TXTIvaAdIns 	= "";
		}else{
			if(!is_numeric($TXTIvaAdIns)){
					$Xtodo_ok = FALSE;
					$Xerror_num.= " IVA INS ";		
				}
		}
//------------------------------------------------------
		if(strlen($TXTIngBru)==0){
			$TXTIngBru 	= "";
		}else{
			if(!is_numeric($TXTIngBru)){
					$Xtodo_ok = FALSE;
					$Xerror_num.= " ING BRU ";		
				}
		}
//------------------------------------------------------
		if(strlen($TXTNroEmiCHE)==0){
			$TXTNroEmiCHE = "";	//echo $TXTNroEmiCHE;
		}else{
			if(!is_numeric($TXTNroEmiCHE)){
				$Xtodo_ok = FALSE;
				$Xerror_num.= " NUMERO CHEQUE ";		
			}
		}
//------------------------------------------------------
		if(strlen($Xerror_num)!=0){
			$Xerror_num.= " DEBE/DEBEN SER NUMERICO/NUMERICOS ";
		}	
			
		if($Xtodo_ok==true){
				
			$db2  = conecto(); //  guardo los datos en la base correspondiente  ///////////////
			$sql2 = " INSERT INTO inspectionpictures (cod_ord, djai, file_desp, fe_desp, num_desp, monto_desp, tip_cam_desp, moto_ar_desp, pos_ara, der_imp, multa_desp, iva_desp, ara_desp, ing_bru, met_pag_desp, banco_desp, tas_estad, iva_ad_desp, imp_gan, serv_guar) VALUES ('".$cod."','".$TXTdjai."','".$FILEdespa."','".$LSTfechaFD."','".$TXTnroDesp."','".$TXTMontoDES."','".$RDODES."','".$TXTMontoDESar."','".$TXTPosAra."','".$TXTDerImpo."','".$TXTMultaFue."','".$TXTIvaAdIns."','".$TXTAraSimImp."','".$TXTIngBru."','".$RDObancoDES."','".$TXTBancoDES."','".$TXTTasaEst."','".$TXTIvaDES."','".$TXTImpGanDES."','".$TXTServGuarDES."') ";
			//echo $sql2;exit();
			$r2   = mysqli_query($db2, $sql2);
	
			if ($r2 == false){
				mysqli_close($db2);
				$error = "Error: (" . mysql_errno() . ") " . mysql_error().")";
				//gestion_errores();
			}
				$Xultimocod_AC = mysqli_insert_id($db2);
				mysqli_close($db2);	

		if(strlen($TXTBcoEmiCHE)!=0){//Si agrego un cheque..
			
			$Xlugar_che = "Documentacion Despacho";
				
			$db5  = conecto(); 
			$sql5 = " INSERT INTO cheques (cod_ord, lugar_che, bco_emi_che, nro_che, fe_emi_che, emi_che, paga_che, observa_che, cod_ref, fe_sal_che, fe_dif_che) VALUES ('".$cod."','".$Xlugar_che."','".$TXTBcoEmiCHE."','".$TXTNroEmiCHE."','".$FEEmiChe."','".$TXTPerEmiCHE."','".$TXTPagadoCHE."','".$TXTObservaCHE."','".$Xultimocod_AC."','".$FESalCHE."','".$TXTFeDifCHE."') ";
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
				$FILEdespa	= $_FILES['FILEdespa']['name'];
				$tmp_namedespa = $_FILES['FILEdespa']['tmp_name'];
				$errordespa = $_FILES['FILEdespa']['error'];
				suboarchivos($estructura,$FILEdespa,$tmp_namedespa,$errordespa,$cod); 
			
			}else{//si salio todo genial

//########################### ARCHIVO DE DESPACHO ############################### 
				$FILEdespa	= $_FILES['FILEdespa']['name'];
				$tmp_namedespa = $_FILES['FILEdespa']['tmp_name'];
				$errordespa = $_FILES['FILEdespa']['error'];
				suboarchivos($estructura,$FILEdespa,$tmp_namedespa,$errordespa,$cod);  
								
			}//FIN si salio todo genial					
		
				
		echo "<script language='javascript'>
				 alert('El Registro a sido Creado');
				window.location.href='../veoordenes.php?cod=$cod'; </script>"; 	
		}
	}// FIN ALTA 
	
	

	if($_POST['BTNMOD']){
		
		$Xtodo_ok 		= true;
		$Xerror_num 	= "";
		
		$despa		= "";
		$FILEdespa	= "";	
				
		$cod_ins_pic	= trim($_POST['cod_ins_pic']);
		$TXTdjai		= trim($_POST['TXTdjai']);
		$FILEdespa		= $_FILES['FILEdespa']['name'];
		$LSTfechaFD 	= trim($_POST['LSTfechaFD_anio'].'-'.$_POST['LSTfechaFD_mes'].'-'.$_POST['LSTfechaFD_dia']);
		$TXTnroDesp 	= trim($_POST['TXTnroDesp']);
		$TXTMontoDES 	= trim($_POST['TXTMontoDES']);
		$RDODES 		= trim($_POST['RDODES']);
		$TXTMontoDESar 	= trim($_POST['TXTMontoDESar']);
		$TXTPosAra 		= trim($_POST['TXTPosAra']);
		$RDObancoDES 	= trim($_POST['RDObancoDES']);
		$TXTBancoDES 	= trim($_POST['TXTBancoDES']);
		$TXTDerImpo 	= trim($_POST['TXTDerImpo']);
		$TXTTasaEst 	= trim($_POST['TXTTasaEst']);
		$TXTMultaFue 	= trim($_POST['TXTMultaFue']);
		$TXTIvaDES 		= trim($_POST['TXTIvaDES']);
		$TXTIvaAdIns 	= trim($_POST['TXTIvaAdIns']);
		$TXTImpGanDES 	= trim($_POST['TXTImpGanDES']);
		$TXTAraSimImp 	= trim($_POST['TXTAraSimImp']);
		$TXTServGuarDES = trim($_POST['TXTServGuarDES']);
		$TXTIngBru 		= trim($_POST['TXTIngBru']);
		$despa 			= trim($_POST['despa']);

		#Datos del cheque//////////////////////////////////////////////////////
		$TXTBcoEmiCHE 	= strtoupper(trim($_POST['TXTBcoEmiCHE']));
		$TXTNroEmiCHE 	= trim($_POST['TXTNroEmiCHE']);
		$FEEmiChe 		= trim($_POST['FEEmiChe_anio'].'-'.$_POST['FEEmiChe_mes'].'-'.$_POST['FEEmiChe_dia']);
		$TXTPerEmiCHE 	= strtoupper(trim($_POST['TXTPerEmiCHE']));
		$TXTPagadoCHE 	= trim($_POST['TXTPagadoCHE']);
		$TXTObservaCHE  = trim($_POST['TXTObservaCHE']);
		
		$FESalCHE 		= trim($_POST['FESalCHE_anio'].'-'.$_POST['FESalCHE_mes'].'-'.$_POST['FESalCHE_dia']);
		$TXTConIngCHE	= strtoupper(trim($_POST['TXTConIngCHE']));
		$TXTConSalCHE	= strtoupper(trim($_POST['TXTConSalCHE']));
		$TXTFeDifCHE	= trim($_POST['TXTFeDifCHE_anio'].'-'.$_POST['TXTFeDifCHE_mes'].'-'.$_POST['TXTFeDifCHE_dia']);
		
	
		if(strlen($TXTdjai)==0){$TXTdjai = "";}
		if(strlen($FILEdespa)==0){$FILEdespa = "";}
		if(strlen($LSTfechaFD)<4){$LSTfechaFD = "";}
		if(strlen($TXTnroDesp)==0){$TXTnroDesp = "";}
		if(strlen($TXTMontoDES)==0){$TXTMontoDES = "";}
		if(strlen($RDODES)==0){$RDODES = "";}
		if(strlen($TXTMontoDESar)==0){$TXTMontoDESar = "";}
		if(strlen($TXTPosAra)==0){$TXTPosAra = "";}
		if(strlen($RDObancoDES)==0){$RDObancoDES = "";}
		if(strlen($TXTBancoDES)==0){$TXTBancoDES = "";}
		if(strlen($TXTDerImpo)==0){$TXTDerImpo = "";}
		if(strlen($TXTTasaEst)==0){$TXTTasaEst = "";}
		if(strlen($TXTMultaFue)==0){$TXTMultaFue = "";}
		if(strlen($TXTIvaDES)==0){$TXTIvaDES = "";}
		if(strlen($TXTIvaAdIns)==0){$TXTIvaAdIns = "";}
		if(strlen($TXTImpGanDES)==0){$TXTImpGanDES = "";}
		if(strlen($TXTAraSimImp)==0){$TXTAraSimImp = "";}
		if(strlen($TXTServGuarDES)==0){$TXTServGuarDES = "";}
		if(strlen($TXTnuTXTIngBrumBL)==0){$TXTIngBru = "";}
		
		#Formateo lOS CHEQUES
		if(strlen($TXTBcoEmiCHE)==0){$TXTBcoEmiCHE = "";}	
		if(strlen($TXTNroEmiCHE)==0){$TXTNroEmiCHE = "";}	
		if(strlen($FEEmiChe)<4){$FEEmiChe = "";}	
		if(strlen($TXTPerEmiCHE)==0){$TXTPerEmiCHE = "";}	
		if(strlen($TXTPagadoCHE)==0){$TXTPagadoCHE = "";}	
		if(strlen($TXTObservaCHE)==0){$TXTObservaCHE = "";}	
		
		if(strlen($FESalCHE)<4){$FESalCHE = "";}	
		if(strlen($TXTConIngCHE)==0){$TXTConIngCHE = "";}	
		if(strlen($TXTConSalCHE)==0){$TXTConSalCHE = "";}		
		if(strlen($TXTFeDifCHE)<4){$TXTFeDifCHE = "";}	

		$AD		 ="";
		if(strlen($FILEdespa)!=0){
				 $AD =	$FILEdespa;
				}
		
		if(strlen($despa)!=0){
				 $AD =	$despa;
				}
//---------------VALIDACIONES  ----------------------
		if(strlen($TXTMontoDES )==0){
			$TXTMontoDES 	= "";
			}else{
				if(!is_numeric($TXTMontoDES)){
					$Xtodo_ok = FALSE;
					$Xerror_num.= " MONTO ";		
					}
				}
//------------------------------------------------------
	/*	if(strlen($TXTnroDesp )==0){
			$TXTnroDesp 	= "";
			}else{
				if(!is_numeric($TXTnroDesp)){
					$Xtodo_ok = FALSE;
					$Xerror_num.= " NUM DESP ";		
					}
				}
				
	*/			
//------------------------------------------------------
		if(strlen($TXTMontoDESar)==0){
			$TXTMontoDESar 	= "";
			}else{
				if(!is_numeric($TXTMontoDESar)){
					$Xtodo_ok = FALSE;
					$Xerror_num.= " NUM DESP ";		
					}
				}
//------------------------------------------------------
		if(strlen($TXTTasaEst)==0){
			$TXTTasaEst 	= "";
			}else{
				if(!is_numeric($TXTTasaEst)){
					$Xtodo_ok = FALSE;
					$Xerror_num.= " NUM DESP ";		
					}
				}
//------------------------------------------------------
		if(strlen($TXTTasaEst)==0){
			$TXTTasaEst 	= "";
			}else{
				if(!is_numeric($TXTTasaEst)){
					$Xtodo_ok = FALSE;
					$Xerror_num.= " TASA ";		
					}
				}
//------------------------------------------------------
		if(strlen($TXTIvaDES)==0){
			$TXTIvaDES 	= "";
			}else{
				if(!is_numeric($TXTIvaDES)){
					$Xtodo_ok = FALSE;
					$Xerror_num.= " IVA ";		
					}
				}
//------------------------------------------------------
		if(strlen($TXTImpGanDES)==0){
			$TXTImpGanDES 	= "";
			}else{
				if(!is_numeric($TXTImpGanDES)){
					$Xtodo_ok = FALSE;
					$Xerror_num.= " IMP GAN ";		
					}
				}
//------------------------------------------------------
		if(strlen($TXTIvaAdIns)==0){
			$TXTIvaAdIns 	= "";
			}else{
				if(!is_numeric($TXTIvaAdIns)){
					$Xtodo_ok = FALSE;
					$Xerror_num.= " IVA INS ";		
					}
				}
//------------------------------------------------------
		if(strlen($TXTIngBru)==0){
			$TXTIngBru 	= "";
			}else{
				if(!is_numeric($TXTIngBru)){
					$Xtodo_ok = FALSE;
					$Xerror_num.= " ING BRU ";		
					}
				}
//------------------------------------------------------
		if(strlen($Xerror_num)!=0){
			$Xerror_num.= " DEBE/DEBEN SER NUMERICO/NUMERICOS ";
		}	
		
		$Xlugar_che = "Documentacion Despacho";
		if($Xtodo_ok==true){

		$db3  = conecto();
		$sql3 = " update inspectionpictures set 
					djai  = '".$TXTdjai."',
					file_desp  = '".$AD."',
					fe_desp  = '".$LSTfechaFD."',
					num_desp  = '".$TXTnroDesp."',
					monto_desp  = '".$TXTMontoDES."',
					tip_cam_desp = '".$RDODES."',					
					moto_ar_desp  = '".$TXTMontoDESar."',
					pos_ara  = '".$TXTPosAra."',
					der_imp  = '".$TXTDerImpo."',
					multa_desp  = '".$TXTMultaFue."',
					iva_desp  = '".$TXTIvaDES."',
					ara_desp = '".$TXTAraSimImp."',
					ing_bru  = '".$TXTIngBru."',
					met_pag_desp  = '".$RDObancoDES."',
					banco_desp  = '".$TXTBancoDES."',
					tas_estad  = '".$TXTTasaEst."',
					iva_ad_desp  = '".$TXTIvaDES."',
					imp_gan  = '".$TXTImpGanDES."',	
					serv_guar  = '".$TXTServGuarDES."'									
					where cod_ord = ".$cod." and cod_ins_pic = ".$cod_ins_pic." ";	
		$r3   = mysqli_query($db3, $sql3);

		if ($r3 == false){
	    	mysqli_close($db3);
	        $error = "Error: (" . mysql_errno() . ") " . mysql_error().")";
	        //gestion_errores();
	    }
	      mysqli_close($db3);


	if(strlen($TXTBcoEmiCHE)!=0){//Si agrego un cheque..

		#VEO SI TIENE UN CHEQUE------------------->
		
		$db_vc  = conecto();
		$sql_vc = " select count(*) as canti from cheques where cod_ord = ".$cod." and lugar_che  = '".$Xlugar_che."' and cod_ref  = '".$cod_ins_pic."' ";
		
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
		
		if ($cantidad > "0"){//Si ya tenia uno..
			
			//echo $cod_ins_pic; exit();
			$db33  = conecto();
			$sql33 = " UPDATE cheques SET
					bco_emi_che  = '".$TXTBcoEmiCHE."',
					nro_che  = '".$TXTNroEmiCHE."',
					fe_emi_che  = '".$FEEmiChe."',
					emi_che  = '".$TXTPerEmiCHE."',
					paga_che  = '".$TXTPagadoCHE."',
					observa_che = '".$TXTPagadoCHE."',
					fe_sal_che = '".$FESalCHE."',
					concep_ing_che = '".$TXTConIngCHE."',
					concep_sal_che = '".$TXTConSalCHE."',
					fe_dif_che = '".$TXTFeDifCHE."'
					 where cod_ord = ".$cod." and lugar_che  = '".$Xlugar_che."' and cod_ref  = '".$cod_ins_pic."' ";
	 			
			//echo $sql33;exit();
			$r33   = mysqli_query($db33, $sql33);
		
			if ($r33 == false){
				mysqli_close($db33);
				$error = "Error: (" . mysql_errno() . ") " . mysql_error().")";
				//gestion_errores();
			}
				
				mysqli_close($db33);
				
		}else{//Si no tenia..
		
		
			$db5  = conecto(); 
			$sql5 = " INSERT INTO cheques (cod_ord, lugar_che, bco_emi_che, nro_che, fe_emi_che, emi_che, paga_che, observa_che, cod_ref, fe_sal_che, fe_dif_che) VALUES ('".$cod."','".$Xlugar_che."','".$TXTBcoEmiCHE."','".$TXTNroEmiCHE."','".$FEEmiChe."','".$TXTPerEmiCHE."','".$TXTPagadoCHE."','".$TXTObservaCHE."','".$cod_ins_pic."','".$FESalCHE."','".$TXTFeDifCHE."') ";
			
			//echo $sql5;exit();
			$r5   = mysqli_query($db5, $sql5);
			if ($r5 == false){
				mysqli_close($db5);
				$error = "Error: (" . mysql_errno() . ") " . mysql_error().")";
				//gestion_errores();
			}
				
				mysqli_close($db5);	
		}	
		#VEO SI TIENE UN CHEQUE------------------->
	}//Si agrego un cheque..
	
	if(strlen($TXTBcoEmiCHE)!=0){// ELIMINO CHEQUE
			//Si tenia un cheque y cambio la opcion, se elimina el cheque..
			if(($RDObancoDES=="E")||($RDObancoDES=="B")){ 
				$Xlugar_che = "Documentacion Despacho";
		
				$db_delche  = conecto(); 
				$sql_delche = " DELETE FROM cheques where cod_ord = ".$cod." and lugar_che  = '".$Xlugar_che."' and cod_ref  = '".$cod_ins_pic."'  ";
			
				//echo $sql_delche;exit();
				$r_delche   = mysqli_query($db_delche, $sql_delche);
			
				if ($r_delche == false){
					mysqli_close($db_delche);
					$error = "Error: (" . mysql_errno() . ") " . mysql_error().")";
					//gestion_errores();
				}
				
				mysqli_close($db_delche);			
			}
		}//FIN ELIMINO CHEQUE	
//-------------------------------------------- UPLOAD DE ARCHIVOS -----------------------	
		//para el alta de las carpetas
		$raiz		= "../ordenes/";
		$estructura = $raiz . trim($cod);
		
			if(!mkdir($estructura, 0777, true))//si no se creo la carpeta, la creo y meto los datos
			{
				
//########################### ARCHIVO DE DESPACHO ############################### 
				$FILEdespa	= $_FILES['FILEdespa']['name'];
				$tmp_namedespa = $_FILES['FILEdespa']['tmp_name'];
				$errordespa = $_FILES['FILEdespa']['error'];
				suboarchivos($estructura,$FILEdespa,$tmp_namedespa,$errordespa,$cod); 
			
			}else{//si salio todo genial
					$FILEdespa	= $_FILES['FILEdespa']['name'];
					$tmp_namedespa = $_FILES['FILEdespa']['tmp_name'];
					$errordespa = $_FILES['FILEdespa']['error'];
					suboarchivos($estructura,$FILEdespa,$tmp_namedespa,$errordespa,$cod);  
								
				 }//FIN si salio todo genial
		
		echo "<script language='javascript'>
				 alert('El Registro a sido Modificado');
				window.location.href='../veoordenes.php?cod=$cod'; </script>"; 				
	}
}
	
	if($_POST['BTNELI']){

		$db4  = conecto();
		$sql4 = " delete from inspectionpictures where cod_ord = ".$cod." ";
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

	$cod_ins_pic 	= "";
	$TXTdjai		= "";
	$FILEdespa		= "";
	$LSTfechaFD 	= "";
	$TXTnroDesp 	= "";
	$TXTMontoDES 	= "";
	$RDODES 		= "";
	$TXTMontoDESar 	= "";
	$TXTPosAra 		= "";
	$RDObancoDES 	= "";
	$TXTBancoDES 	= "";
	$TXTDerImpo 	= "";
	$TXTTasaEst 	= "";
	$TXTMultaFue 	= "";
	$TXTIvaDES 		= "";
	$TXTIvaAdIns 	= "";
	$TXTImpGanDES 	= "";
	$TXTAraSimImp 	= "";
	$TXTServGuarDES = "";
	$TXTIngBru 		= "";	

	$TXTBcoEmiCHE 	= "";
	$TXTNroEmiCHE 	= "";
	$FEEmiChe 		= "";
	$TXTPerEmiCHE 	= "";
	$TXTPagadoCHE 	= "";
	$TXTObservaCHE  = "";

	$FESalCHE 		= "";
	$TXTConIngCHE	= "";
	$TXTConSalCHE	= "";
	$TXTFeDifCHE	= "";
	$veo_cheque		= "N";
					
	if(($accion == "MOD")or($accion == "ELI")){		
		
		#Documentacion Despacho
		$db1  = conecto();
		$sql1 = "select * from inspectionpictures where cod_ord = ".$cod." ";
		$r1   = mysqli_query($db1, $sql1);
	
		if ($r1 == false){
	    	mysqli_close($db1);
	        $error = "Error: (" . mysql_errno() . ") " . mysql_error().")";
	        //gestion_errores();
	    }
	    	mysqli_close($db1);
			
		while ($arr1 = mysqli_fetch_array($r1))		
		{
			$cod_ins_pic 	= trim($arr1['cod_ins_pic']);
			$TXTdjai		= trim($arr1['djai']);
			$FILEdespa		= trim($arr1['file_desp']);
			$LSTfechaFD 	= trim($arr1['fe_desp']);
			$TXTnroDesp 	= trim($arr1['num_desp']);
			$TXTMontoDES 	= trim($arr1['monto_desp']);
			$RDODES 		= trim($arr1['tip_cam_desp']);
			$TXTMontoDESar 	= trim($arr1['moto_ar_desp']);
			$TXTPosAra 		= trim($arr1['pos_ara']);
			$RDObancoDES 	= trim($arr1['met_pag_desp']);
			$TXTBancoDES 	= trim($arr1['banco_desp']);
			$TXTDerImpo 	= trim($arr1['der_imp']);
			$TXTTasaEst 	= trim($arr1['tas_estad']);
			$TXTMultaFue 	= trim($arr1['multa_desp']);
			$TXTIvaDES 		= trim($arr1['iva_ad_desp']);
			$TXTIvaAdIns 	= trim($arr1['iva_desp']);
			$TXTImpGanDES 	= trim($arr1['imp_gan']);
			$TXTAraSimImp 	= trim($arr1['ara_desp']);
			$TXTServGuarDES = trim($arr1['serv_guar']);
			$TXTIngBru 		= trim($arr1['ing_bru']);																										
		}				
				
		if(strlen($TXTdjai)==0){$TXTdjai = "";}
		if(strlen($FILEdespa)==0){$FILEdespa = "";}
		if(strlen($LSTfechaFD)<4){$LSTfechaFD = "";}
		if(strlen($TXTnroDesp)==0){$TXTnroDesp = "";}
		if(strlen($TXTMontoDES)==0){$TXTMontoDES = "";}
		if(strlen($RDODES)==0){$RDODES = "";}
		if(strlen($TXTMontoDESar)==0){$TXTMontoDESar = "";}
		if(strlen($TXTPosAra)==0){$TXTPosAra = "";}
		if(strlen($RDObancoDES)==0){$RDObancoDES = "";}
		if(strlen($TXTBancoDES)==0){$TXTBancoDES = "";}
		if(strlen($TXTDerImpo)==0){$TXTDerImpo = "";}
		if(strlen($TXTTasaEst)==0){$TXTTasaEst = "";}
		if(strlen($TXTMultaFue)==0){$TXTMultaFue = "";}
		if(strlen($TXTIvaDES)==0){$TXTIvaDES = "";}
		if(strlen($TXTIvaAdIns)==0){$TXTIvaAdIns = "";}
		if(strlen($TXTImpGanDES)==0){$TXTImpGanDES = "";}
		if(strlen($TXTAraSimImp)==0){$TXTAraSimImp = "";}
		if(strlen($TXTServGuarDES)==0){$TXTServGuarDES = "";}
		if(strlen($TXTIngBru)==0){$TXTIngBru = "";}

#CHEQUES
		$Xlugar_che = "Documentacion Despacho";
		$dbch  = conecto();
		$sqlch = "select * from cheques where cod_ord = '".$cod."' and lugar_che = '".$Xlugar_che."' ";
		$rch   = mysqli_query($dbch, $sqlch);
	
		if ($rch == false){
	    	mysqli_close($dbch);
	        $error = "Error: (" . mysql_errno() . ") " . mysql_error().")";
	        //gestion_errores();
	    }
	    	mysqli_close($dbch);	
		while ($arrch = mysqli_fetch_array($rch))		
		{
			$TXTBcoEmiCHE 	= trim($arrch['bco_emi_che']);
			$TXTNroEmiCHE 	= trim($arrch['nro_che']);
			$FEEmiChe 		= trim($arrch['fe_emi_che']);
			$TXTPerEmiCHE 	= trim($arrch['emi_che']);
			$TXTPagadoCHE 	= trim($arrch['paga_che']);
			$TXTObservaCHE  = trim($arrch['observa_che']);
			
			$FESalCHE  		= trim($arrch['fe_sal_che']);
			$TXTConIngCHE  	= trim($arrch['concep_ing_che']);
			$TXTConSalCHE  	= trim($arrch['concep_sal_che']);
			$TXTFeDifCHE  	= trim($arrch['fe_dif_che']);
			$FILEdespa	  	= trim($arrch['file_desp']);	
		}
		
		if(strlen($FILEdespa)==0){$FILEdespa = "";}
		if(strlen($TXTBcoEmiCHE)==0){$TXTBcoEmiCHE = "";}	
		if(strlen($TXTNroEmiCHE)==0){$TXTNroEmiCHE = "";}	
		if(strlen($FEEmiChe)<4){$FEEmiChe = "";}	
		if(strlen($TXTPerEmiCHE)==0){$TXTPerEmiCHE = "";}	
		if(strlen($TXTPagadoCHE)==0){$TXTPagadoCHE = "";}	
		if(strlen($TXTObservaCHE)==0){$TXTObservaCHE = "";}	

		if(strlen($FESalCHE)<4){$FESalCHE = "";}	
		if(strlen($TXTConIngCHE)==0){$TXTConIngCHE = "";}	
		if(strlen($TXTConSalCHE)==0){$TXTConSalCHE = "";}		
		if(strlen($TXTFeDifCHE)<4){$TXTFeDifCHE = "";}	

		#Formateo lOS CHEQUES
		if(strlen($TXTBcoEmiCHE)==0){$TXTBcoEmiCHE = "";}	
		if(strlen($TXTNroEmiCHE)==0){$TXTNroEmiCHE = "";}	
		if(strlen($FEEmiChe)<4){$FEEmiChe = "";}	
		if(strlen($TXTPerEmiCHE)==0){$TXTPerEmiCHE = "";}	
		if(strlen($TXTPagadoCHE)==0){$TXTPagadoCHE = "";}	
		if(strlen($TXTObservaCHE)==0){$TXTObservaCHE = "";}	
		
		if(strlen($FESalCHE)<4){$FESalCHE = "";}	
		if(strlen($TXTConIngCHE)==0){$TXTConIngCHE = "";}	
		if(strlen($TXTConSalCHE)==0){$TXTConSalCHE = "";}		
		if(strlen($TXTFeDifCHE)<4){$TXTFeDifCHE = "";}	
 		
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
	<div id="page-wrap"> 
 <form action="" method="post" name="form1" enctype="multipart/form-data" >   
    <?php include 'menu.php'; ?>

    <div class="caption">_%%_empresanombre_%%_.</div> 
	<p>USUARIO: <?php echo $Xnombre; ?></p>
	<table class="sombra">
      <thead>
	          <tr>
	            <th colspan="4" align="center"><input name="cod_ins_pic"  id="cod_ins_pic"  value="<?php echo $cod_ins_pic; ?>" type="hidden">	              <div align="center">DOCUMENTACION DESPACHO</div></th>
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
	            <td><strong>ARCHIVO DESPACHO:</strong></td>
	            <td colspan="2"><div align="left"><span style="color: #000">
	              <?php if(strlen($FILEdespa)!=0){?>	  	
	              <b>Nombre del archivo:</b>
	              <input type="text" value="<?php echo $FILEdespa; ?>" name="despa" id="despa"  class="button">
	              <?php } else { ?>
	              <input name="FILEdespa" type="file" id="FILEdespa" title="SELECCIONE.." class="button" style="width: 75%">
	              </span></div></td>
				 <?php } ?>
				 <td colspan="2"><div align="right">
	            	  <?php 	
							if(strlen($FILEdespa)!=0){?>
	            	  			<a href="<?php echo 'inspic.php?accion=MOD&cod='.$cod.'&DEL=AD'; ?>"><button class="button" type="button">Eliminar</button></a>     
	            	  <?php }?></div></td>                 
            	</tr>
	          <tr>
	            <td><strong>FECHA OFICIALIZACION: </strong></td>
	            <td><?php pinto_fecha('LSTfechaFD','','');?></td>
	            <td><strong><div align="right">N&ordm; DESPACHO:
                </div></strong></td>
	            <td><strong>
	              <input name="TXTnroDesp" type="text" class="button" id="TXTnroDesp" value="<?php echo $TXTnroDesp; ?>" maxlength="15">
                </strong></td>
	            </tr>
	          <tr>
	            <td><strong>MONTO:
                </strong></td>
	            <td><strong>
	              <input name="TXTMontoDES" type="text" class="button" id="TXTMontoDES" value="<?php echo $TXTMontoDES; ?>"  maxlength="15">
.U$S </strong></td>
	            <td><div align="right"><strong><!--BLUE:
                    <input name="RDODES" type="radio" class="button" id="RDODES" value="B">
PESOS:
<input name="RDODES" type="radio" class="button" id="RDODES" value="P">-->
OFICIAL:
<input name="RDODES" type="radio" class="button" id="RDODES" value="O">
                </strong></div></td>
	            <td><strong>
	              <input name="TXTMontoDESar" type="text" class="button" id="TXTMontoDESar" value="<?php echo $TXTMontoDESar; ?>" maxlength="15">
.AR$ </strong></td>
              </tr>
	          <tr>
	            <td><strong>POSICION ARANCELARIA:</strong></td>
	            <td>
                  <strong>
                  <input name="TXTPosAra" type="text" class="button" id="TXTPosAra" value="<?php echo $TXTPosAra; ?>" maxlength="15">
                </strong></td>
	            <td><div align="right"><strong> <!--EFECTIVO:
<input type="radio" name="RDObancoDES" id="RDObancoDES" value="E" onclick="toggle(this)" class="button" <?php //if($RDObancoDES=="E"){ echo "checked";}?>>
                CHEQUE:
<input type="radio" name="RDObancoDES" id="RDObancoDES" value="C" onclick="toggle(this)" class="button" <?php //if($RDObancoDES=="C"){ echo "checked";}?>>
                 -->BANCO:
<input type="radio" name="RDObancoDES" id="RDObancoDES" value="B" onclick="toggle(this)" class="button" <?php if($RDObancoDES=="B"){ echo "checked";}?>>
	            </strong></div></td>
	            <td><strong>
	              <input name="TXTBancoDES" type="text" class="button" id="TXTBancoDES" value="<?php echo $TXTBancoDES; ?>" maxlength="30">
	            </strong></td>
              </tr>
              
              
              	          <tr>
	            <td colspan="4"><div id="uno" <?php #echo $veo_cheque;
													if($veo_cheque!="S"){
														echo 'style="display:none;"';
													} ?> >
                				<div align="center"><p><strong>DATOS DEL CHEQUE</strong></p>
                				</div>
                                <table width="100%" border="0">
                                  <tr>
                                    <td width="20%"><strong>BANCO EMISOR:</strong></td>
                                    <td><strong>
                                    <input type="text" class="button" id="TXTBcoEmiCHE" name="TXTBcoEmiCHE" value="<?php echo $TXTBcoEmiCHE; ?>" >
                                    </strong></td>
                                  </tr>
                                  <tr>
                                    <td><strong>NUMERO DEL CHEQUE:</strong></td>
                                    <td><strong>
                                    <input type="text" class="button" id="TXTNroEmiCHE" name="TXTNroEmiCHE" value="<?php echo $TXTNroEmiCHE; ?>" >
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
                                    <input type="text" class="button" id="TXTPerEmiCHE" name="TXTPerEmiCHE" value="<?php echo $TXTPerEmiCHE; ?>">
                                    </strong></td>
                                  </tr>
                                  <tr>
                                    <td><strong>FECHA SALIDA CHEQUE:</strong></td>
                                    <td><?php pinto_fecha('FESalCHE','','');?></td>
                                  </tr>
                                  <tr>
                                    <td><strong>CONCEPTO INGRESO:</strong></td>
                                    <td><strong>
                                    <input type="text" class="button" id="TXTConIngCHE" name="TXTConIngCHE" value="<?php echo $TXTConIngCHE; ?>">
                                    </strong></td>
                                  </tr>
                                  <tr>
                                    <td><strong>CONCEPTO SALIDA:</strong></td>
                                    <td><strong>
                                    <input type="text" class="button" id="TXTConSalCHE" name="TXTConSalCHE" value="<?php echo $TXTConSalCHE; ?>">
                                    </strong></td>
                                  </tr>
                                  <tr>
                                    <td><strong>FECHA DIFERIDO DEL CHEQUE:</strong></td>
                                    <td><strong>
                                    <?php pinto_fecha('TXTFeDifCHE','','');?>
                                    </strong></td>
                                  </tr>                                  <tr>
                                    <td><strong>OBSERVACIONES:</strong></td>
                                    <td><strong>
                                    <input type="text" class="button" id="TXTObservaCHE" name="TXTObservaCHE" value="<?php echo $TXTObservaCHE; ?>">
                                    </strong></td>
                                  </tr>
                                </table>

                                </div></td>
              </tr>
              
              
              
              
	          <tr>
	            <td><strong>DERECHOS IMPORTACION:</strong></td>
	            <td>
	              <strong>
	              <input name="TXTDerImpo" type="text" class="button" id="TXTDerImpo" value="<?php echo $TXTDerImpo; ?>" maxlength="15">
	              </strong></td>
	            <td><div align="right"><strong>TASA ESTADISTICA:</strong></div></td>
	            <td><input name="TXTTasaEst" type="text" class="button" id="TXTTasaEst" value="<?php echo $TXTTasaEst; ?>" maxlength="15"></td>
              </tr>
	          <tr>
	            <td><strong>MULTA DEST. FUERA DE TER.:</strong></td>
	            <td><strong>
                <input name="TXTMultaFue" type="text" class="button" id="TXTMultaFue" value="<?php echo $TXTMultaFue; ?>" maxlength="15">
	            </strong></td>
	            <td><div align="right"><strong>IVA:</strong></div></td>
	            <td><input name="TXTIvaDES" type="text" class="button" id="TXTIvaDES" value="<?php echo $TXTIvaDES; ?>" maxlength="15"></td>
              </tr>
	          <tr>
	            <td><strong>IVA AD. INS.:</strong></td>
	            <td><strong>
                <input name="TXTIvaAdIns" type="text" class="button" id="TXTIvaAdIns" value="<?php echo $TXTIvaAdIns; ?>" maxlength="15">
	            </strong></td>
	            <td><div align="right"><strong>IMPUESTO A LAS GANANCIAS:</strong></div></td>
	            <td><input name="TXTImpGanDES" type="text" class="button" id="TXTImpGanDES" value="<?php echo $TXTImpGanDES; ?>" maxlength="15"></td>
              </tr>
	          <tr>
	            <td><strong>ARANCEL SIM. IMPO.:                </strong></td>
	            <td><strong>
                <input name="TXTAraSimImp" type="text" class="button" id="TXTAraSimImp" value="<?php echo $TXTAraSimImp; ?>" maxlength="15">
	            </strong></td>
	            <td><div align="right"><strong>SERV. GUARDA</strong></div></td>
	            <td><input name="TXTServGuarDES" type="text" class="button" id="TXTServGuarDES" value="<?php echo $TXTServGuarDES; ?>" maxlength="15"></td>
              </tr>
	          <tr>
	            <td><strong>INGRESOS BRUTOS:</strong></td>
	            <td><strong>
                <input name="TXTIngBru" type="text" class="button" id="TXTIngBru" value="<?php echo $TXTIngBru; ?>" maxlength="15">
	            </strong></td>
	            <td><div align="right"><strong>DJAI</strong></div></td>
	            <td><input name="TXTdjai" type="text" class="button" id="TXTdjai" value="<?php echo $TXTdjai; ?>" maxlength="15"></td>
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
