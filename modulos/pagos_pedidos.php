<?
$con = conectar();
$sql = "SELECT $ID,$NOMBRE_DE_EMPRESA,$DIVISA,$CANTIDAD_PEDIDO,$LINK_PAGO_PEDIDO,$FECHA_PAGO_PEDIDO FROM $TABLA_EMPRESAS WHERE $PAGO_PEDIDO=1 and $ESTADO!='scam' ORDER BY $FECHA_PAGO_PEDIDO DESC";
$res = mysql_query($sql) or die (mysql_error());?>

<table id="tabla" class="sortable" align="center">
	<thead>
		<tr class="cabecera">
			<th>PTC</th>
			<th>Pago nº</th>
			<th>Importe</th>
			<th>Pedido</th>
		</tr>
	</thead>
	<tbody><?
		while($fila = mysql_fetch_array($res)){
			$sql2 = "SELECT $ID FROM $TABLA_TIEMPOS_PAGOS WHERE $ID_EMPRESA=".$fila[$ID];
			$res2 = mysql_query($sql2) or die (mysql_error());
			$count = mysql_num_rows($res2);
			$count++;?>
			<tr>
				<td><? echo "$fila[$NOMBRE_DE_EMPRESA]";?></td>
				<td><? echo "$count";?></td>
                <td>
                	<a href="<? echo "$fila[$LINK_PAGO_PEDIDO]";?>" target="_blank"><? 
					echo simbolo_divisa($fila[$DIVISA]) . "$fila[$CANTIDAD_PEDIDO]";?></a>
             	</td>
				<td><? echo "$fila[$FECHA_PAGO_PEDIDO]";?></td>
			</tr><?
		}?>
	</tbody>
</table>