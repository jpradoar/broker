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

 if(strlen($codche)!=0){//SI borra un cheque

	$codadcli 	= $_GET['codadcli'];
	$cod	 	= $_GET['cod'];
 	$cantidad   = 0;
	
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

	//VEO SI ES EL ULTIMO CHEQUE
		$lugar  = "adelantocliente";
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
		//echo $cantidad; //exit();
		
		if($cantidad==0){//Aviso que no tiene mas cheques

			$db  = conecto();
			$sql = " UPDATE adelantocliente SET met_pag_ad = '' 
						where cod_ord = '".$cod."' and cod_adcli = '".$codadcli."' ";
					
			$r   = mysqli_query($db, $sql);
			//echo $sql;exit();
			if ($r == false){
				mysqli_close($db);
				$error = "Error: (" . mysql_errno() . ") " . mysql_error().")";
				//gestion_errores();
			}
			  mysqli_close($db);
		  			
		}//fin Aviso que no tiene mas cheques	
				
 }//fin SI borra un cheque
 		

if($_POST){//SEGUNDOS POST

	$cod 		 = $_GET['cod'];
	$accion 	 = $_GET['accion'];
	$cod_adcli	 = $_GET['codadcli'];
	
	$RDOMetPagCO = $_POST['RDOMetPagCO'];	
	$MuestroDias = false;
	
	
	if(strlen($RDOMetPagCO)==0){
		$RDOMetPagCO = "";
	}
		
	if($RDOMetPagCO = "C"){
		$veo_cheque = "S";
	}

	#consulto si es el primer adelanto
	$db  = conecto();
	$sql = "select count(*) as canti from adelantocliente where cod_ord = ".$cod." ";
	
	$r   = mysqli_query($db, $sql);
	
	if ($r == false){
	   	mysqli_close($db);
	    $error = "Error: (" . mysql_errno() . ") " . mysql_error().")";
	    //gestion_errores();
	}
	  	mysqli_close($db);
	
	$arr_pri  = mysqli_fetch_array($r);
	$cantidad = $arr_pri['canti'];

	if($cantidad==0){
		$MuestroDias 	= true;
	}
		
	if(($_POST['BTNALTA'])||($_POST['BTNALTAS'])){

		$Xtodo_ok 		= true;
		$xerror_tip 	= true;
		$Xerror_num 	= "";
		$cantidad 		= "0";
		$veo_cheque 	= "";
				
		#recibo los datos del formulario//////////////////////////////////////////////////////
		$CantDiasInsPic = trim($_POST['CantDiasInsPic_anio'].'-'.$_POST['CantDiasInsPic_mes'].'-'.$_POST['CantDiasInsPic_dia']);	
	
		$RDOCerOr 	 = trim($_POST['RDOCerOr']);
		$LSTfechaFdC = trim($_POST['LSTfechaFdC_anio'].'-'.$_POST['LSTfechaFdC_mes'].'-'.$_POST['LSTfechaFdC_dia']);
		$RDOTipPago  = trim($_POST['RDOTipPago']);
		$LSTfechaPAC = trim($_POST['LSTfechaPAC_anio'].'-'.$_POST['LSTfechaPAC_mes'].'-'.$_POST['LSTfechaPAC_dia']);
		$TXTMontoPA	 = trim($_POST['TXTMontoPA']);
		$RDOCO 	 	 = trim($_POST['RDOCO']);
		$TXTMontoCO	 = trim($_POST['TXTMontoCO']);
		$RDOMetPagCO = trim($_POST['RDOMetPagCO']);
		$TXTBancoCO  = trim(strtoupper($_POST['TXTBancoCO']));
		$TXTMontoBLUE = trim($_POST['TXTMontoBLUE']);

		if($RDOMetPagCO == "C"){//Agrego un cheque
		 	$veo_cheque = "S";
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
   			$TXTMonChe		= strtoupper(trim($_POST['TXTMonChe']));
			$RDResto12  	= trim($_POST['RDResto12']);
			
			
			#Formateo las fechas
			if(strlen($RDOCerOr)==0){$RDOCerOr = "";}
			if(strlen($LSTfechaFdC)<4){$LSTfechaFdC = "";}
			if(strlen($RDOTipPago)==0){$RDOTipPago = "";}
			if(strlen($LSTfechaPAC)<4){$LSTfechaPAC = "";}	
			if(strlen($TXTMontoPA)==0){$TXTMontoPA = "";}
			if(strlen($RDOCO)==0){$RDOCO = "";}
			if(strlen($TXTMontoCO)==0){$TXTMontoCO = "";}
			if(strlen($RDOMetPagCO)==0){$RDOMetPagCO = "";}
			if(strlen($TXTBancoCO)==0){$TXTBancoCO = "";}
			if(strlen($TXTMontoBLUE)==0){$TXTMontoBLUE = "";}		
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
					
			
			if(strlen($TXTNroEmiCHE)==0){
				$Xtodo_ok = FALSE;
				$Xerror_num.= " NUMERO CHEQUE ";	
			}else{
				if(!is_numeric($TXTNroEmiCHE)){
					$Xtodo_ok = FALSE;
					$Xerror_num.= " NUMERO CHEQUE ";		
				}
			}
			
			if(strlen($TXTBcoEmiCHE)==0){
				$Xtodo_ok = FALSE;
				$Xerror_num.= " BANCO CHEQUE ";	
			}
			echo $TXTMonChe;
			if(strlen($TXTMonChe)==0){
				$Xtodo_ok = FALSE;
				$Xerror_num.= " MONTO CHEQUE";
			}else{
				if(!is_numeric($TXTMonChe)){
					$Xtodo_ok = FALSE;
					$Xerror_num.= " MONTO CHEQUE";		
				}
			}
							
		}//Fin si agrego cheque 
		#VALIDACIONES    
		
		if(strlen($RDOCO)==0){
			$Xtodo_ok = FALSE;
			$Xerror_num.= " TIPO DE CAMBIO ";
		}
		
		if(strlen($TXTMontoPA)==0){
			$Xtodo_ok = FALSE;
			$Xerror_num.= " MONTO ";
		}else{
			if(!is_numeric($TXTMontoPA)){
				$Xtodo_ok = FALSE;
				$Xerror_num.= " MONTO ";		
			}
		}

		if(strlen($TXTMontoCO)==0){
			$Xtodo_ok = FALSE;
			$Xerror_num.= " MONTO AR$ ";
		}else{
			if(!is_numeric($TXTMontoCO)){
				$Xtodo_ok = FALSE;
				$Xerror_num.= " MONTO AR$ ";		
			}
		}


		if(strlen($RDOTipPago)==0){	
			$Xtodo_ok = FALSE;
			$xerror_tip = FALSE;
			$Xerror_num.= " ";
		}
		
		if(strlen($Xerror_num)!=0){
			if($xerror_tip!= FALSE){
				$Xerror_num.= " DEBE/DEBEN SER NUMERICO/NUMERICOS ";
			}
			
			if($xerror_tip== FALSE){
				$Xerror_num.= " DEBE SELECCIONAR UN TIPO DE PAGO, VERIFIQUE ";	
			}
		}						
		#guardo los datos en la base correspondiente  //////////////////////////////////////////////////////
		
	if($Xtodo_ok==true){#Si esta todo bien	
				
		$db2  = conecto();
		$sql2 = " INSERT INTO adelantocliente (cod_ord, cer_ori, fe_firm_contra, tipo_ad, fe_pri_ad, monto_ad, tipo_cam_ad, met_pag_ad, banco_ad, mon_ar_ad, fe_ven_ins_pic, mon_blu) VALUES ('".$cod."','".$RDOCerOr."','".$LSTfechaFdC."','".$RDOTipPago."','".$LSTfechaPAC."','".$TXTMontoPA."','".$RDOCO."','".$RDOMetPagCO."','".$TXTBncoCO."','".$TXTMontoCO."','".$CantDiasInsPic."','".$TXTMontoBLUE."') ";
		
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
			
			$Xlugar_che = "adelantocliente";
				
			$db5  = conecto(); 
			$sql5 = " INSERT INTO cheques (cod_ord, lugar_che, bco_emi_che, nro_che, fe_emi_che, emi_che, paga_che, observa_che, cod_ref, fe_sal_che, fe_dif_che, monto_che, resto12) VALUES ('".$cod."','".$Xlugar_che."','".$TXTBcoEmiCHE."','".$TXTNroEmiCHE."','".$FEEmiChe."','".$TXTPerEmiCHE."','".$TXTPagadoCHE."','".$TXTObservaCHE."','".$Xultimocod_AC."','".$FESalCHE."','".$TXTFeDifCHE."', '".$TXTMonChe."' ,'".$RDResto12."') ";
			//echo $sql5;exit();
			$r5   = mysqli_query($db5, $sql5);
			if ($r5 == false){
				mysqli_close($db5);
				$error = "Error: (" . mysql_errno() . ") " . mysql_error().")";
				//gestion_errores();
			}
				
				mysqli_close($db5);			
		
		}//fin Si agrego un cheque..	
		
		if($_POST['BTNALTA']){		
			echo "<script language='javascript'>alert('El Registro a sido Creado');window.location.href='../veoordenes.php?cod=$cod'; </script>"; 
		}
		
		if($_POST['BTNALTAS']){
			echo "<script language='javascript'>alert('El Registro a sido Creado');window.location.href='../abms/adelantocliente.php?cod=$cod&accion=MOD&codadcli=$Xultimocod_AC'; </script>";
		}
		
		}#Fin Si esta todo bien				
	}#fin alta

	if($_POST['BTNMOD']){
			
		$Xtodo_ok 		= true;
		$xerror_tip 	= true;		
		$Xerror_num 	= "";
		
		$CantDiasInsPic = trim($_POST['CantDiasInsPic_anio'].'-'.$_POST['CantDiasInsPic_mes'].'-'.$_POST['CantDiasInsPic_dia']);
		
		$cod_adcli 	 = trim($_POST['cod_adcli']);
		$RDOCerOr 	 = trim($_POST['RDOCerOr']);
		$LSTfechaFdC = trim($_POST['LSTfechaFdC_anio'].'-'.$_POST['LSTfechaFdC_mes'].'-'.$_POST['LSTfechaFdC_dia']);
		$RDOTipPago  = trim($_POST['RDOTipPago']);
		$LSTfechaPAC = trim($_POST['LSTfechaPAC_anio'].'-'.$_POST['LSTfechaPAC_mes'].'-'.$_POST['LSTfechaPAC_dia']);
		$TXTMontoPA	 = trim($_POST['TXTMontoPA']);
		$RDOCO 	 	 = trim($_POST['RDOCO']);
		$TXTMontoCO	 = trim($_POST['TXTMontoCO']);
		$RDOMetPagCO = trim($_POST['RDOMetPagCO']);
		$TXTBancoCO  = trim(strtoupper($_POST['TXTBancoCO']));
		$TXTMontoBLUE = trim($_POST['TXTMontoBLUE']);
		
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
		$TXTMonChe		= strtoupper(trim($_POST['TXTMonChe']));		
		$RDResto12		= trim($_POST['RDResto12']);	
			
		if(strlen($RDOCerOr)==0){$RDOCerOr = "";}
		if(strlen($LSTfechaFdC)<4){$LSTfechaFdC = "";}
		if(strlen($RDOTipPago)==0){$RDOTipPago = "";}
		if(strlen($LSTfechaPAC)<4){$LSTfechaPAC = "";}	
		if(strlen($TXTMontoPA)==0){$TXTMontoPA = "";}
		if(strlen($RDOCO)==0){$RDOCO = "";}
		if(strlen($TXTMontoCO)==0){$TXTMontoCO = "";}
		if(strlen($RDOMetPagCO)==0){$RDOMetPagCO = "";}
		if(strlen($TXTBancoCO)==0){$TXTBancoCO = "";}

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
		if(strlen($TXTMontoBLUE)==0){$TXTMontoBLUE = "";}
		

		#consulto la cantidad de dias puestos  para la alarma
		$db  = conecto();
		$sql = "select fe_ven_ins_pic from adelantocliente where cod_ord = ".$cod_adcli." ";
		
		$r   = mysqli_query($db, $sql);
		
		if ($r == false){
			mysqli_close($db);
			$error = "Error: (" . mysql_errno() . ") " . mysql_error().")";
			//gestion_errores();
		}
			mysqli_close($db);
		
		$arr_pri  = mysqli_fetch_array($r);
		$cantidad = $arr_pri['canti'];
	
		if($cantidad==0){
			$MuestroDias 	= true;
		}
				
		#VALIDACIONES
					
		if(strlen($TXTMontoPA)==0){
				$Xtodo_ok = FALSE;
				$Xerror_num.= " MONTO ";	
		}else{
			if(!is_numeric($TXTMontoPA)){
				$Xtodo_ok = FALSE;
				$Xerror_num.= " MONTO ";		
			}
		}

		if(strlen($TXTMontoCO)==0){
			$TXTMontoCO = "";	
		}else{
			if(!is_numeric($TXTMontoCO)){
				$Xtodo_ok = FALSE;
				$Xerror_num.= " MONTO AR$ ";		
			}
		}

		if(strlen($TXTNroEmiCHE)==0){
			$TXTNroEmiCHE = "";	echo $TXTNroEmiCHE;
		}else{
			if(!is_numeric($TXTNroEmiCHE)){
				$Xtodo_ok = FALSE;
				$Xerror_num.= " NUMERO CHEQUE ";		
			}
		}
		
		if(strlen($RDOTipPago)==0){	
			$Xtodo_ok = FALSE;
			$xerror_tip = FALSE;
		}
		
		if(strlen($Xerror_num)!=0){
			if($xerror_tip!= FALSE){
				$Xerror_num.= " DEBE/DEBEN SER NUMERICO/NUMERICOS ";
			}
			
			if($xerror_tip== FALSE){
				$Xerror_num.= " DEBE SELECCIONAR UN TIPO DE PAGO, VERIFIQUE ";	
			}
		}							
		#guardo los datos en la base correspondiente  //////////////////////////////////////////////////////
		
	if($Xtodo_ok==true){#Si esta todo bien	
					
		$db3  = conecto();
		$sql3 = " UPDATE adelantocliente SET
					cer_ori  = '".$RDOCerOr."',
					fe_firm_contra  = '".$LSTfechaFdC."',
					tipo_ad  = '".$RDOTipPago."',
					fe_pri_ad  = '".$LSTfechaPAC."',
					monto_ad  = '".$TXTMontoPA."',
					tipo_cam_ad  = '".$RDOCO."',
					met_pag_ad  = '".$RDOMetPagCO."',
					banco_ad = '".$TXTBancoCO."',
					mon_ar_ad = '".$TXTMontoCO."',
					fe_ven_ins_pic = '".$CantDiasInsPic."',
					mon_blu = '".$TXTMontoBLUE."',
					where cod_ord = '".$cod."' and cod_adcli = '".$cod_adcli."' ";
				
		$r3   = mysqli_query($db3, $sql3);
		#echo $sql3;exit();
		if ($r3 == false){
	    	mysqli_close($db3);
	        $error = "Error: (" . mysql_errno() . ") " . mysql_error().")";
	        //gestion_errores();
	    }
	      mysqli_close($db3);

		if(strlen($TXTBcoEmiCHE)!=0){//Si agrego un cheque..

		#VEO SI TIENE UN CHEQUE------------------->
		$Xlugar_che = "adelantocliente";
		
		$db_vc  = conecto();
		$sql_vc = " select count(*) as canti from cheques where cod_ord = ".$cod." and lugar_che  = '".$Xlugar_che."' and cod_ref  = '".$cod_adcli."' ";
		
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
			
			$Xlugar_che = "adelantocliente";
			//echo $cod_adcli; exit();
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
					fe_dif_che = '".$TXTFeDifCHE."',
					resto12	= '".$RDResto12."'
					where cod_ord = ".$cod." and lugar_che  = '".$Xlugar_che."' and cod_ref  = '".$cod_adcli."' ";
	 			
			//echo $sql33;exit();
			$r33   = mysqli_query($db33, $sql33);
		
			if ($r33 == false){
				mysqli_close($db33);
				$error = "Error: (" . mysql_errno() . ") " . mysql_error().")";
				//gestion_errores();
			}
				
				mysqli_close($db33);
				
		}else{//Si no tenia..
		
			$Xlugar_che = "adelantocliente";
		
			$db5  = conecto(); 
			$sql5 = " INSERT INTO cheques (cod_ord, lugar_che, bco_emi_che, nro_che, fe_emi_che, emi_che, paga_che, observa_che, cod_ref, fe_sal_che, fe_dif_che) VALUES ('".$cod."','".$Xlugar_che."','".$TXTBcoEmiCHE."','".$TXTNroEmiCHE."','".$FEEmiChe."','".$TXTPerEmiCHE."','".$TXTPagadoCHE."','".$TXTObservaCHE."','".$cod_adcli."','".$FESalCHE."','".$TXTFeDifCHE."') ";
			
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
			if(($RDOMetPagCO=="E")||($RDOMetPagCO=="B")){ 
			
				$Xlugar_che = "adelantocliente";
		
				$db_delche  = conecto(); 
				$sql_delche = " DELETE FROM cheques where cod_ord = ".$cod." and lugar_che  = '".$Xlugar_che."' and cod_ref  = '".$cod_adcli."'  ";
			
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
		
		echo "<script language='javascript'>
				 alert('El Registro a sido Modificado');
				window.location.href='../veoordenes.php?cod=$cod'; </script>"; 
	}#Si esta todo bien					
	}


	#Si agrega un cheque
	if($_POST['BTNAgrChe']){
		
		$Xtodo_ok 	= true;
		$Xerror_num = "";
		$Xerror 	= "";
		$accion 	= $_GET['accion'];
		$codadcli 	= $_GET['codadcli'];
		$cod	 	= $_GET['cod'];	
		$lugar		= "adelantocliente";
		       				
			if(strlen($cod_fac_ing)==0){$cod_fac_ing = "";}

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
			$RDResto12  	= trim($_POST['RDResto12']);
			
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
			$sql5 = " INSERT INTO cheques (cod_ord, lugar_che, bco_emi_che, nro_che, fe_emi_che, emi_che, paga_che, observa_che, cod_ref, fe_sal_che, fe_dif_che, monto_che, resto12) VALUES ('".$cod."','".$lugar."','".$TXTBcoEmiCHE."','".$TXTNroEmiCHE."','".$FEEmiChe."','".$TXTPerEmiCHE."','".$TXTPagadoCHE."','".$TXTObservaCHE."','".$codadcli."','".$FESalCHE."','".$TXTFeDifCHE."','".$TXTMonChe."','".$RDResto12."') "; 
				
			//echo $sql5;exit();
			$r5   = mysqli_query($db5, $sql5);
			
			if ($r5 == false){
				mysqli_close($db5);
				$error = "Error: (" . mysql_errno() . ") " . mysql_error().")";
				//gestion_errores();
			}
					
				mysqli_close($db5);	
			
			header('location:adelantocliente.php?accion=MOD&cod='.$cod.'&codadcli='.$codadcli.'');
			exit();		 	
								
		}//Si agrego un cheque..
				
	}
	#Fin Si agrega un cheque
	
		
	if($_POST['BTNELI']){

		$db4  = conecto();
		$sql4 = " delete from adelantocliente where cod_ord = ".$cod." and cod_adcli = '".$cod_adcli."' ";
		$r4   = mysqli_query($db4, $sql4);

		if ($r4 == false){
	    	mysqli_close($db4);
	        $error = "Error: (" . mysql_errno() . ") " . mysql_error().")";
	        //gestion_errores();
	    }
	      mysqli_close($db4);

		$db_delche  = conecto(); 	
		$sql_delche = " DELETE FROM cheques where cod_ord = ".$cod." and lugar_che  = '".$Xlugar_che."' and cod_ref  = '".$cod_adcli."'  ";		
		#echo $sql_delche;exit();
		$r_delche   = mysqli_query($db_delche, $sql_delche);
					
		if ($r_delche == false){
			mysqli_close($db_delche);
			$error = "Error: (" . mysql_errno() . ") " . mysql_error().")";
			//gestion_errores();
		}			
			mysqli_close($db_delche);
				  
		echo "<script language='javascript'>
				 alert('El Registro a sido Eliminado');
				window.location.href='../veoordenes.php?cod=$cod'; </script>"; 	
	}
	
	if($_POST['BTNvolver']){//volver al menu
 		header ('location:../veoordenes.php?cod='.$cod);
		exit();		
	}		
		
}else{
	
	$Xerror 	= "";
	$cod 		= $_GET['cod'];
	$cod_adcli	= $_GET['codadcli'];
	$accion 	= $_GET['accion'];

	$veo_cheque = "N";
	$Xerror_num	= "";
	$cantidad   = 0;	
	
	//Formateo las variables
	$RDOCerOr 	 = "";	
	$LSTfechaFdC = "";
	$RDOTipPago	 = "";
	$LSTfechaPAC = "";	
	$TXTMontoPA  = "";
	$RDOCO 		 = "";
	$RDOMetPagCO = "";
	$TXTBancoCO  = "";
	$TXTMontoCO  = "";
	
	$TXTBcoEmiCHE 	= "";
	$TXTNroEmiCHE 	= "";
	$FEEmiChe 		= "";
	$TXTPerEmiCHE 	= "";
	$TXTPagadoCHE 	= "";
	$TXTObservaCHE  = "";
	$RDResto12		= "";
	
	$FESalCHE 		= "";
	$TXTConIngCHE	= "";
	$TXTConSalCHE	= "";
	$TXTFeDifCHE	= "";
	$TXTMonChe		= "";
	$veo_cheque		= "N";
	//Fin Formateo las variables
	$MuestroDias 	= false;
	
	#consulto si es el primer adelanto
	$db  = conecto();
	$sql = "select count(*) as canti from adelantocliente where cod_ord = ".$cod." ";
	
	$r   = mysqli_query($db, $sql);
	
	if ($r == false){
	   	mysqli_close($db);
	    $error = "Error: (" . mysql_errno() . ") " . mysql_error().")";
	    //gestion_errores();
	}
	  	mysqli_close($db);
	
	$arr_pri = mysqli_fetch_array($r);
	$cantidad = $arr_pri['canti'];

	if($cantidad==0){
		$MuestroDias = true;	
	}
	
	
	if(($accion == "MOD")or($accion == "ELI")){
			
		#ADELANTOCLIENTE
		$db1  = conecto();
		$sql1 = "select * from adelantocliente where cod_adcli = ".$cod_adcli." ";
		#echo $sql1;
		$r1   = mysqli_query($db1, $sql1);
	
		if ($r1 == false){
	    	mysqli_close($db1);
	        $error = "Error: (" . mysql_errno() . ") " . mysql_error().")";
	        //gestion_errores();
	    }
	    	mysqli_close($db1);
		
		while ($arr1 = mysqli_fetch_array($r1))		
		{
			$cod_adcli	 = trim($arr1['cod_adcli']);	
			$RDOCerOr	 = trim($arr1['cer_ori']);
			$LSTfechaFdC = trim($arr1['fe_firm_contra']);
			$RDOTipPago	 = trim($arr1['tipo_ad']);
			$LSTfechaPAC = trim($arr1['fe_pri_ad']);
			$TXTMontoPA	 = trim($arr1['monto_ad']);
			$RDOCO 		 = trim($arr1['tipo_cam_ad']);
			$RDOMetPagCO = trim($arr1['met_pag_ad']);
			$TXTBancoCO	 = trim($arr1['banco_ad']);
			$TXTMontoCO  = trim($arr1['mon_ar_ad']);	
			$TXTMontoBLUE  = trim($arr1['mon_ar_ad']);		
			#formateo las que no tienen nada																											
		}
			if(strlen($RDOCerOr)==0) $RDOCerOr = "";	
			if(strlen($LSTfechaFdC)==0) $LSTfechaFdC = "";
			if(strlen($RDOTipPago)==0) $RDOTipPago = "";
			if(strlen($LSTfechaPAC)==0) $LSTfechaPAC = "";	
			if(strlen($TXTMontoPA)==0) $TXTMontoPA = "";
			if(strlen($RDOCO)==0) $RDOCO = "";
			if(strlen($RDOMetPagCO)==0)	$RDOMetPagCO = "";
			if(strlen($TXTBancoCO)==0) $TXTBancoCO = "";
			if(strlen($TXTMontoCO)==0) $TXTMontoCO = "";
			if(strlen($TXTMontoBLUE)==0) $TXTMontoBLUE = "";
#------------------------------------CHEQUES
		$Xlugar_che = "adelantocliente";
		
		$db_vc  = conecto();
		$sql_vc = " select count(*) as canti from cheques where cod_ord = ".$cod." and lugar_che  = '".$Xlugar_che."' and cod_ref = '".$cod_adcli."' ";
		//echo $sql_vc;exit();
		$r_vc	  = mysqli_query($db_vc, $sql_vc);
		
		if ($r_vc == false){
			mysqli_close($db_vc);
			//$error = "Error: (" . mysql_errno() . ") " . mysql_error().")";
			gestion_errores();
		}
			mysqli_close($db_vc);	
		
		$arrx = mysqli_fetch_array($r_vc);
		$cantidad = $arrx['canti'];
		//echo $cantidad; exit();
				
		#CHEQUES
		
		$db11  = conecto();
		$sql11 = "select * from cheques where cod_ord = '".$cod."' and lugar_che = '".$Xlugar_che."' and cod_ref = '".$cod_adcli."' ";
		$r11   = mysqli_query($db11, $sql11);
	
		if ($r11 == false){
	    	mysqli_close($db11);
	        $error = "Error: (" . mysql_errno() . ") " . mysql_error().")";
	        //gestion_errores();
	    }
	    	mysqli_close($db11);
		/*		
		while ($arr2 = mysqli_fetch_array($r11))		
		{
			$TXTBcoEmiCHE 	= trim($arr2['bco_emi_che']); 
			$TXTNroEmiCHE 	= trim($arr2['nro_che']);
			$FEEmiChe 		= trim($arr2['fe_emi_che']);
			$TXTPerEmiCHE 	= trim($arr2['emi_che']);
			$TXTPagadoCHE 	= trim($arr2['paga_che']);
			$TXTObservaCHE  = trim($arr2['observa_che']);
			
			$FESalCHE  		= trim($arr2['fe_sal_che']);
			$TXTConIngCHE  	= trim($arr2['concep_ing_che']);
			$TXTConSalCHE  	= trim($arr2['concep_sal_che']);
			$TXTFeDifCHE  	= trim($arr2['fe_dif_che']);		
		}
		
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
		*/
		if( strlen($TXTBcoEmiCHE)!=0 ){
			$veo_cheque = "S";
		}		
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
	
				
	/*FUNCIONES DE MONEDA*/		
	function FuncBlue() {
		//document.getElementById("moneda").innerHTML = "U$S";		
		 document.getElementById("montoblue").style.display = "block"; 	
	}		

	function FuncPesos() {
		//document.getElementById("moneda").innerHTML = "AR$";
		document.getElementById("montoblue").style.display = "none";
	}	
	
	function CalcularTotal() {
		
		 var RDOCO = $('input:radio[name=RDOCO]:checked').val();
		 var montoB = $("#TXTMontoBLUE").val();		 
		 var montoC	= $("#TXTMontoCO").val();
		 
		 if(RDOCO=="B"){
		 	var montoA	= $("#TXTMontoPA").val();
			var Resultado = (montoA * montoB) / montoC;
		 }

		 if(RDOCO=="P"){
		 	var montoA	= $("#TXTMontoPA").val();
			var Resultado = montoA * montoC;
		 }
		 
		 if(RDOCO=="O"){
		 	var montoA	= $("#TXTMontoPA").val();
			var Resultado = montoA;
		 }

		 if(RDOCO==""){
		 	var montoA	= 0;
		 }		 		 		 
		 	
		$("#total").val(Resultado);	
	}
			
    </script>
 </head>
<body>
	<div id="page-wrap"> 
 <form action="" method="post" name="form1" >   
    <?php include 'menu.php'; ?>

    <div class="caption">_%%_empresanombre_%%_.</div> 
	<p>USUARIO: <?php echo $Xnombre; ?></p>
	<table class="sombra">
      <thead>
	          <tr>
	            <th colspan="6" align="center">
                <input name="cod_adcli"  id="cod_adcli"  value="<?php echo $cod_adcli; ?>" type="hidden">
                <div align="center">ADELANTO / PAGO DEL CLIENTE</div></th>
	            </tr>
	          </thead>
	        <tbody>
	          <tr>
	            <td colspan="6"><?php echo '<div align="center" style="color:red; font-weight: bold;">'.$Xerror." ".$Xerror_num.'</div>'; ?></td>
	          </tr>
	          <tr>
	            <td colspan="6"><div align="center"><span style="color: #000"><strong>DETALLE</strong></span></div></td>
	          </tr>
              
              <?php 
              	if($MuestroDias == true){
			  ?>
              <tr>
                <td colspan="6">Ingrese fecha limite para cargar las Inspection Pictures:<?php pinto_fecha('CantDiasInsPic','','');?></td>
              </tr>
              <?php 
				}
			  ?> 
                            
	          <tr>
	            <td width="240"><strong>FECHA FIRMA DE CONTRATO: </strong></td>
	            <td width="205"><?php pinto_fecha('LSTfechaFdC','','');?>  </td>
	            <td width="126"><strong>TIPO DE PAGO:</strong></td>
	            <td colspan="3">
                	<strong>ADELANTO<input type="radio" name="RDOTipPago" id="RDOTipPago" value="A" class="button" <?php if($RDOTipPago=="A"){ echo "checked";} ?>></strong>
                    <strong>PAGO<input name="RDOTipPago" type="radio" id="RDOTipPago" value="P" class="button" <?php if($RDOTipPago=="P"){ echo "checked";} ?> checked>
                </strong></td>
	            </tr>
	          <tr>
	            <td><strong>FECHA PRIMER ADELANTO:</strong></td>
	            <td><?php pinto_fecha('LSTfechaPAC','','');?></td>
	            <td><strong>MONTO: </strong></td>
	            <td colspan="2"><strong><input name="TXTMontoPA" type="text" id="TXTMontoPA" maxlength="11" value="<?php echo $TXTMontoPA; ?>" class="button" required></strong></td>
	            <td width="95"><?php if(strlen($Xerror_num)!=0){ echo '<div style="float:right; color:red; font-weight: bold; ">(*)<div>';} ?></td>
              </tr>
	          <tr>
	            <td><strong>TIPO DE CAMBIO:</strong></td>
	            <td colspan="5">
                	<div style="display: inline-block;">
                		<div id="primero" style="float: left;  height: 90px; line-height: 90px;">BLUE:<input type="radio" name="RDOCO" id="RDOCO" value="B" class="button" <?php if($RDOCO=="B"){ echo "checked";} ?> onclick="FuncBlue()">
                        </div>

                   <?php 
				  	if ($RDOCO==='B')
					{
						echo '<div id="montoblue" style="display:block; float:left; height: 90px; line-height: 90px;">'; 
					}else{
						echo '<div id="montoblue" style="display:none; float:left; height: 90px; line-height: 90px;">';
					}
				   ?>                        
              		<input name="TXTMontoBLUE" type="text" id="TXTMontoBLUE" maxlength="11" value="<?php echo $TXTMontoBLUE; ?>" class="button"><strong>.AR$</strong>  &nbsp;
                    </div>
              		<div style="float:left; height: 90px; line-height: 90px;">
                	PESOS: 
                	  <input type="radio" name="RDOCO" id="RDOCO" value="P" class="button" <?php if($RDOCO=="P"){ echo "checked";} ?> onclick="FuncPesos()">
            		OFICIAL: <input type="radio" name="RDOCO" id="RDOCO" value="O" class="button" <?php if($RDOCO=="O"){ echo "checked";} ?>>
            <input name="TXTMontoCO" type="text" id="TXTMontoCO" maxlength="11" value="<?php echo $TXTMontoCO; ?>" class="button" required> 
<strong>.AR$</strong>
            <?php if(strlen($Xerror_num)!=0){ echo '<div style="float:right; color:red; font-weight: bold; ">(*)<div>';} ?>
            		</div>
            		</div></td>
              </tr>

			  <?php  if(($accion == "MOD")or($accion == "ELI")){ ?>
                     
              <tr>
                <td><strong>MONTO TOTAL EN U$S:</strong></td>
                <td colspan="5"><?php echo  $totaluss = $TXTMontoPA / $TXTMontoCO;?></td>
              </tr>
              
              <?php 
			  	}
			   ?>
                                        
         	 <?php
			 	if ($cantidad <= "0"){//Si ya tenia cheques..
			   ?>
              <tr>
                <td><strong>METODO DE PAGO:</strong></td>
                <td colspan="5">EFECTIVO:
	              <input type="radio" name="RDOMetPagCO" id="RDOMetPagCO" value="E" onclick="toggle(this)" class="button" <?php if($RDOMetPagCO=="E"){ echo "checked";} ?> >
	              CHEQUE:
	              <input type="radio" name="RDOMetPagCO" id="RDOMetPagCO" value="C" onclick="toggle(this)" class="button" <?php if($RDOMetPagCO=="C"){ echo "checked";} ?>>
	              BANCO:
	              <input type="radio" name="RDOMetPagCO" id="RDOMetPagCO" value="B" onclick="toggle(this)" class="button" <?php if($RDOMetPagCO=="B"){ echo "checked";} ?>>
	              <strong>
                  <input name="TXTBancoCO" type="text" id="TXTBancoCO" maxlength="30" value="<?php echo $TXTBancoCO; ?>" class="button">
</strong></td>
              </tr>
               <tr>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
                <td><input type="button" name="Total" id="Total" value="Calcular Total" class="button" onclick="CalcularTotal()"></td>
                <td><div align="right"><strong>TOTAL:</strong></div></td>
                <td><input type="text" name="total" id="total"  value="" class="button"></td>
              </tr>     	  
			  <?php 
			  	}else{  
			  		$veo_cheque="S"; 
			   ?>

              <tr>
                <td colspan="6"><div align="center" class="subtitulo"><strong>CHEQUES<input type="radio" name="RDObancoFI" id="RDObancoFI" value="C" class="button" checked disabled></strong></div></td>
              </tr>
              
              <!--CHEQUES-->
				<?php    
					$Xtotal = 0;
					
					while ($arrch = mysqli_fetch_array($r11))
                    {
					/*
						$TXTBcoEmiCHE 	= trim($arrch['bco_emi_che']);
						
						$TXTNroEmiCHE 	= trim($arrch['nro_che']);
						$FEEmiChe 		= trim($arrch['fe_emi_che']);
						$TXTPerEmiCHE 	= trim($arrch['emi_che']);
						$TXTObservaCHE  = trim($arrch['observa_che']);
						
						$FESalCHE  		= trim($arrch['fe_sal_che']);
						$TXTConIngCHE  	= trim($arrch['concep_ing_che']);
						$TXTConSalCHE  	= trim($arrch['concep_sal_che']);
						$TXTFeDifCHE  	= trim($arrch['fe_dif_che']);*/
						
						$resto12	 	= trim($arrch['resto12']);
						$monto_che  	= trim($arrch['monto_che']);
						
						if($resto12=="S"){ 
							$monto_resta 	= $monto_che * 0.012; 
							$monto_che	= $monto_che - $monto_resta;
						}						
						
						
						
						#Formateo lOS CHEQUES
					/*	if(strlen($TXTBcoEmiCHE)==0){$TXTBcoEmiCHE = "";}	
						if(strlen($TXTNroEmiCHE)==0){$TXTNroEmiCHE = "";}	
						if(strlen($FEEmiChe)<4){$FEEmiChe = "";}	
						if(strlen($TXTPerEmiCHE)==0){$TXTPerEmiCHE = "";}	
						if(strlen($TXTObservaCHE)==0){$TXTObservaCHE = "";}	
				
						if(strlen($FESalCHE)<4){$FESalCHE = "";}	
						if(strlen($TXTConIngCHE)==0){$TXTConIngCHE = "";}	
						if(strlen($TXTConSalCHE)==0){$TXTConSalCHE = "";}		
						if(strlen($TXTFeDifCHE)<4){$TXTFeDifCHE = "";}	
						if(strlen($monto_che)==0){$monto_che = "";}	
					*/	
						$Xtotal = $Xtotal + $monto_che;				
                 ?>
                <tr>
                    <td><strong>NUMERO:</strong> <?php echo $nro_che = trim($arrch['nro_che']);?></td>
                    <td><strong>BANCO:</strong> <?php  echo $bco_emi_che = trim($arrch['bco_emi_che']); ?></td>
                    <td><strong>FECHA:</strong> <?php echo $fecha_alta = date("d-m-Y", strtotime($arrch['fe_emi_che'])); ?></td>
                    <td width="134"><strong>MONTO:</strong> <?php echo round($monto_che, 2); ?></td>
                    <td width="199"><strong>-1.2:</strong> <?php if($resto12=="S"){ echo "SI"; }else{ echo "NO"; }?></td>
                  <td><a href="<?php 	$cod_che = trim($arrch['cod_che']);
                                        echo 'adelantocliente.php?codche='.$cod_che.'&accion='.$accion.'&cod='.$cod.'&codadcli='.$cod_adcli; ?>">
                    <button class="button" type="button">
                    <?php 
                                        echo 'Eliminar';
                                    ?>
                    </button>
                  </a> <a href="<?php 	$cod_che = trim($arrch['cod_che']);
                                        echo '../veocheque.php?cod='.$cod_che; ?>">
                  <button class="button" type="button">
                  <?php 
                                        echo 'Ver';
                                    ?>
                  </button>
                  </a></td>
                </tr>
                <?php }  ?>
                <tr>
                  <td><strong>TOTALES</strong></td>
                  <td>&nbsp;</td>
                  <td>&nbsp;</td>
                  <td><?php echo round($Xtotal, 2); ?></td>
                  <td colspan="2">&nbsp;</td>
                </tr>
                <tr>
            <?php } ?>        

			<?php

			?> 
	            <td colspan="6"><div id="uno" <?php //echo $veo_cheque;
													if($veo_cheque!="S"){
														echo 'style="display:none;"';
													} ?> >
   				  <div align="center"><p><strong>DATOS DEL CHEQUE</strong></p>
                				</div>
                                <table width="100%" border="0">
                                  <tr>
                                    <td width="20%"><strong>BANCO EMISOR:</strong></td>
                                    <td colspan="3"><strong>
                                    <input type="text" class="button" id="TXTBcoEmiCHE" name="TXTBcoEmiCHE" value="<?php echo $TXTBcoEmiCHE ?>">
                                    </strong></td>
                                  </tr>
                                  <tr>
                                    <td><strong>NUMERO DEL CHEQUE:</strong></td>
                                    <td colspan="3"><strong>
                                    <input type="text" class="button" id="TXTNroEmiCHE" name="TXTNroEmiCHE" value="<?php echo $TXTNroEmiCHE ?>">
                                    </strong></td>
                                  </tr>
                                  <tr>
                                    <td><strong>FECHA DEL CHEQUE:</strong></td>
                                    <td colspan="3"><strong>
                                    <?php pinto_fecha('FEEmiChe','','');?>
                                    </strong></td>
                                  </tr>
                                  <tr>
                                    <td><strong>EMISOR:</strong></td>
                                    <td colspan="3"><strong>
                                    <input type="text" class="button" id="TXTPerEmiCHE" name="TXTPerEmiCHE" value="<?php echo $TXTPerEmiCHE ?>">
                                    </strong></td>
                                  </tr>
                                  <tr>
                                    <td><strong>FECHA SALIDA CHEQUE:</strong></td>
                                    <td colspan="3"><?php pinto_fecha('FESalCHE','','');?></td>
                                  </tr>
                                  <tr>
                                    <td><strong>CONCEPTO INGRESO:</strong></td>
                                    <td colspan="3"><strong>
                                    <input type="text" class="button" id="TXTConIngCHE" name="TXTConIngCHE" value="<?php echo $TXTConIngCHE ?>">
                                    </strong></td>
                                  </tr>
                                  <tr>
                                    <td><strong>CONCEPTO SALIDA:</strong></td>
                                    <td colspan="3"><strong>
                                    <input type="text" class="button" id="TXTConSalCHE" name="TXTConSalCHE" value="<?php echo $TXTConSalCHE ?>">
                                    </strong></td>
                                  </tr>
                                  <tr>
                                    <td><strong>FECHA DIFERIDO DEL CHEQUE:</strong></td>
                                    <td colspan="3"><strong>
                                    <?php pinto_fecha('TXTFeDifCHE','','');?>
                                    </strong></td>
                                  </tr>                                  
                                  <tr>
                                    <td><strong>MONTO:</strong></td>
                                    <td><strong>
                                      <input type="text" class="button" id="TXTMonChe" name="TXTMonChe" value="<?php echo $TXTMonChe ?>"></strong>
                                      <?php if(strlen($Xerror_num)!=0){ echo '<div style="float:right; color:red; font-weight: bold; ">(*)<div>';} ?></td>
                                    <td><strong>RESTAR 1.2%:</strong></td>
                                    <td><strong>
                                    SI
                                        <input name="RDResto12" type="radio" class="button" id="RDResto12" value="S" checked <?php if($RDResto12=="S"){ echo "checked";} ?>>
                                    </strong><strong>NO</strong><strong>
                                    <input type="radio" name="RDResto12" id="RDResto12" value="N" class="button" <?php if($RDResto12=="N"){ echo "checked";} ?>>
                                    </strong></td>
                                  </tr>
                                  <tr>
                                    <td><strong>OBSERVACIONES:</strong></td>
                                    <td colspan="3"><strong>
                                    <input type="text" class="button" id="TXTObservaCHE" name="TXTObservaCHE" value="<?php echo $TXTObservaCHE ?>">
                                    </strong></td>
                                  </tr>
                                   <tr>
                                    <td>&nbsp;</td>
                                    <td colspan="3"><div align="right">
                                    <?php if(($accion == "MOD")or($accion == "ELI")){?>
                                    
										<input name="BTNAgrChe" type="submit" class="button" id="BTNAgrChe" value="AGREGAR">
									
                                    <?php }?>
									</div></td>
                                  </tr> 
                                </table>

                                </div></td>
              </tr>    
                          
                <!--CHEQUES--> 

	            <td colspan="6"><div align="center"><span style="color: #000">
	              <?php  
				  	if($accion == "ALT"){
					  	echo '<input name="BTNALTA" type="submit" class="button" id="BTNALTA" value="ALTA">';
						echo '<input name="BTNALTAS" type="submit" class="button" id="BTNALTAS" value="ALTA Y SEGIR CARGANDO">';
				  	} 
					
					if($accion == "MOD"){
					  	echo '<input name="BTNMOD" type="submit" class="button" id="BTNMOD" value="MODIFICAR">';
					}
					
					if($accion == "ELI"){
					  	echo '<input name="BTNELI" type="submit" class="button" id="BTNELI" value="ELIMINAR">';
					}
					?>
	              </span><span style="color: #000">
	              <a href="<?php echo "../veoordenes.php?cod=".$cod; ?>"><input type="button" name="BTNvolver" id="BTNvolver" class="button" value="VOLVER AL MENU"></a>
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
