<?
$sql = "SELECT $TABLA_PAGOS.*,$TABLA_EMPRESAS.$NOMBRE_DE_EMPRESA FROM $TABLA_EMPRESAS INNER JOIN $TABLA_PAGOS ON $TABLA_PAGOS.$ID_EMPRESA=$TABLA_EMPRESAS.$ID WHERE $TABLA_PAGOS.$ID_USUARIO=" .$id_usuario. " ORDER BY $NOMBRE_DE_EMPRESA ASC";
$res = mysql_query($sql) or die (mysql_error());
$count = mysql_num_rows($res);

if ($count > 0){?>
<table class="sortable" id="tabla" align="center">
<thead>
	<tr>
		<th></th>
		<th>Empresa</th>
		<th>Por pagarte</th>
		<th>Pagado</th>
	</tr>
</thead>
<tbody><?
	$total_por_pagar = 0;
	$total_pagado = 0;
	while($fila = mysql_fetch_array($res)){
		if ($fila[$POR_PAGAR] != 0 | $fila[$PAGADO] != 0){?>
			<tr>
				<td></td>
				<td><? echo "$fila[$NOMBRE_DE_EMPRESA]";?></td>
				<td><? echo "$fila[$POR_PAGAR]";?></td>
				<td><? echo "$fila[$PAGADO]";?></td>
			</tr><?
			$total_por_pagar += $fila[$POR_PAGAR];
			$total_pagado += $fila[$PAGADO];
		}
	}?>
</tbody>
<tfoot>
  	<td rowspan="<? echo "$count";?>" colspan="2" align="center">Total</td>
	<td><? echo "$total_por_pagar";?></td>
	<td><? echo "$total_pagado";?></td>
</tfoot>
</table><?
}else{?>
	<div class="cuadro_mensaje">No estás apuntado a ninguna empresa.</div><?
}?>