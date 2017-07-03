<?php
require_once('funciones.inc.php');
/*if (falta_logueo())
{ 
	header ('location:login.php');
	exit();
}*/

 $Xaccion	= $_GET['accion'];
 $Xcod 		= $_GET['cod'];

 $db 	= conecto();
 $sql 	= " select * from usuarios where cod_usu = '".$Xcod."' ";
 //echo $sql;
 $r   = mysqli_query($db, $sql);
	
	  if ($r == false){
	  	mysqli_close($db);
	    $error = "Error: (" . mysql_errno() . ") " . mysql_error().")";
	    //gestion_errores();
	  }
	    mysqli_close($db);
		
	
 if($_POST){	
 
  	//if($Xaccion == "ELI"){
	if($_POST['TXTeli']){	
		$TXTnombre = $_POST['TXTnombre'];
		$TXTclave  = $_POST['TXTclave'];
		
		if(strlen($TXTnombre)!=0){
			$db  = conecto();
				
			$sql = " DELETE FROM usuarios where cod_usu = ".$Xcod." ";		
					 
			  $r   = mysqli_query($db, $sql);
			
			  if ($r == false){
			  	mysqli_close($db);
			    $error = "Error: (" . mysql_errno() . ") " . mysql_error().")";
			    //gestion_errores();
			  }
			    mysqli_close($db);
		}
		header('location:resultado.php?acc=ELI');
		die;	
						
	}

 	// if($Xaccion == "MOD"){
	if($_POST['TXTmod']){
		$TXTnombre = $_POST['TXTnombre'];
		$TXTclave  = $_POST['TXTclave'];

		if(strlen($TXTnombre)!=0){
			$db  = conecto();
			$sql = " UPDATE usuarios SET des_usu = '".$TXTnombre."', clave = '".$TXTclave."' where cod_usu = '".$Xcod."' ";		
						 
			  $r   = mysqli_query($db, $sql);
			
			  if ($r == false){
			  	mysqli_close($db);
			    $error = "Error: (" . mysql_errno() . ") " . mysql_error().")";
			    //gestion_errores();
			  }
			    mysqli_close($db);	
		}
		
		header('location:resultado.php?acc=MOD');
		die;			
	}	
	
	if($_POST['XBOTON']){
		header('location:index.php');
		die;
	}
	
	if($_POST['XBOTONCM']){
		header('location:usuarios.php');
		die;
	}
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
    
 </head>
<body>
	<div class="logo">_%%_empresanombre_%%_</div>
	<div id="page-wrap"> 
    <?php include 'menu.php'; ?>
	<p>USUARIO: <?php echo $Xnombre; ?></p>
	<form action="" method="post" name="form1" >
    <table class="sombra" border="0">
		<thead>
		<tr>
        	<th><div align="center">ACCION: <?php if($Xaccion == "ELI"){
									echo "ELIMINAR USUARIO";
							   }else{
								    echo "MODIFICAR USUARIO";
							   }?></div>        
       	    </th>
		</tr>
		</thead>
		<tbody>
		<tr>
			<td>
            
              <table width="100%" border="0">
                <tr>
                  <td >USUARIO</td>
                  <td >CONTRASE&Ntilde;A</td>
                </tr>
                <?php   
				while ($arr = mysqli_fetch_array($r))		
				{		
			  ?>
                <tr>
                  <td><input name="TXTnombre" type="text" id="TXTnombre" maxlength="15" <?php echo 'value="'.$des_usu = trim($arr['des_usu']).'"'; ?> class="button"></td>
                  <td><input name="TXTclave" type="text" id="TXTclave" maxlength="10" <?php echo 'value="'.$clave = trim($arr['clave']).'"'; ?> class="button"></td>
                </tr>
                <?php 
				}
 			  ?>
                <tr>
                  <td colspan="2">&nbsp;</td>
                </tr>
            </table></td>
		</tr>
		<tr>
			<td><div align="center">
            <?php if($Xaccion == "ELI"){
					echo '<input type="submit"  name="TXTeli" id="TXTeli" value="ELIMINAR" class="button">';
				  }else{				    
					echo '<input type="submit"  name="TXTmod" id="TXTmod" value="MODIFICAR" class="button">';
				  } ?>          
            </div></td>
		</tr>
		</tbody>
	</table>
    </form>
	</div>
</body>
</html>