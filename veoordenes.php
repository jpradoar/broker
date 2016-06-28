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
 
#------------------------------------> borrar un cheque
 $codche 	= $_GET['codche']; 	

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
#------------------------------------> Fin borrar un cheque
 		
if($_POST){//SEGUNDOS POST
	
	$cod = $_GET['cod'];

	#ALERTAS / ALARMAS
	$veo_AlarmaVCV = veoContatoVenta($cod);
		
	if($_POST['BTNcreaBHI']){//SE lo asigno a BHI
	
		$XtipoDeOrden = 'BHI';
		$db  = conecto();
		$sql = " update ordenes set destino  = '".$XtipoDeOrden."' where cod_ord = ".$cod." ";
		$r   = mysqli_query($db, $sql);
		if ($r == false){
			mysqli_close($db);
			$error = "Error: (" . mysql_errno() . ") " . mysql_error().")";
			//gestion_errores();
		}
		  mysqli_close($db);		
	}//FIN SE lo asigno a BHI
	
	if($_POST['BTNcreaBSD']){
		
		$XtipoDeOrden = 'BSD';
		$db  = conecto();
		$sql = " update ordenes set destino  = '".$XtipoDeOrden."' where cod_ord = ".$cod." ";
		$r   = mysqli_query($db, $sql);
	
		if ($r == false){
			mysqli_close($db);
			$error = "Error: (" . mysql_errno() . ") " . mysql_error().")";
			//gestion_errores();
		}
		  mysqli_close($db);			
	}	
	if($_POST['BTNcreaEMPRINCE']){
		
		$XtipoDeOrden = 'EMPRINCE';
		$db  = conecto();
		$sql = " update ordenes set destino  = '".$XtipoDeOrden."' where cod_ord = ".$cod." ";
		$r   = mysqli_query($db, $sql);
		if ($r == false){
			mysqli_close($db);
			$error = "Error: (" . mysql_errno() . ") " . mysql_error().")";
			//gestion_errores();
		}
		  mysqli_close($db);	
	}	
	
	$Xtodo_ok = true;
	$Xerror = "";
	
	//// RECIBO LA INFO ////
	
	$XLSTCliente = $_POST['LSTCliente'];

	//// CHEQUEO CUALES CONTIENEN DATOS ////
	if(strlen($XLSTCliente)==0){
		$Xtodo_ok = false;
		$Xerror	= "<script type='text/javascript'>alert('ERROR: DEBE SELECCIONAR UN CLIENTE')</script>";	
	}
	

	if(strlen($XLSTCliente)==0){
		$XLSTCliente = "";	
	}


	if($_POST['BTNvolver']){//volver al menu
 		header ('location:index.php');
		exit();		
	}	

	if($_POST['MODobserva']){//volver al menu
 		header ('location: abms/modobsord.php?cod='.$cod);
		exit();		
	}	
					
}
//else{//PRIMER POST

	$cod = $_GET['cod'];//Si vengo de una modificacion o eliminacion traigo los datos

	$acc = $_GET['acc'];//Si es eliminacion
	
	#ALERTAS / ALARMAS
	$veo_AlarmaVCV = veoContatoVenta($cod);
	
	#Doy formato
	if(strlen($acc)==0){ $acc = "";	}
	
	#Si elimino..
	if($acc=="ELI"){
	
		$db  = conecto();
		$sql = " update ordenes set estado_ord  = '0' where cod_ord = '".$cod."' ";
		$r   = mysqli_query($db, $sql);
		if ($r == false){
			mysqli_close($db);
			$error = "Error: (" . mysql_errno() . ") " . mysql_error().")";
			//gestion_errores();
		}
		  mysqli_close($db);

 		header ('location:index.php');
		exit();			  		
	}
	
	//Formateo todas las variables
	$Xerror		 	= "";
	$Xobserva_ord	= ""; 
	$XLstCliente 	= "";
	$Xfe_alt_ord	= "";	
	$Xcontrato_or	= "";
	$Xpi_or			= "";
	$Xpo_or			= "";
	$Xdestino		= "";	
	
	#---TRAIGO TODOS LOS DATOS
		#CABECERA - ORDENES
		$db0  = conecto();
		$sql0 = "select * from ordenes where cod_ord = ".$cod." ";
		$r0   = mysqli_query($db0, $sql0);
	
		if ($r0 == false){
	    	mysqli_close($db0);
	        $error = "Error: (" . mysql_errno() . ") " . mysql_error().")";
	        //gestion_errores();
	    }
	    	mysqli_close($db0);
			
		while ($arr0 = mysqli_fetch_array($r0))		
		{
			$XLSTCliente 		= trim($arr0['cod_cli']);
			$Xobserva_ord		= trim($arr0['observa_ord']); 
			$Xcod_presu_or		= trim($arr0['cod_presu_or']);
			$Xcontrato_or 		= trim($arr0['contrato_or']);
			$Xpi_or 			= trim($arr0['pi_or']);
			$Xpo_or 			= trim($arr0['po_or']);
			$Xfe_alt_ord		= trim($arr0['fe_alt_ord']);
			$Xdestino 			= trim($arr0['destino']);
			$num_unico 			= trim($arr0['num_unico']);
			
			$cod_presu_or		= trim($arr0['cod_presu_or']);
		}
			if(strlen($Xobserva_ord)==0) $Xobserva_ord = "";

		$db_po  = conecto();
		$sql_po = " select count(*) as canti from pos where cod_presu = ".$cod_presu_or." ";
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
		
		#FIN CABECERA - ORDENES

		#DETALLE - ORDENES
		$db00  = conecto();
		$sql00 = " select * from elementosord where cod_ord = '".$cod."' ";
		$r00   = mysqli_query($db00, $sql00);
	
		if ($r00 == false){
	    	mysqli_close($db00);
	        $error = "Error: (" . mysql_errno() . ") " . mysql_error().")";
	        //gestion_errores();
	    }
	    	mysqli_close($db00);
		#FIN DETALLE - ORDENES
																								
	#---FIN TRAIGO TODOS LOS DATOS			  
	//}#FIN SI ES ELIMINAR O MODIFICAR	
	
