<?php
require_once('funciones.inc.php');
 //session_destroy();
 //session_start();
 
 $mal_pasw 	= false;
 $mal_usu	= false;	
 $mensaje	="";
 
if($_POST)
{
  $Xusuario = $_POST['usuario'];

	if (strlen(trim($_POST['password']))== 0)  // no tipeo password
	{
		$Xmal_pasw = true ;	
						
	}else{	
		$db 	= conecto();
		$sql 	= "select * from usuarios where des_usu = '$Xusuario' ";
		//echo $sql; exit();
		$r  	= mysql_query($sql);

		if (!$r){
			mysql_close($db);
			$error = "Error: (" . mysql_errno() . ") " . mysql_error().")";
			//gestion_errores();
		}
			mysql_close($db);	
			$cantidad   = mysql_num_rows($r);
								
			
		if ($cantidad ==0){
			header ('location:error.php?accion=Err02');
			exit();
			//echo "No se hallo ese Usuario. Verifique";
		}else{
			$arr = mysql_fetch_assoc($r);
								
			if (trim($arr['clave']) == trim($_POST['password'])){
				
				$Xdes_usu = $arr['des_usu'];
												
				logueo_in($Xdes_usu);
																									
				header("location:index.php");
				exit();	
			}else{
				 header ('location:error.php?accion=Err03');
				 exit();
				 //password incorrecto;
				 }	
			}		
		}					
									
}	
?>
<!DOCTYPE html>
<html>
 <head>
	<meta charset='iso-8859-1'>
	<title>_%%_empresanombre_%%_</title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!--<meta http-equiv="refresh" content="5;url=http://localhost/Limpieza/index.php">-->
	<link rel="stylesheet" href="css/style.css">
 </head>
<body>
	<div id="page-wrap"> 
    <div class="caption">_%%_empresanombre_%%_.</div> 
	<form action="" method="post" name="form1" >
    <table class="sombra" border="0">
		<thead>
		<tr>
        	<th colspan="2"><div align="center">INGRESO <?php echo '<br>'.$mensaje.'<br>';?></div></th>
		</tr>
         <tr>
           <th width="50%"><div align="right">USUARIO:</div></th>
           <th><input type="text" name="usuario" id="usuario"></th>
         </tr>
         <tr>
        	<th><div align="right">CONTRASE&Ntilde;A:</div></th>
        	<th><input type="password" name="password" id="password"></th>
		 </tr>
		</thead>
		<tbody>
		<tr>
			<td colspan="2"><div align="center"><button type="submit" name="submit" id="submit" value="Ingresar">Ingresar</button></div></td>
		</tr>
		</tbody>
	</table>
    </form>
	</div>
</body>
</html>
