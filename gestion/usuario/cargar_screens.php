<?
if ($admin == 1){
if (isset($_POST['cargar'])){
	$sql2 = "UPDATE $TABLA_PAGOS SET ";
	$sql2 .= "$GANANCIA_NETA_ANTERIOR = '" . $_POST['ganado_anterior'] . 		"', ";
	$sql2 .= "$GANADO_PROPIO = '" . $_POST['ganado_propio'] . 		"', ";
	$sql2 .= "$GANADO_REFS = '" . $_POST['ganado_refs'] . 		"' ";
	$sql2 .= "WHERE $ID=" . $_GET['id'];
	$res2 = mysql_query($sql2) or die(mysql_error());?>
	<center>Datos cargados correctamente!</center><?
}

$sql = "SELECT $ID FROM $TABLA_USUARIOS WHERE $NOMBRE_DE_USUARIO='$_GET[n]'";
$res = mysql_query($sql) or die (mysql_error());
$fila = mysql_fetch_array($res);
$id_u = $fila[$ID];
$sql = "SELECT $TABLA_PAGOS.$GANANCIA_NETA_ANTERIOR,$TABLA_PAGOS.$ID,$TABLA_PAGOS.$GANADO_PROPIO,$TABLA_PAGOS.$GANADO_REFS,$TABLA_EMPRESAS.$NOMBRE_DE_EMPRESA,$TABLA_EMPRESAS.$PROGRESO,$TABLA_EMPRESAS.$MINIMO FROM $TABLA_EMPRESAS INNER JOIN $TABLA_PAGOS ON $TABLA_PAGOS.$ID_EMPRESA=$TABLA_EMPRESAS.$ID WHERE $TABLA_PAGOS.$ID_USUARIO='$id_u' and $TABLA_EMPRESAS.$TIPO_GESTION='c' and $TABLA_EMPRESAS.$ESTADO!='scam'";
if ($ver_todas == 0)
	$sql .= " and $DUEÑO='".$username."'";
$sql .= " ORDER BY $NOMBRE_DE_EMPRESA ASC";
$res = mysql_query($sql) or die (mysql_error());
$count = mysql_num_rows($res);

if ($count > 0){?>

<table align="center" border="2"  cellpadding="2" cellspacing="0">
<thead>
	<tr>
		<th>Empresa</th>
		<th>ya pagado</th>
		<th>propio</th>
		<th>refs</th>
		<th style="border:none"></th>
	</tr>
</thead>
<tbody><?
	while($fila = mysql_fetch_array($res)){
		if ($_GET['action2'] == 'cargar' & $fila[$ID] == $_GET['id'] & !isset($_POST['cargar'])){?>
			<form action="?mod=ver_usuario&n=<? echo "$_GET[n]";?>&action=cargar_screens&action2=cargar&id=<? echo "$fila[$ID]";?>" method="post">
			<tr>
				<td><a href="?mod=ver_empresa&n=<? echo "$fila[$NOMBRE_DE_EMPRESA]";?>"><? echo "$fila[$NOMBRE_DE_EMPRESA]";?></a></td>
				<td align="right"><input name="ganado_anterior" type="text" size="7"  value="<? echo "$fila[$GANANCIA_NETA_ANTERIOR]";?>"/></td>
				<td align="right"><input name="ganado_propio" type="text" size="7"  value="<? echo "$fila[$GANADO_PROPIO]";?>"/></td>
				<td align="right"><input name="ganado_refs" type="text" size="7"  value="<? echo "$fila[$GANADO_REFS]";?>"/></td>
				<td align="center" style="border:none"><input type="submit" name="cargar" value="Cargar" /></td>	
			</tr>
			</form><?
		}else{?>
			<tr>
				<td><a href="?mod=ver_empresa&n=<? echo "$fila[$NOMBRE_DE_EMPRESA]";?>"><? echo "$fila[$NOMBRE_DE_EMPRESA]";?></a></td>
				<td align="right"><? echo "$fila[$GANANCIA_NETA_ANTERIOR]";?></td>
				<td align="right"><? echo "$fila[$GANADO_PROPIO]";?></td>
				<td align="right"><? echo "$fila[$GANADO_REFS]";?></td>		
				<td align="center" style="border:none"><a href="?mod=ver_usuario&n=<? echo "$_GET[n]";?>&action=cargar_screens&action2=cargar&id=<? echo "$fila[$ID]";?>">Cargar datos</a></td>
			</tr><?
		}
	}?>
</tbody>
</table><?
}else{?>
	<tr><td colspan='7' align='center'><span class="Estilo1">Este usuario no está apuntado a ninguna empresa de tipo C (screen).</span></td></tr><?
}
}else{?>acceso denegado.<? }?>