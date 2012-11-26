<? 
if ($admin == 1){

if (isset($_POST['añadir_usuarios'])){
	$sql = "SELECT $ID FROM $TABLA_EMPRESAS WHERE $NOMBRE_DE_EMPRESA='$_GET[n]'";
	$res = mysql_query($sql) or die (mysql_error());
	$fila = mysql_fetch_array($res);
	$id_empresa = $fila[$ID];
	$salida = "";
	$salir = 0;
	$u = "usuario0";
	for ($i=0;$i<$_POST['num_usuarios'] & $salir == 0 & $u != 'null';){
		$u = "usuario".$i;
		$usu = $_POST[$u];
		if ($usu == 'null')
			$salir = 1;
		else{
			$sql = "SELECT $ID,$NOMBRE_DE_USUARIO FROM $TABLA_USUARIOS WHERE $NOMBRE_DE_USUARIO='$usu'";		
			$res = mysql_query($sql) or die (mysql_error());
			$fila = mysql_fetch_array($res);
			$campos = "$ID_EMPRESA,$ID_USUARIO,$NICK,$FECHA_INSCRIPCION";
			$valores = "'" . $id_empresa . "',";
			$valores .= "'" . $fila[$ID] . "',";
			$nick = "nick"."$i";
			if ($_POST[$nick] == NULL)
				$valores .= "'" . $fila[$NOMBRE_DE_USUARIO] . "',";
			else
				$valores .= "'" . $_POST[$nick] . "',";
			$valores .= "'" . date("Y-m-d") . "'";
			$sql = "INSERT INTO $TABLA_PAGOS ($campos) VALUES ($valores)";
			$res = mysql_query($sql) or die (mysql_error());
			$salida .= "Usuario: <b>".$fila[$NOMBRE_DE_USUARIO]."</b> añadido correctamente.<br>";
			$j = $i+1;
			$usu = "usuario".$j;
			if ($_POST[$usu] == 'null')
				$salir = 1;
			$i++;
		}
	}
	if ($i == 0){?>
		No se le ha añadido ningún usuario. <a href="http://www.sindicatoclicks.net/gestion/ver_empresa.php?n=<? echo "$_GET[n]";?>">Volver</a><?
	}else if ($i>1){
		echo "$salida";?>
		<br /><? echo "$i";?> usuarios/s añadido/s correctamente. <a href="/gestion/?mod=ver_empresa&n=<? echo "$_GET[n]";?>">Volver</a><?
	}else
		echo "$salida";
	exit;
}

}else{?>acceso denegado.<? }?>