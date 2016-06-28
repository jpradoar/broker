<?php
require_once('funciones.inc.php');
/*if (falta_logueo())
{ 
	header ('location:login.php');
	exit();
}

 //SI NO ES EL ADMINISTRADOR NO TENES NADA QUE HACER ACA
 $Xusuario = $_SESSION['usuario'];
 	
 if($Xusuario!='admin'){
	header ('location:index.php');
	exit();	 
 }*/
  //SI NO ES EL ADMINISTRADOR NO TENES NADA QUE HACER ACA
  
  //TRAIGO TODOS LOS USUARIOS
  $db 	= conecto();
  $sql 	= " select * from usuarios ";
  $r   = mysqli_query($db, $sql);

  if ($r == false){
  	mysqli_close($db);
    $error = "Error: (" . mysql_errno() . ") " . mysql_error().")";
    //gestion_errores();
  }
    mysqli_close($db);
	
	
	
 if($_POST){	
	$Xaccion = $_GET['accion'];
	
	if($_POST['BTNuevo']){
		
		$TXTnuevonombre = $_POST['TXTnuevonombre'];
		$TXTnuevaclave  = $_POST['TXTnuevaclave'];
		
		if(strlen($TXTnuevonombre)!=0){
			
			$db  = conecto();
		
			$sql = " INSERT INTO usuarios (des_usu, clave) VALUES ('".$TXTnuevonombre."', '".$TXTnuevaclave."')  ";		
			//echo $sql;	 
			  $r   = mysqli_query($db, $sql);
			
			  if ($r == false){
			  	mysqli_close($db);
			    $error = "Error: (" . mysql_errno() . ") " . mysql_error().")";
			    //gestion_errores();
			  }
			    mysqli_close($db);
		}	
			
	}

	

	//REFRESCO LOS DATOS
	  $db 	= conecto();
	  $sql 	= " select * from usuarios ";
	  $r   = mysqli_query($db, $sql);
	
	  if ($r == false){
	  	mysqli_close($db);
	    $error = "Error: (" . mysql_errno() . ") " . mysql_error().")";
	    //gestion_errores();
	  }
	    mysqli_close($db);
		
		
	if($_POST['XBOTON']){
		header('location:index.php');
		die;
	}
 }	
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

    <!-- PARA AGREGAR ARCHIVOS-->    
	<!--<script type="text/javascript" src="jquery.js"></script>-->
	<script type="text/javascript" src="js/jquery.addfield.js"></script> 
    <!-- FIN PARA AGREGAR ARCHIVOS-->
    
 </head>
<body>
	<div class="logo">BHI - BROKERS</div>
	<div id="page-wrap"> 
 
	 <form action="" method="post" name="form1" enctype="multipart/form-data">   
    <?php include 'menu.php'; ?>

	<p>USUARIO: <?php echo $Xnombre; ?></p>
    <table class="sombra" border="0">
		<thead>
		<tr>
        	<th><div align="center"> USUARIOS</div>
        	  <table width="100%" border="0">
        	    <tr>
        	      <td bgcolor="#000099">USUARIO</td>
        	      <td bgcolor="#000099">CONTRASE&Ntilde;A</td>
        	      <td bgcolor="#000099">ACCION</td>
      	      </tr>
              <?php   
			   	$X=0; 
				while ($arr = mysqli_fetch_array($r))		
				{		
			  ?>
        	    <tr>
        	      <td><input type="text" name="TXTnombre" id="TXTnombre" disabled <?php echo 'value="'.$desusu = trim($arr['des_usu']).'"'; ?> class="button"></td>
        	      <td><input type="text" name="TXTclave" id="TXTclave" disabled <?php echo 'value="'.$clave = trim($arr['clave']).'"'; ?> class="button"></td>
        	      <td>
                  <?php $cod_usu = trim($arr['cod_usu']); ?>
                   <a href="<?php echo 'accion.php?cod='.$cod_usu.'&accion=MOD';?>"><input type="button" value="MODIFICAR" class="button"></a>
        	       <a href="<?php echo 'accion.php?cod='.$cod_usu.'&accion=ELI';?>"><input type="button" value="ELIMINAR" class="button"></a> 
        	        
       	          </td>
      	      </tr>
              <?php 
			  	$X++;
				}
 			  ?>
              <tr>
        	      <td><input name="TXTnuevonombre" type="text" id="TXTnuevonombre" maxlength="15" class="button"></td>
        	      <td><input name="TXTnuevaclave" type="text" id="TXTnuevaclave" maxlength="10" class="button"></td>
        	      <td><input type="submit" name="BTNuevo" id="BTNuevo" value="NUEVO" class="button"></td>
      	      </tr>
              <tr>
        	      <td colspan="3">&nbsp;</td>
       	        </tr>              
      	    </table>
       	    </th>
		</tr>
		</thead>
		<tbody>
		<tr>
			<td><div align="center"><button type="submit" name="XBOTON" id="XBOTON" value="Enviar" class="button">Volver</button></div></td>
		</tr>
		</tbody>
	</table>
    </form>
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