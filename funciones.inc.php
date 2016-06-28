<?php 

/////////////////////////////
function gestion_errores() //
/////////////////////////////
{
	//Error Desconocido
	header ('location:error.php');
	exit();
}

////******************************************************////
//////////////////// TABLA DE ERRORES ////////////////////////
//Err01 || Error Desconocido//////////////////////////////////
//Err02 || Error de Validacion de Usuario - Mal Usuario///////
//Err03 || Error de Validacion de Usuario - Mal Clave/////////
//////////////////////////////////////////////////////////////
////******************************************************////
	
	

//////////////////////////////CONEXIONES//////////////////////////////////////////////
/////////////////////
function conecto() //
/////////////////////

{
   //error_reporting(0);
   	$SERVER		="127.0.0.1";
	$USER 		= "mysql_user";
	$PASS 		= "mysql_pass";
	$DATABASE	= "bhi_db";

	if ($db = mysqli_connect($SERVER, $USER, $PASS, $DATABASE))
	{       		 
				// mysql_select_db($base);
	}else{
		echo $Xa = "Error: (" . mysql_errno() . ") " . mysql_error().")";
		//gestion_errores();
	}
		return $db;
		
}
//////////////////////////
function logueo_in($usuario) //
//////////////////////////

{
	 session_start();// aca inicio la sesion

	 $_SESSION['usuario'] = $usuario;

	//return $rta;
}	

//////////////////////////
function falta_logueo() //
//////////////////////////
{
 // averifico si esta logueado
	session_start();
	if (isset($_SESSION['usuario'])) //Determina si una varible est� definida
	{
		$rta = false;
	}else{
		$rta = true;
	}
	return $rta;
}

////////////////////////
function logueo_out() //
////////////////////////

{
    // aca termino la sesion
	session_start();
	session_destroy();
	unset($_SESSION['usuario']);
	//destruye la variable especificada y devuelve TRUE (destruis la sesion)	
}	


///////////////////////////////////////////////////////
function pinto_fecha($nombre,$readonly,$default)
///////////////////////////////////////////////////////
{
	if ($default=='')
	{
	$default = date("Y-m-d");
	}
	$elegido_dia = substr($default, 8, 2);
	$elegido_mes = substr($default, 5, 2);
	$elegido_anio = substr($default, 0, 4);

	$mes[1] = 'ENE';
	$mes[2] = 'FEB';
	$mes[3] = 'MAR';
	$mes[4] = 'ABR';
	$mes[5] = 'MAY';
	$mes[6] = 'JUN';
	$mes[7] = 'JUL';
	$mes[8] = 'AGO';
	$mes[9] = 'SET';
	$mes[10] = 'OCT';
	$mes[11] = 'NOV';
	$mes[12] = 'DIC';


	if ($readonly == "S")
	{
		$disabled = 'disabled';
	}else
	{
		$disabled = '';
	}
	
	///////////////////////////////// dia
	//echo '<select name="'.$nombre.'_dia" '.$disabled.'>'."\n";		  			
	echo '<select'.' id="'.$nombre.'_dia" '.' name="'.$nombre.'_dia" '.$disabled.' class="button-fecha" >'."\n";		  			
	for ($i = 1; $i <= 31; $i++) 
	{
			if (add_ceros($i,2) == $elegido_dia)
			{
				$elegido = 'selected';
			}
			else
			{
				$elegido = '';
			}
		
		echo '<option value="'.add_ceros($i,2).'" '. $elegido.'>'.add_ceros($i,2).'</option>'."\n";    
	
	}
	 echo '</select>';

	///////////////////////////////// MES
	//echo '<select name="'.$nombre.'_mes" '.$disabled.'>'."\n";		  			
	echo '<select'.' id="'.$nombre.'_mes" '.' name="'.$nombre.'_mes" '.$disabled.' class="button-fecha" >'."\n";		  			
	for ($i = 1; $i <= 12; $i++) 
	{
			if (add_ceros($i,2) == $elegido_mes)
			{
				$elegido = 'selected';
			}
			else
			{
				$elegido = '';
			}
		
		echo '<option value="'.add_ceros($i,2).'" '. $elegido.'>'.$mes[$i].'</option>'."\n";    
	 
	}
	 echo '</select>';

	///////////////////////////////// anio
	//echo '<select name="'.$nombre.'_anio" '.$disabled.'>'."\n";		  			
	echo '<select'.' id="'.$nombre.'_anio" '.' name="'.$nombre.'_anio" '.$disabled.' class="button-fecha" >'."\n";		  			
	for ($i = $elegido_anio - 6; $i <= $elegido_anio + 1; $i++) 
	{
			if ($i == $elegido_anio)
			{
				$elegido = 'selected';
			}
			else
			{
				$elegido = '';
			}
		
		echo '<option value="'.$i.'" '. $elegido.'>'.$i.'</option>'."\n";    
	
	}
	 echo '</select>';

}