//}//FIN POST

///////////////////////////// LISTADOS /////////////////////////////

	#TRAIGO EL NOMBRE DE LOS CLIENTES------------------->
	$db_Cliente  = conecto();
	$sql_Cliente = " select ape_cli, nom_cli, cod_cli from clientes order by ape_cli ASC ";
	$r_Cliente   = mysqli_query($db_Cliente, $sql_Cliente);

	if ($r_Cliente == false){
    	mysqli_close($db_Cliente);
        $error = "Error: (" . mysql_errno() . ") " . mysql_error().")";
        //gestion_errores();
    }
        mysqli_close($db_Cliente);
	#FIN TRAIGO EL NOMBRE DE LOS CLIENTES------------------->	

	#TRAIGO ADELANTOS DE CLIENTE------------------->
	$db2  = conecto();
	$sql2 = " select count(*) as canti from adelantocliente where cod_ord = '".$cod."' ";
	$r2	  = mysqli_query($db2, $sql2);
//echo $sql2;exit();
	if ($r2 == false){
    	mysqli_close($db2);
        $error = "Error: (" . mysql_errno() . ") " . mysql_error().")";
        //gestion_errores();
    }
        mysqli_close($db2);	
	
	$arrx = mysqli_fetch_array($r2);
	$cantidad = $arrx['canti'];
		//echo $cantidad; exit(); 
		
	if ($cantidad > "0"){
		$veo_adelantocliente = true;
		$veo_Alarma = veoAlarmaInsPic($cod);
	}else{
		$veo_adelantocliente = false;
	}	
	#FIN TRAIGO ADELANTOS DE CLIENTE------------------->

	#TRAIGO ADELANTOS DE CHINA------------------->
	$db3  = conecto();
	$sql3 = " select count(*) as canti from adelantochina where cod_ord = '".$cod."' ";
	$r3	  = mysqli_query($db3, $sql3);

	if ($r3 == false){
    	mysqli_close($db3);
        $error = "Error: (" . mysql_errno() . ") " . mysql_error().")";
        //gestion_errores();
    }
        mysqli_close($db3);	
	
	$arrx = mysqli_fetch_array($r3);
	$cantidad = $arrx['canti'];
		
	if ($cantidad > "0"){
		$veo_adelantochina = true;
	}else{
		$veo_adelantochina = false;
	}	
	#FIN TRAIGO ADELANTOS DE CHINA------------------->

	#TRAIGO documentaciones------------------->
	$db31  = conecto();
	$sql31 = " select count(*) as canti from documentaciones where cod_ord = '".$cod."' ";
	$r31	  = mysqli_query($db31, $sql31);

	if ($r31 == false){
    	mysqli_close($db31);
        $error = "Error: (" . mysql_errno() . ") " . mysql_error().")";
        //gestion_errores();
    }
        mysqli_close($db31);	
	
	$arrx = mysqli_fetch_array($r31);
	$cantidad = $arrx['canti'];
		
	if ($cantidad > "0"){
		$veo_documentaciones = true;
	}else{
		$veo_documentaciones = false;
	}	
	#FIN documentaciones------------------->

	#TRAIGO amparos------------------->
	$db32  = conecto();
	$sql32 = " select count(*) as canti from amparos where cod_ord = '".$cod."' ";
	$r32	  = mysqli_query($db32, $sql32);

	if ($r32 == false){
    	mysqli_close($db32);
        $error = "Error: (" . mysql_errno() . ") " . mysql_error().")";
        //gestion_errores();
    }
        mysqli_close($db32);	
	
	$arrx = mysqli_fetch_array($r32);
	$cantidad = $arrx['canti'];
		
	if ($cantidad > "0"){
		$veo_amparos = true;
	}else{
		$veo_amparos = false;
	}	
	#FIN amparos------------------->
		
	#TRAIGO COMERCIAL INVOICE------------------->
	$db4  = conecto();
	$sql4 = " select count(*) as canti from comercialinvoice where cod_ord = '".$cod."' ";
	$r4	  = mysqli_query($db4, $sql4);

	if ($r4 == false){
    	mysqli_close($db4);
        $error = "Error: (" . mysql_errno() . ") " . mysql_error().")";
        //gestion_errores();
    }
        mysqli_close($db4);	
	
	$arrx = mysqli_fetch_array($r4);
	$cantidad = $arrx['canti'];
		
	if ($cantidad > "0"){
		$veo_comercialinvoice = true;
	}else{
		$veo_comercialinvoice = false;
	}	
	#FIN COMERCIAL INVOICE------------------->	

	#TRAIGO EMBARQUES ------------------->
	$db5  = conecto();
	$sql5 = " select count(*) as canti from embarques where cod_ord = '".$cod."' ";
	$r5	  = mysqli_query($db5, $sql5);

	if ($r5 == false){
    	mysqli_close($db5);
        $error = "Error: (" . mysql_errno() . ") " . mysql_error().")";
        //gestion_errores();
    }
        mysqli_close($db5);	
	
	$arrx = mysqli_fetch_array($r5);
	$cantidad = $arrx['canti'];
		
	if ($cantidad > "0"){
		$veo_embarques = true;
	}else{
		$veo_embarques = false;
	}	
	#FIN EMBARQUES ------------------->	

	#TRAIGO INSPICTURE PICTURES ------------------->
	$db6  = conecto();
	$sql6 = " select count(*) as canti from inspectionpictures where cod_ord = '".$cod."' ";
	$r6	  = mysqli_query($db6, $sql6);

	if ($r6 == false){
    	mysqli_close($db6);
        $error = "Error: (" . mysql_errno() . ") " . mysql_error().")";
        //gestion_errores();
    }
        mysqli_close($db6);	
	
	$arrx = mysqli_fetch_array($r6);
	$cantidad = $arrx['canti'];
		
	if ($cantidad > "0"){
		$veo_inspectionpictures = true;
	}else{
		$veo_inspectionpictures = false;
	}	
	#FIN INSPICTURE PICTURES ------------------->	

	#TRAIGO TERMINAL  ------------------->
	$db7  = conecto();
	$sql7 = " select count(*) as canti from facturas_ingresantes where cod_ord = '".$cod."' and lugar_fac_ing  = 'Terminal' ";
	$r7	  = mysqli_query($db7, $sql7);

	if ($r7 == false){
    	mysqli_close($db7);
        $error = "Error: (" . mysql_errno() . ") " . mysql_error().")";
        //gestion_errores();
    }
        mysqli_close($db7);	
	
	$arrx = mysqli_fetch_array($r7);
	$cantidad = $arrx['canti'];
		
	if ($cantidad > "0"){
		$veo_archivoterminales = true;
	}else{
		$veo_archivoterminales = false;
	}	
	#FIN TERMINAL  ------------------->	

	#TRAIGO IVETRA  ------------------->
	$db8  = conecto();
	$sql8 = " select count(*) as canti from facturas_ingresantes where cod_ord = '".$cod."' and lugar_fac_ing  = 'Ivetra/Tap' ";
	$r8	  = mysqli_query($db8, $sql8);

	if ($r8 == false){
    	mysqli_close($db8);
        $error = "Error: (" . mysql_errno() . ") " . mysql_error().")";
        //gestion_errores();
    }
        mysqli_close($db8);	
	
	$arrx = mysqli_fetch_array($r8);
	$cantidad = $arrx['canti'];
		
	if ($cantidad > "0"){
		$veo_ivetras = true;
	}else{
		$veo_ivetras = false;
	}	
	#FIN IVETRA  ------------------->	

	#TRAIGO NAVIERA  ------------------->
	$db9  = conecto();
	$sql9 = " select count(*) as canti from facturas_ingresantes where cod_ord = '".$cod."' and lugar_fac_ing  = 'Naviera' ";
	$r9	  = mysqli_query($db9, $sql9);

	if ($r9 == false){
    	mysqli_close($db9);
        $error = "Error: (" . mysql_errno() . ") " . mysql_error().")";
        //gestion_errores();
    }
        mysqli_close($db9);	
	
	$arrx = mysqli_fetch_array($r9);
	$cantidad = $arrx['canti'];
		
	if ($cantidad > "0"){
		$veo_naviera = true;
	}else{
		$veo_naviera = false;
	}	
	#FIN NAVIERA  ------------------->

	#TRAIGO DEPOSITO FISCAL  ------------------->
	$db10  = conecto();
	$sql10 = " select count(*) as canti from facturas_ingresantes where cod_ord = '".$cod."' and lugar_fac_ing  = 'Deposito Fiscal'";
	$r10	  = mysqli_query($db10, $sql10);

	if ($r10 == false){
    	mysqli_close($db10);
        $error = "Error: (" . mysql_errno() . ") " . mysql_error().")";
        //gestion_errores();
    }
        mysqli_close($db10);	
	
	$arrx_depo = mysqli_fetch_array($r10);
	$cantidad_depo = $arrx_depo['canti'];
		
	if ($cantidad_depo > "0"){
		$veo_depofiscal = true;
	}else{
		$veo_depofiscal = false;
	}	
	#FIN DEPOSITO FISCAL   ------------------->
	
	#TRAIGO SEGURO DE CAUCION   ------------------->
	$db11   = conecto();
	$sql11  = " select count(*) as canti from facturas_ingresantes where cod_ord = '".$cod."' and lugar_fac_ing  = 'Seguro De Caucion' ";
	$r11	= mysqli_query($db11, $sql11);

	if ($r11 == false){
    	mysqli_close($db11);
        $error = "Error: (" . mysql_errno() . ") " . mysql_error().")";
        //gestion_errores();
    }
        mysqli_close($db11);	
	
	$arrx = mysqli_fetch_array($r11);
	$cantidad = $arrx['canti'];
		
	if ($cantidad > "0"){
		$veo_seguros = true;
	}else{
		$veo_seguros = false;
	}	
	#FIN SEGURO DE CAUCION   ------------------->

	#TRAIGO DESPACHANTES     ------------------->
	$db12   = conecto();
	$sql12  = " select count(*) as canti from facturas_ingresantes where cod_ord = '".$cod."' and lugar_fac_ing  = 'Despachante'";
	$r12	= mysqli_query($db12, $sql12);

	if ($r12 == false){
    	mysqli_close($db12);
        $error = "Error: (" . mysql_errno() . ") " . mysql_error().")";
        //gestion_errores();
    }
        mysqli_close($db12);	
	
	$arrx = mysqli_fetch_array($r12);
	$cantidad = $arrx['canti'];
		
	if ($cantidad > "0"){
		$veo_despachantes = true;
	}else{
		$veo_despachantes = false;
	}	
	#FIN DESPACHANTES   ------------------->

	#TRAIGO transportes     ------------------->
	$db13   = conecto();
	$sql13  = " select count(*) as canti from facturas_ingresantes where cod_ord = '".$cod."' and lugar_fac_ing  = 'Transporte'";
	//echo $sql13;
	$r13	= mysqli_query($db13, $sql13);

	if ($r13 == false){
    	mysqli_close($db13);
        $error = "Error: (" . mysql_errno() . ") " . mysql_error().")";
        //gestion_errores();
    }
        mysqli_close($db13);	
	
	$arrx = mysqli_fetch_array($r13);
	$cantidad = $arrx['canti'];
	//	echo $cantidad; exit();
	if ($cantidad > "0"){
		$veo_transportes = true;
	}else{
		$veo_transportes = false;
	}	
	#FIN transportes   ------------------->

	#TRAIGO seguridades     ------------------->
	$db14   = conecto();
	$sql14  = " select count(*) as canti from  facturas_ingresantes where cod_ord = '".$cod."' and lugar_fac_ing  = 'Seguridad'";
	$r14	= mysqli_query($db14, $sql14);

	if ($r14 == false){
    	mysqli_close($db14);
        $error = "Error: (" . mysql_errno() . ") " . mysql_error().")";
        //gestion_errores();
    }
        mysqli_close($db14);	
	
	$arrx = mysqli_fetch_array($r14);
	$cantidad = $arrx['canti'];
		
	if ($cantidad > "0"){
		$veo_seguridades = true;
	}else{
		$veo_seguridades = false;
	}	
	#FIN seguridades   ------------------->			
	
	
	
	#------------------------------------CHEQUES
	$lugar	= "OrdenDeCompra";	
	
	$db_vc  = conecto();
	$sql_vc = " select count(*) as canti from cheques where cod_ord = ".$cod." and lugar_che  = '".$lugar."' ";
		
	$r_vc   = mysqli_query($db_vc, $sql_vc);
	//echo $sql_vc;exit();
	if ($r_vc == false){
		mysqli_close($db_vc);
		//$error = "Error: (" . mysql_errno() . ") " . mysql_error().")";
		gestion_errores();
	}
		mysqli_close($db_vc);	
		
	$arrx = mysqli_fetch_array($r_vc);
	$cantidad_che = $arrx['canti'];
	//echo $cantidad; exit();
			
	if($cantidad_che>0){	
		$dbch  = conecto();
		$sqlch = "select * from cheques where cod_ord = '".$cod."' and lugar_che = '".$lugar."' ";
		$rch   = mysqli_query($dbch, $sqlch);
		
		if ($rch == false){
			mysqli_close($dbch);
			$error = "Error: (" . mysql_errno() . ") " . mysql_error().")";
			//gestion_errores();
		}
			mysqli_close($dbch);
	}
