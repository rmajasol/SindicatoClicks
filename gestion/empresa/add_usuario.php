<?
if ($admin == 1){?>

<?
	if (!isset($_POST['numUsuarios'])){?>
		<form action="?mod=ver_empresa&n=<? echo "$_GET[n]";?>&action=add_usuario" method="post">
			&nbsp; Número de usuarios a insertar: &nbsp;
			<input name="num" type="text" size="5" />
			<input type="submit" name="numUsuarios" value="OK" />
		</form><?
		exit;
	}
	
	$num_existe = 0;
	$sql = "SELECT $ID,$NOMBRE_DE_USUARIO FROM $TABLA_USUARIOS ORDER BY $NOMBRE_DE_USUARIO ASC";
	$res = mysql_query($sql) or die (mysql_error());
	while($fila = mysql_fetch_array($res)){
		$ya_existe = 0;
		$sql2 = "SELECT $ID_EMPRESA FROM $TABLA_PAGOS WHERE $ID_USUARIO = $fila[$ID]";
		$res2 = mysql_query($sql2) or die (mysql_error());
		$sql3 = "SELECT $ID FROM $TABLA_EMPRESAS WHERE $NOMBRE_DE_EMPRESA = '$_GET[n]'";
		$res3 = mysql_query($sql3) or die (mysql_error());
		$fila3 = mysql_fetch_array($res3);
		while($fila2 = mysql_fetch_array($res2))
			if ($fila2[$ID_EMPRESA] == $fila3[$ID])
				$num_existe++;
	}
	$count = mysql_num_rows($res);
	if ($num_existe == $count){
		echo "No hay más usuarios para insertar a esta empresa. Recuerda añadir un usuario antes a la base de datos si es nuevo.";
		exit;
	}?>
		
	<form action="?mod=ver_empresa&n=<? echo "$_GET[n]";?>&action=add_usuario" method="post">
		<table border="0" cellpadding="3"><?
			if ($_POST['num'] == NULL){
				$num = 1;
			}else{
				$num = $_POST['num'];
			}
			for ($i=0;$i<$num;$i++){?>
				<tr>
					<td>
						<select name="usuario<? echo "$i";?>">
						<option value="" selected></option><?
						$sql = "SELECT $ID,$NOMBRE_DE_USUARIO FROM $TABLA_USUARIOS ORDER BY $NOMBRE_DE_USUARIO ASC";
						$res = mysql_query($sql) or die (mysql_error());
						while($fila = mysql_fetch_array($res)){
							$ya_existe = 0;
							$sql2 = "SELECT $ID_EMPRESA FROM $TABLA_PAGOS WHERE $ID_USUARIO = $fila[$ID]";
							$res2 = mysql_query($sql2) or die (mysql_error());
							$sql3 = "SELECT $ID FROM $TABLA_EMPRESAS WHERE $NOMBRE_DE_EMPRESA = '$_GET[n]'";
							$res3 = mysql_query($sql3) or die (mysql_error());
							$fila3 = mysql_fetch_array($res3);
							while($fila2 = mysql_fetch_array($res2)){
								if ($fila2[$ID_EMPRESA] == $fila3[$ID])
									$ya_existe = 1;
							}
							if ($ya_existe == 0){?>
										<option value="<? echo "$fila[$NOMBRE_DE_USUARIO]";?>"><? echo "$fila[$NOMBRE_DE_USUARIO]";?></option><?
							}
						}?>
						</select>
					</td>
					<td>&nbsp; Nick: <input name="nick<? echo "$i";?>" type="text" size="15"></td>
				</tr><?
			}?>
			<input type="hidden" name="num_usuarios" value="<? echo "$num";?>">
			<tr><td colspan="2" align="right"><input type="submit" name="añadir_usuarios" value="añadir" /></td></tr>
		</table>
	</form><?
	
}else{?>acceso denegado.<? }?>