////////////////////////////////////////////////////
function add_ceros($numero,$ceros) 
////////////////////////////////////////////////////
//Agrega ceros
{
	$order_diez = explode(".",$numero);
	$dif_diez	= $ceros - strlen($order_diez[0]);
	
	for($m = 0;	$m < $dif_diez;	$m++)
		{
			@$insertar_ceros.= 0;
		}

	return $insertar_ceros.= $numero; 

}

////////////////////////////////////////////////////
function suboarchivos($estructura,$nombre,$tmp_name,$error,$cod) 
////////////////////////////////////////////////////
//sube archivos
{
	$Xrespuesta = false;
	if( $error > 0 ){
	  //echo 'Error: ' . $error . '<br/>';
	   $Xrespuesta = "<script language='javascript'>alert('Error El archivo no ha sido subido, intentelo mas tarde nuevamente');window.location.href='nuevopresu.php?cod=".$cod."'; </script>"; 
	}else{
	   if( file_exists( $estructura.$nombre) ){
		  $Xrespuesta = 'El archivo ya existe: ' . $nombre;
		}else{
		  move_uploaded_file($tmp_name,$estructura."/".$nombre);
						  //echo "Guardado en: " .$estructura. $_FILES['archivo']['name'];
		 $Xrespuesta = true;
		}					
	}
	return $Xrespuesta;
}
////////////////////////////////////////////////////
function ordenofecha($fecha) 
////////////////////////////////////////////////////
//ordena la fecha traida por el servidor
{
	$año = substr($fecha,0,4);
	$mes = substr($fecha,5,2);
	$dia = substr($fecha,8,2);
	
	$nuevafecha = $dia."-".$mes."-".$año;
	
	return $nuevafecha;
}


//////////////////////////
function veocheque($orden,$referencia) //
//////////////////////////
#Muestra el numero de cheque segun el codigo de orden de compra y el codigo de referencia
{

	$dbch  = conecto();
	$sqlch = " select * from cheques where cod_ord = '".$orden."' and lugar_che = '".$referencia."' ";
	$rch   = mysqli_query($dbch, $sqlch);
	
	if ($rch == false){
	   	mysqli_close($dbch);
	    //$error = "Error: (" . mysql_errno() . ") " . mysql_error().")";
	    gestion_errores();
	 }
	   	mysqli_close($dbch);
	
	
	while ($arrch = mysqli_fetch_array($rch))
	{
		$res_num_che 	= trim($arrch['cod_che']);
	}
	
	return $res_num_che;	
}

//////////////////////////
function veoChequeFactura($orden,$CodigoFactura) //
//////////////////////////
#Muestra el numero de cheque segun el codigo de orden de compra y el codigo de referencia
{

	$db_ch  = conecto();
	$sql_ch = " select * from cheques where cod_ord = '".$orden."' and cod_ref = '".$CodigoFactura."' ";
	$r_ch   = mysqli_query($db_ch, $sql_ch);
	
	if ($r_ch == false){
	   	mysqli_close($db_ch);
	    //$error = "Error: (" . mysql_errno() . ") " . mysql_error().")";
	    gestion_errores();
	 }
	   	mysqli_close($db_ch);
	
	
	while ($arr_ch = mysqli_fetch_array($r_ch))
	{
		$res__num_che 	= trim($arr_ch['cod_che']);
	}
	
	return $res__num_che;	
}