///////////////////////////// FIN LISTADOS /////////////////////////////	
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
 <head>
	<meta charset='iso-8859-1'>
	<title>BHI - Sistema Administrativo</title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="css/style.css">
    
    <link rel="stylesheet" type="text/css" href="css/slimmenu.css">
   	<script src="js/jquery.min.js"></script>
    


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
    
    <script language="Javascript">
    	function eliminar(){

		var codigo = "<?php echo $cod; ?>" ;
	
		 var mensaje = '¿Esta seguro que desea eliminar la orden de compra?'; 
		 if (confirm(mensaje)){ 
			 window.location='veoordenes.php?cod='+codigo+'&acc=ELI'; 
			 return true;
		 } 
		  //return false;
		 }
	</script>

    <style type="text/css">
        #report { border-collapse:collapse;}
        #report h4 { margin:0px; padding:0px;}
        #report img { float:right;}
        #report ul { margin:10px 0 10px 40px; padding:0px;}
        #report th { url(images/header_bkg.png) repeat-x scroll center left; color:#fff; padding:7px 15px; text-align:left;}
        #report td { none repeat-x scroll center left; color:#000; padding:7px 15px; }
        #report tr.odd td { url(images/row_bkg.png) repeat-x scroll center left; cursor:pointer; }
        #report div.arrow { background:transparent url(images/arrows.png) no-repeat scroll 0px -16px; width:16px; height:16px; display:block;}
        #report div.up { background-position:0px 0px;}
    </style>
   
    <script type="text/javascript">  
		$(function() {
		  $("#report tr:not(.accordion)").hide();
		  $("#report tr:first-child").show();
		  $("#report tr.accordion").click(function(){
		  $(this).nextAll("tr").toggle();
			});
		  });		
    </script> 
    
        
    
	<link rel="stylesheet" href="css/alertas.css">        
 </head>
