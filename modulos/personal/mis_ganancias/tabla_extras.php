<?
$sql = "SELECT * FROM $TABLA_EXTRAS WHERE $ID_USUARIO_EX=".$id_usuario." ORDER BY $FECHA_EX DESC";
$res = mysql_query($sql) or die (mysql_error());
$count = mysql_num_rows($res);

if ($count > 0){?>

<table class="sortable" id="tabla">
<thead>
	<tr>
		<th>Concepto</th>
		<th>Cantidad</th>
		<th>Pagado</th>
		<th>Fecha de pago</th>
	</tr>
</thead>
<tbody><?
	while($fila = mysql_fetch_array($res)){
		$concep = dec_utf8($fila[$CONCEPTO_EX]);?>
		<tr>
			<td><? echo "$concep";?></td>
			<td align="right"><? echo "$fila[$CANTIDAD_EX]";?></td>
			<td class="pagado<? echo "$fila[$PAGADO_EX]";?>"></td><?
			if ($fila[$PAGADO_EX] == 1){?>
				<td align="right"><? echo "$fila[$FECHA_EX]";?></td><?
			}else{?>
				<td align="right"></td><?	
			}?>
		</tr><?
	}?>
</tbody>
</table><?
}else{?>
	<div class="cuadro_mensaje">No tienes asociado ningún extra.</div><?
}?>
