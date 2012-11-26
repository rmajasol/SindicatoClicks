<?
if ($admin == 1){
$sql = "SELECT $ID FROM $TABLA_USUARIOS WHERE $NOMBRE_DE_USUARIO='$_GET[n]'";
$res = mysql_query($sql) or die (mysql_error());
$fila = mysql_fetch_array($res);
$id_u = $fila[$ID];

if ($_GET['action2'] == 'cargar_extra'){?>
	<form action="?mod=ver_usuario&n=<? echo "$_GET[n]";?>&action=cargar_extras" method="post">
		<table align="center" border="2"  cellpadding="2" cellspacing="0">
			<tr>
				<td>Concepto:</td>
				<td><textarea name="concepto" rows="3" cols="30"></textarea></td>
			</tr>
			<tr>
				<td>Cantidad:</td>
				<td><input name="cantidad" type="text" size="7"/></td>
			</tr>
			<tr>
				<td colspan="2"><input type="submit" name="cargar" value="Cargar" /></td>
			</tr>
		</table>
	</form><?
	exit;
}else if ($_GET['action2'] == 'cargar_extra_ref'){
	$campos = "$ID_USUARIO_EX,$CANTIDAD_EX,$CONCEPTO_EX";
	$valores = "'" . $id_u . "',";
	$valores .= "'10',";
	$txt = "referido <b>".$_GET['from']."</b> alcanzó los $20";
	$conc = enc_utf8($txt);
	$valores .= "'" . $conc . "'";
	$sql = "INSERT INTO $TABLA_EXTRAS ($campos) VALUES ($valores)";
	$res = mysql_query($sql) or die (mysql_error());
	$sql = "UPDATE $TABLA_USUARIOS SET $REFERIDO_PAGADO=1 WHERE $NOMBRE_DE_USUARIO='".$_GET['from']."'";
	$res = mysql_query($sql) or die (mysql_error());?>
	<center>Extra cargado correctamente!</center><?
	exit;
}


if (isset($_POST['cargar'])){
	$campos = "$ID_USUARIO_EX,$CANTIDAD_EX,$CONCEPTO_EX";
	$valores = "'" . $id_u . "',";
	$valores .= "'" . $_POST['cantidad'] . "',";
	$conc = enc_utf8($_POST['concepto']);
	$valores .= "'" . $conc . "'";
	$sql = "INSERT INTO $TABLA_EXTRAS ($campos) VALUES ($valores)";
	$res = mysql_query($sql) or die (mysql_error());?>
	<center>Extra cargado correctamente!</center><?
}	

if (isset($_POST['editar'])){
	$conc = enc_utf8($_POST['concepto']);
	$sql2 = "UPDATE $TABLA_EXTRAS SET ";
	$sql2 .= "$CONCEPTO_EX = '" . $conc . 		"', ";
	$sql2 .= "$CANTIDAD_EX = '" . $_POST['cantidad'] . 		"', ";
	$sql2 .= "$FECHA_EX = '" . $_POST['f_año_fecha_ex'] . "-" . $_POST['f_mes_fecha_ex'] . "-" . $_POST['f_dia_fecha_ex'] . "', ";
	$sql2 .= "$PAGADO_EX = '" . $_POST['pagado'] . 		"' ";
	$sql2 .= "WHERE $ID_EX=" . $_GET['id'];
	$res2 = mysql_query($sql2) or die(mysql_error());?>
	<center>Extra editado correctamente!</center><?
}

if ($_GET['action2'] == 'eliminar'){
	if (isset($_POST['yes'])){
		$sql2 = "DELETE FROM $TABLA_EXTRAS WHERE id=" . $_GET['id'];
		$res2 = mysql_query($sql2) or die (mysql_error());?>
		<center>Extra eliminado correctamente!</center><?
	}else if (isset($_POST['no'])){
	}else{?>
		<center>¿Estás seguro de querer eliminarle ese extra?
		<form action="?mod=ver_usuario&n=<? echo "$_GET[n]";?>&action=cargar_extras&action2=eliminar&id=<? echo "$_GET[id]";?>" method="post">
			<input type="submit" name="yes" value="SI" />&nbsp;
			<input type="submit" name="no" value="NO" />
		</form></center><?
	}
}

$sql = "SELECT * FROM $TABLA_EXTRAS WHERE $ID_USUARIO_EX=".$id_u." ORDER BY $FECHA_EX DESC";
$res = mysql_query($sql) or die (mysql_error());
$count = mysql_num_rows($res);

if ($count > 0){?>

<table align="center" border="2"  cellpadding="2" cellspacing="0">
<thead>
	<tr>
		<th>Concepto</th>
		<th>Cantidad</th>
		<th>Pagado</th>
		<th>Fecha de pago</th>
		<th style="border:none" colspan="2"></th>
	</tr>
</thead>
<tbody><?
	while($fila = mysql_fetch_array($res)){
		$concep = dec_utf8($fila[$CONCEPTO_EX]);
		$fecha = $fila[$FECHA_EX];
		$año = substr($fecha,0,4);
		$mes = substr($fecha,5,2);
		$dia = substr($fecha,8,2);
		if ($_GET['action2'] == 'editar' & $fila[$ID] == $_GET['id']){?>
			<form action="?mod=ver_usuario&n=<? echo "$_GET[n]";?>&action=cargar_extras&id=<? echo "$fila[$ID]";?>" method="post">
			<tr>
				<td align="right"><textarea name="concepto" rows="3" cols="30"><? echo "$concep";?></textarea></td>
				<td align="right"><input name="cantidad" type="text" size="7"  value="<? echo "$fila[$CANTIDAD_EX]";?>"/></td>
				<td align="right"><input name="pagado" type="text" size="7"  value="<? echo "$fila[$PAGADO_EX]";?>"/></td><?
				if ($fila[$PAGADO_EX] == 1){?>
					<td align="right"><? form_comp_fecha($año,$mes,$dia,'fecha_ex');?></td><?
				}else{?>
					<td></td><?
				}?>
				<td align="center" style="border:none" colspan="2"><input type="submit" name="editar" value="Editar" /></td>	
			</tr>
			</form><?
		}else{?>
			<tr>
				<td><? echo "$concep";?></td>
				<td align="right"><? echo "$fila[$CANTIDAD_EX]";?></td>
				<td align="right"><? echo "$fila[$PAGADO_EX]";?></td><?
				if ($fila[$PAGADO_EX] == 1){?>
					<td align="right"><? echo "$fila[$FECHA_EX]";?></td><?
				}else{?>
					<td></td><?
				}?>		
				<td align="center" style="border:none"><a href="?mod=ver_usuario&n=<? echo "$_GET[n]";?>&action=cargar_extras&action2=editar&id=<? echo "$fila[$ID]";?>">Editar</a></td>
				<td align="center" style="border:none"><a href="?mod=ver_usuario&n=<? echo "$_GET[n]";?>&action=cargar_extras&action2=eliminar&id=<? echo "$fila[$ID]";?>">Eliminar</a></td>
			</tr><?
		}
	}?>
</tbody>
</table><?
}else{?>
	<tr><td colspan='7' align='center'><span class="Estilo1">Este usuario no tiene asociado ningún extra.</span></td></tr><?
}?>
<a href="?mod=ver_usuario&n=<? echo "$_GET[n]";?>&action=cargar_extras&action2=cargar_extra">Cargar nuevo extra</a><?
}else{?>acceso denegado.<? }?>