<body>
	<div class="logo">BHI - BROKERS</div> 
	<div id="page-wrap"> 
  <form action="" method="post" name="form1" enctype="multipart/form-data">   
    <?php include 'menu.php'; ?>

	<p>USUARIO: <?php echo $Xnombre; ?></p>
    
	<table class="sombra">
      <thead>
	          <tr>
	            <th colspan="3" align="center"><h3><div align="center"> ORDEN DE COMPRA</div></h3></th>
	            </tr>
	          </thead>
	        <tbody>
	          <tr>
	            <td colspan="3"><div align="center">Numero: <?php echo $num_unico." / ".date("Y"); ?></div></td>
	            </tr>
	          <tr>
	            <td colspan="3"><div align="center"><strong>CLIENTE: </strong><span style="color: #000">
                <select name="LSTCliente" id="combox" value="<?php echo $XLSTCliente; ?>" class="button">
                <option value="000">Seleccione</option>
                <?php 
				while ($arr_Cliente = mysqli_fetch_array($r_Cliente))			
				{		
					$XseltCliente = '';
					
					if (trim($arr_Cliente['cod_cli'])==trim($XLSTCliente)){	
						$XseltCliente = 'selected ';
					}	
			
					echo '<option value="'.trim($arr_Cliente['cod_cli']).'" '.$XseltCliente.'>'.' '.trim($arr_Cliente['ape_cli']).', ' .trim($arr_Cliente['nom_cli']).'</option>'."\n\t\t";
				}
					
				?>
                </select>
	              <?php if(strlen($Xerror!=0)) echo "*";?>
	              </span> </div></td>
	            </tr>
	          <tr>
	            <td width="657"><strong>FECHA ALTA: <?php echo ordenofecha($Xfe_alt_ord); ?></strong></td>
	            <td colspan="2"><?php 
					if(strlen($Xcontrato_or)!=0){
						$Xveo_contra = "SI";
					}else{
						$Xveo_contra = "NO";
					}
					
					if(strlen($Xpi_or)!=0){
						$Xveo_pi = "SI";
					}else{
						$Xveo_pi = "NO";
					}
					
					if($cantidad_po > 0){
						$Xveo_po = "SI";
					}else{
						$Xveo_po = "NO";
					} 		
		
				?>
	              <strong>ARCHIVOS - PI: <?php echo '<font color="red">'.$Xveo_contra.'</font>' ?> PO: <?php echo '<font color="red">'.$Xveo_pi.'</font>' ?> CONTRATO: <?php echo '<font color="red">'.$Xveo_po.'</font>' ?></strong></td>
              </tr>
	          <tr>
	            <td colspan="2" align="right"><strong>OBSERVACIONES: </strong><?php echo $Xobserva_ord; ?></td>
	            <td width="100" align="right"><a href="abms/modobsord.php?cod=<?php echo $cod; ?>">
	              <input type="button" name="MODobserva" id="MODobserva" value="MODIFICAR" class="button">
	            </a></td>
              </tr>
	          <tr>
	            <td colspan="3" align="right"><strong>Facturar como:</strong><input type="text"  id="Xdestino" name="Xdestino" value="<?php echo $Xdestino; ?>" class="button" disabled></td>
              </tr>
	          <tr>
	            <td colspan="3" align="right"><?php 
												if($veo_Alarma == 1){ echo '<div class="notify notify--danger" role="alert"><strong>Atencion!</strong> La fecha de subida de las Inspection Pictures a expirado</div>'; 
												} 
												if($veo_AlarmaVCV == 1){ echo '<div class="notify notify--warning" role="alert"><strong>Atencion!</strong> La fecha de subida del contrato de venta a expirado</div>'; 
												}
												
												?>
                </td>
              </tr>
	          <tr>
	            <td colspan="3" align="right"><strong><div align="right">
                <a href="<?php 	echo 'nuevopresu.php?cod='.$Xcod_presu_or; ?>"><input type="button" name="button" id="button" value="VER PRESUPUESTO ORIGINAL" class="button"></a></div>
	            </strong></td>
              </tr>
	          <tr>
	            <td colspan="3">&nbsp;</td>
	            </tr>
	          <tr>
	            <td colspan="3"><?php echo '<div align="center" style="color:red; font-weight: bold;">'.$Xerror.'</div>'; ?></td>
	            </tr>
	          <tr>
	            <td colspan="3">
                <table>
	              <tbody>
	                <tr>
	                  <td width="250"><strong>ELEMENTOS DE LA ORDEN</strong></td>
	                  <td width="226"><strong>DESCRIPCION</strong></td>
	                  <td width="145"><strong>PRECIO(U$S)</strong></td>
	                  <td width="176"><strong>PRECIO CHINA</strong></td>
	                  <td width="76"><strong>CANT</strong></td>
	                  <td width="74"><a href="abms/detaordenes.php?cod=<?php echo $cod; ?>"><input type="button" name="add" id="add" value="MODIFICAR" class="button"></a></td>
	                  </tr>
                      <?php 
						$subtotal1 	 =0;
						$total1		 =0;
						$subtotal2	 =0;
						$total2		 =0;
						$total3 	 =0;
					  	while ($arr00 = mysqli_fetch_array($r00))		
						{
							$Xcod_eleord 		= trim($arr00['cod_eleord']);
							$Xcod_presu_or 		= trim($arr00['cod_presu_or']);
							$Xdes_ord 			= trim($arr00['des_ord']);
							$Xanota_ord 		= trim($arr00['anota_ord']);
							$Xprecio_ba_ord 	= trim($arr00['precio_ba_ord']);
							$Xprecio_china_ord	= trim($arr00['precio_china_ord']);
							$Xcanti_ord			= trim($arr00['canti_ord']);
					  	#Incremento los valores para saber los totales
						$subtotal1 = $Xprecio_ba_ord*$Xcanti_ord;
						$total1 = $total1 + $subtotal1;
						$subtotal2 = $Xprecio_china_ord*$Xcanti_ord;
						$total2 = $total2 + $subtotal2;
						$total3 = $total3 + $Xcanti_ord;					
					 echo "<tr>
							  <td>$Xdes_ord</td>
							  <td>$Xanota_ord</td>
							  <td>$Xprecio_ba_ord</td>
							  <td>$Xprecio_china_ord</td>
							  <td>$Xcanti_ord</td>
							  <td>&nbsp;</td>
	                 	  </tr>";
						}   
					  ?>
	                <tr>                      
	                  <td><strong>TOTALES</strong></td>
	                  <td>&nbsp;</td>
	                  <td><?php echo $total1;?></td>
	                  <td><?php echo $total2;?></td>
	                  <td><?php echo $total3;?></td>
	                  <td><strong>U$S.</strong></td>
	                  </tr>
	                </tbody>
	              </table>
                  </td>
	            </tr>
	          <tr>
	            <td colspan="3"><div align="center"><span style="color: #000"><strong>DETALLE</strong></span></div></td>
	            </tr>
                  <tr>
                      <td colspan="3"><div align="center" class="titulo"><strong>COBRANZAS Y PAGOS</strong></div></td>
                  </tr>
 
				<?php 
				 
					#ADELANTO CLIENTE
					if($veo_adelantocliente === true){
						include('tabs/adcli.tab.php');
					}else{
						echo '<tr>
	            				<td colspan="4"><div align="right"> No hay datos del adelanto del cliente<a href="abms/adelantocliente.php?cod='.$cod.'&accion=ALT"><input type="button" name="add" id="add" value="AGREGAR" class="button"></a></div></td>
              				</tr>';
						}	
					echo '<tr><td colspan="4">&nbsp;</td></tr>';	
					#FIN ADELANTO CLIENTE

					#ADELANTO CHINA
					if($veo_adelantochina === true){
						include('tabs/adchina.tab.php');
					}else{
						echo '<tr>
	            				<td colspan="4"><div align="right"> No hay datos de Pagos en Origen <a href="abms/adelantochina.php?cod='.$cod.'&accion=ALT"><input type="button" name="add" id="add" value="AGREGAR" class="button"></a></div></td>
              				</tr>';
						}	
					echo '<tr><td colspan="4">&nbsp;</td></tr>';					
					#FIN ADELANTO CHINA	
										
					?>
                  <!--RESUMEN DE ADELANTOS -->
                  <tr>
                      <td colspan="3">
                      <table>
                        <tbody>
                          <tr>
                            <td colspan="5"><div align="center"><strong>RESUMEN DE COBRANZAS Y PAGOS</strong></div></td>
                          </tr>
                          <tr>
                            <td><strong>TOTAL PAGOS DEL CLIENTE</strong></td>
                            <td width="145">&nbsp;</td>
                            <td width="176">&nbsp;</td>
                            <td width="76"><?php echo veoTotalPagosCliente($cod);?></td>
                            <td width="74"><strong>U$S.</strong></td>
                          </tr>
                         <!-- 
                          <tr>
                            <td><strong>TOTAL ADELANTOS DEL CLIENTE</strong></td>
                            <td>&nbsp;</td>
                            <td>&nbsp;</td>
                            <td><?php //echo veoTotalAdelantosCliente($cod);?></td>
                            <td><strong>U$S.</strong></td>
                          </tr>
                          -->
                          <tr>
                            <td><strong>TOTAL PAGOS A CHINA</strong></td>
                            <td>&nbsp;</td>
                            <td>&nbsp;</td>
                            <td><?php echo veoTotalPagosAchina($cod);?></td>
                            <td><strong>U$S.</strong></td>
                          </tr>
                        </tbody>
                      </table>

                  <tr>
                      <td colspan="3">&nbsp;</td>
                  </tr> 
                  
			 <!--RESUMEN DE ADELANTOS --> 
             <tr>
                 <td colspan="3"><div align="center" class="titulo"><strong>DOCUMENTACION</strong></div></td>
             </tr>
                  
					<?php 
					#documentaciones
					if($veo_documentaciones === true){
						include('tabs/docu.tab.php');
					}else{
						echo '<tr>
	            				<td colspan="4"><div align="right"> No hay datos de Documentos <a href="abms/docu.php?cod='.$cod.'&accion=ALT"><input type="button" name="add" id="add" value="AGREGAR" class="button"></a></div></td>
              				</tr>';
						}	
					echo '<tr><td colspan="4">&nbsp;</td></tr>';					
					#FIN documentaciones
					?> 
                  <tr>
                      <td colspan="3"><div align="center" class="titulo"><strong>DOCUMENTACION DE DESPACHO</strong></div></td>
                  </tr>

					<?php 					
					#amparos
					if($veo_amparos === true){
						include('tabs/amparos.tab.php');
					}else{
						echo '<tr>
	            				<td colspan="4"><div align="right"> No hay datos de documentación para despacho<a href="abms/amparos.php?cod='.$cod.'&accion=ALT"><input type="button" name="add" id="add" value="AGREGAR" class="button"></a></div></td>
              				</tr>';
						}	
					echo '<tr><td colspan="4">&nbsp;</td></tr>';					
					#amparos	 

					#ADELANTO COMERCIALINVOICE
					if($veo_comercialinvoice === true){
						include('tabs/cominv.tab.php');
					}else{
						echo '<tr>
	            				<td colspan="4"><div align="right"> No hay datos del Comercial Invoice<a href="abms/comerinvoice.php?cod='.$cod.'&accion=ALT"><input type="button" name="add" id="add" value="AGREGAR" class="button"></a></div></td>
              				</tr>';
						}	
					echo '<tr><td colspan="4">&nbsp;</td></tr>';					
					#FIN ADELANTO COMERCIALINVOICE	
					
					#ADELANTO EMBARQUES
					if($veo_embarques === true){
						include('tabs/embarque.tab.php');
					}else{
						echo '<tr>
	            				<td colspan="4"><div align="right"> No hay datos de Embarques<a href="abms/embarques.php?cod='.$cod.'&accion=ALT"><input type="button" name="add" id="add" value="AGREGAR" class="button"></a></div></td>
              				</tr>';
						}	
					echo '<tr><td colspan="4">&nbsp;</td></tr>';					
					#FIN ADELANTO EMBARQUES	 
					?>                 
                                                       
                  <tr>
                      <td colspan="3"><div align="center" class="titulo"><strong>GASTOS POR OPERACION</strong></div></td>
                  </tr>                                      
				<?php 



					#ADELANTO INSPICTURE PICTURES
					if($veo_inspectionpictures === true){
						include('tabs/inspic.tab.php');
					}else{
						echo '<tr>
	            				<td colspan="4"><div align="right"> No hay datos de Gastos Por Operacion<a href="abms/inspic.php?cod='.$cod.'&accion=ALT"><input type="button" name="add" id="add" value="AGREGAR" class="button"></a></div></td>
              				</tr>';
						}	
					echo '<tr><td colspan="4">&nbsp;</td></tr>';					
					#FIN INSPICTURE PICTURES	

					#TERMINALES
					if($veo_archivoterminales === true){
						include('tabs/facing.tab.php');
					}else{
						$lugar = "Terminal";
						echo '<tr>
	            				<td colspan="4"><div align="right"> No hay datos de Archivos Terminales<a href="abms/facing.php?cod='.$cod.'&accion=ALT&lugar='.$lugar.'"><input type="button" name="add" id="add" value="AGREGAR" class="button"></a></div></td>
              				</tr>';
						}	
					echo '<tr><td colspan="4">&nbsp;</td></tr>';					
					#FIN TERMINALES

					#IVETRAS
					if($veo_ivetras === true){
						include('tabs/facing.tab.php');
					}else{
						$lugar = "Ivetra/Tap";
						echo '<tr>
	            				<td colspan="4"><div align="right"> No hay datos de Ivetra/Tap<a href="abms/facing.php?cod='.$cod.'&accion=ALT&lugar='.$lugar.'"><input type="button" name="add" id="add" value="AGREGAR" class="button"></a></div></td>
              				</tr>';
						}	
					echo '<tr><td colspan="4">&nbsp;</td></tr>';					
					#FIN IVETRAS
								
					#NAVIERAS
					if($veo_naviera === true){
						include('tabs/facing.tab.php');
					}else{
						$lugar = "Naviera";
						echo '<tr>
	            				<td colspan="4"><div align="right"> No hay datos de Naviera<a href="abms/facing.php?cod='.$cod.'&accion=ALT&lugar='.$lugar.'"><input type="button" name="add" id="add" value="AGREGAR" class="button"></a></div></td>
              				</tr>';
						}	
					echo '<tr><td colspan="4">&nbsp;</td></tr>';					
					#FIN NAVIERAS

					#DEPOSITOSFISCALES
					if($veo_depofiscal === true){
						include('tabs/facing.tab.php');
					}else{
						$lugar = "Deposito Fiscal";
						echo '<tr>
	            				<td colspan="4"><div align="right"> No hay datos del Deposito Fiscal<a href="abms/facing.php?cod='.$cod.'&accion=ALT&lugar='.$lugar.'"><input type="button" name="add" id="add" value="AGREGAR" class="button"></a></div></td>
              				</tr>';
						}	
					echo '<tr><td colspan="4">&nbsp;</td></tr>';					
					#FIN DEPOSITOSFISCALES

					
					#SEGUROSDECAUCION
					if($veo_seguros === true){
						include('tabs/facing.tab.php');
					}else{
						$lugar = "Seguro De Caucion";
						echo '<tr>
	            				<td colspan="4"><div align="right"> No hay datos de Seguros de Caucion<a href="abms/facing.php?cod='.$cod.'&accion=ALT&lugar='.$lugar.'"><input type="button" name="add" id="add" value="AGREGAR" class="button"></a></div></td>
              				</tr>';
						}	
					echo '<tr><td colspan="4">&nbsp;</td></tr>';					
					#FIN SEGUROSDECAUCION

					#veo_despachantes
					if($veo_despachantes === true){
						include('tabs/facing.tab.php');
					}else{
						$lugar = "Despachante";
						echo '<tr>
	            				<td colspan="4"><div align="right"> No hay datos de Despachantes<a href="abms/facing.php?cod='.$cod.'&accion=ALT&lugar='.$lugar.'"><input type="button" name="add" id="add" value="AGREGAR" class="button"></a></div></td>
              				</tr>';
						}	
					echo '<tr><td colspan="4">&nbsp;</td></tr>';					
					#FIN veo_despachantes

					#veo_transportes
					if($veo_transportes === true){
						include('tabs/facing.tab.php');
					}else{
						$lugar = "Transporte";
						echo '<tr>
	            				<td colspan="4"><div align="right"> No hay datos de Transportes<a href="abms/facing.php?cod='.$cod.'&accion=ALT&lugar='.$lugar.'"><input type="button" name="add" id="add" value="AGREGAR" class="button"></a></div></td>
              				</tr>';
						}	
					echo '<tr><td colspan="4">&nbsp;</td></tr>';					
					#FIN veo_transportes

					#veo_seguridades
					if($veo_seguridades === true){
						include('tabs/facing.tab.php');
					}else{
						$lugar = "Seguridad";
						echo '<tr>
	            				<td colspan="4"><div align="right"> No hay datos de Seguridad<a href="abms/facing.php?cod='.$cod.'&accion=ALT&lugar='.$lugar.'"><input type="button" name="add" id="add" value="AGREGAR" class="button"></a></div></td>
              				</tr>';
						}	
					echo '<tr><td colspan="4">&nbsp;</td></tr>';					
					#FIN veo_seguridades
																																																												
					//seguridades
		  		?>                
              <tr>
	            <td colspan="3">&nbsp;</td>
              </tr>
	          <tr>
	            <td colspan="3">&nbsp;</td>
	            </tr>
	          <tr>
	            <td colspan="3"><div align="center"><span style="color: #000">
	              <a href="javascript:eliminar()"><input name="BTNeli" type="button" class="button" id="BTNeli" value="ELIMINAR"></a>
	              <!--<input name="BTNcreaFAC" type="submit" class="button" id="BTNcreaFAC" value="FACTURAR">-->
                  <input name="BTNcreaBHI" type="submit" class="button" id="BTNcreaBHI" value="ASIGNAR OC BHI">
                  <input name="BTNcreaBSD" type="submit" class="button" id="BTNcreaBSD" value="ASIGNAR OC BSD">
                  <input name="BTNcreaEMPRINCE" type="submit" class="button" id="BTNcreaEMPRINCE" value="ASIGNAR OC EMPRINCE">
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