////////////////////////////////////////////////VER TOTALES////////////////////////////////////////////////

//////////////////////////
function veoTotalPagosCliente($orden) //
//////////////////////////
#Muestra el monto total de pagos del cliente
{

	$db_vtpc  = conecto();
	$sql_vtpc = " select monto_ad from adelantocliente where cod_ord = '".$orden."' and tipo_ad = 'P' ";
	$r_vtpc   = mysqli_query($db_vtpc, $sql_vtpc);
	
	if ($r_vtpc == false){
	   	mysqli_close($db_vtpc);
	    //$error = "Error: (" . mysql_errno() . ") " . mysql_error().")";
	    gestion_errores();
	 }
	   	mysqli_close($db_vtpc);
	
	
	$mon_tot_vtpc = 0;
	
	while ($arr_vtpc = mysqli_fetch_array($r_vtpc))
	{
		$monto_ad 		= trim($arr_vtpc['monto_ad']);
		
		$mon_tot_vtpc	= $mon_tot_vtpc + $monto_ad;
	}
	
	return $mon_tot_vtpc;	
}

//////////////////////////
function veoTotalAdelantosCliente($orden) //
//////////////////////////
#Muestra el monto total de pagos del cliente
{

	$db_vtac  = conecto();
	$sql_vtac = " select monto_ad from adelantocliente where cod_ord = '".$orden."' and tipo_ad = 'A' ";
	$r_vtac   = mysqli_query($db_vtac, $sql_vtac);
	
	if ($r_vtac == false){
	   	mysqli_close($db_vtac);
	    //$error = "Error: (" . mysql_errno() . ") " . mysql_error().")";
	    gestion_errores();
	 }
	   	mysqli_close($db_vtac);
	
	
	$mon_tot_vtac = 0;
	
	while ($arr_vtac = mysqli_fetch_array($r_vtac))
	{
		$monto_aad 		= trim($arr_vtac['monto_ad']);
		
		$mon_tot_vtac	= $mon_tot_vtac + $monto_aad;
	}
	
	return $mon_tot_vtac;	
}

//////////////////////////
function veoTotalPagosAchina($orden) //
//////////////////////////
#Muestra el monto total de pagos del cliente
{
	$db_vtpc  = conecto();
	$sql_vtpc = " select monto_ch from adelantochina where cod_ord = '".$orden."' and tipo_ch = 'P' ";
	$r_vtpc   = mysqli_query($db_vtpc, $sql_vtpc);
	
	if ($r_vtpc == false){
	   	mysqli_close($db_vtpc);
	    //$error = "Error: (" . mysql_errno() . ") " . mysql_error().")";
	    gestion_errores();
	 }
	   	mysqli_close($db_vtpc);
	
	
	$mon_tot_vtpc = 0;
	
	while ($arr_vtpc = mysqli_fetch_array($r_vtpc))
	{
		$monto_ch 		= trim($arr_vtpc['monto_ch']);
		
		$mon_tot_vtpc	= $mon_tot_vtpc + $monto_ch;
	}
	
	return $mon_tot_vtpc;	
}


//////////////////////////////////////////////////// ALERTAS / ALARMAS ////////////////////////////////////////////////////

