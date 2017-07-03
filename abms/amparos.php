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

	if ($DEL == "D"){
		$CampoDel = "djai";
	}
	if ($DEL == "MC"){
		$CampoDel = "med_cau";
	}	
	if ($DEL == "SC"){
		$CampoDel = "seg_cau";
	}		
	if ($DEL == "O"){
		$CampoDel = "oficio";
	}

	if ($DEL == "PL"){
		$CampoDel = "packing_list";
	}
	if ($DEL == "ED"){
		$CampoDel = "exp_decla";
	}
	if ($DEL == "NC"){
		$CampoDel = "price_list";
	}
	if ($DEL == "NDC"){
		$CampoDel = "not_comp";
	}
	if ($DEL == "CO"){
		$CampoDel = "cer_ori";
	}							
	if ($DEL == "DES"){
		$CampoDel = "desp";
	}
	if ($DEL == "PS"){
		$CampoDel = "pol_seg";
	}

		$db6  = conecto();
		$sql6 = " update amparos set ".$CampoDel."  = '' where cod_ord = ".$cod." ";
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
 
		$FILEdjai		= $_FILES['FILEdjai']['name'];
		$FILEmed_cau	= $_FILES['FILEmed_cau']['name'];
		$FILEseg_cau	= $_FILES['FILEseg_cau']['name'];
		$FILEoficio		= $_FILES['FILEoficio']['name'];
		$RDOVentaja		= trim($_POST['RDOVentaja']);
		
		$FILEpack_list	= $_FILES['FILEpack_list']['name'];
		$FILEexp_decla	= $_FILES['FILEexp_decla']['name'];
		$FILEprice_list	= $_FILES['FILEprice_list']['name'];
		$FILEnot_comp	= $_FILES['FILEnot_comp']['name'];
		$FILEcer_or		= $_FILES['FILEcer_or']['name'];
		$FILEdespa		= $_FILES['FILEdespa']['name'];
		$FILEpol_seg	= $_FILES['FILEpol_seg']['name'];
				
		if(strlen($FILEdjai)==0){$FILEdjai = "";}
		if(strlen($FILEmed_cau)==0){$FILEmed_cau = "";}
		if(strlen($FILEseg_cau)==0){$FILEseg_cau = "";}
		if(strlen($FILEoficio)==0){$FILEoficio = "";}
		if(strlen($RDOVentaja)==0){$RDOVentaja = "";}
		if(strlen($FILEpack_list)==0){$FILEpack_list = "";}
		if(strlen($FILEexp_decla)==0){$FILEexp_decla = "";}
		if(strlen($FILEprice_list)==0){$FILEprice_list = "";}
		if(strlen($FILEnot_comp)==0){$FILEnot_comp = "";}
		if(strlen($FILEcer_or)==0){$FILEcer_or = "";}
		if(strlen($FILEdespa)==0){$FILEdespa = "";}
		if(strlen($FILEpol_seg)==0){$FILEpol_seg = "";}
		

		
		if($Xtodo_ok==true){
				
			$db2  = conecto(); //  guardo los datos en la base correspondiente  ///////////////
			$sql2 = " INSERT INTO amparos (cod_ord,	cod_amp, djai, med_cau,	seg_cau, oficio, ventaja, packing_list, exp_decla, price_list, not_comp, cer_ori, desp, pol_seg) VALUES ('".$cod."','".$cod_amp."','".$FILEdjai."','".$FILEmed_cau."','".$FILEseg_cau."','".$FILEoficio."','".$RDOVentaja."','".$FILEpack_list."','".$FILEexp_decla."','".$FILEprice_list."','".$FILEnot_comp."','".$FILEcer_or."','".$FILEdespa."','".$FILEpol_seg."') ";
				
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
				
//########################### ARCHIVO  ############################### 
			$FILEFILEdjai	= $_FILES['FILEdjai']['name'];
			$tmp_FILEdjai 	= $_FILES['FILEdjai']['tmp_name'];
			$errorFILEdjai 	= $_FILES['FILEdjai']['error'];
			suboarchivos($estructura,$FILEdjai,$tmp_FILEdjai,$errorFILEdjai,$cod); 

			$FILEmed_cau		= $_FILES['FILEmed_cau']['name'];
			$tmp_FILEmed_cau	= $_FILES['FILEmed_cau']['tmp_name'];
			$errorFILEmed_cau 	= $_FILES['FILEmed_cau']['error'];
			suboarchivos($estructura,$FILEmed_cau,$tmp_FILEmed_cau,$errorFILEmed_caus,$cod); 
			
			$FILEseg_cau		= $_FILES['FILEseg_cau']['name'];
			$tmp_FILEseg_cau 	= $_FILES['FILEseg_cau']['tmp_name'];
			$errorFILEseg_cau 	= $_FILES['FILEseg_cau']['error'];
			suboarchivos($estructura,$FILEseg_cau,$tmp_FILEseg_cau,$errorFILEseg_cau,$cod); 
			
			$FILEoficio			= $_FILES['FILEoficio']['name'];
			$tmp_FILEoficio 	= $_FILES['FILEoficio']['tmp_name'];
			$errorFILEoficio	= $_FILES['FILEoficio']['error'];
			suboarchivos($estructura,$FILEoficio,$tmp_FILEoficio,$errorFILEoficio,$cod); 
			
			$FILEpack_list		= $_FILES['FILEpack_list']['name'];
			$tmp_FILEpack_list 	= $_FILES['FILEpack_list']['tmp_name'];
			$errorFILEpack_list = $_FILES['FILEpack_list']['error'];
			suboarchivos($estructura,$FILEpack_list,$tmp_FILEpack_list,$errorFILEpack_list,$cod); 
									
			$FILEexp_decla		= $_FILES['FILEexp_decla']['name'];
			$tmp_FILEexp_decla 	= $_FILES['FILEexp_decla']['tmp_name'];
			$errorFILEexp_decla = $_FILES['FILEexp_decla']['error'];
			suboarchivos($estructura,$FILEexp_decla,$tmp_FILEexp_decla,$errorFILEexp_decla,$cod); 
										
			$FILEprice_list			= $_FILES['FILEprice_list']['name'];
			$tmp_FILEprice_list 	= $_FILES['FILEprice_list']['tmp_name'];
			$errorFILEprice_list 	= $_FILES['FILEprice_list']['error'];
			suboarchivos($estructura,$FILEprice_list,$tmp_FILEprice_list,$errorFILEprice_list,$cod); 
											
			$FILEnot_comp		= $_FILES['FILEnot_comp']['name'];
			$tmp_FILEnot_comp 	= $_FILES['FILEnot_comp']['tmp_name'];
			$errorFILEnot_comp 	= $_FILES['FILEnot_comp']['error'];
			suboarchivos($estructura,$FILEnot_comp,$tmp_FILEnot_comp,$errorFILEnot_comp,$cod); 
												
			$FILEcer_or			= $_FILES['FILEcer_or']['name'];
			$tmp_FILEcer_or 	= $_FILES['FILEcer_or']['tmp_name'];
			$errorFILEcer_or	= $_FILES['FILEcer_or']['error'];
			suboarchivos($estructura,$FILEcer_or,$tmp_FILEcer_or,$errorFILEcer_or,$cod); 
													
			$FILEdespa		= $_FILES['FILEdespa']['name'];
			$tmp_FILEdespa 	= $_FILES['FILEdespa']['tmp_name'];
			$errorFILEdespa = $_FILES['FILEdespa']['error'];
			suboarchivos($estructura,$FILEdespa,$tmp_FILEdespa,$errorFILEdespa,$cod); 
														
			$FILEpol_seg		= $_FILES['FILEpol_seg']['name'];
			$tmp_FILEpol_seg 	= $_FILES['FILEpol_seg']['tmp_name'];
			$errorFILEpol_seg 	= $_FILES['FILEpol_seg']['error'];
			suboarchivos($estructura,$FILEpol_seg,$tmp_FILEpol_seg,$errorFILEpol_seg,$cod); 
							
			}else{//Si la carpeta existe, tiro solo los datos dentro.

				$FILEFILEdjai	= $_FILES['FILEdjai']['name'];
				$tmp_FILEdjai 	= $_FILES['FILEdjai']['tmp_name'];
				$errorFILEdjai 	= $_FILES['FILEdjai']['error'];
				suboarchivos($estructura,$FILEdjai,$tmp_FILEdjai,$errorFILEdjai,$cod); 

				$FILEmed_cau		= $_FILES['FILEmed_cau']['name'];
				$tmp_FILEmed_cau 	= $_FILES['FILEmed_cau']['tmp_name'];
				$errorFILEmed_cau 	= $_FILES['FILEmed_cau']['error'];
				suboarchivos($estructura,$FILEmed_cau,$tmp_FILEmed_cau,$errorFILEmed_caus,$cod); 
			
				$FILEseg_cau		= $_FILES['FILEseg_cau']['name'];
				$tmp_FILEseg_cau 	= $_FILES['FILEseg_cau']['tmp_name'];
				$errorFILEseg_cau 	= $_FILES['FILEseg_cau']['error'];
				suboarchivos($estructura,$FILEseg_cau,$tmp_FILEseg_cau,$errorFILEseg_cau,$cod); 
			
				$FILEoficio			= $_FILES['FILEoficio']['name'];
				$tmp_FILEoficio 	= $_FILES['FILEoficio']['tmp_name'];
				$errorFILEoficio 	= $_FILES['FILEoficio']['error'];
				suboarchivos($estructura,$FILEoficio,$tmp_FILEoficio,$errorFILEoficio,$cod); 
			
				$FILEpack_list	= $_FILES['FILEpack_list']['name'];
				$tmp_FILEpack_list = $_FILES['FILEpack_list']['tmp_name'];
				$errorFILEpack_list = $_FILES['FILEpack_list']['error'];
				suboarchivos($estructura,$FILEpack_list,$tmp_FILEpack_list,$errorFILEpack_list,$cod); 
									
				$FILEexp_decla	= $_FILES['FILEexp_decla']['name'];
				$tmp_FILEexp_decla = $_FILES['FILEexp_decla']['tmp_name'];
				$errorFILEexp_decla = $_FILES['FILEexp_decla']['error'];
				suboarchivos($estructura,$FILEexp_decla,$tmp_FILEexp_decla,$errorFILEexp_decla,$cod); 
										
				$FILEprice_list	= $_FILES['FILEprice_list']['name'];
				$tmp_FILEprice_list = $_FILES['FILEprice_list']['tmp_name'];
				$errorFILEprice_list = $_FILES['FILEprice_list']['error'];
				suboarchivos($estructura,$FILEprice_list,$tmp_FILEprice_list,$errorFILEprice_list,$cod); 
											
				$FILEnot_comp	= $_FILES['FILEnot_comp']['name'];
				$tmp_FILEnot_comp = $_FILES['FILEnot_comp']['tmp_name'];
				$errorFILEnot_comp = $_FILES['FILEnot_comp']['error'];
				suboarchivos($estructura,$FILEnot_comp,$tmp_FILEnot_comp,$errorFILEnot_comp,$cod); 
												
				$FILEcer_or	= $_FILES['FILEcer_or']['name'];
				$tmp_FILEcer_or = $_FILES['FILEcer_or']['tmp_name'];
				$errorFILEcer_or = $_FILES['FILEcer_or']['error'];
				suboarchivos($estructura,$FILEcer_or,$tmp_FILEcer_or,$errorFILEcer_or,$cod); 
													
				$FILEdespa	= $_FILES['FILEdespa']['name'];
				$tmp_FILEdespa = $_FILES['FILEdespa']['tmp_name'];
				$errorFILEdespa = $_FILES['FILEdespa']['error'];
				suboarchivos($estructura,$FILEdespa,$tmp_FILEdespa,$errorFILEdespa,$cod); 
														
				$FILEpol_seg	= $_FILES['FILEpol_seg']['name'];
				$tmp_FILEpol_seg = $_FILES['FILEpol_seg']['tmp_name'];
				$errorFILEpol_seg = $_FILES['FILEpol_seg']['error'];
				suboarchivos($estructura,$FILEpol_seg,$tmp_FILEpol_seg,$errorFILEpol_seg,$cod); 
								
				 }//FIN si salio todo genial				

		echo "<script language='javascript'>
				 alert('El Registro a sido Creado');
				window.location.href='../veoordenes.php?cod=$cod'; </script>"; 	
		}
	}// FIN ALTA 
	
	

	if($_POST['BTNMOD']){
		
		$Xtodo_ok 		= true;
		$Xerror_num 	= "";
		
		$FILEdjai		= "";
		$FILEmed_cau	= "";
		$FILEseg_cau	= "";
		$FILEoficio		= "";
		$RDOVentaja		= "";
		$FILEpack_list	= "";
		$FILEexp_decla	= "";
		$FILEprice_list	= "";
		$FILEnot_comp	= "";
		$FILEcer_or		= "";
		$FILEdespa		= "";
		$FILEpol_seg	= "";
		
		$djai		= "";
		$med_cau	= "";
		$seg_cau	= "";
		$oficio		= "";
		$ventaja	= "";
		$pack_list	= "";
		$exp_decla	= "";
		$price_list	= "";
		$not_comp	= "";
		$cer_or		= "";
		$despa		= "";
		$pol_seg	= "";

		$FILEdjai		= $_FILES['FILEdjai']['name'];
		$FILEmed_cau	= $_FILES['FILEmed_cau']['name'];
		$FILEseg_cau	= $_FILES['FILEseg_cau']['name'];
		$FILEoficio		= $_FILES['FILEoficio']['name'];
		$RDOVentaja		= trim($_POST['RDOVentaja']);
		$FILEpack_list	= $_FILES['FILEpack_list']['name'];
		$FILEexp_decla	= $_FILES['FILEexp_decla']['name'];
		$FILEprice_list	= $_FILES['FILEprice_list']['name'];
		$FILEnot_comp	= $_FILES['FILEnot_comp']['name'];
		$FILEcer_or		= $_FILES['FILEcer_or']['name'];
		$FILEdespa		= $_FILES['FILEdespa']['name'];
		$FILEpol_seg	= $_FILES['FILEpol_seg']['name'];
		
		$djai		= $_POST['djai'];
		$med_cau	= $_POST['med_cau'];
		$seg_cau	= $_POST['seg_cau'];
		$oficio		= $_POST['oficio'];
		$ventaja	= $_POST['ventaja'];
		$pack_list	= $_POST['pack_list'];
		$exp_decla	= $_POST['exp_decla'];
		$price_list	= $_POST['price_list'];
		$not_comp	= $_POST['not_comp'];
		$cer_or		= $_POST['cer_or'];
		$despa		= $_POST['despa'];
		$pol_seg	= $_POST['pol_seg'];
				
		if(strlen($FILEdjai)==0){$FILEdjai = "";}
		if(strlen($FILEmed_cau)==0){$FILEmed_cau = "";}
		if(strlen($FILEseg_cau)==0){$FILEseg_cau = "";}
		if(strlen($FILEoficio)==0){$FILEoficio = "";}
		if(strlen($FILEventaja)==0){$FILEventaja = "";}
		if(strlen($FILEpack_list)==0){$FILEpack_list = "";}
		if(strlen($FILEexp_decla)==0){$FILEexp_decla = "";}
		if(strlen($FILEprice_list)==0){$FILEprice_list = "";}
		if(strlen($FILEnot_comp)==0){$FILEnot_comp = "";}
		if(strlen($FILEcer_or)==0){$FILEcer_or = "";}
		if(strlen($FILEdespa)==0){$FILEdespa = "";}
		if(strlen($FILEpol_seg)==0){$FILEpol_seg = "";}
		
		if(strlen($djai)==0){$djai = "";}
		if(strlen($med_cau)==0){$med_cau = "";}
		if(strlen($seg_cau)==0){$seg_cau = "";}
		if(strlen($oficio)==0){$oficio = "";}
		if(strlen($ventaja)==0){$ventaja = "";}
		if(strlen($pack_list)==0){$pack_list = "";}
		if(strlen($exp_decla)==0){$exp_decla = "";}
		if(strlen($price_list)==0){$price_list = "";}
		if(strlen($not_comp)==0){$not_comp = "";}
		if(strlen($cer_or)==0){$cer_or = "";}
		if(strlen($despa)==0){$despa = "";}
		if(strlen($pol_seg)==0){$pol_seg = "";}

//-----------------------------------------	
		$D = "";
		if(strlen($FILEdjai)!=0){
			$D =	$FILEdjai;
		}
		
		if(strlen($djai)!=0){
			$D =	$djai;
		}
//-----------------------------------------			
		$MC = "";
		if(strlen($FILEmed_cau)!=0){
			$MC =	$FILEmed_cau;
		}
		
		if(strlen($med_cau)!=0){
			$MC =	$med_cau;
		}
//-----------------------------------------		
		$SC	= "";
		if(strlen($FILEseg_cau)!=0){
			$SC =	$FILEseg_cau;
		}
		
		if(strlen($seg_cau)!=0){
			$SC =	$seg_cau;
		}		
//-----------------------------------------			
		$O = "";
		if(strlen($FILEoficio)!=0){
			$O =	$FILEoficio;
		}
		
		if(strlen($oficio)!=0){
			$O =	$oficio;
		}		
//-----------------------------------------		
		/*
		$V = "";
		if(strlen($FILEventaja)!=0){
			$V = $FILEventaja;
		}
		
		if(strlen($ventaja)!=0){
			$V = $ventaja;
		}*/
//-----------------------------------------			
		
		$PL = "";
		if(strlen($FILEpack_list)!=0){
				$PL =	$FILEpack_list;
				}
		
		if(strlen($pack_list)!=0){
				 $PL =	$pack_list;
				}
//-----------------------------------------			
				$ED		 ="";
		if(strlen($FILEexp_decla)!=0){
				 $ED =	$FILEexp_decla;
				}
		
		if(strlen($exp_decla)!=0){
				 $ED =	$exp_decla;
				}
//-----------------------------------------			
				$NC		 ="";
		if(strlen($FILEprice_list)!=0){
				 $NC =	$FILEprice_list;
				}
		
		if(strlen($price_list)!=0){
				 $NC =	$price_list;
				}
//-----------------------------------------			
				$NDC		 ="";
		if(strlen($FILEnot_comp)!=0){
				 $NDC =	$FILEnot_comp;
				}
		
		if(strlen($not_comp)!=0){
				 $NDC =	$not_comp;
				}
//-----------------------------------------			
				$CO		 ="";
		if(strlen($FILEcer_or)!=0){
				 $CO =	$FILEcer_or;
				}
		
		if(strlen($cer_or)!=0){
				 $CO =	$cer_or;
				}
//-----------------------------------------			
				$DES		 ="";
		if(strlen($FILEdespa)!=0){
				 $DES =	$FILEdespa;
				}
		
		if(strlen($despa)!=0){
				 $DES =	$despa;
				}
//-----------------------------------------			
				$PS		 ="";
		if(strlen($FILEpol_seg)!=0){
				 $PS =	$FILEpol_seg;
				}
		
		if(strlen($pol_seg)!=0){
				 $PS =	$pol_seg;
				}
//-----------------------------------------			
		
		

		if(strlen($Xerror_num)!=0){
			$Xerror_num.= " DEBE/DEBEN SER NUMERICO/NUMERICOS ";
		}	
		
		if($Xtodo_ok==true){

		$db3  = conecto();
		$sql3 = " update amparos set 
				djai  = '".$D."',
				med_cau  = '".$MC."',
				seg_cau  = '".$SC."',
				oficio  = '".$O."',
				ventaja  = '".$RDOVentaja."',
				packing_list  = '".$PL."',
				exp_decla  = '".$ED."',
				price_list  = '".$NC."',
				not_comp  = '".$NDC."',
				cer_ori  = '".$CO."',
				desp  = '".$DES."',
				pol_seg  = '".$PS."' 
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
				
//########################### ARCHIVO  ############################### 
			$FILEFILEdjai	= $_FILES['FILEdjai']['name'];
			$tmp_FILEdjai 	= $_FILES['FILEdjai']['tmp_name'];
			$errorFILEdjai 	= $_FILES['FILEdjai']['error'];
			suboarchivos($estructura,$FILEdjai,$tmp_FILEdjai,$errorFILEdjai,$cod); 

			$FILEmed_cau		= $_FILES['FILEmed_cau']['name'];
			$tmp_FILEmed_cau 	= $_FILES['FILEmed_cau']['tmp_name'];
			$errorFILEmed_cau 	= $_FILES['FILEmed_cau']['error'];
			suboarchivos($estructura,$FILEmed_cau,$tmp_FILEmed_cau,$errorFILEmed_caus,$cod); 
			
			$FILEseg_cau		= $_FILES['FILEseg_cau']['name'];
			$tmp_FILEseg_cau 	= $_FILES['FILEseg_cau']['tmp_name'];
			$errorFILEseg_cau 	= $_FILES['FILEseg_cau']['error'];
			suboarchivos($estructura,$FILEseg_cau,$tmp_FILEseg_cau,$errorFILEseg_cau,$cod); 
			
			$FILEoficio	= $_FILES['FILEoficio']['name'];
			$tmp_FILEoficio = $_FILES['FILEoficio']['tmp_name'];
			$errorFILEoficio = $_FILES['FILEoficio']['error'];
			suboarchivos($estructura,$FILEoficio,$tmp_FILEoficio,$errorFILEoficio,$cod); 
			
								$FILEpack_list	= $_FILES['FILEpack_list']['name'];
								$tmp_FILEpack_list = $_FILES['FILEpack_list']['tmp_name'];
								$errorFILEpack_list = $_FILES['FILEpack_list']['error'];
								suboarchivos($estructura,$FILEpack_list,$tmp_FILEpack_list,$errorFILEpack_list,$cod); 
									
									$FILEexp_decla	= $_FILES['FILEexp_decla']['name'];
									$tmp_FILEexp_decla = $_FILES['FILEexp_decla']['tmp_name'];
									$errorFILEexp_decla = $_FILES['FILEexp_decla']['error'];
									suboarchivos($estructura,$FILEexp_decla,$tmp_FILEexp_decla,$errorFILEexp_decla,$cod); 
										
										$FILEprice_list	= $_FILES['FILEprice_list']['name'];
										$tmp_FILEprice_list = $_FILES['FILEprice_list']['tmp_name'];
										$errorFILEprice_list = $_FILES['FILEprice_list']['error'];
										suboarchivos($estructura,$FILEprice_list,$tmp_FILEprice_list,$errorFILEprice_list,$cod); 
											
											$FILEnot_comp	= $_FILES['FILEnot_comp']['name'];
											$tmp_FILEnot_comp = $_FILES['FILEnot_comp']['tmp_name'];
											$errorFILEnot_comp = $_FILES['FILEnot_comp']['error'];
											suboarchivos($estructura,$FILEnot_comp,$tmp_FILEnot_comp,$errorFILEnot_comp,$cod); 
												
												$FILEcer_or	= $_FILES['FILEcer_or']['name'];
												$tmp_FILEcer_or = $_FILES['FILEcer_or']['tmp_name'];
												$errorFILEcer_or = $_FILES['FILEcer_or']['error'];
												suboarchivos($estructura,$FILEcer_or,$tmp_FILEcer_or,$errorFILEcer_or,$cod); 
													
													$FILEdespa	= $_FILES['FILEdespa']['name'];
													$tmp_FILEdespa = $_FILES['FILEdespa']['tmp_name'];
													$errorFILEdespa = $_FILES['FILEdespa']['error'];
													suboarchivos($estructura,$FILEdespa,$tmp_FILEdespa,$errorFILEdespa,$cod); 
														
														$FILEpol_seg	= $_FILES['FILEpol_seg']['name'];
														$tmp_FILEpol_seg = $_FILES['FILEpol_seg']['tmp_name'];
														$errorFILEpol_seg = $_FILES['FILEpol_seg']['error'];
														suboarchivos($estructura,$FILEpol_seg,$tmp_FILEpol_seg,$errorFILEpol_seg,$cod); 		
		
 			}else{//Si la carpeta existe, tiro solo los datos dentro.

			$FILEFILEdjai	= $_FILES['FILEdjai']['name'];
			$tmp_FILEdjai = $_FILES['FILEdjai']['tmp_name'];
			$errorFILEdjai = $_FILES['FILEdjai']['error'];
			suboarchivos($estructura,$FILEdjai,$tmp_FILEdjai,$errorFILEdjai,$cod); 

				$FILEmed_cau	= $_FILES['FILEmed_cau']['name'];
				$tmp_FILEmed_cau = $_FILES['FILEmed_cau']['tmp_name'];
				$errorFILEmed_cau = $_FILES['FILEmed_cau']['error'];
				suboarchivos($estructura,$FILEmed_cau,$tmp_FILEmed_cau,$errorFILEmed_caus,$cod); 
			
					$FILEseg_cau	= $_FILES['FILEseg_cau']['name'];
					$tmp_FILEseg_cau = $_FILES['FILEseg_cau']['tmp_name'];
					$errorFILEseg_cau = $_FILES['FILEseg_cau']['error'];
					suboarchivos($estructura,$FILEseg_cau,$tmp_FILEseg_cau,$errorFILEseg_cau,$cod); 
			
						$FILEoficio	= $_FILES['FILEoficio']['name'];
						$tmp_FILEoficio = $_FILES['FILEoficio']['tmp_name'];
						$errorFILEoficio = $_FILES['FILEoficio']['error'];
						suboarchivos($estructura,$FILEoficio,$tmp_FILEoficio,$errorFILEoficio,$cod); 
			
								$FILEpack_list	= $_FILES['FILEpack_list']['name'];
								$tmp_FILEpack_list = $_FILES['FILEpack_list']['tmp_name'];
								$errorFILEpack_list = $_FILES['FILEpack_list']['error'];
								suboarchivos($estructura,$FILEpack_list,$tmp_FILEpack_list,$errorFILEpack_list,$cod); 
									
									$FILEexp_decla	= $_FILES['FILEexp_decla']['name'];
									$tmp_FILEexp_decla = $_FILES['FILEexp_decla']['tmp_name'];
									$errorFILEexp_decla = $_FILES['FILEexp_decla']['error'];
									suboarchivos($estructura,$FILEexp_decla,$tmp_FILEexp_decla,$errorFILEexp_decla,$cod); 
										
										$FILEprice_list	= $_FILES['FILEprice_list']['name'];
										$tmp_FILEprice_list = $_FILES['FILEprice_list']['tmp_name'];
										$errorFILEprice_list = $_FILES['FILEprice_list']['error'];
										suboarchivos($estructura,$FILEprice_list,$tmp_FILEprice_list,$errorFILEprice_list,$cod); 
											
											$FILEnot_comp	= $_FILES['FILEnot_comp']['name'];
											$tmp_FILEnot_comp = $_FILES['FILEnot_comp']['tmp_name'];
											$errorFILEnot_comp = $_FILES['FILEnot_comp']['error'];
											suboarchivos($estructura,$FILEnot_comp,$tmp_FILEnot_comp,$errorFILEnot_comp,$cod); 
												
												$FILEcer_or	= $_FILES['FILEcer_or']['name'];
												$tmp_FILEcer_or = $_FILES['FILEcer_or']['tmp_name'];
												$errorFILEcer_or = $_FILES['FILEcer_or']['error'];
												suboarchivos($estructura,$FILEcer_or,$tmp_FILEcer_or,$errorFILEcer_or,$cod); 
													
													$FILEdespa	= $_FILES['FILEdespa']['name'];
													$tmp_FILEdespa = $_FILES['FILEdespa']['tmp_name'];
													$errorFILEdespa = $_FILES['FILEdespa']['error'];
													suboarchivos($estructura,$FILEdespa,$tmp_FILEdespa,$errorFILEdespa,$cod); 
														
														$FILEpol_seg	= $_FILES['FILEpol_seg']['name'];
														$tmp_FILEpol_seg = $_FILES['FILEpol_seg']['tmp_name'];
														$errorFILEpol_seg = $_FILES['FILEpol_seg']['error'];
														suboarchivos($estructura,$FILEpol_seg,$tmp_FILEpol_seg,$errorFILEpol_seg,$cod); 
								
				 }//FIN si salio todo genial

		echo "<script language='javascript'>
				 alert('El Registro a sido Modificado');
				window.location.href='../veoordenes.php?cod=$cod'; </script>"; 	
	}
}
	
	if($_POST['BTNELI']){

		$db4  = conecto();
		$sql4 = " delete from amparos where cod_ord = ".$cod." ";
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
		$sql1 = "select * from amparos where cod_ord = ".$cod." ";
		$r1   = mysqli_query($db1, $sql1);
	
		if ($r1 == false){
	    	mysqli_close($db1);
	        $error = "Error: (" . mysql_errno() . ") " . mysql_error().")";
	        //gestion_errores();
	    }
	    	mysqli_close($db1);
			
		while ($arr1 = mysqli_fetch_array($r1))		
		{
			$RDOIP 			= trim($arr1['insp_pic']);
			$FILEdjai		= trim($arr1['djai']);
			$FILEmed_cau	= trim($arr1['med_cau']);
			$FILEseg_cau	= trim($arr1['seg_cau']);
			$FILEoficio		= trim($arr1['oficio']);
			$RDOVentaja		= trim($arr1['ventaja']);
			$FILEpack_list	= trim($arr1['packing_list']);
			$FILEexp_decla	= trim($arr1['exp_decla']);
			$FILEprice_list	= trim($arr1['price_list']);
			$FILEnot_comp	= trim($arr1['not_comp']);
			$FILEcer_or		= trim($arr1['cer_ori']);
			$FILEdespa		= trim($arr1['desp']);
			$FILEpol_seg	= trim($arr1['pol_seg']);
		}				
				
		if(strlen($RDOIP)==0){$RDOIP = "";}
		if(strlen($FILEdjai)==0){$FILEdjai = "";}
		if(strlen($FILEmed_cau)==0){$FILEmed_cau = "";}
		if(strlen($FILEseg_cau)==0){$FILEseg_cau = "";}
		if(strlen($FILEoficio)==0){$FILEoficio = "";}
		if(strlen($RDOVentaja)==0){$RDOVentaja = "";}
		if(strlen($FILEpack_list)==0){$FILEpack_list = "";}
		if(strlen($FILEexp_decla)==0){$FILEexp_decla = "";}
		if(strlen($FILEprice_list)==0){$FILEprice_list = "";}
		if(strlen($FILEnot_comp)==0){$FILEnot_comp = "";}
		if(strlen($FILEcer_or)==0){$FILEcer_or = "";}
		if(strlen($FILEdespa)==0){$FILEdespa = "";}
		if(strlen($FILEpol_seg)==0){$FILEpol_seg = "";}
		

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
	            <th colspan="6" align="center"><div align="center">DOCUMENTOS</div></th>
	            </tr>
	          </thead>
	        <tbody>
	          <tr>
	            <td colspan="6"><?php echo '<div align="center" style="color:red; font-weight: bold;">'.$Xerror." ".$Xerror_num.'</div>'; ?></td>
              </tr>
	          <tr>
	            <td colspan="6"><div align="center"><span style="color: #000"><strong>DETALLE</strong></span></div></td>
	            </tr>
	          <tr>
	            <td><strong>DJAI:</strong></td>
	            <td colspan="2"><div align="left"><span style="color: #000">
	              <?php if(strlen($FILEdjai)!=0){?>	  	
	              <b>Nombre del archivo:</b>
	              <input type="text" value="<?php echo $FILEdjai; ?>" name="djai" id="djai"  class="button">
	              <?php } else { ?>
	              <input name="FILEdjai" type="file" id="FILEdjai" title="SELECCIONE.." class="button" style="width: 75%">
	              </span></div></td>
				 <?php } ?>
				 </td>
	            	<td><div align="right">
	            	  <?php 	
							if(strlen($FILEdjai)!=0){?>
	            	  <a href="<?php echo 'amparos.php?accion=MOD&cod='.$cod.'&DEL=D'; ?>">
	            	    <button class="button" type="button">Eliminar</button>
            	      </a>     
	            	  <?php }?>
            	    </div></td>
              </tr>
	          <tr>
	            <td><strong>MEDIDA CAUTELAR:</strong></td>
	            <td colspan="2"><div align="left"><span style="color: #000">
	              <?php if(strlen($FILEmed_cau)!=0){?>	  	
	              <b>Nombre del archivo:</b>
	              <input type="text" value="<?php echo $FILEmed_cau; ?>" name="med_cau" id="med_cau"  class="button">
	              <?php } else { ?>
	              <input name="FILEmed_cau" type="file" id="FILEmed_cau" title="SELECCIONE.." class="button" style="width: 75%">
	              </span></div></td>
				 <?php } ?></td>
	            	<td><div align="right">
	            	  <?php 	
							if(strlen($FILEmed_cau)!=0){?>
	            	  <a href="<?php echo 'amparos.php?accion=MOD&cod='.$cod.'&DEL=MC'; ?>">
	            	    <button class="button" type="button">Eliminar</button>
            	      </a>     
	            	  <?php }?>
	            	  </div>
            	</tr>
	          <tr>
	            <td><strong>SEGURO DE CAUCION:</strong></td>
	            <td colspan="2"><div align="left"><span style="color: #000">
                 <?php if(strlen($FILEseg_cau)!=0){?>	  	
	              <b>Nombre del archivo:</b>
	              <input type="text" value="<?php echo $FILEseg_cau; ?>" name="seg_cau" id="seg_cau"  class="button">
	              <?php } else { ?>
	              <input name="FILEseg_cau" type="file" id="FILEseg_cau" title="SELECCIONE.." class="button" style="width: 75%">
	              </span></div></td>
				 <?php } ?></td>
	            	<td><div align="right">
	            	  <?php 	
							if(strlen($FILEseg_cau)!=0){?>
	            	  <a href="<?php echo 'amparos.php?accion=MOD&cod='.$cod.'&DEL=SC'; ?>">
	            	    <button class="button" type="button">Eliminar</button>
            	      </a>     
	            	  <?php }?>
	            	  </div>
           	  </tr>
	          <tr>
	            <td><strong>OFICIO:</strong></td>
	            <td colspan="2"><div align="left"><span style="color: #000">
	              <?php if(strlen($FILEoficio)!=0){?>	  	
	              <b>Nombre del archivo:</b>
	              <input type="text" value="<?php echo $FILEoficio; ?>" name="oficio" id="oficio"  class="button">
	              <?php } else { ?>
	              <input name="FILEoficio" type="file" id="FILEoficio" title="SELECCIONE.." class="button" style="width: 75%">
	              </span></div></td>
				 <?php } ?></td>
	            	<td><div align="right">
	            	  <?php 	
							if(strlen($FILEoficio)!=0){?>
	            	  <a href="<?php echo 'amparos.php?accion=MOD&cod='.$cod.'&DEL=O'; ?>">
	            	    <button class="button" type="button">Eliminar</button>
            	      </a>     
	            	  <?php }?>
	            	  </div>
           	  </tr>
	          <tr>
	            <td><strong>VENTAJA:</strong></td>
	            <td colspan="2"><strong>SI
                    <input name="RDOVentaja" type="radio" class="button" id="RDOVentaja" value="SI" <?php if($RDOVentaja=="S"){ echo 'checked';}?>>
                </strong><strong> NO
                <input name="RDOVentaja" type="radio" class="button" id="RDOVentaja" value="NO" <?php if($RDOVentaja=="N"){ echo 'checked';}?>>
                </strong></td>
				<td>&nbsp;</td>
                <td>&nbsp;</td>
	          </tr>
	          <tr>
	            <td><strong>PACKING LIST:</strong></td>
	            <td colspan="2"><div align="left"><span style="color: #000">
	              <?php if(strlen($FILEpack_list)!=0){?>	  	
	              <b>Nombre del archivo:</b>
	              <input type="text" value="<?php echo $FILEpack_list; ?>" name="pack_list" id="pack_list"  class="button">
	              <?php } else { ?>
	              <input name="FILEpack_list" type="file" id="FILEpack_list" title="SELECCIONE.." class="button" style="width: 75%">
	              </span></div></td>
				 <?php } ?></td>
	            	<td><div align="right">
	            	  <?php 	
							if(strlen($FILEpack_list)!=0){?>
	            	  <a href="<?php echo 'amparos.php?accion=MOD&cod='.$cod.'&DEL=PL'; ?>">
	            	    <button class="button" type="button">Eliminar</button>
            	      </a>     
	            	  <?php }?>
	            	  </div>
           	  </tr>
	          <tr>
	            <td><strong>EXPORT DECLARATION:</strong></td>
	            <td colspan="2"><div align="left"><span style="color: #000">
	              <?php if(strlen($FILEexp_decla)!=0){?>	  	
	              <b>Nombre del archivo:</b>
	              <input type="text" value="<?php echo $FILEexp_decla; ?>" name="exp_decla" id="exp_decla"  class="button">
	              <?php } else { ?>
	              <input name="FILEexp_decla" type="file" id="FILEexp_decla" title="SELECCIONE.." class="button" style="width: 75%">
	              </span></div></td>
				 <?php } ?></td>
	            	<td><div align="right">
	            	  <?php 	
							if(strlen($FILEexp_decla)!=0){?>
	            	  <a href="<?php echo 'amparos.php?accion=MOD&cod='.$cod.'&DEL=ED'; ?>">
	            	    <button class="button" type="button">Eliminar</button>
            	      </a>     
	            	  <?php }?>
	            	  </div>
           	  </tr>
	          <tr>
	            <td><strong>PRICE LIST:</strong></td>
	            <td colspan="2"><div align="left"><span style="color: #000">
	              <?php if(strlen($FILEprice_list)!=0){?>	  	
	              <b>Nombre del archivo:</b>
	              <input type="text" value="<?php echo $FILEprice_list; ?>" name="price_list" id="price_list"  class="button">
	              <?php } else { ?>
	              <input name="FILEprice_list" type="file" id="FILEprice_list" title="SELECCIONE.." class="button" style="width: 75%">
	              </span></div></td>
				 <?php } ?></td>
	            	<td><div align="right">
	            	  <?php 	
							if(strlen($FILEprice_list)!=0){?>
	            	  <a href="<?php echo 'amparos.php?accion=MOD&cod='.$cod.'&DEL=NC'; ?>">
	            	    <button class="button" type="button">Eliminar</button>
            	      </a>     
	            	  <?php }?>
	            	  </div>
	            	</tr>
	          <tr>
	            <td><strong>NOTA DE COMPOSICION:</strong></td>
	            <td colspan="2"><div align="left"><span style="color: #000">
	              <?php if(strlen($FILEnot_comp)!=0){?>	  	
	              <b>Nombre del archivo:</b>
	              <input type="text" value="<?php echo $FILEnot_comp; ?>" name="not_comp" id="not_comp"  class="button">
	              <?php } else { ?>
	              <input name="FILEnot_comp" type="file" id="FILEnot_comp" title="SELECCIONE.." class="button" style="width: 75%">
	              </span></div></td>
				 <?php } ?></td>
	            	<td><div align="right">
	            	  <?php 	
							if(strlen($FILEnot_comp)!=0){?>
	            	  <a href="<?php echo 'amparos.php?accion=MOD&cod='.$cod.'&DEL=NDC'; ?>">
	            	    <button class="button" type="button">Eliminar</button>
            	      </a>     
	            	  <?php }?>
	            	  </div>
           	  </tr>
	          <tr>
	            <td><strong>CERTIFICADO DE ORIGEN:</strong></td>
	            <td colspan="2"><div align="left"><span style="color: #000">
	              <?php if(strlen($FILEcer_or)!=0){?>	  	
	              <b>Nombre del archivo:</b>
	              <input type="text" value="<?php echo $FILEcer_or; ?>" name="cer_or" id="cer_or"  class="button">
	              <?php } else { ?>
	              <input name="FILEcer_or" type="file" id="FILEcer_or" title="SELECCIONE.." class="button" style="width: 75%">
	              </span></div></td>
				 <?php } ?></td>
	            	<td><div align="right">
	            	  <?php 	
							if(strlen($FILEcer_or)!=0){?>
	            	  <a href="<?php echo 'amparos.php?accion=MOD&cod='.$cod.'&DEL=CO'; ?>">
	            	    <button class="button" type="button">Eliminar</button>
            	      </a>     
	            	  <?php }?>
	            	  </div>
           	  </tr>
	          <tr>
	            <td><strong>DESPACHO:</strong></td>
	            <td colspan="2"><div align="left"><span style="color: #000">
	              <?php if(strlen($FILEdespa)!=0){?>	  	
	              <b>Nombre del archivo:</b>
	              <input type="text" value="<?php echo $FILEdespa; ?>" name="despa" id="despa"  class="button">
	              <?php } else { ?>
	              <input name="FILEdespa" type="file" id="FILEdespa" title="SELECCIONE.." class="button" style="width: 75%">
	              </span></div></td>
				 <?php } ?></td>
	            	<td><div align="right">
	            	  <?php 	
							if(strlen($FILEdespa)!=0){?>
	            	  <a href="<?php echo 'amparos.php?accion=MOD&cod='.$cod.'&DEL=DES'; ?>">
	            	    <button class="button" type="button">Eliminar</button>
            	      </a>     
	            	  <?php }?>
	            	  </div>
           	  </tr>
	          <tr>
	            <td><strong>POLIZA DE SEGURO:</strong></td>
	            <td colspan="2"><div align="left"><span style="color: #000">
	              <?php if(strlen($FILEpol_seg)!=0){?>	  	
	              <b>Nombre del archivo:</b>
	              <input type="text" value="<?php echo $FILEpol_seg; ?>" name="pol_seg" id="pol_seg"  class="button">
	              <?php } else { ?>
	              <input name="FILEpol_seg" type="file" id="FILEpol_seg" title="SELECCIONE.." class="button" style="width: 75%">
	              </span></div></td>
				 <?php } ?></td>
	            	<td><div align="right">
	            	  <?php 	
							if(strlen($FILEpol_seg)!=0){?>
	            	  <a href="<?php echo 'amparos.php?accion=MOD&cod='.$cod.'&DEL=PS'; ?>">
	            	    <button class="button" type="button">Eliminar</button>
            	      </a>     
	            	  <?php }?>
	            	  </div>
           	  </tr>
	          <tr>
	            <td colspan="6">&nbsp;</td>
              </tr>
	          <tr>
	            <td colspan="6"><div align="center"><span style="color: #000">
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