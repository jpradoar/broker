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
 
if($_POST){//SEGUNDOS POST

	if($_POST['BTNvolver']){//volver al menu
 		header ('location:index.php');
		exit();		
	}	

}else{
	
	$cod = $_GET['cod'];
			
		$db  = conecto();
		$sql = "select * from cheques 
				inner join ordenes  on ordenes.cod_ord = cheques.cod_ord
				where cheques.cod_che = '".$cod."'  ";
		$r   = mysqli_query($db, $sql);
	
		if ($r == false){
	    	mysqli_close($db);
	        $error = "Error: (" . mysql_errno() . ") " . mysql_error().")";
	        //gestion_errores();
	    }
	    	mysqli_close($db);	
		while ($arr = mysqli_fetch_array($r))		
		{
			$num_unico	 = trim($arr['num_unico'])."/".substr((trim($arr['fe_alt_ord'])),0,4);
			$TXTBcoEmiCHE 	= trim($arr['bco_emi_che']);
			$TXTNroEmiCHE 	= trim($arr['nro_che']);
			$FEEmiChe 		= trim($arr['fe_emi_che']);
			$TXTPerEmiCHE 	= trim($arr['emi_che']);
			$TXTPagadoCHE 	= trim($arr['paga_che']);
			$TXTObservaCHE  = trim($arr['observa_che']);
			
			$FESalCHE  		= trim($arr['fe_sal_che']);
			$TXTConIngCHE  	= trim($arr['concep_ing_che']);
			$TXTConSalCHE  	= trim($arr['concep_sal_che']);
			$TXTFeDifCHE  	= trim($arr['fe_dif_che']);	
			$monto_che  	= trim($arr['monto_che']);	
			$resto12	 	= trim($arr['resto12']);	
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
		if(strlen($monto_che)==0){$monto_che = "";}	
		if(strlen($resto12)==0){$resto12 = "";}	
}
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
    <?php include 'menu.php'; ?>

	<p>USUARIO: <?php echo $Xnombre; ?></p>
	<table class="sombra">
      <thead>
	          <tr>
	            <th width="959" align="center"><h3>
	              <div align="center">CHEQUE</div></h3></th>
	            </tr>
	          </thead>
	        <tbody>
	          <tr>
	            <td><div align="center"><strong>Cheque Numero: <?php echo $cod; ?> -  Corresponde a la Orden de Compra: <?php echo $num_unico; ?></strong></div></td>
	            </tr>
	          <tr>
	            <td><?php echo '<div align="center" style="color:red; font-weight: bold;">'.$Xerror.'</div>'; ?></td>
	            </tr>
	          <tr>
	            <td><div align="center"><span style="color: #000"><strong>DETALLE</strong></span></div></td>
              </tr>
	          <tr>
	            <td><table width="100%" border="0">
	              <tr>
	                <td width="20%">BANCO EMISOR:</td>
	                <td colspan="3"><input type="text" class="button" id="TXTBcoEmiCHE" name="TXTBcoEmiCHE" value="<?php echo $TXTBcoEmiCHE; ?>" disabled ></td>
                  </tr>
	              <tr>
	                <td>NUMERO DEL CHEQUE:</td>
	                <td colspan="3"><input type="text" class="button" id="TXTNroEmiCHE" name="TXTNroEmiCHE" value="<?php echo $TXTNroEmiCHE; ?>" disabled></td>
                  </tr>
	              <tr>
	                <td>FECHA DEL CHEQUE:</td>
	                <td colspan="3"><input type="text" class="button" value="<?php echo ordenofecha($FEEmiChe);?>" disabled></td>
                  </tr>
	              <tr>
	                <td>EMISOR:</td>
	                <td colspan="3"><input type="text" class="button" id="TXTPerEmiCHE" name="TXTPerEmiCHE" value="<?php echo $TXTPerEmiCHE; ?>" disabled></td>
                  </tr>
	              <tr>
	                <td>FECHA SALIDA CHEQUE:</td>
	                <td colspan="3"><input type="text" class="button" value="<?php echo ordenofecha($FESalCHE);?>" disabled></td>
                  </tr>
	              <tr>
	                <td>CONCEPTO INGRESO:</td>
	                <td colspan="3"><input type="text" class="button" id="TXTConIngCHE" name="TXTConIngCHE" value="<?php echo $TXTConIngCHE; ?>" disabled></td>
                  </tr>
	              <tr>
	                <td>CONCEPTO SALIDA:</td>
	                <td colspan="3"><input type="text" class="button" id="TXTConSalCHE" name="TXTConSalCHE" value="<?php echo $TXTConSalCHE; ?>" disabled></td>
                  </tr>
	              <tr>
	                <td>FECHA DIFERIDO DEL CHEQUE:</td>
	                <td colspan="3"><input type="text" class="button" value="<?php echo ordenofecha($TXTFeDifCHE);?>" disabled></td>
                  </tr>
	              <tr>
	                <td>OBSERVACIONES:</td>
	                <td colspan="3"><input type="text" class="button" id="TXTObservaCHE" name="TXTObservaCHE" value="<?php echo $TXTObservaCHE; ?>" disabled></td>
                  </tr>
	              <tr>
	                <td>MONTO:</td>
	                <td><input type="text" class="button" id="TXTmonto_che" name="TXTmonto_che" value="<?php echo $monto_che; ?>" disabled></td>
	                <td>RESTAR 1.2%:</td>
	                <td> SI
	                  <input name="RDResto12" type="radio" class="button" id="RDResto12" value="S" <?php if($resto12=="S"){ echo "checked";} ?>>
	                  NO
	                    <input type="radio" name="RDResto12" id="RDResto12" value="N" class="button" <?php if($resto12=="N"){ echo "checked";} ?>>	                    </td>
                  </tr>                  
                </table></td>
              </tr>
	          <tr>
	            <td>&nbsp;</td>
	            </tr>                                      	
	          <tr>
	            <td><div align="center"><span style="color: #000">
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