//////////////////////////
function veoAlarmaInsPic($cod) //
//////////////////////////
#Pasada una X cantidad de días desde la fecha en que se paga el adelanto a China no se cargaron las Inspection Pictures.
{
	$hoy = date("Y-m-d");
	$fe_ven_ins_pic = date("Y-m-d");
	
	$db_AIP  = conecto();
	//$sql_vCv = " select fe_ven_ins_pic from adelantocliente where cod_ord = '".$orden."' and fe_ven_ins_pic >= '".$hoy."' ";
	//$sql_vCv = " select count(fe_ven_ins_pic) as canti from adelantocliente where cod_ord = '".$cod."' and fe_ven_ins_pic >= '".$hoy."' ";
	$sql_AIP = " select fe_ven_ins_pic from adelantocliente where cod_ord = '".$cod."' and fe_ven_ins_pic != '0000-00-00'  ";
	$r_AIP   = mysqli_query($db_AIP, $sql_AIP);
	
	if ($r_AIP == false){
	   	mysqli_close($db_AIP);
	    gestion_errores();
	 }
	   	mysqli_close($db_AIP);
	
	
	while ($arr_AIP = mysqli_fetch_array($r_AIP))
	{
		$fe_ven_ins_pic	= trim($arr_AIP['fe_ven_ins_pic']);
	}
	//return $fe_ven_ins_pic;
	
	if($fe_ven_ins_pic < $hoy ){
		
		$db_AIP2  = conecto();
		$sql_AIP2 = " SELECT count(*) as canti FROM documentaciones WHERE ins_pic_doc = 'S' and cod_ord = '".$cod."' ";
		$r_AIP2   = mysqli_query($db_AIP2, $sql_AIP2);
		
		if ($r_AIP2 == false){
			mysqli_close($db_AIP2);
			gestion_errores();
		 }
			mysqli_close($db_AIP2);
		
		
		while ($arr_AIP2 = mysqli_fetch_array($r_AIP2))
		{
			$canti_AIP2	= trim($arr_AIP2['canti']);
		}
	
		if($canti_AIP2 == 0){
			return 1;
		}else{
			return ;
		}
		
	}else{
		return 0;	
	}
			
}

//////////////////////////
function veoContatoVenta($cod) //
//////////////////////////
#Pasados 7 días del adelanto del cliente, debe avisar si no se subio el contrato de venta
{
	$hoy = date("Y-m-d");
	
	$db_vCv  = conecto();
	$sql_vCv = " SELECT fe_pri_ad FROM adelantocliente WHERE cod_ord = '".$cod."' order by fe_pri_ad DESC LIMIT 1  ";
	$r_vCv   = mysqli_query($db_vCv, $sql_vCv);
	
	if ($r_vCv == false){
	   	mysqli_close($db_vCv);
	    gestion_errores();
	 }
	   	mysqli_close($db_vCv);
	
	
	while ($arr_vCv = mysqli_fetch_array($r_vCv))
	{
		$fe_pri_ad	= trim($arr_vCv['fe_pri_ad']);
	}
	//return $fe_pri_ad;
	
		
	$db_vCv2  = conecto();
	$sql_vCv2 = " SELECT DATEDIFF('".$hoy."','".$fe_pri_ad."') AS DiffDate ";		
	$r_vCv2   = mysqli_query($db_vCv2, $sql_vCv2);
		
	if ($r_vCv2 == false){
		mysqli_close($db_vCv2);
		gestion_errores();
	 }
		mysqli_close($db_vCv2);
		
		
	while ($arr_vCv2 = mysqli_fetch_array($r_vCv2))
	{
		$DiffDate	= trim($arr_vCv2['DiffDate']);
	}
	
	if($DiffDate > 7){
		
		$db_vCv3  = conecto();
		$sql_vCv3 = " SELECT po_or from ordenes where cod_ord = '".$cod."' ";		
		$r_vCv3   = mysqli_query($db_vCv3, $sql_vCv3);
			
		if ($r_vCv3 == false){
			mysqli_close($db_vCv3);
			gestion_errores();
		 }
			mysqli_close($db_vCv3);
			
			
		while ($arr_vCv3 = mysqli_fetch_array($r_vCv3))
		{
			$po_or	= trim($arr_vCv3['po_or']);
		}	
	
		if(strlen($po_or)==0){
			return 1;	
		}else{
			return 0;	
		}		
		
	}else{
		return 0;
	}
				
}

?>
