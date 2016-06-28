<?php
require_once("funciones.inc.php");
/*
if (falta_logueo())
{ 
	header('location:login.php');
	exit();
}
 if(strlen($cod)==0){header ('location:index.php');exit();}#SI llegaron por error
	
 $Xnombre = trim(strtoupper($_SESSION['usuario']));
 */
 $Xnombre ="";
 session_start();


	
if($_POST){//SEGUNDOS POST
	
	$cod 	= $_GET['cod'];
	$coddet	= $_GET['coddet'];
	$Xerror = "";

	if($_POST['BTNMOD']){
	
		$Xerror_num 	= "";
		
		$TXTelem			 = trim($_POST['TXTelem']);
		$TXTanota			 = trim($_POST['TXTanota']);
		$TXTprecio		 	 = trim($_POST['TXTprecio']);
		$TXTpreciochina		 = trim($_POST['TXTpreciochina']); 
		$TXTcantidad		 = trim($_POST['TXTcantidad']);
		$todo_ok = true;
		

		if(!is_numeric($TXTprecio)){
			$todo_ok = false;
			$Xerror_num.= " PRECIO ";	
		}

		if(!is_numeric($TXTpreciochina)){
			$todo_ok = false;
			$Xerror_num.= " PRECIO CHINA";	
		}

		if(!is_numeric($TXTcantidad)){
			$todo_ok = false;
			$Xerror_num.= " CANTIDAD ";	
		}

		if(($TXTcantidad=="0")||($TXTcantidad=="00")||($TXTcantidad=="000")){
			$todo_ok = false;
			$Xerror= " DEBE AGREGAR UNA CANTIDAD VALIDA ";	
		}

		if(strlen($Xerror_num)!=0){
			$Xerror_num.= " DEBE/DEBEN SER NUMERICO/NUMERICOS ";
		}
		//	echo $Xerror_num; exit();			
		if($todo_ok == true){		
		//echo 1; exit();					
			$db1  = conecto();
			$sql1 = " UPDATE  elementospresu SET 
						des_elepresu = '".$TXTelem."',
						anota_elepresu = '".$TXTanota."',
						precio_ba = '".$TXTprecio."',
						precio_china = '".$TXTpreciochina."',
						canti_presu ='".$TXTcantidad."'
						WHERE cod_elepresu = '".$coddet."' and cod_presu = '".$cod."' ";
			//echo $sql1; exit();
			$r1   = mysqli_query($db1, $sql1);
	
			if ($r1 == false){
				mysqli_close($db1);
				$error = "Error: (" . mysql_errno() . ") " . mysql_error().")";
				//gestion_errores();
			}
				mysqli_close($db1);
			
			#SE AGREGO NUEVO ELEMENTO	
					
			echo "<script language='javascript'>alert('El Registro a sido Modificado');
					window.location.href='nuevopresu.php?cod=$cod'; </script>"; 
		}

	}

	if($_POST['BTNvolver']){//volver al menu
 		header ('location:nuevopresu.php?cod='.$cod);
		exit();		
	}	
				
}
//else{
	
	$Xerror 	= "";
	$Xerror_num = "";
	$cod 		= $_GET['cod'];
	$coddet		= $_GET['coddet'];
		
	if(strlen($cod)!=0){#SI ES ELIMINAR O MODIFICAR	

		#DETALLE 
		$db  = conecto();
		$sql = " select * from elementospresu WHERE cod_elepresu = '".$coddet."' and cod_presu = '".$cod."' ";
		//echo $sql;
		$r   = mysqli_query($db, $sql);
	
		if ($r == false){
	    	mysqli_close($db);
	        $error = "Error: (" . mysql_errno() . ") " . mysql_error().")";
	        //gestion_errores();
	    }
	    	mysqli_close($db);
		#FIN DETALLE - ORDENES
									
	}#FIN SI ES ELIMINAR O MODIFICAR
	
//}
?>
<!DOCTYPE html>
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
    
 </head>
<body>
	<div id="page-wrap"> 
 <form action="" method="post" name="form1" >   
    <?php include 'menu.php'; ?>

    <div class="caption">BHI - BROKERS.</div> 
	<p>USUARIO: <?php echo $Xnombre; ?></p>
	<table class="sombra">
      <thead>
	          <tr>
	            <th align="center" colspan="5"><h3>
	              <div align="center"><strong>DETALLE DEL PRESUPUESTO</strong></div></h3></th>
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
                <td width="250"><strong>ELEMENTO</strong></td>
                <td width="226"><span class="small"><strong>ANOTACIONES</strong></span></td>
                <td width="145"><strong>PRECIO</strong></td>
                <td width="176"><strong>PRECIO CHINA</strong></td>
                <td><strong>CANTIDAD</strong></td>
                </tr>
                      <?php 

					  	while ($arr = mysqli_fetch_array($r))		
						{
							$TXTelem 		= trim($arr['des_elepresu']);
							$TXTanota 		= trim($arr['anota_elepresu']);
							$TXTprecio 		= trim($arr['precio_ba']);
							$TXTpreciochina	= trim($arr['precio_china']);
							$TXTcantidad	= trim($arr['canti_presu']); 
						
							if(strlen($TXTelem)==0){$TXTelem = "";}
							if(strlen($TXTanota)==0){$TXTanota = "";}
							if(strlen($TXTprecio)==0){$TXTprecio = "";}
							if(strlen($TXTpreciochina)==0){$TXTpreciochina = "";}
							if(strlen($TXTcantidad)==0){$TXTcantidad = "";}
												  
						}   
					  ?>
					<tr>
	                    <td><input  type="text"  name="TXTelem"  id="TXTelem" size="30" maxlength="250" class="button" value="<?php echo $TXTelem; ?>"/></td>
	                    <td><input type="text" name="TXTanota" id="TXTanota"  size="6" maxlength="250" class="button" value="<?php echo $TXTanota; ?>"></td>
	                    <td><input type="text" name="TXTprecio"  id="TXTprecio" size="6" maxlength="11" class="button" value="<?php echo $TXTprecio; ?>"></td>
	                    <td><input type="text" name="TXTpreciochina" id="TXTpreciochina" size="6" maxlength="11" class="button" value="<?php echo $TXTpreciochina; ?>"></td>
	                    <td><input name="TXTcantidad" type="text" id="TXTcantidad"  size="6" maxlength="11" class="button" value="<?php echo $TXTcantidad; ?>"></td>
                    </tr>
                    <tr>                      
	                  <td colspan="5">&nbsp;</td>
                     </tr>
	          <tr>
	            <td colspan="5"><div align="center"><span style="color: #000">
	             </span><span style="color: #000">
                  <input type="submit" name="BTNMOD" id="BTNMOD" class="button" value="MODIFICAR">
	              <input type="submit" name="BTNvolver" id="BTNvolver" class="button" value="VOLVER AL MENU">
                </span></div></td>
	            </tr>
	          </tbody>
	        </table>


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
