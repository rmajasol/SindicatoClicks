<form action="../gestion/ver.php" method="post">
<table border="1">
	<tr>
		<td>
			<table border="0">
				<tr>
					<td colspan="2" class="titulo2 usuarios">Usuarios</td>
				</tr>
				<tr>
					<td>
						<select name="usuario" onchange='this.form.submit()'>
							<option value="" selected></option><?
							$sql = "SELECT $NOMBRE_DE_USUARIO FROM $TABLA_USUARIOS ORDER BY $NOMBRE_DE_USUARIO ASC";
							$res = mysql_query($sql) or die (mysql_error());
							while($fila = mysql_fetch_array($res)){?>
								<option value="<? echo "$fila[$NOMBRE_DE_USUARIO]";?>"><? echo "$fila[$NOMBRE_DE_USUARIO]";?></option><?
							}?>
						</select>
					</td>
					<td>
						[<a href="?mod=lista_usuarios">Listar</a>]
					</td>
				</tr>
				<tr>
					<td colspan="2">
						
					</td>
				</tr>
			</table>
		</td>
		<td class="cacho_negro"></td>
		<td>
			<table border="0">
				<tr>
					<td colspan="2" class="titulo2 empresas">Empresas</td>
				</tr>
				<tr>
					<td>
						<select name="empresa" onchange='this.form.submit()'>
							<option value="" selected></option><?
							$sql = "SELECT $NOMBRE_DE_EMPRESA,$DUEÑO,$ESTADO FROM $TABLA_EMPRESAS";
							if ($ver_todas == 0){
								$sql .= " WHERE $DUEÑO='".$username."'";
								if ($ver_scam == 0)
									$sql .= " and $ESTADO!='scam'";
							}else if ($ver_scam == 0){
								$sql .= " WHERE $ESTADO!='scam'";
							}
							$sql .= " ORDER BY $NOMBRE_DE_EMPRESA ASC";
							$res = mysql_query($sql) or die (mysql_error());
							while($fila = mysql_fetch_array($res)){?>
								<option value="<? echo "$fila[$NOMBRE_DE_EMPRESA]";?>"><? echo "$fila[$NOMBRE_DE_EMPRESA]";?></option><?
							}?>
						</select>
					</td>
					<td>
						[<a href="?mod=lista_empresas">Listar</a>]
					</td>
				</tr>
				<tr>
					<td colspan="2">
						<a href="?mod=ins_empresa">[ Insertar nueva empresa ]</a>
					</td>
				</tr>

			</table>
		</td>
	</tr>
</table>
</form>
