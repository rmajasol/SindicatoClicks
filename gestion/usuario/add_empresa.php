<?
if ($admin == 1){?>
<center><?
		if (!isset($_POST['numEmpresas'])){?>
			<form action="?mod=ver_usuario&n=<? echo "$_GET[n]";?>&action=add_empresa" method="post">
				&nbsp; Número de empresas a insertar: &nbsp;
				<input name="num" type="text" size="5" />
				<input type="submit" name="numEmpresas" value="OK" />
			</form><?
			exit;
		}?>
		<form action="?mod=ver_usuario&n=<? echo "$_GET[n]";?>&action=add_empresa" method="post">
		<table border="0" cellpadding="3"><?
			if ($_POST['num'] == NULL){
				$num = 1;
			}else{
				$num = $_POST['num'];
			}
			for ($i=0;$i<$num;$i++){?>
				<tr>
					<td>
						<select name="empresa<? echo "$i";?>">
						<option value="null" selected></option><?
						$sql = "SELECT $ID,$NOMBRE_DE_EMPRESA FROM $TABLA_EMPRESAS WHERE $ESTADO!='scam'";
						if ($ver_todas == 0)
							$sql .= " and $DUEÑO='".$username."'"; 
						$sql .= " ORDER BY $NOMBRE_DE_EMPRESA ASC";
						$res = mysql_query($sql) or die (mysql_error());
						while($fila = mysql_fetch_array($res)){
							$ya_existe = 0;
							$sql2 = "SELECT $ID_USUARIO FROM $TABLA_PAGOS WHERE $ID_EMPRESA = $fila[$ID]";
							$res2 = mysql_query($sql2) or die (mysql_error());
							$sql3 = "SELECT $ID FROM $TABLA_USUARIOS WHERE $NOMBRE_DE_USUARIO = '$_GET[n]'";
							$res3 = mysql_query($sql3) or die (mysql_error());
							$fila3 = mysql_fetch_array($res3);
							while($fila2 = mysql_fetch_array($res2)){
								if ($fila2[$ID_USUARIO] == $fila3[$ID])
									$ya_existe = 1;
							}
							if ($ya_existe == 0){?>
										<option value="<? echo "$fila[$NOMBRE_DE_EMPRESA]";?>"><? echo "$fila[$NOMBRE_DE_EMPRESA]";?></option><?
							}
						}?>
						</select>
					</td>
					<td>&nbsp; Nick: <input name="nick<? echo "$i";?>" type="text" size="15"></td>
				</tr><?
			}?>
			<input type="hidden" name="num_empresas" value="<? echo "$num";?>">
			<tr>
				<td colspan="2" align="right"><input type="submit" name="añadir_empresas" value="añadir" /></td>
			</tr>
		</table>
		</form>
</center><?
}else{?>acceso denegado.<? }?>
		