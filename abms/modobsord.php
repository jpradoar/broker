<?php
require_once("../funciones.inc.php");
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
	
	$cod = $_GET['cod'];
	$Xerror = "";

	if($_POST['BTNMOD']){
		
		$TXAobserva		 = trim($_POST['TXAobserva']);
						
		$db1  = conecto();		
		$sql1 = " UPDATE ordenes SET observa_ord = '".$TXAobserva."' WHERE cod_ord = '".$cod."' ";
		//echo $sql1; exit();
		$r1   = mysqli_query($db1, $sql1);
	
		if ($r1 == false){
			mysqli_close($db1);
			$error = "Error: (" . mysql_errno() . ") " . mysql_error().")";
			//gestion_errores();
		}
			mysqli_close($db1);
			
		#SE AGREGO NUEVO ELEMENTO	
					
		echo "<script language='javascript'>alert('El Registro a sido Agregado/Modificado');
					window.location.href='../veoordenes.php?cod=$cod'; </script>"; 
		
	}

	if($_POST['BTNvolver']){//volver al menu
 		header ('location: ../veoordenes.php?cod='.$cod);
		exit();		
	}	
				
}
//else{
	
	$Xerror 	= "";
	$Xerror_num = "";
	$cod 	= $_GET['cod'];
	
	if(strlen($cod)!=0){#SI ES ELIMINAR O MODIFICAR	

		#DETALLE - ORDENES
		$db  = conecto();
		$sql = " select observa_ord from ordenes where cod_ord = '".$cod."' ";
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
 <form action="" method="post" name="form1" >   
    <?php include 'menu.php'; ?>

    <div class="caption">BHI - BROKERS.</div> 
	<p>USUARIO: <?php echo $Xnombre; ?></p>
	<table class="sombra">
      <thead>
	          <tr>
	            <th align="center"><h3>
	              <div align="center"><strong>OBSERVACIONES DE LA ORDEN DE COMPRA</strong></div></h3></th>
	            </tr>
	          </thead>
	        <tbody>
	          <tr>
	            <td><div align="center"><strong>Numero: <?php echo $cod; ?></strong></div></td>
	            </tr>
	          <tr>
	            <td><div align="center"><span style="color: #000"><strong>DETALLE</strong></span></div></td>
	            </tr>
                      <?php 	
					  	while ($arr = mysqli_fetch_array($r))		
						{
							$observa_ord 	= trim($arr['observa_ord']);

							if(strlen($observa_ord)==0){$observa_ord = "";}						  
						}   
					  ?>
					<tr>
	                    <td>&nbsp;</td>
                    </tr>                    
                    <tr>
	                    <td><div align="center"><textarea name="TXAobserva" cols="100" rows="5" maxlength="250"   id="TXAobserva"><?php echo $observa_ord; ?></textarea></div></td>
                    </tr>
                    <tr>                      
	                  <td>&nbsp;</td>
	                  </tr>
	                
	          <tr>
	            <td><div align="center"><span style="color: #000">
	              </span><span style="color: #000">
                  <input type="submit" name="BTNMOD" id="BTNMOD" class="button" value="AGREGAR/MODIFICAR">
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
